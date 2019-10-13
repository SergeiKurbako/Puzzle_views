$(document).ready(function(){
    var popup = $('.popup-user');

    var slideMenu = false,
        mouseSlideMenu = true;

    var speed = 100;

    var slider = $('.slider'),
        burgerBox =  $('.js-header--burger-box');

    popup.mouseleave(function (){
		popup.hide(speed);
    });

    $('.header__user').mouseenter(function(){
        popup.show(speed);
    });

    burgerBox.click(function(){
        slideMenuToggle('click');
    });

    slider.mouseenter(function(){
        if(!slideMenu) slideMenuToggle('mouseenter');
    });

    slider.mouseleave(function(){
        if(mouseSlideMenu) slideMenuToggle('mouseenter');
    });

    function slideMenuToggle(actions){
        if(slideMenu){
            slideMenu = false;

            $('.slider').animate({width:'70'}, speed);
            $('.slider__menu--text').hide();
            $('.slider__administrator').animate({paddingLeft:'0'}, speed);
            
            if(actions == 'click'){
                $('.slider-and-header--shadow').animate({width:'70'}, speed);
                $('.header__icon').animate({paddingLeft:'85'}, speed);
                $('.main__wrapper').animate({paddingLeft:'40'}, speed);

                mouseSlideMenu = true;
            }

        }else{
            slideMenu = true;

            $('.slider').animate({width:'280'}, speed);
            $('.slider__menu--text').show();
            $('.slider__administrator').animate({paddingLeft:'15'}, speed);  
            
            if(actions == 'click'){
                if (location.href.indexOf('/complaints') == '-1'){
                    console.log("good")
                    $('.slider-and-header--shadow').animate({width:'280'}, speed);
                }

                // $('.slider-and-header--shadow').animate({width:'280'}, speed);
                $('.header__icon').animate({paddingLeft:'285'}, speed);  
                $('.main__wrapper').animate({paddingLeft:'70'}, speed);
                

                mouseSlideMenu = false;
            }
        }
    }

    // Вместо ссылок стоят чекбоксы. При измении чекбокса. Отправляется ajax-запрос по ссылке.

    var smsCheckbox = $('.sms-checkbox'),
        emailCheckbox = $('.email-checkbox'),
        complaintCheckbox = $('.complaint-checkbox');

    smsCheckbox.change(function(){
        if(this.checked)ajaxLink('.sms-check-', this.id, 'on', 'off')
        else ajaxLink('.sms-check-', this.id, 'off', 'on');
    })

    emailCheckbox.change(function(){
        if(this.checked) ajaxLink('.email-check-', this.id, 'on', 'off')
        else ajaxLink('.email-check-', this.id, 'off', 'on')
    });

    complaintCheckbox.change(function(){
        // if(this.checked) window.open($('.complaint-check-'+this.id).attr('href'),'_parent');
        // else window.open($('.complaint-check-'+this.id).attr('href'),'_parent');
        
        if(this.checked) ajaxLink('.complaint-check-', this.id, 'on', 'off')
        else ajaxLink('.complaint-check-', this.id, 'off', 'on')
    });

    function ajaxLink(classLink, id, status, newStatus){
        $.ajax({
            url: $(classLink+id).attr('href'),

            success: function(){
                let url = $(classLink+id).attr('href');

                let newUrl = url.replace('/?status='+status, '/?status='+newStatus);

                $(classLink+id).attr('href', newUrl);
               
              }
          });
    }

    $('.main__table--select select').click(function(){
        $(".main__table--select select :selected").val();
        
        // console.log(window.location.origin + window.location.pathname+'?item_count='+ $(".main__table--select select :selected").val())
        
        window.open(window.location.origin + window.location.pathname+'?item_count='+ $(".main__table--select select :selected").val(),'_parent');
        
    })

    if(window.location.pathname.indexOf('/user/') != -1){
        $('.fa-user').css({'color':'#2898F3'})
    }else if(window.location.pathname.indexOf('requests') != -1){
        $('.fa-recycle').css({'color':'#2898F3'})
    }else if(window.location.pathname.indexOf('complaints') != -1){
        $('.fa-angry').css({'color':'#2898F3'})
    }else if(window.location.pathname.indexOf('wallet') != -1){
        $('.fa-recycle').css({'color':'#2898F3'})
    }else if(window.location.pathname === '/admin-dashboard'){
        $('.fa-home').css({'color':'#2898F3'})
    }


    var sl;
    var code;

    $('.code-frame').click(function(){
        sl = $(this);
            code = $(this).text();
            textSl = $(this).text();

        $(this).html("<textarea id='textareaText' cols='40' rows='10'>"+ $.trim(code)+"</textarea>");
        $('#textareaText').select();
    });

    jQuery(function($){
        $(document).mouseup(function (e){ // событие клика по веб-документу
            var div = sl; // тут указываем ID элемента
            if (!div.is(e.target) // если клик был не по нашему блоку
                && div.has(e.target).length === 0) { // и не по его дочерним элементам
                    // div.hide(); // скрываем его
                    div.html('<xmp>'+ $.trim(code) +'</xmp>');
                    div.show();
            }
          });
      });

    // slider__menu--img i
    if($('#gender') != undefined) $('#gender').SumoSelect();
    if($('#status') != undefined) $('#status').SumoSelect();
    


    // Trigger
    
});