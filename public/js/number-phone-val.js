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

// $(document).ready(function(){
//     let phone = $("#phone");
    
//     $('#btn').click(function(){
//         if(phone.val() == ''){
//             $('.war-phone').css({'opacity':'1'});
//         }else{
//             $.ajax({
//                 url: "http://partycamera.org/lidsystem/check-have-phone?phone="+phone.val(),
//                 success: function(data){
//                   if(data != 'true'){
//                     $('#btn-input').click();
//                   }else{
//                     $('.war-phone').css({'opacity':'1'});  
//                   }
                
//                 }
//               });
//         }
//     })
// });

// $('#btn-input').click();