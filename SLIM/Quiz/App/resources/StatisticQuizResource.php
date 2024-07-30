<?php

namespace SLIM\Quiz\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticQuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'quiz_count' => $this->quizzes_count,
            'question_count' => $this->list_questions_count,
            'correct_answer' => $this->correct_answers_count,
            'incorrect_answer' => $this->incorrect_answers_count,
            'result' => $this->list_questions_count > 0 ? ($this->correct_answers_count / $this->list_questions_count) * 100 : 0,
        ];


    }

}
