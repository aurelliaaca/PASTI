<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DekanController extends Controller
{
    public function index(){
        return view('dashboard_dekan');
    }
}
