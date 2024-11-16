<?php

namespace App\Http\Controllers\Bidan;

use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = RumahSakit::query();
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('action', function ($item) {
                    return '
                        <div class="d-flex gap-2">
                            <a href="' . route('rumah-sakit.edit', $item->id_rumah_sakit) . '" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit text-white"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="deleteData(' . $item->id_rumah_sakit . ')">
                                <i class="fas fa-trash text-white"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.petugas.rumah-sakit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.petugas.rumah-sakit.create');
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
            RumahSakit::create([
                'nama_rumah_sakit' => $request->nama_rumah_sakit,
                'no_hp_rumah_sakit' => $request->no_hp_rumah_sakit,
                'alamat_rumah_sakit' => $request->alamat_rumah_sakit,
            ]);

            // Jika diperlukan, bisa melakukan operasi tambahan di dalam transaksi

            DB::commit(); // Commit transaksi jika semuanya sukses
            toast('Rumah Sakit berhasil ditambahkan', 'success');
            return to_route('rumah-sakit.index');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error

            // Log error
            Log::error('Failed to create Rumah Sakit', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            toast('Rumah Sakit gagal ditambahkan', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = RumahSakit::findOrFail($id);
        return view('pages.petugas.rumah-sakit.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = RumahSakit::findOrFail($id);
        return view('pages.petugas.rumah-sakit.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $data = RumahSakit::findOrFail($id);

            $data->update([
                'nama_rumah_sakit' => $request->nama_rumah_sakit,
                'no_hp_rumah_sakit' => $request->no_hp_rumah_sakit,
                'alamat_rumah_sakit' => $request->alamat_rumah_sakit,
            ]);

            DB::commit();
            toast('Rumah Sakit berhasil diupdate', 'success');
            return to_route('rumah-sakit.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error
            Log::error('Failed to update Rumah Sakit', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            toast('Rumah Sakit gagal diupdate', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $data = RumahSakit::findOrFail($id);

            $data->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete Rumah Sakit', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to delete Rumah Sakit'], 500);
        }
    }
}
