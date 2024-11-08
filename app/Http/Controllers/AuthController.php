<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// INI MASIH BELOM BISA GUYS HEHE

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Pastikan halaman login berada di resources/views/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        // Validasi apakah user ada dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard'); // Ubah 'dashboard' sesuai rute tujuan setelah login
        } else {
            return back()->withErrors([
                'loginError' => 'Username atau password salah.',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
