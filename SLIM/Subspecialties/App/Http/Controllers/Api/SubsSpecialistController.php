<?php

namespace SLIM\Subspecialties\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Subspecialties\App\resources\subSpecializationResorce;
use SLIM\Subspecialties\Interfaces\SubSpecializationServiceInterface;
use SLIM\Traits\GeneralTrait;

class SubsSpecialistController extends Controller
{
    use GeneralTrait;
    private SubSpecializationServiceInterface $subSpecializationService;
    public function __construct(SubSpecializationServiceInterface $subSpecializationService)
    {
        $this->subSpecializationService =$subSpecializationService;
    }

    public function subSpecialists(Request $request)
    {
        $subSpecialists = subSpecializationResorce::collection( $this->subSpecializationService->getAll($request->all()));

        return $this->returnData($subSpecialists,'subSpecialists List');
    }
}
