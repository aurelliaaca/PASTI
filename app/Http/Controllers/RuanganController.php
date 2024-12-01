<?php

namespace App\Http\Controllers;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('bak_ruangan', compact('ruangan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'ruang' => 'required',
            'kapasitas' => 'required|numeric',
        ]);

        $ruangan = Ruangan::create([
            'ruang' => $request->ruang,
            'kapasitas' => $request->kapasitas,
        ]);

        return response()->json([
            'success' => true,
            'data' => $ruangan
        ]);
    }

    public function destroy($id)
    {
        try {
            $ruangan = Ruangan::findOrFail($id);
            $ruangan->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function setujuiSemua(Request $request) {
        // Logika untuk menyetujui semua ruangan
        // Misalnya, update status semua ruangan di database
        Ruangan::query()->update(['status' => 'disetujui']); // Contoh update status

        return response()->json(['success' => true]);
    }
}