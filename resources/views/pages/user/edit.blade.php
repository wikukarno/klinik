@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12 ht-lg-100p">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-header">
                <h3 class="card-title">Edit Akun</h3>
            </div>
            <form action="{{ route('user.akun.update', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="nik_pasien">Nomor NIK</label>
                                <input type="nik_pasien" class="form-control" id="nik_pasien" name="nik_pasien"
                                    value="{{ Auth::user()->nik_pasien }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="no_bpjs">Nomor BPJS</label>
                                <input type="no_bpjs" class="form-control" id="no_bpjs" name="no_bpjs"
                                    value="{{ Auth::user()->no_bpjs }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="no_hp_pasien">Nomor HP/ WA</label>
                                <input type="number" class="form-control" id="no_hp_pasien" name="no_hp_pasien"
                                    value="{{ Auth::user()->no_hp_pasien }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ Auth::user()->tanggal_lahir }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-select form-select-lg" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L" {{ Auth::user()->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ Auth::user()->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="alamat_pasien">Alamat</label>
                                <textarea class="form-control" id="alamat_pasien" name="alamat_pasien">{{
                                    Auth::user()->alamat_pasien }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-5">
                        <a href="{{ route('user.akun.index') }}" class="btn btn-secondary col-6">Kembali</a>
                        <button type="submit" class="btn btn-primary col-6">Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection