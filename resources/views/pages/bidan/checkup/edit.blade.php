@extends('layouts.app')

@section('title', 'Edit Data Check Up')

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
                    <h3 class="card-title mb-4">Edit Data Check Up</h3>
                </div>
                <form action="{{ route('pasien.update', $data->id_pasien) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">
                                    Layanan <span class="text-danger">*</span>
                                </label>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control h-55" name="id_layanan" id="id_layana"
                                        required>
                                        <option selected disabled>Pilih Layanan</option>
                                        @forelse ($layanan as $item)
                                        <option value="{{ $item->id_layanan }}" @if ($data->id_layanan == $item->id_layanan)
                                            selected @endif>{{ $item->nama_layanan }}</option>
                                        @empty
                                        <option value="">No data</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">
                                    Nomor NIK <span class="text-danger">*</span>
                                </label>
                                <input type="number" min="1" class="form-control h-55" name="nik_pasien" id="nik_pasien"
                                    placeholder="Masukan NIK pasien" value="{{ $data->nik_pasien }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Nomor BPJS</label>
                                <input type="number" min="1" class="form-control h-55" name="no_bpjs" id="no_bpjs"
                                    placeholder="Masukan nomor BPJS pasien" value="{{ $data->no_bpjs }}">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">
                                    Nama Pasien <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control h-55" name="nama_pasien" id="nama_pasien"
                                    placeholder="Masukan nama pasien" value="{{ $data->nama_pasien }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">
                                    Nomor HP/WA <span class="text-danger">*</span>
                                </label>
                                <input type="number" min="1" class="form-control h-55" name="no_hp_pasien"
                                    id="no_hp_pasien" placeholder="Masukan nomor HP pasien" value="{{ $data->no_hp_pasien }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">
                                    Jenis Kelamin <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-control h-55" name="jenis_kelamin" id="jenis_kelamin"
                                    required>
                                    <option selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="L" @if ($data->jenis_kelamin == 'L') selected @endif>Laki-laki</option>
                                    <option value="P" @if ($data->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">
                                    Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control h-55" name="tanggal_lahir" id="tanggal_lahir"
                                    required value="{{ $data->tanggal_lahir }}">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Tanggal Check Up</label>
                                <input type="date" class="form-control h-55" name="tanggal_checkup"
                                    id="tanggal_checkup" value="{{ $data->tanggal_checkup }}">
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">
                                    Alamat <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control h-55" name="alamat_pasien" id="alamat_pasien"
                                    placeholder="Masukan alamat pasien" required>{{ $data->alamat_pasien }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap justify-content-end gap-3">
                                <a href="{{ route('pasien.index') }}"
                                    class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    Simpan
                                </button>
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
@endpush