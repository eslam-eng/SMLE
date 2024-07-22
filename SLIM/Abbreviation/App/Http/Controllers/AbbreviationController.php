<?php

namespace SLIM\Abbreviation\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Abbreviation\App\Http\Requests\AbbreviationRequest;
use SLIM\Abbreviation\App\Models\Abbreviation;
use SLIM\Abbreviation\Interfaces\AbbreviationServiceInterface;

class AbbreviationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private  AbbreviationServiceInterface $abbreviationServiceInterface;
    public function  __construct(AbbreviationServiceInterface $abbreviationServiceInterface)
    {
        $this->abbreviationServiceInterface =$abbreviationServiceInterface;
    }

    public function index(Request $request)
    {
        $abbreviations= $this->abbreviationServiceInterface->getAllPaginated($request->all(),15);
           if($request->ajax())
               return view('abbreviation::partial',compact('abbreviations'));

        return view('abbreviation::index',compact('abbreviations'));

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
}
