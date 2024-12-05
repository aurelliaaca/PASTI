<?php

namespace App\Http\Controllers;

use App\Models\PlottingRuang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlottingRuangController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::whereDoesntHave('plottingRuangs', function($query) {
            $query->whereIn('status', ['belum disetujui', 'sudah disetujui']);
        })->get();

        $plottingRuang = PlottingRuang::with('ruangan')->get();

        return view('bak_plottingruang', compact('ruangan', 'plottingRuang'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prodi' => 'required|string',
            'ruangan_id' => 'required|array',
            'ruangan_id.*' => 'exists:ruangan,id',
        ]);

        foreach ($validatedData['ruangan_id'] as $ruanganId) {
            $plottingRuang = new PlottingRuang();
            $plottingRuang->prodi_id = $validatedData['prodi'];
            $plottingRuang->ruangan_id = $ruanganId;
            $plottingRuang->status = 'belum disetujui';

            $plottingRuang->save();
        }

        return response()->json(['success' => true, 'message' => 'Plotting ruang berhasil ditambahkan.']);
    }

    public function approve($id)
    {
        try {
            // Temukan plotting ruang berdasarkan ID
            $plottingRuang = PlottingRuang::findOrFail($id);

            // Ubah status menjadi "telah disetujui"
            $plottingRuang->status = 'telah disetujui';
            $plottingRuang->save();

            // Kembalikan respons atau redirect
            return redirect()->route('bak_plottingruang')->with('success', 'Ruangan berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->route('bak_plottingruang')->with('error', 'Terjadi kesalahan saat menyetujui ruangan.');
        }
    }

    public function getData()
    {
        try {
            $plottingRuang = PlottingRuang::with('ruangan')->get();
            return response()->json($plottingRuang);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memuat data.']);
        }
    }
}

