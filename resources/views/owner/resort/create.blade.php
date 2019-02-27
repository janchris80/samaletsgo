@extends('layouts.backend.app')

@section('title', 'Adding Resort')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('owner.resort.index') }}"><i class="material-icons">event</i>Resort list</a></li>
                <li class="active"><i class="material-icons">create</i> Create resort</li>
            </ol>
        </div>

        <form id="resort_form" action="{{ route('owner.resort.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Resort</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <label for="name" class="form-label">Resort name</label>
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Resort name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <div class="form-line">
                                    <input type="text" id="address" class="form-control" name="address" value="{{ old('address') }}" placeholder="Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-label">Latitude and Longitude</label>
                                <span>(<i>Optional</i> or <a href="https://www.latlong.net/">visit me</a>)</span>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-line">
                                            <input type="text" id="lat" class="form-control" name="lat" value="{{ old('lat') }}" placeholder="Latitude">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-line">
                                            <input type="text" id="lng" class="form-control" name="lng" value="{{ old('lng') }}" placeholder="Longitude">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-label">Front page Image</label>
                                <div class="form-line">
                                    <input type="file" class="form-control" name="file" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Categories</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                    <label for="category">Select Category</label>
                                    <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->name == old('categories') ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Description</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <label for="tinymce" class="form-label"></label>
                                <div class="form-line">
                                    <textarea id="tinymce" rows="10" class="form-control" placeholder="Description" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Entrance & Cottage</h2>
                        </div>
                        <div class="body">

                            <div class="card">
                                <div class="header">
                                    <h2>Entrances</h2>
                                    <ul class="header-dropdown">
                                        <li>
                                            <button type="button" class="btn btn-primary" id="addEntrance">
                                                Add Entrance
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover entranceTable">
                                            <thead>
                                            <tr>
                                                <th>Age Type</th>
                                                <th>Description</th>
                                                <th>Tour</th>
                                                <th>Rate</th>
                                                <th>Person</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="header">
                                    <h2>Cottages</h2>
                                    <ul class="header-dropdown">
                                        <li>
                                            <button type="button" class="btn btn-primary" id="addCottage">
                                                Add Cottage
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover cottageTable">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Rate</th>
                                                <th>Person</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Amenities & Rates</h2>
                            <ul class="header-dropdown">
                                <li>
                                    <button type="button" class="btn btn-primary" id="addResort">
                                        Add Amenity & Rate
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover amenityRateTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Rate</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Packages</h2>
                            <ul class="header-dropdown">
                                <li>
                                    <button type="button" class="btn btn-primary" id="addPackage">
                                        Add Package
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover packageTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Rate</th>
                                        <th>Person</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    </div>

