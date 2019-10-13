<link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/lig-systems.css">
    <link rel="stylesheet" href="../css/number-phone.css">

    <div class="entrance">
        <h1>Шаг 2/3</h1>
        <form action="/lidsystem/step2/create" method="post">
        @csrf
            <div class="bl-input">
                <label for="sms">Введите код из sms-сообщения</label>
                
                <input type="text" name="code" value="{{$code}}" hidden>
                <input type="text" name="frame_id" value="{{$frameId}}" hidden>
                <input type="text" name="lid_id" value="{{$lidId}}" hidden>
                <input type="text" name="phone" value="{{$phone}}" hidden>
                <input id="sms" name="sms_code" type="text" />
                
                <span class="war-phone">Неверный код</span>
            </div>
            <div class="entrance__btn">
                <div class="entrance__btn-login">
                    <input id="btn-input" type="submit" value="Далее" hidden>
                    <span id="btn">Далее</span>
                </div>
            </div>
        </form>
        <p style="padding-top: 20px;">{{$smsCode}}</p>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/number-sms-val.js"></script>