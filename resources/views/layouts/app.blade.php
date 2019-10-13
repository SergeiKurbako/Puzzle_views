<!-- <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css//reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css//fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css//aut-and-reg.css') }}">
    <title>Авторизация</title>
</head>
<body>
<div class="entrance">
        <div class="entrance__logo">
            <img src="../img/icon/logo.png" alt="">
            <p><span>Web</span>widgets</p>
        </div>
        <h1>Авторизация</h1>
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="entrance__email bl-input">
                <label for="e-mail">E-mail адрес</label>
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
                <label for="pass">Пароль</label>
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

                <div class="entrance__btn-login">
                    <input type="submit" value="Вход">
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="entrance__check">
                <input id="check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="check">Запомнить меня</label>
            </div>
            <div class="entrance__btn--register-link">
                <a href="/register">Регистрация</a>
            </div>
        </form>
    </div>
</body>
</html> -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css//reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css//fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css//aut-and-reg.css') }}">
    <title>Авторизация</title>
</head>
<body>
@yield('content')
</body>
</html>