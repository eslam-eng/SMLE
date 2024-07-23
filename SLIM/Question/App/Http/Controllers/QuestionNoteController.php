<?php

namespace SLIM\Question\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SLIM\Question\App\Http\Requests\QuestionRequest;
use SLIM\Question\App\Models\Question;
use SLIM\Question\App\Models\QuestionNote;
use SLIM\Question\services\QuestionNoteService;
use SLIM\Specialization\Service\SpecializationService;
use SLIM\Subspecialties\Interfaces\SubSpecializationServiceInterface;

class QuestionNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private QuestionNoteService $questionNoteService;
    private SpecializationService $specializationService;
    private SubSpecializationServiceInterface $subSpecializationService;

    public function __construct(QuestionNoteService $questionNoteService,
        SpecializationService $specializationService,
        SubSpecializationServiceInterface $subSpecializationService
    )
    {
        $this->questionNoteService      = $questionNoteService;
        $this->specializationService    = $specializationService;
        $this->subSpecializationService = $subSpecializationService;
    }

    public function index(Request $request)
    {
        $specializations     = $this->specializationService->getAll();
        $sub_specializations = $this->subSpecializationService->getAll();

        $questions_note = $this->questionNoteService->getAllPaginated(search: $request->all(),withRelations:['question','trainee'] );

        if ($request->ajax())
        {
            return view('question::question_note.partial', compact('questions_note'));
        }

        return view('question::question_note.index', compact('questions_note', 'specializations', 'sub_specializations'));

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

        $this->questionNoteService->create($questionRequest->all());
    }

    /**
     * Show the specified resource.
     */
    public function show($question_id)
    {
        $specializations    = $this->specializationService->getAll();
        $subSpecializations = $this->subSpecializationService->getAll();
        $question_note      = QuestionNote::find($question_id);
        $question           = Question::find($question_note->question_id);

        return view('question::question_note.show', compact('question_note', 'question', 'specializations', 'subSpecializations'));
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

        $this->questionNoteService->update($question, $questionRequest->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($question_id, Request $request)
    {
        $question = QuestionNote::find($question_id);
        $this->questionNoteService->delete($question);
        return $this->index($request);
    }

}