@stop

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script>
        let count_amenity_rate = 1;
        let count_entrance = 1;
        let count_cottage = 1;
        let count_package = 1;
        $('#addResort').on('click', function () {
            count_amenity_rate += 1;
            $('.amenityRateTable tbody').append(
                '<tr id="amenityRateTable'+count_amenity_rate+'">' +
                    '<td><input type="text" class="form-control" name="amenity_name[]" placeholder="Name"></td>' +
                    '<td><input type="text" class="form-control" name="amenity_description[]" placeholder="Description"></td>' +
                    '<td width="130px"><input type="number" class="form-control" name="amenity_rate[]" placeholder="Rate"></td>' +
                    '<td width="80px">' +
                        '<button onclick="removeAmenityRateRow('+count_amenity_rate+')" type="button" class="btn btn-danger waves-effect">' +
                            // '<i class="material-icons" style="font-size: small">delete</i>' +
                            'Remove' +
                        '</button> '+
                    '</td>' +
                '</tr>'
            );
        });

        $('#addEntrance').on('click', function () {
            count_entrance += 1;
            $('.entranceTable tbody').append(
                '<tr id="entranceTable'+count_entrance+'">' +
                    '<td width="110px">' +
                        '<select class="form-control" name="entrance_agetype[]">' +
                            '<option value="Adult">Adult</option> ' +
                            '<option value="Kid">Kid</option> ' +
                            '<option value="Kid and Adult">Kid and Adult</option> ' +
                        '</select>' +
                    '</td>' +
                    '<td><input type="text" class="form-control" name="entrance_description[]" placeholder="Description"></td>' +
                    '<td width="200px">' +
                        '<select class="form-control" name="entrance_tour[]">' +
                            '<option value="Daytour">Daytour</option> ' +
                            '<option value="Overnight">Overnight</option> ' +
                            '<option value="Daytour and Overnight">Daytour and Overnight</option> ' +
                        '</select>' +
                    '</td>' +
                    '<td width="130px"><input type="number" class="form-control" name="entrance_rate[]" placeholder="Rate"></td>' +
                    '<td width="130px"><input type="number" class="form-control" name="entrance_person[]" placeholder="Person"></td>' +
                    '<td width="80px">' +
                        '<button onclick="removeEntranceRow('+count_entrance+')" type="button" class="btn btn-danger waves-effect">' +
                        // '<i class="material-icons" style="font-size: small">delete</i>' +
                        'Remove' +
                        '</button> '+
                    '</td>' +
                '</tr>'
            );
        });

        $('#addCottage').on('click', function () {
            count_cottage += 1;
            $('.cottageTable tbody').append(
                '<tr id="cottageTable'+count_cottage+'">' +
                    '<td><input type="text" class="form-control" id="cottage_name" name="cottage_name[]" placeholder="Name"></td>' +
                    '<td><input type="text" class="form-control" id="cottage_description" name="cottage_description[]" placeholder="Description"></td>' +
                    '<td width="130px"><input type="number" class="form-control" id="cottage_rate" name="cottage_rate[]" placeholder="Rate"></td>' +
                    '<td width="130px"><input type="number" class="form-control" id="cottage_person" name="cottage_person[]" placeholder="Person"></td>' +
                    '<td width="80px">' +
                        '<button onclick="removeCottageRow('+count_cottage+')" type="button" class="btn btn-danger waves-effect">' +
                        // '<i class="material-icons" style="font-size: small">delete</i>' +
                        'Remove' +
                        '</button> '+
                    '</td>' +
                '</tr>'
            );
        });

        $('#addPackage').on('click', function () {
            count_package += 1;
            $('.packageTable tbody').append(
                '<tr id="packageTable'+count_package+'">' +
                    '<td><input type="text" class="form-control" id="package_name" name="package_name[]" placeholder="Name"></td>' +
                    '<td><input type="text" class="form-control" id="package_description" name="package_description[]" placeholder="Description"></td>' +
                    '<td width="130px"><input type="number" class="form-control" id="package_rate" name="package_rate[]" placeholder="Rate"></td>' +
                    '<td width="130px"><input type="number" class="form-control" id="package_person" name="package_person[]" placeholder="Person"></td>' +
                    '<td width="80px">' +
                        '<button onclick="removePackageRow('+count_package+')" type="button" class="btn btn-danger waves-effect">' +
                        // '<i class="material-icons" style="font-size: small">delete</i>' +
                        'Remove' +
                        '</button> '+
                    '</td>' +
                '</tr>'
            );
        });

        function removeAmenityRateRow(id) {
            $('#amenityRateTable'+id).remove();
        }

        function removeEntranceRow(id) {
            $('#entranceTable'+id).remove();
        }

        function removeCottageRow(id) {
            $('#cottageTable'+id).remove();
        }

        function removePackageRow(id) {
            $('#packageTable'+id).remove();
        }

        $(function () {
            $('#resort_form').validate({
                rules: {
                    'name': {
                        required: true
                    },
                    'file': {
                        required: true
                    },
                    'description': {
                        required: true
                    },
                    'address': {
                        required: true
                    },
                    'categories[]': {
                        required: true
                    },
                },
                highlight: function (input) {
                    // console.log(input);
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.input-group').append(error);
                }
            });
        });
    </script>
@endpush
