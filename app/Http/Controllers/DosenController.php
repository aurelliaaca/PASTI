<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\Irs;
use App\Models\Jadwal_mata_kuliah;
use App\Models\Matkul;

class DosenController extends Controller
{


    public function index(){
        return view('dashboard_dosen');
    }

    public function showPerwalian()
    {
        $useremail = Auth::user()->email;
        $dosenwali = Dosen::where('email',$useremail)->first();
        $mahasiswaperwalian = Mahasiswa::where('dosenwali', $dosenwali->nip)->get();
        return view('dosen.perwalian', compact('mahasiswaperwalian'));
    }

    public function showPersetujuanIRS()
    {
        $useremail = Auth::user()->email;
        $dosenwali = Dosen::where('email',$useremail)->first();
        $mahasiswaperwalian = Mahasiswa::join('Irs', 'mahasiswa.nim', '=', 'irs.nim')
        ->where('dosenwali', $dosenwali->nip)
        ->select('mahasiswa.*', 'status_verifikasi as status')
        ->get();

        return view('dosen.persetujuan', compact('mahasiswaperwalian'));
    }

    // Mendapatkan SKS maksimal berdasarkan IPS
    private function getMaxSksByIps($ips)
    {
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

    public function showIRSMahasiswa(Request $request)
    {
        // Ambil NIM dari URL
        $nim = $request->nim;

        // Cari data mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        // Jika mahasiswa tidak ditemukan, kembalikan error 404
        if (!$mahasiswa) {
            abort(404, 'Mahasiswa not found');
        }

        // Ambil data IRS yang diajukan oleh mahasiswa beserta relasi Jadwal
        $irs = Irs::join('jadwal_mata_kuliah', 'irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid') // yang ini harus disesuaiin lagi
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->where('irs.nim', $nim)
            ->select('Irs.*', 'matakuliah.kode as kodemk', 'matakuliah.nama as namamk', 'jadwal_mata_kuliah.kelas as kelas', 
            'jadwal_mata_kuliah.hari as hari', 'jadwal_mata_kuliah.jam_mulai as start', 'jadwal_mata_kuliah.jam_selesai as finish', 'matakuliah.sks as sks')
            ->get();

        // Mengambil IPS terakhir dan menentukan SKS maksimal yang dapat diambil
        $ipsTerakhir = $mahasiswa->IPS_Sebelumnya;
        $sksMax = $this->getMaxSksByIps($ipsTerakhir);

        // Menghitung jumlah SKS yang sudah diambil oleh mahasiswa
        $sksTerpilih = Irs::where('nim', $mahasiswa->nim)
            ->where('smt', $mahasiswa->smt)
            ->join('jadwal_mata_kuliah', 'irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid') //id nanti ganti jadwalid
            ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
            ->sum('matakuliah.sks');

        // Tampilkan halaman IRS dengan data mahasiswa
        return view('dosen.irsmahasiswa', compact('mahasiswa', 'irs', 'sksTerpilih', 'sksMax'));

    }

    public function setujuiIRS(Request $request)
    {
        $nim = $request->nim;

        // Cari semua data IRS berdasarkan NIM
        $affectedRows = IRS::where('nim', $nim)->update([
            'status_verifikasi' => 'Sudah disetujui', // 'Belum disetujui', 'Diproses', 'Sudah disetujui'
            'tanggal_disetujui' => now(),  
        ]);

        // Jika tidak ada data IRS yang diperbarui
        if ($affectedRows === 0) {
            return redirect()->back()->with('error', 'Tidak ada IRS yang ditemukan untuk NIM tersebut.');
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', "Semua IRS untuk NIM $nim berhasil disetujui");
    }


    public function tolakIRS(Request $request)
    {
        $nim = $request->nim;

        // Cari semua data IRS berdasarkan NIM
        $affectedRows = IRS::where('nim', $nim)->update([
            'status_verifikasi' => 'Belum disetujui', // 'Belum disetujui', 'Diproses', 'Sudah disetujui'
            'tanggal_disetujui' => null,  // Mengosongkan tanggal persetujuan
        ]);

        // Jika tidak ada data IRS yang diperbarui
        if ($affectedRows === 0) {
            return redirect()->back()->with('error', 'Tidak ada IRS yang ditemukan untuk NIM tersebut.');
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', "Semua IRS untuk NIM $nim berhasil ditolak.");
    }

    public function setujuiSemuaIRS(Request $request)
    {
        $useremail = Auth::user()->email;
        $dosenwali = Dosen::where('email', $useremail)->first();
    
        if (!$dosenwali) {
            return redirect()->back()->with('error', 'Dosen tidak ditemukan.');
        }
    
        try {
            // Ambil daftar NIM mahasiswa yang dibimbing oleh dosen wali ini
            $nimwali = Mahasiswa::where('dosenwali', $dosenwali->nip)->pluck('nim');
    
            // Update status IRS hanya untuk mahasiswa yang termasuk dalam daftar NIM wali
            Irs::whereIn('nim', $nimwali)
                ->update([
                    'status_verifikasi' => 'Sudah disetujui',
                    'tanggal_disetujui' => now(),
                ]);
    
            return redirect()->back()->with('success', 'Semua IRS telah disetujui untuk mahasiswa di bawah bimbingan Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui IRS.');
        }
    }
    
    
    public function resetIRS(Request $request){
        $useremail = Auth::user()->email;
        $dosenwali = Dosen::where('email', $useremail)->first();
    
        if (!$dosenwali) {
            return redirect()->back()->with('error', 'Dosen tidak ditemukan.');
        }
    
        try {
            // Ambil daftar NIM mahasiswa yang dibimbing oleh dosen wali ini
            $nimwali = Mahasiswa::where('dosenwali', $dosenwali->nip)->pluck('nim');
    
            // Update status IRS hanya untuk mahasiswa yang termasuk dalam daftar NIM wali
            Irs::whereIn('nim', $nimwali)
                ->update([
                    'status_verifikasi' => 'Belum disetujui',
                    'tanggal_disetujui' => now(),
                ]);
    
            return redirect()->back()->with('success', 'Semua IRS telah direset untuk mahasiswa di bawah bimbingan Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mereset IRS.');
        }
    }
}