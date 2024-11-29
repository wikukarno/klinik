@extends('layouts.app')

@section('title', 'Diagnosa Pasien - ' . $pasien->nama_pasien)

@section('content')
<div class="row row-sm">
    <div class="col-12 col-lg-12">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body">
                <div class="row">
                    <h3 class="card-title">Data Rekam Medis</h3>
                    
                    <div class="table-responsive mt-3">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID Layanan</th>
                                    <td>{{ $pasien->layanan->nama_layanan }}</td>
                                </tr>
                                <tr>
                                    <th>NIK Pasien</th>
                                    <td>{{ $pasien->user->nik_pasien }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor BPJS</th>
                                    <td>{{ $pasien->user->no_bpjs ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Antrian</th>
                                    <td>{{ $antrian->no_antrian }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Pasien</th>
                                    <td>{{ $pasien->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>No. HP Pasien</th>
                                    <td>{{ $pasien->user->no_hp_pasien }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $pasien->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ Carbon\Carbon::parse($pasien->user->tanggal_lahir)->isoFormat('D MMMM Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Pasien</th>
                                    <td>{{ $pasien->user->alamat_pasien }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12 col-lg-12">
                        <h3 class="card-title">
                            Diagnosa
                        </h3>
                    </div>
                    <form action="{{ route('bidan.store.rekam.medis') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pasien" value="{{ $pasien->id_pasien }}">
                    
                        <div class="mb-3">
                            <label for="diagnosa" class="form-label">Diagnosa <span class="text-danger">*</span></label>
                            <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3" required>{{ old('diagnosa') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="resep_obat" class="form-label">Resep Obat <span class="text-danger">*</span></label>
                            <textarea name="resep_obat" id="resep_obat" class="form-control" rows="3" required>{{ old('resep_obat')
                                }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="anamnesa" class="form-label">Anamnesa</label>
                            <textarea name="anamnesa" id="anamnesa" class="form-control" rows="3">{{ old('anamnesa') }}</textarea>
                        </div>
                    
                        <div class="mb-3">
                            <label for="theraphy" class="form-label">Theraphy</label>
                            <textarea name="theraphy" id="theraphy" class="form-control" rows="3">{{ old('theraphy') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <ul>
                                <li>
                                    Tanda <span class="text-danger">*</span> menandakan kolom wajib diisi.
                                </li>
                            </ul>
                        </div>
                    
                        <div class="grid text-end mt-5">
                            <a href="javascript:void(0)" class="btn btn-danger text-white" onclick="batalDiagnosa({{ $pasien->id_pasien }})">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script>
    function batalDiagnosa(id){
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang sudah diinputkan tidak akan tersimpan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('bidan.cancel.rekam.medis', '') }}/" + id,
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_pasien: id
                    },
                    success: function(response){
                        window.location.href = "{{ route('rekam-medis.index') }}";
                    }
                });
            }
        });
    }
</script>
@endpush