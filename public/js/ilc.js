var currentProject,currentRequest,currentIlc,command,countFiles;
var selectedFiles, unselectedFiles;
$(document).ready(function(e){
    setInterval("loadNewILC()", 60000);
    setInterval("mailsys()", 60000);
    $('.pickDate').datepicker({});
    currentProject = {id:-1};
    currentRequest = {id:-1};
    currentIlc = {id:-1};
    isOnChange = -1;
    selectedFiles = [];
    unselectedFiles = [];
    command ='';
    table = $('#tableDataIlc').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            //'print'
        ]
    } );

    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    portletEvents();
    var pending = $('#pending_ilc').data('pending');
    if(pending == '1')
        open('pendingIlc', 'alerta', 'width=700, height=460, left=300, top=200, location=no, directories=no, menubar=no, status=no, toolbar=no, scroolbar=no ');
});


//validate email
function validateEmail(email){
    if(email != ''){
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }else{
        return false;
    }
}

//Return the id of the current project.
function getCurrentProject(){
    return currentProject.id;
}
//Return the id of the current ilc
function getCurrentIlc(){
    return currentIlc.id;
}
//search for the unloaded ilcs
function loadNewILC(){
    ajaxCallback('','loadProjectsILC','paintNewILC');
}
//Paint new projects inside container-leads
function paintNewILC(projects)
{
    for(var i=0;i<projects.length;i++)
    {

        var html ='<tr class="rd" id="rowIlc_'+projects[i][0]+'" style=" background-color: aquamarine;">' +
            '<td align="center">' +
            '<input type="checkbox" class="selectIlc pull-left" id="selectIlc_'+projects[i][0]+'" data-id="'+projects[i][0]+'">' +
            '</td>' +
            '<td align="center">' +
            '<span id="ilc_FileNo_'+projects[i][0]+'"><span data-id="'+projects[i][0]+'" data-pid="'+projects[i][1]+'" class="openIlcPortlet" style="text-decoration: underline;color: #0000CC;cursor: pointer;">'+projects[i][3]+'</span></span>' +
            '</td>' +
            '<td align="center">' +
            '<span id="ilc_clientName_'+projects[i][0]+'">'+projects[0][4]+'</span>' +
            '</td>' +
            '<td align="center">' +
            '<span id="ilc_coordinator_'+projects[i][0]+'">'+projects[i][5]+'</span>' +
            '</td>' +
            '<td align="center">' +
            '<span id="ilc_patentStatus_'+projects[i][0]+'">'+projects[i][6]+'</span>' +
            '</td>' +
            '<td align="center">' +
            '<span id="ilc_ideaName_'+projects[i][0]+'">'+projects[i][7]+'</span>' +
            '</td>' +
            '<td align="center">' +
            '<span id="ilc_PPAType_'+projects[i][0]+'">'+projects[i][8]+'</span>' +
            '</td>' +
            '<td align="center">' +
            '<span id="indType_'+projects[i][0]+'">'+
            projects[i][9] +
            '</span>' +
            '</td>' +
            '</tr>';
        $('#tableDataBodyIlc').prepend(html);
    }
    if(projects.length>0)
    {
        //toastr.info('You have new projects.',"Important!!!");
        document.title="You have new ilc!";
        alert("You have new ilc!");
    }
}

$(document).on('click','.openIlcPortlet', function(){
    var iid = $(this).data('id');
    $('#loadingModal').addClass('show in');
    $('#loadingModal').removeClass('fade in');
    ajaxCallback({'ID':iid},'loadProjectPortlet','loadProjectBack')
});

function loadProjectBack(result){
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    $('#ilc-portlet-container').html(result);
    $('#ilcPortletModal').modal('toggle');
}

function portletEvents()
{
    //set the current project as selected
    $(document).on('click','.portlet',function(e){

        if(currentRequest.id!=$(this).data('request-id') || currentProject.id == '-1')
        {
            currentProject = {
                id:$(this).data('id')
            };
            currentRequest= {
                id:$(this).data('request-id')
            };

            currentIlc = {
                id:$(this).data('iid')
            };

            $('.portlet-selected').removeClass('portlet-selected');
            $(this).addClass('portlet-selected');
            $('.pickDate').datepicker({});
        }
    });



    //print business profile
    //$(document).on('click','.printBusiness',function(e){
    //    var id = $(this).data('id');
    //    $("#iframePrint").attr('src', "printBusinessProfileAdmin?ID="+id);
    //});


    //print project
    $(document).on('click','.printProjectILC',function(e){
        $('#ilcPortletModal').modal('hide');
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printProjectAdmin?ID="+id);
    });

    //Load all accessible files for a project
    $(document).on('click','.openFilesILC',function(e){
        $('#ilcPortletModal').modal('hide');
        var id = $(this).data('id');
        var iid = $(this).data('iid');
        command = 'common';
        $('#sendFilesToVendorBtn').addClass('hidden');
        ajaxCallback({'ID':id,'IID':iid},'loadFilesILC','paintFoundFiles');
    });


    //show the uploadFiles modal.
    $(document).on('click','.uploadFilesILC',function(e){
        if(currentProject.id == -1){
            swal({title: "You must click in the project!",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
        }else{
            $('#ilcPortletModal').modal('hide');
            myDropzone.removeAllFiles(true);
            command = 'common';
            $('#uploadFileModal').modal('show');
        }
    });

}


$(document).on('hidden.bs.modal','#filesModalILC',function(){
    if(command == 'common')
        $('#ilcPortletModal').modal('show');
    else if(command == 'submission'){
        $('#subEmailModal').modal('show');
        if(selectedFiles.length >0)
            ajaxCallback({'FILES':selectedFiles},'getFiles','backGetFiles');
    }else if(command == 'nda'){
        $('#ndaTextModal').modal('show');
        if(selectedFiles.length >0)
            ajaxCallback({'FILES':selectedFiles},'getFiles','backGetFiles');
    }
});
//paint the files selected for send in the submission email
function backGetFiles(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.','Error');
    else{
        var html ='';
        for(var i=0; i< result.length;i ++){
            html+='<div id="attachmeCont_'+result[i].id+'" class="col-md-8"><p class="pull-left">'+result[i].fileName+'</p> <i class="fa fa-remove rmvFromSelectedF" style="color: red;cursor: pointer;"  data-fid="'+result[i].id+'"></i></div>';
        }
        if(command == 'submission')
            $('#attachments-container-sub').html(html);
        else if(command == 'nda')
            $('#attachments-container').html(html);
    }
}

$(document).on('click','.rmvFromSelectedF',function(){
    var fid =$(this).data('fid');
    var index = selectedFiles.indexOf(fid);
    if(index>-1){
        selectedFiles.splice(index,1);
        $('#attachmeCont_'+fid).remove();
    }
});

$(document).on('click','#sendSubmission',function(){
    var email = $('#emailSubm').val();
    var text =  $('#textSubmission').val();
    var manfName = $('#selectManfSub option:selected').text();
    if(!validateEmail(email)){
        toastr.error("Email field is empty or incorrect format for email provided", "You had forgotten something!");
        $('#emailSubm').css('border-color','red');
    }else if(text == ''){
        toastr.error("Email text is empty.", "You had forgotten something!");
        $('#textSubmission').css('border-color','red');
    }else{
        var replace = text.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br/><br/>');
        var bcc = $('#bccSubmission').val();
        ajaxCallback({'FILES':selectedFiles,'EMAIL':email,'BCC':bcc,'TEXT':replace,'PID':currentProject.id,'IID':currentIlc.id,'MANF':manfName},'sendIlcSubEmail','submissionEmailBack')
    }
});

function submissionEmailBack(result){
    if(result == -1)
        toastr.error('An error has happened,please try later.','Error');
    else{
        toastr.success('Submission Email sent!!','Success');
        $('#subEmailModal').modal('hide');
    }
}

//Show a modal with all the files
function paintFoundFiles(result){
    var htmlFiles = '';
    if(result[0].length>0)
    {
        htmlFiles = '<div class="fileHeader"><span class="col-md-6 col-md-push-1">Files</span><span class="col-md-3 col-md-push-1">Date</span></div>';
        $.each(result[0],function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFile col-md-1 pull-left' data-fid='"+file.id+"'>"+
            "<input type='button' class='deleteFile btn btn-primary col-md-1 pull-right' value='delete' data-id='"+file.id+"'>" +
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.fileName+"'>" +
            "<span class='col-md-6'><strong>"+file.name+"</strong></span>" +
            "<span class='col-md-3'><strong>"+file.created+"</strong></span>"+
            "</div>";
        });
        $('.container-founds').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });

        $('.deleteFile').click(function(e){
            var fileId = $(this).data("id");
            ajaxCallback({'FILE':fileId},'deleteFiles','deleteFilesCallback');
        });
        if(result[1] == 1){
            $('#sendFilesBackBtn').removeClass('hidden');
            paintFilesBackToVendor(result[0]);
        }
        else
            $('#sendFilesBackBtn').addClass('hidden');

        $('#sendFilesToVendorBtn').data('existIlcV',result[1]);
        selectedFiles=[];
        $('#filesModalILC').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

//Show a modal with all the files
function paintFoundFilesSub(result){
    var htmlFiles = '';
    if(result[0].length>0)
    {
        htmlFiles = '<div class="fileHeader"><span class="col-md-6">Files</span><span class="col-md-3">Date</span></div>';
        $.each(result[0],function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='selectFileSub pull-left' data-fid='"+file.id+"'>"+
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.fileName+"'>" +
            "<span class='col-md-6'><strong>"+file.name+"</strong></span>" +
            "<span class='col-md-3'><strong>"+file.created+"</strong></span>"+
            "</div>";
        });
        $('.container-founds').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });
        if(command=='submission')
            $('#subEmailModal').modal('hide');
        else if(command == 'nda')
            $('#ndaTextModal').modal('hide');
        $('#filesModalILC').modal('show');
    }
    else {
        if(command=='submission')
            toastr.error('This ilc doesn\'t have files',"No Files");
        else if(command == 'nda')
            toastr.error('The manf selected doesn\'t have files',"No Files");
    }
}

