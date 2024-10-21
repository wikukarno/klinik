@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row row-sm mg-b-20">
        <div class="col-lg-12 ht-lg-100p">
            <div class="card card-dashboard-one">
                <div class="card-header">
                    <div>
                        <h6 class="card-title">Website Audience Metrics</h6>
                        <p class="card-text">Audience to which the users belonged while on the current date range.</p>
                    </div>
                    <div class="btn-group">
                        <button class="btn active">Day</button>
                        <button class="btn">Week</button>
                        <button class="btn">Month</button>
                    </div>
                </div><!-- card-header -->
                <div class="card-body">
                    <div class="card-body-top">
                        <div>
                            <label class="mg-b-0">Users</label>
                            <h2>13,956</h2>
                        </div>
                        <div>
                            <label class="mg-b-0">Bounce Rate</label>
                            <h2>33.50%</h2>
                        </div>
                        <div>
                            <label class="mg-b-0">Page Views</label>
                            <h2>83,123</h2>
                        </div>
                        <div>
                            <label class="mg-b-0">Sessions</label>
                            <h2>16,869</h2>
                        </div>
                    </div><!-- card-body-top -->
                    <div class="flot-chart-wrapper">
                        <div id="flotChart" class="flot-chart"></div>
                    </div><!-- flot-chart-wrapper -->
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>
@endsection