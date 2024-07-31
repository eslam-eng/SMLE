<?php

namespace SLIM\Category\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SLIM\Category\App\resources\CategoryResource;
use SLIM\Category\App\resources\QuestionClassificationDetailsResource;
use SLIM\Category\App\resources\QuestionClassificationResource;
use SLIM\Category\Interfaces\CategoryServiceInterfaces;
use SLIM\Constants\App;
use SLIM\Traits\GeneralTrait;

class CategoryController extends Controller
{
    use GeneralTrait;

    protected CategoryServiceInterfaces $categoryServiceInterfaces;

    public function __construct(CategoryServiceInterfaces $categoryServiceInterfaces)
    {
        $this->categoryServiceInterfaces = $categoryServiceInterfaces;
    }

    public function index()
    {
        $categories = $this->categoryServiceInterfaces->getAllPaginated(['is_active' => 1], App::PAGINATE_LENGTH);
        return $this->returnDateWithPaginate($categories, CategoryResource::class, 'Lsit Classifications');
    }

    public function getQuestionClassification(Request $request)
    {
        $ClassifiedQuestions = auth()->user()->ClassifiedQuestions()
            ->when($request->classified_id, function ($q) use ($request) {
                $q->where('category_id', $request->classified_id);
            })
            ->Paginate(App::PAGINATE_LENGTH);
        return $this->returnDateWithPaginate($ClassifiedQuestions, QuestionClassificationResource::class, 'Classified Questions');
    }

    public function destroy(Request $request)
    {
        $classified = DB::table('question_category')->where('id', $request->question_classified_id)
            ->delete();
        return $this->returnSuccessMessage('Deleted Successfully');

    }


    public function classification_details($id)
    {
        $classified = DB::table('question_category')
            ->join('questions', 'questions.id', '=', 'question_category.question_id')
            ->leftJoin('quizzes', 'quizzes.id', '=', 'question_category.quiz_id')
            ->leftJoin('quiz_question', function ($join) {
                $join->on('quiz_question.quiz_id', '=', 'question_category.quiz_id')
                    ->on('quiz_question.question_id', '=', 'question_category.question_id');
            })
            ->where('question_category.id', $id)
            ->select(['question_category.*',
                'questions.question', 'questions.answer_a', 'questions.answer_b', 'questions.answer_c', 'questions.answer_d',
                'questions.model_answer', 'quizzes.title', 'quiz_question.answer', 'quiz_question.user_answer', 'quiz_question.is_correct'
            ])
            ->first();
        $classified = new QuestionClassificationDetailsResource($classified);
        return $this->returnData($classified, 'Classified Details');
    }

    public function saveClasify($classify, $question, $quiz)
    {
        $classifiedQuestion = auth()->user()->ClassifiedQuestions()->where(
            [
                'question_id' => $question,
                'category_id' => $classify,
                'quiz_id' => $quiz
            ]
        )->first();


        if (is_null($classifiedQuestion)) {
            auth()->user()->ClassifiedQuestions()->attach([
                    $question => [
                        'category_id' => $classify,
                        'quiz_id' => $quiz
                    ]
                ]
            );
        } else {
            $classifiedQuestion->update(
                [
                    'question_id' => $question,
                    'category_id' => $classify,
                    'quiz_id' => $quiz
                ]
            );
        }

    }

    public function questionClassification(Request $request)
    {
        foreach ($request->classified_id as $classify) {
            $this->saveClasify($classify, $request->question_id, $request->quiz_id);
        }
        return $this->returnSuccessMessage('Added Successfully');

    }


}
