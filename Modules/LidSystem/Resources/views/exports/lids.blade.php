<table>
    <thead>
    <tr>
        <th>№</th>
        <th>Дата</th>
        <th>ФИО</th>
        <th>Пол</th>
        <th>Возраст</th>
        <th>E-mail</th>
        <th>Номер телефона</th>
        <th>Цена лида</th>
        <th>Статус заявки</th>
        <th>Сообщение</th>
    </tr>
    </thead>
    <tbody>
    @foreach($lids as $lid)
        <tr>
            <td>{{ $lid->id }}</td>
            <td>{{ $lid->created_at }}</td>
            <td>{{$lid->second_name}} {{$lid->first_name}} {{$lid->patronymic_name}}</td>
            <td>@if($lid->gender === 'man') муж @else жун @endif</td>
            <td>{{$lid->age}}</td>
            <td>{{$lid->email}}</td>
            <td>{{$lid->phone}}</td>
            <td>{{$lid->price}}</td>
            <td>
                @if ($lid->complaint->status === 'moderation')
                    Отправлена на модерацию
                @elseif ($lid->complaint->status === 'rejected')
                    Отклонена администратором
                @elseif ($lid->complaint->status === 'accept')
                    Забракована администратором
                @endif
            </td>
            <td>{{$lid->complaint->message}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
