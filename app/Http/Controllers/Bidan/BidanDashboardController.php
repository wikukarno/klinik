<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidanDashboardController extends Controller
{
    public function index()
    {
        return view('pages.bidan.dashboard');
    }

}
