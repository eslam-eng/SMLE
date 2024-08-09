<?php

namespace SLIM\Quiz\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SLIM\Question\App\Models\Question;
use SLIM\Quiz\App\Http\Requests\QuestionAnswerRequest;
use SLIM\Quiz\App\Http\Requests\QuizRequest;
use SLIM\Quiz\App\Models\Quiz;
use SLIM\Quiz\App\Models\QuizQuestion;
use SLIM\Quiz\App\resources\QuizAnalysisResource;
use SLIM\Quiz\App\resources\QuizResource;
use SLIM\Quiz\App\resources\QuizResourceDetails;
use SLIM\Quiz\App\resources\StatisticQuizResource;
use SLIM\Trainee\App\Models\TraineeSubscribe;
use SLIM\Traits\GeneralTrait;

class QuizController extends Controller
{
    use GeneralTrait;

    public function SaveQuiz(QuizRequest $quizRequest)
    {
        try {
            $user = auth()->user();
            //get trainer subscribe active plan
            $trainerSubscribePlan = TraineeSubscribe::query()
                ->where(['is_paid' => true, 'is_active' => true, 'trainee_id' => $user->id])
                ->latest()
                ->first();

            $quizData = $quizRequest->except('specialists', 'subSpecialists');
            $quizData['trainee_subscribe_id'] = $trainerSubscribePlan->id;
            $quizData['quiz_date'] = date('Y-m-d');

            if (!is_null($trainerSubscribePlan->num_available_question) && $trainerSubscribePlan->num_available_question < $quizRequest->question_no)
                return $this->returnError("you cannot exceed available question number $trainerSubscribePlan->num_available_question", 422);

            if (!is_null($trainerSubscribePlan->num_available_question) && !$trainerSubscribePlan->remaining_quizzes)
                return $this->returnError("There is no quizzes available , please upgrade or renew plan", 422);

            DB::beginTransaction();
            $quiz = auth()->user()->quizzes()
                ->create($quizData);

            $quiz->specialist()->sync($quizRequest->specialists);
            $quiz->Subspecialist()->sync($quizRequest->subSpecialists);
            $this->generateQuiz($quizRequest, $quiz, $trainerSubscribePlan);
            $quiz->loadCount(['correctAnswers', 'incorrectAnswers', 'listQuestions']);
            //increment available quizzes
            $trainerSubscribePlan->decrement('remaining_quizzes');
            DB::commit();
            $quiz = QuizResourceDetails::make($quiz);
            return $this->returnData($quiz, 'Quiz Created Successfully');

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnError($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function show($id)
    {
        $user_id = auth()->id();
        try {
            $quiz = Quiz::query()
                ->withCount(['listQuestions', 'correctAnswers', 'inCorrectAnswers'])
                ->with(['listQuestions'])
                ->where('id', $id)
                ->where('trainee_id', $user_id)
                ->first();
            if (!$quiz)
                return $this->returnError('quiz not found', 404);
            return new QuizResourceDetails($quiz);
        } catch (\Exception $exception) {
            return $this->returnError($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function generateQuiz(QuizRequest $quizRequest, Quiz $quiz, $trainerSubscribePlan)
    {
        $quizQuestionData = [];
        $isThereSpecialists = collect($quizRequest->specialists)->count() + collect($quizRequest->subSpecialists)->count();
        if ($isThereSpecialists) {
            $filters = ['specialist_id' => $quizRequest->specialists, 'sub_specialist_id' => $quizRequest->subSpecialists];
        } else {
            $filters = ['specialist_id' => $trainerSubscribePlan->tranineeSubscribeSpecialization()->pluck('specialist_id')->toArray()];
        }
        $filters = array_filter($filters);


        $questions = Question::query()
            ->where(function ($query) use ($filters) {
                $query->when(Arr::get($filters, 'specialist_id') !== null, function ($q) use ($filters) {
                    $q->whereIn('specialist_id', $filters['specialist_id']);
                })->when(Arr::get($filters, 'sub_specialist_id') !== null, function ($q) use ($filters) {
                    $q->whereIn('sub_specialist_id', $filters['sub_specialist_id']);
                });
            })
            ->when($quizRequest->level, fn($q) => $q->where('level', $quizRequest->level))
            ->inRandomOrder()
            ->limit($quizRequest->question_no)
            ->get();

        if ($questions->isEmpty())
            return $this->returnError('There is no questions available', 422);

        $questions->each(function ($question) use (&$quizQuestionData, $trainerSubscribePlan, $quiz) {
            $quizQuestionData[] = [
                'trainee_id' => $trainerSubscribePlan->trainee_id,
                'quiz_id' => $quiz->id,
                'question_id' => $question->id,
                'answer' => $question->model_answer,
                'created_at' => now(),
                'updated_at' => now()
            ];
        });

        return DB::table('quiz_question')->insert($quizQuestionData);
    }

    public function statistics()
    {
        $user = auth()->user()
            ->load([
                'quizzes' => fn($query) => $query
                    ->limit(10)
                    ->latest('id')
                    ->orderBy('id', 'asc')
                    ->withCount([
                        'listQuestions',
                        'answers as correct_answers_count' => fn($query) => $query->where('is_correct', 1),
                        'answers as incorrect_answers_count' => fn($query) => $query->where('is_correct', 0)
                    ])
            ])->loadCount([
                'quizzes',

                'quizzes as list_questions_count' => fn($query) => $query
                    ->join('quiz_question', 'quizzes.id', '=', 'quiz_question.quiz_id')
                    ->select(DB::raw('count(quiz_question.id)')),

                'quizzes as correct_answers_count' => fn($query) => $query
                    ->join('quiz_question', fn($subQuery) => $subQuery
                        ->on('quizzes.id', '=', 'quiz_question.quiz_id'))
                    ->where('is_correct', 1)
                    ->select(DB::raw('count(quiz_question.id)')),

                'quizzes as incorrect_answers_count' => fn($query) => $query
                    ->join('quiz_question', fn($subQuery) => $subQuery
                        ->on('quizzes.id', '=', 'quiz_question.quiz_id'))
                    ->where('is_correct', 0)
                    ->select(DB::raw('count(quiz_question.id)')),

            ]);
        return new StatisticQuizResource($user);
    }

    public function SaveQuestionAnswer(QuestionAnswerRequest $questionAnswerRequest)
    {
        try {
            $returnedData = [];
            $questionAnswer = QuizQuestion::query()
                ->where([
                    'quiz_id' => $questionAnswerRequest->quiz_id,
                    'question_id' => $questionAnswerRequest->question_id,
                    'trainee_id' => auth()->id(),
                ])
                ->with('quiz')
                ->first();
            $questionAnswer->update([
                'user_answer' => $questionAnswerRequest->answer,
                'is_correct' => $questionAnswer->answer == $questionAnswerRequest->answer
            ]);

            if ($questionAnswer->quiz->auto_correction) {
                $returnedData = [
                    'model_answer' => $questionAnswer->answer,
                    'question_id' => $questionAnswerRequest->question_id,
                    'user_answer' => $questionAnswer->user_answer,
                    'is_correct' => $questionAnswer->is_correct
                ];
            }
            return $this->returnData($returnedData, 'answer saved successfully');


        } catch (\Exception $exception) {
            return $this->returnError('there is an error', 500);
        }
    }

    public function QuizAnalysis(Request $request)
    {
        $quiz = Quiz::withCount([
            'answers as correct_answers_count' => fn($q) => $q->where('is_correct', 1),
            'answers as incorrect_answers_count' => fn($q) => $q->where('is_correct', 0),
            'answers as unanswered_count' => fn($q) => $q->whereNull('is_correct'),
            'listQuestions'
        ])
            ->with('listQuestions')
            ->where('id', $request->quiz_id)
            ->first();

        $QuizAnalysis = QuizAnalysisResource::make($quiz);
        return $this->returnData($QuizAnalysis, 'Quiz Analysis');

    }

    public function getAllQuiz(Request $request)
    {
        $filters = array_filter([
            'title' => $request->title,
            'is_complete' => $request->is_complete,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        $user_id = auth()->id();

        $quizzesQuery = Quiz::query()
            ->select(['id', 'title', 'is_complete', 'level', 'quiz_date', 'trainee_id'])
            ->when(Arr::get($filters, 'title') !== null, fn($q) => $q->where('title', 'LIKE', '%' . $filters['title'] . '%'))
            ->when(Arr::get($filters, 'is_complete') !== null, fn($q) => $q->where('is_complete', $filters['is_complete']))
            ->when(Arr::get($filters, 'start_date') !== null, fn($q) => $q->whereDate('quiz_date', '>=', $filters['start_date']))
            ->when(Arr::get($filters, 'end_date') !== null, fn($q) => $q->whereDate('quiz_date', '<=', $filters['end_date']))
            ->where('trainee_id', $user_id);

        $quizzes = $quizzesQuery
            ->withCount([
                'listQuestions',
                'answers as correct_answers_count' => fn($q) => $q->where('is_correct', 1),
            ])->orderBy('id', 'desc')
            ->paginate();

        return QuizResource::collection($quizzes);
    }

    public function SetTakenTime(Request $request)
    {
        $quiz = Quiz::where('id', $request->quiz_id)->first();
        $quiz->update([
            'time_taken' => $request->taken_time
        ]);

        return $this->returnSuccessMessage('Quiz Taken Time set Successfully');
    }

    public function finishQuiz($id)
    {
        $quiz = Quiz::query()->withCount([
            'listQuestions',
            'answers as unanswered_count' => fn($query) => $query->whereNull('is_correct')
        ])
            ->find($id);
        if (!$quiz)
            return $this->returnError('resource not found', 404);

        $is_completed = !$quiz->unanswered_count;
        Quiz::query()->where('id', $quiz->id)->update(['is_complete' => $is_completed]);

        return $this->returnSuccessMessage('Quiz status updated Successfully');

    }
}
