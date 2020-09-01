@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="route('login')"><b>EAMS</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Confirm Password</p>
            {{ __('Please confirm your password before continuing.') }}
            <form action="{{ route('password.confirm') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input
                        type="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password"
                        name="password" required autocomplete="current-password"
                    />
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
                    <div class="col-12">
                        <button
                            type="submit"
                            class="btn btn-primary btn-block"
                        >
                            Change Password
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->    
@endsection
