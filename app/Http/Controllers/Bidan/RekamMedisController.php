<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Pasien::where('status', 'berlangsung');
            return datatables()->of($query)
                ->addIndexColumn()
                ->editColumn('nama_pasien', function ($item) {
                    return $item->user->name;
                })
                ->editColumn('status', function ($item) {
                    return $item->status == 'menunggu' ? '<span class="badge bg-warning text-white">Menunggu</span>' : ($item->status == 'berlangsung' ? '<span class="badge bg-primary">Berlangsung</span>' : '<span class="badge bg-success">Selesai</span>');
                })
                ->editColumn('action', function ($item) {
                    $countStatusBerlangsung = Pasien::where('status', 'berlangsung')->count();
                    if($item->status == 'menunggu'){
                        if($countStatusBerlangsung == 0){
                            return '
                                <div class="d-flex gap-2">
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm text-white" onClick="diagnosa('. $item->id_pasien .')">
                                        <i class="fas fa-stethoscope"></i>
                                        Diagnosa
                                    </a>
                                </div>
                            ';
                        }else{
                            return '
                                <div class="d-flex gap-2">
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm text-white disabled">
                                        <i class="fas fa-stethoscope"></i>
                                        Diagnosa
                                    </a>
                                </div>
                            ';
                        }
                    }

                    if($item->status == 'berlangsung'){
                        return '
                            <div class="d-flex gap-2">
                                <a href="' . route('bidan.proses.rekam.medis', $item->id_pasien) . '" class="btn btn-primary btn-sm text-white">
                                    <i class="fas fa-stethoscope"></i>
                                    Proses
                                </a>
                            </div>
                        ';
                    }

                    if($item->status == 'selesai'){
                        return '
                            <div class="d-flex gap-2">
                                <a href="'. route('bidan.cetak.rekam.medis', $item->id_pasien) .'" class="btn btn-success btn-sm text-white">
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
        return view('pages.bidan.rekam-medis.index');
    }

    public function diagnosa(string $id)
    {
        $pasien = Pasien::with('user')->find($id);
        $antrian = Antrian::where('pasien_id', $id)->first();
        return view('pages.bidan.rekam-medis.diagnosa', compact('pasien', 'antrian'));
    }

    public function cancelProcessRekamMedis(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
        ]);

        try {
            DB::beginTransaction();
            $pasien = Pasien::find($request->id_pasien);
            $pasien->status = 'menunggu';
            $pasien->save();

            DB::commit();
            
            toast('Rekam medis dibatalkan!', 'success');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            toast('Rekam medis gagal dibatalkan!', 'error');
        }
    }

    public function processRekamMedis(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required',
            'diagnosa' => 'required',
            'resep_obat' => 'required',
        ]);


        try {
            DB::beginTransaction();
            RekamMedis::create([
                'id_pasien' => $request->id_pasien,
                'id_bidan' => Auth::id(),
                'resep_obat' => $request->resep_obat,
                'diagnosa' => $request->diagnosa,
                'anamnesa' => $request->anamnesa,
                'theraphy' => $request->theraphy,
            ]);

            $pasien = Pasien::find($request->id_pasien);
            $pasien->status = 'selesai';
            $pasien->save();

            $antrian = Antrian::where('pasien_id', $request->id_pasien)->first();
            $antrian->status = 'selesai';
            $antrian->save();

            // Kirim data perubahan ke server WebSocket
            $data = [
                'no_antrian' => $antrian->no_antrian,
                'status' => $antrian->status,
                'posisi' => $antrian->posisi
            ];

            Http::post('http://localhost:6001/update-antrian', $data);

            DB::commit();
            
            toast('Data berhasil disimpan!', 'success');
            return to_route('rekam-medis.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            toast('Data gagal disimpan!', 'error');
            return back();
        }
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
