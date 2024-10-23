<?php

use App\Http\Controllers\Bidan\BidanDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Petugas\LayananController;
use App\Http\Controllers\Petugas\PasienController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Petugas\RumahSakitController;
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

    });

Route::prefix('petugas')
    ->middleware(['auth', 'petugas'])
    ->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');

        Route::resource('layanan', LayananController::class);
        Route::resource('rumah-sakit', RumahSakitController::class);
        Route::resource('pasien', PasienController::class);

    });
