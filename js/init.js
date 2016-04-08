$ = jQuery;
$(document).ready(function() {
    "use strict";

    // ressponsive nav
    $('.toogle_nav').click(function() {
        $(".main_nav_container").toggleClass('o_menu');
        $(this).toggleClass('is-active');
        return false;
    });
    $(".main_nav_container .menu-item-has-children>a").after('<i class="i-down"></i>');
    $(".menu-item-has-children i").click(function(event) {
        $(this).toggleClass('i-up').next().slideToggle("fast");
    });
    //$("select").selbel();
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

$(window).load(function() {
    //home slider
    var top_home_slider = new Swiper('#top_home_slider', {
        loop: true,
        paginationClickable: true,
        pagination: '.top_home_slider .swiper-pagination',
        nextButton: '.top_home_slider .swiper-button-next',
        prevButton: '.top_home_slider .swiper-button-prev',
        onInit: function(swiper) {
            $("#top_home_slider").addClass('loaded')
        }
    });
    //backstretch
    $('[data-bg]').each(function() {
        if ($(this).attr('data-bg').length) {
            $(this).backstretch($(this).attr('data-bg'));
        }
    });
});
