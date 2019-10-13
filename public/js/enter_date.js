$(document).ready(function(){
    let name = false,
        second = false,
        patronymic = false,
        age = false,
        email = false;

    let nameFor = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`=1234567890";

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
             $.ajax({
                headers: { "Accept": "application/text"},
                type: "GET",
                dataType: 'text',
                url: "http://partycamera.org/lidsystem/check-have-email?email=" + $('#email').val(),
                success: function(data){
                  if(data != 'true'){
                    email = true;
                  }else{
                    $('.war-email').text('Данный email уже зарегистрирован');
                    $('.war-email').css({'opacity':'1'});  
                    return;
                  }
                }
              });
              
              $('.war-email').css({'opacity':'0'});
        }

        if(name && second && patronymic && age && email)$('#btn-input').click();
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