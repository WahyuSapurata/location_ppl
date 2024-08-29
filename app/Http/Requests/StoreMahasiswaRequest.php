<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
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
            'uuid_kriteria' => 'required',
            'uuid_mitra' => 'required',
            'nama_mahasiswa' => 'required',
            'nim' => 'required|min:11',
            'angkatan' => 'required',
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'uuid_kriteria.required' => 'kolom kriteria harus di isi',
            'uuid_mitra.required' => 'kolom mitra harus di isi',
            'nama_mahasiswa.required' => 'kolom nama mahasiswa harus di isi',
            'nim.required' => 'kolom nim harus di isi',
            'nim.min' => 'kolom nim harus berisi 11 karakter',
            'angkatan.required' => 'kolom angkatan harus di isi',
            'file.required' => 'kolom file harus di isi',
        ];
    }
}
