<link rel="stylesheet" href="../../../../css/reset.css">
<link rel="stylesheet" href="../../../../css/fonts.css">

<head>
<style>
*:root{
    font-family: 'Roboto','Nunito', 'Arial', 'sans-selif';
}

body{
    background: #2196f3;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
        -ms-flex-pack: center;
            justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
        -ms-flex-align: center;
            align-items: center;
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

</style>


</head>

    <div class="entrance-start">
        
        <a style="padding: 20px 80px;" href="/gameframe/{{$frameId}}?&code={{$code}}&lid_id={{$lidId}}">Начать игру</a>
        <!-- <a href="#">Покинуть</a> -->
    </div>
