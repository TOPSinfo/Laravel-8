@extends('auth.common')
@section('title','Forgot password')
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
                <h4 class="mt-0">Forgot Password</h4>
                <p class="text-muted mb-4">Enter your email address and we'll send you an email with instructions to
                    reset your password.</p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
            @endif
            <!-- form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="emailaddress">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required placeholder="Enter your email"
                               autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary waves-effect waves-light btn-block" type="submit"> Reset
                            Password
                        </button>
                    </div>
                </form>
                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Back to <a href="{{route('login')}}" class="text-muted ml-1"><b>Log in</b></a>
                    </p>
                </footer>

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->
@endsection
