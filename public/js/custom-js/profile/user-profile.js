$(function() {
    attachListenerSubmitBtn();
    attachListenerProfilePicture();
});

const attachListenerSubmitBtn=()=> {
    $("#submit").click(function (e) { 
        // e.preventDefault();
        uiBlockerLoader();
        ajaxUploadFile();
    });
}

const attachListenerProfilePicture = () => {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
}

const ajaxUploadFile = () => {
    let file =  $('#file')[0].files[0];
    var user = {};
    let formData = new FormData();
    formData.append('file', file);

    user.firstName = $('#first_name').val();
    user.middleName = $('#middle_name').val();
    user.lastName = $('#last_name').val();
    user.email = $('#email').val();
    user.mobileNumber = $('#mobile_number').val();
    user.address = $('#address').val();
    
    // console.log(user.firstName);

    formData.append('user' , JSON.stringify(user));

    if (validate(user)) {
        $.when(ajax.updateNoId('/profile/update', formData)).done(function(response) {
            switch(response.status) {
                case HttpStatus.SUCCESS:
                   alert('Successfully Updated.');
                case HttpStatus.HTTP_CONFLICT:
                    $.unblockUI();
                    // alert(response.msg);
                    // alertify.error(response.msg);
                    break;
            }
        });
    } else {
        alert('Please fill up all Required details.')
        $.unblockUI();
    }
    
}

function validate(user) {
    var letters = /^[A-Za-z]+$/;
    var validation = true;
    
    if (!$('#first_name').val()) {
        return false;
    }
    if (!$('#middle_name').val()) {
        return false;
    }
    if (!$('#last_name').val()) {
        return false;
    }

    if (!$('#email').val()) {
        return false;
    }

    return validation;
}