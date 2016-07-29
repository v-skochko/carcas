$ = jQuery;
$(document).ready(function() {
    "use strict";
    $(".main_nav")
        .clone()
        .attr({class:''})
        .insertAfter(".resp_search")
        .find('ul')
        .removeAttr('id')
        .find('.menu-item-has-children>a')
        .after('<i class="i-down sub-anchor"></i>');

    // ressponsive nav
    $('.burger').click(function() {
        $(this).toggleClass('is-active');
        $("body").toggleClass('resp_menu_active');
        return false;
    });
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
             prevButton: '.top_home_slider .swiper-button-prev',
        nextButton: '.top_home_slider .swiper-button-next',
           breakpoints: {
            960: {
                slidesPerView: 10
            },
            480: {
                slidesPerView: 10
            }
        }
           onInit: function(swiper) {
            $("#top_home_slider").addClass('loaded')
        }
    });


});
