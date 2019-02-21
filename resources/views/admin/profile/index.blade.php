@extends('layouts.backend.app')

@section('title', 'Profile')

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Content -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Profile Information</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="{{ route('admin.profile.edit', $profile->id) }}" class="btn bg-teal waves-effect">
                                    Edit Profile
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {{ $profile }}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@stop

@push('js')
    <script src="{{ asset('assets/form-handler.js') }}"></script>
@endpush
