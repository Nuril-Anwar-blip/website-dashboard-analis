<?php

namespace App\Services;

use App\Models\Survey;
use App\Models\Response;
use App\Models\ResponseDetail;
use App\Models\KpiResult;
use Illuminate\Support\Facades\DB;

/**
 * =============================================
 * ANALYTICS SERVICE (LAYANAN ANALISIS)
 * =============================================
 * 
 * Mesin utama untuk memproses data survey menjadi metrik KPI.
 * Fungsi utama:
 * - Membersihkan data sebelum kalkulasi.
 * - Menghitung NPS (Net Promoter Score).
 * - Menghitung CSAT (Customer Satisfaction Score).
 * - Menghitung Indeks Kepuasan Rata-rata.
 * - Menyediakan data untuk grafik dashboard.
 */
class AnalyticsService
{
    /**
     * Hitung dan simpan semua KPI untuk survey tertentu.
     * Secara otomatis memebersihkan data terlebih dahulu.
     */
    public static function calculateAll(Survey $survey)
    {
        // Bersihkan data sebelum diolah
        CleaningService::cleanSurveyData($survey->id);

        self::calculateNPS($survey);
        self::calculateCSAT($survey);
        self::calculateSatisfactionIndex($survey);
        self::calculateParticipationRate($survey);
    }

    /**
     * Net Promoter Score (NPS) calculation.
     * Skala 0-10. Promoters: 9-10, Passives: 7-8, Detractors: 0-6.
     * Rumus: %Promoters - %Detractors
     */
    protected static function calculateNPS(Survey $survey)
    {
        $question = $survey->questions()
            ->where('question_type', 'scale')
            ->where('question_text', 'like', '%recommend%')
            ->first() ?? $survey->questions()->where('question_type', 'scale')->first();

        if (!$question) return;

        $total = ResponseDetail::where('question_id', $question->id)->count();
        if ($total === 0) return;

        $promoters = ResponseDetail::where('question_id', $question->id)
            ->whereRaw('CAST(answer AS DECIMAL) >= 9')
            ->count();

        $detractors = ResponseDetail::where('question_id', $question->id)
            ->whereRaw('CAST(answer AS DECIMAL) <= 6')
            ->count();

        $npsValue = (($promoters - $detractors) / $total) * 100;

        KpiResult::updateOrCreate(
            ['survey_id' => $survey->id, 'kpi_name' => 'NPS'],
            ['kpi_value' => $npsValue, 'period' => now()->format('Y-m')]
        );
    }

    /**
     * Customer Satisfaction Score (CSAT).
     * Biasanya dihitung dari persentase responden yang menjawab "Puas" (4) atau "Sangat Puas" (5).
     */
    protected static function calculateCSAT(Survey $survey)
    {
        $question = $survey->questions()
            ->where('question_type', 'scale')
            ->where('question_text', 'like', '%satisfied%')
            ->first() ?? $survey->questions()->where('question_type', 'scale')->first();

        if (!$question) return;

        $total = ResponseDetail::where('question_id', $question->id)->count();
        if ($total === 0) return;

        // Asumsi skala 1-5, CSAT adalah % yang jawab 4 atau 5
        $satisfied = ResponseDetail::where('question_id', $question->id)
            ->whereRaw('CAST(answer AS DECIMAL) >= 4')
            ->count();

        $csatValue = ($satisfied / $total) * 100;

        KpiResult::updateOrCreate(
            ['survey_id' => $survey->id, 'kpi_name' => 'CSAT'],
            ['kpi_value' => $csatValue, 'period' => now()->format('Y-m')]
        );
    }

    /**
     * Perhitungan Indeks Kepuasan Rata-rata berdasarkan semua pertanyaan skala.
     */
    protected static function calculateSatisfactionIndex(Survey $survey)
    {
        $avg = ResponseDetail::whereHas('question', function ($query) use ($survey) {
            $query->where('survey_id', $survey->id)->where('question_type', 'scale');
        })->avg(DB::raw('CAST(answer AS DECIMAL)'));

        KpiResult::updateOrCreate(
            ['survey_id' => $survey->id, 'kpi_name' => 'Satisfaction Index'],
            ['kpi_value' => $avg ?? 0, 'period' => now()->format('Y-m')]
        );
    }

    /**
     * Menghitung Partisipasi (Jumlah responden unik).
     */
    protected static function calculateParticipationRate(Survey $survey)
    {
        $totalResponses = $survey->responses()->count();
        
        KpiResult::updateOrCreate(
            ['survey_id' => $survey->id, 'kpi_name' => 'Total Respondents'],
            ['kpi_value' => $totalResponses, 'period' => now()->format('Y-m')]
        );
    }

