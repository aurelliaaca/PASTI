<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Irs;
use App\Models\histori_irs;
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

    // Menampilkan data mata kuliah, jadwal, dan IRS
    public function listMK(Request $request)
    {
        $user = Auth::user();

        // Mengambil data mahasiswa berdasarkan email
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan!');
        }
        $semesterGanjil = $mahasiswa->smt % 2 != 0;
        $matkul = $semesterGanjil
            ? Matkul::whereRaw('semester % 2 != 0')->get()  // Semester ganjil
            : Matkul::whereRaw('semester % 2 = 0')->get(); // Semester genap

        $ipsTerakhir = $mahasiswa->IPS_Sebelumnya;

        // data sks maksimal
        $sksMax = $this->getMaxSksByIps($ipsTerakhir, $mahasiswa->smt);

        // data sks terpilih
        $sksTerpilih = Irs::where('nim', $mahasiswa->nim)
            ->where('smt', $mahasiswa->smt)
            ->join('jadwal_mata_kuliah', 'irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid')
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->sum('matakuliah.sks');

        // data irs
        $irsTable = Irs::join('jadwal_mata_kuliah', 'irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid')
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->where('irs.nim', $mahasiswa->nim)
            ->get();
            
        // data jadwal 
        $jadwal = Jadwal_mata_kuliah::whereIn('kodemk', $matkul->pluck('kode'))
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->where('jadwal_mata_kuliah.status', 'sudah disetujui')
            ->select(
                'jadwal_mata_kuliah.kodemk',
                'matakuliah.nama',
                'matakuliah.semester',
                'matakuliah.sks',
                'jadwal_mata_kuliah.jam_mulai',
                'jadwal_mata_kuliah.jam_selesai',
                'jadwal_mata_kuliah.kelas',
                'jadwal_mata_kuliah.hari',
                'jadwal_mata_kuliah.jadwalid',
                'jadwal_mata_kuliah.kuota',
                'matakuliah.status'
            )
            ->orderBy('jadwal_mata_kuliah.hari')
            ->orderBy('jadwal_mata_kuliah.jam_mulai')
            ->get();

        $myIrs = histori_irs::join('jadwal_mata_kuliah', 'histori_irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid')
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->where('histori_irs.nim', $mahasiswa->nim)
            ->where('histori_irs.status_verifikasi', 'Sudah disetujui')
            ->get();

        $irsBySemester = $myIrs->groupBy('smt');
                
        return view('mhs_pengisianirspage', compact( 'matkul', 'mahasiswa', 'sksMax', 'sksTerpilih', 'irsTable' ,'jadwal', 'myIrs', 'irsBySemester'));
    }


        // data sks maksimal
    private function getMaxSksByIps($ips, $semester)
    {
        // kondisi semester 1
        if ($semester == 1) {
            return 20;
        }
        
        // kondisi semester 2
        if ($semester == 2) {
            if ($ips < 2.00) {
                return 18;
            }
            return 20;
        }
        
        // kondisi normal
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

    // menyimpan data IRS (pengisian mata kuliah)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwalid' => 'required',
            'nim' => 'required',
            'smt' => 'required',
        ]);

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

            // inisialisasi jadwal yang dipilih
            $jadwalBaru = Jadwal_mata_kuliah::where('jadwalid', $request->jadwalid)->first();
            if (!$jadwalBaru) {
                return response()->json(['error' => 'Jadwal tidak valid.'], 400);
            }

            // mengecek jadwal uang dipilih apakah sudah ada di database menggunakan kodemk
            $exists = Irs::where('nim', $request->nim)
                ->whereHas('jadwal', function ($query) use ($jadwalBaru) {
                    $query->where('kodemk', $jadwalBaru->kodemk);
                })
                ->exists();

            // mengecek jadwal yang dipilih apakah bentrok dengan jadwal yang sudah dipilih
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

            // jumlah sks yang sudah dipilih
            $ipsTerakhir = $mahasiswa->IPS_Sebelumnya;
            $sksMax = $this->getMaxSksByIps($ipsTerakhir, $mahasiswa->smt);
            $sksTerpilih = Irs::where('nim', $mahasiswa->nim)
                ->where('smt', $mahasiswa->smt)
                ->join('jadwal_mata_kuliah', 'irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid')
                ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
                ->sum('matakuliah.sks') ?? 0;

            // jumlah sks yang akan dipilih
            $mataKuliahSks = Jadwal_mata_kuliah::join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
                ->where('jadwal_mata_kuliah.jadwalid', $request->jadwalid)
                ->value('matakuliah.sks');
            
            // mengecek apakah total sks yang dipilih melebihi batas
            if (($sksTerpilih + $mataKuliahSks) > $sksMax) {
                return response()->json([
                    'error' => 'Anda sudah melebihi batas SKS yang dapat diambil.',
                    'sks_over_limit' => true,
                    'jadwal_bentrok' => false,
                    'max_sks' => $sksMax
                ], 400);
            }

            // inisialisasi kuota dari jadwal yang dipilih
            $kuotaJadwal = $jadwalBaru->kuota; 
            
            // menghitung jumlah antrean untuk jadwal ini
            $lastQueue = Irs::where('jadwalid', $request->jadwalid)->count();
            
            // mengecek apakah kuota sudah penuh
            if ($lastQueue >= $kuotaJadwal) {
                return response()->json([
                    'error' => 'Jadwal ini tidak dapat dipilih karena kuota sudah terpenuhi.',
                    'kuota_habis' => true,
                    'jadwal_bentrok' => false
                ], 400);
            }

            // jika lolos semua pengecekan, kembalikan hasil pengecekan
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
        $mahasiswa->jadwals()->detach($validated['jadwalid']);
        return response()->json(['success' => true, 'message' => 'Jadwal berhasil dibatalkan.']);
    }

    public function ajukanSemuaIRS(Request $request)
    {
        $request->validate([
            'nim' => 'required',
        ]);

        try {
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where('email', $user->email)->first();

            if (!$mahasiswa) {
                return response()->json(['status' => 'error', 'message' => 'Mahasiswa tidak ditemukan!']);
            }

            $irsData = Irs::where('nim', $mahasiswa->nim)
                ->where('smt', $mahasiswa->smt)
                ->where('status_verifikasi', 'Belum disetujui')
                ->get();

            if ($irsData->isEmpty()) {
                return response()->json(['status' => 'error', 'message' => 'Tidak ada IRS yang perlu diajukan.']);
            }
            foreach ($irsData as $irs) {
                // // queue berdasarkan pengajuan
                // $lastQueue = Irs::where('jadwalid', $irs->jadwalid)
                //                 ->max('queue');
                // $newQueue = $lastQueue ? $lastQueue + 1 : 1;

                // update status IRS menjadi diproses
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


    public function perubahanSemuaIRS(Request $request)
    {
        $request->validate([
            'nim' => 'required',
        ]);

        try {
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where('email', $user->email)->first();

            if (!$mahasiswa) {
                return response()->json(['status' => 'error', 'message' => 'Mahasiswa tidak ditemukan!']);
            }

            $irsData = Irs::where('nim', $mahasiswa->nim)
                ->where('smt', $mahasiswa->smt)
                ->where('status_verifikasi', 'Sudah disetujui')
                ->get();

            if ($irsData->isEmpty()) {
                return response()->json(['status' => 'error', 'message' => 'Tidak dapat mengajukan perubahan IRS.']);
            }
            foreach ($irsData as $irs) {
                // // queue berdasarkan pengajuan
                // $lastQueue = Irs::where('jadwalid', $irs->jadwalid)
                //                 ->max('queue');
                // $newQueue = $lastQueue ? $lastQueue + 1 : 1;

                // update status IRS menjadi diproses
                Irs::where('jadwalid', $irs->jadwalid)
                    ->where('nim', $irs->nim)
                    ->where('smt', $irs->smt)
                    ->update([
                        'status_verifikasi' => 'Mengajukan perubahan',
                        // 'queue' => $newQueue,
                    ]);
            }
            return response()->json(['status' => 'success', 'message' => 'Perubahan IRS berhasil diajukan dan status diupdate.']);
        } catch (\Exception $e) {
            // Tangani kesalahan jika ada
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengajukan IRS: ' . $e->getMessage()]);
        }
    }


    public function resetIrs(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'smt' => 'required',
        ]);
        try {
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where('email', $user->email)->first();

            if (!$mahasiswa) {
                return response()->json(['status' => 'error', 'message' => 'Mahasiswa tidak ditemukan!']);
            }
            // menghapus data IRS berdasarkan nim dan smt saat ini
            $deleted = Irs::where('nim', $mahasiswa->nim)
                ->where('smt', $request->smt)
                ->delete();

            if ($deleted) {
                return response()->json(['status' => 'success', 'message' => 'Data IRS berhasil direset.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Tidak ada data IRS yang ditemukan untuk direset.']);
            }

        } catch (\Exception $e) {
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
            // menghapus data jadwal yang dipilih berdasarkan nim dan smt saat ini
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

    // mengecek status jadwal
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