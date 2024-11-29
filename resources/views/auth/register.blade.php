@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header text-center">
                    <img src="{{ asset('logo.png') }}" class="mb-3" alt="Logo" width="100">
                    <h1>
                        Selamat Datang Di <br>
                        <span style="color: #007bff">Aplikasi Klinik Riska Yeni</span>
                    </h1>
                    <p>
                        Silahkan daftar untuk membuat akun baru.
                    </p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{ __('Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('Email Address') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                            
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="nik_pasien" class="form-label">{{ __('Nomor NIK') }}

                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="nik_pasien" type="number" class="form-control @error('nik_pasien') is-invalid @enderror" name="nik_pasien"
                                        value="{{ old('nik_pasien') }}" required>
                                    
                                    @error('nik_pasien')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="no_bpjs" class="form-label">{{ __('Nomor BPJS') }}
                                            
                                            <span class="text-danger">*</span>
                                    </label>
                                    <input id="no_bpjs" type="number" class="form-control @error('no_bpjs') is-invalid @enderror" name="no_bpjs"
                                        value="{{ old('no_bpjs') }}" autocomplete="no_bpjs">
                            
                                    @error('no_bpjs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="tanggal_lahir" class="form-label">{{ __('Tanggal Lahir') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" required>
                            
                                    @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="no_hp_pasien" class="form-label">{{ __('Nomor HP/WA') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="no_hp_pasien" type="number" class="form-control @error('no_hp_pasien') is-invalid @enderror" name="no_hp_pasien" required>
                            
                                    @error('no_hp_pasien')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">{{ __('Jenis Kelamin') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    
                                    <select id="jenis_kelamin" class="form-select form-select-lg @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                            
                                    @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="alamat_pasien" class="form-label">{{ __('Alamat Lahir') }}
                                            
                                            <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="alamat" class="form-control @error('alamat_pasien') is-invalid @enderror" name="alamat_pasien" rows="3" required></textarea>

                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary" style="background: #007bff">
                                {{ __('Daftar Sekarang') }}
                            </button>
                        </div>

                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <a href="{{ route('login') }}">
                                {{ __('Sudah punya akun?') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
