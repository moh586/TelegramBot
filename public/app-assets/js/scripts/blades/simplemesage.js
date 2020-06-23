
$( document ).ready(function() {

});


(function(window, document, $) {
    'use strict';

    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
})(window, document, jQuery);







$(".btn-primary").click(function () {
    //alert($(this).data('href'));
    sendMessage();
    return false;
});





$(".btn-warning").click(function () {

    window.location.href = $(this).data('href');
});

$(".detaill").click(function () {
    customeractive($(this).data('val'),$(this),$(this).closest("tr"));
});




function sendMessage()
{


        var CSRF_TOKEN = $('input[name="_token"]').val();

        //
        //
        $.ajax({
            /* the route pointing to the post function */
            url: '/channel/send/simplemessage',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            dataType: 'json',
            beforeSend: function () {
                $('#messagecard').block({
                    message: '<div class="ft-refresh-cw icon-spin font-large-3"></div>',
                    //timeout: 2000, //unblock after 2 seconds
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            },
            complete: function () {
                $('#messagecard').unblock();
            },
            success: function (data) {

                if (data.status == 1) {
                    toastr.success(data.message);

                    resetForm();
                }
                else {
                    toastr.error(data.message);
                }

            },

            data: {
                _token: CSRF_TOKEN,
                message: $('textarea[name="message"]').val(),
            },

        });
        return false;

}


function resetForm() {
    $('#message').val("");
}





