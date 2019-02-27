@extends('layouts.backend.app')

@section('title', 'Accounts')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="#"><i class="material-icons">supervisor_account</i>Account list</a></li>
            </ol>
        </div>

        <!-- Content -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>ACCOUNTS LIST</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover accountTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    {{--<th>Status</th>--}}
                                    <th>Update at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td width="30xp">
                                            <label class="label {{ $user->role_id == 1 ? 'label-success' : 'label-info' }}">
                                                {{ $user->role->name }}
                                            </label>
                                        </td>
                                        {{--<td width="30px">--}}
                                        {{--{{ $user->status ? 'Active' : 'De-active' }}--}}
                                        {{--</td>--}}
                                        <td width="170px">{{ date('M d, Y h:i:s A', strtotime($user->updated_at)) }}</td>
                                        <td width="130px">
                                            <a href="javascript:void(0)" onclick="changeRole({{ $user->id }})" class="btn {{ $user->role->name == 'Admin' ? 'btn-info' : 'btn-success' }}">
                                                <i class="material-icons">compare_arrows</i> Set as {{ $user->role_id == 1 ? 'Owner' : 'Admin' }}
                                            </a>
                                            <form id="changeRole{{ $user->id }}" action="{{ route('admin.account.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('put')
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
        <!-- #END# Exportable Table -->
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
            $('.accountTable').dataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
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
        function changeRole(id) {
            swal({
                title: 'Are you sure?',
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: true,
                },
            }).then( changeRole => {
                if(changeRole){
                    $('#changeRole'+id).submit();
                }
            });
        }
    </script>
@endpush
