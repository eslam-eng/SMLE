<?php

namespace SLIM\Specialization\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Subspecialties\App\resources\subSpecializationResorce;

class SpecilizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' =>$this->id,
            'name' =>$this->name,
            'subSpecialist' =>subSpecializationResorce::collection($this->subSpecialist),
        ];
    }
}
