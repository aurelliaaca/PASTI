<?php

namespace App\Http\Controllers;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangkelas = RuangKelas::all();
        return view('bak_ruangan', compact('ruangkelas'));
    }


    public function store(Request $request)
    { //gedungnya diilangin
        $request->validate([
            'kaprodi' => 'required',
            'departemen' => 'required',
            'ruangan' => 'required',
            'kapasitas' => 'required|numeric',
        ]);

        $ruangkelas = RuangKelas::create([
            'kaprodi' => $request->kaprodi,
            'departemen' => $request->departemen,
            'ruang' => $request->ruangan,
            'kapasitas' => $request->kapasitas,
        ]);

        return response()->json([
            'success' => true,
            'data' => $ruangkelas
        ]);
    }

    public function destroy($id)
    {
        try {
            $ruangan = RuangKelas::findOrFail($id);
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
}