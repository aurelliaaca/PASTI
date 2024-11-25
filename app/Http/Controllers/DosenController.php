<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;


class DosenController extends Controller
{


    public function index(){
        return view('dashboard_dosen');
    }

    public function showPerwalian()
    {
        return view('pa_perwalian');
    }

    public function showPersetujuanIRS()
    {
        return view('pa_persetujuan');
    }

    public function showIRSMahasiswa()
    {
        return view('pa_irsmahasiswa');
    }

    // public function index()
    // {
    //     $data = Mahasiswa::all(); // Mengambil semua data mahasiswa
    //     dd($data);
    //     return view('pa_perwalian', compact('data')); // Kirim ke view
    // }

    // public function index() {
    //     $data = Mahasiswa::all(); // Mengambil semua data mahasiswa
    //     return view('pa_perwalian', compact('data')); // Kirim ke view
    // }
    

}

