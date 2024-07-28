<?php

namespace SLIM\Quiz\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Specialization\App\resources\SpecilizationResource;
use SLIM\Subspecialties\App\resources\subSpecializationResorce;

class QuizAnalysisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'quiz_title' => $this->title,
            'quiz_date' => $this->quiz_date,
            'quiz_level' => $this->level,
            'quiz_duration' => $this->time_taken ?? 0,
            'question_count' => $this->list_questions_count,
            'correct_answer_count' => $this->correct_answers_count,
            'incorrect_answer_count' => $this->incorrect_answers_count,
            'answers_count' => $this->correct_answers_count + $this->incorrect_answers_count,
            'unanswered_count' => $this->unanswered_count,
            'result' => $this->list_questions_count ? ($this->correct_answers_count / $this->list_questions_count) * 100 : 0,
            'specialists' => SpecilizationResource::collection($this->specialist),
            'SubSpecialists' => subSpecializationResorce::collection($this->Subspecialist),

        ];
    }

}
