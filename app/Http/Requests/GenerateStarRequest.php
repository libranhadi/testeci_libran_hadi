<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateStarRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required',
            'number' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'The type field is required.',
            'number.required' => 'The number field is required.',
            'number.integer' => 'The number field must be an number.',
            'number.min' => 'The number field must be at least :min.',
        ];
    }
}
