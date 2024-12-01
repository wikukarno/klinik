@extends('layouts.app')

@section('title', 'Pasien')

@section('content')
    <div class="row row-sm">
        <div class="col-12 col-lg-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-4">Data Pasien</h3>
                    </div>

                    <div class="table-responsive">
                        <table id="tb_pasien" class="table table-hover scroll-horizontal-vertical w-100">
                            <thead>
                                <tr>
                                    <th class="text-start">No</th>
                                    <th class="text-start">Layanan</th>
                                    <th class="text-start">Harga Layanan</th>
                                    <th class="text-start">Nama</th>
                                    <th class="text-start">Status</th>
                                    <th class="text-start">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
<script>
    $('#tb_pasien').dataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! url()->current() !!}",
        columns: [
            { data: 'DT_RowIndex', name: 'id_pasien' },
            { data: 'id_layanan', name: 'id_layanan' },
            { data: 'harga_layanan', name: 'harga_layanan' },
            { data: 'nama_pasien', name: 'nama_pasien' },
            { data: 'status', name: 'status' },
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
            }
        ]
    });
</script>
@endpush