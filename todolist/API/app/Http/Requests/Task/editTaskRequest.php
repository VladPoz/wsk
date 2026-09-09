<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class editTaskRequest extends FormRequest
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
            //
            'title' => 'string|max:255',
            'description' => 'string|max:255|nullable',
            'type' => 'string|in:single,multiple',
            'count' => 'integer|nullable|min:1',
            'count_completed' => 'integer|nullable|min:0',
            'priority' => 'string|in:low,medium,high',
            'completed' => 'boolean:true,false',
        ];
    }
}
