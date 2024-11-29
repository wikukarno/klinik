@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12 ht-lg-100p">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="position-relative">
                            <img src="{{ asset('assets/images/profile-bg.jpg') }}" class="rounded-top-3" alt="profile-bg">
                        </div>
                        <div class="card bg-white border-0 rounded-3 mb-4 rounded-top-0">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between flex-wrap gap-3">
                                    <div class="d-flex align-items-end">
                                        <div class="flex-shrink-0 position-relative mt-minus-110">
                                            <img src="{{ asset('assets/images/user-68.jpg') }}" class="rounded-circle border border-2 wh-160" alt="user">
                                            <img src="{{ asset('assets/images/check.svg') }}" class="position-absolute bottom-0 end-0" alt="check">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h4 class="fs-24 mb-1">{{ Auth::user()->name }}</h4>
                                            <span class="fs-15 fw-medium">
                                                {{ Auth::user()->email ?? Auth::user()->peran }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('user.akun.edit') }}" class="btn btn-outline-light text-body fw-medium fs-16 px-4 hover hover-bg">
                                            <i class="ri-edit-line fw-medium fs-18 me-1"></i>
                                            <span>Edit</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection