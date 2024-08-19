<?php

namespace SLIM\Quiz\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Specialization\App\resources\SpecilizationResource;
use SLIM\Subspecialties\App\resources\subSpecializationResorce;

class QuizResourceDetails extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'question_no' => $this->question_no,
            'level' => $this->level,
            'quiz_duration'=>$this->time_taken,
            'quiz_date' => $this->quiz_date,
            'question_stop_watch' => $this->question_stop_watch,
            'question_time' => $this->question_time,
            'auto_correction' => $this->auto_correction,
            'number_attempt_allowed' => $this->number_attempt_allowed,
            'trainee_id' => $this->trainee_id,
            'question_count' => $this->list_questions_count,
            'correct_answer_count' => $this->correct_answers_count,
            'Incorrect_answer_count' => $this->incorrect_answers_count,
            'specialists' => SpecilizationResource::collection($this->specialist),
            'SubSpecialists' => subSpecializationResorce::collection($this->Subspecialist),
            'quiz_time' => (bool)$this->quiz_time,
            'is_complete' =>(bool) $this->is_complete,
            'result' => $this->list_questions_count ? ($this->correct_answers_count / $this->list_questions_count) * 100 : 0,
            'question' => QuestionQuizResource::collection($this->whenLoaded('listQuestions')),
        ];
    }

}
