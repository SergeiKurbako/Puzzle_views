@extends('admindashboard::layouts.master')

@section('content')
<link rel="stylesheet" href="../../../css/tooltip.css">
<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Жалобы</h1>
                </div>
<!-- ФИЛЬТР -->
                <div class="main__table">
                    <h2>Фильтр</h2>
                    <div class="main__table--filter">
                        <form action="/admin-dashboard/complaints" method="get">
                            <div class="main__table--filter--wrapper" style="-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start">
                                <div class="main__filter--date">
                                    <p>Дата</p>
                                    <div class="main__filter--date-input-wrapper">
                                        <div id="date-example">
                                            <label>От</label>
                                            <input id="from--filter--date" name="from_date" type="text" autocomplete="off"/>
                                        </div>
                                        <div>
                                            <label>До</label>
                                            <input id="to--filter--date" name="to_date" type="text" autocomplete="off"/>
                                        </div>
                                    </div>

                                </div>
                                <div class="main__filter--floor">
                                    <p>Пол</p>
                                    <select id="gender" name="gender">
                                        <option value="">Все</option>
                                        <option value="man">Мужской</option>
                                        <option value="waman">Женский</option>
                                    </select>
                                </div>
                                <div class="main__filter--status">
                                    <p>Статус</p>
                                    <select id="status" name="status">
                                        <option value="">Все</option>
                                        <option value="moderation">На модерации</option>
                                        <option value="rejected">Отклонена</option>
                                        <option value="accept">Одобрена</option>
                                    </select>
                                </div>
                                <div class="main__filter--price">
                                    <p>Цена за лид</p>
                                    <label>От</label>
                                    <input type="number" id="from_price" name="from_price" autocomplete="off"/>
                                    <label>До</label>
                                    <input type="number" id="to_price" name="to_price" autocomplete="off"/>
                                </div>


                            </div>
                            <div style="display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; -webkit-box-align: center; -webkit-align-items: center; -ms-flex-align: center; align-items: center;">
                                <div class="main__filter--btn">
                                    <input type="submit" name="" value="Применить" />
                                </div>
                                <div class="main__filter--btn">
                                    <input id="btn--reset-filter" type="submit" name=""  value="Сбросить" />
                                </div>
                                <div class="main__filter--exel">
                                    <input id="exel"  type="checkbox" name="exel">
                                    <label for="exel">Выгрузить в exel</label>
                                </div>
                            </div>
                        </form>
                    </div>
<!--  END ФИЛЬТР -->

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
                                <td>Статус заявки</td>
                            </tr>
                        @foreach ($lids as $lid)
                            @if ($lid->complaint)
                                <tr>
                                    <td>{{$lid->id}}</td>
                                    <td>{{$lid->created_at}}</td>
                                    <td>{{$lid->second_name}} {{$lid->first_name}} {{$lid->patronymic_name}}</td>
                                    <td>@if($lid->gender === 'man') муж @else жен @endif</td>
                                    <td>{{$lid->age}}</td>
                                    <td>{{$lid->email}}</td>
                                    <td>{{$lid->phone}}</td>
                                    <td> {{$lid->price}}</td>
                                    <td>

                                        <span tooltip="{{$lid->complaint->message}}">
                                            @if ($lid->complaint->status === 'moderation')
                                                <a href="/lidsystem/complaints/{{$lid->complaint->id}}/update?status=rejected">Отклонить</a>
                                                <a href="/lidsystem/complaints/{{$lid->complaint->id}}/update?status=accept">Подтвердить</a>
                                            @elseif ($lid->complaint->status === 'rejected')
                                            Отклонена. Лид корректный.
                                            @elseif ($lid->complaint->status === 'accept')
                                            Одобрена. Лид некорректный.
                                            @endif
                                        </span>

                                    </td>
                                </tr>
                                
                            @endif

                        @endforeach



                        </table>
                        <div class="main__table--footer">
                            <p>Показано от 1 до 10 из 10 записей </p>
                            @include('pagination', ['paginator' => $lids])
                        </div>


                    </div>
                </div>
            </div>
        </div>

        @endsection
