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
    // public function store(Request $request)
    // {
    //     // Debug data yang diterima (jika diperlukan)
    //     // dd($request->all());
    
    //     // Mendapatkan user yang sedang login
    //     $user = Auth::user();
    
    //     // Cari data mahasiswa berdasarkan email pengguna yang sedang login
    //     $mahasiswa = Mahasiswa::where('email', $user->email)->first();
    
    //     // Periksa jika mahasiswa tidak ditemukan
    //     if (!$mahasiswa) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Data mahasiswa tidak ditemukan.'
    //         ]);
    //     }
    
    //     // Validasi data
    //     $validated = $request->validate([
    //         'jadwalid' => 'required|string',
    //         'nim' => 'required|string|max:14',
    //         'smt' => 'required|string',
    //     ]);
    
    //     // Simpan data ke database
    //     $irs = Irs::create([
    //         'jadwalid' => $request->jadwalid,
    //         'nim' => $request->nim, // Gunakan nim dari tabel mahasiswa
    //         'smt' => $request->smt,    // Ambil smt dari request
    //     ]);
    
    //     // Mengembalikan response JSON untuk AJAX
    //     return response()->json([
    //         'success' => true,
    //         'is_edit' => false, // Menandakan bahwa ini adalah create, bukan edit
    //         'data' => $irs
    //     ]);
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

//     public function cekJadwal(Request $request)
// {
//     // Validasi data yang masuk
//     $request->validate([
//         'nim' => 'required|string|max:14',  // Validasi nim sebagai string dengan panjang 14 karakter
//         'jadwalid' => 'required|string',     // Validasi jadwalid sebagai string
//     ]);

//     try {
//         // Periksa apakah jadwal sudah dipilih oleh mahasiswa dengan NIM yang sama
//         $exists = Irs::where('nim', $request->nim)
//             ->where('jadwalid', $request->jadwalid)
//             ->exists();

//         // Kembalikan hasil dalam bentuk JSON
//         return response()->json(['exists' => $exists]);
//     } catch (\Exception $e) {
//         // Tangani kesalahan dan kembalikan response error
//         return response()->json(['error' => 'Terjadi kesalahan saat memeriksa jadwal'], 500);
//     }
// }

// public function cekJadwal(Request $request)
// {
//     // Validate the incoming data
//     $request->validate([
//         'nim' => 'required|string|max:14', // Validate nim as string with max length 14
//         'jadwalid' => 'required|string',   // Validate jadwalid as string
//     ]);

//     try {
//         // Check if the student (nim) already selected the schedule (jadwalid)
//         $exists = Irs::where('nim', $request->nim)
//             ->where('jadwalid', $request->jadwalid)
//             ->exists();

//         // Return the result in JSON format
//         return response()->json(['exists' => $exists]);
//     } catch (\Exception $e) {
//         // Handle any errors and return a 500 response
//         return response()->json(['error' => 'An error occurred while checking the schedule.'], 500);
//     }
// }
// public function cekJadwal(Request $request)
// {
//     // Validasi input nim dan jadwalid
//     $request->validate([
//         'nim' => 'required|string|max:14',
//         'jadwalid' => 'required|string',
//     ]);

//     try {
//         // Mengecek apakah mahasiswa dengan NIM sudah memilih jadwal tertentu
//         $exists = Irs::where('nim', $request->nim)
//             ->where('jadwalid', $request->jadwalid)
//             ->exists();

//         // Mengirimkan respon dalam bentuk JSON
//         return response()->json(['exists' => $exists]);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Terjadi kesalahan saat memeriksa jadwal.'], 500);
//     }
// }
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