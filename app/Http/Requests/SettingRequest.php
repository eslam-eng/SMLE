<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'app_name'      =>'required|string|max:150',
            'about_app'     =>'required|string|max:400',
            'web_logo'          =>'sometimes|nullable|image',
            'web_icon'  =>'sometimes|nullable|image',
            'phone'         =>'required',
            'whatsapp'      =>'required',
            'email'         =>'required',
            'facebook'      =>'sometimes|nullable',
            'youtube'       =>'sometimes|nullable',
            'linked_in'     =>'sometimes|nullable',
            'is_difficult'   =>'sometimes|nullable',
            'timer'          =>'sometimes|nullable',
            'automatic_correct'    =>'sometimes|nullable',
            'try_answer'           =>'sometimes|nullable',


        ];
    }
}
