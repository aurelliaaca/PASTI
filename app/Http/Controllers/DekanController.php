<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DekanController extends Controller
{
    public function showPersetujuan()
    {
        return view('dk_persetujuanruangan');
    }

    public function showJadwal()
    {
        return view('dk_persetujuanjadwal');
    }
}
