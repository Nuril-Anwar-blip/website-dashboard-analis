<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use App\Models\Response;
use App\Models\ResponseDetail;
use App\Models\Region;
use App\Models\Segment;
use App\Imports\ResponseImport;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * =============================================
 * SURVEY CONTROLLER
 * =============================================
 * 
 * Controller ini menangani semua operasi terkait survey:
 * - Menampilkan daftar survey
 * - Membuat survey baru
 * - Menampilkan detail survey
 * - Import data dari file Excel/CSV
 * - Input data manual
 * - Export hasil analisis ke PDF
 * - Menghapus survey
 * 
 * Dokumentasi lengkap untuk setiap method ada di bawah.
 */
class SurveyController extends Controller
{
    /**
     * Menampilkan daftar semua survey yang dimiliki user
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $surveys = Survey::withCount('responses')->get();
        return view('surveys.index', compact('surveys'));
    }

    /**
     * Menampilkan form untuk membuat survey baru
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('surveys.create');
    }

    /**
     * Menyimpan survey baru ke database
     * 
     * Validasi:
     * - Title wajib diisi
     * - Description opsional
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $survey = Survey::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('surveys.show', $survey);
    }

    /**
     * Menampilkan detail survey beserta pertanyaan dan respons
     * 
     * Data yang dimuat:
     * - Informasi survey (title, description)
     * - Daftar pertanyaan
     * - Daftar respons dan detail jawaban
     * 
     * @param Survey $survey
     * @return \Illuminate\View\View
     */
    public function show(Survey $survey)
    {
        $survey->load('questions', 'responses.details');
        return view('surveys.show', compact('survey'));
    }

