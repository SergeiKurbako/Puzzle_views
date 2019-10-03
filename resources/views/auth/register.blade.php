@extends('layouts.app')

@section('content')
<div class="entrance">
        <h1>Register</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="entrance__email bl-input">
                <label for="e-mail">E-mail Address</label>
                <input id="e-mail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"/>
            </div>
            <div class="entrance__pass bl-input">
                <label for="pass">Password</label>
                <input id="pass" type="password" name="password" required autocomplete="new-password"/>
            </div>
            <div class="entrance__pass bl-input">
                <label for="pass_conf">Confirm Password</label>
                <input id="pass_conf" type="password" />
            </div>
            <div class="entrance__btn">
                <div class="entrance__btn-login">
                    <input type="submit" value="Register" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
        </form>
    </div>
    @endsection
