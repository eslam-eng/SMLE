<?php

namespace SLIM\Abbreviation\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SLIM\Abbreviation\App\Exports\AbbreviationExport;
use SLIM\Abbreviation\App\Http\Requests\AbbreviationRequest;
use SLIM\Abbreviation\App\Http\Requests\ImportAbbreviationRequest;
use SLIM\Abbreviation\App\Imports\AbbreviationImport;
use SLIM\Abbreviation\App\Imports\QuestionsImport;
use SLIM\Abbreviation\App\Models\Abbreviation;
use SLIM\Abbreviation\Interfaces\AbbreviationServiceInterface;

class AbbreviationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private AbbreviationServiceInterface $abbreviationServiceInterface;

    public function __construct(AbbreviationServiceInterface $abbreviationServiceInterface)
    {
        $this->abbreviationServiceInterface = $abbreviationServiceInterface;
    }

    public function index(Request $request)
    {
        $abbreviations = $this->abbreviationServiceInterface->getAllPaginated($request->all(), 15);
        if ($request->ajax())
            return view('abbreviation::partial', compact('abbreviations'));

        return view('abbreviation::index', compact('abbreviations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('abbreviation::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AbbreviationRequest $abbreviationRequest)
    {
        $this->abbreviationServiceInterface->create($abbreviationRequest->all());
        return $this->index($abbreviationRequest);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        abort(404);
        return view('abbreviation::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('abbreviation::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AbbreviationRequest $abbreviationRequest, Abbreviation $abbreviation)
    {
        $this->abbreviationServiceInterface->update($abbreviation, $abbreviationRequest->all());
        //  return  $this->index($abbreviationRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Abbreviation $abbreviation, Request $request)
    {
        $this->abbreviationServiceInterface->delete($abbreviation);
        return $this->index($request);

    }

    public function export()
    {
        $file_name = 'abbreviations' . now()->format('YmdHis') . '.xlsx';
        $abbreviations = $this->abbreviationServiceInterface->getAll();
        return (new AbbreviationExport($abbreviations))->download($file_name);
    }

    public function downloadTemplate()
    {
        $file_name = 'abbreviations' . now()->format('YmdHis') . '.xlsx';
        $abbreviations = collect();
        return (new AbbreviationExport($abbreviations))->download($file_name);
    }

    public function importForm()
    {
        return view('abbreviation::import.import');
    }

    public function import(ImportAbbreviationRequest $request)
    {
        $file = $request->file('file');;
        try {
            $import = new AbbreviationImport();
            $import->import($file);
            return back()->with('success','imported successfully');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            session()->flash('failures', $failures);
            return back();
        } catch (\Exception $e) {
            session()->flash('server_error', 'there is an error while importing abbreviations');
            return back();
        }

    }
}
