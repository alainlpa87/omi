var consultantPhone,currentForm,currentProject,currentDate,prices= null;
$(document).ready(function(e){
    callIntervalFunction();
    setInterval("callIntervalFunction()", 60000);
    initializeDateTimePicker();
    currentProject = {id:-1};
    currentDate = new Date();
    consultantPhone = $('#userDID').html();
    prices=[];
    prices['IMG']=-1;
    prices['IIG']=-1;
    prices['UPGRADE']=-1;
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    portletEvents();
    initializeDateTimePickerMoveToDate();
    $('.priceContract').autoNumeric('init');
    //when date changed in the paginator date show or hide portlets
    var pagOptions = {
        onSelectedDateChanged: function(event, date) {
            currentDate = new Date(date);
            $.each($('.portlet'),function(value){
                var datePortlet = $(this).data('date-action');
                var dateCompare = new Date(datePortlet);
                if(dateCompare>currentDate)
                    $('#container_'+$(this).data('id')).addClass('actionDateBigger');
                else
                    $('#container_'+$(this).data('id')).removeClass('actionDateBigger');
            });
            currentProject = {id:-1};
            $('.portlet-selected').removeClass('portlet-selected');
            javascriptRecount();
        }};
    $('#paginator').datepaginator(pagOptions);
    createLastVisitedBox("");

});
//create the boz with the last 15 projects worked when a new project is selected
function createLastVisitedBox(newValue)
{
    $('.container-last').html('');
    var lastVisited = localStorage.getItem("lastVisited")?localStorage.getItem("lastVisited").split('-'):[];
    lastVisited = jQuery.grep(lastVisited, function(value) {
        return value != newValue;
    });
    var newLastVisited = "";
    if(newValue>0)
        lastVisited.unshift(newValue);
    for(var i=0;i<Math.min(15,lastVisited.length);i++)
    {
        var id =lastVisited[i];
        var portlet = $('#container_'+id);
        var fileno =  portlet.data('fileno');
        var pHtml = "<p class='lastProjectVisited' data-id='"+id+"'>"+fileno+"</p>";
        newLastVisited += newLastVisited.length>0?"-"+lastVisited[i]:lastVisited[i];
        $('.container-last').append(pHtml);
    }
    localStorage.setItem("lastVisited",newLastVisited);
}
//call all our interval function
function callIntervalFunction(){
    loadNewProjects();
    loadAppointments();
    mailsys();
    leaders();
    requestsys();
    lastPaidsys();
}

//initialize DateTimePicker
function initializeDateTimePickerMoveToDate(){
    $(".dateMove").datepicker({
        isRTL: 'false',
        format: "mm-dd-yyyy",
        showMeridian: true,
        autoclose: true,
        pickerPosition: "bottom-left",
        todayBtn: true
    });
}

//Return the id of the current project.
function getCurrentProject()
{
    return currentProject.id;
}

//Return the phone of the Consultant.
function getCurrentConsultantPhone()
{
    return consultantPhone;
}

//Assign a new value to the consultant phone
function setCurrentConsultantPhone(phone)
{
    consultantPhone=phone;
}

