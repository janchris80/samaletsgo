@extends('layouts.backend.app')

@section('title', 'Create tourist')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('admin.tourist.index') }}"><i class="material-icons">map</i>Tourist spot list</a></li>
                <li class="active"><i class="material-icons">create</i> Edit tourist</li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>EDIT TOURIST SPOT</h2>
                    </div>
                    <div class="body">
                        <form id="tourist_form" action="{{ route('admin.tourist.update', $tourist->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tourist spot name</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control text-capitalize" id="tourist_form_name" name="name" placeholder="Event name"
                                                   value="{{ $tourist->name }}" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control text-capitalize" id="tourist_form_address" name="address" placeholder="Address"
                                                   value="{{ $tourist->address }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category">Categories</label>
                                        <div class="form-line">
                                            <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                                @foreach($categories as $category)
                                                    <option
                                                        @foreach($tourist->categories as $touristCategory)
                                                            {{ $touristCategory->id == $category->id ? 'selected' : '' }}
                                                        @endforeach
                                                        value="{{ $category->id }}" >{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tourist_form_description">Description</label>
                                        <div class="form-line">
                                            <textarea class="form-control" rows="10" id="tourist_form_description" name="description" placeholder="Description">{{ $tourist->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script>
        $('#tourist_form').validate({
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
