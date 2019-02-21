function validateCategory(form) {
    $(form).validate({
        rules: {
            'name': {
                required: true,
            },
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        }
    });
}

function validateEvent(form) {
    $(form).validate({
        rules: {
            'name': {
                required: true,
            },
            'address': {
                required: true,
            },
            'date': {
                required: true,
            },
            'description': {
                required: true,
            },
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        }
    });
}
