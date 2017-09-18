// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "../../uploadFileLaunch", // Set the url
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
    //increment the count of files for the email from client
    countFiles+=1;
    //file id
    var projectId = $('#closeUploadFile').attr('projectId');
    //adding more data
    formData.append('PROJECT', projectId);
    formData.append('COMMAND', command);
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    // disable the cancel button
    file.previewElement.querySelector(".cancel").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
    $('#uploadFileModal').modal('hide');
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
