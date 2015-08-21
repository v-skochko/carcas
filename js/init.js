$ = jQuery;
$(document).ready(function () {
    "use strict";
    //BXslider
    $('.slider ul').bxSlider({
        nextText: "",
        prevText: "",
        pause: 7000,
        pager: false,
        auto: true,
        onSliderLoad: function () {
            $('.slider').addClass('slider_loaded ');
        }
    });
    //selbel itit
    $("select").selbel();
    /*Contact form7 - close validation error on click*/
    $(this).on('click', '.wpcf7-not-valid-tip', function () {
        $(this).prev().trigger('focus');
        $(this).fadeOut(500, function () {
            $(this).remove();
        });
    });
});
/* end ready*/
$(window).load(function () {
    "use strict";
});
