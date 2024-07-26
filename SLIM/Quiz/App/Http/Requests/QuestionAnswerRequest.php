<?php

namespace SLIM\Quiz\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SLIM\Traits\GeneralTrait;

class QuestionAnswerRequest extends FormRequest
{
    use GeneralTrait;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'quiz_id'=>'required|integer|exists:quiz_question,quiz_id',
            'question_id'=>'required|integer|exists:quiz_question,question_id',
            'answer' =>'required|string|in:A,B,C,D',
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
