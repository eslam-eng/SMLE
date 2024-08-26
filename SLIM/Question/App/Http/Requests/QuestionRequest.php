<?php

namespace SLIM\Question\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'question' =>'required|string|max:150',
            'answer_a' =>'required|string|max:150',
            'answer_b' =>'required|string|max:150',
            'answer_c' =>'required|string|max:150',
            'answer_d' =>'required|string|max:150',
            'model_answer' =>'required|string|in:A,B,C,D',
            'question_mark' =>'required|numeric',
            'level' =>'required|numeric',
            'specialist_id' =>'required|numeric',
            'sub_specialist_id' =>'nullable|numeric',
            'is_active' =>'required|in:1,0',
            'question_image' =>'sometimes|nullable|image|mimes:jpeg,png,jpg',
            'description' =>'sometimes|nullable|string|max:200',
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
