<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use App\Imports\ResponseImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surveys = Survey::withCount('responses')->get();
        return view('surveys.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('surveys.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        $survey->load('questions', 'responses.details');
        return view('surveys.show', compact('survey'));
    }

    /**
     * Import responses from Excel/CSV.
     */
    public function import(Request $request, Survey $survey)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new ResponseImport($survey->id, auth()->id()), $request->file('file'));

        return redirect()->route('surveys.show', $survey)->with('success', 'File telah diunggah dan sedang diproses di latar belakang.');
    }

    /**
     * Export survey analytics to PDF.
     */
    public function export(Request $request, Survey $survey)
    {
        $filters = [
            'region' => $request->query('region'),
            'segment' => $request->query('segment'),
        ];
        $data = AnalyticsService::getDashboardData($survey, $filters);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.survey-insight', $data);
        return $pdf->download('survey-report-'.$survey->id.'.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('surveys.index');
    }
}
