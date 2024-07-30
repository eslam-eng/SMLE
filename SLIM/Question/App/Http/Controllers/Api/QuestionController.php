<?php

namespace SLIM\Question\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SLIM\Constants\App;
use SLIM\Question\App\Http\Requests\QuestionNoteRequest;
use SLIM\Question\App\Http\Requests\QuestionSuggestRequest;
use SLIM\Question\App\Models\QuestionNote;
use SLIM\Question\App\resources\QuestionNoteResource;
use SLIM\Question\App\resources\QuestionSuggestResource;
use SLIM\Traits\GeneralTrait;

class QuestionController extends Controller
{

    use GeneralTrait;

    public function questionNote(QuestionNoteRequest $questionNoteRequest)
    {
        $user_id = auth()->id();
        QuestionNote::query()->updateOrCreate([
            "trainee_id" => $user_id,
            "question_id" => $questionNoteRequest->question_id,
            "quiz_id" => $questionNoteRequest->quiz_id,
        ], ['note' => $questionNoteRequest->note]);
        return $this->returnSuccessMessage('Added Successfully');

    }

    public function getQuestionNote(Request $request)
    {
        $user_id = auth()->id();
        $questionNotes = QuestionNote::query()
            ->with(['question', 'quiz'])
            ->where('trainee_id', $user_id);
        if (count($request->all()) > 0) {
            $questionNotes->where(function ($query) use ($request) {
                if (isset($request->note)) {
                    $query->where("note", 'LIKE', "%" . $request->note . "%");
                }
                if (isset($request->question)) {
                    $query->whereHas('question', fn($subQuery) => $subQuery->where('question', 'LIKE', "%" . $request->question . "%"));
                }
            });
        }
        $questionNotes = $questionNotes->paginate(10);
        return QuestionNoteResource::collection($questionNotes);
    }

    public function deleteQuestionNote(Request $request)
    {
        \DB::table('question_notes')->where('id', $request->question_note_id)->delete();
        return $this->returnSuccessMessage('Question Note Deleted Successfully');

    }

    public function QuestionNoteDetails($id)
    {
        $questionNote = QuestionNote::query()
            ->with(['question', 'quiz'])
            ->find($id);
        return new QuestionNoteResource($questionNote);
    }

    public function questionSuggest(QuestionSuggestRequest $questionSuggestRequest)
    {
        auth()->user()->Suggestsquestions()->sync([
                $questionSuggestRequest->question_id => [
                    'quiz_id' => $questionSuggestRequest->quiz_id,
                    'suggest' => $questionSuggestRequest->suggest,
                    'answer' => $questionSuggestRequest->answer
                ]
            ]
        );
        return $this->returnSuccessMessage('Added Successfully');

    }

    public function getQuestionSuggest()
    {
        $SuggestedQuestion = auth()->user()->Suggestsquestions()->paginate(App::PAGINATE_LENGTH);
        return $this->returnDateWithPaginate($SuggestedQuestion, QuestionSuggestResource::class, 'Noted Questions');

    }

    public function deleteQuestionSuggest(Request $request)
    {
        \DB::table('question_suggests')->where('id', $request->question_suggest_id)->delete();
        return $this->returnSuccessMessage('Question Suggest Deleted Successfully');

    }

    public function QuestionSuggestDetails(Request $request)
    {
        $SuggestedQuestion = QuestionSuggestResource::make(
            auth()->user()->Suggestsquestions()->where('question_suggests.id', $request->question_suggest_id)->first()
        );

        return $this->returnData($SuggestedQuestion, 'Suggested Questions');

    }

}
