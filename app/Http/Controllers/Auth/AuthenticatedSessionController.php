<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        // 1 : mahasiswa, 2 : dosen, 3 : bagian akademik, 4 : dekan, 5 : kaprodi, 6 : dekan + dosen, 7 : kaprodi + dosen
        if($request->user()->role === '1')
        {
            return redirect('mahasiswa/dashboard');
        } 
        elseif($request->user()->role === '2')
        {
            return redirect('dosen/dashboard');
        }
        elseif($request->user()->role === '3')
        {
            return redirect('akademik/dashboard');
        }
        elseif($request->user()->role === '4')
        {
            return redirect('dekan/dashboard');
        }
        elseif($request->user()->role === '5')
        {
            return redirect('kaprodi/dashboard');
        }
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
