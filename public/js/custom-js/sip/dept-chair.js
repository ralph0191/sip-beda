$(function() {
    attachListenerUploadBtn();
    ajaxfetchUser();
});

const attachListenerUploadBtn=()=> {
    $("#upload").click(function (e) { 
        // e.preventDefault();
        uiBlockerLoader();
        ajaxUploadFile();
    });
}

const ajaxUploadFile = () => {
    let file =  $('#file')[0].files[0];
    let form_data = new FormData();
    form_data.append('file', file);

    $.when(ajax.createWithFile('/sip/dept-chairs/batch/import', form_data)).done(function(response) {
        console.log(response.status);
        switch(response.status) {
           
            case HttpStatus.SUCCESS:
                $.unblockUI();
                populatePagination(response.data, '#dept-pagination');
                
                break;
            case HttpStatus.HTTP_NOT_ACCEPTABLE:
                $.unblockUI();
                alert(response.msg);
                // alertify.error(response.msg);
                break;
            case HttpStatus.HTTP_CONFLICT:
                $.unblockUI();
                alert(response.msg);
                // alertify.error(response.msg);
                break;
        }
        $('#upload').val(null);
    });
}


const populatePagination = (data, dom) => {
    $(dom).pagination({
        dataSource: data,
        className: 'paginationjs-theme-blue',
        pageSize: 10,
        callback: function(data, pagination) {
            $('#table-body').empty();
            populateTable(data);
        }
    });
}

const populateTable = (users) => {
    $.each(users, function (indexInArray, user) {
        $('#table-body').append($('<tr/>').addClass('text-center').attr('id', `tr-id-${user.id}`)
        .append($('<td/>').attr('scope', 'col').html(`${user.dept_chair.employee_number}`))
        .append($('<td/>').attr('scope', 'col').html(`${user.first_name} ${user.last_name}`))
        .append($('<td/>').attr('scope', 'col').html(`${user.dept_chair.course.name}`))
        );
    });
}

const ajaxfetchUser = () => {
    console.log('asdasd');
    $.when(ajax.fetch('/sip/dept-chairs/paginate')).done(function(response) {
        switch(response.status) {
            case HttpStatus.SUCCESS:
                // $("#tr-id-" + deleteObj.selectedUser).remove();
                populatePagination(response.data, '#dept-pagination');
            break;
        }
    });
}