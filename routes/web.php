<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\BAKController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController; //bismillah

use App\Http\Controllers\PlottingRuangController;
use App\Http\Controllers\PersetujuanRuanganController;

// Pembaruan Login
Route::get('/', function () {
    return view('welcome');
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
    Route::get('/mhs_pengisianirspage', [MahasiswaController::class, 'listMK'])->name('Pengisian_IRS');
    Route::get('/get-jadwal-mk/{kodeMk}', [MahasiswaController::class, 'getJadwalByMatkul']);
    Route::get('/get-jadwal-mk/{courseId}', [MahasiswaController::class, 'getJadwalByMatkul']);
    Route::post('/cek-tabrakan-jadwal', [MahasiswaController::class, 'cekTabrakan']);
    Route::post('/cek-jadwal', [MahasiswaController::class, 'cekJadwal']);
    Route::post('/store-jadwal', [MahasiswaController::class, 'storeJadwal']);
    Route::post('/batalkan-jadwal', [MahasiswaController::class, 'batalkanJadwal']);
});

// Grup untuk Dekan
Route::middleware(['auth', 'dekan'])->group(function () {
    Route::get('dekan/dashboard', [HomeController::class, 'dashboardDekan'])->name('dashboard.dekan');
    Route::get('dekan/dashboard2', [HomeController::class, 'dashboardDekan'])->name('dashboard.dekan2');
    Route::get('dosen/dashboard2', [HomeController::class, 'dashboardDosen'])->name('dashboard.dosen2');
    Route::get('/dk_persetujuanruangan', [PersetujuanRuanganController::class, 'index'])->name('dk_persetujuanruangan');
    Route::get('/dk_persetujuanjadwal', [DekanController::class, 'showJadwal'])->name('Persetujuan_Jadwal');
    Route::get('/user1', [HomeController::class, 'user1'])->name('user1');
    Route::post('/setujui-semua', [PersetujuanRuanganController::class, 'setujuiSemua'])->name('setujuiSemua');
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
});

// Grup untuk Akademik
Route::middleware(['auth', 'akademik'])->group(function () {
    Route::get('akademik/dashboard', [HomeController::class, 'dashboardAkademik']);
    Route::get('/bak_jadwal', [BAKController::class, 'index'])->name('Jadwal');
    Route::get('/bak_plottingruang', [PlottingRuangController::class, 'index'])->name('bak_plottingruang');
    Route::get('/bak_ruangan', [RuanganController::class, 'index'])->name('bak_ruangan');
    Route::prefix('ruangan')->name('ruangan.')->group(function () {
        Route::post('/store', [RuanganController::class, 'store'])->name('store');
        Route::get('/', [RuanganController::class, 'index'])->name('index');
        Route::delete('/{id}', [RuanganController::class, 'destroy'])->name('destroy');
        
    });
    // Rute resource untuk operasi CRUD pada 'jadwal' (auto CRUD routes untuk store, show, update, destroy)
    Route::resource('jadwal', BAKController::class);
    Route::resource('ruang', RuanganController::class);
    Route::get('/bak_plottingruang', [PlottingRuangController::class, 'index'])->name('bak_plottingruang');
    Route::post('/plotting-ruang/approve/{id}', [PlottingRuangController::class, 'approve'])->name('plotting-ruang.approve');
    Route::post('/plotting-ruang/store', [PlottingRuangController::class, 'store'])->name('plotting-ruang.store');
    Route::get('/plotting-ruang/data', [PlottingRuangController::class, 'getData'])->name('plotting-ruang.data');

});


// Grup untuk Kaprodi
Route::middleware(['auth', 'kaprodi'])->group(function () {
    Route::get('kaprodi/dashboard', [HomeController::class, 'dashboardKaprodi'])->name('dashboard.kaprodi');
    Route::get('kaprodi/dashboard2', [HomeController::class, 'dashboardKaprodi'])->name('dashboard.kaprodi2');
    Route::get('dosen/dashboard3', [HomeController::class, 'dashboardDosen'])->name('dashboard.dosen3');
    Route::get('/user2', [HomeController::class, 'user2'])->name('user2');
    //Route::get('/kp_penjadwalan', function () {return view('kp_penjadwalan');})->name('kp_penjadwalan');
    Route::get('/kp_matakuliah', function () {return view('kp_matakuliah');})->name('kp_matakuliah');
    // Route::get('/kp_penjadwalan', [KaprodiController::class, "buatJadwal"])->name('Penjadwalan');
    Route::get('/kp_penjadwalan', [KaprodiController::class, 'showPenjadwalanForm'])->name('Penjadwalan');
    Route::post('/kp_penjadwalan/tambah', [KaprodiController::class, 'storeJadwal']);
    // Route untuk mendapatkan detail matakuliah
    // Route::get('/get-mata-kuliah-data/{kode}', [KaprodiController::class, 'getMatkul']);
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