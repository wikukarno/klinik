@extends('layouts.auth')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <img src="{{ asset('logo.png') }}" class="mb-3" alt="Logo" width="100">
                    <h1>
                        Selamat Datang Di <br>
                        <span style="color: #007bff">Aplikasi Klinik Riska Yeni</span>
                    </h1>
                    <p>
                        Silahkan masuk ke sistem <br>
                        menggunakan akun yang telah terdaftar.
                    </p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-lg-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary col-12">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        {{-- <div class="row text-center">
                            <div class="col-12 col-lg-12">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
    .container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
        font-weight: 600;
        padding: 10px 20px;
    }

    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 1rem;
        padding: 10px;
    }

    .form-check {
        margin-top: 1rem;
    }

    .form-check-input {
        margin-top: 0.3rem;
    }

    .form-check-label {
        margin-left: 0.5rem;
    }

    .btn-primary {
        background-color: #007bff;
        border: 1px solid #007bff;
        border-radius: 5px;
        color: #ffffff;
        font-size: 1rem;
        padding: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border: 1px solid #0056b3;
    }

    .btn-link {
        color: #007bff;
        font-size: 1rem;
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.9rem;
    }
</style>
@endpush