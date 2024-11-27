<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $layanan = Layanan::count();
        return view('pages.user.dashboard', compact('layanan'));
    }
}
