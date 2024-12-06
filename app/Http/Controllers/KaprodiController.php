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

    public function showPenjadwalanForm()
    {
        $jadwals = Jadwal_mata_kuliah::with(['ruang', 'matkul', 'koordinator', 'pengampu1', 'pengampu2'])->get();
        $matakuliah = Matkul::all();
        $ruangs = Ruangan::all();
        $dosen = Dosen::all();

        return view('kp_penjadwalan', compact('jadwals', 'matakuliah', 'ruangs', 'dosen'));
    }

    public function storeJadwal(Request $request)
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Mendapatkan kodeprodi dari dosen yang terkait dengan user (Kaprodi)
        $kodeprodi = $user->dosen->kodeprodi;
        
        $validator = Validator::make($request->all(), [
            'mata_kuliah_kode' => 'required|exists:matakuliah,kode',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kelas' => 'required|string|max:5',
            'ruang_id' => 'required|exists:ruangs,id',
            'koordinator_nip' => 'required|exists:dosen,nip',
            'pengampu1_nip' => 'nullable|exists:dosen,nip',
            'pengampu2_nip' => 'nullable|exists:dosen,nip',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $jadwal = new Jadwal_mata_kuliah();
        $jadwal->mata_kuliah_kode = $request->mata_kuliah_kode;
        $jadwal->hari = $request->hari;
        $jadwal->jam_mulai = $request->jam_mulai;
        $jadwal->jam_selesai = $request->jam_selesai;
        $jadwal->kelas = $request->kelas;
        $jadwal->ruang_id = $request->ruang_id;
        $jadwal->koordinator_nip = $request->koordinator_nip;
        $jadwal->pengampu1_nip = $request->pengampu1_nip;
        $jadwal->pengampu2_nip = $request->pengampu2_nip;
        $jadwal->status = 'belum disetujui'; // Default status

        $jadwal->save();

        return response()->json(['message' => 'Jadwal berhasil ditambahkan']);
    }

    // public function buatJadwal(Request $request) {
    //     // Fetch all the matakuliah (courses)
    //     $matakuliah = Matkul::all();

    //     $dosen = Dosen::all();

    //     $ruang = Ruangan::all();

    //     // Pass matakuliah to the view
    //     return view('kp_penjadwalan', compact('matakuliah', 'dosen', 'ruang'));
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

    public function matkul(){
        // Mengambil semua data mata kuliah
        $matakuliah = Matkul::all();
        return view('kp_matakuliah', compact('matakuliah'));
    }

    public function storeMatkul(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:matakuliah,kode',
            'nama' => 'required',
            'semester' => 'required|numeric',
            'sks' => 'required|numeric',
            'status' => 'required|in:wajib,pilihan',
        ]);

        Matkul::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'status' => $request->status, // Status default, bisa disesuaikan
        ]);

        return response()->json(['success' => true]);
    }

    
    // Mengecek duplikasi berdasarkan kode atau nama
    public function checkDuplicateMK(Request $request)
    {
        $exists_kode = Matkul::where('kode', $request->kode)->exists();
        $exists_nama = Matkul::where('nama', $request->nama)->exists();

        return response()->json([
            'exists' => $exists_kode || $exists_nama,
            'exists_kode' => $exists_kode,
            'exists_nama' => $exists_nama
        ]);
    }
    // Mengupdate mata kuliah
    public function updateMK(Request $request, $kode)
    {
        $matakuliah = Matkul::findOrFail($kode);

        $matakuliah->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true]);
    }

    // Menghapus mata kuliah
    public function destroyMK($kode)
    {
        $matakuliah = Matkul::findOrFail($kode);
        $matakuliah->delete();

        return response()->json(['success' => true]);

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
    





