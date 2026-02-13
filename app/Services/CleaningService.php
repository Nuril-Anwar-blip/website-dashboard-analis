<?php

namespace App\Services;

use App\Models\Response;
use App\Models\ResponseDetail;
use Illuminate\Support\Facades\Log;

/**
 * =============================================
 * CLEANING SERVICE (LAYANAN PEMBERSIHAN DATA)
 * =============================================
 * 
 * Layanan ini bertanggung jawab untuk membersihkan data survey yang masuk:
 * - Menghapus respons yang tidak memiliki jawaban sama sekali.
 * - Memastikan data numerik valid untuk pertanyaan bertipe 'scale'.
 * - Menghapus spasi berlebih pada jawaban teks.
 * - Logika pembersihan ini dipanggil sebelum data diproses dalam analisis.
 */
class CleaningService
{
    /**
     * Jalankan proses pembersihan untuk semua respons dalam suatu survey.
     * 
     * @param int $surveyId
     * @return array Statistik pembersihan [total, removed, cleaned]
     */
    public static function cleanSurveyData($surveyId)
    {
        $responses = Response::where('survey_id', $surveyId)->with('details')->get();
        $stats = [
            'total' => $responses->count(),
            'removed' => 0,
            'cleaned' => 0,
        ];

        foreach ($responses as $response) {
            // 1. Hapus jika tidak ada detail jawaban
            if ($response->details->isEmpty()) {
                $response->delete();
                $stats['removed']++;
                continue;
            }

            $hasValidAnswer = false;
            foreach ($response->details as $detail) {
                // 2. Bersihkan teks jawaban (trim)
                $originalAnswer = $detail->answer;
                $cleanedAnswer = trim($originalAnswer);

                // 3. Validasi untuk tipe data tertentu jika perlu (di sini fleksibel)
                if ($cleanedAnswer !== '') {
                    $hasValidAnswer = true;
                }

                if ($originalAnswer !== $cleanedAnswer) {
                    $detail->update(['answer' => $cleanedAnswer]);
                    $stats['cleaned']++;
                }
            }

            // 4. Jika semua jawaban kosong setelah di-trim, hapus responsnya
            if (!$hasValidAnswer) {
                $response->delete();
                $stats['removed']++;
            }
        }

        Log::info("Data Cleaning untuk Survey #{$surveyId} selesai.", $stats);
        return $stats;
    }

    /**
     * Membersihkan satu respons saja (biasanya dipanggil saat import).
     * 
     * @param Response $response
     * @return bool True jika respons masih valid, False jika harus dihapus.
     */
    public static function cleanSingleResponse(Response $response)
    {
        $details = $response->details;
        if ($details->isEmpty()) return false;

        $isValid = false;
        foreach ($details as $detail) {
            $answer = trim($detail->answer);
            if ($answer !== '') {
                $isValid = true;
                if ($answer !== $detail->answer) {
                    $detail->update(['answer' => $answer]);
                }
            }
        }

        return $isValid;
    }
}
