<?php

namespace SLIM\Question\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Quiz\App\Models\Quiz;

class QuestionSuggestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array {
        return [
            'question_suggest_id' => $this->pivot ? $this->pivot->id : '',
            'question_id'         => $this->id,
            'quiz_id'             => $this->pivot->quiz_id,
            'question'            => $this->question,
            'quiz_title'          => $this->pivot->quiz_id ? Quiz::where('id', $this->pivot->quiz_id)->first()?->title : '',
            'suggest'             => $this->pivot->suggest,
            'answer'              => $this->pivot->answer
        ];
    }
}
