@extends('userdashboard::layouts.master')

@section('content')

<div class="main">
    <div class="main__wrapper">

    <div class="main__name-page">
        <h1>Создание кода игры</h1>
    </div>

    <div class="main__table">

    <div class="main__table--table wrapper_input_label">

    <form  action="/user-dashboard/frame-rules/{{$frameId}}/update" method="post">
        @csrf
        <div class="wrapper-input">
            <div>
                <label for="">Ширина лабиринта</label>
                <input type="text" name="mazeWidth" value="{{$mazeWidth}}" placeholder="Ширина лабиринта">
            </div>
    
            <div>
                <label for="">Высота лабиринта</label>
                <input type="text" name="mazeHeight" value="{{$mazeHeight}}" placeholder="Высота лабиринта">
            </div>
        </div>

        <div class="wrapper-input">
            <div>
                <label for="">Ширина камеры</label>
                <input type="text" name="cameraWidth" value="{{$cameraWidth}}" placeholder="Ширина камеры">
            </div>
            
            <div>
                <label>Высота камеры</label>
                <input type="text" name="cameraHeight" value="{{$cameraHeight}}" placeholder="Высота камеры">
            </div>
        </div>

        <div class="wrapper-input">
            <div>
                <label>Кол-во бонусов времени</label>
                <input type="text" name="countOfTimeBonus" value="{{$countOfTimeBonus}}" placeholder="Кол-во бонусов времени"> 
            </div>

            <div>
                <label>Кол-во бонусов жизней</label>
                <input type="text" name="countOfHealthBonus" value="{{$countOfHealthBonus}}" placeholder="Кол-во бонусов жизней"> 
            </div>
        </div>

        <div class="wrapper-input">
            <div>
                <label>Скорость уменьшения времени</label>
                <input type="text" name="decreaseTime" value="{{$decreaseTime}}" placeholder="Скорость уменьшения времени"> 
            </div>

            <div>
                <label>Скорость героя</label>
                <input type="text" name="speed" value="{{$speed}}" placeholder="Скорость героя"> 
            </div>
        </div>

        <div class="wrapper-input">
            <div>
                <label>Жизни героя</label>
                <input type="text" name="health" value="{{$health}}" placeholder="Жизни героя"> 
            </div>

            <div>
                <label>Время героя</label>
                <input type="text" name="time" value="{{$time}}" placeholder="Время героя">
            </div>
        </div>

        <div>
            <label>Скорость врагов</label>
            <input type="text" name="botSpeed" value="{{$botSpeed}}" placeholder="Скорость врагов"> 
        </div>

        <div>
            <input type="submit" name="" value="Применить">
        </div>
    
    </form>
    </div>
    </div>
    </div>
</div>
@endsection
