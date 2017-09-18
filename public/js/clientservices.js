var currentProject;
var filesToMerge;//array to save the order of the files to make a merge
$(document).ready(function(e){
    setInterval("mailsys()", 60000);
    setInterval("loadAppointments()", 60000);
    initializeDateTimePicker();
    currentProject = {id:-1};
    filesToMerge=[];
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    portletEvents();

    $('.pickDate').datepicker({});

    $('select.select').each(function(){
        var title = $(this).attr('title');
        if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
        $(this)
            .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
            .after('<span class="select btn-warning">' + title + '</span>')
            .change(function(){
                val = $('option:selected',this).text();
                $(this).next().text(val);
            })
    });



    ventana = open('pendingPCTEPO', 'alerta', 'width=700, height=460, left=300, top=200, location=no, directories=no, menubar=no, status=no, toolbar=no, scroolbar=no ');

    createLastVisitedBox("");
});



//update the list of las 15 visited
function createLastVisitedBox(newValue)
{
    $('.container-last').html('');
    var lastVisited = localStorage.getItem("lastVisitedLead")?localStorage.getItem("lastVisitedLead").split('-'):[];
    lastVisited = jQuery.grep(lastVisited, function(value) {
        return value != newValue;
    });
    var newLastVisited = "";
    if(newValue>0)
        lastVisited.unshift(newValue);
    for(var i=0;i<Math.min(15,lastVisited.length);i++)
    {
        var fileno =lastVisited[i];
        var pHtml = "<p class='lastProjectVisited' data-id='"+fileno+"'>"+fileno+"</p>";
        newLastVisited += newLastVisited.length>0?"-"+lastVisited[i]:lastVisited[i];
        $('.container-last').append(pHtml);
    }
    localStorage.setItem("lastVisitedLead",newLastVisited);
}
//move to the top the clicked project
$(document).on('click','.lastProjectVisited',function(action){
    var fileno = $(this).data('id');
    ajaxCallback({'PARAMS':fileno},'findProjectClientServices','paintFoundProjectsClientServicesCallback');
    $('#adminLoadingModal').modal('show');
});


//store the info of the client to identify changes
$(document).on('focusin','.clientDetailsInput',function(e){
    $(this).css('background-color','antiquewhite');
    currentProject.info = $(this).val();
});

//save client info
$(document).on('focusout','.clientDetailsInput',function(e){
    var id = $(this).data('id');
    var field = $(this).data('field');
    var info =  $(this).val();
    if(info!=currentProject.info)
        ajaxCall( {'ID':id,'FIELD':field,'INFO':info},'updateClientDetailsCs',"Updated successfully.","We couldn't update the info, please try later");
    $(this).css('background-color','white');
    currentProject.info="";
});

//set Patent App Upgrade Due 1 year after Patent Invoice Sent Date
function setPatentAppUp(){
    var id_aux='#patentAppInvoice_'+currentProject.id;
    var id_aux2='#patentInvoiceSentDate_'+currentProject.id;
    var id_aux3='#patentAppUp_'+currentProject.id;
    if($(id_aux).val()!=""){
        // add one year to the Patent Invoice Sent Date and that is the Patent App Upgrade Due
        var fullDate =$(id_aux2).text().split('-');
        var newyear=parseInt(fullDate[2])+1;
        var newDate = fullDate[0] + "-" + fullDate[1] + "-" + newyear;
        $(id_aux3).text(newDate);
    }else
        $(id_aux3).text("");

}

//Return the id of the current project.
function getCurrentProject(){
    return currentProject.id;
}

//events for portlets
function portletEvents()
{
    //set the current project as selected
    $(document).on('click','.portlet',function(e){

        if(currentProject.id!=$(this).data('id'))
        {
            currentProject = {
                id:$(this).data('id'),
                phone:$('#phone_p_'+$(this).data('id')).html(),
                email:$('#email_p_'+$(this).data('id')).html()
            };

            $('.inputCurrentPhone').val(currentProject.phone);
            $('.portlet-selected').removeClass('portlet-selected');
            $(this).addClass('portlet-selected');
            ////
            if($('#returnPSA_'+currentProject.id).length || $('#returnDDR_'+currentProject.id).length || $('#returnCOPYRIGHT_'+currentProject.id).length || $('#returnTRADEMARK_'+currentProject.id).length){
                $('#sendback_label_'+currentProject.id).css('display','block');
            }

            //check if exist at least one legal record and in i not hide the table
            var haslegalR = $('#tableLegalAct_'+currentProject.id).data('existlegal');
            if(haslegalR == '0')
                $('#tableLegalAct_'+currentProject.id).hide();

            createLastVisitedBox($(this).data('fileno'));
        }
    });



    //print business profile
    $(document).on('click','.printBusiness',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printBusinessProfileAdmin?ID="+id);
    });


    //print project
    $(document).on('click','.printProject',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printProjectAdmin?ID="+id);
    });

    //Load all accessible files for a project
    $(document).on('click','.openFilesClientServices',function(e){
        var id = $(this).data('id');
        ajaxCallback({'ID':id},'loadFilesAdmin','paintFoundFiles');
    });

    //show the uploadFiles modal.
    $(document).on('click','.uploadFilesClientServices',function(e){
        $('#closeUploadFile').attr('command','HOME');
        myDropzone.removeAllFiles(true);
        $('#headUploadFM').text('Drag and Drop or Select Add Files to Upload Files');
        $('#uploadFileModal').modal('show');
    });
}

//Show a modal with all the files
function paintFoundFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '</div> <div class="fileHeader"> <span class="col-md-1 col-md-offset-7">Legal</span><span class="col-md-1">CLIENT-LEGAL</span></div>'; //<span class="col-md-2">Send to Attorney</span>

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
                //"<input type='checkbox' class='checkFile col-md-1'data-filename='"+file.fileName+"' data-id='"+file.id+"' data-action='internal'"+">"+
            "<input type='button' class='sendFileClientSToAtt btn btn-primary col-md-1 pull-right' value='to Att' data-id='"+file.id+"'>" +
            "<input type='button' class='deleteFile btn btn-primary col-md-1 pull-right' value='delete' data-id='"+file.id+"'>" +
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.fileName+"'>" +
            "<input type='checkbox' class='checkFileAccess col-md-1 pull-right' data-id='"+file.id+"' data-action='clientVendor' "+(file.clientVendor == 1?'checked':'')+">"+
            "<input type='checkbox' class='checkFileAccess col-md-1 pull-right' data-id='"+file.id+"' data-action='attorney' "+(file.attorney == 1?'checked':'')+">"+
            "<span class='col-md-2'><strong>"+file.created_at.split(" ")[0]+"</strong></span>" +
            "<span class='col-md-4'><strong>"+file.fileName+"</strong></span>" +
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

        $('#filesModalClientServices').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','.checkFileAccess',function(e){
    var fileId = $(this).data("id");
    var type = $(this).data("action");
    var isChecked=$(this).is(":checked");
    ajaxCall( {'FILE':fileId,'COL':type,'VALUE':isChecked},'saveFileAccess',"Access updated successfully.","We couldn't updated the access for this file, please try later");
});

//send new password to client by email
$(document).on('click','.sendPass',function(e){
    var id = $(this).data("id");
    ajaxCall( {'ID':id},'sendNewPasswordCs',"Password successfully sent it.","We couldn't send the password, please try later");
});

