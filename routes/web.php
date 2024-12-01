<?php

use App\Http\Controllers\Bidan\BidanDashboardController;
use App\Http\Controllers\Bidan\BidanPasienController;
use App\Http\Controllers\Bidan\RekamMedisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Petugas\AntrianController;
use App\Http\Controllers\Petugas\LayananController;
use App\Http\Controllers\Petugas\PasienController;
use App\Http\Controllers\Petugas\RumahSakitController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserLayananController;
use App\Http\Controllers\User\UserRekamMedisController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

// Bidan
Route::prefix('bidan')
    ->middleware(['auth', 'bidan'])
    ->group(function () {
        Route::get('/dashboard', [BidanDashboardController::class, 'index'])->name('bidan.dashboard');

        Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
        Route::get('/rekam-medis/edit/{id_pasien}', [RekamMedisController::class, 'edit'])->name('rekam-medis.edit');
        Route::get('/rekam-medis/diagnosa/{id_pasien}', [RekamMedisController::class, 'diagnosa'])->name('bidan.proses.rekam.medis');
        Route::get('/rekam-medis/cetak/{id_pasien}', [RekamMedisController::class, 'downloadSuratRujukan'])->name('bidan.cetak.rekam.medis');
        Route::post('/rekam-medis/diagnosa/store', [RekamMedisController::class, 'processRekamMedis'])->name('bidan.store.rekam.medis');
        Route::put('/rekam-medis/diagnosa/{id_pasien}', [RekamMedisController::class, 'cancelProcessRekamMedis'])->name('bidan.cancel.rekam.medis');

        Route::get('/pasien', [BidanPasienController::class, 'index'])->name('bidan.pasien.index');
    });

// Bidan
Route::prefix('petugas')
    ->middleware(['auth', 'petugas'])
    ->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');

        // Custome route antrian
        Route::get('/antrian', [AntrianController::class, 'index'])->name('petugas.antrian.index');
        Route::put('/antrian/teruskan/{id}', [AntrianController::class, 'teruskan'])->name('petugas.antrian.teruskan');
        Route::get('/antrian/lewati', [AntrianController::class, 'lewati'])->name('petugas.antrian.lewati');
        // Custome route antrian

        // Custom route pasien
        Route::get('/pasien', [PasienController::class, 'index'])->name('petugas.pasien.index');


        // Route::resource('pasien', PasienController::class);
        Route::resource('layanan', LayananController::class);
        Route::resource('rumah-sakit', RumahSakitController::class);
    });

Route::prefix('user')
    ->middleware(['auth', 'user'])
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        
        Route::get('/layanan', [UserLayananController::class, 'index'])->name('user.layanan.index');
        Route::post('/layanan/daftar', [UserLayananController::class, 'store'])->name('user.layanan.store');

        Route::get('/rekam-medis', [UserRekamMedisController::class, 'index'])->name('user.rekam.medis.index');
        Route::get('/rekam-medis/cetak/{id_pasien}', [UserRekamMedisController::class, 'downloadSuratRujukan'])->name('user.cetak.rekam.medis');
        
        Route::get('/akun', [UserDashboardController::class, 'akun'])->name('user.akun.index');
        Route::get('/akun/edit', [UserDashboardController::class, 'edit'])->name('user.akun.edit');
        Route::put('/akun/update/{id}', [UserDashboardController::class, 'update'])->name('user.akun.update');
    });


