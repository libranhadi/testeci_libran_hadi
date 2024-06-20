<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'nama_dept' => [
                'required',
                'max:100'
            ],
        ];
    }

    public function messages()
    {
        return [
            'nama_dept' => 'Mohon isi nama department',
            'nama_dept.max' => 'Nama department tidak boleh lebih dari :max characters.',
        ];
    }
}
