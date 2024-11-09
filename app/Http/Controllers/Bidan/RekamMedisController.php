<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = RekamMedis::query();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('harga_layanan', function ($item) {
                    return 'Rp.' . number_format($item->harga_layanan, 0, ',', '.');
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
        return view('pages.bidan.rekam-medis.index');
    }

    public function processRekamMedis(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'anamnesa' => 'required',
            'diagnosa' => 'required',
            'theraphy' => 'required',
            'resep_obat' => 'required',
        ]);

        RekamMedis::create($request->all());
        return redirect()->route('rekam-medis.index');
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
