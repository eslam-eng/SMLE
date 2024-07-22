<?php

namespace SLIM\Trainee\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SLIM\Traits\GeneralTrait;

class SubscribeTraineeRequest extends FormRequest
{
    use GeneralTrait;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array {
        return [
            'package_id'     => 'required|numeric',
            'amount'         => 'required',
            'package_type'   => 'required|in:m,p,y',
            'start_date'     => 'required|date',
            'payment_method' => 'required|string',
            // 'for_all_specialities' => 'sometimes|nullable|numeric',
            'specialist_id'  => 'sometimes|nullable|exists:specializations,id',
            'invoice_file'   => 'sometimes|nullable|file'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
