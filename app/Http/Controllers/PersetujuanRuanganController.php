<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Log;

class PersetujuanRuanganController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel program studi
        $programStudiList = Prodi::pluck('namaprodi', 'kodeprodi');

        // Ambil semua data dari tabel ruangan
        $ruangans = Ruangan::all();

        return view('dk_persetujuanruangan', compact('programStudiList', 'ruangans'));
    }


    public function setujuisemua(Request $request)
    {
        $namaprodi = $request->input('namaprodi');

        // Perbarui semua entri yang sesuai dengan namaprodi
        $affectedRows = Ruangan::where('namaprodi', $namaprodi)
                                     ->where('status', 'Belum disetujui')
                                     ->update(['status' => 'Sudah disetujui']);

        if ($affectedRows > 0) {
            return response()->json(['success' => true, 'message' => 'Semua ruangan telah disetujui.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Tidak ada ruangan yang perlu disetujui.']);
        }
    }
}
