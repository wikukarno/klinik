<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLayananRequest;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LayananController extends Controller
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
        return view('pages.petugas.layanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.petugas.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Menggunakan transaksi untuk memastikan integritas data
        try {
            DB::beginTransaction(); // Mulai transaksi

            // Buat entitas RumahSakit dengan data yang tervalidasi
            Layanan::create([
                'nama_layanan' => $request->nama_layanan,
                'harga_layanan' =>
                str_replace(
                    ['Rp', '.'],
                    ['', ''],
                    $request->harga_layanan
                ),
                'deskripsi_layanan' => $request->deskripsi_layanan,
            ]);


            DB::commit(); // Commit transaksi jika semuanya sukses
            toast('Data berhasil ditambahkan', 'success');
            return to_route('layanan.index');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error

            // Log error
            Log::error('Failed to create Data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            toast('Data gagal ditambahkan', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Layanan::findOrFail($id);
        return view('pages.petugas.layanan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Layanan::findOrFail($id);
        return view('pages.petugas.layanan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $data = Layanan::findOrFail($id);
            $data->update([
                'nama_layanan' => $request->nama_layanan,
                'harga_layanan' =>
                str_replace(
                    ['Rp', '.'],
                    ['', ''],
                    $request->harga_layanan
                ),
                'deskripsi_layanan' => $request->deskripsi_layanan,
            ]);

            DB::commit();
            toast('Data berhasil diubah', 'success');
            return to_route('layanan.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update Data'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            Layanan::findOrFail($id)->delete();

            DB::commit();

            toast('Data berhasil dihapus', 'success');

            return to_route('layanan.index');
        } catch (\Exception $e) {
            DB::rollBack();

            toast('Data gagal dihapus', 'error');

            return back();
        }
    }
}
