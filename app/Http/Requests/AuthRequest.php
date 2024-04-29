<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Kolom email harus di isi',
            'email.email' => 'Kolom email harus format email xxx@gmail.com',
            'password.required' => 'Kolom password harus di isi'
        ];
    }

    public function getCredentials()
    {
        $email = $this->get('email');

        if ($email) {
            return [
                'email' => $email,
                'password' => $this->get('password')
            ];
        }

        return $this->only('email', 'password');
    }
}
