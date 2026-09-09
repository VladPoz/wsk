<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class addTaskRequest extends FormRequest
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
            "title" => "required|string",
            "description" => "string|nullable",
            "type" => "required|string|in:single,multiple",
            "count" => 'integer|nullable|min:1',
            "count_completed" => 'integer|nullable|min:0',
            "priority" => "required|string|in:low,medium,high",
        ];
    }
}
