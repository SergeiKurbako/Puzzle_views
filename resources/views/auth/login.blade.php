
@extends('layouts.app')

@section('content')
<div class="entrance">
        <h1>Login</h1>
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="entrance__email bl-input">
                <label for="e-mail">E-mail Address</label>
                <input id="e-mail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" />
            </div>
            @error('email')
            <div class="entrance_error">
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </div>
            @enderror
            <div class="entrance__pass bl-input">
                <label for="pass">Password</label>
                <input id="pass" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
            </div>
            <div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div>
            <div class="entrance__btn">
                <div class="entrance__check">
                    <input id="check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="check">Remember Me</label>
                </div>
                <div class="entrance__btn-login">
                    <input type="submit" value="Login">
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </form>
    </div>
@endsection