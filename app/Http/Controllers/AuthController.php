<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function show()
    {
        return view('auth.login');
    }

    public function login_proses(AuthRequest $authRequest)
    {
        $credential = $authRequest->getCredentials();

        if (!Auth::attempt($credential)) {
            return redirect()->route('login.login-akun')->with('failed', 'Email atau Password salah')->withInput($authRequest->only('email'));
        } else {
            return $this->authenticated();
        }
    }

    public function authenticated()
    {
        echo "berhasil";
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.login-akun')->with('success', 'Berhasil Logout');
    }
}
