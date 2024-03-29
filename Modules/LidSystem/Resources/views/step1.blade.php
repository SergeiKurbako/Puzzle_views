<head>

</head>
<style>
*:root{
    font-family: 'Roboto','Nunito', 'Arial', 'sans-selif';
}

.entrance-start{
    font-size: 28px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column;
    background: #fff;
    padding: 100px;
}

.entrance-start *{
    font-size: 29px;
}

.entrance-start p{
    color: #000000;
}

.entrance-start a{
    text-align: center;
    margin-top: 20px;
    color: #fff;
    background: #2196f3;
    padding: 10px;
    text-decoration: none;
    border-radius: 10px;
}

.entrance-start a:hover{
    background: #0c83e2;
}


.entrance{
    display: none;
}

@media screen and (max-width: 576px){
    .entrance-start{
        padding: 60px 0;
        width: 100%;
    }
    .entrance-start div{
        width: 100% !important;
        display: flex;
        justify-content: center;
    }
    .entrance-start p{
        padding: 13px;
    }
    .entrance-start a{
        margin: 20px;
    }
}

</style>  
    
    
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
                <input id="phone" name="phone" type="number" />

                <span class="war-phone">Пользователь с таким номером уже зарегистрирован</span>
                
            </div>
            <div class="entrance__btn">
                <div class="entrance__btn-login">
                    <input id="btn-input" type="submit" value="Далее" hidden>
                    <span id="btn">Далее</span>
                </div>
            </div>
        </form>
    </div>

    <div class="entrance-start">
        <h1 style="fomt-size: 29px; text-align: center;">Получи свой бонус!</h1>
        
        <div style="width: 340px; padding-top: 30px">
            <p style="font-size: 16px; text-align: justify">
            Оставь заявку и получи возможность получить невероянтный бонус от нашей компании. Пройди  игру "Лабиринт" и выиграй его!
            </p>
        </div>
        <a href="#" class="btn-start">Продолжить</a>
        <p style="font-size: 16px; text-align:center; padding-top:10px">Или закройте окно нажатием на крестик</p>
        <!-- <a href="#">Покинуть</a> -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/number-phone-val.js"></script>