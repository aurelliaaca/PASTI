<?php
namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Support\Facades\Auth;  // Pastikan ini ada
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Jadwal_mata_kuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Menampilkan halaman dashboard mahasiswa
        return view('dashboard_mhs');
    }

    public function listMK(Request $request)
    {
        $user = Auth::user();

        // Mengambil seluruh data jadwal dan mata kuliah
        $mahasiswas = Mahasiswa::where('email', $user->email)->get(); // Pastikan ada kolom 'user_id' di tabel mahasiswa
        $users = User::all();
        $jadwalList = Jadwal_mata_kuliah::all();
        $matkul = Matkul::all();  // Daftar mata kuliah

        // Mengirimkan data jadwal dan mata kuliah ke view
        return view('mhs_pengisianirspage', compact('jadwalList', 'matkul', 'mahasiswas'));
    }

    // Mendapatkan jadwal berdasarkan kode mata kuliah yang dipilih
    public function getJadwalByMatkul($kodeMk)
    {
        // Ambil data jadwal berdasarkan kode mata kuliah
        $jadwal = Jadwal_mata_kuliah::with('matkul')
            ->where('kodemk', $kodeMk)
            ->get();

        // Periksa apakah ada jadwal yang ditemukan
        if ($jadwal->isEmpty()) {
            return response()->json([], 404);  // Jika tidak ada jadwal, kembalikan array kosong
        }

        // Tidak perlu urutan hari, kembalikan jadwal langsung
        return response()->json($jadwal);
    }

    public function showBuatIRS()
    {
        $matkul = Jadwal_mata_kuliah::all();  // Ambil semua mata kuliah yang tersedia
        return view('mhs_pengisianirspage', compact('matkul'));
    }
}
