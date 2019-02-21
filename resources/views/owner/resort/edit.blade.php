@extends('layouts.backend.app')

@section('title', 'Edit Resort')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('owner.resort.index') }}"><i class="material-icons">event</i>Resort list</a></li>
                <li class="active"><i class="material-icons">edit</i> Edit resort</li>
            </ol>
        </div>

        <form id="resort_form" action="{{ route('owner.resort.update', $resort->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row clearfix">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Editing Resort</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <label for="name" class="form-label">Resort name</label>
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $resort->name }}" placeholder="Resort name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <div class="form-line">
                                    <input type="text" id="address" class="form-control" name="address" value="{{ $resort->address }}" placeholder="Address">
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
                                        @foreach($categories as $datum)
                                            <option value="{{ $datum->id }}"
                                                    @foreach ($category as $cat)
                                                        {{ $cat->id == $datum->id ? 'selected' : '' }}
                                                    @endforeach
                                            >{{ $datum->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE CHANGES</button>
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
                                    <textarea id="tinymce" rows="10" class="form-control" placeholder="Description" name="description">{{ $resort->description }}</textarea>
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
                            <ul class="header-dropdown">
                                <li>
                                    <button type="button" class="btn btn-primary" id="addEntrance">
                                        Add Entrance
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="body">

                            <div class="card">
                                <div class="header">
                                    <h2>Entrances</h2>
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
                                            @foreach ($entrances as $key => $datum)
                                                <tr id="entranceTable{{ $key }}">
                                                    <td width="110px">
                                                        <select class="form-control" name="entrance_agetype[]">
                                                            <option value="Adult" {{ $datum->agetype == 'Adult' ? 'selected' : '' }}>Adult</option>
                                                            <option value="Kid" {{ $datum->agetype == 'Kid' ? 'selected' : '' }}>Kid</option>
                                                            <option value="Kid and Adult" {{ $datum->agetype == 'Kid and Adult' ? 'selected' : '' }}>Kid and Adult</option>
                                                            </select>
                                                        </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="entrance_description[]" placeholder="Description" value="{{ $datum->description }}">
                                                        <input type="hidden" class="form-control" name="entrance_id[]" value="{{ $datum->id }}">
                                                    </td>
                                                    <td width="200px">
                                                        <select class="form-control" name="entrance_tour[]">
                                                            <option value="Daytour" {{ $datum->tour == 'Daytour' ? 'selected' : '' }}>Daytour</option>
                                                            <option value="Overnight" {{ $datum->tour == 'Overnight' ? 'selected' : '' }}>Overnight</option>
                                                            <option value="Daytour and Overnight" {{ $datum->tour == 'Daytour and Overnight' ? 'selected' : '' }}>Daytour and Overnight</option>
                                                            </select>
                                                        </td>
                                                    <td width="130px">
                                                        <input type="number" class="form-control" name="entrance_rate[]" placeholder="Rate" value="{{ $datum->rate }}">
                                                    </td>
                                                    <td width="130px">
                                                        <input type="number" class="form-control" name="entrance_person[]" placeholder="Person" value="{{ $datum->person }}">
                                                    </td>
                                                    <td width="80px">
                                                        <button onclick="removeEntranceRow({{ $key }})" type="button" class="btn btn-danger waves-effect">Remove</button>
                                                        </td>
                                                    </tr>
                                            @endforeach
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
                                            @foreach ($cottages as $key => $datum)
                                                <tr id="cottageTable{{ $key }}">
                                                    <td>
                                                        <input type="text" class="form-control" id="cottage_name" name="cottage_name[]" placeholder="Name" value="{{ $datum->name }}">
                                                        <input type="hidden" class="form-control" name="cottage_id[]" value="{{ $datum->id }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="cottage_description" name="cottage_description[]" placeholder="Description" value="{{ $datum->description }}">
                                                    </td>
                                                    <td width="130px">
                                                        <input type="number" class="form-control" id="cottage_rate" name="cottage_rate[]" placeholder="Rate" value="{{ $datum->rate }}">
                                                    </td>
                                                    <td width="130px">
                                                        <input type="number" class="form-control" id="cottage_person" name="cottage_person[]" placeholder="Person" value="{{ $datum->person }}">
                                                    </td>
                                                    <td width="80px">
                                                        <button onclick="removeCottageRow({{ $key }})" type="button" class="btn btn-danger waves-effect">Remove</button>
                                                        </td>
                                                    </tr>
                                            @endforeach
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
                                    @foreach ($amenities as $key => $datum)
                                        <tr id="amenityRateTable{{ $key }}">
                                            <td>
                                                <input type="text" class="form-control" name="amenity_name[]" placeholder="Name" value="{{ $datum->name }}">
                                                <input type="hidden" class="form-control" name="amenity_id[]" value="{{ $datum->id }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="amenity_description[]" placeholder="Description" value="{{ $datum->description }}">
                                            </td>
                                            <td width="130px">
                                                <input type="number" class="form-control" name="amenity_rate[]" placeholder="Rate" value="{{ $datum->rate }}">
                                            </td>
                                            <td width="80px">
                                                <button onclick="removeAmenityRateRow({{ $key }})" type="button" class="btn btn-danger waves-effect">Remove</button>
                                            </td>
                                            </tr>
                                    @endforeach
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
                                    @foreach ($packages as $key => $datum)
                                        <tr id="packageTable{{ $key }}">
                                            <td>
                                                <input type="text" class="form-control" id="package_name" name="package_name[]" placeholder="Name" value="{{ $datum->name }}">
                                                <input type="hidden" class="form-control" name="package_id[]" value="{{ $datum->id }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="package_description" name="package_description[]" placeholder="Description" value="{{ $datum->description }}">
                                            </td>
                                            <td width="130px">
                                                <input type="number" class="form-control" id="package_rate" name="package_rate[]" placeholder="Rate" value="{{ $datum->rate }}">
                                            </td>
                                            <td width="130px">
                                                <input type="number" class="form-control" id="package_person" name="package_person[]" placeholder="Person" value="{{ $datum->person }}">
                                            </td>
                                            <td width="80px">
                                                <button onclick="removePackageRow({{ $key }})" type="button" class="btn btn-danger waves-effect">Remove</button>
                                            </td>
                                            </tr>
                                    @endforeach
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
        let count_amenity_rate = $('.amenityRateTable tbody tr').length;
        let count_entrance = $('.entranceTable tbody tr').length;
        let count_cottage = $('.cottageTable tbody tr').length;
        let count_package = $('.packageTable tbody tr').length;
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
    </script>
@endpush
