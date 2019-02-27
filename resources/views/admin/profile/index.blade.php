@extends('layouts.backend.app')

@section('title', 'Profile')

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">
                        <div class="image-area">
                            <img src="{{ asset("storage/profile/$profile->image") }}" width="50%" alt="qwe" />
                        </div>
                        <div class="content-area">
                            <h3 class="text-capitalize">{{ $profile->first_name }}</h3>
                            <p>{{ $profile->email }}</p>
                            <p class="text-uppercase">{{ $profile->role->name }}</p>
                        </div>
                        <div class="content-area">
                            <form action="{{ route('admin.profile.update', $profile->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="file" name="file" class="form-control">
                                <button class="btn btn-xs btn-danger btn-block" style="margin-top: 5px;">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <form method="post" action="{{ route('admin.profile.update', $profile->id) }}" class="form-horizontal">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" class="form-control" id="NewPassword" name="password" placeholder="New Password" required>
                                        <input type="hidden" value="changePassword" name="updateProfile">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" class="form-control" id="NewPasswordConfirm" name="password_confirmation" placeholder="New Password (Confirm)" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-danger">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('js')
    <script src="{{ asset('assets/form-handler.js') }}"></script>
@endpush
