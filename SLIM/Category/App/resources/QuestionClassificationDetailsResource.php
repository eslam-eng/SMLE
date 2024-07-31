<?php

namespace SLIM\Category\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Question\App\Models\Question;

class QuestionClassificationDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'question_classified_id' => $this->id,
            'quiz_title' => $this->title,
            'Question' => $this->question,
            'answers' => [
                ['answer' => 'A', 'name' => $this->answer_a],
                ['answer' => 'B', 'name' => $this->answer_b],
                ['answer' => 'C', 'name' => $this->answer_c],
                ['answer' => 'D', 'name' => $this->answer_d]
            ],
            'user_answer' => $this->user_answer,
            'model_answer' => $this->model_answer,


        ];
    }

    public function getQuestion($quetionId)
    {
        return Question::where('id', $quetionId)->first();

    }

    public function getUserAnswer($quizId, $questionId)
    {

        $answer = \DB::table('quiz_question')->where([
            'quiz_id' => $quizId,
            'question_id' => $questionId
        ])->first();

        return $answer ? $answer->answer : '';

    }

}
