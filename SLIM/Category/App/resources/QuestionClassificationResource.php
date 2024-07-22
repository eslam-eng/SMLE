<?php

namespace SLIM\Category\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Quiz\App\Models\Quiz;

class QuestionClassificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'question_classified_id' =>  $this->pivot->id,
            'classified_id' =>           $this->pivot->category_id,
            'question_id' =>             $this->id,
            'quiz_id' =>                 $this->pivot->quiz_id,
            'question' =>                $this->question,
            'quiz_title' =>$this->pivot->quiz_id ? Quiz::where('id',$this->pivot->quiz_id)->first()?->title:'',
        ];
    }
}
