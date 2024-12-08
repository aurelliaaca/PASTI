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
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\DB;


class KaprodiController extends Controller
{
    public function index() {
        return view('user');
    }
    //INI ADALAH BAGIAN PENJADWALAN
    public function showPenjadwalanForm(Request $request)
    {
        $ruangan = Ruangan::where(['status' => 'sudah disetujui', 'namaprodi' =>'Informatika'])->get();
        $jadwals = Jadwal_mata_kuliah::with(['ruangan', 'matkul', 'koordinator', 'pengampu1', 'pengampu2'])->get();
        $matakuliah = Matkul::all();
        $dosen = Dosen::all();

        return view('kp_penjadwalan', compact('jadwals', 'ruangan', 'matakuliah', 'dosen'));
    }

    public function store(Request $request)
    {
        try {
            // Log request data
            \Log::info('Request data:', $request->all());

            $user = Auth::user();
            $dosen = $user->dosen;
            
            if (!$dosen) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akses ditolak. Anda harus login sebagai dosen!'
                ], 403);
            }

            // Validasi dasar
            $validatedData = $request->validate([
                'kodemk' => 'required|exists:matakuliah,kode',
                'hari' => 'required|string',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'kelas' => 'required|string',
                'namaruang' => 'required|exists:ruangan,namaruang',
                'koordinator_nip' => 'required|exists:dosen,nip',
                'kuota' => 'required|integer',
            ]);

            // Pengecekan duplikasi jadwal
            $exists = Jadwal_mata_kuliah::where('kodemk', $request->kodemk)
                ->where('kelas', $request->kelas)
                ->exists();

            if ($exists) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jadwal dengan Kode MK dan Kelas ini sudah ada.'
                ], 422);
            }

            // Pengecekan irisan jadwal mata kuliah wajib
            $irisan = Jadwal_mata_kuliah::where('kelas', $request->kelas)
                ->where('hari', $request->hari)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                        ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                        ->orWhere(function ($subQuery) use ($request) {
                            $subQuery->where('jam_mulai', '<=', $request->jam_mulai)
                                ->where('jam_selesai', '>=', $request->jam_selesai);
                        });
                })
                ->exists();

            if ($irisan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jadwal bentrok dengan Mata Kuliah Wajib yang lain!'
                ], 422);
            }

            // Jika tidak ada duplikasi dan irisan, lanjutkan menyimpan data
            $kelasValue = substr($request->kelas, -1);

            $jadwalData = [
                'kodeprodi' => $dosen->kodeprodi,
                'kodemk' => $request->kodemk,
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'kelas' => $kelasValue,
                'namaruang' => $request->namaruang,
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

    public function ajukanSemuaJadwal()
    {
        try {
            $user = Auth::user();
            $dosen = $user->dosen;

            if (!$dosen) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akses ditolak!'
                ], 403);
            }

            // Update semua jadwal yang belum disetujui menjadi diproses
            Jadwal_mata_kuliah::where('kodeprodi', $dosen->kodeprodi)
                ->where('status', 'belum disetujui')
                ->update(['status' => 'menunggu persetujuan']);

            return response()->json([
                'status' => 'success',
                'message' => 'Semua jadwal berhasil diajukan'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error dalam mengajukan jadwal:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengajukan jadwal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyJadwal($jadwalid)
    {
        try {
            $jadwal = Jadwal_mata_kuliah::findOrFail($jadwalid);
            $jadwal->delete();

            return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus jadwal.');
        }
    }

    // Tambahkan method untuk edit dan update
    public function edit($jadwalid)
    {
        try {
            $jadwal = Jadwal_mata_kuliah::with(['matkul', 'koordinator', 'pengampu1', 'pengampu2'])
                ->findOrFail($jadwalid);
            return response()->json($jadwal);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ], 404);
        }
    }
    public function update(Request $request, $jadwalid)
    {
        try {
            $jadwal = Jadwal_mata_kuliah::findOrFail($jadwalid);

            // Cek duplikasi (kecuali jadwal yang sedang diedit)
            $duplikat = Jadwal_mata_kuliah::where('jadwalid', '!=', $jadwalid)
                ->where('kodemk', $request->kodemk)
                ->where('kelas', $request->kelas)
                ->exists();

            if ($duplikat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Mata kuliah dengan kelas ini sudah ada!'
                ], 422);
            }

            // Pengecekan irisan jadwal (bentrok)
            $irisan = Jadwal_mata_kuliah::where('jadwalid', '!=', $jadwalid)
                ->where(function ($query) use ($request) {
                    $query->where('kelas', $request->kelas)
                        ->orWhere('namaruang', $request->namaruang);
                })
                ->where('hari', $request->hari)
                ->where(function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where('jam_mulai', '<=', $request->jam_mulai)
                          ->where('jam_selesai', '>', $request->jam_mulai);
                    })
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<', $request->jam_selesai)
                          ->where('jam_selesai', '>=', $request->jam_selesai);
                    })
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '>=', $request->jam_mulai)
                          ->where('jam_selesai', '<=', $request->jam_selesai);
                    });
                })
                ->exists();

            if ($irisan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jadwal bentrok! Terdapat jadwal lain yang menggunakan ruangan atau kelas yang sama pada waktu tersebut.'
                ], 422);
            }

            // Jika tidak ada duplikasi dan bentrok, update data
            $jadwal->update([
                'kodemk' => $request->kodemk,
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'kelas' => $request->kelas,
                'namaruang' => $request->namaruang,
                'koordinator_nip' => $request->koordinator_nip,
                'pengampu1_nip' => $request->pengampu1_nip,
                'pengampu2_nip' => $request->pengampu2_nip,
                'kuota' => $request->kuota,
                'status' => 'belum disetujui'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Jadwal berhasil diperbarui',
                'data' => $jadwal
            ]);

        } catch (\Exception $e) {
            \Log::error('Error dalam memperbarui jadwal:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui jadwal: ' . $e->getMessage()
            ], 500);
        }
    }

    //INI ADALAH BAGIAN MATA KULIAH
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

}