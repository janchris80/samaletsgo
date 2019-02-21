@extends('layouts.backend.app')

@section('title', 'Hotline')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="{{ route('admin.hotline.index') }}"><i class="material-icons">call</i>Hotlines list</a></li>
            </ol>
        </div>

        <!-- Content -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            HOTLINES LIST
                            <label class="label label-info">{{ $hotlines->count() }}</label>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="{{ route('admin.hotline.create') }}" class="btn bg-teal waves-effect">
                                    ADD HOTLINE
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover hotlineTable">
                                <thead>
                                <tr>
                                    <th>Contact name</th>
                                    <th>Telephone no.</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($hotlines as $key => $datum)
                                    <tr>
                                        <td>{{ str_limit($datum->name, 50) }}</td>
                                        <td>{{ $datum->number }}</td>
                                        <td width="170px">{{ date('M d, Y h:i:s A', strtotime($datum->updated_at)) }}</td>
                                        <td width="150px">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('admin.hotline.edit', $datum->id) }}">
                                                            <i class="material-icons">edit</i>Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="deleteData({{ $datum->id }})">
                                                            <i class="material-icons">delete</i>Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <form id="deleteForm{{ $datum->id }}" action="{{ route('admin.hotline.destroy', $datum->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
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
@endpush
