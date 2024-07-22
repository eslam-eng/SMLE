<?php

namespace SLIM\Package\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array {
        return [
            'id'                     => $this->id,
            'name'                   => $this->name,
            'final_price'            => $this->price,
            'monthly_price'          => $this->monthly_price,
            'yearly_price'           => $this->yearly_price,
            'num_available_quiz'     => $this->num_available_quiz,
            'num_available_question' => $this->num_available_question,
            'no_limit_for_quiz'      => $this->no_limit_for_quiz,
            'no_limit_for_question'  => $this->no_limit_for_question,
            //  'for_all_specialities'   => $this->for_all_specialities,
            'specialities'           => SpecialistResource::collection($this->specialist),
            'description'            => $this->description
        ];
    }
}
