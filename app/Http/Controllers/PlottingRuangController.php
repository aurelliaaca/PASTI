<?php

namespace App\Http\Controllers;

use App\Models\PlottingRuang;
use App\Models\Ruangan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlottingRuangController extends Controller
{
    public function index()
    {
        // Ambil data program studi
        $programStudis = Prodi::all();

        // Ambil data ruangan yang belum dipakai
        $ruangan = Ruangan::whereNotIn('id', function($query) {
            $query->select('ruangan_id')->from('plotting_ruang')->whereIn('status', ['belum disetujui', 'sudah disetujui']);
        })->get();

        // Ambil data plotting ruang
        $plottingRuang = PlottingRuang::with('ruangan')->get();

        return view('bak_plottingruang', compact('programStudis', 'ruangan', 'plottingRuang'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prodi_id' => 'required|string|exists:programstudi,kodeprodi',
            'ruangan_id' => 'required|array',
            'ruangan_id.*' => 'integer|exists:ruangan,id',
        ]);

        foreach ($validatedData['ruangan_id'] as $ruanganId) {
            $plottingRuang = new PlottingRuang();
            $plottingRuang->prodi_id = $validatedData['prodi_id'];
            $plottingRuang->ruangan_id = $ruanganId;
            $plottingRuang->status = 'belum disetujui';

            $plottingRuang->save();
        }

        return redirect()->route('dk_persetujuanruangan')->with('success', 'Plotting ruang berhasil ditambahkan dan menunggu persetujuan.');
    }

    public function approve($id)
    {
        try {
            // Temukan plotting ruang berdasarkan ID
            $plottingRuang = PlottingRuang::findOrFail($id);
            $plottingRuang->status = 'sudah disetujui';
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

