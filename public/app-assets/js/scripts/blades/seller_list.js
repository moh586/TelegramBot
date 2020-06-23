
$( document ).ready(function() {

    $(".detaill").click(function () {
        customeractive($(this).data('val'),$(this),$(this).closest("tr"));
        return false;
    });
});




function customeractive(id,a,tr) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        /* the route pointing to the post function */
        url: '/seller/active',
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {'_token': CSRF_TOKEN, 'user_id':id},
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) {

            toastr.warning(data.message);
            a.html(data.statustext+' <i class=\"ft-disc\"></i>');
            if(data.status==0)
            {
                tr.addClass("bg-warning white");
            }
            else  if(data.status==1)
            {
                tr.removeClass( "bg-warning white");
            }
            return false;
        }
    });

    return false;
}

