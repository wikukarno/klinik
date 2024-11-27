<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Layanan;
use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        $rumah_sakit = RumahSakit::all();
        return view('welcome', compact('layanan', 'rumah_sakit'));
    }

    public function daftarAntrianPasien(Request $request)
    {
        DB::transaction();
        try {
            
            // daftar antrian pasien
            $biodata = Pasien::create([
                'nomor_nik' => $request->nomor_nik,
                'nomor_bpjs' => $request->nomor_bpjs,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'layanan_id' => $request->layanan_id,
            ]);

            // daftarkan antrian pasien sesuai dengan biodata yang telah dibuat
            
            // Mendapatkan nomor antrian terakhir dengan format "A" di depannya
            $lastAntrian = Antrian::where('no_antrian', 'like', 'A%')->max('no_antrian');

            // Mengambil angka dari nomor antrian terakhir, jika ada
            $nextNumber = $lastAntrian ? (int) substr($lastAntrian, 1) + 1 : 1;

            // Membuat nomor antrian dengan format "A" dan angka tiga digit
            $no_antrian = 'A' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            // Membuat antrian pasien
            Antrian::create([
                'no_antrian' => $no_antrian,
                'pasien_id' => $biodata->id,
                'layanan_id' => $request->layanan_id,
                'status' => 'menunggu',
            ]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendaftar antrian pasien'
            ]);
        }
    }
}
