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
            'question_classified_id' =>  $this->id,
            'Question' =>$this->getQuestion($this->question_id)->question,
            'answers'=>array(
                ['answer'=>'A','name'=> $this->getQuestion($this->question_id)->answer_a],
                ['answer'=>'B','name'=> $this->getQuestion($this->question_id)->answer_b],
                ['answer'=>'C','name'=> $this->getQuestion($this->question_id)->answer_c],
                ['answer'=>'D','name'=> $this->getQuestion($this->question_id)->answer_d]
            ),
            'user_answer' =>$this->getUserAnswer($this->quiz_id, $this->question_id),
            'model_answer' =>$this->getQuestion($this->question_id)->model_answer,



        ];
    }

    public function getQuestion($quetionId)
    {
        return Question::where('id',$quetionId)->first();

    }

    public function getUserAnswer($quizId, $questionId){

        $answer= \DB::table('quiz_question')->where([
            'quiz_id'=>$quizId,
            'question_id' =>$questionId
        ])->first() ;

        return $answer ? $answer->answer :'';

    }

}
