<?php

namespace App\Http\Controllers;


use App\Models\Prodi;
use App\Models\Jadwal_mata_kuliah;
use Illuminate\Http\Request;
class DekanController extends Controller
{
    public function showPersetujuan()
    {
        return view('dk_persetujuanruangan');
    }

    public function showJadwal()
    {
        $prodis = Prodi::all();
        $jadwals = Jadwal_mata_kuliah::with(['prodi', 'matkul'])->get();
            return view('dk_persetujuanjadwal', compact('prodis','jadwals')); // Kirim data ke view
    }
}
