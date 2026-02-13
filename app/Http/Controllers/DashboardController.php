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

        $filters = [
            'region' => $request->query('region'),
            'segment' => $request->query('segment'),
        ];

        // Jika ada survey, ambil data analytics
        if ($survey) {
        $data = AnalyticsService::getDashboardData($survey, $filters);
        } else {
            // Fallback jika belum ada survey
            $data = [
                'survey' => null,
                'kpis' => collect([
                    (object)['kpi_name' => 'Total Revenue', 'kpi_value' => 99560],
                    (object)['kpi_name' => 'Total Respondents', 'kpi_value' => 35],
                    (object)['kpi_name' => 'NPS', 'kpi_value' => 0],
                    (object)['kpi_name' => 'Satisfaction Index', 'kpi_value' => 0],
                ]),
                'distribution' => collect([]),
            ];
        }

        $surveys = Survey::all();
        $regions = \App\Models\Region::all();
        $segments = \App\Models\Segment::all();

        return view('dashboard', array_merge($data, [
            'survey' => $survey,
            'surveys' => $surveys,
            'regions' => $regions,
            'segments' => $segments,
            'currentFilters' => $filters
        ]));
    }
}
