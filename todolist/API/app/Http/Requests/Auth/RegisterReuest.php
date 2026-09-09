<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterReuest extends FormRequest
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
            'name' => 'required|string|min:3|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Minimum 3 characters',
            'name.unique' => 'Name must be unique',
            'password.required' => 'Password is required',
            'password.min' => 'Minimum 6 characters',
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.min' => 'Minimum 6 characters',
        ];
    }
}
