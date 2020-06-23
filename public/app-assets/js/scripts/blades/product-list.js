
$( document ).ready(function() {

    $(".detaill").click(function () {
        productActive($(this).data('val'),$(this),$(this).closest("tr"));
        return false;
    });

    $(".delete").click(function () {
        productDelete($(this).data('val'),$(this),$(this).closest("tr"));
        return false;
    });

    $(".btn-sm").click(function () {
        //alert($(this).data('href'));
        window.location.href = $(this).data('href');
    });

    $(".btn-edit").click(function () {
        //alert($(this).data('href'));
        //window.location.href = $(this).data('href');
    });
});


function productDelete(id,a,tr) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        /* the route pointing to the post function */
        url: '/product/delete',
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {'_token': CSRF_TOKEN, 'product_id':id},
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) {



            if(data.status==0)
            {
                toastr.warning(data.message);
            }
            else  if(data.status==1)
            {
                toastr.success(data.message);
                tr.remove();
            }

            return false;
        }
    });

    return false;
}



function productActive(id,a,tr) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        /* the route pointing to the post function */
        url: '/product/active',
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {'_token': CSRF_TOKEN, 'product_id':id},
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) {


            a.html(data.statustext+' <i class=\"ft-disc\"></i>');
            if(data.status==0)
            {
                toastr.warning(data.message);
                tr.addClass("bg-warning white");
            }
            else  if(data.status==1)
            {
                toastr.success(data.message);
                tr.removeClass( "bg-warning white");
            }
            else
            {
                toastr.error(data.message);
            }
            return false;
        }
    });

    return false;
}

