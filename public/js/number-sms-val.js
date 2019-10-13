$(document).ready(function(){
    let sms = $("#sms");

    $('#btn').click(function(){
        if(sms.val() == ''){
            $('.war-phone').css({'opacity':'1'});
        }else{
            $.ajax({
                url: "https://partycamera.org/lidsystem/check-right-sms-code?sms_code="+sms.val(),
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

$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});