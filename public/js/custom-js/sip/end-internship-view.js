$(document).ready(function(){
    attachListenerCompleteBtn();
    attachListenerApprovedBtn();
    attachListenerSaveBtn();
    attachListenerDeclineBtn();
});

const attachListenerCompleteBtn=()=> {
    $(document).on("click", "#complete-btn",function(e) {
        e.preventDefault();
        $id = $(this).data('id');
        $.when(ajax.fetch('/sip/complete-end-internship/approved/' +  $id)).done(function(response) {
            switch(response.status) {
           
                case HttpStatus.SUCCESS:
                    alert('Student is now completed.');
                    redirect('/sip/end-internship-table' ,1000);
                break;  
            }
        });
    });
}


const attachListenerDeclineBtn=()=> {
    $(document).on("click", ".decline-listener",function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $('#data-id').val(id);
        $('#status').val(4);
    });
}

const attachListenerApprovedBtn=()=> {
    $(document).on("click", ".approve-listener",function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $('#data-id').val(id);
        $('#status').val(2);
    });
}

const attachListenerSaveBtn=()=> {
    $(document).on("click", "#btn-save",function(e) {
        let info = {};
        info.status =  $('#status').val();
        info.studentId =  $('#id').val();
        info.dataId  = $('#data-id').val();
        info.remarks  = $('#remarks').val();

        $.when(ajax.create('/sip/end-internship/approve-file/', info)).done(function(response) {
            console.log(info.status);
            switch(response.status) {
            
                case HttpStatus.SUCCESS:
                    if (info.status == 2) {
                        alert('Student file have been accepted.');
                    } else {
                        alert('Student file have been Declined.');
                    }
                    
                    redirect('/sip/end-student-view/' + info.studentId ,1000);
                break;  
            }
        });
    });
}
