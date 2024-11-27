<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Antrian;

class AntrianController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Antrian::with('layanan')->where('posisi', 'petugas')->where('status', 'menunggu');
            return datatables()->of($query)
                ->addIndexColumn()
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
                            <a href="' . route('checkup.edit', $item->id_pasien) . '" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit text-white"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="deleteData(' . $item->id_pasien . ')">
                                <i class="fas fa-trash text-white"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('pages.petugas.antrian.index');
    }
}