$(document).on('click','#sendFilesBackBtn', function () {
    command = 'backToVendor';
    unselectedFiles=[];
    $('#filesModalILC').modal('hide');
    $('#filesBackToVendorModal').modal('show');
});

function paintFilesBackToVendor(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div><div class="col-md-3" style="background-color: antiquewhite;"><b>Text</b></div><div style="background-color: antiquewhite;"><textarea rows="4" cols="80" id="backToVendorText"></textarea></div></div><div class="fileHeader" style="margin-top: 20px;"><span class="col-md-6 col-md-push-1"><b>Files</b></span><span class="col-md-3 col-md-push-1"><b>Date</b></span></div>';
        $.each(files,function( key,file )
        {
            if(file.ilcVendors == 0)
                var checkFile ="<input type='checkbox' class='checkFile col-md-1 pull-left' data-fid='"+file.id+"'>";
            else
                var checkFile ="<input type='checkbox' class='uncheckFile col-md-1 pull-left' data-fid='"+file.id+"' checked='checked'>";
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +checkFile+
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.fileName+"'>" +
            "<span class='col-md-6'><strong>"+file.name+"</strong></span>" +
            "<span class='col-md-3'><strong>"+file.created+"</strong></span>"+
            "</div>";
        });
        $('#filesBackContainer').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });
    }
}

$(document).on('click','.selectFileSub',function(){
    if($(this).prop('checked')){
        selectedFiles.push($(this).data('fid'));
    }else{
        var index = selectedFiles.indexOf($(this).data('fid'));
        if(index>-1)
            selectedFiles.splice(index,1);
    }
});

$(document).on('click','.checkFile',function(){
    var existV = $('#sendFilesToVendorBtn').data('existIlcV');
    if($(this).prop('checked')){
        selectedFiles.push($(this).data('fid'));
        if(existV == 0)
            $('#sendFilesToVendorBtn').removeClass('hidden');
    }else{
        var index = selectedFiles.indexOf($(this).data('fid'));
        if(index > -1){
            selectedFiles.splice(index,1);
            if(selectedFiles.length == 0)
                $('#sendFilesToVendorBtn').addClass('hidden');
        }
    }
});

//delete file from the modal
function deleteFilesCallback(id){
    if(id != "-1"){
        $("#fileFound_"+id).fadeOut(600, function(){
            $(this).remove();
        });
    }else{
        toastr.error('We can\'t delete this file now.',"Error");
    }
}

$(document).on('click','#submitbtnIlcCodes',function(){
    if(currentProject.id == -1){
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }else{
        var title1 = $('#title1').val();
        var title2 = $('#title2').val();
        var description1 = $('#description1').val();
        var description2 = $('#description2').val();
        var desc11 = [];
        $('.description11').each(function(){
            if($(this).val()!='')
                desc11.push($(this).val());
        });
        var desc22 = [];
        $('.description22').each(function(){
            if($(this).val()!='')
                desc22.push($(this).val());
        });
        if($.trim(title1) == ''){
            toastr.error("2016 SIC DESCRIPTION TITLE IS EMPTY.", "You had forgotten something!");
        }else if($.trim(title2) == ''){
            toastr.error("2016 NAICS DESCRIPTION TITLE IS EMPTY.", "You had forgotten something!");
        }else if($.trim(description1) == ''){
            toastr.error("2016 SIC DESCRIPTION IS EMPTY.", "You had forgotten something!");
        }else if($.trim(description2) == ''){
            toastr.error("2016 NAICS DESCRIPTION IS EMPTY.", "You had forgotten something!");
        }else{
            ajaxCallback({'ID':currentProject.id,'TITLE1':title1,'DESC1':description1,'DESC11':desc11, 'TITLE2':title2,'DESC2':description2,'DESC22':desc22,'IID':currentIlc.id},'sendIntroPackage','sendILCCodesBack');
        }
    }
});

