<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Layanan;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $layanan = Layanan::count();

        // Cari pasien berdasarkan NIK user yang sedang login
        $pasien = Pasien::where('nik_pasien', auth()->user()->nik_pasien)
            ->with('antrian') // Pastikan relasi ada
            ->first();

        // Pastikan pasien ditemukan
        if (!$pasien) {
            return view('pages.user.dashboard', compact('layanan'));
        }

        $noAntrianSaya = $pasien->antrian->no_antrian ?? 'Belum Ada';

        // Ambil antrean berdasarkan pasien dan status
        $antrian = Antrian::where('pasien_id', $pasien->id_pasien)
            ->where('status', 'berlangsung') // Ambil yang sedang berlangsung
            ->first();

        // Ambil nomor antrean yang sedang dipanggil (opsi lain)
        $no_antrian_dipanggil = $antrian ? $antrian->no_antrian : 'Belum Ada';

        return view('pages.user.dashboard', compact('layanan', 'antrian', 'no_antrian_dipanggil', 'noAntrianSaya'));
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
