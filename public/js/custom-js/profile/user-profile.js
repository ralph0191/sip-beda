$(function() {
    attachListenerSubmitBtn();
    attachListenerProfilePicture();
    attachListenerChangePasswordBtn();
    attachListenerSubmitPhotoBtn();
});

const attachListenerSubmitBtn=()=> {
    $("#submit").click(function (e) { 
        // e.preventDefault();
        uiBlockerLoader();
        updateUser();
    });
}

const attachListenerSubmitPhotoBtn=()=> {
    $("#submit-picture").click(function (e) { 
        // e.preventDefault();
        uiBlockerLoader();
        updateUserPhoto();
    });
}


const attachListenerChangePasswordBtn=()=> {
    $('body').on('click', '#change-pass-btn' ,function (e) { 
        // e.preventDefault();
        uiBlockerLoader();
        updateUserPassword();
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

const updateUser = () => {
    const user = {};

    user.firstName = $('#first_name').val();
    user.middleName = $('#middle_name').val();
    user.lastName = $('#last_name').val();
    user.email = $('#email').val();
    user.mobileNumber = $('#mobile_number').val();
    user.address = $('#address').val();

    if (validate(user)) {
        $.when(ajax.updateNoId('/profile/update', user)).done(function(response) {
            switch(response.status) {
                case HttpStatus.SUCCESS:
                   alert('Successfully Updated.');
                   $.unblockUI();
                   redirect('/profile/form-profile' ,1000);
                   break;
                case HttpStatus.UNPROCESSABLE_ENTITY:
                    $.unblockUI();
                    let errorMessage = "";
                    $.each(response.errors, function (indexInArray, error) {
                        errorMessage += `${error[0]} \n`
                    });
                    alert(errorMessage);
                    break;
            }
        });
    } else {
        alert('Please fill up all Required details.')
        $.unblockUI();
    }
}

const updateUserPassword = () => {
    const user = {};

    user.oldPassword = $('#old-password').val();
    user.newPassword = $('#password').val();
    user.confirmPassowrd = $('#confirm-password').val();

    if (validatePassword()) {
        $.when(ajax.updateNoId('/profile/change-password', user)).done(function(response) {
            switch(response.status) {
                case HttpStatus.SUCCESS:
                    alert('Successfully Updated.');
                    $.unblockUI();
                    redirect('/profile/form-profile' ,1000);
                    break;
                case HttpStatus.UNPROCESSABLE_ENTITY:
                    $.unblockUI();
                    alert(response.error);
                    break;
            }
        });
    } else {
        alert('New Password and confirm Password does not match');
        $.unblockUI();
    }
}

const updateUserPhoto = () => {

    const file = {};
    let formData = new FormData();
    var fileLength = $("#file").get(0).files.length;

    if (fileLength == 0) {
        alert('File is empty.');
        $.unblockUI();
    } else {
        formData.append('file', $('#file')[0].files[0]);
        $.when(ajax.createWithFile('/profile/change-picture', formData)).done(function(response) {
            switch(response.status) {
                case HttpStatus.SUCCESS:
                    alert('Successfully Updated.');
                    $.unblockUI();
                    redirect('/profile/form-profile' ,1000);
                    break;
                case HttpStatus.UNPROCESSABLE_ENTITY:
                    $.unblockUI();
                    alert(response.error);
                    break;
            }
        });
    }

    // if (validatePassword()) {
        
    // } else {
    //     alert('New Password and confirm Password does not match');
    //     $.unblockUI();
    // }
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


function validatePassword() {
    var letters = /^[A-Za-z]+$/;
    var validation = true;
    
    if (!$('#old-password').val()) {
        validation = false;
    }
    
    if (!$('#password').val()) {
        validation = false;
    }

    if (!$('#confirm-password').val()) {
        validation = false;
    }

    if ($('#password').val() != $('#confirm-password').val()) {
        validation = false;
    }

    return validation;
}