<?php

namespace App\Imports;

use App\Models\Response;
use App\Models\ResponseDetail;
use App\Models\Region;
use App\Models\Segment;
use App\Models\Question;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ResponseImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading
{
    protected $surveyId;
    protected $userId;
    protected $questions;

    public function __construct($surveyId, $userId)
    {
        $this->surveyId = $surveyId;
        $this->userId = $userId;
        $this->questions = Question::where('survey_id', $this->surveyId)->get();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $regionName = $row['region'] ?? 'Unknown';
        $segmentName = $row['segment'] ?? 'General';

        $region = Region::firstOrCreate(['name' => $regionName]);
        $segment = Segment::firstOrCreate(['name' => $segmentName]);

        $response = Response::create([
            'survey_id' => $this->surveyId,
            'region_id' => $region->id,
            'segment_id' => $segment->id,
            'user_id' => $this->userId,
        ]);

        foreach ($this->questions as $question) {
            // Assume headers are question texts normalized (lowercase, underscores)
            $header = str_replace(' ', '_', strtolower($question->question_text));
            $answer = $row[$header] ?? $row[str_replace('?', '', $header)] ?? null;

            if ($answer !== null) {
                ResponseDetail::create([
                    'response_id' => $response->id,
                    'question_id' => $question->id,
                    'answer' => $answer,
                ]);
            }
        }

        return $response;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
