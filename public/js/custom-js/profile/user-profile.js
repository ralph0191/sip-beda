$(function() {
    attachListenerSubmitBtn();
});

const attachListenerSubmitBtn=()=> {
    $("#submit").click(function (e) { 
        // e.preventDefault();
        uiBlockerLoader();
        ajaxUploadFile();
    });
}

const ajaxUploadFile = () => {
    let file =  $('#file')[0].files[0];
    var user = {};
    let formData = new FormData();
    form_data.append('file', file);

    user.firstName = $('#first_name').val();
    user.middleName = $('#middle_name').val();
    user.lastName = $('#last_name').val();
    user.email = $('#email').val();
    user.mobileNumber = $('#mobile_number').val();
    user.address = $('#address').val();

    formData.append('user' , JSON.stringify(user));

    if (validate(user)) {
        $.when(ajax.createWithFile('/profile/update', formData)).done(function(response) {
            switch(response.status) {
                case HttpStatus.SUCCESS:
                   alert('Successfully Updated.');
                case HttpStatus.HTTP_CONFLICT:
                    $.unblockUI();
                    alert(response.msg);
                    // alertify.error(response.msg);
                    break;
            }
        });
    }
    
}

function validate(user) {
    var letters = /^[A-Za-z]+$/;
    var validation = true;
    
    if (!input.value.match(user.firstName)) {
        return false;
    }
    if (!input.value.match(user.middleName)) {
        return false;
    }
    if (!input.value.match(user.lastName)) {
        return false;
    }

    return validation;
}