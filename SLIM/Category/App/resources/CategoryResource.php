<?php

namespace SLIM\Category\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
          'id' =>$this->id,
          'name' =>$this->name,
          'color' =>$this->color,
        ];
    }
}
