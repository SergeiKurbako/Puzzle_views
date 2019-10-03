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

                    <div class="main__table--table">
                        <table>
                            <tr>
                                <td>№</td>
                                <td>Игра</td>
                                <td>Сайт</td>
                                <td>Код игры</td>
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

                                <td>{{$frame->url}}</td>
                                
                                <td>{{'<iframe src=\''}}{{stripos($_SERVER["SERVER_PROTOCOL"],"https") === 0 ? "https://" : "http://" . $_SERVER['HTTP_HOST'] . "/lidsystem/?frame_id=" . $frame->id . "&code=" . $frame->code . "' width='1000' height='600'></iframe>"}}</td>
                                
                                <!-- <td>
                                @if ($frame->frame_status === 'on')
                                    @if($frame->sms_confirm === 'on') Вкл <br> (<a href="/gameframe/update-sms-confirm-status/{{$frame->id}}/?status=off">Выкл</a>) @else Выкл <br> (<a href="/gameframe/update-sms-confirm-status/{{$frame->id}}/?status=on">Вкл</a>) @endif
                                @else
                                    Выкл
                                @endif
                                </td> -->
                                <!-- <td>
                                    @if ($frame->frame_status === 'on')
                                    @if($frame->sms_confirm === 'on') 
                                    <div class="checkbox--user-nav">
                                        <input class="sms-checkbox" type="checkbox" checked>
                                    </div>
                                    <a class="sms-check-off" href="/gameframe/update-sms-confirm-status/{{$frame->id}}/?status=off">Выкл</a>
                                    
                                    @else 

                                    <div class="checkbox--user-nav">
                                        <input class="sms-checkbox" type="checkbox">
                                    </div>
                                    <a class="sms-check-on"  href="/gameframe/update-sms-confirm-status/{{$frame->id}}/?status=on">Вкл</a> 
                                    @endif
                                    @else

                                    Выкл
                                    @endif
                                </td> -->
                                <td>
                                    @if ($frame->frame_status === 'on')
                                        @if($frame->sms_confirm === 'on') 

                                        <div class="checkbox--user-nav">
                                            <input class="sms-checkbox" type="checkbox" id="{{$frame->id}}" checked>
                                        </div>

                                        <a class="sms-check-off sms-check-{{$frame->id}}" href="/gameframe/update-sms-confirm-status/{{$frame->id}}/?status=off">Выкл</a>
                                        
                                        @else 

                                        <div class="checkbox--user-nav">
                                            <input class="sms-checkbox" type="checkbox" id="{{$frame->id}}">
                                        </div>

                                        <a class="sms-check-on sms-check-{{$frame->id}}"  href="/gameframe/update-sms-confirm-status/{{$frame->id}}/?status=on">Вкл</a> 
                                        
                                        @endif
                                    @else

                                    Выкл
                                    @endif
                                </td>
                                <!-- <td>
                                @if ($frame->frame_status === 'on')
                                    @if($frame->email_confirm === 'on') Вкл <br> (<a href="/gameframe/update-email-confirm-status/{{$frame->id}}/?status=off">Выкл</a>) @else Выкл <br> (<a href="/gameframe/update-email-confirm-status/{{$frame->id}}/?status=on">Вкл</a>) @endif
                                @else
                                    Выкл
                                @endif
                                </td> -->
                                <td>
                                    @if ($frame->frame_status === 'on')
                                    @if($frame->email_confirm === 'on')
                                    <div class="checkbox--user-nav">
                                        <input class="email-checkbox" type="checkbox" id="{{$frame->id}}" checked>
                                    </div>

                                    <a class="email-check-off email-check-{{$frame->id}}" href="/gameframe/update-email-confirm-status/{{$frame->id}}/?status=off">Выкл</a>
                                    
                                    @else 

                                    <div class="checkbox--user-nav">
                                        <input class="email-checkbox" type="checkbox" id="{{$frame->id}}">
                                    </div>

                                    <a class="email-check-on email-check-{{$frame->id}}" href="/gameframe/update-email-confirm-status/{{$frame->id}}/?status=on">Вкл</a> 
                                    @endif
                                    
                                    @else
                                    Выкл
                                    @endif
                                </td>

                                <td>
                                    <a href="/user-dashboard/frame-rules/{{$frame->id}}">
                                        <i style="color: #2196f3;" class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>

                                <td>
                                    @if ($frame->frame_status === 'on')
                                        @if($frame->status === 'on') Вкл <br> (<a href="/gameframe/update-game-status/{{$frame->id}}/?status=off">Выкл</a>) @else Выкл <br> (<a href="/gameframe/update-game-status/{{$frame->id}}/?status=on">Вкл</a>) @endif
                                    @else
                                        Выкл
                                    @endif
                                    /<a href="/gameframe/delete/{{$frame->id}}">удалить</a>
                                </td>
                                <td>
                                    <a href="/user-dashboard/frame/{{$frame->id}}">
                                        <i style="color: #2196f3" class="far fa-eye"></i>
                                    </a>
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
                            <div class="main__table--footer--page">
                                <div class="main__footer--item main__footer--item--active"><p>1</p></div>
                                <div class="main__footer--item"><p>2</p></div>
                                <div class="main__footer--item"><p>3</p></div>
                                <div class="main__footer--item"><p>4</p></div>
                                <div class="main__footer--item"><p>next</p></div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection