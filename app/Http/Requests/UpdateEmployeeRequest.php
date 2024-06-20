<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'nik' => 'required|string|max:10|unique:karyawan,nik,' . $this->id . ',id_karyawan,deleted_at,NULL',
            'nama' => 'required|string|max:100',
            'ttl' => 'required|date',
            'alamat' => 'required|string',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'id_dept' => 'required|exists:department,id_dept',
        ];
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.max' => 'NIK maksimal :max karakter.',
            'nik.unique' => 'NIK sudah digunakan.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal :max karakter.',
            'ttl.required' => 'Tanggal lahir wajib diisi.',
            'ttl.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'id_jabatan.required' => 'Jabatan wajib dipilih.',
            'id_jabatan.exists' => 'Jabatan yang dipilih tidak valid.',
            'id_dept.required' => 'Departemen wajib dipilih.',
            'id_dept.exists' => 'Departemen yang dipilih tidak valid.',
        ];
    }
}