//events for portlets
function portletEvents()
{
   //Save in the DB the notes typed for the lead owner of the submission
    $(document).on('click','.btnUpdateNotes',function(e){
        var id = $(this).data('id');
        ajaxCall( {'ID':id,'NOTES':$('#notes_'+id).val()},'updateNotesProject',"Notes updated successfully.","We couldn't updated the notes, please try later");
    });

    //Call load Messages for a project from DB
    $(document).on('click','.btnInbox',function(e){
        var id = $(this).data('id');
        var data = {'LEAD':id};
        ajaxCallback(data,'loadInboxFromProject','paintInbox');
    });

    //Exclude a project
    $(document).on('click','.btnRemoveProject',function(e){
        var id = $(this).data('id');
        ajaxCall({'ID':id},'deleteProject',"Project excluded successfully.","We couldn't exclude the project, please try later");
        $('#container_'+id).remove();
        currentProject = {id:-1};
        javascriptRecount();
    });
    //Restore a Project
    $(document).on('click','.btnAddProject',function(e){
        var id = $(this).data('id');
        $('#container_'+id).data('exists','1');
        var button = $('#container_'+id).find('.btnAddProject');
        button.removeClass('btnAddProject');
        button.removeClass('btn-success');
        button.addClass('btnRemoveProject');
        button.addClass('btn-danger');
        button.html("EXCLUDE");
        ajaxCall({'ID':id},'restoreProject',"Project restored successfully","We couldn't restore the project, please try later");
        javascriptRecount();
    });

    //set the current project as selected
    $(document).on('click','.portlet',function(e){

        if(currentProject.id!=$(this).data('id'))
        {
            var id =$(this).data('id');
            var fileno =  $(this).data('fileno');
            currentProject = {
                id:id,
                phone:$('#phone_p_'+id).html(),
                email:$('#email_p_'+id).html(),
                fileno:fileno
            };
            $('.checkPhone').prop('checked', false);
            $('.inputCurrentPhone').val(currentProject.phone);
            $('.portlet-selected').removeClass('portlet-selected');
            $(this).addClass('portlet-selected');
            $('#selectSendEmailProject').val(0);
            createLastVisitedBox(id);
        }
    });

    $('#scriptToReed').change(function(e){
        if($('#scriptToReed').val() != 0){
            window.open($(this).val(),'_blank');
            $('#scriptToReed').val(0);
        }
    });

    //change stage
    $(document).on('click','.btnProjectStage',function(e){
        var id =$(this).data('id');
        $('#container_'+id).find( ".btnProjectStage").each(function(e){
            $(this).data('current',0);
        });
        $(this).data('current',1);
        $('#labelStage').html("Stage: "+$(this).html());
        $('#labelStage').data('stage',$(this).html());
        //$('#setStageAndDateModal').find('.modal-title').html('MOVE TO DATE: '+currentProject.fileno+", "+currentProject.id);
        $('#setStageAndDateModal').modal('show');
    });
    //change the active phone for the lead to make a call
    $(document).on('click','.checkPhone',function(e){
        var isChecked=$(this).is(":checked");
        var phone2 = $('#phone_p_'+currentProject.id+"_2").html();
        var phone1 = $('#phone_p_'+currentProject.id).html();
        if(isChecked)
        {
            if($('#phone_p_'+currentProject.id+"_2").data('checkable')==1 && phone2.length>0 )
            {
                currentProject.phone = phone2;
                $('.inputCurrentPhone').val(phone2);
            }
            else
                $(this).prop('checked', false);
        }
        else
        {
            currentProject.phone = phone1;
            $('.inputCurrentPhone').val(phone1);
        }
    });
//move and change stage
    $(document).on('click','.moveAndChangeStage',function(action)
    {
        var id = currentProject.id;
        var action = $(this).data('action');
        //change portlet to his new place in the view
        var portlet = $('#container_'+id);
        var stage =$('#labelStage').data('stage');
        $('#container_'+id).find( ".btnProjectStage").each(function(e){
            if($(this).data('current')==0)
            {
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-default');
            }
            else
            {
                $(this).removeClass('btn-default');
                $(this).addClass('btn-primary');
            }
        });
        $('#container_'+id).remove();
        $('.container-'+stage.toLowerCase()).find(".clear").before(portlet);
        initializeDateTimePickerMoveToDate();

        if(action==1)
        {
            var date = $('#dateMove_from_stage').val();
            if(date=="")
            {
                toastr.error("You have to select the date first.","Error!!!");
                return false;
            }
            $('#dateMove_'+id).val(date);
            var dateSplit = date.split('-');
            date =dateSplit[2]+"-"+dateSplit[0]+"-"+dateSplit[1];
            ajaxCall({'ID':id,'DATE':date},'moveToDateProject',"Project moved it successfully.","We couldn't change the action date, please try later");
            var dateCompare = new Date(date);
            portlet.data('date-action',date+" 00:00:00");
            $('#container_'+id).data('date-action',date+" 00:00:00");
            if(dateCompare>currentDate)
            {
                currentProject = {id:-1};
                javascriptRecount();
                portlet.addClass('actionDateBigger');
            }
            else
                portlet.removeClass('actionDateBigger');
            ajaxCall( {'ID':id,'NOTES':$('#notes_'+id).val()},'updateNotesProject',"","");
        }

        $('#container_'+id).each(function(e){
            $(this).removeClass('portlet-selected');
        });
        currentProject = {id:-1};
        ajaxCallback({'ID':id,'STAGE':stage},'updateStageProject','updateStageProjectCallback');
        $('#setStageAndDateModal').modal('hide');
    });
    //made a request for approval
    $(document).on('click','.approveBox',function(e){
        var id = $(this).data('id');
        ajaxCall({'ID':id,'REQUEST':'APPROVE','TYPE':'ADMIN'},'requestProject',"Approval request made it successfully.","We couldn't made the request, please try later");
        $('#request_p_'+id).html('REQUEST APPROVE: <span id="request_p_admin_'+id+'">N/A</span>');
    });

    //made a request for reject
    $(document).on('click','.rejectBox',function(e){
        var id = $(this).data('id');
        ajaxCall({'ID':id,'REQUEST':'REJECT','TYPE':'ADMIN'},'requestProject',"Reject request made it successfully.","We couldn't made the request, please try later");
        $('#request_p_'+id).html('REQUEST REJECT: <span id="request_p_admin_'+id+'">N/A</span>');
    });

    //change the action date
    $(document).on('click','.btnMoveToDate',function(e){
        var id = $(this).data('id');
        var date = $('#dateMove_'+id).val();
        if(date=="")
        {
            toastr.error("You have to select the date first.","Error!!!");
            return false;
        }
        var dateSplit = date.split('-');
        date =dateSplit[2]+"-"+dateSplit[0]+"-"+dateSplit[1];
        ajaxCall({'ID':id,'DATE':date},'moveToDateProject',"Project moved it successfully.","We couldn't change the action date, please try later");
        var dateCompare = new Date(date);
        $('#container_'+id).data('date-action',date+" 00:00:00");
        if(dateCompare>currentDate)
        {
            currentProject = {id:-1};
            javascriptRecount();
            e.stopPropagation();
            $('#container_'+id).addClass('actionDateBigger');
        }
        else
            $('#container_'+id).removeClass('actionDateBigger');
        ajaxCall( {'ID':id,'NOTES':$('#notes_'+id).val()},'updateNotesProject',"","");
    });

    //change the internal notes textarea background when it is active
    $(document).on('focusin','.internalNotes',function(e){
        $(this).css('background-color','aliceblue');
        currentProject.internalNotes = $(this).val();
    });
    //save internal notes in the DB
    $(document).on('focusout','.internalNotes',function(e){
        var id = $(this).data('id');
        var notes =  $(this).val();
        if(notes!=currentProject.internalNotes)
            ajaxCall( {'ID':id,'NOTES':notes},'updateInternalNotesProject',"Internal sales notes updated successfully.","We couldn't updated the internal sales notes, please try later");
        $(this).css('background-color','antiquewhite');
        currentProject.internalNotes="";
    });
    //change the sales invention notes textarea background when it is active
    $(document).on('focusin','.salesNotes',function(e){
        $(this).css('background-color','aliceblue');
        currentProject.salesNotes = $(this).val();
    });
    //save sales invention notes in the DB
    $(document).on('focusout','.salesNotes',function(e){
        var id = $(this).data('id');
        var notes =  $(this).val();
        if(notes!=currentProject.salesNotes)
            ajaxCall( {'ID':id,'NOTES':notes},'updateApprovalNotesProject',"Sales invention notes updated successfully.","We couldn't updated the sales invention notes, please try later");
        $(this).css('background-color','antiquewhite');
        currentProject.salesNotes="";
    });
    //made a request for client review
    $(document).on('click','.spanRequestClientReview',function(e){
        var id = $(this).data('id');
        ajaxCall({'ID':id,'REQUEST':'CLIENT REVIEW','TYPE':'CLIENT'},'requestProject',"Client review request made it successfully.","We couldn't made the request, please try later");
    });
    //print business profile
    $(document).on('click','.printBusiness',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printBusinessProfile?ID="+id);
    });
    //print project
    $(document).on('click','.printProject',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printProject?ID="+id);
    });
    //Load all accessible files for a project
    $(document).on('click','.btnFiles',function(e){
        var id = $(this).data('id');
        ajaxCallback({'ID':id},'loadFilesProject','paintFoundFiles');
    });
    //Load production Dates of shipment
    $(document).on('click','.productionShipmentDate',function(e){
        var id = $(this).data('id');
        ajaxCallback({'ID':id},'getProductionDates','showProductionDates');
    });
    // update logs
    $(document).on('click','.updateLogs',function(e){
        var id = $(this).data('id');
        ajaxCallback({'ID':id},'updateLogsProject','updateLogsCallback');
    });
    //enabled or disabled funding account
    $(document).on('click','.allowFundingCheckbox',function(e){
        var id =$(this).data('id');
        var request = $(this).is(":checked")?"ENABLED":"DISABLED";
        ajaxCallback({'ID':id,'REQUEST':request},'allowFundingProject','allowFunding');
    });
    //enabled or disabled PPA account
    $(document).on('click','.allowPPACheckbox',function(e){
        var id =$(this).data('id');
        var request = $(this).is(":checked")?"ENABLED":"DISABLED";
        ajaxCallback({'ID':id,'REQUEST':request},'allowPPAProject','allowPPA');
    });
    //enabled or disabled Half Price for PPA account
    $(document).on('click','.allowHalfPricePPAProject',function(e){
        var id =$(this).data('id');
        var request = $(this).is(":checked")?"ENABLED":"DISABLED";
        ajaxCall({'ID':id,'REQUEST':request},'allowHalfPricePPAProject',request=='ENABLED'?'PPA allow half price successfully.':'PPA disabled half price successfully.','We couldn\'t complete the action requested right now, please try later.');
    });
    //enabled or disabled ECHECK Payments
    $(document).on('click','.allowEcheckPayments',function(e){
        var id =$(this).data('id');
        var request = $(this).is(":checked")?"ENABLED":"DISABLED";
        ajaxCall({'ID':id,'REQUEST':request},'allowEcheckPayments',request=='ENABLED'?'Allow Echeck payments successfully.':'Disabled Echeck payments successfully.','We couldn\'t complete the action requested right now, please try later.');
    });
    //restore password show modal
    $(document).on('click','.btnResetP',function(e){
        var id =$(this).data('id');
        $('#email_to_pass').html($('#email_p_'+ id).text());
        $('#phone_to_pass').html($('#phone_p_'+ id).text());
        $('#lead_to_pass').val($('#container_'+ id).data('lead-id'));
        $('#resetPasswordModal').modal('show');
    });

    $(document).on('click','.requestMoreInfoReview',function(e){
        var id = $(this).data('id');
        ajaxCall({'ID':id},"requestNeedsMoreInfoReview","A request was sent to admin successfully.","We couldn't sent your request, please try later");
    });
}

