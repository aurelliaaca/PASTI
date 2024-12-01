<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DekanController extends Controller
{
    public function showPersetujuan()
    {
        return view('dk_persetujuanruangan');
    }

    public function showMonitoring()
    {
        return view('dk_monitoring');
    }
}
