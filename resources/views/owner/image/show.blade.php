@extends('layouts.backend.app')

@section('title', 'ResortController')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/dropzone/min/dropzone.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('owner.resort.index') }}"><i class="material-icons">event</i>Resort list</a></li>
                <li class="active"><i class="material-icons">image</i> Add image</li>
            </ol>
        </div>

        <!-- Content -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            RESORTS LIST
                            <label class="label label-info"></label>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="#" class="btn bg-teal waves-effect">
                                    ADD RESORT
                                </a>
                            </li>
                        </ul>

                    </div>
                    <div class="body">
                        {{--<h3 class="jumbotron">Laravel Multiple Images Upload Using Dropzone</h3>--}}
                        {{--<form method="post" action="{{ route('owner.image.store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">--}}
                            {{--@csrf--}}
                            {{--<input hidden name="id" value="{{ $resort['id'] }}">--}}
                        {{--</form>--}}

                        <form action="{{ route('owner.image.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="form-control" name="images" />
                            <input type="hidden" class="form-control" name="id" value="{{ $resort['id'] }}"/>
                            <input type="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@stop

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/dropzone/min/dropzone.min.js') }}"></script>

    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                maxFilesize: 10000,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    console.log(file);
                    return time+file.name;
                },
                acceptedFiles: ".jpeg, .jpg, .png, .gif",
                addRemoveLinks: true,
                timeout: 5000,
                success: function(file, response)
                {
                    console.log(file);
                    console.log(response);
                },
                error: function(file, response)
                {
                    console.log(file);
                    console.log(response);
                    return false;
                }
            };
    </script>
@endpush
