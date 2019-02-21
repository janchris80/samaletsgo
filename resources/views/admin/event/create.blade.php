@extends('layouts.backend.app')

@section('title', 'Create event')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('admin.event.index') }}"><i class="material-icons">event</i>Event list</a></li>
                <li class="active"><i class="material-icons">create</i> Create event</li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>CREATE EVENT</h2>
                    </div>
                    <div class="body">
                        <form id="event_form" action="{{ route('admin.event.store') }}" method="POST">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Event name</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control text-capitalize" id="event_form_name" name="name" placeholder="Event name" value="{{ old('name') }}" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control text-capitalize" id="event_form_address" name="address" value="{{ old('address') }}" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Event date</label>
                                        <div class="form-line">
                                            <input type="date" class="form-control date" id="event_form_date" name="date" value="{{ old('date') }}" placeholder="Ex: mm-dd-yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="event_form_description">Description</label>
                                        <div class="form-line">
                                            <textarea class="form-control" rows="10" id="event_form_description" name="description" placeholder="Description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $('#event_form').validate({
            rules: {
                'name': {
                    required: true,
                },
                'address': {
                    required: true,
                },
                'date': {
                    required: true,
                },
                'description': {
                    required: true,
                },
            },
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
                $(element).parents('.form-group').append(error);
            }
        });
    </script>
@endpush
