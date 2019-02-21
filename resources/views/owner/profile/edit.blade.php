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
                        <h2>Editing Profile Information</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="{{ route('owner.profile.index') }}" class="btn btn-warning waves-effect">
                                    Cancel
                                </a>
                            </li>
                        </ul>

                    </div>
                    <div class="body">
                        <form id="sign_in">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First name</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="first_name" value="{{ $profile->first_name }}" placeholder="First name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Middle name</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="middle_name" value="{{ $profile->middle_name }}" placeholder="Middle name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="last_name" value="{{ $profile->last_name }}" placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="email" value="{{ $profile->email }}" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Confirm password</label>
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-success">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@stop

@push('js')

@endpush
