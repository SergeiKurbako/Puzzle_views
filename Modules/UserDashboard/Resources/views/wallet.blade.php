@extends('userdashboard::layouts.master')

@section('content')


<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Пользователи</h1>
                </div>

                <div class="main__table">
                <h2>Вы можете выбрать любой инструмент для превлечения новых клиентов для сбора лидов</h2>
                    <div class="main__table--table">
                        <div class="main__table--toll">
                            <a href="#">
                                <div class="toll__item">
                                    <div class="toll__item--img">
                                        <img src="../../../img/game_lab.png" alt="">
                                    </div>
                                    <div class="toll__item--title">
                                        <p>Лабиринт</p>
                                    </div>
                                    <div class="toll__item--name">
                                        <p>Игра</p>
                                    </div>
                                    <div class="toll__item--desc">
                                        <p>Игрок должен пройти сложный лабиринт и остаться в живых</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#">
                                <div class="toll__item">
                                    <div class="toll__item--img">
                                        <img src="../../../img/game_car.png" alt="">
                                    </div>
                                    <div class="toll__item--title">
                                        <p>Остановка в базе</p>
                                    </div>
                                    <div class="toll__item--name">
                                        <p>Игра</p>
                                    </div>
                                    <div class="toll__item--desc">
                                        <p>Дойти до старта быстрее всех</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#">
                                <div class="toll__item toll__item--active">
                                    <div class="toll__item--img">
                                        <img src="../../../img/game_chat.png" alt="">
                                    </div>
                                    <div class="toll__item--title">
                                        <p>Whatapp бот</p>
                                    </div>
                                    <div class="toll__item--name">
                                        <p>Чат-бот</p>
                                    </div>
                                    <div class="toll__item--desc">
                                        <p>Бот, который продаст любой товар</p>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        @endsection