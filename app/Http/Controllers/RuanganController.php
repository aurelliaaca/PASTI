<?php

namespace App\Http\Controllers;
use App\Models\Ruangan;
use App\Models\Prodi;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function showRuang()
    {
        // Ambil semua data jadwal
        $ruangans = Ruangan::all();
        $prodis = Prodi::all();
        return view('bak_ruangan', compact('ruangans', 'prodis')); // Kirim data ke view
    }

    public function index()
    {
        $ruangans = Ruangan::all();  // Ambil semua data jadwal
        $prodis = Prodi::all();
        return view('bak_ruangan', compact('ruangans', 'prodis')); // Kirim data ke view
    }

    // Menambahkan Ruangan
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'gedung' => 'required|string|max:255',
            'ruang' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
        ]);
    
        // Mengecek apakah kombinasi gedung dan ruang sudah ada
        $existingRuang = Ruangan::where('gedung', $request->gedung)
                                ->where('ruang', $request->ruang)
                                ->first();
    
        if ($existingRuang) {
            // Mengembalikan response JSON jika ruangan sudah ada
            return response()->json([
                'success' => false,
                'message' => 'Ruangan ini sudah ada di gedung yang sama.'
            ]);
        }
    
        // Simpan data ke database jika tidak ada duplikasi
        $ruang = Ruangan::create([
            'gedung' => $request->gedung,
            'ruang' => $request->ruang,
            'kapasitas' => $request->kapasitas,
        ]);
    
        // Mengembalikan response JSON untuk AJAX
        return response()->json([
            'success' => true,
            'is_edit' => false, // Menandakan bahwa ini adalah create, bukan edit
            'data' => $ruang
        ]);
    }

    // Mengupdate Ruangan
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'gedung' => 'required|string|max:255',
            'ruang' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
        ]);

        // Temukan jadwal berdasarkan ID
        $ruang = Ruangan::findOrFail($id);

        // Mengecek apakah kombinasi gedung dan ruang sudah ada, kecuali untuk data yang sedang diedit
        $existingRuang = Ruangan::where('gedung', $request->gedung)
                                ->where('ruang', $request->ruang)
                                ->where('id', '<>', $id) // Menjaga ID yang sedang diedit
                                ->first();

        if ($existingRuang) {
            // Mengembalikan response JSON jika ruangan sudah ada
            return response()->json([
                'success' => false,
                'message' => 'Ruangan ini sudah ada di gedung yang sama.'
            ]);
        }

        // Perbarui data jadwal
        $ruang->update([
            'gedung' => $request->gedung,
            'ruang' => $request->ruang,
            'kapasitas' => $request->kapasitas,
        ]);

        return response()->json([
            'success' => true,
            'is_edit' => true, // Menandakan bahwa ini adalah update, bukan create
            'data' => $ruang
        ]);
    }


    // Menghapus Ruangan
    public function destroy($id)
    {
        // Temukan jadwal berdasarkan ID
            $ruang = Ruangan::findOrFail($id);

            // Hapus data jadwal
            $ruang->delete();

            return response()->json(['success' => true]);
    }
}