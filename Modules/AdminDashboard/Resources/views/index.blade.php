@extends('admindashboard::layouts.master')

@section('content')

        <div class="main main__index">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Пользователи</h1>
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
                                <td>Имя</td>
                                <td>Лицо</td>
                                <td>Дата</td>
                                <td>e-mail</td>
                                <td>Баланс</td>
                                <td colspan="2">Статус</td>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->userInfo->first_name}}</td>
                                <td>{{$user->userInfo->work_place}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->balance}}</td>
                                <td class="main__table--table--last-child main__table--table--last-child--icon">

                                   @if ($user->status === 'off')
                                    <a href="/admin-dashboard/user/{{$user->id}}/on"><i class="fas fa-plus-circle"></i></a>
                                    <a href="/admin-dashboard/user/{{$user->id}}/delete"><i class="fas fa-trash-alt"></i></a>
                                    @else

                                    <a href="/admin-dashboard/user/{{$user->id}}/delete"><i class="far fa-trash-alt"></i></a>
                                    <a href="/admin-dashboard/user/{{$user->id}}/off"><i class="fas fa-minus-circle"></i></a>
                                    @endif

                                </td>
                                <td class="main__table--table--last-child--icon">
                                    <a href="/admin-dashboard/user/{{$user->id}}">
                                        <i class="far fa-window-maximize"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="main__table--footer">

                            @include('pagination', ['paginator' => $users])

                            <p>Показано от 1 до 10 из 10 записей </p>
                            <div class="main__table--footer--page">
                                <div class="main__footer--item main__footer--item--active"><p>1</p></div>
                                <div class="main__footer--item"><p>2</p></div>
                                <div class="main__footer--item"><p>3</p></div>
                                <div class="main__footer--item"><p>4</p></div>
                                <div class="main__footer--item"><p>next</p></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        @endsection
