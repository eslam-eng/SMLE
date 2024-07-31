<?php

namespace SLIM\Quiz\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'quiz_date' => $this->quiz_date,
            'is_complete' => (bool)$this->is_complete,
            'level' => $this->level,
            'questions_count' => $this->list_questions_count,
            'correct_answers_count' => $this->correct_answers_count,
            'result' => $this->list_questions_count ? ($this->correct_answers_count / $this->list_questions_count) * 100 : 0,
        ];
    }

}
