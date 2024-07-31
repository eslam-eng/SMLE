<?php

namespace SLIM\Specialization\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use SLIM\Specialization\App\Models\Specialization;
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
        $specialists = SpecilizationResource::collection($this->specializationService->getAll($data));
        return $this->returnData($specialists, 'Lsit specialists');
    }

    public function traineeSpecialists()
    {
        try {
            $user = auth()->user();
            if (!$user)
                return $this->returnError('resource not found', 400);
            $activeTraineeSubscribeSpecialistsIds = $user->activeSubscribe->tranineeSubscribeSpecialization->pluck('specialist_id')->toArray();
            $specialists = Specialization::query()->with('subSpecialist')->whereIn("id", $activeTraineeSubscribeSpecialistsIds)->get();
            return SpecilizationResource::collection($specialists);
        } catch (\Exception $exception) {
            return $this->returnError('there is an error', 500);
        }
    }
}
