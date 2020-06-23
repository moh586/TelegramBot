// Wizard tabs with icons setup

(function(window, document, $) {


    //Customer TypeHead
    $(".touchspin").TouchSpin({ min: 1, max: 10});
    'use strict';
    var customertoken = new Bloodhound({
        datumTokenizer: function(datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            wildcard: '%QUERY',
            url: "/customer/typehead/%QUERY",
            transform: function(response) {
                return $.map(response, function(data) {
                    $('#customer_id').val(data.id);
                    return { name: (data.first_name==null?"":data.first_name)+' '+(data.last_name==null?"":data.last_name),
                        username:data.username,
                        avatar:data.avatar};
                });
            }
        }
    });
    //


    $('#customer').typeahead({
        hint: false,
        highlight: true,
        minLength: 3,
        limit: 20
    },{
        limit: 20,
        name:'customers',
        display:"name",
        source: customertoken,
        templates: {
            empty: [
                '<div class="empty-message">',
                'موردی یافت نشد',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile('<div class="media">\n' +
                '<div class="media-left pr-1">\n' +
                '<span class="avatar avatar-sm avatar-online rounded-circle">\n' +
                '<img src="/storage/{{avatar}}" alt="avatar"><i></i>\n' +
                '</span>\n' +
                '</div>\n' +
                '<div class="media-body w-100">\n' +
                '<h6 class="media-heading mb-0">{{name}}</h6>\n' +
                '<p class="font-small-2 mb-0 text-muted"><td>{{username}}</td></p>\n' +
                '</div>\n' )
        }

    });

    //******************************************product TypeHead

    'use strict';
    var producttoken = new Bloodhound({
        datumTokenizer: function(datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            wildcard: '%QUERY',
            url: "/product/typehead/%QUERY",
            transform: function(response) {
                return $.map(response, function(data) {
                    $('#product_id').val(data.id);
                    return { name: data.name,
                        brand:data.brand,
                        price:data.price};
                });
            }
        }
    });
    //


    $('#product').typeahead({
        hint: false,
        highlight: true,
        minLength: 2,
        limit: 20
    },{
        limit: 20,
        name:'customers',
        display:"name",
        source: producttoken,
        templates: {
            empty: [
                '<div class="empty-message">',
                'موردی یافت نشد',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile('<div class="media">\n' +
                '<div class="media-left pr-1">\n' +
                '<span class="mt-2 center">\n' +
                '{{price}}<i></i>\n' +
                '</span>\n' +
                '</div>\n' +
                '<div class="media-body w-100">\n' +
                '<h6 class="media-heading mb-0">{{name}}</h6>\n' +
                '<p class="font-small-2 mb-0 text-muted"><td>{{brand}}</td></p>\n' +
                '</div>\n' )
        }

    });
    $(".btn-warning").click(function () {
        //alert($(this).data('href'));
        window.location.href = $(this).data('href');
    });

    $("#btn").click(function () {
        var form = $(this).parents('form:first');
        if(!($('#customer_id').length && $('#customer_id').val().length)||!($('#product_id').length && $('#product_id').val().length))
        {
            if(!($('#customer_id').length && $('#customer_id').val().length))
                toastr.error("Please Select a Customer");
            if(!($('#product_id').length && $('#product_id').val().length))
                toastr.error("Please Select a Product");
            return false;
        }
        else
            form.submit();
    });





})(window, document, jQuery);
