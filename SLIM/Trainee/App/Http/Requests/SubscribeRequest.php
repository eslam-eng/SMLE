<?php

namespace SLIM\Trainee\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'trainee_id'=>'required|numeric',
            'package_id'=>'required|numeric',
            'amount' =>'required',
            'package_type' =>'required|in:m,p,y',
            'start_date'=>'nullable|date|date_format:Y-m-d',
            'end_date'=>'required_if:package_type,==,m',
            'payment_method'=>'required|integer|exists:payments,id',
            'invoice_file'=>'sometimes|nullable|file',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        return $this->merge(['start_date' => now()->format("Y-m-d")]);
    }
}
