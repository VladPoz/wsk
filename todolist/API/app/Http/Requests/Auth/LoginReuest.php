<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginReuest extends FormRequest
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
            'name' => 'required|min:3',
            'password' => 'required|min:6',
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Minimum 3 characters',
            'password.required' => 'Password is required',
            'password.min' => 'Minimum 6 characters',
        ];
    }
}
