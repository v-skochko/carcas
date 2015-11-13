$ = jQuery;
$(document).ready(function() {
    "use strict";

    // ressponsive nav
    $('.toogle_nav').click(function() {
        $(this).next().toggleClass('o_menu');
        $(this).toggleClass('is-active');
        return false;
    });
    $(".main_nav_container .menu-item-has-children>a").after('<i class="i-down"></i>');
    $(".menu-item-has-children i").click(function(event) {
        $(this).toggleClass('i-up').next().slideToggle("fast");
    });

    //bx_slider
    $('.bx_slider ul').bxSlider({
        nextText: "<i class='icf-left'></i>",
        prevText: "<i class='icf-right'></i>",
        pause: 7000,
        // pager: false,
        auto: true,
        onSliderLoad: function() {
            $('.slider').addClass('slider_loaded ');
        }
    });
    $("select").selbel();

    /*Contact form7 - close validation error on click*/
    $(this).on('click', '.wpcf7-not-valid-tip', function() {
        $(this).prev().trigger('focus');
        $(this).fadeOut(500, function() {
            $(this).remove();
        });
    });
    $(".wpcf7-response-output").click(function(event) {
        $(this).slideUp(400);
    });
});
/* end ready*/