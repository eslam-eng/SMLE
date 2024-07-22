<?php

namespace SLIM\Question\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SLIM\Traits\GeneralTrait;

class QuestionSuggestRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array {
        return [
            'question_id' => 'required|numeric|exists:questions,id',
            'quiz_id'     => 'required|numeric|exists:quizzes,id',
            'suggest'     => 'required|string',
            'answer'      => 'required|string'
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
