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
            'package_type'   => 'required|in:m,y',
            'payment_method' => 'required|string',
            'invoice_file'   => 'sometimes|nullable|file',
            'specialist_ids'   => 'required|array|min:1',
            'specialist_ids.*'   => 'required|exists:specializations,id',
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
