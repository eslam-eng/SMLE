<?php

namespace SLIM\Specialization\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use SLIM\Specialization\App\resources\SpecilizationResource;
use SLIM\Specialization\Interfaces\SpecializationServiceInterface;
use SLIM\Traits\GeneralTrait;

class SpecializationController extends Controller
{
    use GeneralTrait;
    private SpecializationServiceInterface $specializationService;
    public function __construct(SpecializationServiceInterface $specializationService)
    {
        $this->specializationService = $specializationService;
    }

    public function specialists()
    {
        $data['is_active'] = 1;
        $specialists       = SpecilizationResource::collection($this->specializationService->getAll($data));
        return $this->returnData($specialists, 'Lsit specialists');
    }
}
