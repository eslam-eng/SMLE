<?php

namespace SLIM\Trainee\App\Http\resources;

use Illuminate\Http\Resources\Json\JsonResource;
use SLIM\Package\App\resources\SpecialistResource;

class TraineeSubscribeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->package->name,
            'package_id' => $this->package->id,
            'is_free_package' => !($this->amount > 0),
            'description' => $this->package->description,
            'package_type' => $this->package_type,
            'amount' => $this->amount,
            'no_limit_for_quiz' => is_null($this->quizzes_count),
            'no_limit_for_question' => $this->package->no_limit_for_question,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_active' => $this->is_active,
            'subscribe_status' => $this->subscribe_status,
            'quizzes_count' => $this->quizzes_count,
            'remaining_quizzes' =>  $this->remaining_quizzes,
            'num_available_question' => $this->num_available_question,
            'invoice_file' => isset($this->invoice_file) ? asset('storage/' . $this->invoice_file) : null,
            'specialists' => SpecialistResource::collection($this->package->specialist),
        ];
    }
}
