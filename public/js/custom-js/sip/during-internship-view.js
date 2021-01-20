$(document).ready(function(){
    attachListenerCompleteBtn();
});

const attachListenerCompleteBtn=()=> {
    $(document).on("click", "#complete-btn",function(e) {
        e.preventDefault();
        $id = $(this).data('id');
        $.when(ajax.fetch('/sip/complete-during-internship/approved/' +  $id)).done(function(response) {
            switch(response.status) {
           
                case HttpStatus.SUCCESS:
                    alert('Student is now completed.');
                    redirect('/sip/during-internship' ,1000);
                break;  
            }
        });
    });
}


