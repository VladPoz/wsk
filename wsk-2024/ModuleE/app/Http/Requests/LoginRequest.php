<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:3|max:255',
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'name is required',
            'name.min' => 'name min 3 characters',
            'name.max' => 'name max 255 characters',
            'password.required' => 'password is required',
            'password.min' => 'password min 3 characters',
            'password.max' => 'password max 255 characters',
        ];
    }
}
