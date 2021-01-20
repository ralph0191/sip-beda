$(document).ready(function(){
    attachListenerIntentFormBtn();
});

const attachListenerIntentFormBtn=()=> {
    
    $(document).on("click", "#intent-form-btn",function(e) {
        e.preventDefault();
        uiBlockerLoader();
        $.when(ajax.fetch('/student/intent-form/approved')).done(function(response) {
            switch(response.status) {
           
                case HttpStatus.SUCCESS:
                    $.unblockUI();
                    alert('Please Wait until the dept chair approved the form.');
                    redirect('/home',1000);
                break;  
            }
        });
    });
}
