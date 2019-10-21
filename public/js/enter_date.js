$(document).ready(function(){
    var http = window.location.protocol;

    let name = false,
        second = false,
        patronymic = false,
        age = false,
        email = false,
        emailCheck = false;

    let nameFor = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`=1234567890";


    if($('#phone').val() == ''){
        $('#phone').val(0);
        $('.entrance-start').removeClass('disabled');
    }else{
        $('.entrance').removeClass('disabled');
    }

    console.log($("#phone").val())

    $(".btn-start").click(function(){
        $('.entrance-start').addClass('disabled');
        $('.entrance').removeClass('disabled');
    })

    $('#btn').click(function(){

        for (let x = 0; x<$('.name').val().length; x++){
            if( nameFor.indexOf($('.name').val()[x]) != -1  || $('.name').val() == ''){
                $('.war-name').css({'opacity':'1'});
                break;
            }else{
                $('.war-name').css({'opacity':'0'});
                name = true;
            }
        };
    
        for (let x = 0; x<nameFor.length; x++){
            if( $('#second').val().indexOf(nameFor[x]) != -1 || $('#second').val() == ''){
                $('.war-second').css({'opacity':'1'});
                break;
            }else{
                $('.war-second').css({'opacity':'0'});
                second = true;
            }
        };

        for (let x = 0; x<nameFor.length; x++){
            if( $('#patronymic').val().indexOf(nameFor[x]) != -1 || $('#patronymic').val() == ''){
                $('.war-patronymic').css({'opacity':'1'});
                break;
            }else{
                $('.war-patronymic').css({'opacity':'0'});
                patronymic = true;
            }
        };

        if($('#age').val() == '' || $('#age').val() < 1 || $('#age').val() > 99){
            $('.war-age').css({'opacity':'1'});
        }else{
            age = true;
            $('.war-age').css({'opacity':'0'});
        }

        if($('#email').val() == '' || $('#email').val().indexOf('@') == -1 || $('#email').val().indexOf('.') == -1){
            $('.war-email').css({'opacity':'1'});
        }else{
            
            $('.war-email').css({'opacity':'0'});
            email = true;
        }

        if(email){
            var test_str = window.location.href;
            var start_pos = test_str.indexOf('frame_id')+9;
            var end_pos = test_str.indexOf('&code',start_pos);
            var text_to_get = test_str.substring(start_pos,end_pos);

            $.ajax({
                headers: { "Accept": "application/text"},
                type: "GET",
                dataType: 'text',
                // url: "https://partycamera.org/lidsystem/check-have-email?email=" + $('#email').val(),
                // url: "http://partycamera.org/lidsystem/check-have-email?email=" + $('#email').val(),
                url: http+"/check-have-email?email="+ $('#email').val()+"&frame_id="+text_to_get,

                // url: "http://194.87.145.192/lidsystem/check-have-email?email="+ $('#email').val()+"&frame_id="+text_to_get,
    
                // url: "http://127.0.0.2/lidsystem/check-have-email?email=" + $('#email').val(),
                success: function(data){

                    console.log("http://194.87.145.192/lidsystem/check-have-email?email="+ $('#email').val()+"&frame_id="+text_to_get);

                  if(data != 'true'){
                    emailCheck = true;
                    if(name && second && patronymic && age && email && emailCheck)$('#btn-input').click();
                  }else{
                    $('.war-email').text('Данный email уже зарегистрирован');
                    $('.war-email').css({'opacity':'1'});  
                    return;
                  }
                }
            });
        }

        if(name && second && patronymic && age && email && emailCheck)$('#btn-input').click();
        
    });
});


$(document).ready(function() {
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });