<?php

namespace SLIM\Trainee\App\Http\Requests;

use SLIM\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    use GeneralTrait;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'full_name'=>'required|string|max:100',
            'degree'=>'required|string|max:100',
            'user_name'=>'required|string|unique:trainees|max:550',
            'email'=>'required|email|unique:trainees',
            'phone'=>'required|unique:trainees',
            'password'=>'required|min:6',
         //   'specialist_id'=>'sometimes|nullable|numeric',
           // 'sub_specialist_id'=>'sometimes|nullable|numeric',
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