function sendILCCodesBack(result){
    if(result == -1){
        toastr.error('An error has happened, please try later','Error');
    }else if(result == 2){
        swal({title: "The ILC Agreement wasn't signed online, please send it in a separate email.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
    else{
        toastr.success('SIC & NAICS CODES SEND','Success');
    }
    $('#ilcCodesModal').modal('hide');
}


// to clear the modal
$(document).on('hidden.bs.modal','#ilcCodesModal',function(){
    $(this).find("input,textarea,select").val('').end();
});

$(document).on('click','#addDesc11',function(){
    var newDesc = '<div class="desc11">' +
        '<div class="col-md-offset-2 col-md-1">' +
        '<label class="control-label">&bull;</label>' +
        '</div>' +
        '<div class="col-md-8">' +
        '<textarea rows="1" class="form-control description11"></textarea>' +
        '</div></div>';
    $('#desc11-container').append(newDesc);
});

$(document).on('click','#removeDesc11',function(){
    var newDesc =$(".desc11").last().remove();
});

$(document).on('click','#addDesc22',function(){
    var newDesc = '<div class="desc22">' +
        '<div class="col-md-offset-2 col-md-1">' +
        '<label class="control-label">&bull;</label>' +
        '</div>' +
        '<div class="col-md-8">' +
        '<textarea rows="1" class="form-control description22"></textarea>' +
        '</div></div>';
    $('#desc22-container').append(newDesc);
});

$(document).on('click','#removeDesc22',function(){
    var newDesc =$(".desc22").last().remove();
});

$(document).on('change','#selectOptionILC',function(){
    var type = $(this).val();
    if(currentProject.id == -1 && type!='courtesy'){
        $('#selectOptionILC').val(0);
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
    else{
        switch (type){
            case 'intro_pkg':
                $('#selectOptionILC').val(0);
                var newDesc = '<div class="desc11">' +
                    '<div class="col-md-offset-2 col-md-1">' +
                    '<label class="control-label">&bull;</label>' +
                    '</div>' +
                    '<div class="col-md-8">' +
                    '<textarea rows="1" class="form-control description11"></textarea>' +
                    '</div></div>';
                $('#desc11-container').html(newDesc);
                var newDesc = '<div class="desc22">' +
                    '<div class="col-md-offset-2 col-md-1">' +
                    '<label class="control-label">&bull;</label>' +
                    '</div>' +
                    '<div class="col-md-8">' +
                    '<textarea rows="1" class="form-control description22"></textarea>' +
                    '</div></div>';
                $('#desc22-container').html(newDesc);
                $('#ilcCodesModal').modal('show');
                break;
            case 'courtesy':
                $('#selectOptionILC').val(0);
                $('#courtesyModal').modal('show');
                break;
            case 'nda_to_manf':
                $('#selectOptionILC').val(0);
                $('#titleNdaModal').html('ILC NDA TO MANF');
                $('#attachFile').addClass('hidden');
                $('#labelAttach').addClass('hidden');
                $('#attachments-container').addClass('hidden');
                $('#attachments-container').html('');
                $('#emailNDA').val('');
                $('#sendNda').data('action','to_manf');
                $('#emailNDA').val('');
                var text ="Hi,\r\nThank you for your interest.\r\nTo better clarify, ILC is a licensing consultant company that is in possession of patented or patent-pending innovations. Our goal is to introduce you to an innovation that will encourage your company to retain licensing rights, as the first step to enabling production, distribution and selling of the product to an awaiting consumer base.\r\nTo begin sharing those innovations with you, I have attached our NDA. ILC’s NDA does not obligate you to definitively license one of our products; however, after signing it we will be able to expedite the research and development on innovations specifically to your interest in confidentiality. Should you have any questions about the language of this contract, do not hesitate to ask for clarification.\r\nIf by chance, your company possesses their own Non-Disclosure Agreement, please submit this to me so that we can discuss the conditions of that NDA with our client directly.";
                $('#textContent').val(text);
                ajaxCallback({'IID':currentIlc.id},'loadManufacturersFromClient','backFromLoadManf');
                break;
            case 'nda_to_client':
                $('#selectOptionILC').val(0);
                if(currentIlc.id != -1){
                    var email = $('#ilc_email_'+currentIlc.id).text();
                    $('#emailNDA').val(email);
                }
                $('#attachFile').removeClass('hidden');
                $('#labelAttach').removeClass('hidden');
                $('#attachments-container').removeClass('hidden');
                $('#attachments-container').html('');
                $('#titleNdaModal').html('MANF NDA TO CT');
                $('#sendNda').data('action','to_client');
                $('#textContent').val('');
                selectedFiles=[];
                countFiles=0;
                ajaxCallback({'IID':currentIlc.id},'loadManufacturersFromClient','backFromLoadManf');
                break;
            case 'submission':
                $('#selectOptionILC').val(0);
                //$('#textSubmission').val('');
                selectedFiles=[];
                ajaxCallback({'PID':currentProject.id,'IID':currentIlc.id},'loadSubInfo','backFromLoadSub');
                break;
            case 'decline_email':
                $('#selectOptionILC').val(0);
                ajaxCallback({'IID':currentIlc.id},'loadManufacturersFromClient','backFromLoadManufacturer');
                break;
            case 'intro_call_email':
                $('#selectOptionILC').val(0);
                showIntroCallModal();
                break;
            case 'after_graphic':
                $('#selectOptionILC').val(0);
                var date = $('#afterGraphicDate').val('');
                $('#afterGraphicModal').modal('show');
                break;
            case 'patented_contract':
                $('#selectOptionILC').val(0);
                showPatentedContractModal();
                break;
            default:
                break;
        }
    }
});

function backFromLoadManufacturer(result){
    if(result == -1){
        toastr.error("An error has happened, please try later", "Error");
    }else{
        if(result.length>0)
        {
            html = '<option value="0">Select Manufacturer</option>';
            $.each(result,function( key,manufacturer ){
                html +='<option value="'+manufacturer.email+'" data-mid="'+manufacturer.id+'">'+manufacturer.name+'</option>';
            });
            $('#selectManufacturerToDecline').html(html);
        }
        $('#selectManufacturerToDecline').val(0);
        $('#emailDecline').val('');
        $('#textDecline').val('');
        $('#declineEmailModal').modal('show');

    }
}

function backFromLoadManf(result){
    if(result == -1){
        toastr.error("An error has happened, please try later", "Error");
    }else{
        if(result.length>0)
        {
            html = '<option value="0">Select Manufacturer</option>';
            $.each(result,function( key,manufacturer ){
                html +='<option value="'+manufacturer.email+'" data-mid="'+manufacturer.id+'">'+manufacturer.name+'</option>';
            });
            $('#selectNdaToManf').html(html);
        }
        $('#selectNdaToManf').val(0);
        $('#ndaTextModal').modal('show');
    }
}

$(document).on('change','#selectNdaToManf',function(){
    var toCLient =$('#sendNda').data('action');
    if($(this).val() != '0' && toCLient != 'to_client')
        $('#emailNDA').val($(this).val());
    else if($(this).val() == '0' && toCLient != 'to_client')
        $('#emailNDA').val('')
});

$(document).on('change','#selectManufacturerToDecline',function(){
    if($(this).val() != '0')
        $('#emailDecline').val($(this).val());
    else
        $('#emailDecline').val('');
});

$(document).on('change','#selectManfSub',function(){
    if($(this).val() != '0')
        $('#emailSubm').val($(this).val());
    else
        $('#emailSubm').val('');
});

$(document).on('click','#sendDecline',function(){
    var selected = $('#selectManufacturerToDecline').find('option:selected');
    var mid = selected.data('mid');
    var email = $('#emailDecline').val();
    var text = $('#textDecline').val();
    if(currentProject.id == -1){
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }else if(!validateEmail(email)){
        toastr.error("Email field is empty or incorrect format for email provided", "You had forgotten something!");
        $('#chooseType').css('border-color','red');
    }else if(text == ''){
        toastr.error("Email text is empty.", "You had forgotten something!");
        $('#textSubmission').css('border-color','red');
    }else{
        var replace = text.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br/><br/>');
        ajaxCallback({'PID':currentProject.id,'IID':currentIlc.id,'MID':mid,'EMAIL':email,'TEXT':replace},'sendDeclineEmailToManf','sendDeclineBack');
    }
});

function sendDeclineBack(result){
    if(result == -1)
        toastr.error("An error has happened, please try later", "Error");
    else{
        var note =  '<div class="noteLink col-md-12" id="divNote_'+result.id+'">'+
            '<i title="Edit" class="fa fa-pencil-square-o col-md-1 editNotesIlc" data-id="'+result.id+'" aria-hidden="true"></i>'+
            '<p id="pNote_'+result.id+'" title="'+result.notes+'" class="col-md-6">'+(result.notes.length>45?result.notes.substring(0,40)+'...':result.notes)+'</p>'+
            '<p class="col-md-4">Today</p>'+
            '<i title="Delete" class="fa fa-times col-md-1 deleteNotesIlc" data-id="'+result.id+'" aria-hidden="true"></i>'+
            '</div>';
        $('#insideCollapseNotes_'+result.ilc_id).prepend(note);
        $('#declineEmailModal').modal('hide');
        toastr.success("Decline Email Sent!!", "Success");
    }

}

function backFromLoadSub(result){
    var texbody = 'Greetings,\r\n'+
        'International Licensing Consultants (ILC) proudly represents, '+result[0]+', and we kindly request you accept the following documents in order to initiate a review of his/her patent-pending product,  '+result[1]+'.  Within this package you will find:\r\n'+
        '1. Talicor, Inc.- Confidential Disclosure Agreement – signed by client, '+result[0]+'\r\n'+
        '2. A general product description and inventor profile – provided by ILC \r\n'+
        '3. A University Market Analysis – research and development findings related to the '+result[1]+'\r\n'+
        '4. 2D graphic prototype of the '+result[1]+'\r\n'+
        '5. Prototype available upon request \r\n'+
        'Should you require additional information, please do not hesitate to reach out to us directly. ILC will do our best to accommodate your requests as you consider the opportunities in licensing this innovation.\r\n' +
        'Here’s to Great Opportunities,\r\n';
    $('#textSubmission').val(texbody);
    $('#attachments-container-sub').html('');
    if(result[2].length>0)
    {
        html = '<option value="0">Select Manufacturer</option>';
        $.each(result[2],function( key,manufacturer ){
            html +='<option value="'+manufacturer.email+'" data-mid="'+manufacturer.id+'">'+manufacturer.name+'</option>';
        });
        $('#selectManfSub').html(html);
    }
    $('#selectManfSub').val(0);
    $('#emailSubm').val('');
    $('#subEmailModal').modal('show');
}

//add attachment to nda email
$(document).on('click','.attachFile',function(){
    if(currentProject.id == -1){
        $('#selectOptionILC').val(0);
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
    else{
        command = 'nda';
        var selected = $('#selectNdaToManf').find('option:selected');
        var mid = selected.data('mid');
        ajaxCallback({'MID':mid},'loadFilesManufacturer','paintFoundFilesSub');
    }
});

//add attachment to submission email
$(document).on('click','.attachFileSub',function(){
    command = 'submission';
    //search the files available for ilc
    ajaxCallback({'ID':currentProject.id},'loadFilesILC','paintFoundFilesSub');
});


$(document).on('click','.removeAttachment',function(){
    var fid = $(this).data('fid');
    ajaxCallback({'FID':fid},'removeAttachment','backRemoveAttch');
});

function backRemoveAttch(result){
    if(result == -1)
        toastr.error("An error has happened, please try later", "Error!");
    else{
        countFiles--;
        $('#attachmeCont_'+result).remove();
    }
}

$(document).on('hidden.bs.modal','#uploadFileModal',function(){
    if(command == 'emailCT'){
        ajaxCallback({'COUNT':countFiles, 'PROJECTID':currentProject.id},'getAttachments', 'backFromAttachILC');
    }else if(command == 'patentStatus'){
        if(!$('#selectIlc_'+currentIlc.id).prop('checked')){
            currentIlc.id = -1;
            currentProject.id = -1;
        }
    }else if(command != 'ndaFile')
        $('#ilcPortletModal').modal('show');
    command = '';
});

function backFromAttachILC(result){
    if(result != 0){
        var html ='';
        for(var i=0; i< result.length;i ++){
            html+='<div id="attachmeCont_'+result[i].id+'" class="col-md-8"><p class="pull-left">'+result[i].fileName+'</p> <i class="fa fa-remove removeAttachment" style="color: red;cursor: pointer;"  data-fid="'+result[i].id+'"></i></div>';
        }
        $('#attachments-container-emIlc').html(html);
    }
    $('#emailILCModal').modal('show');
    command = '';
}

//delete notes
$(document).on('click','.deleteNotesIlc',function(e){
    var id=$(this).data('id');
    $("#divNote_"+id).fadeOut(600, function(){
        $(this).remove();
    });
    ajaxCall({'ID': id}, 'ilcDeleteNotes', 'Note Deleted', 'An error has happened!');
});

//add Notes modal.
$(document).on('click','.addNotesIlc',function(e){
    $('#noteIlc').val('');
    //$('#submitbtnIlcNotes').attr('data-id',"0");
    $('#submitbtnIlcNotes').data('id',"0");
    var iid = $(this).data('iid');
    $('#submitbtnIlcNotes').data('iid',iid);
    $('#ilcPortletModal').modal('hide');
    $('#ilcNotesModal').modal('show');
});

//edit Notes modal.
$(document).on('click','.editNotesIlc',function(e){
    var id=$(this).data('id');
    var system = $(this).data('system');
    var note = $("#pNote_"+id).attr("title");
    $('#submitbtnIlcNotes').data('id',id);
    $('#submitbtnIlcNotes').data('iid','-1');
    $('#noteIlc').val(note);
    if(system == 1) {
        $('#submitbtnIlcNotes').prop('disabled', true);
        $('#noteIlc').prop('disabled', true);
    }
    $('#ilcPortletModal').modal('toggle');
    $('#ilcNotesModal').modal('show');
});

//edit Notes modal.
$(document).on('click','#submitbtnIlcNotes',function(e){
    var id=$(this).data('id');
    var iid=$(this).data('iid');
    var note = $('#noteIlc').val();
    ajaxCallback({'IID': iid,'ID': id,'VALUE': note}, 'ilcSaveNotes', 'callBackILCSaveNotes');
});

function callBackILCSaveNotes(result){

    if($('#divNote_'+result.id).length == 0){
        var note =  '<div class="noteLink col-md-12" id="divNote_'+result.id+'">'+
            '<i title="Edit" class="fa fa-pencil-square-o col-md-1 editNotesIlc" data-id="'+result.id+'" aria-hidden="true"></i>'+
            '<p id="pNote_'+result.id+'" title="'+result.notes+'" class="col-md-6">'+(result.notes.length>45?result.notes.substring(0,40)+'...':result.notes)+'</p>'+
            '<p class="col-md-4">Today</p>'+
            '<i title="Delete" class="fa fa-times col-md-1 deleteNotesIlc" data-id="'+result.id+'" aria-hidden="true"></i>'+
            '</div>';
        $('#insideCollapseNotes_'+result.ilc_id).prepend(note);
    }else{
        $('#pNote_'+result.id).attr('title',result.notes);
        $('#pNote_'+result.id).html(result.notes.length>45?result.notes.substring(0,40)+'...':result.notes);
    }
    $('#ilcNotesModal').modal('hide');
    $('#ilcPortletModal').modal('toggle');
}

$(document).on('click','#sendNda',function(){
    var email = $('#emailNDA').val();
    var text =  $('#textContent').val();
    if(!validateEmail(email)){
        toastr.error("Email field is empty or incorrect format for email provided", "You had forgotten something!");
        $('#emailNDA').css('border-color','red');
    }else if(text == ''){
        toastr.error("Email text is empty.", "You had forgotten something!");
        $('#textContent').css('border-color','red');
    }else{
        var replace = text.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br/><br/>');
        var action =$(this).data('action');
        if(action == 'to_manf')
            ajaxCall({'EMAIL':email,'TEXT': replace, 'IID':currentIlc.id},'ilcNDATextEmail','NDA Email sent.','An error has happened, please try later.');
        else if (action == 'to_client') {
            var selected = $('#selectNdaToManf').find('option:selected');
            var mid = selected.data('mid');
            ajaxCall({
                'EMAIL': email,
                'TEXT': replace,
                'IID': currentIlc.id,
                'FILES': selectedFiles,
                'MID':mid
            }, 'ilcNDAToClient', 'NDA Email To Client Sent.', 'An error has happened, please try later.');
        }
    }

});


$(document).on('hidden.bs.modal','#ilcNotesModal',function(){
    $('#ilcPortletModal').modal('show');
});

$(document).on('hidden.bs.modal','#ilcPortletModal',function(){
    if(command == ''){
        $('.selectIlc').each(function (index, value){
            $(this).prop('checked',false);
        });
        currentProject.id = -1;
        currentIlc.id = -1;
    }
});

//select one project
$(document).on('click','.selectIlc',function(){
    var pid =$(this).data('id');
    var iid = $(this).data('iid');
    if($(this).is(':checked')){
        currentProject.id=pid;
        currentIlc.id = iid;
    }else{
        currentProject.id=-1;
        currentIlc.id = -1;
    }
    $('.selectIlc').each(function (index, value){
        if($(this).data('id')!= pid)
            $(this).prop('checked',false);
    });
});

$(document).on('change','.industrySelected',function(){
    var ind_id =$(this).val();
    var ilc_id = $(this).data('iid');
    ajaxCallback({'IND_ID':ind_id,'ILC_ID':ilc_id},'saveIndustryILC','backSaveIndustry');
});

function backSaveIndustry(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.');
    else{
        var iid = result[0];
        var html ='<option value="-1" selected>Select Manufacturer</option>';
        for(var i=0; i< result[1].length;i++){
            var option ='<option value="'+result[1][i].id+'">'+result[1][i].name+'</option>';
            html+= option;
        }

        $('#manufacturerSelect_'+iid).html(html);
        $('#manufacturersIlc_'+iid).empty();

        var newCell = '<span>'+result[2]+'</span>';

        //var indType = '<span>'+result[2]+'</span>'
        //$('#indType_'+iid).html(indType);
        var table = $('#tableDataIlc').DataTable();
        var info = table.page.info();
        $('#tableDataIlc').dataTable().fnUpdate( newCell, $('tr#rowIlc_'+currentIlc.id)[0], 7 );
        table.page(info.page).draw( false );
        toastr.success('Industry changed!!!!');
    }
}

$(document).on('click','#addManufacturer',function(){
    var iid = $(this).data('iid');
    var mid = $('#manufacturerSelect_'+iid).val();
    if(mid == -1)
        swal({title: "You must select one manufacturer to add!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    else{
        if(! $("#manufacturersIlc_"+iid+" option[value='"+mid+"']").length > 0)
            ajaxCallback({'MID':mid,'IID':iid},'addManufacturer','backAddManufacturer');
    }

});

function backAddManufacturer(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.');
    else{
        var iid = result[0];
        var option = '<option value="'+result[1].id+'">'+result[1].name+'</option>';
        $('#manufacturersIlc_'+iid).append(option);
        var manufacturerToGrid ='<span >'+result[1].name+'</span>';
        $('#manufacturersList_'+iid).append(manufacturerToGrid);
        toastr.success('Manufacturer added!!!!');
    }
}

$(document).on('click','#removeManufacturer',function(){
    var iid = $(this).data('iid');
    var mid = $('#manufacturersIlc_'+iid).val();
    if(mid == null)
        swal({title: "You must select one manufacturer to remove!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    else{
        ajaxCallback({'MID':mid,'IID':iid},'removeManufacturer','backRemoveManufacturer');
    }
});

function backRemoveManufacturer(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.');
    else{
        $('#manufacturersIlc_'+result[0]+' option[value='+result[1]+']').remove();
        toastr.success('Manufacturer removed!!!!');
    }
}

//change the industry and the manufacturer link to that industry
$(document).on('change','.industrySelectedCourtesy',function(){
    var ind_id =$(this).val();
    var ilc_id = $(this).data('iid');
    ajaxCallback({'IND_ID':ind_id,'ILC_ID':ilc_id},'getManufacturersIndustry','backCourtesyIndustry');
});

function backCourtesyIndustry(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.');
    else{
        var html ='<option value="-1" selected>Select Manufacturer</option>';
        for(var i=0; i< result.length;i++){
            var option ='<option value="'+result[i].id+'">'+result[i].name+'</option>';
            html+= option;
        }

        $('#manufacturerSelectCourtesy').html(html);
        $('#manufacturersCourtesy').empty();
    }
}

$(document).on('click','#addManufacturerCourtesy',function(){
    var mid = $('#manufacturerSelectCourtesy').val();
    var mName = $('#manufacturerSelectCourtesy option:selected').text();
    if(mid == -1)
        swal({title: "You must select one manufacturer to add!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    else{
        var option = '<option value="'+mid+'">'+mName+'</option>';
        if(! $("#manufacturersCourtesy option[value='"+mid+"']").length > 0)
            $('#manufacturersCourtesy').append(option);
    }

});

$(document).on('click','#removeManufacturerCourtesy',function(){
    var mid = $('#manufacturersCourtesy').val();
    if(mid == null)
        swal({title: "You must select one manufacturer to remove!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    else{
        $('#manufacturersCourtesy option[value='+mid+']').remove();
    }
});

$(document).on('click','#sendCourtesy',function(){
    var list = '';
    $("#manufacturersCourtesy option").each(function()
    {
        list+= $(this).text()+',';
    });
    var industry = $('#industrySelectedCourtesy').val();
    ajaxCall({'INDUSTRY':industry,'MANUFACTURERS':list},'sendCourtesyEmail','Courtesy Update Email sent.','An error has happened, please try later.');
});

// to clear the modal
$(document).on('hidden.bs.modal','#courtesyModal',function(){
    var html ='<option value="-1" selected>Select Manufacturer</option>';
    $('#manufacturerSelectCourtesy').html(html);
    $("#industrySelectedCourtesy").val('-1');
    $('#manufacturersCourtesy').empty();
});

//open modal of nda actions
$(document).on('click','#openNDAAction',function(){
    if(currentIlc.id == -1){
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
    else{
        ajaxCallback({'IID':currentIlc.id},'loadManufacturersFromClient','openNdaBack');
    }
});

function openNdaBack(result){
    if(result == -1){
        toastr.error("An error has happened, please try later", "Error");
    }else{
        if(result.length>0)
        {
            html = '<option value="0">Select Manufacturer</option>';
            $.each(result,function( key,manufacturer ){
                html +='<option value="'+manufacturer.id+'">'+manufacturer.name+'</option>';
            });
            $('#manufacturersForActionSelect').html(html);
            $('#manufacturersForActionSelect').val(0);
            $('#ndaActionsSelect').val(0);
            $('#ndaActionsModal').modal('show');
        }else
            swal({title: "This project don't have any manufacturers!",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
    }
}

$(document).on('click','#uploadNDAFile',function(){
    if($('#ndaActionsSelect').val() == 0 || $('#manufacturersForActionSelect').val() == 0){
        swal({title: "You must select one action and one manufacturer!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }else{
        command = 'ndaFile';
        var action = $('#ndaActionsSelect').val();
        var manufacturer = $('#manufacturersForActionSelect').val();
        $('#closeUploadFile').attr('action',action);
        $('#closeUploadFile').attr('manufacturer',manufacturer);
        $('#ndaActionsModal').modal('hide');
        myDropzone.removeAllFiles(true);
        $('#uploadFileModal').modal('show');
    }
});

//store the info of the client to identify changes
$(document).on('focusin','.clientDetailsInput',function(e){
    $(this).css('background-color','antiquewhite');
    currentProject.info = $(this).val();
});

//save client info
$(document).on('focusout','.clientDetailsInput',function(e){
    var iid = $(this).data('iid');
    var field = $(this).data('field');
    var info =  $(this).val();
    if(info!=currentProject.info)
        ajaxCallback( {'IID':iid,'FIELD':field,'INFO':info},'updateClientDetailsILC','updateCtInfoBack');
    $(this).css('background-color','white');
    currentProject.info="";
});

//store the info of the client to identify changes
$(document).on('focusin','.editWebsiteCodes',function(e){
    $(this).css('background-color','antiquewhite');
    currentProject.info = $(this).val();
});

//save client info
$(document).on('focusout','.editWebsiteCodes',function(e){
    var iid = $(this).data('iid');
    var field = $(this).data('field');
    var info =  $(this).val();
    if(info!=currentProject.info)
        ajaxCall( {'IID':iid,'FIELD':field,'INFO':info},'updateWebsiteInfo',"Updated successfully.","We couldn't update the info, please try later");
    $(this).css('background-color','white');
    currentProject.info="";
});

function updateCtInfoBack(result){
    if(result == '-1')
        toastr.error("We couldn't update the info, please try later",'Error');
    else{
        if(result[0]=='invFname' || result[0]=='invLname'){
            //$('#ilc_clientName_'+currentIlc.id).html(result[1]);
            var table = $('#tableDataIlc').DataTable();
            var info = table.page.info();
            var newCell = '<span id="ilc_clientName_'+currentIlc.id+'">'+result[1]+'</span>';
            $('#tableDataIlc').dataTable().fnUpdate( newCell, $('tr#rowIlc_'+currentIlc.id)[0], 2);
            table.page(info.page).draw( false );
        }
        toastr.success('Updated successfully.','Success');
    }
}

$(document).on('click','.attachFileEmILC', function () {
    command='emailCT';
    countFiles =0;
    myDropzone.removeAllFiles(true);
    $('#emailILCModal').modal('hide');
    $('#uploadFileModal').modal('show');
});

$(document).on('click','#sendEmILC',function(){
    var text =  $('#emailILCText').val();
    var pid = currentProject.id;
    if(text == ''){
        toastr.error("Email text is empty.", "You had forgotten something!");
        $('#emailILCText').css('border-color','red');
    }else{
        if(countFiles == null)
            countFiles =0;
        ajaxCall({'TEXT':text, 'PID':pid,'IID':currentIlc.id,'COUNT':countFiles},'responseFromILCToClients','Email Sent.','An error has happened, please try later.');
        $('#emailILCModal').modal('hide');
    }
});

$(document).on('click','#emToCTBtn', function () {
    if(currentProject.id == -1)
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    else{
        $('#emailILCText').val('');
        $('#attachments-container-emIlc').html('');
        countFiles=0;
        $('#emailILCModal').modal('show');
    }
});

$(document).on('click','.checkIntroCall', function (){
    var col = $(this).data('prop');
    var check =-1;
    if( $(this).prop('checked'))
        check = 1;
    ajaxCallback({'IID':currentIlc.id,'COL':col,'CHECK':check},'checkDates','checkDatesBack');
})

function checkDatesBack(result){
    if(result == '-1')
        toastr.error('An error has happened, please try later.');
    else if(result == 'introCallDate'){
        if( $('#introCallCheck_'+currentIlc.id).prop('checked')){
            var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
            $('#introCallDate_'+currentIlc.id).prop('disabled', false);
        }else{
            var fullDate = '';
            $('#introCallDate_'+currentIlc.id).prop('disabled', true);
        }
        $('#introCallDate_'+currentIlc.id).val(fullDate);
    }else if(result == 'website_codes'){
        if( $('#websiteCodesCheck_'+currentIlc.id).prop('checked')){
            var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
            $('#websiteCodesDate_'+currentIlc.id).prop('disabled', false);
        }else{
            var fullDate = '';
            $('#websiteCodesDate_'+currentIlc.id).prop('disabled', true);
        }
        $('#websiteCodesDate_'+currentIlc.id).val(fullDate);
    }
}

var isOnChange;
$(document).on('focus','.editDate',function(e){
    isOnChange = 1;
});

//edit the sent date of intro call and website code
$(document).on('changeDate','.editDate',function(e){
    if(currentIlc.id != '-1'){
        var date=$(this).val();
        var col=$(this).data('prop');
        if(isOnChange == 1){
            isOnChange = -1;
            ajaxCall({
                'IID': currentIlc.id,
                'DATE': date,
                'COL': col
            }, 'changeDates', 'Date changed!', 'An error has happened!');
        }
    }
});

$(document).on('click','.selCoord', function () {
    currentIlc.id = $(this).data('iid');
    var value = $(this).data('val');
    if(value == '')
        $('#coordinatorSelect').val(0);
    else
        $('#coordinatorSelect').val(value);
    $('#coordinatorModal').modal('show');
});

//select coordinator
$(document).on('change','#coordinatorSelect',function(){
    var value = $(this).val();
    ajaxCallback({'IID':currentIlc.id,'VALUE':value},'selectCoordinator','selectCoordBack')
});

function selectCoordBack(result){
    if(result == '-1')
        toastr.error('An error has happened, please try later.','Error');
    else{
        if($('#coordinatorSelect').val() != '0'){
            var value =$('#coordinatorSelect').val();
            var newCell = '<span id="ilc_coordinator_'+currentIlc.id+'" style="cursor: pointer;color: blue;" class="selCoord" data-iid="'+currentIlc.id+'" data-val="'+value+'">'+value+'</span>';

        }else
            var newCell = '<span id="ilc_coordinator_'+currentIlc.id+'" style="cursor: pointer;color: blue;" class="selCoord" data-iid="'+currentIlc.id+'" data-val="">-</span>';

        var table = $('#tableDataIlc').DataTable();
        var info = table.page.info();
        $('#tableDataIlc').dataTable().fnUpdate( newCell, $('tr#rowIlc_'+currentIlc.id)[0], 3 );
        table.page(info.page).draw( false );
        toastr.success('Assigned coordinator changed!!','Success');
    }
}

$(document).on('hidden.bs.modal','#coordinatorModal,#patentStatusSelect',function(){
    if(!$('#selectIlc_'+currentIlc.id).prop('checked'))
        currentIlc.id = -1;

});

$(document).on('click','.selPStatus', function () {
    currentIlc.id = $(this).data('iid');
    currentProject.id = $(this).data('pid');
    var value = $(this).data('val');
    if(value == '')
        $('#patentStatusSelect').val(0);
    else
        $('#patentStatusSelect').val(value);
    $('#patentStatusModal').modal('show');
});

//select patent status
$(document).on('click','#uploadPatentStatus',function(){
    command = 'patentStatus';
    var value = $('#patentStatusSelect').val();
    $('#closeUploadFile').attr('patentStatus',value);
    $('#patentStatusModal').modal('hide');
    myDropzone.removeAllFiles(true);
    $('#uploadFileModal').modal('show');
});

$(document).on('hidden.bs.modal','#patentStatusModal',function(){
    if(command =='' && !$('#selectIlc_'+currentIlc.id).prop('checked')){
        currentIlc.id = -1;
        currentProject.id = -1;
    }
});

//show the pending intro calls for the day
$(document).on('click','#showPendingIntroCall', function () {
    var pending = $('#pending_ilc').data('pending');
    if(pending == '1')
        open('pendingIlc', 'alerta', 'width=700, height=460, left=300, top=200, location=no, directories=no, menubar=no, status=no, toolbar=no, scroolbar=no ');
    else
        toastr.error('There are no pending intro calls for today.','Error');
});

//send the upgrade regarding the ilc webpage after graphic was sent
$(document).on('click','#sendAfterGraphic', function () {
    var date = $('#afterGraphicDate').val();
    ajaxCall({'DATE':date,'PID':currentProject.id,'IID':currentIlc.id},'sendUpdateRegardingILCWeb','The upgrade regarding the ILC webpage was sent!!','An error has happened, please try later.');
    $('#afterGraphicModal').modal('hide');
});

function showIntroCallModal(){
    html="<p>Hello,</p>" +
    "<p>Please review below to further support your Welcome Package content: </p>" +
    "<ol>" +
    "<li style='text-align: justify;'>" +
    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>We are an independent corporation from Patent Services (PSU)</u>. ILC focus is in the marketing of your invention and solely the process of marketing and/or licensing potentials. So moving forward all questions or concerns related to the USPTO or the patent attorney should continue to be addressed by PSU. ILC can only answer questions related to industry feedback. Lastly, for confidentiality reasons ILC does not share any marketing information with PSU." +
    "</li>" +
    "<br>" +
    "<li style='text-align: justify;'>" +
    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All services you will be receiving from ILC are done on a 100% contingency basis, meaning <u>ILC does not receive any money until the invention is actually licensed</u> (which is all stated in the contract).The ultimate goal is to get your invention licensed to a manufacturer. If your product is licensed to a manufacturer, royalties will be split 90% to you and 10% to ILC." +
    "</li>" +
    "<br>" +
    "<li style='text-align: justify;'>" +
    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We will soon be sending out your project to a graphic design team where a computerized prototype will be created. The computerized prototype is a graphical illustration that is used to show manufacturers what your product is and how it works. Please be aware that the computerized prototype will be created strictly by what is in your original patent application and will portray the basic functionality of the idea. <u>Any end designs and/or packaging will be determined between you and the manufacturer if it is licensed</u>.  While the computerized prototype is being created, ILC will be working on the webpage.  After the webpage is completed, you will receive a username and password, by e-mail, to log on and see your web page. Please allow up to 90 days for the completion of the webpage and the computerized prototype, due to the planning and editing involved.  During this time, our team will be discussing potential industries and companies that will be targeted." +
    "</li>" +
    "<br>" +
    "<li style='text-align: justify;'>" +
    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please note the Inventor Resource Guide is only for you to keep as a " +
    "reference. You are not required to reach out to manf. for ILC will be conducting marketing on your " +
    "behalf, however, if you choose to be proactive and research leads independent from us, please use the " +
    "Inventor Resource Guide as a step-by-step instruction pamphlet and please use the SIC and NAICS codes " +
    "as a way to filter out which manf. are best to contact. In addition, just keep us informed of any leads " +
    "or developments, as we will be doing the same." +
    "</li>" +
    "<br>" +
    "<li style='text-align: justify;'>" +
    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With respect to tradeshows please note that we attend 6-8, at minimum, " +
    "per year.  At tradeshows, our product specialist walks the floors of the show visiting each manufacturers' booth." +
    "The main purpose of these tradeshows is to collect manufacturer contact information and generate interest for our " +
    "clients' projects through conversation.  After the tradeshow, these manufacturers are contacted by our office, and " +
    "if they express further interest in <u>YOUR product idea specifically</u>, you will be notified in a timely fashion. " +
    "Absolutely, NO NEGOTIATING or DEALS are done on the trade show floor.  If you have any further questions on tradeshows, " +
    "please refer to the 'TRADE SHOW PROCEDURES' form in your ILC Welcome Packet.  Also, upcoming tradeshow information can be " +
    "found on the ILC website: <a href='http://successwithilc.com/TradeShow.aspx'>http://successwithilc.com/TradeShow.aspx</a>" +
    "</li>" +
    "<br>" +
    "<li style='text-align: justify;'>" +
    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lastly, please be aware that this process is very unpredictable, and it can take some" +
    "time since we will be working around the manufacturers' schedule, mostly depending on when they will be available to speak " +
    "to us regarding your product.  When we receive any updates on your invention (manufacturer feedback, mailings, or submissions), " +
    "we will contact you in a timely fashion either by phone or email.  With this in mind, please note that ILC <u>updates will not be " +
    "weekly, but more than likely on a monthly basis</u>." +
    "</li>" +
    "</ol>" +
    "<p style='text-align: justify;'>This is a great deal of information to take in but please review carefully along with our welcome packet to familiarize yourself with ILC services.</p>";
    $('#textIntroCall').html(html);
    $('#introCallEmailModal').modal('show');
}

$(document).on('click','#sendIntroCallEmail', function () {
    var text = $('#textIntroCall').html();
    ajaxCall({'PID':currentProject.id ,'IID':currentIlc.id,'TEXT':text},'sendIntroCallILC','Intro Call Email sent!','An error has happened, please try later.');
    $('#introCallEmailModal').modal('hide');
});

$(document).on('change','#selectSeparationLetter',function(){
    var type = $(this).val();
    if(currentProject.id == -1){
        $('#selectSeparationLetter').val(0);
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
    else{
        switch (type){
            case 'abandoned':
                $('#selectSeparationLetter').val(0);
                ajaxCall({'PID':currentProject.id,'IID':currentIlc.id},'sendSeparationAbandoned','The separation letter was sent!','An error has happened, please try later');
                break;
            case 'client_request':
                $('#selectSeparationLetter').val(0);
                ajaxCall({'PID':currentProject.id,'IID':currentIlc.id},'sendSeparationClientRequest','The separation letter was sent!','An error has happened, please try later');
                break;
            case 'provisional':
                $('#selectSeparationLetter').val(0);
                ajaxCall({'PID':currentProject.id,'IID':currentIlc.id},'sendSeparationProv','The separation letter was sent!','An error has happened, please try later');
                break;
            case 'utility':
                $('#selectSeparationLetter').val(0);
                ajaxCall({'PID':currentProject.id,'IID':currentIlc.id},'sendSeparationUtility','The separation letter was sent!','An error has happened, please try later');
                break;
            default:
                break;
        }
    }
});

function showPatentedContractModal(){
    if(currentIlc.id == -1 ||  currentProject.id == -1)
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    else {
        text = "Hello,\r\n" +
        "I have attached the ILC contract for your review. Please, read, sign and return back to ILC, by email, fax or parcel mail.\r\n" +
        "Once, the contract is signed, by all parties ILC will activate your account.\r\n";
        $('#textPatentedContract').val(text);
        $('#patentedContractEmailModal').modal('show');
    }
}

$(document).on('click','#sendPatentedContractEmail', function () {
    var text = $('#textPatentedContract').val();
    var replace = text.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br/><br/>');
    ajaxCall({'IID':currentIlc.id,'PID':currentProject.id,'TEXT':replace},'sendPatentedContract','ILC Patented Contract Sent!!!','An error has happened, please try later');
    //ajaxCall({'IID':38,'PID':8305,'TEXT':text},'sendPatentedContract','ILC Patented Contract Sent!!!','An error has happened, please try later');
    $('#patentedContractEmailModal').modal('hide');
});

$(document).on('click','.setCallTradeshow',function(){
    var iid = $(this).data('iid');
    if($(this).is(":checked"))
        var value =1;
    else
        var value =0;
    ajaxCall({'IID':iid,'VALUE':value},'setCallTradeshow','The call after trade show was set it!!!','An error has happened, please try later.');
});

$(document).on('click','#sendFilesToVendorBtn', function () {
    command = 'ilcVendor';
    $('#filesModalILC').modal('hide');
    $('#ilcVendorModal').modal('show');
});

$(document).on('click','#sendIlcVendor', function () {
    if(currentIlc.id == -1){
        swal({title: "You must click in the project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }else{
        var vendorId = $('#ilcVendorsSelect').val();
        var designType = $('input[name="designType"]:checked').val();
        var text = $('#ilcVendorText').val();
        if(vendorId == '0')
            toastr.error("You must select a vendor.", "You had forgotten something!");
        else if(designType == null)
            toastr.error("You must select a design type.", "You had forgotten something!");
        else{
            var replace = text.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br/><br/>');
            ajaxCall({'IID':currentIlc.id, 'PID':currentProject.id ,'VID':vendorId,'DESIGNT':designType, 'TEXT':replace,'FILES':selectedFiles},'sendIlcToVendor','ILC sent it to vendor!!','An error has happened, please try later.')
            $('#ilcVendorModal').modal('hide');
        }
    }
});

$(document).on('click','#sendBackToVendor', function () {
    var text = $('#backToVendorText').val();
    if(text == ''){
        toastr.error("Text field is empty.", "You had forgotten something!");
        $('#backToVendorText').css('border-color','red');
    }else{
        ajaxCall({'PID':currentProject.id,'IID':currentIlc.id,'TEXT':text,'SFILES':selectedFiles,'USFILES':unselectedFiles},'sendIlcBackToVendor','The file was sent back!!!','An error has happened, please try later.');
        $('#filesBackToVendorModal').modal('hide');
    }
});

$(document).on('click','.uncheckFile',function(){
    if($(this).prop('checked')){
        var index = unselectedFiles.indexOf($(this).data('fid'));
        if(index > -1)
            unselectedFiles.splice(index,1);
    }else{
        unselectedFiles.push($(this).data('fid'));
    }
});

$(document).on('click','.checkDModelRcvd',function(){
    if($(this).prop('checked')){
        var pid = $(this).data('pid');
        ajaxCall({'PID':pid},'received3D','The 3D(2D) Model was check like received!!!','An error has happened, please try later.');
    }
});
