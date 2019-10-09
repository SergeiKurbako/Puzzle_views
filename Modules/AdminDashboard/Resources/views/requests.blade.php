@extends('admindashboard::layouts.master')

@section('content')
<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Запросы</h1>
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

                    <div class="main__table--table main__table--table--request">
                        <table>
                            <tr>
                                <td>№</td>
                                <td>Игра</td>
                                <td>Сайт</td>
                                <td>Статус запроса</td>
                                <td>Цена за лид</td>
                            </tr>
                            @foreach($frames as $frame)
                            <tr>
                                <td>{{$frame->id}}</td>
                                <td>{{$frame->game->name}} {{$frame->game->type}}</td>
                                <td><a href="{{$frame->url}}" target="_blank">{{$frame->url}}</a></td>
                                <td><a href="/gameframe/update-frame-status/{{$frame->id}}/?frame_status=on" title="Одобрить"><i class="fas fa-check-circle"></i></a>  <a href="/gameframe/delete/{{$frame->id}}" title="Удалить"><i class="far fa-trash-alt"></i></a></td>
                                <td>
                                <form class="" action="/gameframe/set-price/{{$frame->id}}" method="post">
                                    @csrf
                                    <input class="input-prim-price input-prim" type="text" name="price" value="{{$frame->price}}">
                                    <input class="btn-prim " type="submit" name="" value="Задать">
                                </form>
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
