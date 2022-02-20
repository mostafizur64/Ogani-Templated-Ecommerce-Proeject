@extends('layouts.fontend_master')
@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
                <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin Login From <span class="tx-info tx-normal"></span></div>

                <hr>
                <hr>
                <div class="form-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div><!-- form-group -->
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div><!-- form-group -->
                <button type="submit" class="btn btn-info btn-block">Sign In</button>

                <div class="mg-t-60 tx-center">Not yet a member? <a href="page-signup.html" class="tx-info">Sign Up</a></div>
            </div><!-- login-wrapper -->
        </form>

    </div><!-- d-flex -->

</div>

@endsection