/* ==========================================================================
    swiper source
    https://raw.githubusercontent.com/nolimits4web/Swiper/master/dist/js/swiper.jquery.min.js
    Fancybox source
    https://raw.githubusercontent.com/fancyapps/fancybox/master/dist/jquery.fancybox.min.js
    Selectric source
    https://raw.githubusercontent.com/lcdsantos/jQuery-Selectric/master/public/jquery.selectric.min.js
    Date Picker
    https://github.com/amsul/pickadate.js/edit/master/lib/compressed/picker.js
    https://raw.githubusercontent.com/amsul/pickadate.js/master/lib/compressed/picker.date.js
    Malihu custom scrollbar
    https://raw.githubusercontent.com/malihu/malihu-custom-scrollbar-plugin/master/js/minified/jquery.mCustomScrollbar.min.js
    css3animate-it
    https://raw.githubusercontent.com/Tusko/WP-Anatomy/master/js/libs/css3animate-it.js
  ========================================================================== */

// @formatter:off
/*clickOff*/$.fn.clickOff = function (callback, selfDestroy) {var clicked = false;var parent = this;var destroy = selfDestroy || true;parent.click(function () {clicked = true;});$(document).click(function (event) {if (!clicked) {callback(parent, event);}if (destroy) {}clicked = false;});};
// @formatter:on

$(document).ready(function () {
    "use strict";
    $(".mobile_nav").find('.menu-item-has-children>a').after('<i class="i-down sub-anchor"></i>');
    $('.burger').click(function () {
        $(this).toggleClass('is-active');
        $("body").toggleClass('mobile_menu_active');
        return false;
    });
    $('.mobile_menu_container').clickOff(function () {
        $('.burger').removeClass('is-active');
        $("body").removeClass('mobile_menu_active');
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
});
