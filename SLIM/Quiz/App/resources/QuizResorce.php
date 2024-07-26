<?php

namespace SLIM\Quiz\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Specialization\App\resources\SpecilizationResource;
use SLIM\Subspecialties\App\resources\subSpecializationResorce;

class QuizResorce extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' =>$this->id,
            'title' =>$this->title,
            'question_no' =>$this->question_no,
            'level' =>$this->level,
            'quiz_date' =>$this->quiz_date,
          //  'quiz_time' =>$this->quiz_time,
            'question_stop_watch' =>$this->question_stop_watch,
            'question_time' =>$this->question_time,
            'auto_correction' =>$this->auto_correction,
            'number_attempt_allowed' =>$this->number_attempt_allowed,
            'trainee_id' =>$this->trainee_id,
            'question_count' =>$this->listQuestions()->count(),
            'correct_answer_count' =>$this->correctAnswers()->count(),
            'Incorrect_answer_count' =>$this->inCorrectAnswers()->count(),
            'specialists' =>SpecilizationResource::collection($this->specialist),
            'SubSpecialists' =>subSpecializationResorce::collection($this->Subspecialist),
            'taken_time' =>$this->time_taken ?? 0,
            'quiz_duration' =>$this->time_taken ?? 0,
            'is_complete' =>$this->is_complete,
            'result' =>$this->listQuestions()->count() ? ($this->CorrectAnswers()->count() / $this->listQuestions()->count()) * 100 :0,
     //       'question'=>QuestionQuizResource::collection($this->listQuestions),
        ];
    }

}
