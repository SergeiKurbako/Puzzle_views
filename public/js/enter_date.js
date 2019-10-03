$(document).ready(function(){
    let name = false,
        second = false,
        patronymic = false,
        age = false,
        email = false;

    $('#btn').click(function(){
        if($('.name').val() == ''){
            $('.war-name').css({'opacity':'1'});
        }else{
            name = true;
            $('.war-name').css({'opacity':'0'});
        }

        if($('#second').val() == ''){
            $('.war-second').css({'opacity':'1'});
        }else{
            second = true;
            $('.war-second').css({'opacity':'0'});
        }

        if($('#patronymic').val() == ''){
            $('.war-patronymic').css({'opacity':'1'});
        }else{
            patronymic = true;
            $('.war-patronymic').css({'opacity':'0'});
        }

        if($('#age').val() == '' || $('#age').val() < 1 || $('#age').val() > 99){
            $('.war-age').css({'opacity':'1'});
        }else{
            age = true;
            $('.war-age').css({'opacity':'0'});
        }

        if($('#email').val() == '' || $('#email').val().indexOf('@') == -1){
            $('.war-email').css({'opacity':'1'});
        }else{
            email = true;
            $('.war-email').css({'opacity':'0'});
        }

        if(name && second && patronymic && age && email)$('#btn-input').click();
    });
});