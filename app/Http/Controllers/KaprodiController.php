<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Ruangan;
use App\Models\Dosen;
use App\Models\Jadwal_mata_kuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\PlottingRuang;
use App\Models\ProgramStudi;


class KaprodiController extends Controller
{
    public function index() {
        return view('user');
    }

    public function showPenjadwalanForm(Request $request)
    {
        $plottingRuang = PlottingRuang::where('status', 'sudah disetujui')->with('ruangan')->get();
        $jadwals = Jadwal_mata_kuliah::with(['plottingRuang.ruangan', 'matkul', 'koordinator', 'pengampu1', 'pengampu2'])->get();
        $matakuliah = Matkul::all();
        $dosen = Dosen::all();

        return view('kp_penjadwalan', compact('jadwals', 'plottingRuang', 'matakuliah', 'dosen'));
    }

    public function storeJadwal(Request $request)
    {
        try {
            $user = Auth::user();
            $dosen = $user->dosen;
            
            if (!$dosen) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akses ditolak. Anda harus login sebagai dosen!'
                ], 403);
            }

            $validatedData = $request->validate([
                'kodemk' => 'required|exists:matakuliah,kode',
                'sks' => 'required|integer',
                'semester' => 'required|string',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'ruang_id' => 'required|exists:plotting_ruang,id',
                'kuota' => 'required|integer',
                'hari' => 'required|string',
                'koordinator_nip' => 'required',
                'pengampu1_nip' => 'nullable',
                'pengampu2_nip' => 'nullable',
            ]);

            // Log untuk memastikan ruang_id yang diterima
            \Log::info('Ruang ID yang diterima:', ['ruang_id' => $request->ruang_id]);

            $kelasValue = substr($request->kelas, -1);

            $jadwalData = [
                'kodeprodi' => $dosen->kodeprodi,
                'kodemk' => $request->kodemk,
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'kelas' => $kelasValue,
                'ruang_id' => $request->ruang_id,
                'koordinator_nip' => $request->koordinator_nip,
                'pengampu1_nip' => $request->pengampu1_nip,
                'pengampu2_nip' => $request->pengampu2_nip,
                'kuota' => $request->kuota,
                'status' => 'belum disetujui',
            ];

            \Log::info('Data yang akan disimpan:', $jadwalData);

            $jadwal = Jadwal_mata_kuliah::create($jadwalData);

            return response()->json([
                'status' => 'success',
                'message' => 'Jadwal berhasil ditambahkan'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error dalam menyimpan jadwal:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan jadwal: ' . $e->getMessage()
            ], 500);
        }
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

    public function edit($id)
    {
        $jadwal = Jadwal_mata_kuliah::with('ruangan')->find($id);
        return response()->json($jadwal);
    }

    public function store(Request $request)
    {
        // Ambil dosen yang sedang login
        $dosen = Dosen::where('email', Auth::user()->email)->first();

        if (!$dosen || !$dosen->kodeprodi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dosen tidak memiliki kode prodi'
            ], 403);
        }

        // Validasi input
        $validatedData = $request->validate([
            'kodemk' => 'required|string|max:8',
            'hari' => 'required|string|max:6',
            'jam_mulai' => 'required|date_format:H:i',
            'kelas' => 'required|string|max:1',
            'ruang_id' => 'required|string|exists:ruangan,ruang',
            'koordinator_nip' => 'required|string|exists:dosen,nip',
            'pengampu1_nip' => 'nullable|string|exists:dosen,nip',
            'pengampu2_nip' => 'nullable|string|exists:dosen,nip',
            'kuota' => 'required|integer|min:1',
        ]);

        // Tambahkan kodeprodi dari dosen yang login
        $validatedData['kodeprodi'] = $dosen->kodeprodi;

        // Simpan data ke database
        $jadwal = Jadwal_mata_kuliah::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Data jadwal berhasil ditambahkan',
            'data' => $jadwal
        ]);
    }

    public function create()
    {
        // Ambil ruangan yang sudah disetujui
        $ruangs = PlottingRuang::where('status', 'Disetujui')->get();

        return view('kp_penjadwalan', compact('ruangs'));
    }
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
    