//restore password submit
$('#resetPassSubmit').click(function(e){
    var lead = $('#lead_to_pass').val();
    var byEmail = $('#checkEmailPass').is(":checked");
    var byPhone = $('#checkMessagePass').is(":checked");
    if($('#checkEmailPass').is(":checked") || $('#checkMessagePass').is(":checked")){
        ajaxCall({'LEAD':lead, 'BYEMAIL':byEmail, 'BYPHONE':byPhone},"resetPassword","New Password sent successfully.","We couldn't sent the Password, please try later");
        $('#resetPasswordModal').modal('hide');
    }else{
        toastr.error("Select at least one option.","Error!!");
    }
});


//expande or collapse the Find Sub input
$("#inputFindSub").expandable({
    width: 180,
    duration: 300
});

//Call to find Project when is pressed  enter key and Search Projects by fname, lname, phone, email or fileno
$("#inputFindSub").keypress(function(e) {
    if(e.which == 13 && $(this).val().length>0)
        ajaxCallback({'PARAMS':$(this).val().trim(),'MOBILE':isMobile()?1:-1},'findProject','paintFoundProjectsCallback');
});

//eliminate the portlet if is an incubator or show a message.
function updateStageProjectCallback(id){
    if(id=="-2"){
        toastr.success('Stage update successfully.',"Success!!");
    }else if(id=="-1"){
        toastr.error("We couldn't update the stage.", "Please try later");
    }else{
        $('#container_'+id).remove();
    }
}

function showProductionDates(text){
    swal({title: text,
        type: "info",
        html:true,
        showCancelButton: false,
        confirmButtonText: "Ok",
        closeOnConfirm: true });
    return false;
}

//paint projects from Find Sub
function paintFoundProjectsCallback(projects)
{
    if(projects.length>0)
    {
        //Hide the current portlets
        $('.container-portlets').css('display','none');
        //Clean the container for previous search
        $('.container-added-portlets').html('');
        for(var i =0;i<projects.length;i++)
        {
            var project = $(projects[i]);
            project.removeClass('portlet-new');
            project.removeClass('actionDateBigger');
            //if exists the portlet searched in the current view, move it for the search result view
            if($('#container_'+project.data('id')).length>0)
            {
                //add a field called exists to know if it was showed previously
                project.data('exists','1');
                $('#container_'+project.data('id')).remove();
            }
            $('.container-added-portlets').append(project);
        }
        //unselected all the projects in the view
        $('.portlet-selected').removeClass('portlet-selected');
        currentProject = {id:-1};
        $('.container-portlets-found').css('display','inline');
        initializeDateTimePickerMoveToDate()
    }
    else
        toastr.error('Sorry no matches',"No Matches");
}

