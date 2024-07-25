<?php

namespace SLIM\Quiz\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use SLIM\Constants\App;
use SLIM\Question\App\Models\Question;
use SLIM\Quiz\App\Http\Requests\QuestionAnswerRequest;
use SLIM\Quiz\App\Http\Requests\QuizRequest;
use SLIM\Quiz\App\Models\Quiz;
use SLIM\Quiz\App\resources\QuizAnalysisResource;
use SLIM\Quiz\App\resources\QuizResorce;
use SLIM\Quiz\App\resources\QuizResourceDetails;

use SLIM\Quiz\App\resources\StatisticQuizResource;
use SLIM\Traits\GeneralTrait;
class QuizController extends Controller
{
    use GeneralTrait;

    public function SaveQuiz(QuizRequest $quizRequest)
    {

        DB::beginTransaction();
        try {
            $quiz = auth()->user()->quizzes()->create($quizRequest->except('specialists', 'subSpecialists'));
            $quiz->specialist()->sync($quizRequest->specialists);
            $quiz->Subspecialist()->sync($quizRequest->subSpecialists);
            $this->generateQuiz($quizRequest->subSpecialists, $quiz);

            DB::commit();
            $quiz = QuizResourceDetails::make($quiz);

            return $this->returnData($quiz, 'Quiz Created Successfully');

        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return $this->returnError($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function show($id)
    {
        $user_id = auth()->id();
        try {
            $quiz = Quiz::query()->where('id',$id)->where('trainee_id',$user_id)->first();
            return new QuizResourceDetails($quiz);
        }
        catch (\Exception $exception)
        {
            return $this->returnError($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function generateQuiz($subSpecialists = [], Quiz $quiz)
    {

        $questions = Question::whereIn('sub_specialist_id', $subSpecialists)
            ->limit($quiz->question_no)->pluck('id');

        if ($questions)
        {
            $questions = Question::inRandomOrder()
                ->limit($quiz->question_no)->pluck('id');
        }




        $quiz->listQuestions()->sync($questions);
        $quiz->listQuestions()->update([
            'trainee_id'=>auth()->user()->id,
        ]);
    }

    public function Statistics()
    {
        $Statistic = StatisticQuizResource::make(auth()->user());
        return $this->returnData($Statistic, 'Statistic');

    }

    public function SaveQuestionAnswer(QuestionAnswerRequest $questionAnswerRequest)
    {
        foreach ($questionAnswerRequest->answers as $answer)
        {
            $question = Question::find($answer['question_id']);

            if($question->model_answer ==  $answer['answer'])
                $answer['is_correct']=true;
            else
                $answer['is_correct']=false;

            $questionAnswer = \DB::table('quiz_question')->where([
                'quiz_id'      => $questionAnswerRequest->quiz_id,
                'question_id'  => $answer['question_id'],
                'trainee_id'              =>auth()->user()->id,
            ])->first();



            if($questionAnswer){
                $questionAnswer = \DB::table('quiz_question')->where([
                    'quiz_id'      => $questionAnswerRequest->quiz_id,
                    'question_id'  => $answer['question_id'],
                    'trainee_id'              =>auth()->user()->id,
                ])->update([
                    'quiz_id'      => $questionAnswerRequest->quiz_id,
                    'question_id'  => $answer['question_id'],
                    'answer'       => $answer['answer'],
                    'is_correct'   => $answer['is_correct'],
                    'trainee_id'              =>auth()->user()->id,
                ]);
            }
            else{
//                \DB::table('quiz_question')->insert([
//                    'quiz_id'      => $questionAnswerRequest->quiz_id,
//                    'question_id'  => $answer['question_id'],
//                    'answer'       => $answer['answer'],
//                    'is_correct'   => $answer['is_correct'],
//                    'trainee_id'              =>auth()->user()->id,
//                ]);
            }


        }
        return $this->returnSuccessMessage('Question Answer Saved');

    }

    public function QuizAnalysis(Request $request)
    {
        $quiz         = Quiz::where('id', $request->quiz_id)->first();
        $QuizAnalysis = QuizAnalysisResource::make($quiz);
        return $this->returnData($QuizAnalysis, 'Quiz Analysis');

    }

    public function getAllQuiz(Request $request)
    {
        $quizzes = auth()->user()->quizzes()->paginate(App::PAGINATE_LENGTH);
        return $this->returnDateWithPaginate($quizzes, QuizResorce::class, 'Quizzes List');
    }

    public function SetTakenTime(Request $request)
    {
        $quiz = Quiz::where('id', $request->quiz_id)->first();
        $quiz->update([
            'time_taken' => $request->taken_time
        ]);

        return $this->returnSuccessMessage('Quiz Taken Time set Successfully');
    }

    public function CompleteQuiz(Request $request)
    {
        Quiz::where('id',$request->quiz_id)->update([
            'is_complete' =>true
        ]);
        return $this->returnSuccessMessage('Quiz Complete Successfully');

    }
}
