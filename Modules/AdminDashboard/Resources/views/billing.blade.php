@extends('admindashboard::layouts.master')
@section('content')

<div class="main">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Кошелёк</h1>
                </div>

                <div class="main__table">
                <h2>Фильтр</h2>
                    <div class="main__table--filter">
                        <form action="" method="get">
                            <div class="main__table--filter--wrapper" style="-webkit-box-pack: start;-webkit-justify-content: flex-start;-ms-flex-pack: start;justify-content: flex-start;">
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
                                <div class="main__filter--email">
                                    <p>Email</p>
                                    <input type="text" id="email" name="email" autocomplete="off"/>
                                </div>
                            </div>
                            <div style="display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; -webkit-box-align: center; -webkit-align-items: center; -ms-flex-align: center; align-items: center;">
                                <div class="main__filter--btn">
                                    <input type="submit" name="" value="Применить" />
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
                                <td>Сумма</td>
                                <td>Email</td>
                            </tr>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{$payment->id}}</td>
                                <td>{{$payment->created_at}}</td>
                                <td>{{$payment->payment_value}}</td>
                                <td>none</td>
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