//Close search result box and show again portlets
$('.close-portlets-found').click(function(e){

    $('.container-added-portlets').find( ".portlet").each(function(e){
        if($(this).data('exists')==1)
        {
            stage="";
            var portlet = $(this);
            var datePortlet = portlet.data('date-action');
            var dateCompare = new Date(datePortlet);
            if(dateCompare>currentDate)
                portlet.addClass('actionDateBigger');
            $(this).find( ".btnProjectStage").each(function(e){
                if($(this).hasClass('btn-primary'))
                {
                    var stage = $(this).html();
                    $('.container-'+stage.toLowerCase()).find(".clear").before(portlet);
                }
            });
        }
    });
    $('.portlet-selected').removeClass('portlet-selected');
    currentProject = {id:-1};
    $('.container-portlets').css('display','inline');
    $('.container-portlets-found').css('display','none');
    $('.container-added-portlets').html('');
    $('#inputFindSub').val('');
});

//Show Send Article Modal when an article is selected to be send
$('#selectSendArticle').change(function(e){
    if(currentProject.id!=-1)
    {
        $('#article_to_link').html($("#selectSendArticle option:selected").text());
        $('#email_to_link').html(currentProject.email);
        $('#phone_to_link').html(currentProject.phone);
        $('#lead_to_link').val($('#container_'+currentProject.id).data('lead-id'));
        $('#lead_to_link').data('article',$("#selectSendArticle option:selected").attr('title'));
        $('.seeLinkArticle').attr('href','learn/'+$("#selectSendArticle option:selected").attr('title')+'#Portfolio');
        $('#sendArticleModal').modal('show');
    }
    else
        toastr.error("Select a Lead First.","Error!!");
    $('#selectSendArticle').val(0);

});
//Send an article link by email or phone text
$('#sendArticleLink').click(function(e){
    if($('#checkEmailArticle').is(":checked"))
    {
        ajaxCall({'LEAD':$('#lead_to_link').val(),'ARTICLE':$('#lead_to_link').data('article')},"sendLink","Link sent by email successfully.","We couldn't sent the link by email, please try later");
    }
    if($('#checkMessageArticle').is(":checked"))
    {
        ajaxCall({'FROM':consultantPhone,'TO':$('#phone_to_link').html(),'TITLE':$('#lead_to_link').data('article'),'COMMAND':'link'},"smsOut","Link sent by phone successfully.","We couldn't sent the link by phone, please try later");
    }
});
//Load contract action modal
$('#btnContractActions').click(function(e){
    var id = getCurrentProject();
    if(id==-1)
    {
        toastr.error("Select a Project First.","Error!!");
        return ;
    }
    ajaxCallback({'ID':id},'checkContractActionsProject','loadContractActionsModal');
});

//allow IIG Upgrades
$('#allowIigUpgrade').click(function(e){
    var checked = 0;
    if ($(this).prop('checked')){
        checked = 1;
    }
    ajaxCall({'ID':getCurrentProject(),'CHECKED':checked},'allowIigUpgrade',checked==1?'Allow IIG Upgrade Successfully.':'Allow IIG Upgrade Disabled.',"We couldn't process your request, please try later");
});

