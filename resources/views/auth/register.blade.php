@extends('layouts.app')

@section('content')
<div class="entrance">
        <div class="entrance__logo">
            <img src="../img/icon/logo.png" alt="">
            <p><span>Web</span>widgets</p>
        </div>
        <h1>Регистрация</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="entrance__email bl-input">
                <label for="e-mail">E-mail адрес</label>
                <input id="e-mail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"/>
            </div>
            <div class="entrance__pass bl-input">
                <label for="pass">Пароль</label>
                <input id="pass" type="password" name="password" required autocomplete="new-password"/>
            </div>
            <div class="entrance__pass bl-input">
                <label for="pass_conf">Повторить пароль</label>
                <input id="pass_conf" type="password" name="password_confirmation" required autocomplete="new-password"/>
            </div>
            <div class="entrance__btn">
                <div class="entrance__btn-login">
                    <input type="submit" value="Регистрация">
                </div>
            </div>
        </form>
        <div class="entrance_error">
        @error('password')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
        </div>
    </div>
    @endsection
