@extends('layouts.app')

@section('title', 'Tambah Data Rumah sakit')

@section('content')
    <div class="row row-sm">
        <div class="col-12 col-lg-12">
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
                    <form action="{{ route('layanan.update', $data->id_layanan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">
                                        Nama Layanan <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" value="{{ $data->nama_layanan }}" class="form-control h-55" name="nama_layanan" placeholder="Masukan nama layanan" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">
                                        Harga Layanan <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="harga_layanan" value="Rp. {{ number_format($data->harga_layanan, 0, ',', '.') }}" class="form-control h-55" name="harga_layanan" placeholder="Masukan harga layanan" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">
                                        Deskripsi Layanan <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control h-55" name="deskripsi_layanan" placeholder="Masukan deskripsi layanan"
                                        required>{{ $data->deskripsi_layanan }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap justify-content-end gap-3">
                                    <a href="{{ route('layanan.index') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Batal</a>
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
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    var rupiah = document.getElementById('harga_layanan');
    rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
</script>
@endpush