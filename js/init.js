$ = jQuery;
$(document).ready(function () {
    "use strict";
    $(".mobile_nav").find('.menu-item-has-children>a').after('<i class="i-down sub-anchor"></i>');
    $('.burger').click(function () {
        $(this).toggleClass('is-active');
        $("body").toggleClass('resp_menu_active');
        return false;
    });
    $('.resp_container').clickOff(function () {
        $('.burger').removeClass('is-active');
        $("body").removeClass('resp_menu_active');
        return false;
    });
    $(".menu-item-has-children i").click(function (event) {
        $(this).toggleClass('i-up').next().slideToggle("fast");
    });
   /*Contact form7 - close validation error on click*/
    $(this).on('click', '.wpcf7-not-valid-tip', function () {
        $(this).prev().trigger('focus');
        $(this).fadeOut(500, function () {
            $(this).remove();
        });
    });
    $(".wpcf7-response-output").click(function (event) {
        $(this).slideUp(400);
    });
    // $('select').selectric({
    //     disableOnMobile: false
    // });
    //$('.datepicker').pickadate()
});
/* end ready*/
$(window).on('load', function () {
    // var main_slider = new Swiper('.main_slider', {
    //     loop: true,
    //     paginationClickable: true,
    //     pagination: '.main_slider .swiper-pagination',
    //     prevButton: '.main_slider .swiper-button-prev',
    //     nextButton: '.main_slider .swiper-button-next',
        //     effect: 'fade',
    //     fade: {crossFade: true},
    //     virtualTranslate: true,
    //     autoplay: 5000,
    //     speed: 1000,

    //     spaceBetween: 40,
    //     onInit: function (swiper) {
    //         $("body").addClass('main_slider_loaded')
    //     },
    //    paginationBulletRender: function (swiper, index, className, swiperprocessstep) {
     //       return '<span class="' + className + ' "> ' + swiper.slides.eq(index).attr('data-name') + '</span>';
    //    },
    //     breakpoints: {
    //         480: {
    //             slidesPerView: 1
    //         }
    //     }
    // });
});
