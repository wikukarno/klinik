<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Pasien;
use App\Models\Layanan;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CheckUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Pasien::whereIn('status', ['menunggu', 'berlangsung']);
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('id_layanan', function ($item) {
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

        return view('pages.petugas.checkup.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $layanan = Layanan::all();
        $rumahSakit = RumahSakit::all();
        return view('pages.petugas.checkup.create', compact('layanan', 'rumahSakit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_layanan' => 'required|exists:layanan,id_layanan',
            'nik_pasien' => 'required|unique:pasien,nik_pasien',
            'no_bpjs' => 'nullable',
            'nama_pasien' => 'required|string',
            'no_hp_pasien' => 'required|numeric',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'tanggal_checkup' => 'nullable|date',
            'alamat_pasien' => 'required|string',
        ]);
        try {
            DB::beginTransaction();

            Pasien::create([
                'id_layanan' => $request->id_layanan,
                'nik_pasien' => $request->nik_pasien,
                'no_bpjs' => $request->no_bpjs,
                'nama_pasien' => $request->nama_pasien,
                'no_hp_pasien' => $request->no_hp_pasien,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tanggal_checkup' => $request->tanggal_checkup,
                'alamat_pasien' => $request->alamat_pasien,
            ]);

            DB::commit();

            toast('Data berhasil disimpan', 'success');

            return redirect()->route('checkup.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            toast('Data gagal disimpan', 'error');

            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pasien::with('layanan')->findOrFail($id);

        return view('pages.petugas.checkup.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pasien::findOrFail($id);
        $layanan = Layanan::all();
        return view('pages.petugas.checkup.edit', compact('data', 'layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_layanan' => 'required|exists:layanan,id_layanan',
            'nik_pasien' => 'required|unique:pasien,nik_pasien,' . $id . ',id_pasien',
            'no_bpjs' => 'nullable',
            'nama_pasien' => 'required|string',
            'no_hp_pasien' => 'required|numeric',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'tanggal_checkup' => 'nullable|date',
            'alamat_pasien' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            Pasien::findOrFail($id)->update([
                'id_layanan' => $request->id_layanan,
                'nik_pasien' => $request->nik_pasien,
                'no_bpjs' => $request->no_bpjs,
                'nama_pasien' => $request->nama_pasien,
                'no_hp_pasien' => $request->no_hp_pasien,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tanggal_checkup' => $request->tanggal_checkup,
                'alamat_pasien' => $request->alamat_pasien,
            ]);

            DB::commit();

            toast('Data berhasil diubah', 'success');

            return redirect()->route('checkup.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            toast('Data gagal diubah', 'error');

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            Pasien::findOrFail($id)->delete();

            DB::commit();

            toast('Data berhasil dihapus', 'success');

            return redirect()->route('checkup.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            toast('Data gagal dihapus', 'error');

            return back();
        }
    }
}
