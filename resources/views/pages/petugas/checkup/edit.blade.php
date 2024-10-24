@extends('layouts.app')

@section('title', 'Tambah Data Rumah sakit')

@section('content')
    <div class="row row-sm">
        <div class="col-12 col-lg-12">
            {{-- Error list --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="col-12 col-lg-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-4">Tambah Data Rumah Sakit</h3>
                    </div>
                    <form action="{{ route('rumah-sakit.update', $data->id_rumah_sakit) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Nama Rumah Sakit</label>
                                    <input type="text" value="{{ $data->nama_rumah_sakit }}" class="form-control h-55" name="nama_rumah_sakit" placeholder="Enter hospital name" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Nomor HP Rumah Sakit</label>
                                    <input type="number" value="{{ $data->no_hp_rumah_sakit }}" class="form-control h-55" name="no_hp_rumah_sakit" placeholder="Enter phone number" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Alamat Rumah Sakit</label>
                                    <input type="text" value="{{ $data->alamat_rumah_sakit }}" class="form-control h-55" name="alamat_rumah_sakit"
                                        placeholder="Enter hospital address" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap justify-content-end gap-3">
                                    <a href="{{ route('rumah-sakit.index') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Batal</a>
                                    <button class="btn btn-primary py-2 px-4 fw-medium fs-16"> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
<script>
    $('#tb_rumahsakit').dataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! url()->current() !!}",
        columns: [
            { data: 'DT_RowIndex', name: 'id_rumah_sakit' },
            { data: 'nama_rumah_sakit', name: 'nama_rumah_sakit' },
            { data: 'no_hp_rumah_sakit', name: 'no_hp_rumah_sakit' },
            { data: 'website_rumah_sakit', name: 'website_rumah_sakit' },
            {
                data: 'action',
                searchable: false,
                sortable: false
            }
        ],
        columnDefs: [
            {
                targets: 0,
                className: 'text-start'
            },
            {
                targets: 1,
                className: 'text-start'
            },
            {
                targets: 2,
                className: 'text-start'
            },
            {
                targets: 3,
                className: 'text-start'
            },
            {
                targets: 4,
                className: 'text-start'
            }
        ]
    });
</script>
@endpush