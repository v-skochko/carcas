$ = jQuery;
$(document).ready(function() {
    "use strict";
    $('.toogle_nav').click(function() {
        $(this).next().toggleClass('o_menu');
          $(this).toggleClass('is-active');
        return false;
    });

    $(".main_nav_container .menu-item-has-children").append('<i class="icf-down"></i>')
    $(".menu-item-has-children i").click(function(event) {
        $(this).prev('.sub-menu').slideToggle("fast");


    });

    //BXslider
    $('.slider ul').bxSlider({
        nextText: "",
        prevText: "",
        pause: 7000,
        pager: false,
        auto: true,
        onSliderLoad: function() {
            $('.slider').addClass('slider_loaded ');
        }
    });


    /*Contact form7 - close validation error on click*/
    $(this).on('click', '.wpcf7-not-valid-tip', function() {
        $(this).prev().trigger('focus');
        $(this).fadeOut(500, function() {
            $(this).remove();
        });
    });
});
/* end ready*/
$(window).load(function() {
    "use strict";
});
