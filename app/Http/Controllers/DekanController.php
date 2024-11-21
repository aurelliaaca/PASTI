<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DekanController extends Controller
{
    public function showPersetujuan()
    {
        return view('dk_persetujuan');
    }

    public function showMonitoring()
    {
        return view('dk_monitoring');
    }
}
