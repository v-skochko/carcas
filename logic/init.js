/*jslint browser: true, white: true*/
/*global $, jQuery, FastClick*/
$ = jQuery;

var hash = window.location.hash;
var ww = document.body.clientWidth;

var mob = false;
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Windows Phone|ZuneWP7|Nokia|Opera Mini/i.test(navigator.userAgent)) { var mob = true; }
var supportsTouch = false;
if (window.hasOwnProperty('ontouchstart') || window.navigator.msPointerEnabled) { supportsTouch = true; }
function footer(e){
    "use strict";
    $('.footix').height($('footer').outerHeight());
}
$(document).ready(function () {
    "use strict";
    $(this).on('click', '.wpcf7-not-valid-tip', function(){
        $(this).prev().trigger('focus');
        $(this).fadeOut(500,function(){
            $(this).remove();
        });
    });
});

$(window).load(function(){
    "use strict";
});

