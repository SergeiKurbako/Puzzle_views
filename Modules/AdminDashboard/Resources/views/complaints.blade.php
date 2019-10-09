@extends('admindashboard::layouts.master')

@section('content')

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
                            <div class="main__table--filter--wrapper" style="align-items:flex-start">
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
                                <div class="main__filter--floor">
                                    <p>Пол</p>
                                    <select name="gender">
                                        <option value="man">Мужской</option>
                                        <option value="waman">Женский</option>
                                    </select>
                                </div>
                                <div class="main__filter--status">
                                    <p>Статус</p>
                                    <select name="status">
                                        <option value="moderation">На модерации</option>
                                        <option value="rejected">Отклонена администратором</option>
                                        <option value="accept">Забракована администратором</option>
                                    </select>
                                </div>
                                <div class="main__filter--price">
                                    <p>Цена за лид</p>
                                    <label>От</label>
                                    <input type="text" name="from_price" />
                                    <label>До</label>
                                    <input type="text" name="to_price" />
                                </div>


                            </div>
                            <div class="main__filter--exel">

                                    <input id="exel"  type="checkbox" name="exel" checked>
                                    <label for="exel">Выгрузить в exel</label>
                                </div>


                            <div class="main__filter--btn">
                                <input type="submit" name="" value="Применить" />
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
                            <tr>
                                <td>{{$lid->id}}</td>
                                <td>{{$lid->created_at}}</td>
                                <td>{{$lid->second_name}} {{$lid->first_name}} {{$lid->patronymic_name}}</td>
                                <td>@if($lid->gender === 'man') муж @else жун @endif</td>
                                <td>{{$lid->age}}</td>
                                <td>{{$lid->email}}</td>
                                <td>{{$lid->phone}}</td>
                                <td> {{$lid->price}}</td>
                                <td>
                                @if ($lid->complaint->status === 'moderation')
                                Отправлена на модерацию
                                @elseif ($lid->complaint->status === 'rejected')
                                Отклонена администратором
                                @elseif ($lid->complaint->status === 'accept')
                                Лид забракован администратором
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8">Сообщение:
                                    {{$lid->complaint->message}}
                                </td>
                                <td>
                                @if ($lid->complaint->status === 'moderation')

                                <a href="/lidsystem/complaints/{{$lid->complaint->id}}/update?status=rejected">Отклонить</a>
                                <a href="/lidsystem/complaints/{{$lid->complaint->id}}/update?status=accept">Подтвердить</a>
                                @else
                                @endif
                                </td>
                            </tr>
                            @endforeach



                        </table>
                        <div class="main__table--footer">
                            <p>Показано от 1 до 10 из 10 записей </p>
                            
                        </div>


                    </div>
                </div>
            </div>
        </div>
        @endsection
