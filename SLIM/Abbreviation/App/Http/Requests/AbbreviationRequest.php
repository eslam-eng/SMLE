<?php

namespace SLIM\Abbreviation\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbbreviationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'char_abbreviations' =>'required|max:200',
            'word_abbreviations' =>'required|max:200',
            'description_abbreviations' =>'required|max:500',
            'is_active' =>'required|in:1,0',
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
