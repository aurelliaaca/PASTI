<?php

namespace App\Http\Controllers;

use App\Models\JadwalIrs;
use Illuminate\Http\Request;

class BAKController extends Controller
{
    // Menampilkan halaman jadwal dengan data
    public function showJadwal()
    {
        // Ambil semua data jadwal
        $jadwals = JadwalIrs::all();
        return view('bak_jadwal', compact('jadwals')); // Kirim data ke view
    }

    // Menampilkan data jadwal untuk halaman bak_jadwal
    public function index()
    {
        $jadwals = JadwalIrs::all();  // Ambil semua data jadwal
        return view('bak_jadwal', compact('jadwals')); // Kirim data ke view
    }

    // Menyimpan jadwal baru
    public function store(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'keterangan' => 'required|string|max:255',
        'jadwal_mulai' => 'required|date',
        'jadwal_berakhir' => 'required|date|after_or_equal:jadwal_mulai',
    ]);

    // Simpan data ke database
    $jadwal = JadwalIrs::create([
        'keterangan' => $request->keterangan,
        'jadwal_mulai' => $request->jadwal_mulai,
        'jadwal_berakhir' => $request->jadwal_berakhir,
    ]);

    // Mengembalikan response JSON untuk AJAX
    return response()->json([
        'success' => true,
        'is_edit' => false, // Menandakan bahwa ini adalah create, bukan edit
        'data' => $jadwal
    ]);
}

    // Menyimpan perubahan jadwal
   // Menyimpan perubahan jadwal
public function update(Request $request, $id)
{
    // Validasi data
    $validated = $request->validate([
        'keterangan' => 'required|string|max:255',
        'jadwal_mulai' => 'required|date',
        'jadwal_berakhir' => 'required|date|after_or_equal:jadwal_mulai',
    ]);

    // Temukan jadwal berdasarkan ID
    $jadwal = JadwalIrs::findOrFail($id);

    // Perbarui data jadwal
    $jadwal->update([
        'keterangan' => $request->keterangan,
        'jadwal_mulai' => $request->jadwal_mulai,
        'jadwal_berakhir' => $request->jadwal_berakhir,
    ]);

    return response()->json([
        'success' => true,
        'is_edit' => true, // Menandakan bahwa ini adalah update, bukan create
        'data' => $jadwal
    ]);
}


    // Menghapus jadwal
    public function destroy($id)
    {
        // Temukan jadwal berdasarkan ID
        $jadwal = JadwalIrs::findOrFail($id);

        // Hapus data jadwal
        $jadwal->delete();

        return response()->json(['success' => true]);
    }
}
