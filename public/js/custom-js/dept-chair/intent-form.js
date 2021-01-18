$(document).ready(function(){
    attachListenerAcceptBtn();
});

const attachListenerAcceptBtn=()=> {


    $(document).on("click", "#accept-btn",function(e) {
        e.preventDefault();
        // console.log($(this).data('id'));
        let sample = {};
        $id = $(this).data('id');
        $.when(ajax.fetch('/dept-chair/intent-form/approved/' +  $id, sample)).done(function(response) {
            switch(response.status) {
           
                case HttpStatus.SUCCESS:
                    alert('Student is been approved.');
                    redirect('/dept-chair/intent-form' ,1000);
                break;  
            }
        });
    });
}
