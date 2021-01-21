$(document).ready(function(){
    attachModalUploadListener();
});

const attachModalUploadListener = () => {
    $('#btn-save').click(function (e) {
        
        // if (validateFile()) {
            // uiBlockerLoader();
            const file_tree_content = {};
            let formData = new FormData();
            var fileLength = $("#file").get(0).files.length;

            for (i = 0; i < fileLength; i++) {
                formData.append('file[]', $('#file')[0].files[i]);
            }
            file_tree_content.internshipRequirementsId = $('#type').val();
            formData.append('fileTreeObj' , JSON.stringify(file_tree_content));
            
            $.when(ajax.createWithFile('/student/pre-internship/attached-file', formData)).done(function(response) {
                switch(response.status) {
           
                    case HttpStatus.SUCCESS:
                        alert('File is sended wait for approved');
                        $('#label-' + file_tree_content.internshipRequirementsId).html('Pending');
                        $('#type').val('');
                        $('#file').empty();
                        $('#addFileModal').hide();
                        $('#addFileModal').modal('hide');
                    break;  
                }
            });
        }
    );
    // });
}