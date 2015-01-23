$ = jQuery;
var ww = document.body.clientWidth;
var mob = false;
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Windows Phone|ZuneWP7|Nokia|Opera Mini/i.test(navigator.userAgent)) { var mob = true; }
$(document).ready(function() {
    "use strict";
    /* sticky footer */
    $('.footix').height($('footer').outerHeight());
   /* close validation error on click*/
    $(this).on('click', '.wpcf7-not-valid-tip', function() {
        $(this).prev().trigger('focus');
        $(this).fadeOut(500, function() {
            $(this).remove();
        });
    });
}); /* end ready*/
$(window).load(function() {
    "use strict";
});