<?php

namespace SLIM\Quiz\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SLIM\Traits\GeneralTrait;

class QuizRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:225',
            'question_no' => 'required|numeric|min:1',
            'level' => 'required|string',
            'specialists' => 'nullable|array|min:1',
            'specialists.*' => 'required|numeric|distinct|min:1',

            'subSpecialists' => 'nullable|array|min:1',
            'subSpecialists.*' => 'required|numeric|distinct',

            'quiz_time' => 'sometimes|nullable|in:1,0',
            'question_stop_watch' => 'sometimes|nullable|in:1,0',
            'question_time' => 'required_if:question_stop_watch,==,1|numeric',
            'auto_correction' => 'sometimes|nullable|in:1,0',
            'number_attempt_allowed' => 'sometimes|nullable|numeric',
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
