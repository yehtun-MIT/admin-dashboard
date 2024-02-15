@extends('layouts.app')
@section('content')
    <h4>Hello! let's get started</h4>
    <h6 class="font-weight-light">Sign in to continue.</h6>
    <form method="POST" class="pt-3" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            {{-- <label for="email" class="col-md-4 col-form-label text-md-end form-label">{{ __('Email Address') }}</label> --}}
            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" id="exampleInputEmail1" placeholder="Email Address">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password"
                name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                type="submit">{{ __('Login') }}</button>
        </div>
        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    Keep me signed in
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
        <div class="text-center mt-4 font-weight-light">
            Don't have an account?
            @if (Route::has('register'))
                    <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        </div>
    </form>
@endsection
