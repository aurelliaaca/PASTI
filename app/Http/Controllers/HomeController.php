<?php

namespace App\Http\Controllers;
use App\Models\Bagian_akademik;
use Illuminate\Support\Facades\Auth;  // Pastikan ini ada
use App\Models\Mahasiswa;
use App\Models\Dekan;
use App\Models\Dosen;
use App\Models\User;
use App\Models\KetuaProdi;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function dashboardMahasiswa()
    {
        $user = Auth::user();

    // Ambil data mahasiswa yang terhubung dengan user yang sedang login
        $mahasiswas = Mahasiswa::where('email', $user->email)->get(); // Pastikan ada kolom 'user_id' di tabel mahasiswa
        $users = User::all();
            return view('mahasiswa.dashboard_mhs', compact('users','mahasiswas')); // Kirim data ke view
    }
    
    public function dashboardDosen()
    {
        $user = Auth::user();

    // Ambil data mahasiswa yang terhubung dengan user yang sedang login
        $dosens = Dosen::where('email', $user->email)->get(); // Pastikan ada kolom 'user_id' di tabel mahasiswa
        $users = User::all();
            return view('dosen.dashboard', compact('users','dosens')); // Kirim data ke view
    }

    public function dashboardAkademik()
    {
        $user = Auth::user();

    // Ambil data mahasiswa yang terhubung dengan user yang sedang login
        $akademiks = Bagian_akademik::where('email', $user->email)->get(); // Pastikan ada kolom 'user_id' di tabel mahasiswa
        $users = User::all();
            return view('akademik.dashboard', compact('users','akademiks')); // Kirim data ke view
    }

    public function dashboardDekan()
    {
        $user = Auth::user();

    // Ambil data Dekan berdasarkan email user
    $dekans = Dekan::whereHas('dosen', function ($query) use ($user) {
        // Cari dosen yang punya email yang sama dengan user yang login
        $query->where('email', $user->email);
    })->get();

    // Ambil data Dosen yang terkait
    $dosens = Dosen::with('dekan')->get();

    // Kirimkan data ke view
    return view('dekan.dashboard_dekan', compact('dekans', 'dosens'));
    }

    public function dashboardKaprodi()
    {
        $user = Auth::user();

    // Ambil data Dekan berdasarkan email user
    $kaprodis = KetuaProdi::whereHas('dosen', function ($query) use ($user) {
        // Cari dosen yang punya email yang sama dengan user yang login
        $query->where('email', $user->email);
    })->get();

    // Ambil data Dosen yang terkait
    $dosens = Dosen::with('kaprodi')->get();

    // Kirimkan data ke view
    return view('kaprodi.dashboard_kp', compact('kaprodis', 'dosens'));
    }

    public function user1()
    {
        return view('user1');
    }

    public function user2()
    {
        return view('user2');
    }
    
}
