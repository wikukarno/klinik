<?php

namespace App\Http\Controllers\Bidan;

use App\Models\Pasien;
use App\Models\Layanan;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BidanDashboardController extends Controller
{
    public function index()
    {
        $rumah_sakit = RumahSakit::count();
        $layanan = Layanan::count();
        $pasien = Pasien::where('status', 'selesai')->count();
        return view('pages.bidan.dashboard', compact('rumah_sakit', 'layanan', 'pasien'));
    }

}
