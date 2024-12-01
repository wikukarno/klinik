<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserRekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Pasien::where('nik_pasien', auth()->user()->nik_pasien)->with('layanan');
            return datatables()->of($query)
                ->addIndexColumn()
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
                                <a href="' . route('user.cetak.rekam.medis', $item->id_pasien) . '" class="btn btn-success btn-sm text-white">
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
        return view('pages.user.rekam-medis.index');
    }

    public function downloadSuratRujukan(string $id)
    {
        $path_upt = base_path('public/upt-kampar.webp');
        $type_upt = pathinfo($path_upt, PATHINFO_EXTENSION);
        $data_upt = file_get_contents($path_upt);
        $pic_upt  = 'data:image/' . $type_upt . ';base64,' . base64_encode($data_upt);

        $path_kesehatan = base_path('public/logo-kesehatan.png');
        $type_kesehatan = pathinfo($path_kesehatan, PATHINFO_EXTENSION);
        $data_kesehatan = file_get_contents($path_kesehatan);
        $pic_kesehatan  = 'data:image/' . $type_kesehatan . ';base64,' . base64_encode($data_kesehatan);

        $pasien = Pasien::find($id);
        $rekam_medis = RekamMedis::where('id_pasien', $id)->first();

        $pdf  = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.cetak.surat-rujukan', [
            'pic_upt' => $pic_upt,
            'pic_kesehatan' => $pic_kesehatan,
            'pasien' => $pasien,
            'rekam_medis' => $rekam_medis,
        ]);

        $tgl_cetak = Carbon::now()->isoFormat('D MMMM Y');
        // return $pdf->download('Surat_Rujukan_' . $tgl_cetak . '.pdf');
        return $pdf->stream('Surat_Rujukan_' . $tgl_cetak . '.pdf');
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
