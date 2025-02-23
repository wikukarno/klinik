<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class BidanPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Pasien::with('layanan')->where('status', 'selesai');
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('id_layanan', function ($item) {
                    return $item->layanan->nama_layanan;
                })
                ->editColumn('harga_layanan', function ($item) {
                    return 'Rp ' . number_format($item->layanan->harga_layanan, 0, ',', '.');
                })
                ->editColumn('nama_pasien', function ($item) {
                    return $item->user->name;
                })
                ->editColumn('status', function ($item) {
                    return $item->status == 'menunggu' ? '<span class="badge bg-warning text-white">Menunggu</span>' : ($item->status == 'berlangsung' ? '<span class="badge bg-primary">Berlangsung</span>' : '<span class="badge bg-success">Selesai</span>');
                })
                ->editColumn('action', function ($item) {
                    if ($item->status == 'selesai') {
                        return '
                            <div class="d-flex gap-2">
                                <a href="' . route('bidan.cetak.rekam.medis', $item->id_pasien) . '" class="btn btn-success btn-sm text-white">
                                    <i class="fas fa-file-medical text-white"></i>
                                    Download
                                </a>
                            </div>
                        ';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('pages.bidan.pasien.index');
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
        //
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
