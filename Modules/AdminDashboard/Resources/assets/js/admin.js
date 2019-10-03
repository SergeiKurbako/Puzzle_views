$(document).ready(function(){
    let popup = $('.popup-user');

    let slideMenu = false,
        mouseSlideMenu = true;

    let speed = 100;

    let slider = $('.slider'),
        burgerBox =  $('.js-header--burger-box');

    

    $(document).mouseup(function (e){
		if (!popup.is(e.target) && popup.has(e.target).length === 0) popup.hide(speed);
	});

    $('.header__user').click(function(){
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
                $('.header__icon').animate({paddingLeft:'110'}, speed);
                $('.main__wrapper').animate({paddingLeft:'40'}, speed);

                mouseSlideMenu = true;
            }

        }else{
            slideMenu = true;

            $('.slider').animate({width:'280'}, speed);
            $('.slider__menu--text').show();
            $('.slider__administrator').animate({paddingLeft:'15'}, speed);  
            
            if(actions == 'click'){
                $('.slider-and-header--shadow').animate({width:'280'}, speed);
                $('.header__icon').animate({paddingLeft:'320'}, speed);  
                $('.main__wrapper').animate({paddingLeft:'70'}, speed);

                mouseSlideMenu = false;
            }
        }
    }

    
});