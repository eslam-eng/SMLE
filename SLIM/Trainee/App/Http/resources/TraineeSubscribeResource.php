<?php

namespace SLIM\Trainee\App\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TraineeSubscribeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->pacakge->name,
            'is_free_package' => ($this->package->monthly_price && $this->package->yearly_price),
            'description' => $this->pacakege->description,
            'package_type' => $this->package_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_active' => $this->is_active,
            'subscribe_status' => $this->subscribe_status,
            'quizzes_count' => $this->quizzes_count,
            'remaining_quizzes' => $this->remaining_quizzes,
            'num_available_question' => $this->num_available_question,
        ];
    }
}
