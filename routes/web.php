<?php

use App\Http\Controllers\Bidan\BidanDashboardController;
use App\Http\Controllers\Bidan\CheckUpController;
use App\Http\Controllers\Bidan\LayananController;
use App\Http\Controllers\Bidan\RekamMedisController;
use App\Http\Controllers\Bidan\RumahSakitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
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

    });

// Bidan
Route::prefix('petugas')
    ->middleware(['auth', 'petugas'])
    ->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');

        Route::resource('pasien', CheckUpController::class);
        Route::resource('layanan', LayananController::class);
        Route::resource('rumah-sakit', RumahSakitController::class);
    });


