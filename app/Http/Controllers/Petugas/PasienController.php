<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Pasien::query();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('id_layanan', function ($item) {
                    return $item->layanan->nama_layanan;
                })
                ->editColumn('action', function ($item) {
                    return '
                        <div class="d-flex gap-2">
                            <a href="' . route('layanan.edit', $item->id_layanan) . '" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit text-white"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="deleteData(' . $item->id_layanan . ')">
                                <i class="fas fa-trash text-white"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.petugas.pasien.index');
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
