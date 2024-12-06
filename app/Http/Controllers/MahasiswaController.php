<?php
namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Support\Facades\Auth;  // Pastikan ini ada
use App\Models\Mahasiswa;
use App\Models\Irs;
use App\Models\User;
use App\Models\Jadwal_mata_kuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Menampilkan halaman dashboard mahasiswa
        return view('dashboard_mhs');
    }

    public function listMK(Request $request)
{
    $user = Auth::user();

    // Mengambil data mahasiswa berdasarkan email
    $mahasiswa = Mahasiswa::where('email', $user->email)->first();

    // Periksa jika mahasiswa ditemukan
    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan!');
    }

    // Menentukan apakah semester mahasiswa ganjil atau genap
    $semesterGanjil = $mahasiswa->smt % 2 != 0; // Jika smt ganjil (1, 3, 5,...)
    
    // Ambil mata kuliah berdasarkan semester yang sesuai dengan mahasiswa (ganjil/genap)
    if ($semesterGanjil) {
        // Jika semester mahasiswa ganjil, ambil mata kuliah untuk semester ganjil (smt % 2 != 0)
        $matkul = Matkul::whereRaw('semester % 2 != 0')->get();  // Semester ganjil
    } else {
        // Jika semester mahasiswa genap, ambil mata kuliah untuk semester genap (smt % 2 == 0)
        $matkul = Matkul::whereRaw('semester % 2 = 0')->get();  // Semester genap
    }

    // Mengambil data jadwal berdasarkan kode mata kuliah yang sesuai
    $jadwalList = Jadwal_mata_kuliah::whereIn('kodemk', $matkul->pluck('kode'))->get();

    // Mengirimkan data ke view
    return view('mhs_pengisianirspage', compact('jadwalList', 'matkul', 'mahasiswa'));
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

    // public function showBuatIRS()
    // {
    //     $matkul = Jadwal_mata_kuliah::all();  // Ambil semua mata kuliah yang tersedia
    //     return view('mhs_pengisianirspage', compact('matkul'));
    // }

    public function store(Request $request)
{
    $validated = $request->validate([
        'jadwalid' => 'required|string',
        'nim' => 'required|string|max:14',
        'smt' => 'required|string',
    ]);

    // Ambil jadwal berdasarkan jadwalid
    $jadwal = Jadwal_mata_kuliah::where('jadwalid', $request->jadwalid)->first();

    // Cek jika jadwal tidak ditemukan
    if (!$jadwal) {
        return response()->json(['success' => false, 'message' => 'Jadwal tidak ditemukan.']);
    }

    $kodemk = $jadwal->kodemk; // Ambil kodemk dari jadwal yang dipilih

    // Cek apakah mahasiswa sudah memilih jadwal dengan kodemk yang sama
    $existingIRS = Irs::where('nim', $request->nim)
        ->whereHas('jadwal', function ($query) use ($kodemk) {
            $query->where('kodemk', $kodemk);
        })
        ->exists();

    // Jika sudah ada jadwal dengan kodemk yang sama
    if ($existingIRS) {
        return response()->json([
            'success' => false,
            'message' => 'Anda sudah memilih mata kuliah dengan kode MK yang sama.',
        ]);
    }

    // Simpan jadwal ke tabel IRS
    $irs = Irs::create([
        'jadwalid' => $request->jadwalid,
        'nim' => $request->nim,
        'smt' => $request->smt,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Jadwal berhasil dipilih.',
        'data' => $irs,
    ]);
}

public function cekJadwal(Request $request)
{
    $request->validate([
        'nim' => 'required|string|max:14',
        'jadwalid' => 'required|string',
    ]);

    try {
        // Ambil jadwal yang dipilih berdasarkan jadwalid
        $jadwal = Jadwal_mata_kuliah::where('jadwalid', $request->jadwalid)->first();

        // Jika jadwal tidak ditemukan
        if (!$jadwal) {
            return response()->json(['error' => 'Jadwal tidak valid.'], 400);
        }

        // Ambil kodemk dari jadwal yang dipilih
        $kodemk = $jadwal->kodemk;

        // Cek apakah mahasiswa sudah memilih jadwal dengan kodemk yang sama
        $exists = Irs::where('nim', $request->nim)
            ->whereHas('jadwal', function ($query) use ($kodemk) {
                $query->where('kodemk', $kodemk); // Cek kodemk pada jadwal yang dipilih
            })
            ->exists();

        return response()->json(['exists' => $exists]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Terjadi kesalahan saat memeriksa jadwal.'], 500);
    }
}
}