<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ ('../../../css/reset.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/lib/all.min.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/lib/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/fonts.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/admin.css') }}">
    
    <link rel="stylesheet" href="{{ ('../../../css/lib/sumoselect.css') }}">
    <link rel="stylesheet" href="{{ ('../../../css/filter.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ ('../../../css/calen.css') }}">
    
    <style>
    
    </style>

    <title>Admin</title>
</head>
<body>
    <div class="header">
        <div class="header__icon">
            <i class="js-header--burger-box fas fa-bars"></i>
        </div>
        <!-- <div class="header__user">
            <img src="../../../img/icon/user.png" alt="">
            <p>John Doe</p>
        </div> -->
        <div class="header--user">
            <div class="header__user--balance">
            </div>
            <div class="header__user">
                <img src="../../../img/icon/user.png" alt="">
                <p>{{$email}}</p>
            </div>
        </div>
    </div>

    <div class="popup-user">
        <!-- <div class="popup-user__settings">
            <a href="#">
                <i class="fas fa-cog"></i>
                <p> Настройки</p>
            </a>
        </div> -->
        <div class="popup-user__logout">
            <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <p>Выход</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="admin">

        <div class="slider-and-header--shadow"></div>

        <div class="slider-and-header">
            <div class="slider">

                <div class="slider__administrator">
                    <a href="#">
                        <div class="slider__administrator--img">
                            <img src="../../../img/icon/logo.png" alt="">
                        </div>
                        <div class="slider__administrator--text">
                            <p><span>web</span>widgets</p>
                        </div>
                    </a>
                </div>

                <div class="slider__menu">
                    <div class="slider__menu--item" style="display: none">
                        <a href="#">
                            <div class="slider__menu--img">
                                <i class="fas fa-home"></i>
                                <span style="opacity:0;"></span>
                            </div>
                            <div class="slider__menu--text">
                                <p>Главная</p>
                            </div>
                        </a>
                    </div>

                    <div class="slider__menu--item">
                        <a href="/admin-dashboard">
                            <div class="slider__menu--img">
                                <i class="far fa-user"></i>
                                <span style="opacity:0;"></span>
                            </div>
                            <div class="slider__menu--text">
                                <p class="slider__menu--user">Пользователи</p>
                            </div>
                        </a>
                    </div>

                    <div class="slider__menu--item">
                        <a href="/admin-dashboard/requests">
                            <div class="slider__menu--img">
                                <i class="fas fa-recycle"></i>
                                <span class="menu_request">{{$countOfRequests}}</span>
                            </div>
                            <div class="slider__menu--text">
                                <p class="slider__menu--request">Запросы</p>
                            </div>
                        </a>
                    </div>

                    <div class="slider__menu--item">
                        <a href="/admin-dashboard/complaints">
                            <div class="slider__menu--img">
                                <i class="far fa-angry"></i>
                                <span class="menu__complaints">{{$countOfComplaints}}</span>
                            </div>
                            <div class="slider__menu--text">
                                <p class="slider__menu--complaints">Жалобы</p>
                            </div>
                        </a>
                    </div>

                    <div class="slider__menu--item">
                        <a href="/admin-dashboard/billing">
                            <div class="slider__menu--img">
                            <i class="far fa-credit-card"></i>
                                <span style="opacity:0;"></span>
                            </div>
                            <div class="slider__menu--text">
                                <p class="slider__menu--billing">Биллинг</p>
                            </div>
                        </a>
                    </div>

                </div>
                
            </div>
        </div>

        @yield('content')

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
    
    <script src="../../../js/local-filter.js"></script>
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="../../../js/lib/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sumoselect/3.0.2/jquery.sumoselect.min.js"></script>
    <script>
        $( function() {
            $("#from--filter--date" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $("#to--filter--date").datepicker({ dateFormat: 'yy-mm-dd' });
        } );
        
    </script>

    <script src="../../../js/admin.js"></script>

    
    
</body>
</html>
