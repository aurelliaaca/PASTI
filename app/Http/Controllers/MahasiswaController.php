<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Support\Facades\Auth;
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

    // Menampilkan halaman dashboard mahasiswa
    public function index()
    {
        return view('dashboard_mhs');
    }

    // Menampilkan mata kuliah berdasarkan semester mahasiswa
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
        $semesterGanjil = $mahasiswa->smt % 2 != 0;

        // Ambil mata kuliah berdasarkan semester mahasiswa
        $matkul = $semesterGanjil
            ? Matkul::whereRaw('semester % 2 != 0')->get()  // Semester ganjil
            : Matkul::whereRaw('semester % 2 = 0')->get(); // Semester genap

        // Mengambil data jadwal berdasarkan kode mata kuliah yang sesuai
        $jadwalList = Jadwal_mata_kuliah::whereIn('kodemk', $matkul->pluck('kode'))->get();

        // Mengambil IPS terakhir dan menentukan SKS maksimal yang dapat diambil
        $ipsTerakhir = $mahasiswa->IPS_Sebelumnya;
        $sksMax = $this->getMaxSksByIps($ipsTerakhir);

        // Menghitung jumlah SKS yang sudah diambil oleh mahasiswa
        $sksTerpilih = Irs::where('nim', $mahasiswa->nim)
            ->where('smt', $mahasiswa->smt)
            ->join('jadwal_mata_kuliah', 'irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid')
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->sum('matakuliah.sks');

        // Mengambil data IRS mahasiswa
        $irsTable = Irs::join('jadwal_mata_kuliah', 'irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid')
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->where('irs.nim', $mahasiswa->nim)
            ->get();

        return view('mhs_pengisianirspage', compact('jadwalList', 'matkul', 'mahasiswa', 'sksMax', 'sksTerpilih', 'irsTable'));
    }

    // Mendapatkan SKS maksimal berdasarkan IPS
    private function getMaxSksByIps($ips)
    {
        if ($ips < 2.00) {
            return 7;
        } elseif ($ips >= 2.00 && $ips <= 2.49) {
            return 20;
        } elseif ($ips >= 2.50 && $ips <= 2.99) {
            return 22;
        } else {
            return 24;
        }
    }

    // Mendapatkan jadwal berdasarkan kode mata kuliah
    public function getJadwalByMatkul($kodeMk)
    {
        // Tentukan urutan hari yang benar
        $daysOrder = [
            'Senin' => 1,
            'Selasa' => 2,
            'Rabu' => 3,
            'Kamis' => 4,
            'Jumat' => 5,
            'Sabtu' => 6,
            'Minggu' => 7,
        ];

        // Ambil data jadwal berdasarkan kode mata kuliah
        $jadwal = Jadwal_mata_kuliah::with('matkul')
            ->where('kodemk', $kodeMk)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai') // Urutkan berdasarkan jam mulai setelah hari
            ->get();

        // Periksa apakah ada jadwal yang ditemukan
        if ($jadwal->isEmpty()) {
            return response()->json([], 404);  // Jika tidak ada jadwal, kembalikan array kosong
        }

        // Sort ulang data untuk memastikan setiap jadwal yang baru dipilih terurut kembali
        $jadwal = $jadwal->sortBy(function($item) use ($daysOrder) {
            // Tentukan urutan hari berdasarkan array $daysOrder
            return $daysOrder[$item->hari] . $item->jam_mulai; // Urutkan berdasarkan hari dan jam
        });

        // Kembalikan jadwal yang terurut
        return response()->json($jadwal->values()); // values() digunakan untuk reindexing collection
    }
    // Menyimpan data IRS (pengisian mata kuliah)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwalid' => 'required|integer',
            'nim' => 'required|string|max:14',
            'smt' => 'required|string',
        ]);

        $jadwal = Jadwal_mata_kuliah::where('jadwalid', $request->jadwalid)->first();

        // Cek jika jadwal tidak ditemukan
        if (!$jadwal) {
            return response()->json(['success' => false, 'message' => 'Jadwal tidak ditemukan.']);
        }

        $kodemk = $jadwal->kodemk;

        // Cek apakah mahasiswa sudah memilih jadwal dengan kodemk yang sama
        $existingIRS = Irs::where('nim', $request->nim)
            ->whereHas('jadwal', function ($query) use ($kodemk) {
                $query->where('kodemk', $kodemk);
            })
            ->exists();

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

    // Memeriksa apakah mahasiswa sudah memilih jadwal tertentu
    public function cekJadwal(Request $request)
{
    $request->validate([
        'nim' => 'required|string|max:14',
        'jadwalid' => 'required|integer',
    ]);

    try {
        $user = Auth::user();

        // Mengambil data mahasiswa berdasarkan email
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        // Periksa jika mahasiswa ditemukan
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan!');
        }

        $jadwal = Jadwal_mata_kuliah::where('jadwalid', $request->jadwalid)->first();

        // Jika jadwal tidak ditemukan
        if (!$jadwal) {
            return response()->json(['error' => 'Jadwal tidak valid.'], 400);
        }

        $kodemk = $jadwal->kodemk;

        // Cek apakah mahasiswa sudah memilih jadwal dengan kodemk yang sama
        $exists = Irs::where('nim', $request->nim)
            ->whereHas('jadwal', function ($query) use ($kodemk) {
                $query->where('kodemk', $kodemk);
            })
            ->exists();

        // Mengambil IPS terakhir dan menentukan SKS maksimal yang dapat diambil
        $ipsTerakhir = $mahasiswa->IPS_Sebelumnya;
        $sksMax = $this->getMaxSksByIps($ipsTerakhir);

        $sksTerpilih = Irs::where('nim', $mahasiswa->nim)
            ->where('smt', $mahasiswa->smt)
            ->join('jadwal_mata_kuliah', 'irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid')
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->sum('matakuliah.sks') ?? 0;

            $mataKuliahSks = Jadwal_mata_kuliah::join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->where('jadwal_mata_kuliah.jadwalid', $request->jadwalid)
            ->value('matakuliah.sks');
            
       // Cek apakah SKS yang ingin diambil melebihi batas
       if (($sksTerpilih + $mataKuliahSks) > $sksMax) {
        return response()->json([
            'error' => 'Total SKS melebihi batas beban SKS.',
            'sks_over_limit' => true // Kirimkan key ini jika SKS melebihi batas
        ], 400);
    }
        
        // Kembalikan response dengan informasi jadwal dan status SKS
        return response()->json([
            'exists' => $exists,
            'sks_over_limit' => false // Kirimkan false jika tidak melebihi batas SKS
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Terjadi kesalahan saat memeriksa jadwal.'], 500);
    }
}
}