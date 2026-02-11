<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $surveyId = $request->query('survey');
        $survey = $surveyId ? Survey::find($surveyId) : Survey::withCount('responses')->orderBy('created_at', 'desc')->first();

        if (!$survey) {
            return redirect()->route('surveys.create')->with('info', 'Harap buat survey terlebih dahulu.');
        }

        $filters = [
            'region' => $request->query('region'),
            'segment' => $request->query('segment'),
        ];

        // AnalyticsService::calculateAll($survey); // Opsional: tetap simpan KPI utama jika perlu
        $data = AnalyticsService::getDashboardData($survey, $filters);
        $surveys = Survey::all();
        $regions = \App\Models\Region::all();
        $segments = \App\Models\Segment::all();

        return view('dashboard', array_merge($data, [
            'surveys' => $surveys,
            'regions' => $regions,
            'segments' => $segments,
            'currentFilters' => $filters
        ]));
    }
}
