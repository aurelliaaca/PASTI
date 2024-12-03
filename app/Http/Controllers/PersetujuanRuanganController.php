<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlottingRuang;

class PersetujuanRuanganController extends Controller
{
    public function index()
    {
        $programStudiList = ['INFORMATIKA', 'BIOLOGI', 'MATEMATIKA', 'FISIKA', 'KIMIA', 'BIOTEKNOLOGI', 'STATISTIKA'];

        $plottingRuangData = [];
        foreach ($programStudiList as $programStudi) {
            $plottingRuangData[$programStudi] = PlottingRuang::where('prodi_id', $programStudi)->with('ruangan')->get();
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
}
