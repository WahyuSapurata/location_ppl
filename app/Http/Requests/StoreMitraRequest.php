<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMitraRequest extends FormRequest
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
            'nama_perusahaan' => 'required',
            'bidang' => 'required',
            'logo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_perusahaan.required' => 'kolom nama perusahaan harus di isi',
            'bidang.required' => 'kolom bidang harus di isi',
            'logo.required' => 'kolom logo harus di isi',
        ];
    }
}
