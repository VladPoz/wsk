<?php

namespace App\Http\Requests\Place;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePlaceRequest extends FormRequest
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
            'name' => 'required|unique:places,name',
            'latitude' => 'required',
            'longitude' => 'required',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'open_time' => 'required',
            'close_time' => 'required',
            'description' => 'required',
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'Name is required.',
            'name.unique' => 'Name must be unique.',
            'latitude.required' => 'Latitude is required.',
            'longitude.required' => 'Longitude is required.',
            'type.required' => 'Type is required.',
            'image.required' => 'Image is required.',
            'image.image' => 'Image must be an image.',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'Image size must be less than 2MB.',
            'open_time.required' => 'Open time is required.',
            'close_time.required' => 'Close time is required.',
            'description.required' => 'Description is required.',
        ];
    }
}
