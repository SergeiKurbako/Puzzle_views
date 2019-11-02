@extends('userdashboard::layouts.master')


@section('content')

<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Кошелёк</h1>
                </div>

                <div class="main__table">
                    <div class="main__table--filter">
                        <form action="" method="get">
                            
                                <div class="main__filter--btn">
                                    <input type="submit" name="" value="Пополнить баланс" />
                                </div> 
                            
                        </form>
                    </div>

                <div class="main__table" style="margin-top: 0;">
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
                                <td>Сумма</td>
                                <td>Баланс</td>
                            </tr>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{$payment->id}}</td>
                                <td>{{$payment->created_at}}</td>
                                <td>{{$payment->payment_value}}</td>
                            </tr>
                            @endforeach

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
                            
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection