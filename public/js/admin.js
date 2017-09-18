var currentProject,currentRequest;
$(document).ready(function(e){
    setInterval("loadNewRequest()", 60000);
    currentProject = {id:-1};
    currentRequest = {id:-1};
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    portletEvents();
});

//Return the id of the current project.
function getCurrentProject(){
    return currentProject.id;
}

//Return the phone of the Consultant.
function getCurrentRequest(){
    return currentRequest;
}

//events for portlets
function portletEvents()
{
   //set the current project as selected
    $(document).on('click','.portlet',function(e){

        if(currentRequest.id!=$(this).data('request-id'))
        {
            currentProject = {
                id:$(this).data('id'),
                phone:$('#phone_p_'+$(this).data('id')).html(),
                email:$('#email_p_'+$(this).data('id')).html()
            };
            currentRequest= {
                id:$(this).data('request-id')
            };

            $('.inputCurrentPhone').val(currentProject.phone);
            $('.portlet-selected').removeClass('portlet-selected');
            $(this).addClass('portlet-selected');
        }
    });

    //approve, reject or NMI
    $(document).on('click','.adminActions',function(e){
        var id = $(this).data('requestid');
        var value = $(this).data('action');
        ajaxCallback({'REQUEST':id,'VALUE':value},'changeRequestStage',"adminActionsCallback");
    });

    //change the internal notes textarea background when it is active
    $(document).on('focusin','.adminNotes',function(e){
        $(this).css('background-color','aliceblue');
        currentProject.adminNotes = $(this).val();
    });

    //save internal notes in the DB
    $(document).on('focusout','.adminNotes',function(e){
        var requestId = $(this).data('requestid');
        var notes =  $(this).val();
        if(notes!=currentProject.adminNotes)
            ajaxCall( {'REQUEST':requestId,'NOTES':notes},'saveAdminNotes',"Notes updated successfully.","We couldn't updated the notes, please try later");
        $(this).css('background-color','antiquewhite');
        currentProject.adminNotes="";
    });

    //print business profile
    $(document).on('click','.printBusiness',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printBusinessProfileAdmin?ID="+id);
    });

    //available for vendors
    $(document).on('click','.checkVendor',function(e){
        var projectId = $(this).data("projectid");
        var isChecked=$(this).is(":checked");
        ajaxCall( {'PROJECT':projectId,'VALUE':isChecked},'saveAvailableForVendors',"Saved","Sorry, try later");
    });

    //print project
    $(document).on('click','.printProject',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printProjectAdmin?ID="+id);
    });

    //Load all accessible files for a project
    $(document).on('click','.openFilesAdmin',function(e){
        var id = $(this).data('id');
        ajaxCallback({'ID':id},'loadFilesAdmin','paintFoundFiles');
    });

    //show the uploadFilesAdmin modal.
    $(document).on('click','.uploadFilesAdmin',function(e){
        myDropzone.removeAllFiles(true);
        $('#uploadFileModal').modal('show');
    });

    //combo the admin options
    $('#selectOptionAdmin').change(function(e){
        optionAdmin($(this).val());
    });
}
//alert vendors check
function vendorAvailableAnswer(result)
{
    if(result==1)
        toastr.success("Project updated successfully","Success!!");
    if(result==-1)
        toastr.error("We couldn't updated the Project, please try later","Error!!");
    if(result==-2)
        toastr.error("We couldn't updated the Project. This file is currently used for Production Department, please contact them","Error!!");
}
//Show a modal with all the files
function paintFoundFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"> <span class="col-md-1">INTERNAL</span><span class="col-md-1">PUBLIC</span><span class="col-md-1">VENDOR</span><span class="col-md-1">CLIENT-LEGAL</span><span class="col-md-7"></span></div>';
        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFileAccess col-md-1' data-id='"+file.id+"' data-action='internal' "+(file.internal == 1?'checked':'')+">"+
            "<input type='checkbox' class='checkFileAccess col-md-1' data-id='"+file.id+"' data-action='public' "+(file.public == 1?'checked':'')+">"+
            "<input type='checkbox' class='checkFileAccess col-md-1' data-id='"+file.id+"' data-action='vendor' "+(file.vendor == 1?'checked':'')+">"+
            "<input type='checkbox' class='checkFileAccess col-md-1' data-id='"+file.id+"' data-action='clientVendor' "+(file.clientVendor == 1?'checked':'')+">"+
            "<input type='button' class='deleteFile btn btn-primary col-md-1 pull-right' value='delete' data-id='"+file.id+"'>" +
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.fileName+"'>" +
            "<span class='col-md-4'><strong>"+file.fileName+"</strong></span>" +
            "<span class='col-md-2'><strong>"+file.created_at.split(" ")[0]+"</strong></span>" +
            "</div>";
        });
        $('.container-founds').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });

        $('.checkFileAccess').click(function(e){
            var fileId = $(this).data("id");
            var type = $(this).data("action");
            var isChecked=$(this).is(":checked");
            ajaxCall( {'FILE':fileId,'COL':type,'VALUE':isChecked},'saveFileAccess',"Access updated successfully.","We couldn't updated the access for this file, please try later");
        });

        $('.deleteFile').click(function(e){
            var fileId = $(this).data("id");
            ajaxCallback({'FILE':fileId},'deleteFiles','deleteFilesCallback');
        });

        $('#filesModalAdmin').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

