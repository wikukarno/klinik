<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        $rumah_sakit = RumahSakit::all();
        return view('welcome', compact('layanan', 'rumah_sakit'));
    }
}
