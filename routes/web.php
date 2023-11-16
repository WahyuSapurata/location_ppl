<?php

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
        return view('home.index');
    })->name('landing');

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
    });

    Route::get('/logout', 'AuthController@logout')->name('logout');
});
