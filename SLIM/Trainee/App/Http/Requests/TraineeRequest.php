<?php

namespace SLIM\Trainee\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TraineeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'full_name'=>'required|string|max:100',
            'user_name'=>'required|string|unique:trainees|max:550',
            'email'=>'required|email|unique:trainees',
            'phone'=>'required|unique:trainees',
            'phone_code'=>'required',
            'password'=>'required|min:6',
            'is_active'=>'required|in:1,0',
            'specialist_id'=>'required|numeric',
          //  'category_id'=>'required|numeric',
            'sub_specialist_id'=>'required|numeric',
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
