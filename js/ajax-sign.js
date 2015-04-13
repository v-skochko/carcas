/*jslint browser: true, white: true */
/*global $, jQuery, FastClick, bxSlider, console, ajax_login_object, ajaxurl */
$(document).ready(function(){
    'use strict';
    $(document).on('submit', '#ajaxlogin', function(){
        $('#login-result', this).slideDown(250).find(' > span').text(ajax_login_object.loadingmessage);
        var $this = $(this);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action': 'ajaxlogin',
                'username': $('#user_login', $this).val(),
                'password': $('#user_pass', $this).val(),
                'security': $('#security', $this).val()
            },
            success: function(data){
                $('#login-result > span', $this).text(data.message);
                if (data.loggedin === true){
                    window.location.reload();
                }
            }
        });
        return false;
    });

    $('#ajaxregi').submit(function () {
        var form = $('#ajaxregi'),
            $this = $(this);
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                $('#regi-result > span', $this).html(response.error);
                if(response.log_in === 1) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: ajax_login_object.ajaxurl,
                        data: {
                            'action': 'ajaxlogin',
                            'username': response.email,
                            'password': response.password,
                            'security': response.security
                        },
                        success: function(data){
                            if (data.loggedin === true){
                                window.location.reload();
                            }
                        }
                    });
                }
            }
        });
        return false;
    });
});
