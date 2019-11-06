$(document).ready(function(){

  var http = window.location.protocol;
  
  console.log('number-phone');

  $('.btn-start').click(function(){
    $('.entrance-start').css({'display' : 'none'})
    $('.entrance').css({'display' : 'block'})
  })

    var phone = $("#phone");
    
    $('#btn').click(function(){
        if(phone.val() == ''){
            $('.war-phone').css({'opacity':'1'});
        }else{
            $.ajax({
              headers: { "Accept": "application/text"},
              type: "GET",
              dataType: 'text',
                url: http+"//partycamera.org/lidsystem/check-have-phone?phone="+phone.val(),
                // url: http+"//admin.webwidgets.ru/lidsystem/check-have-phone?phone="+phone.val(),
                // url: "http://127.0.0.2/lidsystem/check-have-phone?phone="+phone.val(),
                
                success: function(data){
                  if(data != 'true'){
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


// $('#btn-input').click();