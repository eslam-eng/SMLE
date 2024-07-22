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
            'quiz_title' =>$this->title,
            'quiz_date' =>$this->quiz_date,
            'quiz_level' =>$this->level,
            'quiz_duration' =>$this->time_taken ?? 0,
            'question_count' =>$this->listQuestions()->count(),
            'correct_answer_count' =>$this->CorrectAnswers()->count(),
            'Incorrect_answer_count' =>$this->InCorrectAnswers()->count(),
            'result' =>$this->listQuestions()->count() ? ($this->CorrectAnswers()->count() / $this->listQuestions()->count()) * 100 :0,
            'specialists' =>SpecilizationResource::collection($this->specialist),
            'SubSpecialists' =>subSpecializationResorce::collection($this->Subspecialist),

        ];
    }

}
