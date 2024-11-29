<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Layanan;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Layanan::query();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('harga_layanan', function ($item) {
                    return 'Rp.' . number_format($item->harga_layanan, 0, ',', '.');
                })
                ->editColumn('action', function ($item) {
                    $cekStatus = Pasien::where('id_layanan', $item->id_layanan)
                        ->where('nik_pasien', Auth::user()->nik_pasien) // Pastikan cek sesuai dengan pasien yang login
                        ->first();

                    if ($cekStatus && $cekStatus->status == 'menunggu') {
                        // Jika layanan sudah didaftarkan dan statusnya "menunggu"
                        return '
                            <span class="badge bg-warning text-white">Menunggu</span>
                        ';
                    } else {
                        // Jika layanan belum didaftarkan
                        return '
                            <button class="btn btn-warning btn-sm text-white" onClick="daftarLayanan(' . $item->id_layanan . ')">
                                Daftar Layanan
                            </button>
                        ';
                    }

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.user.layanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Ambil user yang sedang login
            $user = Auth::user();

            // Cek apakah pasien berdasarkan NIK sudah ada
            $cekPasien = Pasien::where('nik_pasien', $user->nik_pasien)->first();

            // Log untuk debugging
            Log::info('Pasien ditemukan: ', ['pasien' => $cekPasien]);

            // Jika pasien ditemukan, cek apakah sudah ada dalam antrian "menunggu"
            if ($cekPasien) {
                $antrian = Antrian::where('pasien_id', $cekPasien->id_pasien)
                    ->where('status', 'menunggu')
                    ->first();

                if ($antrian) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Anda sudah terdaftar dalam antrian dengan status "menunggu".'
                    ]);
                }
            }

            // Validasi layanan
            $layanan = Layanan::find($request->id_layanan);
            if (!$layanan) {
                return response()->json([
                    'status' => false,
                    'message' => 'Layanan tidak ditemukan.'
                ]);
            }

            // Jika pasien belum ada, buat pasien baru
            if (!$cekPasien) {
                $cekPasien = Pasien::create([
                    'nik_pasien' => $user->nik_pasien,
                    'id_layanan' => $layanan->id_layanan,
                    'status' => 'menunggu'
                ]);
            }

            // Dapatkan nomor antrian terakhir yang dimulai dengan "A"
            $lastAntrian = Antrian::where('no_antrian', 'like', 'A%')
                ->max('no_antrian');

            // Mengambil angka dari nomor antrian terakhir, jika ada
            $nextNumber = $lastAntrian ? (int) substr($lastAntrian, 1) + 1 : 1;

            // Membuat nomor antrian dengan format "A" dan angka tiga digit
            $no_antrian = 'A' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            // Buat antrian baru
            $antrian = Antrian::create([
                'pasien_id' => $cekPasien->id_pasien,
                'layanan_id' => $layanan->id_layanan,
                'status' => 'menunggu',
                'posisi' => 'petugas',
                'no_antrian' => $no_antrian
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Antrian berhasil dibuat.',
                'data' => $antrian
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error saat membuat antrian: ', ['error' => $th->getMessage()]);

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat memproses antrian.',
                'error' => $th->getMessage()
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
