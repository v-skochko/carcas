//swiper source   https://raw.githubusercontent.com/nolimits4web/Swiper/master/dist/js/swiper.jquery.min.js
//fancybox source   https://raw.githubusercontent.com/fancyapps/fancybox/master/dist/jquery.fancybox.min.js
//selectric https://raw.githubusercontent.com/lcdsantos/jQuery-Selectric/master/public/jquery.selectric.min.js
//datepicker https://github.com/amsul/pickadate.js/edit/master/lib/compressed/picker.js  https://raw.githubusercontent.com/amsul/pickadate.js/master/lib/compressed/picker.date.js
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//clickOff
$.fn.clickOff = function (callback, selfDestroy) { var clicked = false; var parent = this; var destroy = selfDestroy || true; parent.click(function () { clicked = true; }); $(document).click(function (event) { if (!clicked) { callback(parent, event); } if (destroy) { } clicked = false; }); };
/*Contact form7 - close validation error on click*/
