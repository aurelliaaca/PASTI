<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\BAKController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController; //bismillah
use App\Http\Controllers\PersetujuanRuanganController;

// Pembaruan Login
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Grup untuk Mahasiswa
Route::middleware(['auth', 'mahasiswa'])->group(function () {
    Route::get('mahasiswa/dashboard', [HomeController::class, 'dashboardMahasiswa']);
    Route::get('/mhs_pengisianirspage', [MahasiswaController::class, 'bebanSKS']);
    Route::get('/mhs_pengisianirspage', [MahasiswaController::class, 'listMk'])->name('Pengisian_IRS');
    Route::get('/get-jadwal-mk/{kodeMk}', [MahasiswaController::class, 'getJadwalByMatkul']);
    Route::get('/get-jadwal-mk/{courseId}', [MahasiswaController::class, 'getJadwalByMatkul']);
    Route::post('/cek-tabrakan-jadwal', [MahasiswaController::class, 'cekTabrakan']);
    Route::post('/cek-jadwal', [MahasiswaController::class, 'cekJadwal']);
    Route::post('/store-jadwal', [MahasiswaController::class, 'store']);
    Route::post('/batalkan-jadwal', [MahasiswaController::class, 'batalkanJadwal']);
    Route::get('/getJadwalByKodeMK', [MahasiswaController::class, 'getJadwalByKodeMK'])->name('getJadwalByKodeMK');
    Route::get('/api/jadwal', [MahasiswaController::class, 'getJadwal']);
    Route::get('/get-sks-terpilih', [MahasiswaController::class, 'getSksTerpilih'])->name('get.sks.terpilih');
    Route::get('/mahasiswa/getJadwalByMatkul/{kodeMatkul}', [MahasiswaController::class, 'getJadwalByMatkul']);
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
    Route::post('/save-jadwal', [MahasiswaController::class, 'store']);
    Route::post('/batal-jadwal', [MahasiswaController::class, 'bataljadwal'])->name('batalkan.jadwal');
    Route::post('/hapus-jadwal', [MahasiswaController::class, 'hapusJadwal']);
// Pastikan route ini sesuai dengan nama yang digunakan di form
Route::post('/ajukan-semua-IRS', [MahasiswaController::class, 'ajukanSemuaIRS'])->name('ajukanSemuaIrs');
Route::post('/reset-irs', [MahasiswaController::class, 'resetIrs'])->name('resetIrs');



// routes/web.php
Route::post('/submit-jadwal', [MahasiswaController::class, 'store']);

Route::get('/jadwal/{kode_matkul}', [MahasiswaController::class, 'getJadwalByMatkul']);



    

// Mengambil data jadwal menggunakan AJAX berdasarkan nim dan smt

});


// Grup untuk Dekan
Route::middleware(['auth', 'dekan'])->group(function () {
    Route::get('dekan/dashboard', [HomeController::class, 'dashboardDekan'])->name('dashboard.dekan');
    Route::get('dekan/dashboard2', [HomeController::class, 'dashboardDekan'])->name('dashboard.dekan2');
    Route::get('dosen/dashboard2', [HomeController::class, 'dashboardDosen'])->name('dashboard.dosen2');
    Route::get('/persetujuanruangan', [DekanController::class, 'showPersetujuan'])->name('persetujuanruangan');
    Route::get('/persetujuanjadwal', [DekanController::class, 'showJadwal'])->name('persetujuanjadwal');
    Route::get('/user1', [HomeController::class, 'user1'])->name('user1');
    Route::post('/setujui-semua-ruang', [DekanController::class, 'approveAllRooms'])->name('setujui.semua.ruang');
    Route::post('/setujui-semua-jadwal', [DekanController::class, 'approveAllJadwal'])->name('setujui.semua.jadwal');
    Route::get('/dekan/dashboard2', [DekanController::class, 'showDashboard'])->name('dashboard.dekan2');
    // Route::get('/user1', function () {return view('user1');})->name('user1');
});

