<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'name' => 'required|string|exists:users,name',
        ];
    }
    public function messages(): array{
        return [
            'name.required'=> 'Name is required',
            'name.string'=> 'Name must be string',
            'name.exists'=> 'Name does not exist',
        ];
    }
}
