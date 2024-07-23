<?php

namespace SLIM\Question\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SLIM\Question\App\Http\Requests\QuestionRequest;
use SLIM\Question\App\Models\Question;
use SLIM\Question\App\Models\QuestionSuggest;
use SLIM\Question\services\QuestionSuggestService;
use SLIM\Specialization\Service\SpecializationService;
use SLIM\Subspecialties\Interfaces\SubSpecializationServiceInterface;

class QuestionSuggestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private QuestionSuggestService $questionSuggestService;
    private SpecializationService $specializationService;
    private SubSpecializationServiceInterface $subSpecializationService;

    public function __construct(QuestionSuggestService $questionSuggestService,
        SpecializationService $specializationService,
        SubSpecializationServiceInterface $subSpecializationService
    )
    {
        $this->questionSuggestService   = $questionSuggestService;
        $this->specializationService    = $specializationService;
        $this->subSpecializationService = $subSpecializationService;
    }

    public function index(Request $request)
    {
        $specializations     = $this->specializationService->getAll();
        $sub_specializations = $this->subSpecializationService->getAll();

        $question_suggest = $this->questionSuggestService->getAllPaginated(
            search: $request->all(),
            pageSize:  15,
            withRelations: ['trainee','question']);

        if ($request->ajax())
        {
            return view('question::question_suggest.partial', compact('question_suggest'));
        }

        return view('question::question_suggest.index', compact('question_suggest', 'specializations', 'sub_specializations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->specializationService->getAll();
        return view('question::create', compact('specializations'));
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

        $this->questionSuggestService->create($questionRequest->all());
    }

    /**
     * Show the specified resource.
     */
    public function show($question_id)
    {
        $specializations    = $this->specializationService->getAll();
        $subSpecializations = $this->subSpecializationService->getAll();
        $question_suggest   = QuestionSuggest::find($question_id);
        $question           = Question::find($question_suggest->question_id);

        return view('question::question_suggest.show', compact('question_suggest', 'question', 'specializations', 'subSpecializations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $data = [
            'specialist_id' => $question->specialist_id
        ];
        $specializations    = $this->specializationService->getAll();
        $subSpecializations = $this->subSpecializationService->getAll($data);

        return view('question::edit', compact('specializations', 'question', 'subSpecializations'));
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

        $this->questionSuggestService->update($question, $questionRequest->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($question_id, Request $request)
    {
        $question = QuestionSuggest::find($question_id);
        $this->questionSuggestService->delete($question);
        return $this->index($request);
    }

}
