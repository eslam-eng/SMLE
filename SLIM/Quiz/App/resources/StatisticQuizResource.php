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
            'quiz_count' =>$this->quizzes()->count(),
            'question_count' =>$this->quizzes()->count(),
            'correct_answer' =>$this->CorrectAnswers ? $this->CorrectAnswers()->count() :0,
            'Incorrect_answer' =>$this->CorrectAnswers ? $this->InCorrectAnswers()->count() :0,
            'result' =>$this->CorrectAnswers ? $this->CorrectAnswers()->count() / $this->quizzes()->count() *100 :0,
        ];



    }

}
