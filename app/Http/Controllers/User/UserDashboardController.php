<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $layanan = Layanan::count();
        return view('pages.user.dashboard', compact('layanan'));
    }

    public function akun()
    {
        return view('pages.user.akun');
    }

    public function edit()
    {
        return view('pages.user.edit');
    }

    public function update(Request $request, $id)
    {
        try {
            $data = User::findOrFail($id);
            $data->update($request->all());
            
            toast('Data berhasil diubah', 'success');
            return redirect()->route('user.dashboard');
        } catch (\Throwable $th) {
            toast('Data gagal diubah', 'error');
            return redirect()->route('user.akun.edit');
        }
    }
}