//load contract actions Modal
function loadContractActionsModal(actions)
{
    $('#allowIigUpgradeSpan').css('display','none');
    $('#allowIigUpgrade').prop( "checked", false );

    var contract=actions['contract'];
    var contract_img=actions['contract_img'];
    var upgrade=actions['upgrade'];
    var welcome_package=actions['welcome_package'];
    var soldIIG = actions['soldIIG'];

    if(soldIIG == -1){
        $('#allowIigUpgradeSpan').css('display','');
        $('#allowIigUpgrade').prop( "checked", true );
    }else if(soldIIG == 1){
        $('#allowIigUpgradeSpan').css('display','');
        $('#allowIigUpgrade').prop( "checked", false );
    }

    if(upgrade==contract&&contract==welcome_package&&welcome_package==0) {
        toastr.error('This project doesn\'t allow any contract action at this moment', "No Action");
        var state_zip = $('#state_p_' + getCurrentProject()).text().split(',');
        $('#contract_name').val($('#full_name_p_' + getCurrentProject()).text());
        $('#contract_email').val($('#email_p_' + getCurrentProject()).text());
        $('#contract_phone').val($('#phone_p_' + getCurrentProject()).text());
        $('#contract_phone2').val($('#phone_p_' + getCurrentProject() + '_2').text());
        $('#contract_invention').val($('#ideaname_' + getCurrentProject()).text());
        $('#contract_consultant').val($('#userDID').data('fname') + " " + $('#userDID').data('lname'));
        $('#contract_address').val($('#address_p_' + getCurrentProject()).text());
        $('#contract_city').val($('#city_p_' + getCurrentProject()).text());
        $('#contract_state').val(state_zip.length > 0 ? state_zip[0].trim() : "");
        $('#contract_zip').val(state_zip.length > 1 ? state_zip[1].trim() : "");
        $('#contract_date').val(today());

        currentForm = $('#formContractAction').serialize();

        if (contract_img == 0) {
            $('#img_li').css('display', 'none');
            $('#img_tab').css('display', 'none');
        }
        else {
            $('#img_li').css('display', '');
            $('#img_tab').css('display', '');
        }
        if (contract == 0) {
            $('#iig_li').css('display', 'none');
            $('#iig_tab').css('display', 'none');
        }
        else {
            $('#iig_li').css('display', '');
            $('#iig_tab').css('display', '');
            if (soldIIG == -1) {
                $('#allowIigUpgradeSpan').css('display', '');
                $('#allowIigUpgrade').prop("checked", true);
            } else if (soldIIG == 1) {
                $('#allowIigUpgradeSpan').css('display', '');
                $('#allowIigUpgrade').prop("checked", false);
            }
        }
        if (upgrade == 0) {
            $('#up_li').css('display', 'none');
            $('#up_tab').css('display', 'none');
        }
        else {
            $('#up_li').css('display', '');
            $('#up_tab').css('display', '');
            $('#contract_upgrade_price').val(actions['upgrade_price']);
        }
        if (welcome_package == 0) {
            $('#wp_li').css('display', 'none');
            $('#wp_tab').css('display', 'none');
        }
        else {
            $('#wp_li').css('display', '');
            $('#wp_tab').css('display', '');
        }
        $('#contractActionsModal').modal('show');
        $('.emailIMG').attr('disabled', 'disabled');
        $('.requestIMG').attr('disabled', 'disabled');
        $('.emailIIG').attr('disabled', 'disabled');
        $('.requestIIG').attr('disabled', 'disabled');
        $('.emailUp').attr('disabled', 'disabled');
        $('.requestUp').attr('disabled', 'disabled');
        $('.emailWP').attr('disabled', 'disabled');
        $('.requestWP').attr('disabled', 'disabled');
    }
    else
    {
        var state_zip =$('#state_p_'+getCurrentProject()).text().split(',');
        $('#contract_name').val($('#full_name_p_'+getCurrentProject()).text());
        $('#contract_email').val($('#email_p_'+getCurrentProject()).text());
        $('#contract_phone').val($('#phone_p_'+getCurrentProject()).text());
        $('#contract_phone2').val($('#phone_p_'+getCurrentProject()+'_2').text());
        $('#contract_invention').val($('#ideaname_'+getCurrentProject()).text());
        $('#contract_consultant').val($('#userDID').data('fname')+" "+$('#userDID').data('lname'));
        $('#contract_address').val($('#address_p_'+getCurrentProject()).text());
        $('#contract_city').val($('#city_p_'+getCurrentProject()).text());
        $('#contract_state').val(state_zip.length>0?state_zip[0].trim():"");
        $('#contract_zip').val(state_zip.length>1?state_zip[1].trim():"");
        $('#contract_date').val(today());

        currentForm =$('#formContractAction').serialize();

        if(contract_img==0)
        {
            $('#img_li').css('display','none');
            $('#img_tab').css('display','none');
        }
        else
        {
            $('#img_li').css('display','');
            $('#img_tab').css('display','');
        }
        if(contract==0)
        {
            $('#iig_li').css('display','none');
            $('#iig_tab').css('display','none');
        }
        else
        {
            $('#iig_li').css('display','');
            $('#iig_tab').css('display','');
        }
        if(upgrade==0)
        {
            $('#up_li').css('display','none');
            $('#up_tab').css('display','none');
        }
        else
        {
            $('#up_li').css('display','');
            $('#up_tab').css('display','');
            $('#contract_upgrade_price').val(actions['upgrade_price']);
        }
        if(welcome_package==0)
        {
            $('#wp_li').css('display','none');
            $('#wp_tab').css('display','none');
        }
        else
        {
            $('#wp_li').css('display','');
            $('#wp_tab').css('display','');
        }
        $('#contractActionsModal').modal('show');
        $('.emailIMG').attr('disabled','disabled');
        $('.requestIMG').attr('disabled','disabled');
        $('.emailIIG').attr('disabled','disabled');
        $('.requestIIG').attr('disabled','disabled');
        $('.emailUp').attr('disabled','disabled');
        $('.requestUp').attr('disabled','disabled');
        $('.emailWP').attr('disabled','disabled');
        $('.requestWP').attr('disabled','disabled');
    }
}
//Enabled btnUpdateContractActions if something is changed
$('.inputContractAction').keyup(function(e){
    var form = $('#formContractAction').serialize();
    if(form!=currentForm)
    {
        $('.btnUpdateContractActions').removeAttr('disabled');
        $('.btnContract').each(function(e){
            $(this).attr('disabled','disabled');
        });
    }
    else
    {
        $('.btnUpdateContractActions').attr('disabled','disabled');
        $('.btnContract').each(function(e){
            $(this).removeAttr('disabled');
        });
    }
});

//Update Basic Lead Information
$('.btnUpdateContractActions').click(function(e){

    var project_id = getCurrentProject();
    var lead_id = $('#container_'+project_id).data('lead-id');
    var fullname= $('#contract_name').val().split(' ');
    var fname =fullname[0].trim();
    var lname='';
    for(var i=1;i<fullname.length;i++)
    {
        lname +=fullname[i].trim()+' ';
    }
    lname = lname.trim();
    var phone =$('#contract_phone').val();
    var phone2 =$('#contract_phone2').val();
    var email = $('#contract_email').val();
    var street = $('#contract_address').val();
    var city = $('#contract_city').val();
    var state =$('#contract_state').val();
    var zip = $('#contract_zip').val();
    var ideaName = $('#contract_invention').val();

    if(validatePhone(phone) && validateEmail(email) &&(phone2.length==0 ||validatePhone(phone2)))
    {
        var data = {'ID':lead_id,'FNAME':fname,'LNAME':lname,'PHONE':phone,'PHONE2':phone2,'EMAIL':email,'STREET':street,'CITY':city,'STATE':state,'ZIP':zip};
        ajaxCall(data,'updateBasicDataLead',"Lead info updated successfully.","We couldn't updated the lead info, please try later");
        var data1 = {'INVENTION_NAME':ideaName,'ID':project_id};
        ajaxCall(data1,'updateInventionName',"","");
        //update current form serialize
        currentForm =$('#formContractAction').serialize();
        $('.btnUpdateContractActions').attr('disabled','disabled');
        $('.btnContract').each(function(e){
            $(this).removeAttr('disabled');
        });
        //update Base Tab
        $('#full_name_p_'+project_id).text(fname+" "+lname);
        $('#email_p_'+project_id).text(email);
        $('#phone_p_'+project_id).text(phone);
        $('#phone_p_'+project_id+'_2').text(phone2);
        if(phone2.length>0 && $('#checkPhone_'+project_id).length==0)
        {
            $('#phone_p_'+project_id+'_2').data('checkable',1);
            var checkHtml = '<input type="checkbox" class="checkPhone" id="checkPhone_'+project_id+'" style="float: left;">';
            $('#phone_p_'+project_id+'_2').before(checkHtml);
        }
        $('#address_p_'+project_id).text(street);
        $('#city_p_'+project_id).text(city);
        $('#state_p_'+project_id).text(state+", "+zip);
        $('#captionFullName_'+project_id).text(lname+", "+fname);
        $('#ideaname_'+project_id).text(ideaName);
        $('#container_'+project_id).find('.ideaNameSecondP').text(ideaName);

        //update Current Phone
        $('#inputCurrentPhone').val(phone);
        $('.checkPhone').prop('checked', false);
        //Update Business Profile Tab
        $('#pProjectInfoStreet_'+project_id).text(street);
        $('#pProjectInfoCity_'+project_id).text(city);
        $('#pProjectInfoState_'+project_id).text(state);
        $('#pProjectInfoPhone_'+project_id).text(phone);
        $('#pProjectInfoFullName_'+project_id).text(fname+" "+lname);
    }
    else
        toastr.error("Invalid format for the phone number or email.","Error!!");
});

