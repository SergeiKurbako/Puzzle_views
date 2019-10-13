@extends('layouts.app')

@section('content')

<div class="container">
    Регистрация пройдена
</div>


@endsection
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ ('../../../css/reset.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/lib/all.min.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/lib/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/fonts.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/admin.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/filter.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/frame-fules.css') }}">
    <title>Admin</title>
</head>
<body>
<div class="header">
        <div class="header__icon">
        <a href="/" style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex">
                        <div class="slider__administrator--img">
                            <img src="../../../img/icon/logo.png" alt="">
                        </div>
                        <div class="slider__administrator--text">
                            <p><span>web</span>widgets</p>
                        </div>
                    </a>
        </div>
        
    </div>



    <div class="admin">


        <div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Успех!</h1>
                </div>

                <div class="main__table">

                    <div class="main__table--table" style="margin-bottom: 20px;">
                        <p>Регистрация пройдена, теперь можете <a href="/login">авторизоваться</a> </p>  
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="../../../js/admin.js"></script>
</body>
</html>
