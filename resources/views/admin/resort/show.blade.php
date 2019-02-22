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
                                @if($resort->is_approve == false)
                                    <a href="javascript:void(0)" class="btn btn-success waves-effect" onclick="approvePost({{ $resort->id }})">
                                        <i class="material-icons">done</i>
                                        <span>Approve</span>
                                    </a>
                                    <form method="post" action="{{ route('admin.resort.update', $resort->id) }}" id="approval-form" style="display: none">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                @else
                                    <a type="button" class="btn btn-success" disabled>
                                        <i class="material-icons">done</i>
                                        <span>Approved</span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {!! $resort->description !!}
                    </div>
                </div>
            </div>


            <!--AMENITY-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-capitalize">
                            Amenity and Rate
                        </h2>
                    </div>
                    <div class="body">
                        <ul>
                            @if (count($amenities))
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
                            @else
                                <h4><i>No Amenity</i></h4>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!--ENTRANCE-->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="card">
                    <div class="header">
                        <h2 class="text-capitalize">
                            Entrance
                        </h2>
                    </div>
                    <div class="body">
                        <ul>
                            @if (count($entrances))
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
                            @else
                                <h4><i>No Entrance</i></h4>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!--COTTAGE-->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="card">
                    <div class="header">
                        <h2 class="text-capitalize">
                            Cottage
                        </h2>
                    </div>
                    <div class="body">
                        <ul>
                            @if (count($cottages))
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
                            @else
                                <h4><i>No Cottage</i></h4>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!--PACKAGE-->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="card">
                    <div class="header">
                        <h2 class="text-capitalize">
                            Package
                        </h2>
                    </div>
                    <div class="body">
                        <ul>
                            @if (count($packages))
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
                            @else
                                <h4><i>No Package</i></h4>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@push('js')
    <script>
        function approvePost(id) {
            swal({
                title: "Are you sure?",
                text: "You want to approve this resort?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((result) => {
                    if (result) {
                        event.preventDefault();
                        document.getElementById('approval-form').submit();
                        swal("Done! Successfully Approve", {
                            icon: "success",
                        });
                    }
                });
        }
    </script>
@endpush
