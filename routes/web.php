<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\BAKController;
use App\Http\Controllers\RuanganController;


Route::get('/', function () {
    return view('login');
});

Route::get('login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('proses_login', 'App\Http\Controllers\LoginController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cek_login:kaprodi']], function(){
        Route::resource('kaprodi', UserController::class);
    });
    Route::group(['middleware' => ['cek_login:mahasiswa']], function(){
        Route::resource('mahasiswa', UserController::class);
    });
});

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/dashboard_mhs', [UserController::class, 'index'])->name('dashboard_mhs');
Route::get('/dk_persetujuan', [DekanController::class, 'showPersetujuan'])->name('dk_persetujuan');
Route::get('/dk_monitoring', [DekanController::class, 'showMonitoring'])->name('dk_monitoring');
Route::get('/bak_jadwal', [BAKController::class, 'showJadwal'])->name('bak_jadwal');
Route::get('/bak_ruangan', [RuanganController::class, 'index'])->name('bak_ruangan');

Route::prefix('ruangan')->name('ruangan.')->group(function () {
    Route::post('/store', [RuanganController::class, 'store'])->name('store');
    Route::get('/', [RuanganController::class, 'index'])->name('index');
    Route::delete('/{id}', [RuanganController::class, 'destroy'])->name('destroy');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/login/user', function () {
    return view('user');
});

Route::get('/dashboard_mhs', function () {
    return view('dashboard_mhs');
});

Route::get('/dashboard_bak', function () {
    return view('dashboard_bak');
});

Route::get('/dashboard_kp', function () {
    return view('dashboard_kp');
})->name('dashboard_kp');

Route::get('/dashboard_dekan', function () {
    return view('dashboard_dekan');
})->name('dashboard_dekan');

Route::get('/dashboard_dosen', function () {
    return view('dashboard_dosen');
})->name('dashboard_dosen');

Route::get('/kp_penjadwalan', function () {
    return view('kp_penjadwalan');
})->name('kp_penjadwalan');

Route::get('/dosen_perwalian', function () {
    return view('dosen_perwalian');
})->name('dosen_perwalian');

// NYOBA MAKSIMAL
// Route::get('/perwalian', [DosenController::class, 'index'])->name('perwalian.index');

Route::get('/dosen_persetujuan', function () {
    return view('dosen_persetujuan');
})->name('dosen_persetujuan');

Route::get('/dosen_irsmahasiswa', function () {
    return view('dosen_irsmahasiswa');
})->name('dosen_irsmahasiswa');

Route::get('/mhs_pengisianirspage', function () {
    return view('mhs_pengisianirspage');
})->name('mhs_pengisianirspage');

Route::get('/user1', function () {
    return view('user1');
})->name('user1');
