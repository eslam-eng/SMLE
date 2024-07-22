<?php

namespace SLIM\Trainee\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TraineeUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'full_name'=>'required|string|max:100',
            'user_name'=>'required|string|max:50|unique:trainees,user_name,'.$this->route('trainee')->id,
            'email'=>'required|email|unique:trainees,email,'.$this->route('trainee')->id,
            'phone'=>'required|unique:trainees,phone,'.$this->route('trainee')->id,
            'phone_code'=>'required',
            'password'=>'sometimes|nullable|min:6',
            'is_active'=>'required|in:1,0',
            'specialist_id'=>'required|numeric',
        //    'category_id'=>'required|numeric',
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
