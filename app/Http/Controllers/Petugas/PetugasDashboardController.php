<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $rumah_sakit = RumahSakit::count();
        $layanan = Layanan::count();
        return view('pages.petugas.dashboard', compact('rumah_sakit', 'layanan'));
    }
}
