<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.petugas.checkup.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.petugas.checkup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

            return redirect()->route('petugas.checkup.index');
        } catch (\Throwable $th) {
            DB::rollBack();

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

        return view('pages.petugas.checkup.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

            return redirect()->route('petugas.checkup.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            toast('Data gagal diubah', 'error');

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();

            Pasien::findOrFail($request->id)->delete();

            DB::commit();

            toast('Data berhasil dihapus', 'success');

            return redirect()->route('petugas.checkup.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            toast('Data gagal dihapus', 'error');

            return back();
        }
    }
}
