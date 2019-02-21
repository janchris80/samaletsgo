@extends('layouts.backend.app')

@section('title', 'Create Category')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('admin.category.index') }}"><i class="material-icons">map</i>Category list</a></li>
                <li class="active"><i class="material-icons">create</i> Edit category</li>
            </ol>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>EDIT CATEGORY</h2>
                    </div>
                    <div class="body">
                        <form id="hotline_form" action="{{ route('admin.category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category name</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control text-capitalize" name="name" placeholder="Category name" value="{{ $category->name }}" autofocus>
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
