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
            'quiz_id'=>'required',
            'answers' =>'required|array|min:1',
            'answers.*.question_id' =>'required|numeric|distinct|exists:questions,id',
            'answers.*.answer' =>'required|string|in:A,B,C,D',

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
