@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row row-sm mg-b-20">
        <div class="col-lg-12 ht-lg-100p">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-xxl-4 col-xl-4 col-sm-12">
                            <div class="card bg-danger bg-opacity-10 border-danger border-opacity-10 rounded-3 mb-4 stats-box style-three">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-19">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined fs-40 text-danger">
                                                local_hospital
                                            </i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <span>Rumah Sakit</span>
                                            <h3 class="fs-20 mt-1 mb-0">
                                                {{ $rumah_sakit }}
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">
                                        <span class="fs-12">Rumah Sakit</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-sm-12">
                            <div
                                class="card bg-success bg-opacity-10 border-success border-opacity-10 rounded-3 mb-4 stats-box style-three">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-19">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined fs-40 text-success">assignment_turned_in</i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <span>Layanan</span>
                                            <h3 class="fs-20 mt-1 mb-0">
                                                {{ $layanan }}
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">
                                        <span class="fs-12">Layanan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-sm-12">
                            <div
                                class="card bg-primary-div bg-opacity-10 border-primary-div border-opacity-10 rounded-3 mb-4 stats-box style-three">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-shrink-0">
                                            <i class="material-symbols-outlined fs-40 text-primary-div">group</i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <span>Pasien</span>
                                            <h3 class="fs-20 mt-1 mb-0">65+</h3>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">
                                        <span class="fs-12">Pasien</span>
                                        <ul class="ps-0 mb-0 list-unstyled d-flex align-items-center">
                                            <li>
                                                <a href="my-profile.html">
                                                    <img src="{{ asset('assets/images/user-16.jpg') }}"
                                                        class="wh-34 lh-34 rounded-circle border border-1 border-color-white" alt="user">
                                                </a>
                                            </li>
                                            <li class="ms-m-15">
                                                <a href="my-profile.html">
                                                    <img src="{{ asset('assets/images/user-17.jpg') }}"
                                                        class="wh-34 lh-34 rounded-circle border border-1 border-color-white" alt="user">
                                                </a>
                                            </li>
                                            <li class="ms-m-15">
                                                <a href="my-profile.html">
                                                    <img src="{{ asset('assets/images/user-18.jpg') }}"
                                                        class="wh-34 lh-34 rounded-circle border border-1 border-color-white" alt="user">
                                                </a>
                                            </li>
                                            <li class="ms-m-15">
                                                <a href="my-profile.html">
                                                    <img src="{{ asset('assets/images/user-19.jpg') }}"
                                                        class="wh-34 lh-34 rounded-circle border border-1 border-color-white" alt="user">
                                                </a>
                                            </li>
                                            <li class="ms-m-15">
                                                <a href="user-list.html"
                                                    class="wh-34 lh-34 rounded-circle bg-primary d-block text-center text-decoration-none text-white fs-12 fw-medium border border-1 border-color-white">+55</a>
                                            </li>
                                        </ul>
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