$(document).ready(function() {
    // attachCourseTypeListener();
    attachNameListener();
});



// const attachCourseTypeListener = () => {
//     $(document).on('change', '#course', function() {
        
//     });
    
//     $('#course').change();
// }

const attachNameListener = () => {
    $('body').on('keyup', '#search', function() {
        let filters = {};
        filters.name = $('#search').val();
        var internshipType = $('#internship-type').val();
        var url = "";

        console.log(internshipType);
        if (internshipType == Status.DURING_INTERN) {
            url = "/dept-chair/during-internship/get-users";
        } else if (internshipType == Status.END_INTERN) {
            url = "/dept-chair/end-internship/get-users";
        } else if (internshipType == Status.COMPLETED_INTERN) {
            url ="/dept-chair/complete-internship/get-users";
        }
        $.when(ajax.fetchWithData(url, filters)).done(function(response) {
        
            switch(response.status) {
            
                case HttpStatus.SUCCESS:
                    populatePagination(response.data, '#table-pagination');
                break;  
            }
        });
    });
    $('#search').keyup();
}

const populatePagination = (data, dom) =>    {
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

const populateTable = (students) => {

    
    var internshipType = $('#internship-type').val();
    var url = "";

    if (internshipType == Status.DURING_INTERN) {
        url = "/dept-chair/during-student-view/";
    } else if (internshipType == Status.END_INTERN) {
        url = "/dept-chair/end-student-view/";
    } else if (internshipType == Status.COMPLETED_INTERN) {
        url ="/dept-chair/complete-student-view/";
    }

    $.each(students, function (indexInArray, student) {
        $('#table-body').append($('<tr/>').addClass('text-center').attr('id', `tr-id-${student.id}`)
            .append($('<td/>').html(`${student.student_number}`))
            .append($('<td/>').html(`${student.user.first_name} ${student.user.last_name}`))
            .append($('<td/>').append(
                    $('<button/>').attr('onclick', `location.href='${url + student.id}'`).addClass('btn btn-primary').html('View Student')
                )
            )
        );
    });
}