<?php

namespace SLIM\Payment\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array {
        return [
            'id'                     => $this->id,
            'name'                   => $this->name,
        ];
    }
}