//paint projects from Find Sub
function adminActionsCallback(id){
    if(id== "-1"){
        toastr.error("We couldn't save this action, please try later","Error!!");
    }else if(id== "-2"){
        toastr.error("We couldn't save this action, because another admin take action first over this project.","Error!!");
        $("#container_"+id).fadeOut(600, function(){
            $(this).remove();
        });
    }else {
        $("#container_"+id).fadeOut(600, function(){
            $(this).remove();
        });
    }
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

//Features that admin has in his view.
function optionAdmin(value){
    $("#adminActionForm").trigger('reset');
    switch (value){
        case 'C-L':
            ajaxCallback('','allConsultants','allConsultantsCreateLeadCallback');
            break;
        case 'C-S':
            $('.reassignAdminActionForms').css('display','none');
            $('.reassignAdminActionAllForms').css('display','none');
            $('.createLeadAdminAction').css('display','none');
            $('#selectOptionAdmin').val(0);
            $('#adminActionModal .modal-title').html('CREATE SUBMISSION');
            $('.createSubAdminAction').css('display','block');
            $('.filenoDivAdminAction').css('display','block');
            $('#adminActionModal').modal('show');
            break;
        case 'E-L':
            $('.createLeadAdminAction').css('display','none');
            $('.reassignAdminActionForms').css('display','none');
            $('.reassignAdminActionAllForms').css('display','none');
            $('.createSubAdminAction').css('display','none');
            $('.filenoDivAdminAction').css('display','block');
            $('#selectOptionAdmin').val(0);
            $('#adminActionModal .modal-title').html('EXCLUDE LEAD');
            $('#adminActionModal').modal('show');
            break;
        case 'R-L':
            ajaxCallback('','allConsultants','allConsultantsReassignLeadCallback');
            break;
        case 'R-A':
            $('#consultantList').text('');
            $('#consultantList').val('');
            ajaxCallback('','allConsultants','allConsultantsReassignAllLeadCallback');
            break;
    }

    $('#submitAdminAction').unbind().click(function(e){
        var fileno  = $('#filenoAdminAction').val();
        if($('#adminActionModal .modal-title').html() == 'EXCLUDE LEAD'){
            if(fileno != ""){
                ajaxCall({'FILENO':fileno},'adminDeleteLead',"Lead removed successfully.","We couldn't removed the lead, please try later");
            }else{
                toastr.error("Something is missing.","Error!!");
            }
        }else if($('#adminActionModal .modal-title').html() == 'CREATE SUBMISSION'){
            var idea  = $('#ideaNameAdminAction').val();
            if(fileno != "" && idea != ""){
                ajaxCall({'FILENO':fileno, 'IDEANAME':idea},'adminCreateSub',"Submission created successfully.","We couldn't created the submission, We can't find the lead or there is another submission for this file");
            }else{
                toastr.error("Something is missing.","Error!!");
            }

        }else if($('#adminActionModal .modal-title').html() == 'REASSIGN LEAD'){
            var consultantId = $('#selectConsultantAdmin').val();
            var reason = $('#reasonAdminAction').val();
            if(fileno != "" && reason != ""){
                ajaxCall({'FILENO':fileno, 'CONSULTANT':consultantId, 'REASON':reason},'reassignLead',"Lead Reassigned successfully.","We couldn't reassign the Lead., There is no lead with that fileno.");
            }else{
                toastr.error("Something is missing.","Error!!");
            }

        }else if($('#adminActionModal .modal-title').html() == 'CREATE LEAD'){
            var fname = $('#fnameAction').val();
            var lname = $('#lnameAction').val();
            var email = $('#emailAction').val();
            var phone = $('#phoneAction').val();
            var street = $('#streetAction').val();
            var street2 = $('#street2Action').val();
            var city = $('#cityAction').val();
            var state = $('#stateAction').val();
            var zip = $('#zipAction').val();
            var consultantId = $('#selectConsultantCreateLeadAdmin').val();
            if(fname != "" && lname != "" && email != "" && phone != "" && street != "" && city != "" && state != "" && zip != "" && consultantId != "16"){
                ajaxCall({'FILENO':fileno, 'CONSULTANT':consultantId, 'FNAME':fname, 'LNAME':lname, 'EMAIL':email, 'PHONE':phone, 'STREET':street, 'STREET2':street2, 'CITY':city, 'STATE':state, 'ZIP':zip},'createNewLeadAdmin',"Lead Created successfully.","We couldn't create the Lead, Information Repeated.");
            }else{
                toastr.error("Something is missing.","Error!!");
            }

        }else if($('#adminActionModal .modal-title').html() == 'REASSIGN MORE LEAD'){
            var toConsultantId = $('#selectToConsultantAdmin').val();
            var fromConsultantId = $('#selectFromConsultantAdmin').val();
            var reason = $('#reasonAdminAction').val();
            var amount = $('#amountAdminAction').val();
            var all = $('#reassignAdminAllLeads').is(':checked');
            var random = $('#reassignAdminRandom').is(':checked');
            if(all == false && amount == ''){
                toastr.error("You need an amount of leads or check all the leads.","Error!!");
                return;
            }
            if(random == false && toConsultantId <=0){
                toastr.error("Please select a consultant to assign the leads or select random.","Error!!");
                return;
            }
            if(fromConsultantId > 0){
                $('#reassignMessage').attr('consultant',fromConsultantId);
                ajaxCallback({'FROM':fromConsultantId, 'TO':toConsultantId, 'RANDOM':random, 'REASON':reason, 'AMOUNT':amount, 'ALL':all},'reassignAllLead',"reassignAllLeadCallback");
                $('#adminActionModal').css('z-index','9998');
                $('#adminLoadingModal').modal('show');
            }else{
                toastr.error("Something is missing.","Error!!");
            }

        }
    });
}

//show modal with fields to reassign one lead
function allConsultantsReassignLeadCallback(users){
    var select = '<label class="control-label col-md-4">TO</label><div class="col-md-8"><select  id="selectConsultantAdmin"><option value="0">SELECT_CONSULTANT</option>';
    $.each(users,function(key,user){
           select +='<option value="'+user.id+'">'+user.usr+'</option>';
    });
    select +='</select></div>';
    $('.reassignAdminAction').html(select);
    $('.createSubAdminAction').css('display','none');
    $('.createLeadAdminAction').css('display','none');
    $('.reassignAdminActionAllForms').css('display','none');
    $('#selectOptionAdmin').val(0);
    $('.reassignAdminActionForms').css('display','block');
    $('.filenoDivAdminAction').css('display','block');
    $('#adminActionModal .modal-title').html('REASSIGN LEAD');
    $('#adminActionModal').modal('show');
}

//after reassign all leads see if left submissions
function reassignAllLeadCallback(count){
    $('#adminActionModal').css('z-index','9999');
    $('#adminLoadingModal').modal('hide');
    if(count > 0){
        $('#reassignMessage').html("You need to reassign "+count+" submission from this consultant.");
        $('#reassignMessage').attr('sub',count);
        ajaxCallback('','allConsultants','reassignAllSubsCallback');
    }else if(count == -1){
        swal({title: "Action completed successfully.",
            type: "info",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }else{
        swal({title: "Sorry, the task was partially completed because "+Math.abs(count + 1)+" of the leads has a submission.",
            type: "info",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
}

//show modal with fields to reassign all subs
function reassignAllSubsCallback(users){
    var select = '<label class="control-label col-md-4">TO</label><div class="col-md-8"><select  id="selectConsultantAdmin"><option value="0">SELECT_CONSULTANT</option>';
    $.each(users,function(key,user){
        select +='<option value="'+user.id+'">'+user.usr+'</option>';
    });
    select +='</select></div>';

    $('.reassignAdminCombo').html(select);
    $('#adminActionModal').modal('hide');
    $(document).on('click','#addConsultantFromCombo',function(action){
        event.preventDefault();
        event.stopPropagation();
        if($('#consultantList').text() != '' && $('#consultantList').text().split(",").length + 1 > $('#reassignMessage').attr("sub")){
            swal({title: "You reach the maximum number of consultants,because the number of consultants can't be greater than the number of subs. ",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }else if ($('#consultantList').text().indexOf($('#selectConsultantAdmin').val()) >= 0){
            swal({title: "you have that user in the list already.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
        }else{
            if($('#consultantList').val() == ''){
                $('#consultantList').val($('#selectConsultantAdmin :selected').text());
                $('#consultantList').text($('#selectConsultantAdmin').val());
            }else{
                $('#consultantList').val($('#consultantList').val()+','+$('#selectConsultantAdmin :selected').text());
                $('#consultantList').text($('#consultantList').text()+','+$('#selectConsultantAdmin').val());
            }
        }
    });
    $(document).on('click','#reassignAllSubmit',function(action){
        if ($('#consultantList').text() != ''){
            var list = $('#consultantList').text()
            var amount = $('#reassignMessage').attr("sub");
            var from = $('#reassignMessage').attr('consultant')
            ajaxCallback( {'LEADS':amount,'FROM':from,'TO':list},'reassignAllLeadWithSub','reassignAllLeadWithSubCallback');
            $('#adminReassignLeadWithSubModal').css('z-index','9998');
            $('#adminLoadingModal').modal('show');
        }else{
            swal({title: "you need at least one user in the list.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }
    });
    $('#adminReassignLeadWithSubModal').modal('show');
}

function reassignAllLeadWithSubCallback(){
    $('#adminLoadingModal').modal('hide');
    $('#adminReassignLeadWithSubModal').modal('hide');
    swal({title: "Action completed successfully.",
        type: "info",
        showCancelButton: false,
        confirmButtonText: "Ok",
        closeOnConfirm: true });
}

//show modal with fields to reassign one lead
function allConsultantsReassignAllLeadCallback(users){
    var selectTo = '<label class="control-label col-md-4">TO</label><div class="col-md-8"><select  id="selectToConsultantAdmin"><option value="0">SELECT_CONSULTANT</option>';
    var selectFrom = '<label class="control-label col-md-4">FROM</label><div class="col-md-8"><select  id="selectFromConsultantAdmin"><option value="0">SELECT_CONSULTANT</option>';

    var options = '';
    $.each(users,function(key,user){
        options +='<option value="'+user.id+'">'+user.usr+'</option>';
    });
    selectTo += options+'</select></div>';
    selectFrom += options+'</select></div>';

    $('.reassignAdminAction').html(selectFrom);
    $('.reassignAdminAll').html(selectTo);
    $('.createSubAdminAction').css('display','none');
    $('.createLeadAdminAction').css('display','none');
    $('.filenoDivAdminAction').css('display','none');
    $('#selectOptionAdmin').val(0);
    $('.reassignAdminActionForms').css('display','block');
    $('.reassignAdminActionAllForms').css('display','block');
    $('#adminActionModal .modal-title').html('REASSIGN MORE LEAD');
    $('#adminActionModal').modal('show');
}

//show modal with fields to create one lead
function allConsultantsCreateLeadCallback(users){
    var select = '<label class="control-label col-md-4">Assign To</label><div class="col-md-8"><select  id="selectConsultantCreateLeadAdmin"><option value="0">SELECT_CONSULTANT</option>';
    $.each(users,function(key,user){
        select +='<option value="'+user.id+'">'+user.usr+'</option>';
    });
    select +='</select></div>';
    $('.consultantsComboAdminAction').html(select);
    $('.reassignAdminActionForms').css('display','none');
    $('.reassignAdminActionAllForms').css('display','none');
    $('.createSubAdminAction').css('display','none');
    $('#selectOptionAdmin').val(0);
    $('#adminActionModal .modal-title').html('CREATE LEAD');
    $('.createLeadAdminAction').css('display','block');
    $('#adminActionModal').modal('show');
}

//expande or collapse the Find Sub input
$("#inputFindSub").expandable({
    width: 180,
    duration: 300
});

//Call to find Project when is pressed  enter key and Search Projects by fname, lname, phone, email or fileno
$("#inputFindSub").keypress(function(e) {
    if(e.which == 13 && $(this).val().length>0)
        ajaxCallback({'PARAMS':$(this).val().trim()},'findProjectAdmin','paintFoundProjectsAdminCallback');
});

//paint projects from Find Sub
function paintFoundProjectsAdminCallback(projects){
    if(projects.length>0)
    {
        //Hide the current portlets
        $('.container-portlets').css('display','none');
        //Clean the container for previous search
        $('.container-added-portlets').html('');
        for(var i =0;i<projects.length;i++){
            var project = $(projects[i]);
            //if exists the portlet searched in the current view, move it for the search result view
            if($('#container_'+project.data('request-id')).length>0)
            {
                //add a field called exists to know if it was showed previously
                project.data('exists','1');
                $('#container_'+project.data('request-id')).remove();
            }
            $('.container-added-portlets').append(project);
        }
        //unselected all the projects in the view
        $('.portlet-selected').removeClass('portlet-selected');
        currentProject = {id:-1};
        currentRequest = {id:-1};
        $('.container-portlets-found').css('display','inline');
    }
    else
        toastr.error('Sorry no matches',"No Matches");
}

//Close search result box and show again portlets
$('.close-portlets-found').click(function(e){
    $('.container-added-portlets').find( ".portlet").each(function(e){
        if($(this).data('exists')==1){
            var portlet = $(this);
            $('.container-portlets').append(portlet);
        }
    });
    $('.portlet-selected').removeClass('portlet-selected');
    currentProject = {id:-1};
    currentRequest = {id:-1};
    $('.container-portlets').css('display','inline');
    $('.container-portlets-found').css('display','none');
    $('.container-added-portlets').html('');
    $('#inputFindSub').val('');
});

//search for the unloaded leads
function loadNewRequest(){
    ajaxCallback('','loadNewRequest','paintNewRequest');
}

//Paint new request inside container-leads
function paintNewRequest(result){
    var cont = parseInt($('#contractsToMail').html()) + parseInt(result.contracts);
    $('#contractsToMail').html(cont);
    var projects = result.request;
    for(var i =0;i<projects.length;i++){
        $('.container-portlets').append(projects[i]);
    }
}


//search for the contract for print
$('#btnContracts').click(function(e){
    ajaxCallback('','loadNewContract','loadNewContractCallback');
});

//search for the contract for print
function loadNewContractCallback(contracts){
    var htmlFiles = '';
    if(contracts.length>0)
    {
        $.each(contracts,function( key,file )
        {
            htmlFiles+="<div id='contractFound_"+file.id+"' class='contractFound'> " +
            "<input type='button' class='sendContract btn btn-primary col-md-2 pull-right' value='Mark As Sent' data-id='"+file.id+"'>" +
            "<span class='col-md-2'><strong>"+file.clientName+"</strong></span>" +
            "<span class='col-md-4'><strong>"+file.clientAddress+"</strong></span>" +
            "<span class='col-md-2'><strong>"+file.fileName+"</strong></span>" +
            "<input type='button' class='showContract btn btn-primary col-md-1' value='open' data-url='"+file.url+"' data-name='"+file.fileName+"'>" +
            "</div>";
        });
        $('.container-founds-contract').html(htmlFiles);

        $('.showContract').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });

        $('.sendContract').click(function(e){
            var requestId = $(this).data("id");
            ajaxCall( {'REQUEST':requestId},'saveSendContract',"Contract updated successfully.","We couldn't updated the contract, please try later");
            $("#contractFound_"+requestId).fadeOut(600, function(){
                $(this).remove();
            });
            var cont = parseInt($('#contractsToMail').html()) - 1;
            $('#contractsToMail').html(cont);
        });

        $('#adminContractModal').modal('show');
    }
    else
        toastr.error('There is no contracts to print.',"No Contracts");
}

//expande or collapse the who's input
$("#whoString").expandable({
    width: 180,
    duration: 300
});

//Call to find leads when is pressed  enter key
$("#whoString").keypress(function(e) {
    if(e.which == 13 && $(this).val().length>0)
        whoIsThis($(this).val().trim());
});

//Search leads by fname, lname, phone, email or fileno
function whoIsThis(params)
{
    ajaxCallback({'PARAMS':params},'findLeadAdmin','paintFoundLeads');
}
//Show a modal with the result of search leads by some params
function paintFoundLeads(leads)
{
    var htmlFounds = "<div col-md-12'> " +
        "<span class='col-md-2'><strong>FILENO</strong></span>" +
        "<span class='col-md-7'><strong>NAME & PHONE</strong></span>" +
        "<span class='col-md-2'><strong>CONSULTANT</strong></span>" +
        "</div>";
    if(leads.length>0)
    {
        $.each(leads,function( key,lead )
        {
            htmlFounds+="<div id='leadFound_"+lead.id+"' class='leadFound col-md-12'> " +
            "<span class='col-md-2'><strong>"+lead.fileno+"</strong></span>" +
            "<span class='col-md-7'>"+lead.fname+" "+lead.lname+" --- "+lead.phone+"</span>" +
            "<span class='col-md-2'>"+lead.user+"</span>" +
            "</div>";
        });
        $('.container-founds').html(htmlFounds);
        $('#whoIsThisModal').modal('show');
    }
    else
        toastr.error('Sorry no matches',"No Matches");
}


