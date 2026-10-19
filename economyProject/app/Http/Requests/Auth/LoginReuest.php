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
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|max:24',
        ];
    }
    public function messages(): array{
        return [
            'email.required' => 'Введите email',
            'email.email' => 'Введите email',
            'email.max' => 'Максимум 255 символов',
            'password.required' => 'Введите пароль',
            'password.min' => 'Минимум 6 символов',
            'password.max' => 'Максимум 24 символа',
        ];
    }
}
