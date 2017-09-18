// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);
uploadeddocs=[];

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "uploadFileAttCS", // Set the url
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
    var project = ($('#closeUploadFile').attr('projectId')=="0"?0:getCurrentProject());
    formData.append('PROJECT', project);
    formData.append('CONSULTANT', $('#spanUser').data('id'));
    formData.append('COMMAND',$('.aux-class-att').data('command'));
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    // And disable the cancel button
    file.previewElement.querySelector(".cancel").setAttribute("disabled", "disabled");
    //and save the name of the file
    uploadeddocs.push(file.name);
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
    swal({title: "Files Uploaded.",
            type: "info",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true },
        function(isConfirm){
            if (isConfirm) {
                var project = $('#closeUploadFile').data('aid');
                ajaxCallback({'ID':project,'FILES':uploadeddocs,'COMMAND':$('.aux-class-att').data('command')},'finishAttCS','hideProject');

            }
        }
    );
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
