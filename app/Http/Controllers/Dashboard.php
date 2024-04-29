<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Mitra;
use Illuminate\Http\Request;

class Dashboard extends BaseController
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->back();
        }
        return redirect()->route('login.login-akun');
    }

    public function dashboard_admin()
    {
        $module = 'Dashboard';
        $mahasiswa = Mahasiswa::count();
        $dosen = Dosen::count();
        $mitra = Mitra::count();
        $pendaftar = Mahasiswa::where('uuid_dosen', null)->count();
        return view('dashboard.index', compact('module', 'mahasiswa', 'dosen', 'mitra', 'pendaftar'));
    }
}
