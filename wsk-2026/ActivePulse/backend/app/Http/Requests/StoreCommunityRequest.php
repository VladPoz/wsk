<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommunityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:32', 'unique:communities,slug']
        ];
    }
    public function messages(): array{
        return [
            'slug.required' => 'The slug field is required.',
            'slug.string' => 'The slug must be a string.',
            'slig.max' => 'The slug max 32 characters.',
            'slug.unique' => 'The slug has already been taken.',
        ];
    }
}
