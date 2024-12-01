<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\BAKController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\KaprodiController;

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
Route::get('/dk_persetujuanruangan', [DekanController::class, 'showPersetujuan'])->name('dk_persetujuanruangan');
Route::get('/dk_monitoring', [DekanController::class, 'showMonitoring'])->name('dk_monitoring');
Route::get('/bak_ruangan', [RuanganController::class, 'index'])->name('bak_ruangan');

Route::prefix('ruangan')->name('ruangan.')->group(function () {
    Route::post('/store', [RuanganController::class, 'store'])->name('store');
    Route::get('/', [RuanganController::class, 'index'])->name('index');
    Route::delete('/{id}', [RuanganController::class, 'destroy'])->name('destroy');
    Route::post('/setujuiSemua', [RuanganController::class, 'setujuiSemua'])->name('setujuiSemua');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/login/user', function () {
    return view('user');
});

// perDASHBOARDan
Route::get('/dashboard_mhs', function () {
    return view('dashboard_mhs');
});

Route::get('/dashboard_bak', function () {
    return view('dashboard_bak');
})->name('Bagian_akademik');

Route::get('/dashboard_kp', function () {
    return view('dashboard_kp');
})->name('Ketua_Prodi');

Route::get('/dashboard_dekan', function () {
    return view('dashboard_dekan');
})->name('Dekan');

Route::get('/dashboard_dosen', function () {
    return view('dashboard_dosen');
})->name('Dosen');

Route::get('/kp_penjadwalan', function () {
    return view('kp_penjadwalan');
})->name('kp_penjadwalan');

Route::get('/dosen_perwalian', function () {
    return view('dosen_perwalian');
})->name('Perwalian');

// NYOBA MAKSIMAL
// Route::get('/perwalian', [DosenController::class, 'index'])->name('perwalian.index');

Route::get('/dosen_persetujuan', function () {
    return view('dosen_persetujuan');
})->name('persetujuan_IRS');

Route::get('/dosen_irsmahasiswa', function () {
    return view('dosen_irsmahasiswa');
})->name('IRS_Mahasiswa');

Route::get('/mhs_pengisianirspage', function () {
    return view('mhs_pengisianirspage');
})->name('Pengisian_IRS');

Route::get('/user1', function () {
    return view('user1');
})->name('user1');

Route::get('/kp_matakuliah', function () {
    return view('kp_matakuliah');
})->name('kp_matakuliah');

Route::get('/bak_plottingruang', function () {
    return view('bak_plottingruang');
})->name('bak_plottingruang'); 

Route::get('/kp_penjadwalan', [KaprodiController::class, "listMk"])->name('kp_penjadwalan');

// Route untuk mendapatkan detail matakuliah
Route::get('/get-mata-kuliah-data/{kode}', [KaprodiController::class, 'getMatkul']);

// routes mahasiswa
use App\Http\Controllers\MahasiswaController;
Route::get('/mhs_pengisianirspage', [MahasiswaController::class, 'listMK'])->name('Pengisian_IRS');
Route::get('/get-jadwal-mk/{kodeMk}', [MahasiswaController::class, 'getJadwalByMatkul']);
Route::get('/get-jadwal-mk/{courseId}', [MahasiswaController::class, 'getJadwalByMatkul']);


// Rute untuk menampilkan halaman jadwal dengan data
Route::get('/bak_jadwal', [BAKController::class, 'index'])->name('Jadwal');

// Rute resource untuk operasi CRUD pada 'jadwal' (auto CRUD routes untuk store, show, update, destroy)
Route::resource('jadwal', BAKController::class);

// Rute resource untuk operasi CRUD pada 'jadwal'
Route::resource('jadwal', BAKController::class);

// Jika perlu, tambahkan metode khusus untuk hapus dan update, jika Anda ingin kontrol lebih pada rute tertentu
Route::delete('/jadwal/{id}', [BAKController::class, 'destroy']);
Route::put('/jadwal/{id}', [BAKController::class, 'update']);
