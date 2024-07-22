<?php

namespace SLIM\Trainee\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Package\App\Models\Package;
use SLIM\Package\App\resources\PackageResource;

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
            'package' =>$this->packages()->count() > 0 ? PackageResource::make($this->packages()->first()):
                PackageResource::make(Package::where('price',0)->first())

      //      'specialist'=>$this->specialist->name,
        //    'specialist'=>$this->sub_specialist->name,
        ];
    }
}
