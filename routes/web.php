<?php

use App\Models\Mitra;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'Dashboard@index')->name('home.index');

    Route::get('/', function () {
        $data = Mitra::all();
        return view('home.index', compact('data'));
    })->name('landing');

    Route::post('/addHome-mahasiswa', 'MahasiswaController@store')->name('addHome-mahasiswa');

    Route::group(['prefix' => 'login', 'middleware' => ['guest'], 'as' => 'login.'], function () {
        Route::get('/login-akun', 'AuthController@show')->name('login-akun');
        Route::post('/login-proses', 'AuthController@login_proses')->name('login-proses');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
        Route::get('/dashboard-admin', 'Dashboard@dashboard_admin')->name('dashboard-admin');

        Route::get('/kriteria', 'KriteriaController@index')->name('kriteria');
        Route::post('/add-kriteria', 'KriteriaController@store')->name('add-kriteria');
        Route::get('/get-kriteria', 'KriteriaController@get')->name('get-kriteria');
        Route::get('/show-kriteria/{params}', 'KriteriaController@show')->name('show-kriteria');
        Route::post('/update-kriteria/{params}', 'KriteriaController@update')->name('update-kriteria');
        Route::delete('/delete-kriteria/{params}', 'KriteriaController@delete')->name('delete-kriteria');

        Route::get('/mahasiswa', 'MahasiswaController@index')->name('mahasiswa');
        Route::post('/add-mahasiswa', 'MahasiswaController@store')->name('add-mahasiswa');
        Route::get('/get-mahasiswa', 'MahasiswaController@get')->name('get-mahasiswa');
        Route::get('/show-mahasiswa/{params}', 'MahasiswaController@show')->name('show-mahasiswa');
        Route::post('/update-mahasiswa/{params}', 'MahasiswaController@update')->name('update-mahasiswa');
        Route::delete('/delete-mahasiswa/{params}', 'MahasiswaController@delete')->name('delete-mahasiswa');

        Route::get('/alternatif', 'AlternatifController@index')->name('alternatif');
        Route::post('/add-alternatif', 'AlternatifController@store')->name('add-alternatif');
        Route::get('/get-alternatif', 'AlternatifController@get')->name('get-alternatif');
        Route::get('/show-alternatif/{params}', 'AlternatifController@show')->name('show-alternatif');
        Route::post('/update-alternatif/{params}', 'AlternatifController@update')->name('update-alternatif');
        Route::delete('/delete-alternatif/{params}', 'AlternatifController@delete')->name('delete-alternatif');

        Route::get('/perangkingan', 'Perangkingan@index')->name('perangkingan');
        Route::get('/get-rangking', 'Perangkingan@kalkulasiRangking')->name('get-rangking');

        Route::get('/perusahaan', 'MitraController@index')->name('perusahaan');
        Route::post('/add-perusahaan', 'MitraController@store')->name('add-perusahaan');
        Route::get('/get-perusahaan', 'MitraController@get')->name('get-perusahaan');
        Route::get('/show-perusahaan/{params}', 'MitraController@show')->name('show-perusahaan');
        Route::post('/update-perusahaan/{params}', 'MitraController@update')->name('update-perusahaan');
        Route::delete('/delete-perusahaan/{params}', 'MitraController@delete')->name('delete-perusahaan');

        Route::get('/surat', 'Surat@index')->name('surat');
        Route::post('/add-surat', 'Surat@store')->name('add-surat');
        Route::get('/get-surat', 'Surat@get')->name('get-surat');
        Route::get('/get-pdf', 'Surat@pdf')->name('get-pdf');
    });

    Route::get('/logout', 'AuthController@logout')->name('logout');
});
