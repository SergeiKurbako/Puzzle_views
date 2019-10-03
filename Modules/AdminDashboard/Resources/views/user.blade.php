@extends('admindashboard::layouts.master')

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
                                <td colspan="2">Код игры</td>
                                <td>SMS подтв.</td>
                                <td>email подтв.</td>
                                <td>Статус игры</td>
                                <td>Статистика</td>
                                <td colspan="2">Цена за лид</td>
                                <td>Статус</td>
                            </tr>
                            @foreach($frames as $frame)
                            <tr>
                                <td>{{$frame->id}}</td>

                                <td>{{$frame->game->name}} {{$frame->game->type}}</td>

                                <td>{{$frame->url}}</td>

                                <td>{{'<iframe src=\''}}{{stripos($_SERVER["SERVER_PROTOCOL"],"https") === 0 ? "https://" : "http://" . $_SERVER['HTTP_HOST'] . "/lidsystem/?frame_id=" . $frame->id . "&code=" . $frame->code . "' width='1000' height='600'></iframe>"}}</td>
                                
                                <td>
                                    <a href="/admin-dashboard/frame/{{$frame->id}}/update">
                                        <i style="color: #2196f3;" class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                
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
                                <td>@if($frame->status === 'on') Вкл <br> (<a href="/gameframe/update-game-status/{{$frame->id}}/?status=off">Выкл</a>) @else Выкл <br>  @endif</td>
                                <td style="text-align: center;"> <a href="/admin-dashboard/frame/{{$frame->id}}">
                                    <i style="color: #2196f3" class="far fa-eye"></i>
                                    </a></td>
                                <form class="" action="/gameframe/set-price/{{$frame->id}}" method="post">
                                    @csrf
                                <td><input class="input-prim-price input-prim" type="text" name="price" value="{{$frame->price}}"></td>
                                <td><input class="btn-prim" type="submit" name="" value="Задать"></td>
                                </form>
                                <td>Активен</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="12">
                                    <a href="/admin-dashboard/create-frame/?user_id={{$userId}}">
                                        <input class="btn-prim" type="submit" value="Создать код игры" />
                                    </a>
                                </td>
                            <tr>
                            
                            
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

        @endsection