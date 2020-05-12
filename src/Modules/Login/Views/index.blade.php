@extends('gateway::layouts.plain')

@section('title', 'Please Login')

@section('content')
<div class="login-screen">
    <a href="/" class="back">Back</a>
    <div class="ls-rail">
        <div class="form-block login">
            <div class="in-block">
                <h1 class="fb-head">Sign In</h1>

                <form method="post" action="{{ route('admin.login') }}" class="form login-form">
                    {{ csrf_field() }}
                    <div class="input-wrap">
                        <label for="username" >Username / Email:</label>
                        <input type="text" name="username" id="username" class="loginInput form-control" required="required" aria-required="true" value="{{ old('username') }}" placeholder="Username or Email Address" />
                    </div>

                    <div class="input-wrap">
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" class="loginInput form-control" minlength="6" maxlength="21"  required="required" aria-required="true" placeholder="Password" />
                    </div>

                    <div class="input-wrap">
                        <div class="col">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember"> Remember Me</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <button type="submit" class="btn btn-danger btn-block submit" data-imsg="Logging In">Login</button>
                        </div>
                        <div class="col-sm"></div>
                        <div class="col-sm">
                            <a href="" class="btn btn-block btn-light fg-toggle">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="form-block reset">
            <div class="in-block">
                <h1 class="fb-head">Reset Password</h1>

                <form method="post" action="{{ route('admin.password.email') }}" class="form login-form">
                    {{ csrf_field() }}
                    <div class="input-wrap">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required="required" aria-required="true" placeholder="Your Email Address" />
                    </div>

                    <div class="row">
                        <div class="col">
                            <a href="" class="btn btn-light btn-block fg-toggle">Remembered?</a>
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger btn-block">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
