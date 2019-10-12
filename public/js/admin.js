$(document).ready(function(){
    let popup = $('.popup-user');

    let slideMenu = false,
        mouseSlideMenu = true;

    let speed = 100;

    let slider = $('.slider'),
        burgerBox =  $('.js-header--burger-box');

    popup.mouseleave(function (){
        console.log("gg")
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

    let smsCheckbox = $('.sms-checkbox'),
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

    
    $('#gender').SumoSelect();
    $('#status').SumoSelect();

});