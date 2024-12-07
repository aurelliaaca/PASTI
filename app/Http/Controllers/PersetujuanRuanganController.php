<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlottingRuang;
use App\Models\Prodi;

class PersetujuanRuanganController extends Controller
{
    public function index()
    {
        $programStudiList = Prodi::pluck('namaprodi', 'kodeprodi');

        $plottingRuangData = [];
        foreach ($programStudiList as $kodeprodi => $namaprodi) {
            $plottingRuangData[$namaprodi] = PlottingRuang::where('prodi_id', $kodeprodi)
                ->with('ruangan')
                ->get();
        }

        return view('dk_persetujuanruangan', compact('plottingRuangData', 'programStudiList'));
    }

    public function approve($id)
    {
        $plottingRuang = PlottingRuang::find($id);
        if ($plottingRuang) {
            $plottingRuang->status = 'telah disetujui';
            $plottingRuang->save();
        }

        return redirect()->route('dk_persetujuanruangan')->with('success', 'Ruangan telah disetujui.');
    }

    public function approveAll(Request $request)
    {
        try {
            // Pastikan kolom yang digunakan benar
            $plottingRuangs = PlottingRuang::where('prodi_id')
                ->where('status', 'belum disetujui')
                ->get();
    
            foreach ($plottingRuangs as $plottingRuang) {
                $plottingRuang->status = 'telah disetujui';
                $plottingRuang->save();
            }
    
            return response()->json(['success' => true, 'message' => 'Semua ruangan telah disetujui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyetujui ruangan.'], 500);
        }
    }

    public function setujuiSemua(Request $request)
    {
        try {
            // Logika untuk menyetujui semua ruangan
            PlottingRuang::where('status', 'belum disetujui')->update(['status' => 'sudah disetujui']);

            return redirect()->back()->with('success', 'Semua ruangan telah disetujui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui ruangan.');
        }
    }
}
