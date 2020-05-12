@extends('gateway::layouts.plain')

@section('title', 'Reset Your Admin password')

@section('content')
<div class="login-screen">
    <a href="{{ route('admin.login') }}" class="back">Back</a>
    <div class="login-hold">
        <div class="ls-rail">
        <div class="form-block login">
            <div class="in-block">
                <h1 class="fb-head">Reset Password</h1>

                <form method="post" action="{{ route('admin.password.request') }}" class="form login-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-wrap">
                        <label for="username" >Email:</label>
                        <input type="text" name="email" id="email" class="loginInput form-control" required="required" aria-required="true" value="{{ $email or old('email') }}" placeholder="Email Address" autofocus/>
                    </div>

                    <div class="input-wrap">
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" class="loginInput form-control" minlength="6" maxlength="21"  required="required" aria-required="true" placeholder="Password" />
                    </div>

                    <div class="input-wrap">
                        <label for="password">Confirm Password: </label>
                        <input type="password" name="password_confirmation" id="password-confirm" class="loginInput form-control" minlength="6" maxlength="21"  required="required" aria-required="true" placeholder="Confirm Password" />
                    </div>


                    <div class="row">
                        <div class="col-sm">
                            <button type="submit" class="btn btn-danger btn-block submit" data-imsg="Logging In">Reset Password</button>
                        </div>
                        <div class="col-sm"></div>
                        <div class="col-sm">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
