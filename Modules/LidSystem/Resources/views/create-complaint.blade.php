@extends('lidsystem::layouts.master')

@section('content')
<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Пожаловаться модератору</h1>
                </div>
                <div class="main__table">
                    <div class="main__table--table">
                        <table>
                            <form class="" action="/lidsystem/{{$lidId}}/complaint" method="post">
                                @csrf
                                <div class="create-complaint-label"><label>Напишите причину:</label></div>
                                <div class="create-complaint-input"><textarea name="message" rows="8" cols="80"></textarea></div>
                                <div class="create-complaint-btn"><input type="submit" name="" value="Отправить"></div>
                            </form>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
        @endsection