//Load IMG Contract for review
$('.reviewIMG').click(function(e){
    cleanIframe('iframePrint');
    var id = getCurrentProject();
    var price = $('#contract_img_price').val().replace(',','');
    if(!validPrice(price,449))
    {
        toastr.error("The price needs to be bigger than $449.00" ,"Error");
        return;
    }
    $("#iframePrint").attr('src', "reviewPDF?ID="+id+"&PRICE="+price+"&TYPE=IMG");
    $('#iframeModal').modal('show');
    $('.emailIMG').removeAttr('disabled');
    $('.requestIMG').removeAttr('disabled');
    prices['IMG']=parseInt(price);
});
//Load IIG Contract for review
$('.reviewIIG').click(function(e){
    cleanIframe('iframePrint');
    var id = getCurrentProject();
    var price = $('#contract_iig_price').val().replace(',','');
    if(!validPrice(price,879))
    {
        toastr.error("The price needs to be $879.00" ,"Error");
        return;
    }
    $("#iframePrint").attr('src', "reviewPDF?ID="+id+"&PRICE="+price+"&TYPE=IIG");
    $('#iframeModal').modal('show');
    $('.emailIIG').removeAttr('disabled');
    $('.requestIIG').removeAttr('disabled');
    prices['IIG']=parseInt(price);
});
//Load Upgrade Contract for review
$('.reviewUp').click(function(e){
    cleanIframe('iframePrint');
    var id = getCurrentProject();
    var price = $('#contract_upgrade_price').val().replace(',','');
    $("#iframePrint").attr('src', "reviewPDF?ID="+id+"&PRICE="+price+"&TYPE=IGUP");
    $('#iframeModal').modal('show');
    $('.emailUp').removeAttr('disabled');
    $('.requestUp').removeAttr('disabled');
    prices['UPGRADE']=parseInt(price);
});
//Load Welcome Package for review
$('.reviewWP').click(function(e){
    cleanIframe('iframePrint');
    var id = getCurrentProject();
    $("#iframePrint").attr('src', "reviewPDF?ID="+id+"&TYPE=WP");
    $('#iframeModal').modal('show');
    $('.emailWP').removeAttr('disabled');
    $('.requestWP').removeAttr('disabled');
});

//Send By Email IMG Contract
$('.emailIMG').click(function(e){
    var id = getCurrentProject();
    var price = $('#contract_img_price').val();
    if(!validPrice(price,449))
    {
        toastr.error("The price needs to be bigger than $449.00" ,"Error");
        return;
    }

    //update  portlet
    var contract = 'Last Send <br><span>(IMG : '+price+')</span>';
    $('#contract_info_'+id).html(contract);
    var send = $(this).data('send');
    ajaxCall({'ID':id,'PRICE':price,'TYPE':'IMG','REQUEST':'EMAIL','SEND':send},'saveContract',send==0?"IMG uploaded it successfully.":"IMG sent it successfully.","We couldn't sent the IMG, please try later");
});
//Send By Email IIG Contract
$('.emailIIG').click(function(e){
    var id = getCurrentProject();
    var price = $('#contract_iig_price').val();
    if(!validPrice(price,879))
    {
        toastr.error("The price needs to be $879.00" ,"Error");
        return;
    }

    //update  portlet
    var contract = 'Last Send <br><span>(IIG : '+price+')</span>';
    $('#contract_info_'+id).html(contract);
    var send = $(this).data('send');
    ajaxCall({'ID':id,'PRICE':price,'TYPE':'IIG','REQUEST':'EMAIL','SEND':send},'saveContract',send==0?"IIG uploaded it successfully.":"IIG sent it successfully.","We couldn't sent the IIG, please try later");
});
//Send By Email Upgrade Contract
$('.emailUp').click(function(e){
    var id = getCurrentProject();
    var price = $('#contract_upgrade_price').val();

    //update  portlet
    var contract = 'Last Send <br><span>(IGUP : '+price+')</span>';
    $('#contract_info_'+id).html(contract);
    var send = $(this).data('send');
    ajaxCall({'ID':id,'PRICE':price,'TYPE':'IGUP','REQUEST':'EMAIL','SEND':send},'saveContract',send==0?"Upgrade uploaded it successfully.":"Upgrade sent it successfully.","We couldn't sent the Upgrade, please try later");
});


//Send By Email Welcome Package
$('.emailWP').click(function(e){
    var id = getCurrentProject();
    var send = $(this).data('send');
    ajaxCall({'ID':id,'PRICE':0,'TYPE':'WP','REQUEST':'EMAIL','SEND':send},'saveContract',send==0?"WP uploaded it successfully.":"WP sent it successfully.","We couldn't sent the WP, please try later");
});

//Request to Admin IMG Contract
$('.requestIMG').click(function(e){
    var id = getCurrentProject();
    var price = $('#contract_img_price').val();
    if(!validPrice(price,449))
    {
        toastr.error("The price needs to be bigger than $449.00" ,"Error");
        return;
    }
    ajaxCall({'ID':id,'PRICE':price,'TYPE':'IMG','REQUEST':'MAIL'},'saveContract',"IMG requested it successfully.","We couldn't requested the IMG, please try later");
});
//Request to Admin IIG Contract
$('.requestIIG').click(function(e){
    var id = getCurrentProject();
    var price = $('#contract_iig_price').val();
   /* if(!validPrice(price,995))
    {
        toastr.error("The price needs to be bigger than $995.00" ,"Error");
        return;
    }*/
    ajaxCall({'ID':id,'PRICE':price,'TYPE':'IIG','REQUEST':'MAIL'},'saveContract',"IIG requested it successfully.","We couldn't requested the IIG, please try later");
});
//Request to Admin IIG Contract
$('.requestUp').click(function(e){
    var id = getCurrentProject();
    var price = $('#contract_upgrade_price').val();
    /*if(!validPrice(price,995))
    {
        toastr.error("The price needs to be bigger than $995.00" ,"Error");
        return;
    }*/
    ajaxCall({'ID':id,'PRICE':price,'TYPE':'IGUP','REQUEST':'MAIL'},'saveContract',"Upgrade requested it successfully.","We couldn't requested the Upgrade, please try later");
});
//Request to Admin Welcome Package
$('.requestWP').click(function(e){
    var id = getCurrentProject();
    ajaxCall({'ID':id,'PRICE':0,'TYPE':'WP','REQUEST':'MAIL'},'saveContract',"WP requested it successfully.","We couldn't requested the WP, please try later");
});


//Check if IIG price has changed since the last review
$('#contract_iig_price').keyup(function(e){
    var price = parseInt($(this).val());
    if(price!=prices['IIG'])
    {
        $('.emailIIG').attr('disabled','disabled');
        $('.requestIIG').attr('disabled','disabled');
    }
    else
    {
        $('.emailIIG').removeAttr('disabled');
        $('.requestIIG').removeAttr('disabled');
    }
});
//Check if IMG price has changed since the last review
$('#contract_img_price').keyup(function(e){
    var price = parseInt($(this).val());
    if(price!=prices['IMG'])
    {
        $('.emailIMG').attr('disabled','disabled');
        $('.requestIMG').attr('disabled','disabled');
    }
    else
    {
        $('.emailIMG').removeAttr('disabled');
        $('.requestIMG').removeAttr('disabled');
    }
});
//Check if UPGRADE price has changed since the last review
$('#contract_upgrade_price').keyup(function(e){
    var price = parseInt($(this).val());
    if(price!=prices['UPGRADE'])
    {
        $('.emailUP').attr('disabled','disabled');
    }
    else
    {
        $('.emailUP').removeAttr('disabled');
    }
});

// Load set payment modal
$('#btnSetPayment').click(function(e){
    if(getCurrentProject()>0)
        $('#setPaymentProjectModal').modal('show');
    else
        toastr.error("Select a Project First!","Error");
});
//set the payment for the select project
$('#setPaymentProjectButton').click(function(e){
    var cType = $('#setPaymentContractType').val();
    var price = $('#setPaymentPrice').val();
    price = price.length==0?0:price;
    var id = getCurrentProject();
    if(cType == 'IIG' && parseInt(price) !== 879)
        toastr.error("The price needs to be $879.00" ,"Error");
    else if(cType == 'IMG' && parseInt(price) !== 449)
        toastr.error("The price needs to be $449.00" ,"Error");
    else
    {
        ajaxCall({'ID':id,'PRICE':price,'CTYPE':cType},'setPaymentProject',"Contract ready to payment.","We couldn't set the payment, please try later");
        $('#setPaymentProjectModal').modal('hide');
    }
});

