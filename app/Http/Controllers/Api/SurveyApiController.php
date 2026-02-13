<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Region;
use App\Models\Segment;
use App\Models\Response;
use App\Models\ResponseDetail;
use App\Services\CleaningService;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * =============================================
 * API CONTROLLER (INPUT DATA OTOMATIS)
 * =============================================
 * 
 * Controller ini menyediakan endpoint untuk sistem eksternal
 * agar dapat memasukkan data survey secara otomatis.
 * 
 * Endpoint: POST /api/surveys/{survey}/responses
 * Auth: Menggunakan Laravel Sanctum (Token based)
 */
class SurveyApiController extends Controller
{
    /**
     * Menerima kiriman data respons dari sistem survey eksternal.
     * 
     * Format Request JSON:
     * {
     *   "region": "Jakarta",
     *   "segment": "Enterprise",
     *   "answers": {
     *      "1": "9", // ID Pertanyaan: Jawaban
     *      "2": "Sangat Puas"
     *   }
     * }
     */
    public function storeResponse(Request $request, Survey $survey)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'region' => 'nullable|string|max:255',
            'segment' => 'nullable|string|max:255',
            'answers' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // 2. Cari/Buat Region & Segment
            $region = $request->region ? Region::firstOrCreate(['name' => $request->region]) : null;
            $segment = $request->segment ? Segment::firstOrCreate(['name' => $request->segment]) : null;

            // 3. Simpan Response Utama
            $response = Response::create([
                'survey_id' => $survey->id,
                'region_id' => $region?->id,
                'segment_id' => $segment?->id,
                'user_id' => $survey->user_id, // Default ke pemilik survey
            ]);

            // 4. Simpan Detail Jawaban
            foreach ($request->answers as $questionId => $answer) {
                ResponseDetail::create([
                    'response_id' => $response->id,
                    'question_id' => $questionId,
                    'answer' => (string) $answer
                ]);
            }

            // 5. Jalankan Pembersihan Data & Trigger Rekalkulasi
            CleaningService::cleanSingleResponse($response);
            AnalyticsService::calculateAll($survey);

            return response()->json([
                'status' => 'success',
                'message' => 'Data respons berhasil diterima dan diproses otomatis.',
                'data' => [
                    'response_id' => $response->id,
                    'survey_title' => $survey->title
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan internal: ' . $e->getMessage()
            ], 500);
        }
    }
}
