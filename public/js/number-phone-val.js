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
    let phone = $("#phone");
    
    $('#btn').click(function(){
        if(phone.val() == ''){
            $('.war-phone').css({'opacity':'1'});
        }else{
            $('#btn-input').click();
        }
    })
});