@extends('lidsystem::layouts.master')

@section('content')
<div class="container">
    <h3>Пожаловаться модератору</h3>
    <form class="" action="/lidsystem/{{$lidId}}/complaint" method="post">
        @csrf
            <div class="col-6">
                Напишите причину:
                <textarea name="message" rows="8" cols="80"></textarea>
                <input type="submit" name="" value="Отправить">
            </div>
    </form>
</div>

@endsection

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
                                Напишите причину:
                                <textarea name="message" rows="8" cols="80"></textarea>
                                <input type="submit" name="" value="Отправить">
                                </div>
                            </form>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
        @endsection
