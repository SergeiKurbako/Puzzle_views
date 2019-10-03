@extends('admindashboard::layouts.master')

@section('content')
<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Редактирование фрейма</h1>
                </div>

                <div class="main__table">

                    <div class="main__table--table">
                        <table>
                        <form class="" action="/admin-dashboard/frame/{{$frame->id}}/update" method="post">
                            <tr>
                                <td>Сайт</td>
                                <td colspan="2">Код фрейма</td>
                            </tr>

                            <tr>
                                <td><input class="input-prim" type="text" name="url" value="{{$frame->url}}"></td>
                                <td><input class="input-prim" type="text" name="code" value="{{$frame->code}}"></td>
                                <td><input class="btn-prim" type="submit" name="" value="Применить"></td>
                            </tr>
                          
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
        @endsection