$('#setPPAType').on('change', function() {
     if($(this).val() == 'NEW'){
         $('#setPPAUtilityTypeSelect').css('display','block');
         $('#setPPATimeSelect').css('display','block');
     }else{
         $('#setPPAUtilityTypeSelect').css('display','none');
         $('#setPPATimeSelect').css('display','none');
     }
});
//set PPA settings for the select project
$('#setPPAProjectButton').click(function(e){
    var uType = $('#setPPAUtilityType').val();
    var ppaTime = $('#setPPATime').val();
    var status = $('#setPPAType').val();
    var needSign = $('#needSign').prop('checked')?1:0;
    if( uType == '' && status == 'NEW'){
        swal({title: "Select PPA Type.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return false;
    }
    if( ppaTime == '' && status == 'NEW'){
        swal({title: "Select PPA Time.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return false;
    }
    var id = getCurrentProject();
    ajaxCall({'ID':id,'UTYPE':uType,'TIME':ppaTime,'STATUS':status},'setPPAProject',"Contract ready to PPA.","We couldn't set the PPA, please try later");
    $('#project_utility_box_'+id).css('display','block');
    $('#ppa_type_'+id).html(uType=="U_D"?"Utility & Design":uType);
    $('#ppa_type_'+id).attr('data-utility',uType);
    $('#setPPAProjectModal').modal('hide');
    $('#setPPAPrice').val(0);

    var code ='<div id="alloyHalfPricePPABox_'+id+'">Allow Half Price PPA <input type="checkbox" data-amount="0" id="allowHalfPricePPAProject_'+id+'" class="allowHalfPricePPAProject"  data-id="'+id+'"/></div>';
    $('#contract_p_ppa_'+id).append(code);
    $('#setPPAUtilityTypeSelect').css('display','none');
    $('#setPPATimeSelect').css('display','none');

    $('#setPPAUtilityType').val("");
    $('#setPPATime').val("");
    $('#setPPAType').val("");
});

//change span minimum price information when contract type is changed
$('#setPaymentContractType').change(function(e){
    if($(this).val()=="IMG")
        $('#setPaymentPriceSpan').text('Minimum price: $449.00');
    else
        $('#setPaymentPriceSpan').text('Minimum price: $879.00');
});

//search for the unloaded leads
function loadNewProjects()
{
    var data = {'MOBILE':isMobile()?1:-1};
    ajaxCallback(data,'loadProjects','paintNewProjects');
}
//Paint new projects inside container-leads
function paintNewProjects(projects)
{
    for(var i=projects.length-1;i>=0;i--)
    {
        var portlet = projects[i]['portlet'];
        var stage = projects[i]['stage'];
        //$('.container-'+stage.toLowerCase()+":first-child").prepend(portlet);
        $('.container-'+stage.toLowerCase()).find("h5:first").after(portlet);
    }
    if(projects.length>0)
    {
        //toastr.info('You have new projects.',"Important!!!");
        document.title="You have new submissions!";
        alert("You have new submissions!");
        //swal({title: "You have new submissions.",
        //    type: "info",
        //    showCancelButton: false,
        //    confirmButtonColor: "#8CD4F5",
        //    confirmButtonText: "Ok",
        //    closeOnConfirm: true },
        //    function(){
        //        document.title = "Projects View";
        //});
        javascriptRecount();
        initializeDateTimePickerMoveToDate()
    }

}
//Look if there is new admin stages in the DB for the current consultant
function requestsys()
{
    ajaxCallback('','requestsys','paintAdminStageRequest');
}
// updateLogsCallback
function updateLogsCallback(param){
    $('#portlet_tab_notes_'+currentProject.id+'_3 .projectLogs').html(param);
}
//update the request made in the portlet for the current consultant
function paintAdminStageRequest(requests)
{
    var show = 0;
    var text = 'Update Request Projects:\n\n';
    $.each(requests,function( key,request )
    {
        text += request.FILENO+' --> '+request.ADMINSTAGE+'\n';
        $('#request_p_admin_'+request.PROJECTID).html(request.ADMINSTAGE+(request.NEEDSMOREINFO==1?
        "<span class='moreInfo'> BUT NEEDS MORE INFO <i data-id='"+request.ID+"' class='fa fa-envelope-square requestMoreInfoReview'></i></span>":""));
        show = 1;
    } );
    show == 1?alert(text):'';
}

//Look if there is new admin stages in the DB for the current consultant
function lastPaidsys()
{
    ajaxCallback('','lastPaidSys','lastPaidSysCallback');
}
//update the request made in the portlet for the current consultant
function lastPaidSysCallback(requests)
{
    $.each(requests,function( key,request )
    {
        $('#contract_p_paid_'+request.PROJECTID).html('Last Paid <br><span>('+request.CTYPE+' : '+request.PRICE+')</span>');
    } );
}

//Show a modal with the result of search internal and public files
function paintFoundFiles(files)
{
    var htmlFiles = '';
    if(files.length>0)
    {
        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='button' class='showFile btn btn-primary' value='open' data-url='"+file.url+"' data-name='"+file.name+"'>" +
            "<span class='col-md-7' title='"+file.name+"'><strong>"+(file.name.length>30?file.name.substring(0,27)+'...':file.name)+"</strong></span>" +
            "<span class='col-md-3'><strong>"+file.date['date'].split(" ")[0]+"</strong></span>" +
            "</div>";
        });
        $('.container-founds').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });
        $('#filesModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}
//Enabled or disabled checkbox funding
function allowFunding(result)
{
    var active = $('#allowFundingCheckbox_'+currentProject.id).is(":checked");
    if(result==-1)
        toastr.error("There isn\'t a contract sent for this project" ,"Error");
    if(result==-2)
        toastr.error("You cannot disable a project that has already started to pay" ,"Error");
    if(result==1)
        toastr.success("Funding "+(active?" enabled":"disabled")+" for this project","Funding");
    else
    {
        if(active)
            $('#allowFundingCheckbox_'+currentProject.id).prop('checked', false);
        else
            $('#allowFundingCheckbox_'+currentProject.id).prop('checked', true);
    }
}
//Enabled or disabled PPA
function allowPPA(result)
{
    var active = $('#allowPPACheckbox_'+currentProject.id).is(":checked");
    if(result==-1)
        toastr.error("You cannot disable a project that has already started to pay" ,"Error");
    if(result==1)
    {
        //toastr.success("PPA payment"+(active?" enabled":"disabled")+" for this project","PPA");
        if(active && $('#ppa_type_'+currentProject.id).length<2)
        {
            $('#allowPPACheckbox_'+currentProject.id).prop('checked', true);
            var utility = $('#ppa_type_'+currentProject.id).length>0?$('#ppa_type_'+currentProject.id).data('utility'):'';
            var img = $('#ppa_type_'+currentProject.id).data('img');

            if(img==1 || utility == 'IMG'){
                $('#setPPAUtilityType').val('IMG');
            }else{
                $('#setPPAUtilityType').removeAttr('disabled');
                $('#setPPAUtilityType').val('Utility');
            }
            $('#setPPAProjectModal').modal('show');
            var amount = $('#allowSignPPACheckbox_'+currentProject.id).data('amount');
            if(amount>0)
                $('#alloySignPPABox_'+currentProject.id).css('display','block');
        }
        else
        {
            $('#alloyHalfPricePPABox_'+currentProject.id).css('display','none');
            $('#alloySignPPABox_'+currentProject.id).css('display','none');
        }
    }
    else
    {
        if(active)
            $('#allowPPACheckbox_'+currentProject.id).prop('checked', false);
        else
        {
            $('#allowPPACheckbox_'+currentProject.id).prop('checked', true);
        }
    }
}

//Update the total leads showed in the view
function javascriptRecount()
{
    var total = $(".portlet").not(".actionDateBigger").length;
    $(".totalProjects").html("Total Projects: "+total);
}
$('.goToProjectStage').click(function(e){
    $('html, body').animate({
        scrollTop: $('#'+$(this).data('stage')+"SC").offset().top-180
    }, 200);
});
//move to the top the clicked project
$(document).on('click','.lastProjectVisited',function(action){
    var id = $(this).data('id');
    if($('#container_'+id).hasClass('actionDateBigger'))
        toastr.error("The action date for this project is bigger than today.","Error!!");
    else if($('#container_'+id).length>0)
    $('html, body').animate({
        scrollTop: $('#container_'+id).offset().top-190
    }, 200);
});
$('.modal').on('hide.bs.modal', function (e) {
    $('.boxFixedTop').css('z-index','997');
    $('.container-portlets').css('z-index','0');
});
$('.modal').on('show.bs.modal', function (e) {
    $('.container-portlets').css('z-index','-1');
    $('.boxFixedTop').css('z-index','0');

});




