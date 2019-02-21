$(function () {
    $('#sign_in').validate({
        highlight: function (input) {
            // console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
});

$(function () {
    $('#sign_up').validate({
        rules: {
            'name': {
                required: true
            },
            'email': {
                required: true
            },
            'type': {
                required: true
            },
            'password': {
                required: true
            },
            'confirm': {
                equalTo: '[name="password"]'
            }
        },
        highlight: function (input) {
            console.log(input);
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
});

$(function () {
    $('#form_change_password').validate({
        rules: {
            'OldPassword': {
                required: true
            },
            'NewPassword': {
                required: true
            },
            'NewPasswordConfirm': {
                equalTo: '[name="NewPassword"]'
            }
        },
        highlight: function (input) {
            console.log(input);
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
});

$(function () {
    $('#edit_resort').validate({
        rules: {
            'title': {
                required: true
            },
            'contact': {
                required: true
            },
            'location': {
                required: true
            },
            'category': {
                required: true
            },
            'description': {
                required: true
            },
            'amenity': {
                required: true
            },
        },
        highlight: function (input) {
            console.log(input);
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
});

$(function () {
    $('#form_add_resort').validate({
        rules: {
            'title': {
                required: true
            },
            'contact': {
                required: true
            },
            'location': {
                required: true
            },
            'category': {
                required: true
            },
            'description': {
                required: true
            },
            'amenity': {
                required: true
            },
        },
        highlight: function (input) {
            console.log(input);
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
});

// FORM FOR HOTLINE
function formHotline(form) {
    $(form).validate({
        rules: {
            'contact': {
                required: true
            },
            'number': {
                required: true
            }
        },
        highlight: function (input) {
            console.log(input);
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

// FORM FOR EVENT
function formEvent(form) {
    $(form).validate({
        rules: {
            'title': {
                required: true
            },
            'location': {
                required: true
            },
            'date': {
                required: true
            },
            'detail': {
                required: true
            }
        },
        highlight: function (input) {
            console.log(input);
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

// FORM FOR TOURIST
function formTourist(form) {
    $(form).validate({
        rules: {
            'name': {
                required: true
            },
            'category': {
                required: true
            },
            'location': {
                required: true
            }
        },
        highlight: function (input) {
            console.log(input);
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
