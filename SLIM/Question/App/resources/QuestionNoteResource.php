<?php

namespace SLIM\Question\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionNoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'question_note_id' => $this->id,
            'question_id' => $this->question_id,
            'quiz_id' => $this->quiz_id,
            'question' => $this->question->question,
            'quiz_title' => $this->quiz?->title,
            'note' => $this->note,
            'user_answer' => $this->getUserAnswer($this->quiz_id, $this->question_id)?->user_answer,
            'answers' => array(
                ['answer' => 'A', 'name' => $this->question->answer_a],
                ['answer' => 'B', 'name' => $this->question->answer_b],
                ['answer' => 'C', 'name' => $this->question->answer_c],
                ['answer' => 'D', 'name' => $this->question->answer_d]
            ),
            'model_answer' => $this->question->model_answer,
        ];
    }

    public function getUserAnswer($quizId, $questionId)
    {

        return \DB::table('quiz_question')->where([
            'quiz_id' => $quizId,
            'question_id' => $questionId
        ])->first();

    }
}
