<?php

namespace SLIM\Specialization\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SLIM\Specialization\App\Http\Requests\SpecializationRequest;
use SLIM\Specialization\App\Models\Specialization;
use SLIM\Specialization\Interfaces\SpecializationServiceInterface;

class SpecialtiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected SpecializationServiceInterface $service;

    public function __construct(SpecializationServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request, $isAjax = false)
    {

        $specializations = $this->service->getAllPaginated(search: array_filter($request->all()),withCountRelations: ['subscribes','questions']);

        if ($request->ajax() || $isAjax)
        {
            return view('specialization::partial', compact('specializations'));
        }

        return view('specialization::index', compact('specializations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('specialization::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecializationRequest $specializationRequest)
    {
        $this->service->create($specializationRequest->all());
        return $this->index(new Request(), true);

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('specialization::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('specialization::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpecializationRequest $specializationRequest, Specialization $specialization)
    {
        $this->service->update($specialization, $specializationRequest->all());
        return $this->index($specializationRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $this->service->delete($id);
        return $this->index($request);

    }

}
