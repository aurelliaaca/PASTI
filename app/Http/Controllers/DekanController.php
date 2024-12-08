<?php

namespace App\Http\Controllers;


use App\Models\Prodi;
use App\Models\Jadwal_mata_kuliah;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DekanController extends Controller
{
    public function showPersetujuan()
    {
        $ruangans = Ruangan::where('is_plotted', true)
            ->whereIn('status', ['belum disetujui', 'sudah disetujui'])
            ->get();

        $ruanganByProdi = $ruangans->groupBy('namaprodi');

        return view('dekan.persetujuanruangan', compact('ruanganByProdi'));
    }

    public function showJadwal()
    {
        $prodis = Prodi::all();
        $jadwals = Jadwal_mata_kuliah::with(['prodi', 'matkul', 'ruangan', 'koordinator'])->get();

        $jadwalByProdi = [];
        foreach ($jadwals as $jadwal) {
            $jadwalByProdi[$jadwal->kodeprodi][] = $jadwal;
        }

        return view('dekan.persetujuanjadwal', compact('prodis', 'jadwalByProdi'));
    }

    public function approveAllRooms(Request $request)
    {
        $namaprodi = $request->namaprodi;

        // Cari semua ruangan berdasarkan namaprodi yang belum disetujui dan is_plotted = true
        $affectedRows = Ruangan::where('namaprodi', $namaprodi)
            ->where('status', 'belum disetujui') // Pastikan hanya yang belum disetujui
            ->where('is_plotted', true) // Pastikan is_plotted bernilai true
            ->update([
                'status' => 'sudah disetujui', // Ubah status menjadi sudah disetujui
                'tanggal_disetujui' => now() // Menambahkan tanggal persetujuan
            ]);

        // Jika tidak ada data yang diperbarui
        if ($affectedRows === 0) {
            return redirect()->back()->with('error', 'Tidak ada ruangan yang ditemukan untuk prodi tersebut.');
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', "Semua ruangan untuk prodi $namaprodi berhasil disetujui.");
    }

    public function approveAllJadwal(Request $request)
    {
        $kodeprodi = $request->kodeprodi;

        // Debugging: Cek nilai kodeprodi
        Log::info('Kode Prodi: ' . $kodeprodi);

        $affectedRows = Jadwal_mata_kuliah::where('kodeprodi', $kodeprodi)
            ->update([
                'status' => 'sudah disetujui',
                // 'tanggal_disetujui' => now() // Hapus atau komentari baris ini jika kolom tidak ada
            ]);

        // Debugging: Cek jumlah baris yang terpengaruh
        Log::info('Affected Rows: ' . $affectedRows);

        if ($affectedRows === 0) {
            return redirect()->back()->with('error', 'Tidak ada jadwal yang ditemukan untuk prodi tersebut.');
        }

        return redirect()->back()->with('success', "Semua jadwal untuk prodi $kodeprodi berhasil disetujui.");
    }
}
