<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Ruangan;
use App\Models\Dosen;
use App\Models\Jadwal_mata_kuliah;


class KaprodiController extends Controller
{
    public function index() {
        return view('user');
    }

    public function listMK(Request $request) {
        // Fetch all the matakuliah (courses)
        $matakuliah = Matkul::all();

        $dosen = Dosen::all();


        // Pass matakuliah to the view
        return view('kp_penjadwalan', compact('matakuliah', 'dosen'));
    }

    public function getMatkul($kode) {
        // Ambil data matakuliah berdasarkan kode yang dipilih
        $matakuliah = Matkul::where('kode', $kode)->first();
        
        // Jika matakuliah ditemukan, kirimkan data sebagai response JSON
        if ($matakuliah) {
            return response()->json([
                'kode' => $matakuliah->kode,
                'sks' => $matakuliah->sks,
                'semester' => $matakuliah->semester,
            ]);
        }
    
        // Jika tidak ditemukan, kirimkan response kosong
        return response()->json([]);
    }

    
    // public function getDosen() {
    //     // Ambil data matakuliah berdasarkan kode yang dipilih
    //     $dosen = Dosen::all();
    //     return view('kp_penjadwalan', compact('dosen'));
    // }
}
// class KaprodiController extends Controller
// {


//     // Menampilkan form penjadwalan
//     public function penjadwalan()
//     {
//         // Mengambil data dari model (tabel yang terkait)
//         $matakuliah = Matkul::all();
//         $ruangan = Ruangan::all();
//         $dosen = Dosen::all();

//         // Return form untuk membuat jadwal
//         return view('kp_penjadwalan', compact('matakuliah', 'ruangan', 'dosen'));
//     }

//     // Menyimpan jadwal baru
//     public function store(Request $request)
//     {
//         // Validasi data
//         $request->validate([
//             'namaMk' => 'required',
//             'kodeMk' => 'required',
//             'sksMk' => 'required|integer',
//             'semesterMk' => 'required|integer',
//             'kelasMk' => 'required',
//             'ruangKls' => 'required',
//             'jamMulai' => 'required|date_format:H:i',
//             'jamSelesai' => 'required|date_format:H:i',
//             'hari' => 'required',
//             'dosenSelect' => 'required|array|min:1|max:3',
//         ]);

//         // Menyimpan data ke dalam tabel jadwal_mata_kuliah
//         Jadwal_mata_kuliah::create([
//             'jadwalid' => uniqid('JDK'), // Membuat ID unik
//             'kodemk' => $request->kodeMk,
//             'jam_mulai' => $request->jamMulai,
//             'jam_selesai' => $request->jamSelesai,
//             'ruangan' => $request->ruangKls,
//             'kelas' => $request->kelasMk,
//             'hari' => $request->hari,
//             'semester' => $request->semesterMk,
//             'kuota' => 30, // Misalnya kuota tetap
//             'koordinator' => $request->dosenSelect[0], // Dosen pertama sebagai koordinator
//             'pengampu1' => $request->dosenSelect[1] ?? null, // Dosen kedua (optional)
//             'pengampu2' => $request->dosenSelect[2] ?? null, // Dosen ketiga (optional)
//         ]);

//         // Redirect atau memberikan notifikasi sukses
//         return redirect()->route('penjadwalan.create')->with('success', 'Jadwal berhasil ditambahkan!');
//     }

//     // Menampilkan daftar jadwal (opsional)
//     public function index()
//     {
//         $jadwals = Jadwal_mata_kuliah::all();
//         return view('kp_penjadwalan', compact('jadwals'));
//     }
// }


// class KaprodiController extends Controller
// {
//     public function index() {
//         return view('user');
//     }

  

    // public function listMK(Request $request) {
    //     // Fetch all the matakuliah (courses)
    //     $matakuliah = Matkul::all();

    //     // Pass matakuliah to the view
    //     return view('kp_penjadwalan', compact('matakuliah'));
    // }

    // public function getMatkul($kode) {
    //     // Ambil data matakuliah berdasarkan kode yang dipilih
    //     $matakuliah = Matkul::where('kode', $kode)->first();
        
    //     // Jika matakuliah ditemukan, kirimkan data sebagai response JSON
    //     if ($matakuliah) {
    //         return response()->json([
    //             'kode' => $matakuliah->kode,
    //             'sks' => $matakuliah->sks,
    //             'semester' => $matakuliah->semester,
    //         ]);
    //     }
    
    //     // Jika tidak ditemukan, kirimkan response kosong
    //     return response()->json([]);
    // }
    





