<?php

namespace SLIM\Admin\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:100',
            'email'=>'required|email|unique:users,email,'.request('id'),
            'password'=>'sometimes|nullable|min:6',
            'role'=>'required',
            'is_active'=>'required|in:1,0',
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
