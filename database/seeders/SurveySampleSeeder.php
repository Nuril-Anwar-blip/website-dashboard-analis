<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveySampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::firstOrCreate([
            'email' => 'admin@survey.com',
        ], [
            'name' => 'Administrator',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        $survey = \App\Models\Survey::create([
            'title' => 'Sample Customer Satisfaction Survey',
            'description' => 'A sample survey to verify system functionality.',
            'user_id' => $admin->id,
        ]);

        $q1 = \App\Models\Question::create([
            'survey_id' => $survey->id,
            'question_text' => 'How likely are you to recommend us?',
            'question_type' => 'scale',
            'order' => 1,
        ]);

        $q2 = \App\Models\Question::create([
            'survey_id' => $survey->id,
            'question_text' => 'Overall satisfaction score?',
            'question_type' => 'scale',
            'order' => 2,
        ]);

        $regionsArr = ['Jakarta', 'Surabaya', 'Bandung'];
        $segmentsArr = ['Retail', 'Corporate', 'Government'];

        foreach (range(1, 20) as $i) {
            $resp = \App\Models\Response::create([
                'survey_id' => $survey->id,
                'region_id' => \App\Models\Region::firstOrCreate(['name' => $regionsArr[array_rand($regionsArr)]])->id,
                'segment_id' => \App\Models\Segment::firstOrCreate(['name' => $segmentsArr[array_rand($segmentsArr)]])->id,
            ]);

            \App\Models\ResponseDetail::create([
                'response_id' => $resp->id,
                'question_id' => $q1->id,
                'answer' => rand(5, 10),
            ]);

            \App\Models\ResponseDetail::create([
                'response_id' => $resp->id,
                'question_id' => $q2->id,
                'answer' => rand(3, 10),
            ]);
        }
    }
}
