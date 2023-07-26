@extends('home.main')

@section('title', 'Login')

@section('content')
    <!-- Session Status -->
    @if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="w-100 p-3 form-login">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="text-light">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group mt-2">
            <label for="password"  class="text-light">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-group form-check mt-2">
            <input type="checkbox" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label text-light" for="remember">{{ __('Remember me') }}</label>
        </div>

        <div class="form-group text-end">
            <button type="submit" class="btn btn-primary">
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    <style>
        .form-login{
            margin: 50px auto;
            max-width: 400px;
            border-radius: 7px;
            background: #315382;
        }
    </style>
@endsection
