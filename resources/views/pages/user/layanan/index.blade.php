@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
    <div class="row row-sm">
        <div class="col-12 col-lg-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-4">Data Layanan</h3>
                    </div>

                    <div class="table-responsive">
                        <table id="tb_layanan" class="table table-hover scroll-horizontal-vertical w-100">
                            <thead>
                                <tr>
                                    <th class="text-start">No</th>
                                    <th class="text-start">Nama</th>
                                    <th class="text-start">Harga Layanan</th>
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

    function daftarLayanan(id){
        $.ajax({
            url: "{{ url('user/layanan/daftar') }}",
            type: "POST",
            data: {
                id_layanan: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(res){
                if(res.status == true){
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#tb_layanan').DataTable().ajax.reload();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            error: function(err){
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: err.responseJSON.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

    $('#tb_layanan').dataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! url()->current() !!}",
        columns: [
            { data: 'DT_RowIndex', name: 'id_layanan' },
            { data: 'nama_layanan', name: 'nama_layanan' },
            { data: 'harga_layanan', name: 'harga_layanan' },
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
        ]
    });
</script>
@endpush