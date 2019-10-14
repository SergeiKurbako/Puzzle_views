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

                                <td>
                                    <div class="code-frame">
                                        <xmp><link rel="stylesheet" href="http://partycamera.org/buttonframe/css/style.css"><div class="disabled modalIframe" id="wrapper-iframe"><div class="wrapper-iframe--wrapper"><a id="js-close-modal" class="madalIframe--close" href="#"></a>{{'<iframe src=\''}}{{stripos($_SERVER["SERVER_PROTOCOL"],"https") === 0 ? "https://" : "http://" . $_SERVER['HTTP_HOST'] . "/lidsystem/?frame_id=" . $frame->id . "&code=" . $frame->code . "' width='1000' height='600'></iframe>"}}</div></div><svg id="game" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 400" overflow="visible"> <linearGradient id="ArcGradient" ><stop offset="0" stop-color="#fff" stop-opacity=".2"/><stop offset="50%" stop-color="#fff" stop-opacity="0"/></linearGradient><path id="arc" fill="none" stroke="url(#ArcGradient)" stroke-width="4" d="M100,250c250-400,550-400,800,0" pointer-events="none"/><defs><g id="arrow"><line x2="60" fill="none" stroke="#888" stroke-width="2" /><polygon fill="#888" points="64 0 58 2 56 0 58 -2" /><polygon fill="#88ce02" points="2 -3 -4 -3 -1 0 -4 3 2 3 5 0" /></g></defs><g id="target"><path fill="#FFF" d="M924.2,274.2c-21.5,21.5-45.9,19.9-52,3.2c-4.4-12.1,2.4-29.2,14.2-41c11.8-11.8,29-18.6,41-14.2 C944.1,228.3,945.7,252.8,924.2,274.2z" /><path fill="#F4531C" d="M915.8,265.8c-14.1,14.1-30.8,14.6-36,4.1c-4.1-8.3,0.5-21.3,9.7-30.5s22.2-13.8,30.5-9.7 C930.4,235,929.9,251.7,915.8,265.8z" /><path fill="#FFF" d="M908.9,258.9c-8,8-17.9,9.2-21.6,3.5c-3.2-4.9-0.5-13.4,5.6-19.5c6.1-6.1,14.6-8.8,19.5-5.6 C918.1,241,916.9,250.9,908.9,258.9z" /><path fill="#F4531C" d="M903.2,253.2c-2.9,2.9-6.7,3.6-8.3,1.7c-1.5-1.8-0.6-5.4,2-8c2.6-2.6,6.2-3.6,8-2 C906.8,246.5,906.1,250.2,903.2,253.2z" /></g><g id="bow" fill="none" stroke-linecap="round" vector-effect="non-scaling-stroke" pointer-events="none"><polyline fill="none" stroke="#ddd" stroke-linecap="round" points="88,200 88,250 88,300"/><path fill="none" stroke="#88ce02" stroke-width="3" stroke-linecap="round" d="M88,300 c0-10.1,12-25.1,12-50s-12-39.9-12-50"/></g><g class="arrow-angle"><use x="100" y="250" xlink:href="#arrow"/></g><clipPath id="mask"><polygon opacity=".5" points="0,0 1500,0 1500,200 970,290 950,240 925,220 875,280 890,295 920,310 0,350" pointer-events="none"/></clipPath><g class="arrows" clip-path="url(#mask)" pointer-events="none"></g><g class="miss" fill="#aaa" opacity="0" transform="translate(0, 100)"><path d="M358 194L363 118 386 120 400 153 416 121 440 119 446 203 419 212 416 163 401 180 380 160 381 204"/><path d="M450 120L458 200 475 192 474 121"/><path d="M537 118L487 118 485 160 515 162 509 177 482 171 482 193 529 199 538 148 501 146 508 133 537 137"/><path d="M540 202L543 178 570 186 569 168 544 167 546 122 590 116 586 142 561 140 560 152 586 153 586 205"/><path d="M595,215l5-23l31,0l-5,29L595,215z M627,176l13-70l-41-0l-0,70L627,176z"/></g><g class="bullseye" fill="#F4531C" opacity="0"><path d="M322,159l15-21l-27-13l-32,13l15,71l41-14l7-32L322,159z M292,142h20l3,8l-16,8 L292,142z M321,182l-18,9l-4-18l23-2V182z"/><path d="M340 131L359 125 362 169 381 167 386 123 405 129 392 183 351 186z"/><path d="M413 119L402 188 450 196 454 175 422 175 438 120z"/><path d="M432 167L454 169 466 154 451 151 478 115 453 113z"/><path d="M524 109L492 112 466 148 487 155 491 172 464 167 463 184 502 191 513 143 487 141 496 125 517 126z"/><path d="M537 114L512 189 558 199 566 174 533 175 539 162 553 164 558 150 543 145 547 134 566 148 575 124z"/><path d="M577 118L587 158 570 198 587 204 626 118 606 118 598 141 590 112z"/><path d="M635 122L599 198 643 207 649 188 624 188 630 170 639 178 645 162 637 158 649 143 662 151 670 134z"/><path d="M649,220l4-21l28,4l-6,25L649,220z M681,191l40-79l-35-8L659,184L681,191z"/></g><g class="hit" fill="#ffcc00" opacity="0" transform="translate(180, -80) rotate(12) "><path d="M383 114L385 195 407 191 406 160 422 155 418 191 436 189 444 112 423 119 422 141 407 146 400 113"/><path d="M449 185L453 113 477 112 464 186"/><path d="M486 113L484 130 506 130 481 188 506 187 520 131 540 135 545 119"/><path d="M526,195l5-20l22,5l-9,16L526,195z M558,164l32-44l-35-9l-19,51L558,164z"/></g><!-- <line x1= "875", y1= "280", x2= "925", y2= "220" stroke="red"/><circle class="point" r="7" fill="purple" opacity=".4"/> --></svg><script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script><script src="http://partycamera.org/buttonframe/js/mb.js"></script><script src="http://partycamera.org/buttonframe/js/main.js"></script>"</xmp>
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