// Grup untuk Dosen
Route::middleware(['auth', 'dosen'])->group(function () {
    Route::get('dosen/dashboard', [HomeController::class, 'dashboardDosen'])->name('dashboard.dosen');
    Route::get('dosen/perwalian', [DosenController::class, 'showPerwalian'])->name('Perwalian');
    //Route::get('/dosen_perwalian', function () {return view('dosen_perwalian');})->name('Perwalian');
    Route::get('dosen/persetujuan', [DosenController::class, 'showPersetujuanIRS'])->name('persetujuan_IRS');
    // Route::get('/dosen_persetujuan', function () {return view('dosen_persetujuan');})->name('persetujuan_IRS');
    Route::get('dosen/irs-mahasiswa', [DosenController::class, 'showIRSMahasiswa'])->name('IRS_Mahasiswa');
    Route::post('dosen/setujui-irs', [DosenController::class, 'setujuiIRS'])->name('setujuiIRS');
    Route::post('dosen/tolak-irs', [DosenController::class, 'tolakIRS'])->name('tolakIRS');
    Route::post('dosen/setujui-semua-IRS', [DosenController::class, 'setujuiSemuaIRS'])->name('setujuiSemuaIrs');
    Route::post('dosen/reset-IRS', [DosenController::class, 'resetIrs'])->name('resetIrsDosen');
    
});

// Grup untuk Akademik
Route::middleware(['auth', 'akademik'])->group(function () {
    Route::get('akademik/dashboard', [HomeController::class, 'dashboardAkademik']);
    
    // Rute untuk ruangan
    Route::get('/ruangan', [BAKController::class, 'ruangan'])->name('ruangan');
    Route::post('/ruangan/store', [BAKController::class, 'store'])->name('ruangan.store');
    Route::delete('/ruangan/{id}', [BAKController::class, 'destroyRuangan'])->name('ruangan.destroy');
    Route::get('/ruangan/{id}/edit', [BAKController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/{id}', [BAKController::class, 'updateRuangan'])->name('ruangan.update');
    
    // Rute untuk plotting ruang
    Route::get('/plottingruang', [BAKController::class, 'plotruang'])->name('plottingruang');
    Route::get('/plotting-ruang/data', [BAKController::class, 'getData'])->name('plotting-ruang.data');
    Route::post('/plottingruang/store', [BAKController::class, 'storePlottingRuang'])->name('storePlottingRuang');
    Route::post('/plottingruang/ajukan', [BAKController::class, 'ajukanPlotting'])->name('plottingruang.ajukan');
    
    // Rute untuk periode
    Route::get('/periode', [BAKController::class, 'showJadwal'])->name('periode');
    Route::post('/periode/store', [BAKController::class, 'simpanPeriode'])->name('simpanPeriode');
    Route::delete('/periode/{id}', [BAKController::class, 'hapusPeriode'])->name('hapusPeriode');
    Route::get('/periode/{id}', [BAKController::class, 'editPeriode'])->name('editPeriode');
    Route::put('/periode/{id}', [BAKController::class, 'updatePeriode'])->name('updatePeriode');
});


// Grup untuk Kaprodi
Route::middleware(['auth', 'kaprodi'])->group(function () {
    Route::get('kaprodi/dashboard', [HomeController::class, 'dashboardKaprodi'])->name('dashboard.kaprodi');
    Route::get('kaprodi/dashboard2', [HomeController::class, 'dashboardKaprodi'])->name('dashboard.kaprodi2');
    Route::get('dosen/dashboard3', [HomeController::class, 'dashboardDosen'])->name('dashboard.dosen3');
    Route::get('/user2', [HomeController::class, 'user2'])->name('user2');
    Route::get('/kp_matakuliah', function () {return view('kp_matakuliah');})->name('kp_matakuliah');
    // Route untuk bagian penjadwalan
    Route::get('/kp_penjadwalan', [KaprodiController::class, 'showPenjadwalanForm'])->name('penjadwalan');
    Route::post('/kp_penjadwalan/store', [KaprodiController::class, 'store'])->name('kp.jadwal.store');
    Route::put('/kp_penjadwalan/ajukan/{id}', [KaprodiController::class, 'ajukan'])->name('kp.jadwal.ajukan');
    Route::post('/kaprodi/jadwal/ajukan-semua', [KaprodiController::class, 'ajukanSemuaJadwal'])
    ->name('kaprodi.jadwal.ajukan-semua');
    Route::get('/kp_penjadwalan/delete/{jadwalid}', [KaprodiController::class, 'destroyJadwal'])->name('jadwal.destroy');
    Route::get('/kp_penjadwalan/edit/{jadwalid}', [KaprodiController::class, 'edit'])->name('jadwal.edit');
    Route::put('/kp_penjadwalan/update/{jadwalid}', [KaprodiController::class, 'update'])->name('jadwal.update');
    // Route untuk mendapatkan detail matakuliah
    Route::prefix('kp_matakuliah')->group(function () {
        Route::get('/', [KaprodiController::class, 'matkul'])->name('Matakuliah');
        Route::post('/', [KaprodiController::class, 'storeMatkul'])->name('matakuliah.store');
        Route::post('/check-duplicate', [KaprodiController::class, 'checkDuplicateMK'])->name('matakuliah.checkDuplicateMK');
        Route::delete('/{kode}', [KaprodiController::class, 'destroyMK'])->name('matakuliah.destroy');
        Route::put('/{kode}', [KaprodiController::class, 'updateMK'])->name('matakuliah.update');
    });

    
});

// Ini tolong jangan digeser
Route::get('/profile', function() {
    // Halaman profil pengguna
    return view('profile');
})->name('profile');

// Fosil

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('login', 'App\Http\Controllers\LoginController@index')->name('login');
// Route::post('proses_login', 'App\Http\Controllers\LoginController@proses_login')->name('proses_login');
// Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

// Route::group(['middleware' => ['auth']], function(){
//     Route::group(['middleware' => ['cek_login:kaprodi']], function(){
//         Route::resource('kaprodi', UserController::class);
//     });
//     Route::group(['middleware' => ['cek_login:mahasiswa']], function(){
//         Route::resource('mahasiswa', UserController::class);
//     });
// });

// Route::get('/user', [UserController::class, 'index'])->name('user');
// Route::get('/dashboard_mhs', [UserController::class, 'index'])->name('dashboard_mhs');
// Route::get('/dk_persetujuanruangan', [DekanController::class, 'showPersetujuan'])->name('dk_persetujuanruangan');
// Route::get('/dk_monitoring', [DekanController::class, 'showMonitoring'])->name('dk_monitoring');
// Route::get('/bak_ruangan', [RuanganController::class, 'index'])->name('bak_ruangan');

// Route::prefix('ruangan')->name('ruangan.')->group(function () {
//     Route::post('/store', [RuanganController::class, 'store'])->name('store');
//     Route::get('/', [RuanganController::class, 'index'])->name('index');
//     Route::delete('/{id}', [RuanganController::class, 'destroy'])->name('destroy');
//     Route::post('/setujuiSemua', [RuanganController::class, 'setujuiSemua'])->name('setujuiSemua');
// });

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/login/user', function () {
//     return view('user');
// });

// // perDASHBOARDan
// Route::get('/dashboard_mhs', function () {
//     return view('dashboard_mhs');
// });

// Route::get('/dashboard_bak', function () {
//     return view('dashboard_bak');
// })->name('Bagian_akademik');

// Route::get('/dashboard_kp', function () {
//     return view('dashboard_kp');
// })->name('Ketua_Prodi');

// Route::get('/dashboard_dekan', function () {
//     return view('dashboard_dekan');
// })->name('Dekan');

// Route::get('/dashboard_dosen', function () {
//     return view('dashboard_dosen');
// })->name('Dosen');

// Route::get('/kp_penjadwalan', function () {
//     return view('kp_penjadwalan');
// })->name('kp_penjadwalan');

// Route::get('/dosen_perwalian', function () {
//     return view('dosen_perwalian');
// })->name('Perwalian');

// // NYOBA MAKSIMAL
// // Route::get('/perwalian', [DosenController::class, 'index'])->name('perwalian.index');

// Route::get('/dosen_persetujuan', function () {
//     return view('dosen_persetujuan');
// })->name('persetujuan_IRS');

// Route::get('/dosen_irsmahasiswa', function () {
//     return view('dosen_irsmahasiswa');
// })->name('IRS_Mahasiswa');

// Route::get('/user1', function () {
//     return view('user1');
// })->name('user1');

// Route::get('/kp_matakuliah', function () {
//     return view('kp_matakuliah');
// })->name('kp_matakuliah');

// Route::get('/kp_matakuliah', function () {
//     return view('kp_matakuliah');
// })->name('kp_matakuliah');

// Route::get('/kp_penjadwalan', [KaprodiController::class, "buatJadwal"])->name('Penjadwalan');
// Route::get('/bak_plottingruang', function () {
//     return view('bak_plottingruang');
// })->name('bak_plottingruang'); 

// Route::get('/kp_penjadwalan', [KaprodiController::class, "listMk"])->name('kp_penjadwalan');

// // Route untuk mendapatkan detail matakuliah
// Route::get('/get-mata-kuliah-data/{kode}', [KaprodiController::class, 'getMatkul']);

// Route::prefix('kp_matakuliah')->group(function () {
//     Route::get('/', [KaprodiController::class, 'matkul'])->name('Matakuliah');
//     Route::post('/', [KaprodiController::class, 'storeMatkul'])->name('matakuliah.store');
//     Route::post('/check-duplicate', [KaprodiController::class, 'checkDuplicateMK'])->name('matakuliah.checkDuplicateMK');
//     Route::delete('/{kode}', [KaprodiController::class, 'destroyMK'])->name('matakuliah.destroy');
//     Route::put('/{kode}', [KaprodiController::class, 'updateMK'])->name('matakuliah.update');
//});


// // Route untuk mendapatkan detail matakuliah
// Route::get('/get-mata-kuliah-data/{kode}', [KaprodiController::class, 'getMatkul']);

// routes mahasiswa
// use App\Http\Controllers\MahasiswaController;
// Route::get('/mhs_pengisianirspage', [MahasiswaController::class, 'listMK'])->name('Pengisian_IRS');
// Route::get('/get-jadwal-mk/{kodeMk}', [MahasiswaController::class, 'getJadwalByMatkul']);
// Route::get('/get-jadwal-mk/{courseId}', [MahasiswaController::class, 'getJadwalByMatkul']);


// // Rute untuk menampilkan halaman jadwal dengan data
// Route::get('/bak_jadwal', [BAKController::class, 'index'])->name('Jadwal');

// // Rute resource untuk operasi CRUD pada 'jadwal' (auto CRUD routes untuk store, show, update, destroy)
// Route::resource('jadwal', BAKController::class);

// // Rute resource untuk operasi CRUD pada 'jadwal'
// Route::resource('jadwal', BAKController::class);

// // Jika perlu, tambahkan metode khusus untuk hapus dan update, jika Anda ingin kontrol lebih pada rute tertentu
// Route::delete('/jadwal/{id}', [BAKController::class, 'destroy']);
// Route::put('/jadwal/{id}', [BAKController::class, 'update']);

// use Illuminate\Support\Facades\Auth;



// Route::post('/logout', function() {
//     Auth::logout();
//     return redirect()->route('login');
// })->name('logout');

// Route::middleware(['auth'])->group(function () {
//     Route::post('/kp_penjadwalan/store', [KaprodiController::class, 'store'])->name('kp.jadwal.store');
// });

// Route::delete('/jadwal/{id}', [KaprodiController::class, 'destroyJadwal'])->name('jadwal.destroy');