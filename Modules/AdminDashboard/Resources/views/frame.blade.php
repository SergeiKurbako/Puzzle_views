@extends('admindashboard::layouts.master')

@section('content')
        <div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Пользователи</h1>
                </div>

                <div class="main__table">
                <h2>Фильтр</h2>
                    <div class="main__table--filter">
                        <form action="/admin-dashboard/frame/{{$frameId}}" method="get">
                            <div class="main__table--filter--wrapper" style="justify-content: flex-start;">
                                <div class="main__filter--date main__filter--date--stat-user">
                                    <p>Дата</p>
                                        <div class="main__filter--date-input-wrapper--stas-user">
                                            <div>
                                                <label>От</label>
                                                <input id="from--filter--date" name="from_date" type="text" autocomplete="off"/>
                                            </div>
                                            <div>
                                                <label>До</label>
                                                <input id="to--filter--date" name="to_date" type="text" autocomplete="off"/>
                                            </div>
                                        </div>
                                </div>
                                <div class="main__filter--floor" style="margin-left: 40px;">
                                    <p>Пол</p>
                                    <select name="gender" id="gender">
                                        <option value="">Все</option>
                                        <option value="man">Мужской</option>
                                        <option value="waman">Женский</option>
                                    </select>
                                </div>
                                <div style="padding-left: 50px;" class="main__filter--price">
                                    <p>Цена за лид</p>
                                    <div class="main__filter--price--wrapper">
                                        <div class="main__filter--price--item">
                                            <label>От</label>
                                            <input type="number" name="from_price" autocomplete="off"/>
                                        </div>
                                        <div class="main__filter--price--item">
                                            <label>До</label>
                                            <input type="number" name="to_price" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="main__filter--floor" style="margin-left: 40px;">
                                    <p>Результат игры</p>
                                    <select name="result_game" id="result_game">
                                        <option value="">Все</option>
                                        <option value="win">Победа</option>
                                        <option value="lose">Проигрыш</option>
                                        <option value="wait">Ожидание</option>
                                    </select>
                                </div>
                                

                            </div>
                            <div style="display: flex; align-items: center;">
                                <div class="main__filter--btn">
                                    <input type="submit" name=""  value="Применить" />
                                </div>
                                <div class="main__filter--exel">
                                    <input id="exel"  type="checkbox" name="exel">
                                    <label for="exel">Выгрузить в exel</label>
                                </div>
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
                                <td>{{$lid->game_result}}</td>
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
                            <!-- <div class="main__table--footer--page">
                                <div class="main__footer--item main__footer--item--active"><p>1</p></div>
                                <div class="main__footer--item"><p>2</p></div>
                                <div class="main__footer--item"><p>3</p></div>
                                <div class="main__footer--item"><p>4</p></div>
                                <div class="main__footer--item"><p>next</p></div>
                            </div> -->
                            {{ $lids->links() }}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
