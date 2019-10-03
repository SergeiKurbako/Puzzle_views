$(document).ready(function(){
    let sms = $("#sms");

    $('#btn').click(function(){
        if(sms.val() == ''){
            $('.war-phone').css({'opacity':'1'});
        }else{
            $('#btn-input').click();
        }
    })
});