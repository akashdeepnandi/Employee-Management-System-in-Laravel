@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>EAMS</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign In</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email" 
                        value="{{ old('email') }}" required
                        placeholder="Email" autocomplete="email"
                        autofocus
                    />
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
                    <input
                        type="password"
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
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} 
                            />
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button
                            type="submit"
                            class="btn btn-primary btn-block"
                        >
                            Log In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            @if (Route::has('password.request'))
            <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
            @endif
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->    
@endsection



