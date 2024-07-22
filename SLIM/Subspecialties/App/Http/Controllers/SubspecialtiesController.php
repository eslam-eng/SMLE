<?php

namespace SLIM\Subspecialties\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Subspecialties\App\Models\SubSpecialties;
use SLIM\Subspecialties\Interfaces\SubSpecializationServiceInterface;
use SLIM\Specialization\Interfaces\SpecializationServiceInterface;
use  SLIM\Subspecialties\App\Http\Requests\SubSpecializationRequest;
class SubspecialtiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected SubSpecializationServiceInterface $service;
    protected SpecializationServiceInterface $specializationService;


    public function __construct(SubSpecializationServiceInterface $service ,SpecializationServiceInterface $specializationService)
    {
        $this->service = $service;
        $this->specializationService = $specializationService;
    }

    public function index(Request  $request)
    {
        $subSpecializations=$this->service->with(['specialist'])->getAllPaginated($request->all(),15);
        $Specializations=$this->specializationService->getAll();
        if($request->ajax())
            return view('subspecialties::partial',compact('subSpecializations'));
        return view('subspecialties::index',compact('subSpecializations','Specializations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subspecialties::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubSpecializationRequest $subSpecializationRequest)
    {
        $this->service->create($subSpecializationRequest->all());
        return $this->index($subSpecializationRequest);

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('subspecialties::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('subspecialties::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubSpecializationRequest $subSpecializationRequest, $id)
    {
        $subSpecialties =SubSpecialties::findorfail($id);
        $this->service->update($subSpecialties, $subSpecializationRequest->all());
        return  $this->index($subSpecializationRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $this->service->delete($id);
        return  $this->index($request);


    }
    public function getSubSpecialization(Request $request)
    {
        $subSpecializations =$this->service->getAll($request->all());
        return  view('subspecialties::sub_specialist',compact('subSpecializations'));


    }
}
