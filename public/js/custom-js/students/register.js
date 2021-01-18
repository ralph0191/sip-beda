$(document).ready(function(){
    initCoursesDropDown();
});

const initCoursesDropDown=()=> {
    console.log(HttpStatus.SUCCESS);
    $.when(ajax.fetch('/courses')).done(function(response) {
        
        switch(response.status) {
           
            case HttpStatus.SUCCESS:
                let courses = response.course;
                for (i = 0; i < courses.length; i++) {
                    console.log(courses[i]);
                    $("#course").append($("<option/>").attr("value", courses[i].id).html(courses[i].name));
                }
                $("#course").trigger("contentChanged");
            break;  
        }
    });
}
