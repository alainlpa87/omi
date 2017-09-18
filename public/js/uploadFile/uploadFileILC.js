// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "uploadFileILC", // Set the url
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
    //increment the count of files for the nda emailed
    countFiles+=1;

    //adding more data
    formData.append('PROJECT', getCurrentProject());
    formData.append('CONSULTANT', $('#spanUser').data('id'));
    if(command == 'ndaFile'){
        formData.append('COMMAND', 'ndaFile');
        formData.append('ILC', getCurrentIlc());
        formData.append('ACTION',$('#closeUploadFile').attr('action'));
        formData.append('MANUFACTURER',$('#closeUploadFile').attr('manufacturer'));
    }else if(command == 'patentStatus'){
        formData.append('COMMAND', 'patentStatus');
        formData.append('VALUE',$('#closeUploadFile').attr('patentStatus'));
        formData.append('ILC', getCurrentIlc());
    }
    else
        formData.append('COMMAND', 'common');
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
    if(command == 'patentStatus'){
        if($('#patentStatusSelect').val() != '0'){
            var value =$('#patentStatusSelect').val();
            var newCell = '<span id="ilc_patentStatus_'+currentIlc.id+'" style="cursor: pointer;color: blue;" class="selPStatus" data-iid="'+currentIlc.id+'" data-pid="'+currentProject.id+'" data-val="'+value+'">'+value+'</span>';
        }else
            var newCell = '<span id="ilc_patentStatus_'+currentIlc.id+'" style="cursor: pointer;color: blue;" class="selPStatus" data-iid="'+currentIlc.id+'" data-pid="'+currentProject.id+'" data-val="">Select Patent Status</span>';

        var table = $('#tableDataIlc').DataTable();
        var info = table.page.info();
        $('#tableDataIlc').dataTable().fnUpdate( newCell, $('tr#rowIlc_'+currentIlc.id)[0], 4 );
        table.page(info.page).draw( false );
    }
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
