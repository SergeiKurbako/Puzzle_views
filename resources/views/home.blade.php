@extends('layouts.app')

@section('content')
<div class="entrance">
        <h1>Авторизация</h1>
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="entrance__email bl-input">
                <label for="e-mail">E-mail адрес</label>
                <input id="e-mail" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" />
            </div>
            <div class="entrance__pass bl-input">
                <label for="pass">Пароль</label>
                <input id="pass" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
            </div>
            <div class="entrance__btn">
                <div class="entrance__check">
                    <input id="check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="check">Запомнить меня</label>
                </div>
                <div class="entrance__btn-login">
                    <input type="submit" value="Вход">
                </div>
            </div>
            <div class="entrance__btn--register-link">
                <a href="/register">Регистрация</a>
            </div>
        </form>
    </div>


<!-- <div class="container">
    <div class="row justify-content-center">
        <iframe src='http://puzzles/lidsystem/?frame_id=1&code=852645823' width='1000' height='600'></iframe>
        <iframe src='http://puzzles/gameframe/1?&code=852645823' width='1000' height='600'></iframe>
    </div>
</div> -->

@endsection
