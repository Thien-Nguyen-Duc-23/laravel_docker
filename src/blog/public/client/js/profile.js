function profile(id, urlRoute) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = new FormData();
    formData.append("avatar",  $("#upload-img")[0].files[0]);
    formData.append("id", id);
    formData.append("full_name", $('#user_full_name').val());
    formData.append("user_address", $('#user_address').val());
    formData.append("user_phone", $('#user_phone').val());
    formData.append("user_gender", $('#user_gender').val());
    formData.append("user_dob", $('#user_dob').val());
    $.ajax({
        url: urlRoute,
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
            $('#alert-profile-success').empty();
            $('#alert-profile-fail').hide();
            $('#alert-profile-success').show();
            $('#alert-profile-success').append('<li>update success</li>');
            elmnt = document.getElementById("alert-profile-success");
            elmnt.scrollIntoView();
        },
        error: function (data){
            $('#alert-profile-fail').empty();
            $.each(data.responseJSON.errors, function(key, value){
                $('#alert-profile-fail').show();
                $('#alert-profile-fail').append('<li>'+value+'</li>');
            });
            elmnt = document.getElementById("alert-profile-fail");
            elmnt.scrollIntoView();
        }
    });
}

function changePassword(id, urlRouteChange)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData = new FormData();
    formData.append("id", id);
    formData.append("old_password", $('#current_password').val());
    formData.append("password", $('#new_password').val());
    formData.append("password_confirmation", $('#confirm_password').val());

    $.ajax({
        url: urlRouteChange,
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: 'json',
        success: function(data){
            console.log(data);
            $('#change-password')[0].reset();
            if(typeof data['error'] != "undefined" && typeof data['error'] !== null) {
                $('#alert-password-success').hide();
                $('#alert-password-fail').empty();
                $('#alert-password-fail').show();
                $('#alert-password-fail').append('<li>'+data['error']+'</li>');

                elmnt = document.getElementById("alert-password-fail");
                elmnt.scrollIntoView();
            } else {
                $('#alert-password-success').empty();
                $('#alert-password-fail').hide();
                $('#alert-password-success').show();
                $('#alert-password-success').append('<li>'+data['success']+'</li>');

                elmnt = document.getElementById("alert-password-success");
                elmnt.scrollIntoView();
            }
        },
        error: function (data){
            $('#alert-password-success').hide();
            $('#alert-password-fail').empty();
            $.each(data.responseJSON.errors, function(key, value){
                $('#alert-password-fail').show();
                $('#alert-password-fail').append('<li>'+value+'</li>');
            });
            elmnt = document.getElementById("alert-password-fail");
            elmnt.scrollIntoView();
            $('#change-password')[0].reset();
        }
    });
}
