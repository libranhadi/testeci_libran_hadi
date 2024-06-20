<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            'nama_jabatan' => [
                'required',
                'max:100'
            ],
            'id_level' => [
                'required'
            ],
        ];
    }

    public function messages()
    {
        return [
            'nama_jabatan' => 'Mohon isi nama jabatan',
            'nama_jabatan.max' => 'Nama jabatan tidak boleh lebih dari :max characters.',
            'id_level' => 'Mohon pilih level',
        ];
    }
}
