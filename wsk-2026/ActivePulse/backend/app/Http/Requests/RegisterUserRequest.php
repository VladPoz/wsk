<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|min:3|max:32|unique:users,name',
            'avatar' => 'required|string',
            'is_admin' => 'required|integer|between:0,1',
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'name is required',
            'name.string' => 'name must be string',
            'name.min' => 'name min 3 characters',
            'name.max' => 'name max 32 characters',
            'name.unique' => 'name must be unique',
            'avatar.required' => 'avatar is required',
            'avatar.string' => 'avatar must be string',
            'is_admin.required' => 'is_admin is required',
            'is_admin.integer' => 'is_admin must be integer',
            'is_admin.between' => 'is_admin must be between 0 and 1',
        ];
    }
}
