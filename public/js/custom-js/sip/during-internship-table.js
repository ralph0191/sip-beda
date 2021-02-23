$(document).ready(function(){
    initCoursesDropDown();
    attachCourseTypeListener();
    attachNameListener();
});


const initCoursesDropDown=()=> {
    $.when(ajax.fetch('/courses')).done(function(response) {
        
        switch(response.status) {
           
            case HttpStatus.SUCCESS:
                let courses = response.course;
                for (i = 0; i < courses.length; i++) {
                    $("#course").append($("<option/>").attr("value", courses[i].id).html(courses[i].name));
                }
            break;  
        }
    });
}

const attachCourseTypeListener = () => {
    $(document).on('change', '#course', function() {
        let filters = {};

        filters.courseId = $('#course').val();
        filters.name = $('#search').val();
        var internshipType = $('#internship-type').val();
        var url = "";

        if (internshipType == Status.PRE_INTERN) {
            url = "/sip/pre-internship-table/get-users";
        } else if (internshipType == Status.DURING_INTERN) {
            url = "/sip/during-internship-table/get-users";
        } else if (internshipType == Status.END_INTERN) {
            url = "/sip/end-internship-table/get-users";
        } else if (internshipType == Status.COMPLETED_INTERN) {
            url ="/sip/complete-internship-table/get-users";
        }
        $.when(ajax.fetchWithData(url, filters)).done(function(response) {
        
            switch(response.status) {
            
                case HttpStatus.SUCCESS:
                    populatePagination(response.data, '#table-pagination');
                    

                break;  
            }
        });
    });
    
    $('#course').change();
}

const attachNameListener = () => {
    $('body').on('keyup', '#search', function() {
       $('#course').change();
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

const populateTable = (students) => {

    
    var internshipType = $('#internship-type').val();
    var url = "";

    if (internshipType == Status.PRE_INTERN) {
        url = "/sip/pre-student-view/";
    } else if (internshipType == Status.DURING_INTERN) {
        url = "/sip/during-student-view/";
    } else if (internshipType == Status.END_INTERN) {
        url = "/sip/end-student-view/";
    } else if (internshipType == Status.COMPLETED_INTERN) {
        url ="/sip/complete-student-view/";
    }

    $.each(students, function (indexInArray, student) {
        $('#table-body').append($('<tr/>').addClass('text-center').attr('id', `tr-id-${student.id}`)
            .append($('<td/>').html(`${student.student_number}`))
            .append($('<td/>').html(`${student.user.first_name} ${student.user.last_name}`))
            .append($('<td/>').html(`${student.course.name}`))
            .append($('<td/>').append(
                    $('<button/>').attr('onclick', `location.href='${url + student.id}'`).addClass('btn btn-primary').html('View Student')
                )
            )
        );
    });
}