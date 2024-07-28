<?php

namespace SLIM\Quiz\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Abbreviation\App\resources\AbbreviationResource;

class QuestionQuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'description' => $this->description,
            'model_answer' => $this->model_answer,
            'user_answer' => $this->pivot ? $this->pivot->answer : '',
            'image' => url($this->image),
            'abbreviations' => AbbreviationResource::collection($this->abbreviations),
            'answers' => array(
                ['answer' => 'A', 'name' => $this->answer_a],
                ['answer' => 'B', 'name' => $this->answer_b],
                ['answer' => 'C', 'name' => $this->answer_c],
                ['answer' => 'D', 'name' => $this->answer_d]
            ),

        ];
    }

}
