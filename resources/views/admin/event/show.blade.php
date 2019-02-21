@extends('layouts.backend.app')

@section('title', 'Event detail')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('admin.event.index') }}"><i class="material-icons">event</i>Event list</a></li>
                <li class="active"><i class="material-icons">remove_red_eye</i> View event detail</li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-capitalize">
                            {{ $event->name }}
                            <small>
                                <i class="material-icons" style="font-size: small">place</i>
                                {{ $event->address }}
                            </small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li>
                                <b>Date:</b>
                                {{ date('M d, Y', strtotime($event->date)) }}
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {!! html_entity_decode($event->description) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')

@endpush
