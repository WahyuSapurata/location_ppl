<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlternatifRequest extends FormRequest
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
            'mobile' => 'required',
            'web' => 'required',
            'desain' => 'required',
            'jaringan' => 'required',
            'nama_mahasiswa' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'Kolom mobile harus diisi',
            'web.required' => 'Kolom web harus diisi',
            'desain.required' => 'Kolom desain harus diisi',
            'jaringan.required' => 'Kolom jaringan harus diisi',
            'nama_mahasiswa.required' => 'Kolom nama mahasiswa harus diisi',
        ];
    }
}
