@extends('auth.app')

@section('content')
    <body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>SAMALETSGO</b></a>
            {{--<small>Admin BootStrap Based - Material Design</small>--}}
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST">
                    @csrf
                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <label>First name</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="first_name" placeholder="First name" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Middle name</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle name" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Last name</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="last_name" placeholder="Last name" required autofocus>
                        </div>
                    </div>
                    <hr>
                    <div class="input-group">
                        <label>Username</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Email</label>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Password</label>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Confirm password</label>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password_confirmation" minlength="6" placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" id="register-button">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{ route('login') }}">You already have a membership?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
@stop
