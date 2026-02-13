<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Region;
use App\Models\Segment;
use App\Models\Response;
use App\Models\ResponseDetail;
use Illuminate\Support\Facades\Hash;

class SurveySampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Users
        $admin = User::firstOrCreate([
            'email' => 'admin@survey.com',
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $enumerator1 = User::firstOrCreate([
            'email' => 'enumerator1@survey.com',
        ], [
            'name' => 'Budi Santoso',
            'password' => Hash::make('password'),
            'role' => 'enumerator',
        ]);

        $enumerator2 = User::firstOrCreate([
            'email' => 'enumerator2@survey.com',
        ], [
            'name' => 'Siti Nurhaliza',
            'password' => Hash::make('password'),
            'role' => 'enumerator',
        ]);

        // Create Regions
        $regions = [
            'Jakarta',
            'Surabaya',
            'Bandung',
            'Medan',
            'Semarang',
            'Makassar',
            'Yogyakarta',
            'Palembang',
        ];

        foreach ($regions as $regionName) {
            Region::firstOrCreate(['name' => $regionName]);
        }

        // Create Segments
        $segments = [
            'Retail',
            'Corporate',
            'Government',
            'Education',
            'Healthcare',
            'Technology',
        ];

        foreach ($segments as $segmentName) {
            Segment::firstOrCreate(['name' => $segmentName]);
        }

        // Survey 1: Customer Satisfaction
        $survey1 = Survey::create([
            'title' => 'Survei Kepuasan Pelanggan 2026',
            'description' => 'Survei untuk mengukur tingkat kepuasan pelanggan terhadap produk dan layanan kami. Data ini akan digunakan untuk meningkatkan kualitas layanan.',
            'user_id' => $admin->id,
        ]);

        $q1_s1 = Question::create([
            'survey_id' => $survey1->id,
            'question_text' => 'Seberapa besar kemungkinan Anda merekomendasikan produk kami kepada teman atau kolega? (NPS Score)',
            'question_type' => 'scale',
            'order' => 1,
        ]);

        $q2_s1 = Question::create([
            'survey_id' => $survey1->id,
            'question_text' => 'Bagaimana tingkat kepuasan Anda secara keseluruhan?',
            'question_type' => 'scale',
            'order' => 2,
        ]);

        $q3_s1 = Question::create([
            'survey_id' => $survey1->id,
            'question_text' => 'Seberapa mudah produk kami digunakan?',
            'question_type' => 'scale',
            'order' => 3,
        ]);

        $q4_s1 = Question::create([
            'survey_id' => $survey1->id,
            'question_text' => 'Bagaimana kualitas layanan customer service kami?',
            'question_type' => 'scale',
            'order' => 4,
        ]);

        // Survey 2: Employee Engagement
        $survey2 = Survey::create([
            'title' => 'Survei Keterlibatan Karyawan Q1 2026',
            'description' => 'Survei internal untuk mengukur tingkat keterlibatan dan kepuasan karyawan di lingkungan kerja.',
            'user_id' => $admin->id,
        ]);

        $q1_s2 = Question::create([
            'survey_id' => $survey2->id,
            'question_text' => 'Seberapa puas Anda dengan lingkungan kerja saat ini?',
            'question_type' => 'scale',
            'order' => 1,
        ]);

        $q2_s2 = Question::create([
            'survey_id' => $survey2->id,
            'question_text' => 'Bagaimana penilaian Anda terhadap komunikasi internal perusahaan?',
            'question_type' => 'scale',
            'order' => 2,
        ]);

        $q3_s2 = Question::create([
            'survey_id' => $survey2->id,
            'question_text' => 'Seberapa baik manajemen mendengarkan masukan dari karyawan?',
            'question_type' => 'scale',
            'order' => 3,
        ]);

        // Survey 3: Market Research
        $survey3 = Survey::create([
            'title' => 'Riset Pasar Produk Baru',
            'description' => 'Survei untuk memahami kebutuhan dan preferensi pasar terhadap produk baru yang akan diluncurkan.',
            'user_id' => $admin->id,
        ]);

        $q1_s3 = Question::create([
            'survey_id' => $survey3->id,
            'question_text' => 'Seberapa tertarik Anda dengan fitur produk baru ini?',
            'question_type' => 'scale',
            'order' => 1,
        ]);

        $q2_s3 = Question::create([
            'survey_id' => $survey3->id,
            'question_text' => 'Berapa harga yang menurut Anda wajar untuk produk ini?',
            'question_type' => 'scale',
            'order' => 2,
        ]);

        // Generate Responses for Survey 1
        $this->generateResponses($survey1, [$q1_s1, $q2_s1, $q3_s1, $q4_s1], 150, [$admin->id, $enumerator1->id, $enumerator2->id]);

        // Generate Responses for Survey 2
        $this->generateResponses($survey2, [$q1_s2, $q2_s2, $q3_s2], 80, [$admin->id]);

        // Generate Responses for Survey 3
        $this->generateResponses($survey3, [$q1_s3, $q2_s3], 120, [$admin->id, $enumerator1->id]);
    }

    private function generateResponses($survey, $questions, $count, $userIds)
    {
        $regions = Region::all()->pluck('id')->toArray();
        $segments = Segment::all()->pluck('id')->toArray();

        for ($i = 0; $i < $count; $i++) {
            $response = Response::create([
                'survey_id' => $survey->id,
                'region_id' => $regions[array_rand($regions)],
                'segment_id' => $segments[array_rand($segments)],
                'user_id' => $userIds[array_rand($userIds)],
            ]);

            foreach ($questions as $question) {
                // Generate realistic answers based on question type
                $answer = match($question->question_type) {
                    'scale' => rand(1, 10),
                    'multiple_choice' => ['Option A', 'Option B', 'Option C'][array_rand(['Option A', 'Option B', 'Option C'])],
                    default => rand(1, 10),
                };

                ResponseDetail::create([
                    'response_id' => $response->id,
                    'question_id' => $question->id,
                    'answer' => $answer,
                ]);
            }
        }
    }
}
