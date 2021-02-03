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
                // $("#course").trigger("contentChanged");
            break;  
        }
    });
}

const attachCourseTypeListener = () => {
    $(document).on('change', '#course', function() {
       let course = {};

       course.courseId = $('#course').val();
       course.name = $('#search').val();

       $.when(ajax.fetchWithData('/sip/pre-internship-table/get-users', course)).done(function(response) {
        
            switch(response.status) {
            
                case HttpStatus.SUCCESS:
                    populatePagination(response.data, '#pre-intern-pagination');

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
    $.each(students, function (indexInArray, student) {
        $('#table-body').append($('<tr/>').addClass('text-center').attr('id', `tr-id-${student.id}`)
            .append($('<td/>').html(`${student.student_number}`))
            .append($('<td/>').html(`${student.user.first_name} ${student.user.last_name}`))
            .append($('<td/>').html(`${student.course.name}`))
            .append($('<td/>').append(
                    $('<button/>').attr('onclick', `location.href='/sip/pre-student-view/${student.id}'`).addClass('btn btn-primary').html('View Student')
                )
            )
        );
    });
}