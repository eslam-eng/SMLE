<?php

namespace SLIM\Trainee\App\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Package\App\resources\PackageResource;

class TraineeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'user_name' => $this->user_name,
            'degree' => $this->degree,
            'subscription_data' => new TraineeSubscribeResource($this->activeSubscribe),
        ];
    }
}
