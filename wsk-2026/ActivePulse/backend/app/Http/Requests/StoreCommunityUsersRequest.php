<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommunityUsersRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'community_id' => 'required|integer|exists:communities,id',
        ];
    }
    public function messages(): array{
        return [
            'user_id.required' => 'user_id is required',
            'user_id.exists' => 'user_id does not exist',
            'community_id.required' => 'community_id is required',
            'community_id.exists' => 'community_id does not exist',
        ];
    }
}
