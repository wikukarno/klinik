<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        return view('pages.petugas.dashboard');
    }
}
