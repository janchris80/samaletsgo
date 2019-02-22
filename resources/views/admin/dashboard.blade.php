@extends('layouts.backend.app')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Content -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon">
                        <a href="javascript:void(0)">
                            <i class="material-icons col-red">beach_access</i>
                        </a>
                    </div>
                    <div class="content">
                        <div class="text">REGISTERED RESORTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ count($resorts) }}" data-speed="1500" data-fresh-interval="20">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-4 bg-orange hover-zoom-effect">
                    <div class="icon">
                        <a href="javascript:void(0)">
                            <i class="material-icons col-red">beach_access</i>
                        </a>
                    </div>
                    <div class="content">
                        <div class="text">PENDING</div>
                        <div class="number count-to" data-from="0" data-to="{{ count($pending) }}" data-speed="1500" data-fresh-interval="20">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-4 bg-light-green hover-zoom-effect">
                    <div class="icon">
                        <a href="javascript:void(0)">
                            <i class="material-icons col-red">beach_access</i>
                        </a>
                    </div>
                    <div class="content">
                        <div class="text">APPROVED</div>
                        <div class="number count-to" data-from="0" data-to="{{ count($approved) }}" data-speed="1500" data-fresh-interval="20">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            @foreach ($categories as $key => $category)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">{{ $category->name }}</div>
                            <div class="number count-to" data-from="0" data-to="{!! $category_resort[$key] + $category_tourist[$key] !!}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Top 5 Trending Resort</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Rating</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Isla Reta</td>
                                    <td>1,500</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Bluejazz</td>
                                    <td>905</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Bluebliss</td>
                                    <td>456</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td></td>
                                    <td>413</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td></td>
                                    <td>401</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('assets/backend/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.time.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
@endpush
