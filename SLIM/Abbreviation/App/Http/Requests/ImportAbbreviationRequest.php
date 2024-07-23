<?php

namespace SLIM\Abbreviation\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportAbbreviationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'file' =>'required|file|mimes:xls,xlsx',
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
