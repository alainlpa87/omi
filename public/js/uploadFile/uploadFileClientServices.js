// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "uploadFileClientS", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
});

myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
});

myDropzone.on('sending', function(file, xhr, formData){
    //adding more data
    formData.append('PROJECT', getCurrentProject());
    formData.append('CONSULTANT', $('#spanUser').data('id'));
    formData.append('COMMAND',$('#closeUploadFile').attr('command'));
    formData.append('EMAILATT',$('#att_email_'+currentProject.id).text());
    formData.append('ATTID',$('#selectAttorney_'+currentProject.id).val());
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    // And disable the cancel button
    file.previewElement.querySelector(".cancel").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
    var fullDate = new Date();
    var twoDigitMonth = (fullDate.getMonth() >=9)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
    var currentDate = twoDigitMonth + "-" + fullDate.getDate() + "-" + fullDate.getFullYear();
    if($('#closeUploadFile').attr('command')=='PA' || $('#closeUploadFile').attr('command')=='PROV' || $('#closeUploadFile').attr('command')=='DESIGN'){
       if($('#closeUploadFile').attr('command')=='DESIGN'){
           $('#pApplicationSentD_'+getCurrentProject()).prop('checked', true);
           $('#pApplicationDateD_'+getCurrentProject()).val(currentDate);
           $('#pApplicationDateD_'+currentProject.id).removeAttr('disabled');
           $('#poaDecSentD_'+getCurrentProject()).prop('checked',true);
           $('#poaDecDateD_'+getCurrentProject()).val(currentDate);
           $('#poaDecDateD_'+getCurrentProject()).removeAttr('disabled');
       }else{
        $('#pApplicationSent_'+getCurrentProject()).prop('checked', true);
        $('#pApplicationDate_'+getCurrentProject()).val(currentDate);
        $('#pApplicationDate_'+currentProject.id).removeAttr('disabled');
        $('#poaDecSent_'+getCurrentProject()).prop('checked',true);
        $('#poaDecDate_'+getCurrentProject()).val(currentDate);
        $('#poaDecDate_'+getCurrentProject()).removeAttr('disabled');
       }
        ajaxCall({'ID':currentProject.id,'COMMAND':$('#closeUploadFile').attr('command')},'emailPatentApp','The Patent App was sent it!!','An error has happened, please try later.')
        $('#uploadFileModal').modal('hide');
    }else if($('#closeUploadFile').attr('command')=='DtoA'){
        $('#documentSent_'+getCurrentProject()).prop('checked','checked');
        $('#documentSentDate_'+getCurrentProject()).val(currentDate);
        $('#documentSentDate_'+getCurrentProject()).removeAttr('disabled');
        $('#uploadFileModal').modal('hide');
        toastr.success("The attorney cover shield was send it!","Success")
        ('#documentSent_'+currentProject.id).prop('checked',true);
    }
});

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};
/*document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
};*/
