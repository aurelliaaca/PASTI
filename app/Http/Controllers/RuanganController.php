<?php

namespace App\Http\Controllers;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function showJadwal()
    {
        // Ambil semua data jadwal
        $ruangans = Ruangan::all();
        return view('bak_ruangan', compact('ruangans')); // Kirim data ke view
    }

    public function index()
    {
        $ruangans = Ruangan::all();  // Ambil semua data jadwal
        return view('bak_ruangan', compact('ruangans')); // Kirim data ke view
    }

    // Menambahkan Ruangan
public function store(Request $request)
{
    $ruangan = new Ruangan();
    $ruangan->gedung = $request->gedung;
    $ruangan->ruang = $request->ruang;
    $ruangan->kapasitas = $request->kapasitas;
    $ruangan->save();

    return response()->json([
        'success' => true,
        'data' => $ruangan,
        'is_edit' => false,
    ]);
}

// Mengupdate Ruangan
public function update(Request $request, $id)
{
    $ruangan = Ruangan::findOrFail($id);
    $ruangan->gedung = $request->gedung;
    $ruangan->ruang = $request->ruang;
    $ruangan->kapasitas = $request->kapasitas;
    $ruangan->save();

    return response()->json([
        'success' => true,
        'data' => $ruangan,
        'is_edit' => true,
    ]);
}

// Menghapus Ruangan
public function destroy($id)
{
    $ruangan = Ruangan::findOrFail($id);
    $ruangan->delete();

    return response()->json(['success' => true]);
}
}