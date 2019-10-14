@extends('userdashboard::layouts.master')

@section('content')



<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Пользователи</h1>
                </div>

                <div class="main__table">
                <h2>Фильтр</h2>
                    <div class="main__table--filter">
                        <form  action="/user-dashboard/frame/{{$frameId}}" method="get">
                            <div class="main__table--filter--wrapper" style="justify-content: flex-start;">
                                <div class="main__filter--date">
                                    <p>Дата</p>
                                        <div class="main__filter--date-input-wrapper">
                                            <div>
                                                <label>От</label>
                                                <input name="from_date" type="date" />
                                            </div>
                                            <div>
                                                <label>До</label>
                                                <input name="to_date" type="date" />
                                            </div>
                                        </div>

                                </div>
                                <div class="main__filter--floor" style="margin-left: 40px;">
                                    <p>Пол</p>
                                    <select name="gender">
                                        <option value="man">Мужской</option>
                                        <option value="waman">Женский</option>
                                    </select>
                                </div>

                            </div>

                            <div class="main__filter--btn">
                                <input type="submit" name=""  value="Применить" />
                            </div>

                        </form>
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
                                <td>Дата</td>
                                <td>ФИО</td>
                                <td>Пол</td>
                                <td>Возраст</td>
                                <td>E-mail</td>
                                <td>Номер телефона</td>
                                <td>Цена за лид</td>
                                <td>Результат игры</td>
                                <td>Пожаловаться модератору</td>
                            </tr>
                            @foreach($lids as $lid)
                            <tr>
                                <td>{{$lid->id}}</td>
                                <td>{{$lid->created_at}}</td>
                                <td>{{$lid->second_name}} {{$lid->first_name}} {{$lid->patronymic_name}}</td>
                                <td>@if($lid->gender === 'man') муж @else жун @endif</td>
                                <td>{{$lid->age}}</td>
                                <td>{{$lid->email}}</td>
                                <td>{{$lid->phone}}</td>
                                <td>{{$lid->price}}</td>
                                <td>
                                @if ($lid->session_id !== 0)
                                    <a href="/maze?session_id={{$lid->session_id}}">{{$lid->game_result}}</a>
                                @else
                                    {{$lid->game_result}}
                                @endif
                                </td>
                                <td class="main__table--table--last-child--icon">
                                @if ($lid->have_complaint === 'no')
                                    <a href="/lidsystem/{{$lid->id}}/complaint">
                                    <!-- <i style="color: #be4c4c;" class="fas fa-exclamation"></i> -->
                                    Пожаловаться
                                    </a>
                                @else
                                @if ($lid->complaint->status === 'moderation')
                                    Отправлена на модерацию
                                @elseif ($lid->complaint->status === 'rejected')
                                    Отклонена администратором
                                @elseif ($lid->complaint->status === 'accept')
                                    Лид забракован администратором
                                @endif
                                @endif
                                </td>
                            </tr>
                            @endforeach

                        </table>
                        <table style="margin-top: 20px;">
                            <tr>
                                <td>Итого: {{$lidCount}} лид {{$lidSum}} руб</td>


                            </tr>
                        </table>

                        

                        <div class="main__table--footer">
                            <p>Показано от 1 до 10 из 10 записей </p>
                            
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection