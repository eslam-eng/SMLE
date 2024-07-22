<?php

namespace SLIM\Question\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SLIM\Abbreviation\Interfaces\AbbreviationServiceInterface;
use SLIM\Question\App\Http\Requests\QuestionRequest;
use SLIM\Question\App\Models\Question;
use SLIM\Question\services\QuestionService;
use SLIM\Specialization\Service\SpecializationService;
use SLIM\Subspecialties\Interfaces\SubSpecializationServiceInterface;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private QuestionService $questionservice;
    private SpecializationService $specializationService;
    private SubSpecializationServiceInterface $subSpecializationService;
    private  AbbreviationServiceInterface $abbreviationServiceInterface;

    public function __construct(QuestionService $questionservice,
        SpecializationService $specializationService,
        SubSpecializationServiceInterface $subSpecializationService,
        AbbreviationServiceInterface $abbreviationServiceInterface
    )
    {
        $this->questionservice          = $questionservice;
        $this->specializationService    = $specializationService;
        $this->subSpecializationService = $subSpecializationService;
        $this->abbreviationServiceInterface =$abbreviationServiceInterface;

    }

    public function index(Request $request)
    {
        $specializations     = $this->specializationService->getAll();
        $sub_specializations = $this->subSpecializationService->getAll();

        $questions = $this->questionservice->getAllPaginated($request->all(), 15);

        if ($request->ajax())
        {
            return view('question::partial', compact('questions'));
        }

        return view('question::index', compact('questions', 'specializations', 'sub_specializations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->specializationService->getAll();
        $abbreviations= $this->abbreviationServiceInterface->getAll();

        return view('question::create', compact('specializations','abbreviations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $questionRequest)
    {

        if ($questionRequest->hasFile('question_image'))
        {
            $fileName = $questionRequest->question_image->HashName();
            $questionRequest->question_image->storeAs('public/question', $fileName);

            $questionRequest->merge([
                'image' => 'storage/question/' . $fileName
            ]);
        }

        $question =$this->questionservice->create($questionRequest->all());
        $question =$question->abbreviations()->sync($questionRequest->abbreviations);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('abbreviation::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $data = [
            'specialist_id' => $question->specialist_id
        ];


        $abbreviations= $this->abbreviationServiceInterface->getAll();
        $specializations    = $this->specializationService->getAll();
        $subSpecializations = $this->subSpecializationService->getAll($data);
        $Selected_abbreviations=$question->abbreviations ? $question->abbreviations()->pluck('abbreviation_id')->toarray():[];


        return view('question::edit', compact('specializations', 'question', 'subSpecializations','abbreviations','Selected_abbreviations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $questionRequest, Question $question)
    {

        if ($questionRequest->hasFile('question_image'))
        {
            $fileName = $questionRequest->question_image->HashName();
            $questionRequest->question_image->storeAs('public/question', $fileName);
            $questionRequest->merge([
                'image' => 'storage/question/' . $fileName
            ]);
        }

        $this->questionservice->update($question, $questionRequest->all());
        $question =$question->abbreviations()->sync($questionRequest->abbreviations);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question, Request $request)
    {
        $this->questionservice->delete($question);
        return $this->index($request);
    }

}
