<?php

namespace SLIM\Quiz\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use SLIM\Question\App\Models\QuestionNote;
use SLIM\Question\App\Models\QuestionSuggest;
use SLIM\Quiz\App\Models\Quiz;
use SLIM\Quiz\services\QuizService;
use SLIM\Specialization\Service\SpecializationService;
use SLIM\Subspecialties\Interfaces\SubSpecializationServiceInterface;
use SLIM\Subspecialties\Service\SubSpecializationService;

class QuizController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    private QuizService $quizService;
    private SpecializationService $specializationService;
    private SubSpecializationService $subSpecializationService;
    protected $service;

    public function __construct(QuizService                       $quizService,
                                SpecializationService             $specializationService,
                                SubSpecializationServiceInterface $subSpecializationService
    )
    {
        $this->quizService = $quizService;
        $this->specializationService = $specializationService;
        $this->subSpecializationService = $subSpecializationService;
    }

    public function index(Request $request)
    {
        $specializations = $this->specializationService->getAll();
        $sub_specializations = $this->subSpecializationService->getAll();

        $quizs = $this->quizService->with(['correctAnswers', 'trainee'])->getAllPaginated($request->all(), 15);

        if ($request->ajax()) {
            return view('quiz::partial', compact('quizs'));
        }

        return view('quiz::index', compact('quizs', 'specializations', 'sub_specializations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quiz::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show(Quiz $quiz)
    {
        $quiz->load([
            'answerdQuestions'=>['specialist','sub_specialist'],
            'unanswerdQuestions'=>['specialist','sub_specialist'],
        ])
            ->loadCount(['answers as correct_answers' => fn($query) => $query->where('is_correct', 1), 'answers as incorrect_answers' => fn($query) => $query->where('is_correct', 0)]);
        return view('quiz::show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('quiz::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz, Request $request)
    {
        $this->quizService->delete($quiz);
        QuestionNote::where('quiz_id', $quiz->id)->delete();
        QuestionSuggest::where('quiz_id', $quiz->id)->delete();
        return $this->index($request);
    }

}
