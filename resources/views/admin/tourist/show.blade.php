@extends('layouts.backend.app')

@section('title', 'Event detail')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('admin.tourist.index') }}"><i class="material-icons">map</i>Tourist spot list</a></li>
                <li class="active"><i class="material-icons">remove_red_eye</i> View tourist spot detail</li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-capitalize">
                            {{ $data->name }}
                            <small>
                                <i class="material-icons" style="font-size: small">place</i>
                                {{ $data->address }}
                            </small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="{{ route('admin.tourist.edit', $data->id) }}" class="btn btn-info
                                 waves-effect">
                                    Edit
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {!! html_entity_decode($data->description) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')

@endpush
