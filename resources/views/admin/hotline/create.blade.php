@extends('layouts.backend.app')

@section('title', 'Create Hotline')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('admin.hotline.index') }}"><i class="material-icons">map</i>Hotline list</a></li>
                <li class="active"><i class="material-icons">create</i> Create hotline</li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>CREATE HOTLINE</h2>
                    </div>
                    <div class="body">
                        <form id="hotline_form" action="{{ route('admin.hotline.store') }}" method="POST">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact name</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control text-capitalize" name="name" placeholder="Contact name" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telephone no.</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control text-capitalize" name="number" placeholder="Telephone no.">
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
        $('#hotline_form').validate({
            rules: {
                'name': {
                    required: true,
                },
                'number': {
                    required: true,
                }
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
