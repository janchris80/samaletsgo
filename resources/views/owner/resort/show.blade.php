@extends('layouts.backend.app')

@section('title', 'Resort Detail')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('admin.resort.index') }}"><i class="material-icons">event</i>Resort list</a></li>
                <li class="active"><i class="material-icons">remove_red_eye</i> View resort detail</li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-capitalize">
                            {{ $resort->name }}
                            <small><i class="material-icons" style="font-size: small">place</i>{{ $resort->address }}</small>
                        </h2>
                        @foreach ($categories as $category)
                            <span class="label bg-teal">{!! $category->name !!}</span>
                        @endforeach
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="{{ route('owner.resort.edit', $resort->id) }}" class="btn btn-info waves-effect">
                                    EDIT
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {!! $resort->description !!}
                    </div>
                </div>
            </div>
        </div>
        <!--AMENITY-->
        @if(count($amenities))
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-capitalize">
                                Amenity and Rate
                            </h2>
                        </div>
                        <div class="body">
                            <ul>
                                @foreach ($amenities as $amenity)
                                    <li>
                                        {!! $amenity->name !!}
                                    </li>
                                    <ul>
                                        @if ($amenity->description)
                                            <li>{!! $amenity->description !!}</li>
                                        @endif
                                        @if ($amenity->rate)
                                            <li>P{!! $amenity->rate !!}</li>
                                        @endif
                                    </ul>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    <!--ENTRANCE-->
        @if (count($entrances))
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-capitalize">
                                Entrance
                            </h2>
                        </div>
                        <div class="body">
                            <ul>
                                @foreach ($entrances as $entrance)
                                    <li>
                                        {!! $entrance->agetype !!} ({!! $entrance->tour !!})
                                    </li>
                                    <ul>
                                        @if ($entrance->rate)
                                            <li>P{!! $entrance->rate !!}</li>
                                        @endif
                                        @if ($entrance->person)
                                            <li>{!! $entrance->person !!}</li>
                                        @endif
                                        @if ($entrance->description)
                                            <li>{!! $entrance->description !!}</li>
                                        @endif
                                    </ul>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    <!--COTTAGE-->
        @if (count($cottages))
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-capitalize">
                                Cottage
                            </h2>
                        </div>
                        <div class="body">
                            <ul>
                                @foreach ($cottages as $cottage)
                                    <li>
                                        {!! $cottage->name !!}
                                    </li>
                                    <ul>
                                        @if ($cottage->description)
                                            <li>{!! $cottage->description !!}</li>
                                        @endif
                                        @if ($cottage->rate)
                                            <li>P{!! $cottage->rate !!}</li>
                                        @endif
                                        @if ($cottage->person)
                                            <li>Person: {!! $cottage->person !!}</li>
                                        @endif
                                    </ul>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    <!--PACKAGE-->
        @if (count($packages))
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-capitalize">
                                Package
                            </h2>
                        </div>
                        <div class="body">
                            <ul>
                                @foreach ($packages as $package)
                                    <li>
                                        {!! $package->name !!}
                                    </li>
                                    <ul>
                                        @if ($package->description)
                                            <li>{!! $package->description !!}</li>
                                        @endif
                                        @if ($package->rate)
                                            <li>P{!! $package->rate !!}</li>
                                        @endif
                                        @if ($package->person)
                                            <li>Person: {!! $package->person !!}</li>
                                        @endif
                                    </ul>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (count($images))
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="text-capitalize">
                                Images
                            </h2>
                        </div>
                        <div class="body">
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                @foreach ($images as $image)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ asset($image->file_location) }}" data-sub-html="{{ $image->original_name .' | '. $image->size }}">
                                            <img class="img-responsive thumbnail" src="{{ asset($image->file_location) }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop

@push('js')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEW_VqeFNPUDk5Lq0TlACjDFjPEOkct24&callback=initMap"
            type="text/javascript"></script>

    <script>
        $(function () {
            //Basic Map
            var basicMap = new GMaps({
                el: '#gmap_basic_example',
                lat: -12.043333,
                lng: -77.028333
            });

            //Markers
            var markers = new GMaps({
                div: '#gmap_markers',
                lat: -12.043333,
                lng: -77.028333
            });
            markers.addMarker({
                lat: -12.043333,
                lng: -77.03,
                title: 'Lima',
                details: {
                    database_id: 42,
                    author: 'HPNeo'
                },
                click: function (e) {
                    if (console.log)
                        console.log(e);
                    alert('You clicked in this marker');
                }
            });
            markers.addMarker({
                lat: -12.042,
                lng: -77.028333,
                title: 'Marker with InfoWindow',
                infoWindow: {
                    content: '<p>HTML Content</p>'
                }
            });

            //Static maps
            var staticMap = GMaps.staticMapURL({
                size: [$('#gmap_static_map').width(), 400],
                lat: -12.043333,
                lng: -77.028333
            });

            $('<img/>').attr('src', staticMap).appendTo('#gmap_static_map');

            //Static maps with markers
            var staticMapWithMarkers = GMaps.staticMapURL({
                size: [$('#gmap_static_map_with_markers').width(), 400],
                lat: -12.043333,
                lng: -77.028333,
                markers: [
                    { lat: -12.043333, lng: -77.028333 },
                    {
                        lat: -12.045333, lng: -77.034,
                        size: 'small'
                    },
                    {
                        lat: -12.045633, lng: -77.022,
                        color: 'blue'
                    }
                ]
            });

            $('<img/>').attr('src', staticMapWithMarkers).appendTo('#gmap_static_map_with_markers');

            //Static maps with polyline
            var path = [
                [-12.040397656836609, -77.03373871559225],
                [-12.040248585302038, -77.03993927003302],
                [-12.050047116528843, -77.02448169303511],
                [-12.044804866577001, -77.02154422636042],
                [-12.040397656836609, -77.03373871559225],
            ];

            var staticMapPolyline = GMaps.staticMapURL({
                size: [$('#gmap_static_map_polyline').width(), 400],
                lat: -12.043333,
                lng: -77.028333,

                polyline: {
                    path: path,
                    strokeColor: '#131540',
                    strokeOpacity: 0.6,
                    strokeWeight: 6
                    // fillColor: '#ffaf2ecc'
                }
            });

            $('<img/>').attr('src', staticMapPolyline).appendTo('#gmap_static_map_polyline');

            //Panorama
            var panorama = GMaps.createPanorama({
                el: '#gmap_panorama',
                lat: 42.3455,
                lng: -71.0983
            });
        });
    </script>
@endpush