    /**
     * =============================================
     * IMPORT DATA DARI FILE EXCEL/CSV
     * =============================================
     * 
     * Proses Import:
     * 1. Validasi file (format: .xlsx, .xls, .csv, max 10MB)
     * 2. Cek apakah survey memiliki pertanyaan
     * 3. Proses file menggunakan ResponseImport class
     * 4. File dibaca baris per baris (chunking untuk performa)
     * 5. Setiap baris diproses:
     *    - Membuat/mencari Region dan Segment
     *    - Membuat Response baru
     *    - Mencocokkan kolom dengan pertanyaan survey
     *    - Menyimpan jawaban ke ResponseDetail
     * 6. Menghitung jumlah data yang berhasil diimport
     * 7. Menampilkan pesan sukses/error
     * 
     * Setelah Import Berhasil:
     * - Data tersimpan di database (tabel responses dan response_details)
     * - Statistik survey otomatis terupdate
     * - User dapat langsung melihat hasil di dashboard
     * - Data siap untuk dianalisis dan diekspor ke PDF
     * 
     * @param Request $request
     * @param Survey $survey
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request, Survey $survey)
    {
        try {
            // Validasi file
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv|max:10240', // Max 10MB
            ]);

            // Pastikan survey punya pertanyaan
            if ($survey->questions->count() === 0) {
                return redirect()->route('surveys.show', $survey)
                    ->with('error', 'Survey belum memiliki pertanyaan. Silakan tambahkan pertanyaan terlebih dahulu.');
            }

            // Inisialisasi import class
            $import = new ResponseImport($survey->id, auth()->id());
            
            // Proses import file (membaca dan menyimpan data ke database)
            Excel::import($import, $request->file('file'));

            // Jalankan pembersihan data dan hitung ulang semua KPI
            AnalyticsService::calculateAll($survey);

            // Ambil hasil import
            $importedCount = $import->getImportedCount();
            $errors = $import->getErrors();

            // Hitung total respons setelah import
            $totalResponses = $survey->fresh()->responses()->count();

            // Buat pesan sukses dengan detail
            $message = "✅ File berhasil diunggah dan diproses!\n\n";
            $message .= "📊 Data yang diimport: {$importedCount} respons baru\n";
            $message .= "📈 Total respons survey sekarang: {$totalResponses} respons\n\n";
            
            if (count($errors) > 0) {
                $message .= "⚠️ Terdapat " . count($errors) . " error selama proses import.\n";
                $message .= "Silakan periksa data Anda dan coba lagi untuk baris yang error.";
            } else {
                $message .= "✨ Semua data berhasil diimport tanpa error!\n\n";
                $message .= "💡 Langkah selanjutnya:\n";
                $message .= "• Klik 'Lihat Dashboard' untuk melihat analisis data\n";
                $message .= "• Atau klik 'Export PDF' untuk mengunduh laporan";
            }

            return redirect()->route('surveys.show', $survey)
                ->with('success', $message)
                ->with('imported_count', $importedCount)
                ->with('total_responses', $totalResponses);
                
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Error validasi dari Excel
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
            }
            return redirect()->route('surveys.show', $survey)
                ->with('error', '❌ Validasi gagal: ' . implode(' | ', $errorMessages));
        } catch (\Exception $e) {
            // Error umum
            \Log::error('Import error: ' . $e->getMessage());
            return redirect()->route('surveys.show', $survey)
                ->with('error', '❌ Gagal mengimport file: ' . $e->getMessage() . "\n\nPastikan:\n• Format file sesuai (.xlsx, .xls, atau .csv)\n• File memiliki header yang benar\n• Kolom jawaban sesuai dengan pertanyaan survey");
        }
    }

    /**
     * =============================================
     * INPUT DATA MANUAL
     * =============================================
     * 
     * Menyimpan data respons survey yang diinput manual oleh user.
     * 
     * Proses:
     * 1. Validasi input (region dan segment opsional)
     * 2. Membuat/mencari Region dan Segment jika ada
     * 3. Membuat Response baru
     * 4. Menyimpan jawaban untuk setiap pertanyaan
     * 5. Redirect dengan pesan sukses
     * 
     * @param Request $request
     * @param Survey $survey
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeResponse(Request $request, Survey $survey)
    {
        try {
            $request->validate([
                'region' => 'nullable|string|max:255',
                'segment' => 'nullable|string|max:255',
            ]);

            $region = null;
            $segment = null;

            // Buat atau cari region jika ada
            if ($request->region) {
                $region = Region::firstOrCreate(['name' => $request->region]);
            }
            
            // Buat atau cari segment jika ada
            if ($request->segment) {
                $segment = Segment::firstOrCreate(['name' => $request->segment]);
            }

            // Buat respons baru
            $response = Response::create([
                'survey_id' => $survey->id,
                'region_id' => $region?->id,
                'segment_id' => $segment?->id,
                'user_id' => auth()->id(),
            ]);

            // Simpan jawaban untuk setiap pertanyaan
            foreach ($survey->questions as $question) {
                $answerKey = 'question_' . $question->id;
                if ($request->has($answerKey) && $request->$answerKey !== null) {
                    ResponseDetail::create([
                        'response_id' => $response->id,
                        'question_id' => $question->id,
                        'answer' => $request->$answerKey,
                    ]);
                }
            }

            $totalResponses = $survey->fresh()->responses()->count();

            return redirect()->route('surveys.show', $survey)
                ->with('success', "✅ Data respons berhasil ditambahkan!\n\n📊 Total respons survey sekarang: {$totalResponses} respons");
        } catch (\Exception $e) {
            return redirect()->route('surveys.show', $survey)
                ->with('error', '❌ Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * =============================================
     * EXPORT HASIL ANALISIS KE PDF
     * =============================================
     * 
     * Menghasilkan file PDF berisi:
     * - KPI (Key Performance Indicators)
     * - Distribusi jawaban
     * - Statistik survey
     * 
     * Proses:
     * 1. Ambil data analisis dari AnalyticsService
     * 2. Generate PDF menggunakan DomPDF
     * 3. Download file PDF
     * 
     * @param Request $request
     * @param Survey $survey
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function export(Request $request, Survey $survey)
    {
        try {
            $filters = [
                'region' => $request->query('region'),
                'segment' => $request->query('segment'),
            ];
            
            // Ambil data analisis
            $data = AnalyticsService::getDashboardData($survey, $filters);
            $data['survey'] = $survey;
            
            // Generate PDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.survey-insight', $data);
            
            // Nama file dengan timestamp
            $filename = 'survey-report-' . $survey->id . '-' . now()->format('Y-m-d') . '.pdf';
            
            // Download PDF
            return $pdf->download($filename);
        } catch (\Exception $e) {
            return redirect()->route('surveys.show', $survey)
                ->with('error', '❌ Gagal membuat PDF: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus survey beserta semua data terkait
     * 
     * @param Survey $survey
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('surveys.index');
    }
}
