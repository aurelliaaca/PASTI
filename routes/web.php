<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('login');
});

Route::get('login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('proses_login', 'App\Http\Controllers\LoginController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cek_login:kaprodi']], function(){
        Route::resource('kaprodi', UserController::class);
    });
});

Route::get('/user', [UserController::class, 'index'])->name('user');


Route::get('/login', function () {
    return view('login');
});

Route::get('/login/user', function () {
    return view('user');
});


