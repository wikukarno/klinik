<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $rumah_sakit = RumahSakit::count();
        $layanan = Layanan::count();
        $pasien = Pasien::count();
        return view('pages.petugas.dashboard', compact('rumah_sakit', 'layanan', 'pasien'));
    }
}
