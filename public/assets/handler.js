$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    // LoadChart();
});

// logout ajax
$('#logout-button').on('click',function(){
    event.preventDefault();
    swal({
        title: "Are you sure you want to Log out?",
        text: "Click OK to continue!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Goodbye!", {
                    icon: "success",
                }).then(() => {
                    $('#form_logout').submit();
                    // window.location.reload();
                });
            } else {
                swal("Maybe later!");
            }
        });
});

// REGISTER AJAX
$('#register-button').on('click',function(){
    event.preventDefault();
    if ($('#sign_up').valid()) {
        $.ajax({
            url:'/register',
            type:'post',
            data:$('#sign_up').serializeArray(),
            success:function(result, status, xhr){
                if(status === 'success') {
                    swal({
                        title: "Register Successfully",
                        text: 'Redirect to Dashboard',
                        icon: "success",
                    }).then(() => {
                        window.location.reload();
                    });
                }

            },
            error:function(xhr, status, error){
                let msg = xhr.responseJSON.message ? xhr.responseJSON.message : '';
                let email = xhr.responseJSON.errors.email ? xhr.responseJSON.errors.email : '';
                let password = xhr.responseJSON.errors.password ? xhr.responseJSON.errors.password : '';
                swal({
                    title: msg,
                    text: email + '\n' + password,
                    icon: "error"
                });
            }
        });
    }
});

// REGISTER NEW ACCOUNT AJAX
$('#register-new-button').on('click',function(){
    event.preventDefault();
    if ($('#sign_up_new').valid()) {
        $.ajax({
            url: 'account',
            type: 'POST',
            data: $('#sign_up_new').serializeArray(),
            success: function(result, status, xhr){
                if(status === 'success') {
                    swal({
                        title: "Register Successfully",
                        text: 'Redirect to Dashboard',
                        icon: "success",
                    }).then(() => {
                        $('#sign_up_new').submit();
                    });
                }
            },
            error: function(xhr, status, error){
                let msg = xhr.responseJSON.message ? xhr.responseJSON.message : '';
                let email = xhr.responseJSON.errors.email ? xhr.responseJSON.errors.email : '';
                let password = xhr.responseJSON.errors.password ? xhr.responseJSON.errors.password : '';
                swal({
                    title: msg,
                    text: email + '\n' + password,
                    icon: "error"
                });
            }
        });
    }
});

// LOGIN AJAX
$('#login-button').on('click',function(){
    event.preventDefault();
    let form = $('#sign_in');
    if ($(form).valid()) {
        $.ajax({
            url: '/login',
            type: 'post',
            data: $(form).serializeArray(),
            success: function (result, status, xhr) {
                console.log(status);
                if (status === 'success') {
                    swal({
                        title: "Login Successfully",
                        text: 'Redirect to Dashboard',
                        icon: "success",
                    }).then(() => {
                        window.location.reload();
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log('xhr: ',xhr);
                if(error) {
                    swal({
                        title: 'Something Wrong',
                        text: xhr.responseJSON.message,
                        icon: "error"
                    });
                }
                let msg = xhr.responseJSON.message ? xhr.responseJSON.message : '';
                let email = xhr.responseJSON.errors.email ? xhr.responseJSON.errors.email : '';
                let password = xhr.responseJSON.errors.password ? xhr.responseJSON.errors.password : '';
                swal({
                    title: msg,
                    text: email + '\n' + password,
                    icon: "error"
                });
            }
        });
    }
});


