$(document).ready(function(){
    var http = window.location.protocol;
    var sms = $("#sms");

    $('#btn').click(function(){
        if(sms.val() == ''){
            $('.war-phone').css({'opacity':'1'});
        }else{
            $.ajax({
              headers: { "Accept": "application/text"},
              type: "GET",
              dataType: 'text',
                url: http+"//194.87.145.192lidsystem/check-right-sms-code?sms_code="+sms.val(),
                // url: http+"//admin.webwidgets.ru/lidsystem/check-right-sms-code?sms_code="+sms.val(),
                // url: "http://127.0.0.2/lidsystem/check-right-sms-code?sms_code="+sms.val(),
                
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