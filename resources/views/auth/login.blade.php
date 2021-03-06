@extends('layouts.guest')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="/">{{ config('app.name') }}</a>
        </div><!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <label class="d-none" for="email"></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="d-none"></label>
                        <input type="password" class="form-control @error('email') is-invalid @enderror" placeholder="Password" id="password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                        </div><!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook (Em breve)
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+ (Em breve)
                    </a>
                </div><!-- /.social-auth-links -->
                @if (Route::has('password.request'))
                    <p class="mb-1">
                        <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    </p>
                @endif

{{--                <p class="mb-0">--}}
{{--                    <a href="register.html" class="text-center">Register a new membership</a>--}}
{{--                </p>--}}
            </div><!-- /.login-card-body -->
        </div>
    </div><!-- /.login-box -->
@endsection
