@extends('userdashboard::layouts.master')

@section('content')


<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Баланс</h1>
                </div>

                <div class="main__table">

                    <div class="main__table--table" style="margin-bottom: 20px;">
                        <table style="width: 10%;">
                            <tr>
                                <td>Баланс:</td>
                                <td>{{$balance}}</td>
                            </tr>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
        @endsection