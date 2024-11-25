<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BAKController extends Controller
{
    public function showJadwal()
    {
        return view('bak_jadwal');
    }
}
