<?php

namespace SLIM\Package\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePackageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('packages', 'name')->ignore($this->package)],
            'monthly_price' => 'required|numeric|min:0',
            'yearly_price' => 'required|numeric|min:0',
            'num_available_quiz' => 'required_if:no_limit_for_quiz,==,null|numeric',
            'num_available_question' => 'required_if:no_limit_for_question,==,null|numeric',
            'is_active' => 'required|in:1,0',
            'no_limit_for_quiz' => 'nullable|in:1,0',
            'no_limit_for_question' => 'nullable|in:1,0',
            'specialist' => 'nullable|array',
            'speialist.*' => 'nullable',
            'specialist.specialist_id.*' => 'nullable|distinct|exists:specializations,id',
            'description' => 'nullable|string:max:500'
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