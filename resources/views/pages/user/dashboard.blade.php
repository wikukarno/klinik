@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12 ht-lg-100p">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection