<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Kriteria extends FormRequest
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
            'nama_kriteria' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_kriteria.required' => 'kolom nama_kriteria harus di isi',
            'atribut.required' => 'kolom atribut harus di isi',
            'bobot.required' => 'kolom bobot harus di isi',
        ];
    }
}
