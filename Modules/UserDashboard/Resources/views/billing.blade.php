@foreach ($payments as $payment)
    <hr>
    {{$payment->id}}<br>
    {{$payment->created_at}}<br>
    {{$payment->payment_value}}
@endforeach
