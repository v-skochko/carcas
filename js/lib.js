//swiper source   https://raw.githubusercontent.com/nolimits4web/Swiper/master/dist/js/swiper.jquery.min.js
//fancybox source   https://raw.githubusercontent.com/fancyapps/fancybox/master/dist/jquery.fancybox.min.js



//clickOff
$.fn.clickOff = function (callback, selfDestroy) { var clicked = false; var parent = this; var destroy = selfDestroy || true; parent.click(function () { clicked = true; }); $(document).click(function (event) { if (!clicked) { callback(parent, event); } if (destroy) { } clicked = false; }); };
