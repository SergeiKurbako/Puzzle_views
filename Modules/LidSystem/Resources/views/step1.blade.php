    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/lig-systems.css">
    <!-- <link rel="stylesheet" href="../css/number-phone.css"> -->

    <div class="entrance">
        <h1>Шаг 1/3</h1>
        <form action="/lidsystem/step1/create" method="post">
        @csrf
            <div class="bl-input">
                <label for="phone">Введите номер телефона</label>
                
                <input type="text" name="code" value="{{$code}}" hidden>
                <input type="text" name="frame_id" value="{{$frameId}}" hidden>
                <input id="phone" type="tel" />

                <span class="war-phone">Некорректный номер телефона</span>
            </div>
            <div class="entrance__btn">
                <div class="entrance__btn-login">
                    <input id="btn-input" type="submit" value="Далее" hidden>
                    <span id="btn">Далее</span>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/number-phone-val.js"></script>