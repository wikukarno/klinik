@extends('layouts.app')

@section('title', 'Antrian')

@section('content')
    <div class="row row-sm">
        <div class="col-12 col-lg-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-4">Data Antrian</h3>
                    </div>

                    <div class="table-responsive">
                        <table id="tb_antrian" class="table table-hover scroll-horizontal-vertical w-100">
                            <thead>
                                <tr>
                                    <th class="text-start">No</th>
                                    <th class="text-start">Nomor Antrian</th>
                                    <th class="text-start">Layanan</th>
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

    function btnTeruskan(id){
        // console.log(id_antrian);
        $.ajax({
            url: "{{ url('petugas/antrian/teruskan') }}/" + id,
            type: "POST",
            data: {
                _method: 'PUT',
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                console.log(res);
                Swal.fire({
                    title: 'Berhasil!',
                    text: "Antrian berhasil diteruskan.",
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: true
                });
                setTimeout(() => {
                    $('#tb_antrian').DataTable().ajax.reload();
                }, 1500);
            }
        })
    }

    $('#tb_antrian').dataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! url()->current() !!}",
        columns: [
            { data: 'DT_RowIndex', name: 'id_antrian' },
            { data: 'no_antrian', name: 'no_antrian' },
            { data: 'layanan_id', name: 'layanan_id' },
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
            },
        ]
    });

    // function deleteData(id){
    //     Swal.fire({
    //         title: 'Apakah Anda yakin?',
    //         text: "Data yang dihapus tidak dapat dikembalikan!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, Hapus!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: "{{ url('petugas/antrian') }}/" + id,
    //                 type: "POST",
    //                 data: {
    //                     _method: 'DELETE',
    //                     _token: "{{ csrf_token() }}"
    //                 },
    //                 success: function(response) {
    //                     Swal.fire({
    //                         title: 'Berhasil!',
    //                         text: "Data berhasil dihapus.",
    //                         icon: 'success',
    //                         timer: 1500,
    //                         showConfirmButton: true
    //                     });
    //                     setTimeout(() => {
    //                         $('#tb_antrian').DataTable().ajax.reload();
    //                     }, 1500);
    //                 }
    //             });
    //         }
    //     });
    // }
</script>
@endpush