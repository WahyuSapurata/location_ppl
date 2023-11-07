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

    // Route::get('/', 'Dashboard@index')->name('home.index');

    Route::get('/', function () {
        return view('home.index');
    })->name('landing');

    Route::group(['prefix' => 'login', 'middleware' => ['guest'], 'as' => 'login.'], function () {
        Route::get('/login-akun', 'AuthController@show')->name('login-akun');
        Route::post('/login-proses', 'AuthController@login_proses')->name('login-proses');
    });

    // Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    //     Route::get('/dashboard-admin', 'Dashboard@dashboard_admin')->name('dashboard-admin')->middleware('userAkses:admin');

    //     Route::get('/menu-makanan', 'MenuMakananController@index')->name('menu-makanan')->middleware('userAkses:admin');
    //     Route::get('/add-menu', 'MenuMakananController@store')->name('add-menu')->middleware('userAkses:admin');
    //     Route::get('/get-menu', 'MenuMakananController@get')->name('get-menu')->middleware('userAkses:admin');
    //     Route::get('/show-menu', 'MenuMakananController@show')->name('show-menu')->middleware('userAkses:admin');
    //     Route::get('/update-menu', 'MenuMakananController@update')->name('update-menu')->middleware('userAkses:admin');
    //     Route::get('/delete-menu', 'MenuMakananController@delete')->name('delete-menu')->middleware('userAkses:admin');
    // });

    Route::get('/logout', 'AuthController@logout')->name('logout');
});
