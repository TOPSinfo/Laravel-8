@extends('auth.common')
@section('title','Login')
@section('content')
    <!--Auth fluid right content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">
                <!-- Logo -->
                <div class="auth-brand text-lg-left">
                    <div class="auth-logo">
                        <a href="javascript:void(0)" class="logo logo-dark">
                                    <span class="logo-lg">
                                        <img src="{{asset('assets/images/logo-dark-login.svg')}}" alt="">
                                    </span>
                        </a>
                    </div>
                </div>
                <!-- title-->
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-4">Enter your email address and password to access account.</p>
                <!-- form -->

                @if (session('success'))
                    @include('common.success')
                @endif
                @if (session('error'))
                    @include('common.error')
                @endif


                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="emailaddress">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required placeholder="Enter your email"
                               autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        @if (Route::has('password.request'))
                            <a href="{{route('password.request')}}" class="text-muted float-right"><small>Forgot your
                                    password?</small></a>
                        @endif
                        <label for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   placeholder="Enter your password" autocomplete="current-password">
                            <div class="input-group-append" data-password="false">
                                <div class="input-group-text">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember"
                                   id="checkbox-signin" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    </div>
                </form>
                <!-- end form-->
            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->
@endsection
