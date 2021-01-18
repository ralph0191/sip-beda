$(document).ready(function(){
    attachListenerCompleteBtn();
});

const attachListenerCompleteBtn=()=> {


    $(document).on("click", "#complete-btn",function(e) {
        e.preventDefault();
        // console.log($(this).data('id'));
        $id = $(this).data('id');
        $.when(ajax.fetch('/sip/complete-pre-internship/approved/' +  $id)).done(function(response) {
            switch(response.status) {
           
                case HttpStatus.SUCCESS:
                    alert('Student is now completed.');
                    redirect('/sip/pre-internship-table' ,1000);
                break;  
            }
        });
    });
}
