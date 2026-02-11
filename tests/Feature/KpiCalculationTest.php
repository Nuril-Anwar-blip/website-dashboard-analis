<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\Response;
use App\Models\ResponseDetail;
use App\Models\Survey;
use App\Models\User;
use App\Services\AnalyticsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KpiCalculationTest extends TestCase
{
    use RefreshDatabase;

    public function test_nps_calculation_is_correct()
    {
        $user = User::factory()->create();
        $survey = Survey::create(['title' => 'Test NPS', 'user_id' => $user->id]);
        $question = Question::create([
            'survey_id' => $survey->id,
            'question_text' => 'Would you recommend us?',
            'question_type' => 'scale',
            'order' => 1
        ]);

        // 1 Promoter (10), 1 Detractor (6), 1 Passive (8)
        // NPS = (1-1)/3 * 100 = 0
        $this->createResponseWithDetail($survey, $question, 10);
        $this->createResponseWithDetail($survey, $question, 6);
        $this->createResponseWithDetail($survey, $question, 8);

        $data = AnalyticsService::getDashboardData($survey);
        $nps = collect($data['kpis'])->where('kpi_name', 'NPS')->first();

        $this->assertEquals(0, $nps->kpi_value);
    }

    public function test_satisfaction_index_calculation_is_correct()
    {
        $user = User::factory()->create();
        $survey = Survey::create(['title' => 'Test Satisf', 'user_id' => $user->id]);
        $question = Question::create([
            'survey_id' => $survey->id,
            'question_text' => 'Satisfaction Score',
            'question_type' => 'scale',
            'order' => 1
        ]);

        // Scores: 10, 5, 0 -> Avg = 5
        $this->createResponseWithDetail($survey, $question, 10);
        $this->createResponseWithDetail($survey, $question, 5);
        $this->createResponseWithDetail($survey, $question, 0);

        $data = AnalyticsService::getDashboardData($survey);
        $satisfaction = collect($data['kpis'])->where('kpi_name', 'Satisfaction Index')->first();

        $this->assertEquals(5, $satisfaction->kpi_value);
    }

    protected function createResponseWithDetail($survey, $question, $answer)
    {
        $response = Response::create([
            'survey_id' => $survey->id,
            'region_id' => \App\Models\Region::firstOrCreate(['name' => 'Test'])->id,
            'segment_id' => \App\Models\Segment::firstOrCreate(['name' => 'Test'])->id,
        ]);

        ResponseDetail::create([
            'response_id' => $response->id,
            'question_id' => $question->id,
            'answer' => $answer
        ]);
    }
}
