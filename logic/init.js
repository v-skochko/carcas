$ = jQuery;
var ww = document.body.clientWidth;
var mob = false;
$(document).ready(function() {
    "use strict";
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