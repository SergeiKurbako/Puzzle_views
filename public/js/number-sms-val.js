$(document).ready(function(){
    let sms = $("#sms");

    $('#btn').click(function(){
        if(sms.val() == ''){
            $('.war-phone').css({'opacity':'1'});
        }else{
            $.ajax({
                url: "http://194.87.145.192/lidsystem/check-right-sms-code?sms_code="+sms.val(),
                success: function(data){
                  if(data == 'true'){
                    $('#btn-input').click();
                  }else{
                    $('.war-phone').css({'opacity':'1'});  
                  }
                }
              });
        }
    })


});