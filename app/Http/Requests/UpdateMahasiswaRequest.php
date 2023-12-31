<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMahasiswaRequest extends FormRequest
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
            'nama_mahasiswa' => 'required',
            'nim' => 'required',
            'angkatan' => 'required',
            'file' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'nama_mahasiswa.required' => 'kolom nama_mahasiswa harus di isi',
            'nim.required' => 'kolom nim harus di isi',
            'angkatan.required' => 'kolom angkatan harus di isi',
        ];
    }
}
