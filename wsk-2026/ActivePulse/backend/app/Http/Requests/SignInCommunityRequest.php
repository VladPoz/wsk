<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SignInCommunityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'exists:App\Models\Community,slug'],
        ];
    }
    public function messages(): array{
        return [
            'slug.required' => 'Slug is required.',
            'slug.string' => 'Slug must be a string.',
            'slug.exists' => 'Slug does not exist.',
        ];
    }
}
