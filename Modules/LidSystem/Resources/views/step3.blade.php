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


/* .entrance{
    display: none;
} */

.disabled{
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



<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" href="../css/reset.css">
<link rel="stylesheet" href="../css/fonts.css">
<link rel="stylesheet" href="../css/lig-systems.css">
<link rel="stylesheet" href="../css/enter-date.css">


<div class="entrance-start disabled">
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


<div class="entrance disabled">
    <h1 class="header_title">Шаг 3/3</h1>
    <form action="/lidsystem/step3/create" method="post">
    @csrf
        <div class="bl-input">
            <div class="bl-input__wrapper">

                <div class="bl-input__wrapper--item">
                    <input id="phone" type="text" name="phone" value="{{$phone}}" hidden>
                    <input type="text" name="lid_id" value="{{$lidId}}" hidden>
                    <input type="text" name="code" value="{{$code}}" hidden>
                    <label for="first">Имя</label>
                    <input class="name" for="first" type="text" name="first_name" value="" required>
                    <p class="war-name">Некорректное имя</p>
                </div>

                <div class="bl-input__wrapper--item">
                    <label for="patronymic">Отчество</label>
                    <input id="patronymic" type="text" name="patronymic_name" value="">
                    <p class="war-patronymic">Некорректное отчество</p>
                   
                </div>

            </div>
            <label for="second">Фамилия</label>
            <input id="second" type="text" name="second_name" value="" required>
            <p class="war-second">Некорректная фамилия</p>

            <div class="bl-input__wrapper">
                <div>
                    <label for="gender">Пол</label><br>
                    <select id="gender" name="gender">
                        <option value="man">мужской</option>
                        <option value="women">женский</option>
                    </select>
                </div>
                
                <div>
                <label for="age">Возраст</label><br>
                <input id="age" class="entrance__age" type="number" name="age" value="" required>
                <p class="war-age">Некорректный возраст</p>
                </div>
            </div>

            <label for="email">E-mail</label>
            <input id="email" type="text" name="email" value="" required>
            <p class="war-email">Некорректный E-mail</p>

            <label for="job">Место работы</label>
            <input id="job" type="text" name="work_place" value="">
            <p class="war-job"></p>

        </div>
        <div class="entrance__btn">
            <div class="entrance__btn-login">
                <input id="btn-input" type="submit" value="Далее" hidden>
                <span id="btn">Далее</span>
                <input type="text" name="frame_id" value="{{$frameId}}" hidden><br>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="../js/enter_date.js"></script>