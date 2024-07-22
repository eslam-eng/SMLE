<?php

namespace SLIM\Package\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array {
        return [
            'name'          =>$this->name,
            'specialist_id' => $this->pivot?->specialist_id,
            'monthly_price' => $this->pivot?->monthly_price,
            'yearly_price'  => $this->pivot?->yearly_price
        ];
    }
}
