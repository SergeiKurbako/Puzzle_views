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

    if(window.location.pathname.indexOf('/user/') != -1){
        $('.fa-user').css({'color':'#2898F3'})
        $('.slider__menu--user').css({'color':'#2898F3'})
    }else if(window.location.pathname.indexOf('requests') != -1){
        $('.fa-recycle').css({'color':'#2898F3'})
        $('.slider__menu--request').css({'color':'#2898F3'})
    }else if(window.location.pathname.indexOf('complaints') != -1){
        $('.fa-angry').css({'color':'#2898F3'})
        $('.slider__menu--complaints').css({'color':'#2898F3'})
    }else if(window.location.pathname.indexOf('wallet') != -1){
        $('.fa-recycle').css({'color':'#2898F3'})
    }else if(window.location.pathname === '/admin-dashboard'){
        $('.fa-user').css({'color':'#2898F3'})
        $('.slider__menu--user').css({'color':'#2898F3'})
    }else if(window.location.pathname === '/user-dashboard'){
        $('.fa-user').css({'color':'#2898F3'})
        $('.slider__menu--user').css({'color':'#2898F3'})
    }else if(window.location.pathname.indexOf('/frame/') != -1){
        $('.fa-user').css({'color':'#2898F3'})
        $('.slider__menu--user').css({'color':'#2898F3'})
    }else if(window.location.pathname.indexOf('/billing') != -1){
        $('.fa-credit-card').css({'color':'#2898F3'})
        $('.slider__menu--billing').css({'color':'#2898F3'})
    }
    
    // Trigger
    var sl;
    var code;

    $('.code-frame').click(function(){
        sl = $(this);
        code = $(this).text();

        $(this).html("<textarea id='textareaText' cols='40' rows='10'>"+ $.trim(code)+"</textarea>");
        $('#textareaText').select();
    });

    jQuery(function($){
        $(document).mouseup(function (e){
            var div = sl;
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                    // div.hide(); // скрываем его
                    div.html('<xmp>'+ $.trim(code) +'</xmp>');
                    div.show();
            }
          });
      });

    // slider__menu--img i
    if($('#gender') != undefined) $('#gender').SumoSelect();
    if($('#status') != undefined) $('#status').SumoSelect();
    if($('#result_game') != undefined) $('#result_game').SumoSelect();
    

    // if($('.main__table--select select') != undefined) $('.main__table--select select').SumoSelect();

    // if($('.main__table--select select') != undefined) $('.main__table--select select').SumoSelect();


    // $('.main__table--select .opt').click(function(){
    //     sessionStorage.setItem(window.location.pathname, s.val());
    //     window.open(window.location.origin + window.location.pathname+'?item_count='+ $(this).text(),'_parent');
    // })
    

// Selected

    // var urlSelect = window.location.href;
    // var start_url_select = test_str.indexOf('?item_count=')+9;
    // var end_url_select = test_str.indexOf('&code',start_url_select);
    // var text_to_get = test_str.substring(start_pos,end_pos);
    // console.log(text_to_get)

    if($('.menu_request').text() >= 1){
        $('.menu_request').css("opacity","1");
    }
    if($('.menu__complaints').text() >= 1){
        $('.menu__complaints').css("opacity","1");
    }
    
    
});