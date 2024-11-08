<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController; // atau controller yang menangani halaman user

// Routes auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk halaman user
Route::get('/user', [HomeController::class, 'index'])->name('user')->middleware('auth');