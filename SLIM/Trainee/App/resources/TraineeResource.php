<?php

namespace SLIM\Trainee\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Package\App\Models\Package;
use SLIM\Package\App\resources\PackageResource;
use SLIM\Package\App\resources\SpecialistResource;

class TraineeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return[
            'full_name'=>$this->full_name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'user_name'=>$this->user_name,
            'degree'=>$this->degree,
            'package' => PackageResource::make($this->activeSubscribe->package),

        ];
    }
}