    /**
     * Mengambil data dashboard dengan filter opsional.
     */
    public static function getDashboardData(Survey $survey, array $filters = [])
    {
        $distribution = self::getDistribution($survey, $filters);
        $kpis = self::calculateDynamicKpis($survey, $filters);

        return [
            'survey' => $survey,
            'kpis' => $kpis,
            'distribution' => $distribution,
        ];
    }

    /**
     * Hitung KPI secara dinamis di memori berdasarkan filter yang dipilih.
     */
    protected static function calculateDynamicKpis(Survey $survey, array $filters)
    {
        $kpis = collect();

        // Total Respondents
        $query = $survey->responses();
        if (!empty($filters['region'])) $query->where('region_id', $filters['region']);
        if (!empty($filters['segment'])) $query->where('segment_id', $filters['segment']);
        $totalResponses = $query->count();
        $kpis->push((object)['kpi_name' => 'Total Respondents', 'kpi_value' => $totalResponses]);

        // NPS
        $question = $survey->questions()
            ->where('question_type', 'scale')
            ->where('question_text', 'like', '%recommend%')
            ->first() ?? $survey->questions()->where('question_type', 'scale')->first();

        if ($question) {
            $rdQuery = ResponseDetail::where('question_id', $question->id)
                ->whereHas('response', function($q) use ($filters) {
                    if (!empty($filters['region'])) $q->where('region_id', $filters['region']);
                    if (!empty($filters['segment'])) $q->where('segment_id', $filters['segment']);
                });
            
            $total = (clone $rdQuery)->count();
            if ($total > 0) {
                $promoters = (clone $rdQuery)->whereRaw('CAST(answer AS DECIMAL) >= 9')->count();
                $detractors = (clone $rdQuery)->whereRaw('CAST(answer AS DECIMAL) <= 6')->count();
                $npsValue = (($promoters - $detractors) / $total) * 100;
                $kpis->push((object)['kpi_name' => 'NPS', 'kpi_value' => $npsValue]);
            }
        }

        // CSAT (Dynamic)
        $csatQuestion = $survey->questions()
            ->where('question_type', 'scale')
            ->where('question_text', 'like', '%satisfied%')
            ->first() ?? $survey->questions()->where('question_type', 'scale')->first();

        if ($csatQuestion) {
            $rdQuery = ResponseDetail::where('question_id', $csatQuestion->id)
                ->whereHas('response', function($q) use ($filters) {
                    if (!empty($filters['region'])) $q->where('region_id', $filters['region']);
                    if (!empty($filters['segment'])) $q->where('segment_id', $filters['segment']);
                });
            
            $total = (clone $rdQuery)->count();
            if ($total > 0) {
                $satisfied = (clone $rdQuery)->whereRaw('CAST(answer AS DECIMAL) >= 4')->count();
                $csatValue = ($satisfied / $total) * 100;
                $kpis->push((object)['kpi_name' => 'CSAT', 'kpi_value' => $csatValue]);
            }
        }

        // Satisfaction Index
        $avg = ResponseDetail::whereHas('question', function ($query) use ($survey) {
                $query->where('survey_id', $survey->id)->where('question_type', 'scale');
            })
            ->whereHas('response', function($q) use ($filters) {
                if (!empty($filters['region'])) $q->where('region_id', $filters['region']);
                if (!empty($filters['segment'])) $q->where('segment_id', $filters['segment']);
            })
            ->avg(DB::raw('CAST(answer AS DECIMAL)'));
        
        $kpis->push((object)['kpi_name' => 'Satisfaction Index', 'kpi_value' => $avg ?? 0]);

        return $kpis;
    }

    /**
     * Ambil distribusi jawaban untuk grafik.
     */
    protected static function getDistribution(Survey $survey, array $filters)
    {
        $distQuestion = $survey->questions()->where('question_type', 'scale')->first();
        if (!$distQuestion) return collect();

        return ResponseDetail::where('question_id', $distQuestion->id)
            ->whereHas('response', function($q) use ($filters) {
                if (!empty($filters['region'])) $q->where('region_id', $filters['region']);
                if (!empty($filters['segment'])) $q->where('segment_id', $filters['segment']);
            })
            ->select('answer', DB::raw('count(*) as total'))
            ->groupBy('answer')
            ->get();
    }
}
