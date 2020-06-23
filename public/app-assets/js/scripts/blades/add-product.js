// Wizard tabs with icons setup
$(".add-doctors-tab").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Vertical tabs form wizard setup
$(".vertical-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    stepsOrientation: "vertical",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Validate steps wizard

// Show form
var form = $(".steps-validation").show();

$(".steps-validation").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }
        // Forbid next action on "Warning" step if the user is too young
        if (newIndex === 3 && Number($("#age-2").val()) < 18) {
            return false;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        if($("#seller" ).val()==0) {
            $('#steps-uid-0-t-0').click();
            toastr.error('Please Select a Seller');
        }
        else
         form.submit();
    }
});

// Initialize validation
$(".steps-validation").validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'danger',
    successClass: 'success',
    highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    rules: {
        email: {
            email: true
        }
    }
});

(function(window, document, $) {
// Tagging support
    $("#color").select2({
        dropdownAutoWidth: true,
        width: '100%',
        tags: true
    });

    $("#size").select2({
        dropdownAutoWidth: true,
        width: '100%',
        tags: true
    });

    function iconFormat(icon) {
        var originalOption = icon.element;
        if (!icon.id) { return icon.text; }
        var $icon = "<i class='la la-" + $(icon.element).data('icon') + "'></i>" + icon.text;

        return $icon;
    }

    // Select With Icon
    $(".select2-icons").select2({
        dropdownAutoWidth: true,
        width: '100%',
        minimumResultsForSearch: Infinity,
        templateResult: iconFormat,
        templateSelection: iconFormat,
        escapeMarkup: function(es) { return es; }
    });


    /********************************************
     *               Multiple Files              *
     ********************************************/
    Dropzone.options.dpzMultipleFiles = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 0.5, // MB
        clickable: true
    }




})(window, document, jQuery);
