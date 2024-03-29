@extends('admindashboard::layouts.master')

@section('content')
        <div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Создание кода игры</h1>
                </div>

                <div class="main__table">

                    <div class="main__table--table">
                        <form  action="/gameframe/store-admin-frame" method="post">
                        @csrf
                        <table style="margin-bottom: 20px;">
                            <tr>
                                <td colspan="2">Адрес сайта</td>
                            </tr>
                            
                            <tr>
                                <td style="width: 20%">
                                    <input type="text" name="user_id" value="{{$userId}}" hidden>
                                    <input id="url" class="input-prim" type="text" name="url" value="" style="margin-bottom:0;">
                                </td>
                                <td><input class="btn-prim" type="submit" name="" value="Создать"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span style="color: red">{{$error}}</span>
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection