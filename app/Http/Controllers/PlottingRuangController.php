<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlottingRuangController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::with('prodi')->get();

        $programStudis = Prodi::all();

        return view('bak_plottingruang', compact('ruangans', 'programStudis'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namaprodi' => 'required|string|exists:prodi,namaprodi',
            'ruangan_id' => 'required|array',
            'ruangan_id.*' => 'integer|exists:ruangan,id',
        ]);

        $newRuangan = [];

        foreach ($validatedData['ruangan_id'] as $ruanganId) {
            $ruangan = new Ruangan();
            $ruangan->kodeprodi = $validatedData['namaprodi'];
            $ruangan->ruangan_id = $ruanganId;
            $ruangan->status = 'belum disetujui';
            $ruangan->save();

            $newRuangan[] = $ruangan->load('ruangan', 'prodi');
        }

        return response()->json(['success' => true, 'message' => 'Plotting ruang berhasil ditambahkan.']);
    }

    public function getData()
    {
        try {
            $ruangan = Ruangan::all();
            return response()->json($ruangan);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memuat data.']);
        }
    }
}

