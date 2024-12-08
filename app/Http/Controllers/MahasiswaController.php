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
        $sksMax = $this->getMaxSksByIps($ipsTerakhir, $mahasiswa->smt);

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

    
            
            $jadwalLain = Jadwal_mata_kuliah::whereIn('kodemk', $matkul->pluck('kode'))
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->select(
                'jadwal_mata_kuliah.kodemk',
                'matakuliah.nama',
                'matakuliah.semester',
                'matakuliah.sks',
                'jadwal_mata_kuliah.jam_mulai',
                'jadwal_mata_kuliah.kelas',
                'jadwal_mata_kuliah.hari',
                'jadwal_mata_kuliah.jadwalid',
                'jadwal_mata_kuliah.kuota',
                'matakuliah.status'
            )
            ->get();
        
    

        return view('mhs_pengisianirspage', compact('jadwalList', 'matkul', 'mahasiswa', 'sksMax', 'sksTerpilih', 'irsTable' ,'jadwalLain'));
    }


    // Mendapatkan SKS maksimal berdasarkan IPS
    private function getMaxSksByIps($ips, $semester)
    {
        // Kondisi khusus untuk semester 1
        if ($semester == 1) {
            return 20;
        }
        
        // Kondisi khusus untuk semester 2
        if ($semester == 2) {
            // Jika IPS semester 1 < 2.00, maka maksimal 18 SKS
            if ($ips < 2.00) {
                return 18;
            }
            return 20;
        }
        
        // Untuk semester > 2, gunakan aturan normal
        if ($ips < 2.00) {
            return 18;
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
    // Validasi input request
    $validated = $request->validate([
        'jadwalid' => 'required',
        'nim' => 'required',
        'smt' => 'required',
    ]);

    // Cek apakah jadwal dengan jadwalid tersebut ada
    $jadwal = Jadwal_mata_kuliah::where('jadwalid', $request->jadwalid)->first();
    if (!$jadwal) {
        return response()->json(['success' => false, 'message' => 'Jadwal tidak ditemukan.']);
    }

    // Ambil kodemk dari jadwal
    $kodemk = $jadwal->kodemk;

    // Cek apakah mahasiswa sudah memilih mata kuliah dengan kodemk yang sama
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

    // Tentukan nilai queue berdasarkan nilai terbesar yang ada di jadwalid yang sama
    $lastQueue = Irs::where('jadwalid', $request->jadwalid)
                    ->max('queue');

    $newQueue = $lastQueue ? $lastQueue + 1 : 1;  // Mulai dari 1 jika tidak ada antrean sebelumnya

    // Simpan data IRS ke tabel IRS
    $irs = Irs::create([
        'jadwalid' => $request->jadwalid,
        'nim' => $request->nim,
        'smt' => $request->smt,
        'queue' => $newQueue,  // Menambahkan antrean berdasarkan jadwalid
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
        'nim' => 'required',
        'jadwalid' => 'required',
    ]);

    try {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan!');
        }

        // Ambil informasi jadwal yang dipilih
        $jadwalBaru = Jadwal_mata_kuliah::where('jadwalid', $request->jadwalid)->first();
        if (!$jadwalBaru) {
            return response()->json(['error' => 'Jadwal tidak valid.'], 400);
        }

        // Cek apakah mahasiswa sudah memilih jadwal yang sama berdasarkan kodemk
        $exists = Irs::where('nim', $request->nim)
            ->whereHas('jadwal', function ($query) use ($jadwalBaru) {
                $query->where('kodemk', $jadwalBaru->kodemk);
            })
            ->exists();

        // Cek bentrok jadwal
        $jadwalBentrok = Irs::where('nim', $request->nim)
            ->where('smt', $mahasiswa->smt)
            ->whereHas('jadwal', function ($query) use ($jadwalBaru) {
                $query->where('hari', $jadwalBaru->hari)
                    ->where(function ($q) use ($jadwalBaru) {
                        $q->whereRaw("
                            (TIME(jam_mulai) <= TIME(?) AND TIME(jam_selesai) >= TIME(?))
                            OR (TIME(jam_mulai) <= TIME(?) AND TIME(jam_selesai) >= TIME(?))
                            OR (TIME(jam_mulai) >= TIME(?) AND TIME(jam_selesai) <= TIME(?))",
                            [
                                $jadwalBaru->jam_mulai,
                                $jadwalBaru->jam_mulai,
                                $jadwalBaru->jam_selesai,
                                $jadwalBaru->jam_selesai,
                                $jadwalBaru->jam_mulai,
                                $jadwalBaru->jam_selesai
                            ]
                        );
                    });
            })
            ->exists();

        // Cek SKS
        $ipsTerakhir = $mahasiswa->IPS_Sebelumnya;
        $sksMax = $this->getMaxSksByIps($ipsTerakhir, $mahasiswa->smt);
        $sksTerpilih = Irs::where('nim', $mahasiswa->nim)
            ->where('smt', $mahasiswa->smt)
            ->join('jadwal_mata_kuliah', 'irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid')
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->sum('matakuliah.sks') ?? 0;

        $mataKuliahSks = Jadwal_mata_kuliah::join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->where('jadwal_mata_kuliah.jadwalid', $request->jadwalid)
            ->value('matakuliah.sks');
        
        // Cek apakah total SKS yang dipilih melebihi batas
        if (($sksTerpilih + $mataKuliahSks) > $sksMax) {
            return response()->json([
                'error' => 'Total SKS melebihi batas beban SKS.',
                'sks_over_limit' => true,
                'jadwal_bentrok' => false,
                'max_sks' => $sksMax
            ], 400);
        }

        
        // **Cek Kuota**: Periksa kuota dari jadwal yang dipilih
        $kuotaJadwal = $jadwalBaru->kuota; // Kuota yang disediakan untuk jadwal ini (dari tabel Jadwal_mata_kuliah)
        
        // Ambil antrean terbesar untuk jadwal ini
        $lastQueue = Irs::where('jadwalid', $request->jadwalid)->max('queue');
        
        // Tentukan apakah kuota sudah penuh
        if ($lastQueue >= $kuotaJadwal) {
            return response()->json([
                'error' => 'Jadwal ini tidak dapat dipilih karena kuota sudah terpenuhi.',
                'kuota_habis' => true,
                'jadwal_bentrok' => false
            ], 400);
        }

        // Jika lolos semua pengecekan, kembalikan hasil pengecekan
        return response()->json([
            'exists' => $exists,
            'sks_over_limit' => false,
            'jadwal_bentrok' => $jadwalBentrok,
            'kuota_habis' => false
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Terjadi kesalahan saat memeriksa jadwal.',
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function hapusJadwal(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string',
            'jadwalid' => 'required|integer',
        ]);

        $mahasiswa = Mahasiswa::where('nim', $validated['nim'])->first();
        
        if (!$mahasiswa) {
            return response()->json(['success' => false, 'message' => 'Mahasiswa tidak ditemukan.']);
        }

        // Menghapus jadwal yang telah dipilih
        $mahasiswa->jadwals()->detach($validated['jadwalid']);

        return response()->json(['success' => true, 'message' => 'Jadwal berhasil dibatalkan.']);
    }
    public function ajukanSemuaIRS(Request $request)
{
    // Validasi hanya 'nim'
    $request->validate([
        'nim' => 'required',
    ]);

    try {
        // Ambil data user yang sedang login
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        // Cek jika mahasiswa tidak ditemukan
        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Mahasiswa tidak ditemukan!']);
        }

        // Ambil daftar IRS yang statusnya 'Belum disetujui' untuk mahasiswa ini
        $irsData = Irs::where('nim', $mahasiswa->nim)
            ->where('smt', $mahasiswa->smt)
            ->where('status_verifikasi', 'Belum disetujui')
            ->get();

        // Cek apakah ada IRS yang perlu diajukan
        if ($irsData->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Tidak ada IRS yang perlu diajukan.']);
        }

        // Update status IRS menjadi 'Diproses' dan tentukan nilai queue
        foreach ($irsData as $irs) {
            // // Tentukan nilai queue berdasarkan kombinasi jadwalid dan nim
            // $lastQueue = Irs::where('jadwalid', $irs->jadwalid)
            //                 ->max('queue');
            // $newQueue = $lastQueue ? $lastQueue + 1 : 1;

            // Lakukan update status dan queue dengan query builder, menggunakan kombinasi jadwalid dan nim
            Irs::where('jadwalid', $irs->jadwalid)
                ->where('nim', $irs->nim)
                ->where('smt', $irs->smt)
                ->update([
                    'status_verifikasi' => 'Diproses',
                    // 'queue' => $newQueue,
                ]);
        }

        return response()->json(['status' => 'success', 'message' => 'IRS berhasil diajukan dan status diupdate.']);
    } catch (\Exception $e) {
        // Tangani kesalahan jika ada
        return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengajukan IRS: ' . $e->getMessage()]);
    }
}

public function resetIrs(Request $request)
{
    // Validasi hanya 'nim' dan 'smt' yang diperlukan
    $request->validate([
        'nim' => 'required',
        'smt' => 'required',
    ]);

    try {
        // Ambil data user yang sedang login
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        // Cek jika mahasiswa tidak ditemukan
        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Mahasiswa tidak ditemukan!']);
        }
        // Hapus data IRS berdasarkan NIM dan semester
        $deleted = Irs::where('nim', $mahasiswa->nim)
            ->where('smt', $request->smt)
            ->delete();

        // Cek apakah ada IRS yang dihapus
        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Data IRS berhasil direset.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Tidak ada data IRS yang ditemukan untuk direset.']);
        }

    } catch (\Exception $e) {
        // Tangani kesalahan jika ada
        return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat mereset IRS: ' . $e->getMessage()]);
    }
}
    public function batalJadwal(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required',
            'jadwalid' => 'required',
            'smt' => 'required', 
        ]);

        try {
            // Hapus data IRS berdasarkan nim dan jadwalid
            $deleted = Irs::where('nim', $validated['nim'])
                ->where('jadwalid', $validated['jadwalid'])
                ->where('smt', $validated['smt'])
                ->delete();

            if ($deleted) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Jadwal berhasil dibatalkan.'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jadwal tidak ditemukan.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat membatalkan jadwal: ' . $e->getMessage()
            ]);
        }
    }
    public function cekStatusJadwal($jadwalId, $nim)
{
    $irs = IRS::where('nim', $nim)
             ->where('jadwalid', $jadwalId)
             ->first();

    $jadwal = Jadwal_mata_kuliah::find($jadwalId);
    $kodeMKTerpilih = IRS::where('nim', $nim)
                        ->whereHas('jadwal', function($query) use ($jadwal) {
                            $query->where('kodemk', $jadwal->kodemk);
                        })
                        ->exists();

    return response()->json([
        'terpilih' => $irs !== null,
        'kodeMKTerpilih' => $kodeMKTerpilih
    ]);
}

}