$ = jQuery;
$(document).ready(function () {
    "use strict";

    // $('select').selectric({
    //     disableOnMobile: false
    // });
    //$('.datepicker').pickadate()
});
/* end ready*/
$(window).on('load', function () {
   
    //new
        var testimonials_slider = new Swiper('.testimonials_slider', {
        loop: true,
        speed: 1000,
        autoplay: {
            delay: 4000
        },
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
            clickable: true
        },
        navigation: {
            nextEl: '.swiper-next',
            prevEl: '.swiper-prev'
        },
              on: {
            init: function () {
                $('.work_bottom_slider').addClass('slider_loaded');
            }
        }
    });
});
