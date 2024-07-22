<?php

namespace SLIM\Question\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Quiz\App\Models\Quiz;
use function Nette\Utils\first;

class QuestionNoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array {
        return [
            'question_note_id' => $this->pivot ? $this->pivot->id :'',
            'question_id' =>$this->id,
            'quiz_id' =>$this->pivot->quiz_id,
            'question' =>$this->question,
            'quiz_title' =>$this->pivot->quiz_id ? Quiz::where('id',$this->pivot->quiz_id)->first()?->title:'',
        'user_answer' =>$this->getUserAnswer($this->pivot->quiz_id, $this->id),
            'note' =>$this->pivot->note,
           'answers'=>array(
             ['answer'=>'A','name'=>$this->answer_a],
             ['answer'=>'B','name'=>$this->answer_b],
             ['answer'=>'C','name'=>$this->answer_c],
             ['answer'=>'D','name'=>$this->answer_d]
        ),
        'model_answer' =>$this->model_answer,
        ];
    }

    public function getUserAnswer($quizId, $questionId){

        $answer= \DB::table('quiz_question')->where([
            'quiz_id'=>$quizId,
             'question_id' =>$questionId
        ])->first() ;

        return $answer ? $answer->answer :'';

    }
}
