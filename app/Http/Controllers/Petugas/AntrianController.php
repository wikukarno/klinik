<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AntrianController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Antrian::with('layanan', 'pasien.user')->whereIn('status', ['menunggu', 'dilewati', 'berlangsung']);
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
                        'dilewati' => '<span class="badge bg-secondary text-white">Dilewati</span>',
                        'batal' => '<span class="badge bg-danger text-white">Batal</span>',
                        default => '<span class="badge bg-danger text-white">Error</span>',
                    };
                })
                ->editColumn('action', function ($item) {
                    if($item->status == 'dilewati') {
                        return '
                            <div class="d-flex gap-2">
                                <button class="btn btn-success btn-sm text-white" onClick="btnTeruskan('. $item->id_antrian .')">
                                    Teruskan
                                </button>
                            </div>
                        ';
                    }

                    if($item->status == 'menunggu') {
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
                    }

                    if($item->status == 'berlangsung') {
                        return '
                            <div class="d-flex gap-2">
                                <button class="btn btn-danger btn-sm text-white" onClick="btnLewati(' . $item->id_antrian . ')">
                                    Lewati
                                </button>
                            </div>
                        ';
                    }

                    return '
                        <div class="d-flex gap-2">
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
            if (!$antrian) {
                Log::warning("Antrian dengan ID $id tidak ditemukan.");
                return response()->json([
                    'message' => 'Antrian tidak ditemukan'
                ], 404);
            }

            // jika ada antrian yang sedang berlangsung, maka tidak bisa menerima antrian baru
            $antrian_berlangsung = Antrian::where('status', 'berlangsung')->first();
            if ($antrian_berlangsung) {
                return response()->json([
                    'status' => false,
                    'message' => 'Antrian tidak bisa diteruskan karena masih ada antrian yang sedang berlangsung'
                ]);
            }

            // Perbarui status antrian
            $antrian->status = 'berlangsung';
            $antrian->posisi = 'bidan';
            $antrian->save();
            Log::info("Antrian dengan ID $id berhasil diperbarui ke status 'berlangsung'.");

            // Cari pasien berdasarkan NIK user yang sedang login
            $pasien = Pasien::where('id_pasien', $antrian->pasien_id)
                ->whereIn('status', ['menunggu', 'dilewati'])
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

            // Kirim data perubahan ke server WebSocket
            $data = [
                'no_antrian' => $antrian->no_antrian,
                'status' => $antrian->status,
                'posisi' => $antrian->posisi
            ];

            Http::post('http://localhost:6001/update-antrian', $data);

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
        // Gunakan transaksi untuk memastikan konsistensi data
        DB::beginTransaction();

        try {
            // Cari antrian berdasarkan ID
            $antrian = Antrian::find($id);
            if (!$antrian) {
                Log::warning("Antrian dengan ID $id tidak ditemukan.");
                return response()->json([
                    'status' => false,
                    'message' => 'Antrian tidak ditemukan'
                ]);
            }

            // Perbarui status antrian
            $antrian->status = 'dilewati';
            $antrian->posisi = 'petugas';
            $antrian->save();

            Log::info("Antrian dengan ID $id berhasil diperbarui ke status 'dilewati'.");

            // Cari pasien berdasarkan ID
            $pasien = Pasien::where('id_pasien', $antrian->pasien_id)->first();

            if (!$pasien) {
                Log::warning("Pasien dengan ID " . $antrian->pasien_id . " tidak ditemukan.");
                return response()->json([
                    'status' => false,
                    'message' => 'Pasien tidak ditemukan'
                ]);
            }

            // Perbarui status pasien
            $pasien->status = 'dilewati';
            $pasien->save();

            Log::info("Pasien ditemukan dan diperbarui: " . $pasien->nama);

            // Kirim data perubahan ke server WebSocket
            $data = [
                'no_antrian' => $antrian->no_antrian,
                'status' => $antrian->status,
                'posisi' => $antrian->posisi
            ];

            Http::post('http://localhost:6001/update-antrian', $data);

            Log::info('Data sent to Socket.IO: ', $data);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Antrian berhasil dilewati'
            ]);
        } catch (\Throwable $th) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            Log::error("Kesalahan saat memproses antrian: " . $th->getMessage());

            return response()->json([
                'message' => 'Antrian gagal dilewati',
                'error' => $th->getMessage() // Hanya untuk debugging; sebaiknya dihapus di production
            ], 500);
        }
    }
}
