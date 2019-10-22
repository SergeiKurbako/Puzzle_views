@extends('userdashboard::layouts.master')

@section('content')

<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Пользователи</h1>
                </div>
                <div class="main__table">
                <div class="main__table--select">
                        Показать
                        <select>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        записей
                    </div>
                    
                    <div class="main__table--table" style="overflow-x: scroll;">
                        <table>
                            <tr>
                                <td>№</td>
                                <td>Игра</td>
                                <td>Сайт</td>
                                <td colspan="2">Код игры</td>
                                <td>SMS подтв.</td>
                                <td>email подтв.</td>
                                <td>Правила</td>
                                <td>Статус игры</td>
                                <td>Статистика</td>
                                <td>Цена за лид</td>
                            </tr>
                            @foreach($frames as $frame)
                            <tr>
                                <td>{{$frame->id}}</td>

                                <td>{{$frame->game->name}} {{$frame->game->type}}</td>

                                <td><a href="{{$frame->url}}" target="_blank">{{$frame->url}}</a></td>

                                <td class="td__code">
                                    <div class="code-frame">
                                        <xmp><script src="http://partycamera.org/buttonframe/repack.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js" defer></script>
                                        <script src="https://partycamera.org/buttonframe/js/mb.js" defer></script>
                                        <script src="https://partycamera.org/buttonframe/js/main.js" defer></script>
                                        <script>
                                            var src = `{{stripos($_SERVER["SERVER_PROTOCOL"],"https") === 0 ? "https://" : "http://" . $_SERVER['HTTP_HOST'] . "/lidsystem/?frame_id=" . $frame->id . "&code=" . $frame->code}}`;
                                            document.getElementById('iframe').src = src;
                                        </script>
                                    </xmp>
                                    </div>
                                </td>
                                
                                
                                
                                
                                
                                
                                    <!-- <td><a href="/user-dashboard/frame/{{$frame->id}}/update">Редактировать</a></td> -->
                                <td class="main__table--table--last-child--icon">
                                    <a href="/user-dashboard/frame/{{$frame->id}}/update" title="Редактировать">
                                        <i style="color: #2196f3;" class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    @if ($frame->frame_status === 'on')
                                        @if($frame->sms_confirm === 'on')

                                        <div class="checkbox--user-nav table__content--center">
                                            <input class="sms-checkbox" type="checkbox" id="{{$frame->id}}" checked>
                                        </div>

                                        <a class="sms-check-off sms-check-{{$frame->id}}" href="/gameframe/update-sms-confirm-status/{{$frame->id}}/?status=off">Выкл</a>

                                        @else

                                        <div class="checkbox--user-nav table__content--center">
                                            <input class="sms-checkbox" type="checkbox" id="{{$frame->id}}">
                                        </div>

                                        <a class="sms-check-on sms-check-{{$frame->id}}"  href="/gameframe/update-sms-confirm-status/{{$frame->id}}/?status=on">Вкл</a>

                                        @endif
                                    @else

                                    <div class="checkbox--user-nav table__content--center">
                                        <input class="sms-checkbox" type="checkbox" disabled>
                                    </div>
                                    @endif
                                </td>

                                <td>
                                    @if ($frame->frame_status === 'on')
                                    @if($frame->email_confirm === 'on')
                                    <div class="checkbox--user-nav table__content--center">
                                        <input class="email-checkbox" type="checkbox" id="{{$frame->id}}" checked>
                                    </div>

                                    <a class="email-check-off email-check-{{$frame->id}}" href="/gameframe/update-email-confirm-status/{{$frame->id}}/?status=off">Выкл</a>

                                    @else

                                    <div class="checkbox--user-nav table__content--center">
                                        <input class="email-checkbox" type="checkbox" id="{{$frame->id}}">
                                    </div>

                                    <a class="email-check-on email-check-{{$frame->id}}" href="/gameframe/update-email-confirm-status/{{$frame->id}}/?status=on">Вкл</a>
                                    @endif

                                    @else
                                    <div class="checkbox--user-nav table__content--center">
                                        <input class="sms-checkbox" type="checkbox" disabled>
                                    </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="table__content--center main__table--table--last-child--icon">
                                        <a href="/user-dashboard/frame-rules/{{$frame->id}}" title="Редактировать">
                                            <i style="color: #2196f3;" class="fas fa-pencil-alt"></i>
                                        </a>
                                    </div>
                                </td>

                                <td>
                                    <div class="table__content--center">
                                        @if ($frame->frame_status === 'on')
                                            @if($frame->status === 'on')

                                            <div class="checkbox--user-nav table__content--center">
                                                <input class="complaint-checkbox" type="checkbox" id="{{$frame->id}}" checked>
                                            </div>

                                            <a class="complaint-check-off complaint-check-{{$frame->id}}" href="/gameframe/update-game-status/{{$frame->id}}/?status=off">Выкл</a>

                                            @else

                                            <div class="checkbox--user-nav table__content--center">
                                                <input class="complaint-checkbox" type="checkbox" id="{{$frame->id}}">
                                            </div>

                                            <a class="complaint-check-on complaint-check-{{$frame->id}}" href="/gameframe/update-game-status/{{$frame->id}}/?status=on">Вкл</a>

                                            @endif
                                        @else
                                        <div class="checkbox--user-nav table__content--center">
                                            <input class="sms-checkbox" type="checkbox" disabled>
                                        </div>
                                        @endif
                                        <a class="main__table--table--last-child--icon" style="margin-left: 15px;" href="/gameframe/delete/{{$frame->id}}" title="Удалить">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="table__content--center main__table--table--last-child--icon">
                                        <a href="/user-dashboard/frame/{{$frame->id}}" title="Просмотреть">
                                            <i style="color: #2196f3" class="far fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>{{$frame->price}}</td>
                            </tr>
                            @endforeach

                        </table>
                        <table style="margin-top: 20px;">

                            <td colspan="9">
                                    <a href="/user-dashboard/create-frame">
                                        <input class="btn-prim" type="submit" value="Создать код игры" />
                                    </a>
                                </td>
                        </table>

                       

                        <div class="main__table--footer">
                            <p>Показано от 1 до 10 из 10 записей </p>
                            @include('pagination', ['paginator' => $frames])
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
