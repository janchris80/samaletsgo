function resortFormValidation(form) {
    $(form).validate({
        rules: {
            'resort_name': {
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

function resortEntranceFormValidation(form) {
    $(form).validate({
        rules: {
            'tour': {
                required: true
            },
            'age_type': {
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

function resortRateFormValidation(form) {
    $(form).validate({
        rules: {
            'description': {
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
}

function resortAmenityFormValidation(form) {
    $(form).validate({
        rules: {
            'description': {
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
}

function resortCottageFormValidation(form) {
    $(form).validate({
        rules: {
            'description': {
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
}

function resortPackageFormValidation(form) {
    $(form).validate({
        rules: {
            'package_name': {
                required: true
            },
            'rate': {
                required: true
            },
            'description': {
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
}

function resortRoomFormValidation(form) {
    $(form).validate({
        rules: {
            'description': {
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
}

function resortCorkageFormValidation(form) {
    $(form).validate({
        rules: {
            'description': {
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
}

function touristFormValidation(form) {
    $(form).validate({
        rules: {
            'tourist_name': {
                required: true
            },
            'location': {
                required: true
            },
            'category': {
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
}

function hotlineFormValidation (form) {
    $(form).validate({
        rules: {
            'contact': {
                required: true
            },
            'number': {
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
}

function eventFormValidation (form) {
    $(form).validate({
        rules: {
            'event_name': {
                required: true
            },
            'location': {
                required: true
            },
            'date': {
                required: true
            },
            'description': {
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
}

function accountFormValidation (form) {
    $(form).validate({
        rules: {
            'first_name': {
                required: true
            },
            'middle_name': {
                required: true
            },
            'last_name': {
                required: true
            },
            'username': {
                required: true
            },
            'email': {
                required: true
            },
            'password': {
                required: true
            },
            'password_confirmation': {
                equalTo: '[name="password"]'
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
}

function locationFormValidation (form) {
    $(form).validate({
        rules: {
            'location_name': {
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
}

function categoryFormValidation (form) {
    event.preventDefault();
    $(form).validate({
        rules: {
            'type': {
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
}
