<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Mahasiswa
{
    public function handle(Request $request, Closure $next)
    {
        // Memastikan user yang login adalah Mahasiswa
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role !== '1') {
                // Jika bukan mahasiswa, arahkan ke dashboard sesuai role mereka
                switch ($user->role) {
                    case '2': // Dosen
                        return redirect('dosen/dashboard');
                    case '3': // Akademik
                        return redirect('akademik/dashboard');
                    case '4': // Dekan
                        return redirect('dekan/dashboard');
                    case '5': // Kaprodi
                        return redirect('kaprodi/dashboard');
                    default:
                        return redirect('/'); // Redirect ke halaman utama jika tidak ada role yang cocok
                }
            }
        }

        return $next($request); // Melanjutkan request jika user adalah mahasiswa
    }
}
