<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\Irs;


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
        $mahasiswaperwalian = Mahasiswa::where('dosenwali', $dosenwali->nip)->get();
        return view('dosen.persetujuan', compact('mahasiswaperwalian'));

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

        // jumlahin sks yang dipilih
        // $jumlahsks = 

        // Tampilkan halaman IRS dengan data mahasiswa
        return view('dosen.irsmahasiswa', compact('mahasiswa'));

    }

    public function setujuiIRS(Request $request)
    {
        $nim = $request->nim;

        // Cari semua data IRS berdasarkan NIM
        $affectedRows = IRS::where('nim', $nim)->update([
            'status_verifikasi' => true, // Gunakan true untuk boolean
            'tanggal_disetujui' => now(), // Menambahkan tanggal persetujuan
        ]);

        // Jika tidak ada data IRS yang diperbarui
        if ($affectedRows === 0) {
            return redirect()->back()->with('error', 'Tidak ada IRS yang ditemukan untuk NIM tersebut.');
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', "Semua IRS untuk NIM $nim berhasil disetujui.");
    }

    public function tolakIRS(Request $request)
    {
        $nim = $request->nim;

        // Cari semua data IRS berdasarkan NIM
        $affectedRows = IRS::where('nim', $nim)->update([
            'status_verifikasi' => false, // Menandai belum disetujui
            'tanggal_disetujui' => null,  // Mengosongkan tanggal persetujuan
        ]);

        // Jika tidak ada data IRS yang diperbarui
        if ($affectedRows === 0) {
            return redirect()->back()->with('error', 'Tidak ada IRS yang ditemukan untuk NIM tersebut.');
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', "Semua IRS untuk NIM $nim berhasil ditolak.");
    }

    // public function index()
    // {
    //     $data = Mahasiswa::all(); // Mengambil semua data mahasiswa
    //     dd($data);
    //     return view('pa_perwalian', compact('data')); // Kirim ke view
    // }

    // public function index() {
    //     $data = Mahasiswa::all(); // Mengambil semua data mahasiswa
    //     return view('pa_perwalian', compact('data')); // Kirim ke view
    // }
    

}