<?php

namespace App\Imports;

use App\Models\Response;
use App\Models\ResponseDetail;
use App\Models\Region;
use App\Models\Segment;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

/**
 * =============================================
 * RESPONSE IMPORT CLASS
 * =============================================
 * 
 * Class ini menangani proses import data survey dari file Excel/CSV.
 * 
 * ALUR PROSES IMPORT:
 * ===================
 * 
 * 1. FILE DIBACA
 *    - File Excel/CSV dibaca baris per baris
 *    - Baris pertama dianggap sebagai header (nama kolom)
 *    - Setiap baris berikutnya adalah data respons
 * 
 * 2. PROSES SETIAP BARIS (method model()):
 *    a. Ambil Region dan Segment dari kolom file
 *       - Mencari di kolom: region, Region, REGION, wilayah, Wilayah
 *       - Jika tidak ada, default: "Unknown"
 *       - Membuat Region baru jika belum ada di database
 * 
 *    b. Ambil Segment dari kolom file
 *       - Mencari di kolom: segment, Segment, SEGMENT, segmen, Segmen
 *       - Jika tidak ada, default: "General"
 *       - Membuat Segment baru jika belum ada di database
 * 
 *    c. Buat Response baru
 *       - Menyimpan survey_id, region_id, segment_id, user_id
 * 
 *    d. Proses setiap pertanyaan survey:
 *       - Mencari jawaban di kolom file dengan berbagai variasi:
 *         * Teks pertanyaan lengkap (lowercase, dengan/tanpa underscore)
 *         * Format Q1, Q2, Q3 (berdasarkan ID pertanyaan)
 *         * Format "Question 1", "Question 2" (berdasarkan urutan)
 *       - Jika ditemukan, simpan ke ResponseDetail
 * 
 * 3. CHUNKING (untuk performa):
 *    - File diproses per 100 baris untuk menghindari memory overflow
 *    - Cocok untuk file besar dengan ribuan baris
 * 
 * 4. HASIL:
 *    - Data tersimpan di tabel: responses, response_details
 *    - Region dan Segment otomatis dibuat jika belum ada
 *    - Counter importedCount bertambah untuk setiap baris sukses
 *    - Error disimpan di array errors jika ada masalah
 * 
 * FORMAT FILE YANG DIDUKUNG:
 * ===========================
 * 
 * Header (Baris 1):
 * - region / Region / REGION / wilayah / Wilayah (opsional)
 * - segment / Segment / SEGMENT / segmen / Segmen (opsional)
 * - Kolom jawaban: bisa menggunakan:
 *   * Teks pertanyaan lengkap: "How likely are you to recommend us?"
 *   * Format dengan underscore: "how_likely_are_you_to_recommend_us"
 *   * Format Q1, Q2, Q3: "Q1", "Q2", dll
 *   * Format Question 1: "Question 1", "Question 2", dll
 * 
 * Data (Baris 2+):
 * - Setiap baris = 1 respons
 * - Isi sesuai dengan header
 * 
 * CONTOH FORMAT FILE:
 * ===================
 * 
 * region | segment | How likely are you to recommend us? | Overall satisfaction score?
 * -------|---------|-------------------------------------|----------------------------
 * Jakarta | General | 9 | 8
 * Bandung | Premium | 10 | 9
 * 
 * ATAU:
 * 
 * Region | Segment | Q1 | Q2
 * -------|---------|----|----
 * Jakarta | General | 9 | 8
 */
class ResponseImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    protected $surveyId;
    protected $userId;
    protected $questions;
    protected $importedCount = 0;
    protected $errors = [];

    /**
     * Constructor: Inisialisasi import dengan survey ID dan user ID
     * 
     * @param int $surveyId ID survey yang akan diimport datanya
     * @param int $userId ID user yang melakukan import
     */
    public function __construct($surveyId, $userId)
    {
        $this->surveyId = $surveyId;
        $this->userId = $userId;
        // Ambil semua pertanyaan dari survey ini
        $this->questions = Question::where('survey_id', $this->surveyId)->get();
    }

    /**
     * Normalize header untuk matching yang lebih fleksibel
     * 
     * Fungsi:
     * - Mengubah header menjadi lowercase
     * - Menghapus karakter khusus
     * - Mengganti spasi dengan underscore
     * 
     * Contoh:
     * "How likely are you?" -> "how_likely_are_you"
     * "Region" -> "region"
     * 
     * @param string $header Nama kolom dari file
     * @return string Header yang sudah dinormalisasi
     */
    private function normalizeHeader($header)
    {
        // Hapus karakter khusus, lowercase, ganti spasi dengan underscore
        $normalized = strtolower(trim($header));
        $normalized = preg_replace('/[^a-z0-9\s_]/', '', $normalized);
        $normalized = preg_replace('/\s+/', '_', $normalized);
        return $normalized;
    }

    /**
     * Mencari nilai jawaban di row dengan berbagai variasi header
     * 
     * Mencoba berbagai format header untuk menemukan jawaban:
     * - Teks pertanyaan lengkap
     * - Teks dengan underscore
     * - Tanpa tanda tanya
     * - Format slug
     * - Format Q1, Q2, dll
    *
     * @param array $row Data baris dari file Excel/CSV
     * @param Question $question Objek pertanyaan yang dicari jawabannya
     * @return mixed Nilai jawaban atau null jika tidak ditemukan
     */
    private function findAnswer($row, $question)
    {
        // Variasi header yang mungkin
        $variations = [
            // Exact match dengan question text
            strtolower($question->question_text),
            // Dengan underscore
            str_replace(' ', '_', strtolower($question->question_text)),
            // Tanpa tanda tanya
            str_replace('?', '', str_replace(' ', '_', strtolower($question->question_text))),
            // Hanya beberapa kata pertama
            Str::slug($question->question_text, '_'),
            // Nomor pertanyaan
            'question_' . $question->id,
            'q' . $question->id,
        ];

        // Coba semua variasi
        foreach ($variations as $variation) {
            // Normalize semua key di row
            foreach ($row as $key => $value) {
                $normalizedKey = $this->normalizeHeader($key);
                if ($normalizedKey === $variation || 
                    $normalizedKey === str_replace('_', '', $variation) ||
                    str_contains($normalizedKey, $variation) ||
                    str_contains($variation, $normalizedKey)) {
                    return $value;
                }
            }
        }

        return null;
    }

    /**
     * =============================================
     * METHOD UTAMA: PROSES SETIAP BARIS DATA
     * =============================================
     * 
     * Method ini dipanggil untuk setiap baris data di file Excel/CSV.
     * 
     * PROSES:
     * 1. Ambil Region dan Segment dari kolom file
     * 2. Buat atau cari Region dan Segment di database
     * 3. Buat Response baru
     * 4. Untuk setiap pertanyaan, cari jawaban dan simpan
     * 5. Increment counter jika sukses
     * 
     * @param array $row Data satu baris dari file (key = nama kolom, value = isi)
     * @return \Illuminate\Database\Eloquent\Model|null Response yang dibuat atau null jika error
    */
    public function model(array $row)
    {
        try {
            // ============================================
            // 1. AMBIL REGION DAN SEGMENT
            // ============================================
            // Cari di berbagai variasi nama kolom
            $regionName = $row['region'] ?? 
                         $row['Region'] ?? 
                         $row['REGION'] ?? 
                         $row['wilayah'] ?? 
                         $row['Wilayah'] ??
                         'Unknown';
            
            $segmentName = $row['segment'] ?? 
                          $row['Segment'] ?? 
                          $row['SEGMENT'] ?? 
                          $row['segmen'] ?? 
                          $row['Segmen'] ??
                          'General';

            // Normalize (hapus spasi di awal/akhir)
            $regionName = trim($regionName) ?: 'Unknown';
            $segmentName = trim($segmentName) ?: 'General';

            // ============================================
            // 2. BUAT ATAU CARI REGION DAN SEGMENT
            // ============================================
            // firstOrCreate: jika belum ada, buat baru; jika sudah ada, ambil yang lama
        $region = Region::firstOrCreate(['name' => $regionName]);
        $segment = Segment::firstOrCreate(['name' => $segmentName]);

            // ============================================
            // 3. BUAT RESPONSE BARU
            // ============================================
        $response = Response::create([
            'survey_id' => $this->surveyId,
            'region_id' => $region->id,
            'segment_id' => $segment->id,
            'user_id' => $this->userId,
        ]);

            // ============================================
            // 4. PROSES SETIAP PERTANYAAN
            // ============================================
        foreach ($this->questions as $question) {
                // Cari jawaban dengan berbagai variasi format
                $answer = $this->findAnswer($row, $question);

                // Jika tidak ditemukan, coba dengan format Q1, Q2, dll (berdasarkan ID)
                if ($answer === null) {
                    $colIndex = 'Q' . ($question->id);
                    $answer = $row[$colIndex] ?? $row[strtolower($colIndex)] ?? null;
                }

                // Jika masih null, coba dengan format "Question 1", "Question 2" (berdasarkan urutan)
                if ($answer === null) {
                    $questionIndex = array_search($question, $this->questions->all()) + 1;
                    $colIndex = 'Question ' . $questionIndex;
                    $answer = $row[$colIndex] ?? $row[strtolower($colIndex)] ?? null;
                }

                // Simpan jawaban jika ada dan tidak kosong
                if ($answer !== null && $answer !== '') {
                ResponseDetail::create([
                    'response_id' => $response->id,
                    'question_id' => $question->id,
                        'answer' => (string) $answer,
                ]);
            }
        }

            // ============================================
            // 5. INCREMENT COUNTER
            // ============================================
            $this->importedCount++;
        return $response;
            
        } catch (\Exception $e) {
            // Jika ada error, simpan ke array errors dan return null
            $this->errors[] = 'Error pada baris: ' . $e->getMessage();
            return null;
        }
    }

    /**
     * Ukuran chunk untuk proses import (jumlah baris per batch)
     * 
     * Semakin besar chunk, semakin cepat tapi membutuhkan lebih banyak memory.
     * Default: 100 baris per batch (cocok untuk sebagian besar kasus)
     * 
     * @return int Jumlah baris per batch
     */
    public function chunkSize(): int
    {
        return 100;
    }

    /**
     * Rules validasi untuk import (kosong karena validasi dilakukan manual)
     * 
     * @return array Array kosong (validasi dilakukan di method model())
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Getter: Ambil jumlah data yang berhasil diimport
     * 
     * @return int Jumlah respons yang berhasil diimport
     */
    public function getImportedCount()
    {
        return $this->importedCount;
    }

    /**
     * Getter: Ambil daftar error yang terjadi selama import
     * 
     * @return array Array berisi pesan error
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
