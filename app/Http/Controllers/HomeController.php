<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function dashboardMahasiswa()
    {
        return view('mahasiswa.dashboard_mhs');
    }
    
    public function dashboardDosen()
    {
        return view('dosen.dashboard');
    }

    public function dashboardAkademik()
    {
        return view('akademik.dashboard');
    }

    public function dashboardDekan()
    {
        return view('dekan.dashboard');
    }

    public function dashboardKaprodi()
    {
        return view('kaprodi.dashboard');
    }
}
