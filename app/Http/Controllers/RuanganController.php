<?php

namespace App\Http\Controllers;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Models\PlottingRuang;

class RuanganController extends Controller
{

    public function index()
    {
        $ruangans = Ruangan::with('plottingRuangs')
        ->get()
        ->sortBy(function($ruangan) {
            return $ruangan->plottingRuangs->where('status', 'sudah disetujui')->isNotEmpty();
        });

        // Convert the sorted collection back to a query for pagination
        $ruangans = $ruangans->values(); // Reset the keys after sorting
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $currentItems = $ruangans->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedRuangans = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, $ruangans->count(), $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        return view('bak_ruangan', compact('paginatedRuangans'));
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