//send file to att with an email
$(document).on('click','.sendFileClientSToAtt', function (e) {
    var att_id = $('#selectAttorney_'+currentProject.id).val();
    if(att_id=="0"){
        swal({title: "Sorry, there is no attorney for this project.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }else{
        ajaxCall({'EMAILATT':$.trim($('#att_email_'+currentProject.id).text()),'PROJECT':currentProject.id,'FILE':$(this).data('id')},'sendFileClientSToAtt','File Sent','Sorry, Try Later.');
    }
});


//update the checkbox  Documents to attorney
function afterMerge(result){
    var aux_id1 = '#documentSent_'+currentProject.id; //checkbox id
    var aux_id2 = '#documentSentDate_'+currentProject.id;// <p> id
    if(result!="-1"){
        $(aux_id1).prop('checked','checked');
        $(aux_id2).val(result);
        $('#filesModalClientServices').modal('hide');
        toastr.success("The attorney coversheet was send it!","Success")
    }else
        toastr.error("An error has happened, try later","Error")
}

//resend documents to the client, this button show a new modal to write the notes to the client
$(document).on('click','.resendFile',function(e){
    var id=$(this).data('id');
    var htmlFiles = "<div class='fileHeader'><span class='col-md-4'>"+$(this).data('filename')+"</span></div>"+
        "<div id='notesToResend_"+id+"' class='fileFound'>" +
        "<textarea rows='6' cols='40' id='textNotes' data-id='"+id+"'  data-name='"+$(this).data('filename')+"'></textarea></div>";
    $('.container-resendFiles').html(htmlFiles);
    $('#resendLegalDocsModal').modal('show');
});


//resend documents, this button make the changes in the server to resend files to client
$(document).on('click','#resendFiles', function (e) {
    var id=$('#textNotes').data('id');
    var note=$('#textNotes').val();
    $('#resendLegalDocsModal').modal('hide');
    ajaxCallback({'FILE_ID':id,'NOTE':note,'PIN':currentProject.id},'resendFile','disabledSendBack');
});

//disable the bttn to send back a doc
function disabledSendBack(result){
    if(result!="-1"){
        var btnId = '#'+result+currentProject.id;
        $(btnId).prop('disabled',true);
    }else
        toastr.error('An error has happened, try later',"Error.");
}

//delete file from the modal
function deleteFilesCallback(id){
    if(id != "-1"){
        $("#fileFound_"+id).fadeOut(600, function(){
            $(this).remove();
        });
    }else{
        toastr.error('We can\'t delete this file now.',"Error.");
    }
}


//expande or collapse the Find Sub input
$("#inputFindSub").expandable({
    width: 180,
    duration: 300
});

//Call to find Project when is pressed  enter key and Search Projects by fname, lname, phone, email or fileno
$("#inputFindSub").keypress(function(e) {
    if(e.which == 13 && $(this).val().length>0){
        $('#adminLoadingModal').modal('show');
        ajaxCallback({'PARAMS':$(this).val().trim()},'findProjectClientServices','paintFoundProjectsClientServicesCallback');
    }
});

//paint projects from Find Sub
function paintFoundProjectsClientServicesCallback(projects){
    if(projects.length>0)
    {
        //Hide the current portlets
        $('.container-portlets').css('display','none');
        //Clean the container for previous search
        $('.container-added-portlets').html('');
        for(var i =0;i<projects.length;i++){
            var project = $(projects[i]);
            //if exists the portlet searched in the current view, move it for the search result view
            var ident = '#container_'+project.data('id');
            if($(ident).length!=0)
            {
                //add a field called exists to know if it was showed previously
                project.attr('data-exists',1);
                $('#container_'+project.data('id')).remove();
            }
            $('.container-added-portlets').append(project);
        }
        //unselected all the projects in the view
        $('.portlet-selected').removeClass('portlet-selected');
        currentProject = {id:-1};
        $('.container-portlets-found').css('display','inline');
        $('.pickDate').datepicker({});
        $('select.select').each(function(){
            var title = $(this).attr('title');
            if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
            $(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                .after('<span class="select btn-warning">' + title + '</span>')
                .change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().text(val);
                })
        });
        $('#adminLoadingModal').modal('hide');
    }
    else{
        $('#adminLoadingModal').modal('hide');
        toastr.error('Sorry no matches',"No Matches");
    }
}

//Close search result box and show again portlets
$('.close-portlets-found').click(function(e){
    $('.container-added-portlets').find( ".portlet").each(function(e){
        if($(this).data('exists')==1){
            var portlet = $(this);
            switch ($(this).data('completed')){
                case 0:
                    $('.container-portlets-new').append(portlet);
                    break;
                case 1:
                    $('.container-portlets-process').append(portlet);
                    break;
                case 2:
                    $('.container-portlets-returned').append(portlet);
                    break;
                case 3:
                    $('.container-portlets-overdue').append(portlet);
                    break;
                default :
                    break;
            }
            //var phase = $(this).data('phase');
            //$('.container-portlets-phase'+phase).append(portlet);

        }
    });
    $('.portlet-selected').removeClass('portlet-selected');
    currentProject = {id:-1};
    $('.container-portlets').css('display','inline');
    $('.container-portlets-found').css('display','none');
    $('.container-added-portlets').html('');
    $('#inputFindSub').val('');
});

//set the PPA Contract Type
$(document).on('click','.checkType',function(e){
    var type=$(this).data('val');
    var check = -1;
    if( $(this).prop('checked')){
        check = 1;
        if(type == "PROV"){
            var aux_id ="#ppa_type_"+currentProject.id;
            $(aux_id).text("PROVISIONAL");
            $('#pApplicationSent_'+currentProject.id).data('type','PROV');
        }
        if(type == "UPG_UT" || type=="UT"){
            $('#pApplicationSent_'+currentProject.id).data('type','PA');
        }
    }else if(type == "PROV"){
        var aux_id = "#ppa_type_"+currentProject.id;
        var text_type = $(aux_id).data('type');
        $(aux_id).text(text_type);
        $('#pApplicationSent_'+currentProject.id).data('type','PA');
    }else if(type == "UPG_UT" && $('#typePROV_'+currentProject.id).prop('checked')){
        $('#pApplicationSent_'+currentProject.id).data('type','PROV');
    }
    ajaxCallback({'ID':currentProject.id ,'TYPE':type,'CHECK':check},'checkTypeContract','typeContractBack'); //'Contract type set','An error has happened');
});

//set the PPA Contract Type
$(document).on('click','.checkMailOnly',function(e){
    var check = 0;
    if( $(this).prop('checked')){
        check = 1;
    }
    ajaxCall({'ID':currentProject.id ,'CHECK':check},'checkMailOnly','Saved','An error has happened, please try later.'); //'Contract type set','An error has happened');
})

function typeContractBack(result){
    if(result == "1")
        toastr.success("Contract type set!","Success")
    else if(result == "-1")
        toastr.error('An error has happened, please try later',"Error");
    else if(result == "reminder"){
        var html = "<p> Please remember send out PCT and/or EPO Filing to attorney.</p>";
        $('.container-reminder').html(html);
        $('#reminderPCTEPO').modal('show');
    }

}

//set the type design (show a modal asking if wanna send a coversheet)
$(document).on('click','.checkDesign',function(){
    var type=$(this).data('val');
    var check = -1;
    if( $(this).prop('checked')){
        $('.hide-files').hide();
        $(this).prop('checked',false);
        $('#designCoversheetModal').modal('show');
    }else {
        ajaxCallback({'ID': currentProject.id, 'TYPE': type, 'CHECK': check}, 'checkTypeContract', 'typeContractBack');
    }
});

$(document).on('click','.notCoversheetD',function(){
    ajaxCall({'ID':currentProject.id ,'TYPE':'D','CHECK':1},'checkTypeContract','Contract type set','An error has happened, please try later.');
    $('#designCoversheetModal').modal('hide');
    $('#typeD_'+currentProject.id).prop('checked',true);
});

$(document).on('click','.coversheetD',function(){
    ajaxCallback({'ID':currentProject.id},'sendDesignCoversheet','sendDesignCoversheetBack');
    $('#designCoversheetModal').modal('hide');
});

function sendDesignCoversheetBack(result){
    if(result == -1){
        toastr.error('An error has happenned, please try later.', 'Error');
    }
    else if(result == 1){
        $('#designCoversheetModal').modal('hide');
        $('#typeD_'+currentProject.id).prop('checked',true);
        toastr.success('Design Coversheet sent to Attorney!', 'Success');
        ajaxCall({'ID':currentProject.id ,'TYPE':'D','CHECK':1},'checkTypeContract','Contract type set','An error has happened, please try later.');
    }
    else if (result == -2){
        ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','designCoversheetSelectFiles');
    }
}

function designCoversheetSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendDC"  aria-hidden="true">Send Design Coversheet</button>';
        $('.attach-files').html(htmlBtn);
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendDC',function(){
    if(filesToMerge.length>0){
        ajaxCallback({
            'ID': currentProject.id,
            'FILES': filesToMerge
        }, 'sendDesignCoversheetWithFile', 'sendDCBack');
        $('#selectFilesToAttachModal').modal('hide');
    }else
        swal({title: "Please select the files to send.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
});

function sendDCBack(result){
    if(result==1){
        $('#typeD_'+currentProject.id).prop('checked',true);
        toastr.success('Design Coversheet sent to Attorney!', 'Success');
        ajaxCall({'ID':currentProject.id ,'TYPE':'D','CHECK':1},'checkTypeContract','Contract type set','An error has happened, please try later.');
    }else
        toastr.error('An error has happenned, please try later.', 'Error');
}


// set Copyright Filing Attorney && Trademark Filing Attorney
$(document).on('change','.selectAttorney',function(e){
    var att_id=$(this).val();
    var col=$(this).data('prop');
    ajaxCall({'ID':currentProject.id,'ATT':att_id,'COL':col},'selectAtt','Patent Application Process changed','An error has happened');

});
//change the attorney
$(document).on('change','.selectAtt',function(e){
    var id = $('#selectAttorney_'+currentProject.id).val();
    if(id== "0")
        $('#att_email_'+currentProject.id).text("N/A");
    else
        ajaxCallback({'ID':id,'PID':currentProject.id},"changeAtt","changeAttBack");
});
function changeAttBack(email){
    $('#att_email_'+currentProject.id).text(email);
}


//save the date of PCT Invoice Sent && Design Invoice Sent after pick the date in the datepicker
$(document).on('click','.saveDate',function(e){var date=$('#'+$(this).data('date')).val();
    var col=$('#'+$(this).data('date')).data('prop');
    ajaxCall({
        'ID': currentProject.id,
        'DATE': date,
        'COL':col
    }, 'setSentDate', 'Patent Application Process changed', 'An error has happened');
});


//remove the date of PCT Invoice Rcvd && Design Invoice Sent
$(document).on('blur','.saveDataInput',function(e){
    var date=$(this).val();
    var col=$(this).data('prop');
    if(date=="") {
        ajaxCall({
            'ID': currentProject.id,
            'DATE': "0000-00-00 00:00:00",
            'COL': col
        }, 'setSentDate', 'Patent Application Process changed', 'An error has happened');
    }
});

//set the date when the paten app was sent it to the client, and show a modal to upload the paten app
$(document).on('click','.patentAppSent',function(e){
    var att = $('#selectAttorney_'+currentProject.id).val();
    var check = -1;
    var col = $(this).data('prop');//the column in the model
    var type =$(this).data('type');//to know if is a prov or ut or design
    if ($(this).prop('checked'))
        check = 1;
    $(this).prop('checked', false);
    if(att == 0){
        toastr.error('Select the attorney to send the Patent Application Package');
    }else {
        //set the date and show the modal
        if (check == 1) {
            $('#closeUploadFile').attr('command', type);
            $('#adminLoadingModal').modal('show');
            ajaxCallback({'PID':currentProject.id,'TYPE':type,'CALL':'SEND'},'beforeSendPatent','backToBeforeSendPA');
        }
        else {
            $('#' + $(this).data('p')).text('');
            ajaxCallback({
                'ID': currentProject.id,
                'CHECK': check,
                'DATE': '',
                'COL': col
            }, 'checkPatentAppProcess', 'checkPatenAppCallBack');
        }
    }
});


function backToBeforeSendPA(result){
    if(result == 1){
        myDropzone.removeAllFiles(true);
        $('#adminLoadingModal').modal('hide');
        $('#uploadFileModal').modal('show');
    }else if(result == 'DESIGN_STARTED'){
        $('#adminLoadingModal').modal('hide');
        swal({title: "There's another sent Patent App Pack provisional or utility still without approve.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true }
        );
    }else if(result == 'PATENT_STARTED'){
        $('#adminLoadingModal').modal('hide');
        swal({title: "There's another sent Patent App Pack design still without approve.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true }
        );
    }
}

$(document).on('click','.resendAPP',function(e){
    var att = $('#selectAttorney_'+currentProject.id).val();
    if(att == 0)
        toastr.error('Select the attorney to send the Patent Application Package');
    else{
        var type =$(this).data('type');//to know if is a prov or ut or design
        ajaxCallback({'PID':currentProject.id,'TYPE':type,'CALL':'RESEND'},'beforeSendPatent','backToResendApp');
    }
});

function backToResendApp(type){
    if(type == 'DESIGN_STARTED'){
        $('#adminLoadingModal').modal('hide');
        swal({title: "There's another sent Patent App Pack provisional or utility still without approve.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true }
        );
    }else if(type == 'PATENT_STARTED'){
        $('#adminLoadingModal').modal('hide');
        swal({title: "There's another sent Patent App Pack design still without approve.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true }
        );
    }else
        ajaxCallback({'ID':currentProject.id,'COMMAND':type},'reEmailPatentAppPack','callBackReEmailPatentApp')
}

function callBackReEmailPatentApp(result){

    if(result == -1)
        toastr.error('An error has happened, please try later.','Error');
    else{
        if($('#divNote_'+result.id).length == 0){
            var note =  '<div class="noteLink col-md-12" id="divNote_'+result.id+'">'+
                '<i title="Edit" class="fa fa-pencil-square-o col-md-1 editNotesCs" data-id="'+result.id+'" aria-hidden="true"></i>'+
                '<p id="pNote_'+result.id+'" title="'+result.notes+'" class="col-md-6">'+(result.notes.length>45?result.notes.substring(0,40)+'...':result.notes)+'</p>'+
                '<p class="col-md-4">Today</p>'+
                '<i title="Delete" class="fa fa-times col-md-1 deleteNotesCs" data-id="'+result.id+'" aria-hidden="true"></i>'+
                '</div>';
            $('#insideCollapseNotes_'+result.projectclientservices_id).prepend(note);
            toastr.success('The Patent App was sent it!!','Success');
        }else{
            $('#pNote_'+result.id).attr('title',result.notes);
            $('#pNote_'+result.id).html(result.notes.length>45?result.notes.substring(0,40)+'...':result.notes);
            toastr.success('The Patent App was sent it!!','Success');
        }
    }
}

//set the value of the checkboxs and their date
$(document).on('click','.checkPatenApp',function(e){
    var check =-1;
    var col=$(this).data('prop');//the column in the model
    var att = $('#selectAttorney_'+currentProject.id).val();

    if( $(this).prop('checked'))
        check = 1;
    if(check==1){
        var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
        $('#'+$(this).data('p')).val(fullDate);
        $('#'+$(this).data('p')).removeAttr("disabled");
    }
    else{
        $('#'+$(this).data('p')).val('');
        $('#'+$(this).data('p')).prop("disabled","disabled");
    }
    if(col == 'ppaSent_created_at' && att == 0){
        swal({title: "You must have select an attorney!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        $(this).prop('checked',false)
    }else
        ajaxCallback({'ID':currentProject.id,'CHECK':check,'DATE':fullDate,'COL':col},'checkPatentAppProcess','checkPatenAppCallBack');
});


//set the value of the checkboxs appPendingRevision
$(document).on('click','.appPendingRevision',function(e){
    var check =0;
    var col = $(this).data('prop');
    if( $(this).prop('checked'))
        check = 1;
    ajaxCall({'ID':currentProject.id,'CHECK':check,'COL':col},'saveAppPendingRevision','Saved','Sorry,try again later.');
});

$(document).on('click','.checkILCAgreementSent',function(e){
    if( $(this).prop('checked')){
        ajaxCallback({'ID':currentProject.id},'findFilingR','backCheckFilingR');
    }
    else
        ajaxCallback({'ID':currentProject.id,'CHECK':-1,'DATE':'','COL':"marketingAgrSent_created_at"},'checkPatentAppProcess','checkPatenAppCallBack');
});

function backCheckFilingR(result){
    if(result == '-1')
        toastr.error('An error has happenned, please try later.', 'Error');
    else if(result==0){
        ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','paintFilingR');
    }else{
        var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
        ajaxCallback({'ID':currentProject.id,'CHECK':1,'DATE':fullDate,'COL':"marketingAgrSent_created_at",'FILEID':result},'checkPatentAppProcess','checkPatenAppCallBack');
    }
}

$(document).on('click','.checkILCAgreementSentAfterUpgrade',function(e){
    if($(this).prop('checked')){
        ajaxCallback({'ID':currentProject.id},'findFilingR','backCheckFilingRUpg');
    }else{
        ajaxCall({'ID':currentProject.id},'unCheckIlcAfterUpgrade','Saved','Sorry,try again later.');
        $('#ILCAfterUpgradeSentDate_'+currentProject.id).val('');
        $('#ILCAfterUpgradeSentDate_'+currentProject.id).prop("disabled","disabled");
    }
});

function backCheckFilingRUpg(result){
    if(result == '-1')
        toastr.error('An error has happenned, please try later.', 'Error');
    else if(result==0){
        ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','paintFilingR');
    }else{
        var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
        ajaxCallback({'ID':currentProject.id,'CHECK':1,'DATE':fullDate,'COL':"marketingAgrSentAfterUpgrade_created_at",'FILEID':result},'checkPatentAppProcess','checkPatenAppCallBack');
    }
}

function paintFilingR(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '</div> <div class="fileHeader"> <span class="col-md-3">Mark as filing receipt</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFilingR col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        $('.container-founds-filingR').html(htmlFiles);
        $('#filingRFilesModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','.saveFilingR',function(e){
    ///////
    var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
    var fileId = -1;
    $('.checkFilingR').each(function(key,file){
        if($(this).prop('checked'))
            fileId=$(this).data('id');
    });
    if(fileId != -1){
        if($('#marketingAgrSentDate_'+currentProject.id).val() == ""){
            ajaxCallback({'ID':currentProject.id,'CHECK':1,'DATE':fullDate,'COL':"marketingAgrSent_created_at",'FILEID':fileId},'checkPatentAppProcess','checkPatenAppCallBack');
        }else{
            ajaxCallback({'ID':currentProject.id,'CHECK':1,'DATE':fullDate,'COL':"marketingAgrSentAfterUpgrade_created_at",'FILEID':fileId},'checkPatentAppProcess','checkPatenAppCallBack');
        }
    }else{
        $('#marketingAgrSent_'+currentProject.id).prop('checked',false);
        toastr.error('Select one file to mark as filing receipt.');
    }
});

$(document).on('click','.doc_sent_att',function(e){
    var check =-1;
    if( $(this).prop('checked'))
        check = 1;
    if(check==1){
        $(this).prop('checked',false);
        $('#closeUploadFile').attr('command', 'DtoA');
        myDropzone.removeAllFiles(true);
        $('#uploadFileModal').modal('show');
        $('#headUploadFM').text('Drag and Drop or Select Add Files to send to Attorney');
    }

});

function checkPatenAppCallBack(result){
    switch(result){
        case "psa_ddr":
            var btnPsa = '#returnPSA_'+currentProject.id;
            var btnDdr = '#returnDDR_'+currentProject.id;
            $(btnPsa).addClass('hide');
            $(btnDdr).addClass('hide');
            $('#emailSent_'+currentProject.id).prop('checked',true);
            var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
            $('#emailSentDate_'+currentProject.id).val(fullDate);
            toastr.success("PSA & DDR set!!");
            break;
        case "copyright":
            var btnCopy = '#returnCOPYRIGHT_'+currentProject.id;
            $(btnCopy).addClass('hide');
            toastr.success("Copyright set!!")
            break;
        case "trademark":
            var btnTrademark = '#returnTRADEMARK_'+currentProject.id;
            $(btnTrademark).addClass('hide');
            toastr.success("Trademark set!!")
            break;
        case "ilc_sent":
            var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
            $('#marketingAgrSentDate_'+currentProject.id).val(fullDate);
            $('#marketingAgrSentDate_'+currentProject.id).removeAttr("disabled");
            toastr.success("ILC sent!!");
            break;
        case "ilcAfterUpgrade_sent":
            var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
            $('#ILCAfterUpgradeSentDate_'+currentProject.id).val(fullDate);
            $('#ILCAfterUpgradeSentDate_'+currentProject.id).removeAttr("disabled");
            toastr.success("ILC sent!!");
            break;
        case "uncheck_ilc_sent":
            $('#marketingAgrSentDate_'+currentProject.id).val('');
            $('#marketingAgrSentDate_'+currentProject.id).prop("disabled","disabled");
            break;
        case "uncheck_patent_app":
            $('#pApplicationDate_'+currentProject.id).val("");
            $('#pApplicationDate_'+currentProject.id).prop("disabled","disabled");
            $('#poaDecSent_'+currentProject.id).prop('checked',false);
            $('#poaDecDate_'+currentProject.id).val("");
            $('#poaDecDate_'+currentProject.id).prop("disabled","disabled");
            break;
        case "uncheck_patent_app_d":
            $('#pApplicationDateD_'+currentProject.id).val("");
            $('#pApplicationDateD_'+currentProject.id).prop("disabled","disabled");
            $('#poaDecSentD_'+currentProject.id).prop('checked',false);
            $('#poaDecDateD_'+currentProject.id).val("");
            $('#poaDecDateD_'+currentProject.id).prop("disabled","disabled");
            break;
        case "-1":
            toastr.error('An error has happened, try later',"Error.");
            break;
        default :
            toastr.success('Success!!',"Success.");
            break;
    }
}


// verify the number change
$(document).on('focus','.inputPatenAppProc, .inputAppNo',function(e){
    numbercheck=$(this).val();
});

//save the value of a input text and save the date
$(document).on('blur','.inputPatenAppProc, .inputAppNo',function(e){
    var fullDate = new Date();
    var twoDigitMonth = (fullDate.getMonth() >=9)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
    var currentDate = twoDigitMonth + "/" + fullDate.getDate() + "/" + fullDate.getFullYear();
    var number=$(this).val();
    var col=$(this).data('prop');//the column of the value
    var col2=$(this).data('prop2');//the column of the date if has one
    if(col2!="-")
        var hasDate=1;
    else
        var hasDate=0;

    if(number!=0 && hasDate==1){
        $('#'+$(this).data('p')).val(currentDate);
        $('#'+$(this).data('p')).removeAttr("disabled");
    }
    else if(hasDate==1){//the value was removed
        $('#'+$(this).data('p')).val("");
        $('#'+$(this).data('p')).prop("disabled","disabled");
    }

    if(numbercheck!=number){//the value was changed
        setPatentAppUp();
        ajaxCallback({'ID':currentProject.id,'NUMBER':number,'DATE':currentDate,'HASDATE':hasDate,'COL':col,'COL2':col2},'setNumberPatentApp','reminderFilPCTEPO');
    }
});



$(document).on('blur','#notesCS' ,function(e){
    var notes = $(this).val();
    ajaxCall({'ID':currentProject.id,'NOTES':notes},'saveNotes','Notes saved','An error has happened, please try later');
});

function reminderFilPCTEPO(type){
    if(type == '-1')
        toastr.error('An error has happened, try later',"Error.");
    else if(type!=""){
        var arrType = type.split(',');
        if(arrType.length>0)
            var html = "<p> Please remember send out PCT and/or EPO Filing to attorney.</p>";

        $('.container-reminder').html(html);
        $('#reminderPCTEPO').modal('show');
    }else
        toastr.success('Patent Application Process changed!',"Success");
}

//slide the accordion
$(document).on('click','.indicator',function(e){
    var id = $(this).data('id');
    $('.indicator').each(function(e){
        var idT = $(this).data('id');
        if(idT!=id)//projects not selected
        {
            //hide the tab and changed the arrow position
            $(".portlet_tab_content_"+idT).css('display', 'none');
            $("#container_"+idT).css('height', '40px');
            $("#portletBody_"+idT).addClass('hide');
            $("#indicator_"+idT).removeClass('fa-chevron-up');
            $("#indicator_"+idT).addClass('fa-chevron-down');
            $("#navTabs_"+idT).addClass('invisible');
        }
    });
    //changed to visible
    if($("#portletBody_"+id).hasClass('hide')){
        $(".portlet_tab_content_"+id).css('display', 'block');
        $("#container_"+id).css('height', 'auto');
        $("#portletBody_"+id).removeClass('hide');
        $("#navTabs_"+id).removeClass('invisible');
        $("#indicator_"+id).removeClass('fa-chevron-down');
        $("#indicator_"+id).addClass('fa-chevron-up');
    }else{ //changed to hide
        $(".portlet_tab_content_"+id).css('display', 'none');
        $("#container_"+id).css('height', '40px');
        $("#portletBody_"+id).addClass('hide');
        $("#navTabs_"+id).addClass('invisible');
        $("#indicator_"+id).removeClass('fa-chevron-up');
        $("#indicator_"+id).addClass('fa-chevron-down');
    }
});

//add the project to client services table
$(document).on('click','.createProjBuntton',function(e){
    ajaxCallback({'ID':currentProject.id},'addProjectCS','openLegal');
});

//put the portled of the project changed with the new legal
function openLegal(arr){
    if(arr[0]!="false"){
        var project=arr[0];
        var id=arr[1];
        //remove the old container
        $('#container_'+$(project).data('id')).remove();
        //add the new container
        $('.container-added-portlets').append(project);
        //put the tab legal active and not collapse
        $("#indicator_"+id).removeClass('fa-chevron-down');
        $("#indicator_"+id).addClass('fa-chevron-up');
        $("#navTabs_"+id).removeClass('invisible');
        $("#portletBody_"+id).removeClass('hide');
        $(".portlet_tab_content_"+id).css('display','block');
        $("#container_"+id).css('height', 'auto');
        $('#portlet_tab_'+id+'_3').addClass('active');
        $('#portlet_tab_'+id+'_1').removeClass('active');
        $('#container_'+id).data('exists','1');
        $('#container_'+id).data('completed',0);

    }else
        toastr.error('The project dont have a contract PPA',"Error!!");
}

//change the state of column show
$(document).on('click','.showProjectClientServices',function(e){
    var state=$(this).data('state');
    if(state=="1"){
        //change the icon && and the value of la prop 'state'
        $(this).removeClass('fa-eye');
        $(this).addClass('fa-eye-slash');
        $(this).data('state','0');
    }
    else{
        $(this).removeClass('fa-eye-slash');
        $(this).addClass('fa-eye');
        $(this).data('state','1');
    }
    ajaxCallback({'ID':currentProject.id,'STATE':1-state},'changedShow','removeProjectCS');
});

//show or disappears the project according the state of the var show
function removeProjectCS(arr){
    if(arr[1]=="1") {
        $("#container_"+arr[0]).data('exists','1');
        $("#container_"+arr[0]).data('completed',arr[2]);
        //$("#container_"+arr[0]).data('phase',arr[2]);
    }else
        $("#container_"+arr[0]).fadeOut(600, function(){
            $(this).remove();});
}


// verify the number change
$(document).on('focus','.ppaDetailsInput',function(e){
    numbercheck=$(this).val();
});


//set the value of total price of the contract PPA
$(document).on('blur','.ppaDetailsInput',function(e){
    var field = $(this).attr('name');
    var value = $(this).val();
    if(numbercheck != value)
        ajaxCallback({'ID':currentProject.id,'FIELD':field,'VALUE':value},'setPPADetails','callbackDetailsPPA');
});

//recalculate the due balance and percentage
function callbackDetailsPPA(result){
    if(result == '1'){
        var tP = $('#totalPrice_'+currentProject.id).val();
        var aP = $('#amntPaid_'+currentProject.id).val();
        var due = tP - aP;
        var percent = (aP/tP) * 100;
        percent = Math.round(percent);
        $('#balanceDue_'+currentProject.id).text(due);
        $('#percentPaid_'+currentProject.id).text(percent+'%');
        toastr.success('PPA detail was set!',"Success");
    }else
        toastr.error('An error has happened, please try later',"Error");

}

//save the date of the contract PPA received
$(document).on('changeDate','.ppaDetailsDate',function(e){
    if(currentProject.id != '-1'){
        var date=$(this).val();
        var col=$(this).attr('name');
        ajaxCallback({
            'ID': currentProject.id,
            'VALUE': date,
            'FIELD':col
        }, 'setPPADetails', 'callBackSaveDate');
    }
});


function callBackSaveDate(result){
    if(result[0] == '-1')
        toastr.error('An error has happened, please try later',"Error");
    else if(result[0] == '1')
        toastr.success('PPA detail was set!',"Success");
    else{
        $('#contractEndDate_'+currentProject.id).text(result[0]);
        toastr.success('PPA detail was set!',"Success");
    }
}

var actDate;

//$(document).on('focus','.editDate',function(e){
//   actDate = $(this).val();
//});
//
//$(document).on('blur','.editDate',function(e){
//    var date=$(this).val();
//    if(actDate != date && currentProject.id != '-1'){
//        var col=$(this).data('prop');
//        ajaxCall({
//            'ID': currentProject.id,
//            'DATE': date,
//            'COL': col
//        }, 'setSentDate', 'Date changed!', 'An error has happened!');
//    }
//});

//edit the sent date
$(document).on('changeDate','.editDate',function(e){
    if(currentProject.id != '-1'){
        var date=$(this).val();
        var col=$(this).data('prop');
        ajaxCall({
            'ID': currentProject.id,
            'DATE': date,
            'COL': col
        }, 'setSentDate', 'Date changed!', 'An error has happened!');
    }
});

//delete notes
$(document).on('click','.deleteNotesCs',function(e){
    var id=$(this).data('id');
    $("#divNote_"+id).fadeOut(600, function(){
        $(this).remove();
    });
    ajaxCall({'ID': id}, 'csDeleteNotes', 'Note Deleted', 'An error has happened!');
});

//add Notes modal.
$(document).on('click','.addNotesCs',function(e){
    $('#noteCS').val('');
    $('#submitbtnCSNotes').data('id',"0");
    $('#csNotesModal').modal('show');
});

//edit Notes modal.
$(document).on('click','.editNotesCs',function(e){
    var id=$(this).data('id');
    var note = $("#pNote_"+id).attr("title");
    $('#submitbtnCSNotes').data('id',id);
    $('#noteCS').val(note);
    $('#csNotesModal').modal('show');
});

//edit Notes modal.
$(document).on('click','#submitbtnCSNotes',function(e){
    var id=$(this).data('id');
    var note = $('#noteCS').val();
    ajaxCallback({'PID': currentProject.id,'ID': id,'VALUE': note}, 'csSaveNotes', 'callBackCsSaveNotes');
});

function callBackCsSaveNotes(result){

    if($('#divNote_'+result.id).length == 0){
        var note =  '<div class="noteLink col-md-12" id="divNote_'+result.id+'">'+
            '<i title="Edit" class="fa fa-pencil-square-o col-md-1 editNotesCs" data-id="'+result.id+'" aria-hidden="true"></i>'+
            '<p id="pNote_'+result.id+'" title="'+result.notes+'" class="col-md-6">'+(result.notes.length>45?result.notes.substring(0,40)+'...':result.notes)+'</p>'+
            '<p class="col-md-4">Today</p>'+
            '<i title="Delete" class="fa fa-times col-md-1 deleteNotesCs" data-id="'+result.id+'" aria-hidden="true"></i>'+
            '</div>';
        $('#insideCollapseNotes_'+result.projectclientservices_id).prepend(note);
    }else{
        $('#pNote_'+result.id).attr('title',result.notes);
        $('#pNote_'+result.id).html(result.notes.length>45?result.notes.substring(0,40)+'...':result.notes);
    }
}

$(document).on('click','.uploadFileToAtt',function(e){
    $('#closeUploadFile').attr('command','ATT');
    myDropzone.removeAllFiles(true);
    $('#headUploadFM').text('Drag and Drop or Select Add Files to Upload Files to Attorney');
    $('#uploadFileModal').modal('show');
});


$(document).on('change','.select', function (e) {
    var state = $(this).val();
    if(state != "")
        ajaxCallback({'ID':currentProject.id,'STATE':state},'changeState','backChangeState');

});

function backChangeState(state){
    if(state == '1'){
        $("#container_"+currentProject.id).data('exists','1');
        $("#container_"+currentProject.id).data('completed',1);
        $('#reOpenBtn_'+currentProject.id).remove();
        var html = '<select class="select" title="Select State"><option ></option><option value="4">Closed</option> <option value="5">Closed (expired)</option>   </select>';
        $('#divChangState_'+currentProject.id).html(html);
        $('select.select').each(function(){
            var title = $(this).attr('title');
            if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
            $(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                .after('<span class="select btn-warning">' + title + '</span>')
                .change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().text(val);
                })
        });
        toastr.success('Project Reopened!!');

    }else{
        $("#showP_"+currentProject.id).data('state','0');
        $("#container_"+currentProject.id).fadeOut(600, function(){
            $(this).remove();});
        toastr.success('Project Closed!!');
    }
}

$(document).on('click','.reOpenBtn',function(e){
    var state = 1;
    ajaxCallback({'ID':currentProject.id,'STATE':state},'changeState','backChangeState');
});

$(document).on('change','.actTypeSel',function(e){
    if($(this).val() == "Utility"){
        $("#activitySelect option[value='Notice of Approval']").remove();
        $("#activitySelect option[value='Registration']").remove();
        $('.activitySel').append('<option value="Advisory Actions">Advisory Actions</option>');
        $('.activitySel').append('<option value="Design Applications">Design Applications</option>');
        $('.activitySel').append('<option value="Notice of Allowance">Notice of Allowance</option>');
        $('.activitySel').append('<option value="Notice of Abandonment">Notice of Abandonment</option>');
        if($(".activitySel > option[value='OTHER']").length == 0)
            $('.activitySel').append('<option value="OTHER">other (manual)</option>');
        $('.activitySel').removeAttr('disabled');
    }else if($(this).val() == "Trademark"){
        $("#activitySelect option[value='Advisory Actions']").remove();
        $("#activitySelect option[value='Design Applications']").remove();
        $("#activitySelect option[value='Notice of Allowance']").remove();
        $("#activitySelect option[value='Notice of Abandonment']").remove();
        $('.activitySel').append('<option value="Notice of Approval">Notice of Approval</option>');
        $('.activitySel').append('<option value="Registration">Registration</option>');
        if($(".activitySel > option[value='OTHER']").length == 0)
            $('.activitySel').append('<option value="OTHER">other (manual)</option>');
        $('.activitySel').removeAttr('disabled');
    }else{
        // disabled the activitySel and set the option in none
        $('.activitySel').attr('disabled','disabled');
        $('.activitySel').val('NONE');
    }
});

$(document).on('click','.newLegalAct',function(e){
    $('#createLegalMaintenance').data('isnew','1');
    $('#legalMaintenanceModal').modal('show');
});

$(document).on('click','#createLegalMaintenance',function(e){
    var recordLegal = $('.legalR').val();
    var actType = $('.actTypeSel').val();
    var activity = $('.activitySel').val();
    var dueDate = $('.activityDueDate').val();
    var rcvdDate = $('.activityRcvdDate').val();
    var description = $('.descriptionInfo').val();

    //check if exist at least one legal record and in i not hide the table
    var isnew = $('#createLegalMaintenance').data('isnew');
    if(isnew == '1')
        ajaxCallback({'PID':currentProject.id,'LEGAL_R':recordLegal, 'ACT_TYPE':actType,'ACTIVITY':activity,
            'DUE_DATE':dueDate,'RCVD_DATE':rcvdDate,'DESCRIPTION':description},'createLegalActivity','createLegalBack');
    else if(isnew == '0'){
        var legal_id = $(this).data('lid');
        ajaxCallback({
            'LID': legal_id, 'LEGAL_R': recordLegal, 'ACT_TYPE': actType, 'ACTIVITY': activity,
            'DUE_DATE': dueDate, 'RCVD_DATE': rcvdDate, 'DESCRIPTION': description
        }, 'editLegalAct', 'editLegalBack');
    }

});

function createLegalBack(legalAct){
    //add the new legal record
    var str = legalAct.activity_due_date;
    var res = str.split("-");
    var newDate = res[1]+"/"+res[2]+"/"+res[0];
    var tr="<tr id='legalAct_'"+legalAct.id+"><th style='vertical-align: top;width: 3%;'><i title='Delete' class='fa fa-times deleteLegalA' data-id='"+legalAct.id+"' aria-hidden='true'></i></th><th><a class='edit-legal-Act' data-id='"+legalAct.id+"'>"+legalAct.legal_record+"</a></th><th>"+legalAct.record_type+"</th><th>"+legalAct.activity+"</th><th>"+newDate+"</th><th><p style='font-size: 11px;' title='"+legalAct.description+"'>"+(legalAct.description.length>24?legalAct.description.substring(0,24)+'...':legalAct.description)+"</p></th></tr>";
    $('#tableDataBodyLegal_'+currentProject.id).append($(tr));
    //make the table visible
    $('#tableLegalAct_'+currentProject.id).show();
    //hide and clean the modal
    $('#legalMaintenanceModal').modal('hide');
    //$('.legalR').val('');
    //$('.actTypeSel').val('NONE');
    //$('.activitySel').val('NONE');
    //$('.activitySel').attr('disabled','disabled');
    //$('.activityDueDate').val('');
    //$('.activityRcvdDate').val('');
    //$('.descriptionInfo').val('');
}

function editLegalBack(legalAct){
    if(legalAct!= "-1"){
        var row_id = 'legalAct_'+legalAct.id;
        var str = legalAct.activity_due_date;
        var res = str.split("-");
        var newDate = res[1]+"/"+res[2]+"/"+res[0];
        var new_row = "<th style='vertical-align: top;width: 3%;'><i title='Delete' class='fa fa-times deleteLegalA' data-id='"+legalAct.id+"' aria-hidden='true'></i></th><th><a class='edit-legal-Act' data-id='"+legalAct.id+"'>"+legalAct.legal_record+"</a></th><th>"+legalAct.record_type+"</th><th>"+legalAct.activity+"</th><th>"+newDate+"</th><th><p style='font-size: 11px;' title='"+legalAct.description+"'>"+(legalAct.description.length>24?legalAct.description.substring(0,24)+'...':legalAct.description)+"</p></th>";
        $('#'+row_id).html(new_row);
        $('#legalMaintenanceModal').modal('hide');

        toastr.success('Legal Activity edited!');
    }else
        toastr.error('An error has happened');
}

$(document).on('click','.edit-legal-Act',function(e){
    var legal_id = $(this).data('id');
    $('#createLegalMaintenance').data('isnew','0');
    ajaxCallback({'LID':legal_id},'getLegalAct','showEditLegal');
});

function showEditLegal(legalAct){
    var str = legalAct.activity_due_date;
    var res = str.split("-");
    var aux = res[2].split(" ");
    var newDate = res[1]+"/"+aux[0]+"/"+res[0];
    $('.legalR').val(legalAct.legal_record);
    $('.actTypeSel').val(legalAct.record_type);
    if(legalAct.record_type == "Utility"){
        $("#activitySelect option[value='Notice of Approval']").remove();
        $("#activitySelect option[value='Registration']").remove();
        ////
        $("#activitySelect option[value='Advisory Actions']").remove();
        $("#activitySelect option[value='Design Applications']").remove();
        $("#activitySelect option[value='Notice of Allowance']").remove();
        $("#activitySelect option[value='Notice of Abandonment']").remove();
        ////
        $('.activitySel').append('<option value="Advisory Actions">Advisory Actions</option>');
        $('.activitySel').append('<option value="Design Applications">Design Applications</option>');
        $('.activitySel').append('<option value="Notice of Allowance">Notice of Allowance</option>');
        $('.activitySel').append('<option value="Notice of Abandonment">Notice of Abandonment</option>');
        if($(".activitySel > option[value='OTHER']").length == 0)
            $('.activitySel').append('<option value="OTHER">other (manual)</option>');
    }else if(legalAct.record_type == "Trademark"){
        $("#activitySelect option[value='Advisory Actions']").remove();
        $("#activitySelect option[value='Design Applications']").remove();
        $("#activitySelect option[value='Notice of Allowance']").remove();
        $("#activitySelect option[value='Notice of Abandonment']").remove();
        ////////
        $("#activitySelect option[value='Notice of Approval']").remove();
        $("#activitySelect option[value='Registration']").remove();
        ///////
        $('.activitySel').append('<option value="Notice of Approval">Notice of Approval</option>');
        $('.activitySel').append('<option value="Registration">Registration</option>');
        if($(".activitySel > option[value='OTHER']").length == 0)
            $('.activitySel').append('<option value="OTHER">other (manual)</option>');
    }

    $('.activitySel').val(legalAct.activity);
    $('.activitySel').removeAttr('disabled');
    $('.activityDueDate').val(newDate);
    var str1 = legalAct.recv_date;
    var res2 = str1.split("-");
    var aux2 = res2[2].split(" ");
    var newDate2 = res2[1]+"/"+aux2[0]+"/"+res2[0];
    $('.activityRcvdDate').val(newDate2);
    $('.descriptionInfo').val(legalAct.description);
    $('#createLegalMaintenance').data('lid',legalAct.id);
    $('#legalMaintenanceModal').modal('show');
}

$(document).on('hidden.bs.modal', '#legalMaintenanceModal', function(){
    $('.legalR').val('');
    $('.actTypeSel').val('NONE');
    $('.activitySel').val('NONE');
    $('.activitySel').attr('disabled','disabled');
    $('.activityDueDate').val('');
    $('.activityRcvdDate').val('');
    $('.descriptionInfo').val('');
});

$(document).on('click','.deleteLegalA',function(e){
    var legal_id = $(this).data('id');
    ajaxCallback({'LID':legal_id},'deleteLegalAct','deleteLegalBack')
});

function deleteLegalBack(lid){
    if(lid!='-1'){
        $('#legalAct_'+lid).remove();
        toastr.success('Legal Record Deleted.');
    }else
        toastr.error('An error has happened, please try later.');

}




$(document).on('focus', '.titleInv', function(e){
    titleInventionCheck = $(this).val();
});

$(document).on('blur', '.titleInv', function(e){
    var value = $(this).val();
    var col =$(this).data('prop');
    if(titleInventionCheck != value)
        ajaxCall({'ID':currentProject.id,'INVENTION':value,'COL':col},'saveTitleOfInvention','Title saved!!','An error has happened, please try later.');
});

$(document).on('focus', '.industryInput', function(e){
    industryCheck = $(this).val();
});

$(document).on('blur', '.industryInput', function(e){
    var value = $(this).val();
    if(industryCheck != value)
        ajaxCall({'ID':currentProject.id,'INDUSTRY':value},'saveIndustry','Industry saved!!','An error has happened, please try later.');
});


function testCoversheetBack(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '</div> <div class="fileHeader"><span class="col-md-3">Select the files to merge</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        $('.container-founds-files').html(htmlFiles);
        $('#selectFilesModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

function pctqSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendPCTQ"  aria-hidden="true">Send PCT AGREEMENT</button>';
        $('.attach-files').html(htmlBtn);
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendPCTQ',function(){
    if(filesToMerge.length>0){
        ajaxCallback({'FILES':filesToMerge,'ID':currentProject.id},'emailPCTQuest','pctQuestBack')
    }else
        swal({title: "Please select the files to send.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true },
            function(){
                $('#adminLoadingModal').modal('hide');
            });
});

function pctQuestBack(result){
    if(result != -1){
        var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
        $('#pctQuestSent_'+currentProject.id).val(fullDate);
        $('#pctQuestSent_'+currentProject.id).removeAttr("disabled");
        //put the note
        if($('#divNote_'+result.id).length == 0){
            var note =  '<div class="noteLink col-md-12" id="divNote_'+result.id+'">'+
                '<i title="Edit" class="fa fa-pencil-square-o col-md-1 editNotesCs" data-id="'+result.id+'" aria-hidden="true"></i>'+
                '<p id="pNote_'+result.id+'" title="'+result.notes+'" class="col-md-6">'+(result.notes.length>45?result.notes.substring(0,40)+'...':result.notes)+'</p>'+
                '<p class="col-md-4">Today</p>'+
                '<i title="Delete" class="fa fa-times col-md-1 deleteNotesCs" data-id="'+result.id+'" aria-hidden="true"></i>'+
                '</div>';
            $('#insideCollapseNotes_'+result.projectclientservices_id).prepend(note);
        }else{
            $('#pNote_'+result.id).attr('title',result.notes);
            $('#pNote_'+result.id).html(result.notes.length>45?result.notes.substring(0,40)+'...':result.notes);
        }

        toastr.success('PCT Questionnaire sent!!',"Success");
        $('#selectFilesToAttachModal').modal('hide');
    }else
        toastr.error('An error has happened, please try later',"Error");
}

$(document).on('hidden.bs.modal', '#selectFilesModal', function(){
    filesToMerge=[];
});

$(document).on('hidden.bs.modal', '#selectFilesToAttachModal', function(){
    if(command == 'revision'){
        command = 'common';
        if(filesToMerge.length>0)
            ajaxCallback({'FILES':filesToMerge},'getFiles','backGetFilesRevision');
    }else if(command == 'toVendor'){
        command = 'common';
        if(filesToMerge.length>0)
            ajaxCallback({'FILES':filesToMerge},'getFiles','backGetFilesToVendor');
        else
            $('#emailToVendorsModal').modal('show');
    }
    else{
        filesToMerge=[];
    }
});

$(document).on('click','.checkFiletoMerge',function(){
    if($(this).prop('checked')){
        filesToMerge.push($(this).data('id'));
    }else{
        var index = filesToMerge.indexOf($(this).data('id'));
        if(index>-1)
            filesToMerge.splice(index,1);
    }
});

//show a review of the pdf merge
$(document).on('click','#reviewMergeGeneral', function (e) {
    var att_id = $('#selectAttorney_'+currentProject.id).val();
    if(filesToMerge.length>0){
        $("#selectFilesModal").css('z-index',"100");
        $('#adminLoadingModal').modal('show');
        var type = $(this).data('target');

        if((type == 'ATT_COVERSHEET' || type == 'TM_COVERSHEET' || type == 'CR_COVERSHEET') && att_id == 0)
        {
            swal({title: "Please check if the attorney is selected.",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonText: "Ok",
                    closeOnConfirm: true },
                function(){
                    $('#adminLoadingModal').modal('hide');
                });
        }
        else
            ajaxCallback({'F_IDS':filesToMerge,'P_ID':currentProject.id,'DOC_TYPE':type},'reviewMergeFiles','afterReviewCoversheet');
    }else if(filesToMerge.length<=0)
        swal({title: "Please select the files to send.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true },
            function(){
                $('#adminLoadingModal').modal('hide');
            });
});

//after the pdf was created clean the ids array and put the id of the pdf in th btn sendfilesid
function afterReviewCoversheet(result){
    $('#adminLoadingModal').modal('hide');
    if(result[0]!="-1" && typeof result[0]!= 'undefined'){
        //clean the file ids array and the checkbox
        filesToMerge=[];
        $('.checkFiletoMerge').removeAttr('checked');
        $('#finishMerge').data('fileid',result[0]);
        cleanIframe('iframePrint');
        $("#iframePrint").css('z-index',"150");
        $("#selectFilesModal").css('z-index',"100");
        $("#iframePrint").attr('src', result[1]);
        $('#iframeModal').modal('show');
        $('#finishMerge').removeAttr('disabled');
    }else
        swal({title: "An error has happened, please make the document manually.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true },
            function(){
                $('#selectFilesModal').modal('hide');
            });
}


$(document).on('click','#finishMerge',function(){
    var docType = $(this).data('target');
    if(docType == 'ATT_COVERSHEET'){
        var email = $('#att_email_'+currentProject.id).text();
        var att_id =$('#selectAttorney_'+currentProject.id).val();
        var fileid =$(this).data('fileid');
        ajaxCallback({'FILE_ID':fileid, 'ATT_EMAIL':email,'ATT_ID':att_id},'mergeFiles','afterMerge');
    }else
        ajaxCall({'ID':currentProject.id,'TYPE':docType},'sendCoversheet','Coversheet sent!!!','An error has happened, please try later.');

});

$(document).on('change','#selectOptionClientS',function(){
    if(currentProject.id == -1){
        $('#selectOptionClientS').val(0);
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
    else{
        var type = $(this).val();
        switch (type){
            case 'ttry':
                $('#selectOptionClientS').val(0);
                ajaxCall({'ID':currentProject.id},'emailDntReach','Email sent.','An error has happened, please try later.')
                break;
            case 'tm-letter':
                $('#selectOptionClientS').val(0);
                ajaxCall({'ID':currentProject.id},'sendTrademarkLetter','Trademark Letter sent.','An error has happened, please try later.')
                break;
            case 'pct-quest':
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','pctqSelectFiles');
                break;
            case 'UPG_COVERSHEET':
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'getDatesUpgC','backUpgCoversheet');
                break;
            case 'TR_ALLOWANCE':
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','tmAllowanceSelectFiles');
                break;
            case 'TR_OFFICE_ACTION':
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','tmOfficeActSelectFiles');
                break;
            case 'NON_F_OFFICE_ACTION':
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','nonFinalActionSelectFiles');
                break;
            case 'F_OFFICE_ACTION':
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','finalActionSelectFiles');
                break;
            case 'NOTICE_OF_ALLOWANCE':
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','noticeAllowanceSelectFiles');
                break;
            case 'PCT_AGREEMENT':
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','pctAgreementSelectFiles');
                break;
            case 'PCT_APP':
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','pctAppSelectFiles');
                break;
            case 'REVISION_ATT':
                $('#selectOptionClientS').val(0);
                $('#revisionDESIGN').prop('checked', false);
                $('#revisionUT').prop('checked', false);
                $('#revisionNotes').val('');
                $('#emailModalHeader').html('REVISION ATTORNEY');
                $('#typeEmailModal').removeClass('hidden');
                $('#bodyTag').html('NOTES');
                $('#attachments-container-revision').html('');
                $('#sendRevision').data('command','revision');
                $('#emailCSModal').modal('show');
                break;
            case 'EMAIL_CLIENT':
                $('#selectOptionClientS').val(0);
                $('#revisionNotes').val('');
                $('#emailModalHeader').html('EMAIL TO CLIENT');
                $('#typeEmailModal').addClass('hidden');
                $('#bodyTag').html('BODY EMAIL');
                $('#attachments-container-revision').html('');
                $('#sendRevision').data('command','client');
                $('#emailCSModal').modal('show');
                break;
            case 'EMAIL_VENDOR':
                $('#selectOptionClientS').val(0);
                $('#selectVendor').val(0);
                $('#emailToVendor').val('');
                $('#subjEmToVendor').val('');
                $('#bodyToVend').val('');
                $('#attachments-container-toVendor').html('');
                $('#sendEmToVendor').data('from','cs');
                $('#emailToVendorsModal').modal('show');
                break;
            case 'PCT_EPO_TOATT':
                var newOpt = '<option value="0">Select Action</option>' +
                    '<option value="Docketing1@bayareaip.com">PCT</option>' +
                    '<option value="gschutte@cruickshank.ie">EPO</option>';
                $('#selectOptionClientS').val(0);
                $('#selectVendor').html('');
                $('#selectVendor').append(newOpt);
                $('#sendEmToVendor').data('from','pct_epo');
                $('#selectVendor').val(0);
                $('#emailToVendor').val('');
                $('#subjEmToVendor').val('');
                $('#bodyToVend').val('');
                $('#bodyToVend').val('Please see attached file for new application.');
                $('#attachments-container-toVendor').html('');
                $('#emailToVendorsModal').modal('show');
                break;
            case 'ILC_COVERSHEET':
                if( $('#marketingAgrReceived_'+currentProject.id).is(':checked')){
                    $('#finishMerge').data('target',type);
                    $('#reviewMergeGeneral').data('target',type);
                    $('#selectOptionClientS').val(0);
                    ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','testCoversheetBack');
                }else{
                    $('#selectOptionClientS').val(0);
                    swal({title: "In order to sen the ILC Coversheet the marketing agreement received must be checked.",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonText: "Ok",
                        closeOnConfirm: true });
                }
                break;
            case 'RESEND_TM_COVERSHEET':
                $('#finishMerge').data('target',type);
                $('#reviewMergeGeneral').data('target','TM_COVERSHEET');
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','testCoversheetBack');
                break;
            case 'RESEND_CR_COVERSHEET':
                $('#finishMerge').data('target',type);
                $('#reviewMergeGeneral').data('target','CR_COVERSHEET');
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','testCoversheetBack');
                break;
            case 'ATT_COVERSHEET':
                if($('#patentAppFilingDate_'+currentProject.id).val() != ""){
                    swal({title: "An application has been filed and Design type of contract is not check. You should try SEND UPGRADE COVERSHEET instead, or check type Design to send a DESIGN app to ATT.",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonText: "Ok",
                        closeOnConfirm: true });
                }
                else{
                    $('#finishMerge').data('target',type);
                    $('#reviewMergeGeneral').data('target',type);
                    $('#selectOptionClientS').val(0);
                    ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','testCoversheetBack');
                    break;
                }
            default:
                $('#finishMerge').data('target',type);
                $('#reviewMergeGeneral').data('target',type);
                $('#selectOptionClientS').val(0);
                ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','testCoversheetBack');
                break;
        }
    }
});

function sendUpgback(result){
    if(result == -1){
        toastr.error("An error has happened, please try later","Error");
    }else if(result == -2){
        ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','upgCoversheetSelectFiles');
        $('#upgCoversheetModal').modal('hide');
    }else{
        var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
        $('#upgradeSentDate_'+currentProject.id).val(fullDate);
        $('#upgradeSentDate_'+currentProject.id).removeAttr("disabled");
        $('#upgradeSent_'+currentProject.id).prop('checked',true);
        $('#typeCoversheet').val('');
        $('#upgCoversheetModal').modal('hide');
        toastr.success("The upgrade coversheet was send it!","Success");
    }
}

function upgCoversheetSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendUPG"  aria-hidden="true">Send Upgrade Coversheet</button>';
        $('.attach-files').html(htmlBtn);
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendUPG',function(){
    if(filesToMerge.length>0){
        var recvdDate = $('#upgRcvdDate').val();
        var dueDate =$('#upgDueDate').val();
        var type = $('#typeCoversheet').val();
        ajaxCallback({
            'ID': currentProject.id,
            'FILES': filesToMerge,
            'TYPE':type,
            'DDATE':dueDate,
            'RDATE':recvdDate
        }, 'sendUpgCoversheet', 'sendUpgradeBack');
        $('#selectFilesToAttachModal').modal('hide');
    }else
        swal({title: "Please select the files to send.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
});

function sendUpgradeBack(result){
    if(result == -1){
        toastr.error("An error has happened, please try later","Error");
    }else{
        var fullDate =$.datepicker.formatDate('mm-dd-yy', new Date());
        $('#upgradeSentDate_'+currentProject.id).val(fullDate);
        $('#upgradeSentDate_'+currentProject.id).removeAttr("disabled");
        $('#upgradeSent_'+currentProject.id).prop('checked',true);
        $('#typeCoversheet').val('');
        $('#upgCoversheetModal').modal('hide');
        toastr.success("The upgrade coversheet was sent!","Success");
    }
}

function tmAllowanceSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        var selDate = "<div class='fileFound'><div class='col-md-2'><p>Select a date: </p></div> <div class='col-md-2'><input style='width: 100% !important;' type='text' class='pickDate' id='tmAllowanceDate_"+currentProject.id+"' ></div></div>"
        htmlFiles+=selDate;
        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendTMAll"  aria-hidden="true">Send Trademark Notice of Allowance</button>';
        $('.attach-files').html(htmlBtn);
        $('.pickDate').datepicker({});
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendTMAll',function(){
    var date = $('#tmAllowanceDate_'+currentProject.id).val();
    if(date != '') {
        ajaxCall({
            'ID': currentProject.id,
            'FILES': filesToMerge,
            'DATE': date
        }, 'trademarkAllowanceEmail', 'Trademark Notice of Allowance sent!!!', 'An error has happened, please try later');
        $('#selectFilesToAttachModal').modal('hide');
    }else
        swal({title: "Please select a date.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
});

function tmOfficeActSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });

        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendTMOffAct"  aria-hidden="true">Send Trademark Office Action</button>';
        $('.attach-files').html(htmlBtn);
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendTMOffAct',function(){
    ajaxCall({
        'ID': currentProject.id,
        'FILES': filesToMerge
    }, 'trademarkActionEmail', 'Trademark Office Action sent!!!', 'An error has happened, please try later');
    $('#selectFilesToAttachModal').modal('hide');

});


function nonFinalActionSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });

        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendNonFinalAct"  aria-hidden="true">Send Non Final Office Action</button>';
        $('.attach-files').html(htmlBtn);
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendNonFinalAct',function(){
    ajaxCall({
        'ID': currentProject.id,
        'FILES': filesToMerge
    }, 'noFinalActionEmail', 'Non Final Office Action sent!!!', 'An error has happened, please try later');
    $('#selectFilesToAttachModal').modal('hide');
});

function finalActionSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        var selDate = "<div class='fileFound'><div class='col-md-3'><p>Select received date: </p></div> <div class='col-md-2'><input style='width: 100% !important;' type='text' class='pickDate' id='finalARcvdDate_"+currentProject.id+"' ></div><div class='col-md-2'><p>Select due date: </p></div> <div class='col-md-2'><input style='width: 100% !important;' type='text' class='pickDate' id='finalADueDate_"+currentProject.id+"' ></div></div>"
        htmlFiles+=selDate;
        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendFinalAct"  aria-hidden="true">Send Final Office Action</button>';
        $('.attach-files').html(htmlBtn);
        $('.pickDate').datepicker({});
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendFinalAct',function(){
    var rcvdDate = $('#finalARcvdDate_'+currentProject.id).val();
    var dueDate =$('#finalADueDate_'+currentProject.id).val();
    if(rcvdDate!='' && dueDate!=''){
        ajaxCall({
            'ID': currentProject.id,
            'FILES': filesToMerge,
            'RDATE':rcvdDate,
            'DDATE':dueDate
        }, 'finalActionEmail', 'Final Office Action sent!!!', 'An error has happened, please try later');
        $('#selectFilesToAttachModal').modal('hide');
    }else
        swal({title: "Please select received and due date.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
});

function noticeAllowanceSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        var selDate = "<div class='fileFound'><div class='col-md-2'><p>Select due date: </p></div> <div class='col-md-2'><input style='width: 100% !important;' type='text' class='pickDate' id='noticeAllowanceDueDate_"+currentProject.id+"' ></div><div class='col-md-2'><p>Select fee amount: </p></div><div  class='col-md-2'><input type='number' id='feeAmnt_"+currentProject.id+"'></div></div>";

        htmlFiles+=selDate;

        var attorneys = $('#attorneys_'+currentProject.id).data('att');
        var selectInit = '<div class="fileFound"><div class="col-md-2"><p>Select Attorney</p></div><div class="col-md-3"><select id="selAtt_'+currentProject.id+'" style="height: 100%;">' +
            '<option value="-1" selected>NONE</option>';
        var selectEnd= '</select></div></div>';
        $.each(attorneys, function (i, attorney) {
            selectInit+='<option value="'+attorney.id+'">'+attorney.usr+'</option>';
        });
        selectInit+=selectEnd;

        htmlFiles+=selectInit;
        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendNoticeAll"  aria-hidden="true">Send Notice of Allowance</button>';
        $('.attach-files').html(htmlBtn);
        $('.pickDate').datepicker({});
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendNoticeAll',function(){
    var dueDate = $('#noticeAllowanceDueDate_'+currentProject.id).val();
    var feeAmnt = $('#feeAmnt_'+currentProject.id).val();
    var attId = $('#selAtt_'+currentProject.id).val();

    if(dueDate!='' && feeAmnt!='' && feeAmnt>0 && attId!="-1"){
        ajaxCall({
            'ID': currentProject.id,
            'FILES': filesToMerge,
            'DDATE':dueDate,
            'FEE':feeAmnt,
            'ATT':attId
        }, 'noticeAllowanceEmail', 'Notice Allowance (Patent) sent!!!', 'An error has happened, please try later');
        $('#selectFilesToAttachModal').modal('hide');
    }else
        swal({title: "Please select due date, fee amount and attorney.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
});

function pctAgreementSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';
        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendPCTAgreement"  aria-hidden="true">Send PCT FILING RECEIPT</button>';
        $('.attach-files').html(htmlBtn);
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendPCTAgreement',function(e){
    if(filesToMerge.length>0){
        ajaxCall({
            'ID': currentProject.id,
            'FILES': filesToMerge
        }, 'emailPCTAgreement', 'PCT Agreement sent!!!', 'An error has happened, please try later');
        $('#selectFilesToAttachModal').modal('hide');
    }else
        swal({title: "Please select the files to send.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
});

function pctAppSelectFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-3">Select the files to attach</span></div>';
        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge col-md-2'data-filename='"+file.fileName+"' data-id='"+file.id+"'>"+
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        $('.container-files-attach').html(htmlFiles);
        var htmlBtn = '<button class="btn btn-primary" id="sendPCTApp"  aria-hidden="true">Send PCT Application</button>';
        $('.attach-files').html(htmlBtn);
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','#sendPCTApp',function(e){
    if(filesToMerge.length>0){
        ajaxCall({
            'ID': currentProject.id,
            'FILES': filesToMerge
        }, 'emailPCTApplication', 'PCT Application sent!!!', 'An error has happened, please try later');
        $('#selectFilesToAttachModal').modal('hide');
    }else
        swal({title: "Please select the files to send.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
});

$(document).on('click','#sendUpgCoversheet',function(){
    var recvdDate = $('#upgRcvdDate').val();
    var dueDate =$('#upgDueDate').val();
    var type = $('#typeCoversheet').val();
    if(dueDate != '' && recvdDate != ''){
        ajaxCallback({'ID':currentProject.id,'TYPE':type,'DDATE':dueDate,'RDATE':recvdDate},'sendUpgCoversheet','sendUpgback');
    }else
        swal({title: "Please select the received and the due date.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
});

function backUpgCoversheet(result){
    if(result == -1)
        toastr.error('An error has happenned, please tr later.','Error');
    else if(result == -2){
        swal({title: "This project don't have a Provisional Patent App Filing Date!!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
    else{
        $('#upgRcvdDate').val(result[0]);
        $('#upgDueDate').val(result[1]);
        $('#upgCoversheetModal').modal('show');
    }

}

// set Copyright Filing Attorney && Trademark Filing Attorney
$(document).on('change','.selectPatentType',function(e){
    var type=$(this).val();
    ajaxCall({'ID':currentProject.id,'TYPE':type},'selectPatentType','Patent Application type changed','An error has happened');

});


//add attachment to revision to attorney
$(document).on('click','.attachFileRevision',function(){
    $('#emailCSModal').modal('hide');
    command = 'revision';
    //search the files available for ilc
    ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','paintFoundFilesRevision');
});

//Show a modal with all the files
function paintFoundFilesRevision(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '';
        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge pull-left' data-id='"+file.id+"'>"+
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.fileName+"'>" +
            "<span class='col-md-6'><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        $('.attach-files').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });
        $('#selectFilesToAttachModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

var command;
$(document).on('hidden.bs.modal', '#emailCSModal, #emailToVendorsModal', function(){
    filesToMerge=[];
});





//paint the files selected for send revision to attorney
function backGetFilesRevision(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.','Error');
    else{
        var html ='';
        for(var i=0; i< result.length;i ++){
            html+='<div id="attachmeCont_'+result[i].id+'" class="col-md-8"><p class="pull-left">'+result[i].fileName+'</p> <i class="fa fa-remove rmvFromSelectedF" style="color: red;cursor: pointer;"  data-fid="'+result[i].id+'"></i></div>';
        }
        $('#attachments-container-revision').html(html);
    }
    $('#emailCSModal').modal('show');
}

$(document).on('click','.rmvFromSelectedF',function(){
    var fid =$(this).data('fid');
    var index = filesToMerge.indexOf(fid);
    if(index>-1){
        filesToMerge.splice(index,1);
        $('#attachmeCont_'+fid).remove();
    }
});

$(document).on('click','#sendRevision',function(){
    var emailCommand = $(this).data('command');
    if(emailCommand == 'revision'){
        var text =  $('#revisionNotes').val();
        var type ='';
        if($('#revisionUT').is(":checked")){
            type = 'UT';
        }else if($('#revisionDESIGN').is(":checked")){
            type = 'DESIGN';
        }else if($('#revisionPROV').is(":checked")){
            type = 'PROV';
        }else if($('#revisionUPG').is(":checked")){
            type = 'UPG_UT';
        }
        if(type == ''){
            toastr.error("You must select a type.", "You had forgotten something!");
            $('#chooseType').css('border-color','red');
        }else if(text == ''){
            toastr.error("Notes are empty.", "You had forgotten something!");
        }else{
            var replace = text.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br/><br/>');
            ajaxCallback({'PID':currentProject.id,'FILES':filesToMerge,'NOTES':replace,'TYPE':type},'returnPatentAppByClientServices','revisionToAttBack')
        }
    }else if(emailCommand == 'client'){
        var text =  $('#revisionNotes').val();
        if(text == ''){
            toastr.error("The email body is empty.", "You had forgotten something!");
        }else{
            ajaxCallback({'PID':currentProject.id,'FILES':filesToMerge,'NOTES':text},'responseFromPsuToClients','emailToClientBack')
        }
    }
});

function revisionToAttBack(result){
    if(result == -1)
        toastr.error("An error has happened,please try later.", "Error");
    else{
        $('#emailCSModal').modal('hide');
        toastr.success("Revision to attorney sent!!", "Success");
    }
}

function emailToClientBack(result){
    if(result == -1)
        toastr.error("An error has happened,please try later.", "Error");
    else{
        $('#emailCSModal').modal('hide');
        toastr.success("Email to client sent!!", "Success");
    }
}

$(document).on('click','#revisionUT',function(){
    if($(this).is(":checked")){
        $('#revisionDESIGN').prop('checked', false);
    }
});

$(document).on('click','#revisionDESIGN',function(){
    if($(this).is(":checked")){
        $('#revisionUT').prop('checked', false);
    }
});

$(document).on('change','#selectVendor',function(){
    if($(this).val() == 0)
        $('#emailToVendor').val('');
    else
        $('#emailToVendor').val($(this).val());
});

//add attachment to email to vendor
$(document).on('click','.attachFileToVendor',function(){
    $('#emailToVendorsModal').modal('hide');
    command = 'toVendor';
    //search the files available for ilc
    ajaxCallback({'ID':currentProject.id},'loadFilesAdmin','paintFoundFilesRevision');
});

//paint the files selected for send email to vendor
function backGetFilesToVendor(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.','Error');
    else{
        var html ='';
        for(var i=0; i< result.length;i ++){
            html+='<div id="attachmeCont_'+result[i].id+'" class="col-md-8"><p class="pull-left">'+result[i].fileName+'</p> <i class="fa fa-remove rmvFromSelectedF" style="color: red;cursor: pointer;"  data-fid="'+result[i].id+'"></i></div>';
        }
        $('#attachments-container-toVendor').html(html);
    }
    $('#emailToVendorsModal').modal('show');
}

//send the email to vendor
$(document).on('click','#sendEmToVendor',function(){
    var email = $.trim($('#emailToVendor').val());
    var subj = $('#subjEmToVendor').val();
    var text =  $('#bodyToVend').val();
    var from =  $(this).data('from');
    if(email == ''){
        toastr.error("The email is empty.", "You had forgotten something!");
    }else if($.trim(subj) == ''){
        toastr.error("The subject is empty.", "You had forgotten something!");
    }else if($.trim(text) == ''){
        toastr.error("The email body is empty.", "You had forgotten something!");
    }else{
        ajaxCallback({'PID':currentProject.id,'FILES':filesToMerge,'NOTES':text,'EMAIL':email,'SUBJ':subj,'FROM':from},'sendEmailToVendor','emailToVendorBack')
    }
});

function emailToVendorBack(result){
    if(result == -1)
        toastr.error("An error has happened,please try later.", "Error");
    else{
        $('#emailToVendorsModal').modal('hide');
        toastr.success("Email to vendor sent!!", "Success");
    }
}