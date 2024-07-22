<?php

namespace SLIM\Subspecialties\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubSpecializationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' =>'required|max:60',
            'is_active' =>'required|in:1,0',
            'specialist_id' =>'required'
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
