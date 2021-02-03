$(document).ready(function(){
    initCoursesDropDown();
});

const initCoursesDropDown=()=> {
    $.when(ajax.fetch('/courses')).done(function(response) {
        
        switch(response.status) {
           
            case HttpStatus.SUCCESS:
                let courses = response.course;
                for (i = 0; i < courses.length; i++) {
                    $("#course").append($("<option/>").attr("value", courses[i].id).html(courses[i].name));
                }
                $("#course").trigger("contentChanged");
            break;  
        }
    });
}
