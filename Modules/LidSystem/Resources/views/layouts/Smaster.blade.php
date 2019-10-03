<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>AdminDashboard</title>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/admindashboard.css') }}"> --}}

       <style>
           .container {
               width: 1700px;
               max-width: 1700px;
           }
       </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <a class="nav-link active" href="/">
                            <li class="nav-item">
                                 <span class="caret">Puzzles</span>
                            </li>
                        </a>
                        <a class="nav-link @if(Route::getFacadeRoot()->current()->uri() === 'user-dashboard') active @endif" href="/user-dashboard">
                            <li class="nav-item">
                                 <span class="caret">Фреймы</span>
                            </li>
                        </a>
                        <a class="nav-link @if(Route::getFacadeRoot()->current()->uri() === 'user-dashboard/wallet') active @endif" href="/user-dashboard/wallet">
                            <li class="nav-item">
                                 <span class="caret">Баланс</span>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/admindashboard.js') }}"></script> --}}
    </body>
</html>