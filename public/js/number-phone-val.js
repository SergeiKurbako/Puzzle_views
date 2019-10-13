// $(document).ready(function(){
//     let phone = $("#phone");
//     phone.mask("+999 99 99-99-999 ? 99");

//     $('#btn').click(function(){
//         if(phone.val() == ''){
//             $('.war-phone').css({'opacity':'1'});
//         }else{
//             $('#btn-input').click();
//         }
//     })
// });

$(document).ready(function(){

  $('.btn-start').click(function(){
    $('.entrance-start').css({'display' : 'none'})
    $('.entrance').css({'display' : 'block'})
  })

    let phone = $("#phone");
    
    $('#btn').click(function(){
        if(phone.val() == ''){
            $('.war-phone').css({'opacity':'1'});
        }else{
            $.ajax({
              headers: { "Accept": "application/text"},
              type: "GET",
              dataType: 'text',
                url: "http://partycamera.org/lidsystem/check-have-phone?phone="+phone.val(),
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