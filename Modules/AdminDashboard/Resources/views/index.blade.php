@extends('admindashboard::layouts.master')

@section('content')

        <div class="main main__index">
            <div class="main__wrapper">

                <div class="main__name-page">
                    <h1>Пользователи</h1>
                </div>

                <div class="main__table">
                    

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
                                    <a href="/admin-dashboard/user/{{$user->id}}/on" title="Запустить"><i class="fas fa-plus-circle"></i></a>
                                    <a href="/admin-dashboard/user/{{$user->id}}/delete" title="Удалить"><i class="far fa-trash-alt"></i></a>
                                    @else

                                    
                                    <a href="/admin-dashboard/user/{{$user->id}}/off" title="Остановить"><i class="fas fa-minus-circle"></i></a>
                                    <a href="/admin-dashboard/user/{{$user->id}}/delete" title="Удалить"><i class="far fa-trash-alt"></i></a>
                                    @endif

                                </td>
                                <td class="main__table--table--last-child--icon">
                                    <a href="/admin-dashboard/user/{{$user->id}}" title="Подробнее">
                                        <i class="far fa-window-maximize"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="main__table--footer">
                            <p>Показано от 1 до 10 из 10 записей </p>
                            
                        </div>


                    </div>
                </div>
            </div>
        </div>

        @endsection
