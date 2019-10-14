<link rel="stylesheet" href="../css/reset.css">
<link rel="stylesheet" href="../css/fonts.css">
<link rel="stylesheet" href="../css/lig-systems.css">
<link rel="stylesheet" href="../css/enter-date.css">
<div class="entrance">
    <h1>Шаг 3/3</h1>
    <form action="/lidsystem/step3/create" method="post">
    @csrf
        <div class="bl-input">
            <div class="bl-input__wrapper">

                <div class="bl-input__wrapper--item">
                    <input type="text" name="phone" value="{{$phone}}" hidden>
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
                        <option value="waman">женский</option>
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