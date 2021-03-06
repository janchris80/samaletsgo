@extends('layouts.backend.app')

@section('title', 'Event')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">

        <!-- EVENT -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            EVENTS LIST
                            <label class="label label-info">{{ $events->count() }}</label>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover eventTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($events as $key => $datum)
                                    <tr>
                                        <td>{{ $datum->name }}</td>
                                        <td>{{ $datum->address }}</td>
                                        <td width="100px">{{ date('M d, Y', strtotime($datum->date)) }}</td>
                                        <td width="170px">{{ date('M d, Y h:i:s A', strtotime($datum->updated_at)) }}</td>
                                        <td width="150px">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="deleteData({{ $datum->id }})">
                                                            <i class="material-icons">restore</i>Restore
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <form id="deleteForm{{ $datum->id }}" action="{{ route('admin.archive.destroy', $datum->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input hidden value="event" name="delete">
                                            </form>
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

        <!-- HOTLINE -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            HOTLINES LIST
                            <label class="label label-info">{{ $hotlines->count() }}</label>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover hotlineTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($hotlines as $key => $datum)
                                    <tr>
                                        <td>{{ str_limit($datum->name, 50) }}</td>
                                        <td width="120px">{{ $datum->number }}</td>
                                        <td width="170px">{{ date('M d, Y h:i:s A', strtotime($datum->updated_at)) }}</td>
                                        <td width="150px">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="deleteData({{ $datum->id }})">
                                                            <i class="material-icons">restore</i>Restore
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <form id="deleteForm{{ $datum->id }}" action="{{ route('admin.archive.destroy', $datum->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input hidden value="hotline" name="delete">
                                            </form>
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

        <!-- RESORT -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            RESORTS LIST
                            <label class="label label-info">{{ $resorts->count() }}</label>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover resortTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($resorts as $datum)
                                    <tr>
                                        <td>{{ $datum->name }}</td>
                                        <td width="80px">
                                            <label class="label {{ $datum->is_approve ? 'label-success' : 'label-warning' }}">
                                                {{ $datum->is_approve ? 'APPROVED' : 'PENDING' }}
                                            </label>
                                        </td>
                                        <td width="170px">{{ date('M d, Y h:i:s A', strtotime($datum->updated_at)) }}</td>
                                        <td width="150px">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="deleteData({{ $datum->id }})">
                                                            <i class="material-icons">restore</i>Restore
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <form id="deleteForm{{ $datum->id }}" action="{{ route('admin.archive.destroy', $datum->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input hidden value="resort" name="delete">
                                            </form>
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

        <!-- TOURIST -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TOURISTS SPOT LIST
                            <label class="label label-info">{{ $tourists->count() }}</label>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover touristTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Categories</th>
                                    <th>Address</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tourists as $key => $datum)
                                    <tr>
                                        <td>{{ str_limit($datum->name, 20) }}</td>
                                        <td>
                                            @foreach($datum->categories as $category)
                                                <span class="label bg-teal">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $datum->address }}</td>
                                        <td width="170px">{{ date('M d, Y h:i:s A', strtotime($datum->updated_at)) }}</td>
                                        <td width="150px">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="deleteData({{ $datum->id }})">
                                                            <i class="material-icons">restore</i>Restore
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <form id="deleteForm{{ $datum->id }}" action="{{ route('admin.archive.destroy', $datum->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input hidden value="tourist" name="delete">
                                            </form>
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

@stop

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script>
        $(function () {
            $('.eventTable').dataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print',
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },

                ],
                order: [3, 'desc']
            });
        });
        function deleteData(id) {
            swal({
                title: 'Are you sure?',
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: true,
                },
            }).then( willDelete => {
                if(willDelete){
                    $('#deleteForm'+id).submit();
                }
            });
        }
    </script>

    <script>
        $(function () {
            $('.hotlineTable').dataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print',
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },

                ],
                order: [3, 'desc']
            });
        });
    </script>

    <script>
        $(function () {
            $('.resortTable').dataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print',
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },

                ],
                order: [3, 'desc']
            });
        });

    </script>

    <script>
        $(function () {
            $('.touristTable').dataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print',
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },

                ],
                order: [3, 'desc']
            });
        });
    </script>

@endpush
