<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AntrianController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Antrian::with('layanan', 'pasien.user')->where('posisi', 'petugas')->where('status', 'menunggu');
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('nama_pasien', function ($item) {
                    return $item->pasien->user->name;
                })
                ->editColumn('layanan_id', function ($item) {
                    return $item->layanan->nama_layanan;
                })
                ->editColumn('status', function ($item) {
                    return match ($item->status) {
                        'menunggu' => '<span class="badge bg-warning text-white">Menunggu</span>',
                        'berlangsung' => '<span class="badge bg-primary text-white">Berlangsung</span>',
                        'selesai' => '<span class="badge bg-success text-white">Selesai</span>',
                        default => '<span class="badge bg-danger text-white">Error</span>',
                    };
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="d-flex gap-2">
                            <button class="btn btn-success btn-sm text-white" onClick="btnTeruskan('. $item->id_antrian .')">
                                Teruskan
                            </button>
                            <button class="btn btn-danger btn-sm text-white" onClick="btnLewati(' . $item->id_antrian . ')">
                                Lewati
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('pages.petugas.antrian.index');
    }

    public function teruskan(string $id)
    {
        // Gunakan transaksi untuk memastikan konsistensi data
        DB::beginTransaction();

        try {
            // Cari antrian berdasarkan ID
            $antrian = Antrian::find($id);
            Log::info('antrian'. $antrian);
            if (!$antrian) {
                Log::warning("Antrian dengan ID $id tidak ditemukan.");
                return response()->json([
                    'message' => 'Antrian tidak ditemukan'
                ], 404);
            }

            // Perbarui status antrian
            $antrian->status = 'berlangsung';
            $antrian->posisi = 'bidan';
            $antrian->save();
            Log::info("Antrian dengan ID $id berhasil diperbarui ke status 'berlangsung'.");

            // Cari pasien berdasarkan NIK user yang sedang login
            $pasien = Pasien::where('id_pasien', $antrian->pasien_id)
                ->where('status', 'menunggu')
                ->first();

            $pasien->status = 'berlangsung';
            $pasien->save();
            
            if (!$pasien) {
                Log::warning("Pasien dengan NIK " . Auth::user()->nik_pasien . " tidak ditemukan.");
                return response()->json([
                    'message' => 'Pasien tidak ditemukan'
                ], 404);
            }

            Log::info("Pasien ditemukan: " . $pasien->nama);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            return response()->json([
                'message' => 'Antrian berhasil diteruskan'
            ]);
        } catch (\Throwable $th) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            Log::error("Kesalahan saat memproses antrian: " . $th->getMessage());

            return response()->json([
                'message' => 'Antrian gagal diteruskan',
                'error' => $th->getMessage() // Hanya untuk debugging; sebaiknya dihapus di production
            ], 500);
        }
    }


    public function lewati($id)
    {
        $antrian = Antrian::find($id);
        $antrian->status = 'dilewati';
        $antrian->save();

        return response()->json([
            'message' => 'Antrian berhasil dilewati'
        ]);
    }
}
