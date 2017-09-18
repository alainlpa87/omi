var currentProject;
$(document).ready(function(e){
    currentProject = {id:-1,previousAttorney:''};
    filesToMerge=[];
    $("#dateSchedule").datetimepicker({
        isRTL: 'false',
        format: "dd MM yyyy - HH:ii P",
        showMeridian: true,
        autoclose: true,
        pickerPosition: "bottom-left",
        todayBtn: true
    });
    $("#dateShipping").datetimepicker({
        isRTL: 'false',
        format: "dd MM yyyy - HH:ii P",
        showMeridian: true,
        autoclose: true,
        pickerPosition: "bottom-left",
        todayBtn: true
    });
    portletEvents();
    setInterval("callIntervalFunction()", 60000);

    if($('#pendingPatentAppF').data('projpending')=='1')
        ventana = open('pendingPatentAppF', 'alerta3D', 'width=700, height=460, left=300, top=200, location=no, directories=no, menubar=no, status=no, toolbar=no, scroolbar=no ');
});

//call all our interval function
function callIntervalFunction(){
    mailsys();
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

        if(currentProject.id!=$(this).data('request-id'))
        {
            currentProject = {
                id:$(this).data('id')
            };
            $('.portlet-selected').removeClass('portlet-selected');
            $(this).addClass('portlet-selected');
        }
    });

    //print business profile
    $(document).on('click','.printBusinessProduction',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printBusinessProduction?ID="+id);
    });

    //print project
    $(document).on('click','.printProject',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printProject?ID="+id);
    });

    //Load all accessible files for a project
    $(document).on('click','.openFilesProduction',function(e){
        var id = $(this).data('id');
        ajaxCallback({'ID':id},'loadFilesProduction','paintFoundFiles');
    });

    $(document).on('click','.indicator',function(e){
        var id = $(this).data('id');
        $('.indicator').each(function(e){
           var idT = $(this).data('id');
            if(idT!=id)
            {
                $(".portlet_tab_content_"+idT).css('display', 'none');
                $("#container_"+idT).css('height', '40px');
                $("#portletBody_"+idT).addClass('hide');
                $("#indicator_"+idT).removeClass('fa-chevron-up');
                $("#indicator_"+idT).addClass('fa-chevron-down');
            }
        });
        if($("#portletBody_"+id).hasClass('hide')){
            $(".portlet_tab_content_"+id).css('display', 'block');
            $("#container_"+id).css('height', 'auto');
            $("#portletBody_"+id).removeClass('hide');
            $("#indicator_"+id).removeClass('fa-chevron-down');
            $("#indicator_"+id).addClass('fa-chevron-up');
        }else{
            $(".portlet_tab_content_"+id).css('display', 'none');
            $("#container_"+id).css('height', '40px');
            $("#portletBody_"+id).addClass('hide');
            $("#indicator_"+id).removeClass('fa-chevron-up');
            $("#indicator_"+id).addClass('fa-chevron-down');
        }
    });

    //Load the modal to set attorney, designer, writer and university
    $(document).on('click','.setDestiny',function(e){

        var fileno = $(this).data('fileno');
        var id = $(this).data('id');
        var attorney = $('#hiddenAttorney_'+id).val();
        var writer = $('#hiddenWriter_'+id).val();
        var designer = $('#hiddenDesigner_'+id).val();
        var university = $('#hiddenUniversity_'+id).val();
        var scheduleDate = $('#hiddenScheduleDate_'+id).val();
        var letter = $('#hiddenLetter_'+id).val();
        var letterDate = $('#hiddenLetterDate_'+id).val();
        currentProject.id = id;
        currentProject.previousAttorney = attorney;
        $('#selectAttorney').val(attorney);
        $('#letterOfEng').val(letter);
        $('#letterOfEngDate').html("");
        $('#letterOfEngDate').html(letterDate);
        $('#selectWriter').val(writer);
        $('#selectUniversity').val(university);
        $('#selectDesigner').val(designer);
        $('#dateSchedule').val(scheduleDate);
        $('#dateSchedule').html(scheduleDate);
        $('#spanFilenoSelected').text(fileno);
        $('#productionSelectAttorneyModal').modal('show');

    });

    //show modal to return project
    $(document).on('click','.returnProject',function(e){
        var fileno = $(this).data('fileno');
        var id = $(this).data('id');
        currentProject.id = id;
        currentProject.previousAttorney = '';
        $('#spanFilenoReturn').text(fileno);
        $('#productionReturnProjectModal').modal('show');
    });

    //show the uploadFilesAdmin modal.
    $(document).on('click','.finishProject',function(e){
        myDropzone.removeAllFiles(true);
        var id = $(this).data('id');
        $('#closeUploadFile').attr('projectId',id);
        command ='common';
        $('#uploadFileModal').modal('show');
    });
    //show the setShippingDate modal.
    $(document).on('click','.shippingDateSet',function(e){
        $('#dateShipping').val('');
        $('#selectUtility').val('');
        var fileno = $(this).data('fileno');
        var id = $(this).data('id');
        var shippingDate = $('#hiddenShippingDate_'+id).val();
        var utility = $('#utility_'+id).val();
        currentProject.id = id;
        if(utility.length>0)
            $('#selectUtility').val(utility);
        if(shippingDate.length>0)
            $('#dateShipping').val(shippingDate);
        $('#spanFilenoShippingSelected').text(fileno);
        $('#productionSetShippingDateModal').modal('show');
    });
    $(document).on('click','.completeProject',function(e){
        var id = $(this).data('id');
        currentProject.id = id;
        syncAjaxCallback({'ID':id},'completeProjectProduction','completeProjectProductionCallBack');
    });
    $(document).on('click','.refundFilesProduction',function(e){
        var id = $(this).data('id');
        currentProject.id = id;
        $('#container_'+id).remove();
        ajaxCall({'ID':id},'refundFilesProduction',"Refund Notification successfully","We couldn't notify the refund, please refresh and try again");
    });

    $(document).on('click','.excludeProjectInput',function(e){
        var id = $(this).data('id');
        var attorney = $('#hiddenAttorney_'+id).val();
        var attorney1Total = parseInt($('#attorney1Available').html());
        var attorney2Total = parseInt($('#attorney2Available').html());
        if($(this).is(':checked'))
        {
            if(attorney==29)
                $('#attorney1Available').html(attorney1Total-1);
            else if(attorney==34)
                $('#attorney2Available').html(attorney2Total-1);
        }
        else
        {
            if(attorney==29)
                $('#attorney1Available').html(attorney1Total+1);
            else if(attorney==34)
                $('#attorney2Available').html(attorney2Total+1);
        }

    });

}
function completeProjectProductionCallBack(result)
{
    if(result==1)
    {
        var portlet = $('#container_'+currentProject.id);
        portlet.attr('data-stage','completed');
        $('#container_'+currentProject.id).remove();
        $('.container-portlets-completed').append(portlet);
        toastr.success('projects was complete successfully.','Success');
    }
    else
        toastr.error('We couldn\'t complete the project, please try again','Error');
}
//Show a modal with the result of search vendor files

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
        $('#productionFilesModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

//expande or collapse the Find Sub input
$("#inputFindSub").expandable({
    width: 180,
    duration: 300
});

//Call to find Project when is pressed  enter key and Search Projects by fname, lname, phone, email or fileno
$("#inputFindSub").keypress(function(e) {
    if(e.which == 13 && $(this).val().length>0)
        ajaxCallback({'PARAMS':$(this).val()},'findProjectProduction','paintFoundProjectsProductionCallback');
});

//paint projects from Find Sub
function paintFoundProjectsProductionCallback(projects){
    if(projects.length>0)
    {
        //Hide the current portlets
        $('.container-portlets').css('display','none');
        //Clean the container for previous search
        $('.container-added-portlets').html('');
        for(var i =0;i<projects.length;i++){
            var project = $(projects[i]);
            //if exists the portlet searched in the current view, move it for the search result view
            if($('#container_'+project.data('id')).length>0)
            {
                //add a field called exists to know if it was showed previously
                project.attr('data-exists','1');
                $('#container_'+project.data('id')).remove();
            }
            $('.container-added-portlets').append(project);
        }
        //unselected all the projects in the view
        $('.portlet-selected').removeClass('portlet-selected');
        currentProject = {id:-1};
        $('.container-portlets-found').css('display','inline');
    }
    else
        toastr.error('Sorry no matches',"No Matches");
}

//Close search result box and show again portlets
$('.close-portlets-found').click(function(e){
    $('.container-added-portlets').find( ".portlet").each(function(e){
        if($(this).data('exists')==1){
            var stage = $(this).data('stage');
            $('.container-portlets-'+stage.toLowerCase()).append($(this));
            //$('.container-portlets').append($(this));
        }
    });
    $('.portlet-selected').removeClass('portlet-selected');
    currentProject = {id:-1};
    $('.container-portlets').css('display','inline');
    $('.container-portlets-found').css('display','none');
    $('.container-added-portlets').html('');
    $('#inputFindSub').val('');
});

//
$('#setVendorsValue').click(function(e){
    var currentAttorney = $('#selectAttorney').val();
    if(currentAttorney!==currentProject.previousAttorney)
    {
        var attorney1Total = parseInt($('#attorney1Available').html());
        var attorney2Total = parseInt($('#attorney2Available').html());
        if(currentAttorney==29)
        {
            $('#attorney1Available').html(attorney1Total-1);
            $('#attorney2Available').html(attorney2Total+1);
        }
        else
        {
            $('#attorney1Available').html(attorney1Total+1);
            $('#attorney2Available').html(attorney2Total-1);
        }
    }
    //letter of engagement
    var letter = $('#letterOfEng').val();

    var date =$('#dateSchedule').val();
    var res = date.replace("-", "");
    date = new Date(res);
    var stamp = date.getFullYear()+ "-" +(date.getMonth() + 1) + "-" + date.getDate()+" "+date.getHours() + ":" + date.getMinutes()+ ":00"
    ajaxCall({'ID':currentProject.id,'ATTORNEY':currentAttorney,'SCHEDULEDATE':stamp,'LETTER':letter},'saveAttorney','This project was set for vendors successfully','We could\'t set the project for vendors,please try later');
    $('#hiddenAttorney_'+currentProject.id).val($('#selectAttorney').val());
    $('#hiddenLetter_'+currentProject.id).val(letter);
    $('#hiddenWriter_'+currentProject.id).val($('#selectWriter').val());
    $('#hiddenDesigner_'+currentProject.id).val($('#selectDesigner').val());
    $('#hiddenUniversity_'+currentProject.id).val($('#selectUniversity').val());
    $('#hiddenScheduleDate_'+currentProject.id).val($('#dateSchedule').val());
    $('#productionSelectAttorneyModal').modal('hide');
});

$('#sentLetterOfEngagement').click(function(e){
    ajaxCall({},'sendLetterOfEngagement','Letter Of Engagement sent successfully','We could\'t sent the Letter Of Engagement,please try later');
});

$('#setShippingValue').click(function(e){
    var stamp = '';
   var date =$('#dateShipping').val();
    var utility = $('#selectUtility').val();
    if(utility=="")
    {
        toastr.error('You have to select the utility first.','Error');
        return;
    }
    if(date != ''){
        var res = date.replace("-", "");
        date = new Date(res);
        stamp = date.getFullYear()+ "-" +(date.getMonth() + 1) + "-" + date.getDate()+" "+date.getHours() + ":" + date.getMinutes()+ ":00"
    }

    ajaxCall({'ID':currentProject.id,'SHIPPINGDATE':stamp,'UTILITY':utility},'saveShippingDate','The shipping date for this project was save  successfully','We could\'t save the shipping date for this project,please try later');
    $('#hiddenShippingDate_'+currentProject.id).val($('#dateShipping').val());
    $('#spanShipping_'+currentProject.id).html((date.getMonth() + 1)+"-"+date.getDate()+"-"+date.getFullYear());
    $('#productionSetShippingDateModal').modal('hide');
});

$('#sendProjects').click(function(e){
    var projects = $('.container-portlets-new').children();
    var ids="";
    for(var i=0;i<projects.length;i++)
    {
        var portlet = $(projects[i]);
        var id = portlet.data('production-id');
        var idProject = portlet.data('id');
        if(!$('#excludeProject_'+idProject).is(':checked'))
            ids+=ids.length>0?","+id:id;
    }
    $('#loadingModalAjax').modal('show');
    syncAjaxCallback({'IDS':ids},'sentToVendors','sendToVendorsCallBack');
});
function sendToVendorsCallBack(result)
{
    if(result==1)
    {
        var projects = $('.container-portlets-new').children();
        var ids="";
        for(var i=0;i<projects.length;i++)
        {
            var portlet = $(projects[i]);
            $('#container_'+portlet.data('id')).remove();
            portlet.find(".setDestiny").remove();
            $('.container-portlets-sent').append(portlet);
        }
        toastr.success('projects when sent to vendors successfully.','Success');
    }
    else
        toastr.error('We couldn\'t sent the projects, please try again','Error');
    $('#loadingModalAjax').modal('hide');
}

$('#returnFileBtn').click(function(e){
    var reason  = $('#textReason').val();
    var type = $('#selectVendorReturn').val();
    syncAjaxCallback({'ID':currentProject.id,'TYPE':type,'REASON':reason},'returnProject','returnProjectCallBack');
    $('#productionReturnProjectModal').modal('hide');
});
function returnProjectCallBack(result)
{
    if(result==1)
    {
        var portlet = $('#container_'+currentProject.id);
        portlet.attr('data-stage','returned');
        $('#container_'+currentProject.id).remove();
        $('.container-portlets-returned').append(portlet);
        toastr.success('project was  return to vendors successfully.','Success');
    }
    else
        toastr.error('We couldn\'t return the project, please try again','Error');
}

//////////EMAIL TO VENDOR//////////////
/////////////////////////////////////
//add attachment to email to vendor
var filesToMerge;
//$(document).on('click','.attachFileToVendor',function(){
//    $('#emailToVendorsModal').modal('hide');
//    //search the files available for ilc
//    ajaxCallback({'ID':currentProject.id},'loadFilesProduction','paintFoundFilesToVendor');
//});
var countFiles,command;
$(document).on('click','.attachFileToVendor',function(){
    command='emailVendor';
    countFiles =0;
    myDropzone.removeAllFiles(true);
    $('#emailToVendorsModal').modal('hide');
    $('#uploadFileModal').modal('show');
});

$(document).on('hidden.bs.modal', '#uploadFileModal', function(){
    if(command == 'emailVendor')
        ajaxCallback({'COUNT':countFiles, 'PROJECTID':currentProject.id},'getAttachments', 'backFromAttachProd');

});

function backFromAttachProd(result){
    if(result != 0){
        var html ='';
        for(var i=0; i< result.length;i ++){
            html+='<div id="attachmeCont_'+result[i].id+'" class="col-md-8"><p class="pull-left">'+result[i].fileName+'</p> <i class="fa fa-remove removeAttachment" style="color: red;cursor: pointer;"  data-fid="'+result[i].id+'"></i></div>';
        }
        $('#attachments-container-toVendor').html(html);
    }
    command = '';
    $('#emailToVendorsModal').modal('show');
}

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
    if(email == ''){
        toastr.error("The email is empty.", "You had forgotten something!");
    }else if($.trim(subj) == ''){
        toastr.error("The subject is empty.", "You had forgotten something!");
    }else if($.trim(text) == ''){
        toastr.error("The email body is empty.", "You had forgotten something!");
    }else{
        ajaxCallback({'PID':currentProject.id,'COUNT':countFiles,'NOTES':text,'EMAIL':email,'SUBJ':subj, 'FROM':'prod'},'sendEmailToVendor','emailToVendorBack')
    }
});

function emailToVendorBack(result){
    if(result == -1)
        toastr.error("An error has happened,please try later.", "Error");
    else{
        $('#emailToVendorsModal').modal('hide');
        filesToMerge=[];
        toastr.success("Email to vendor sent!!", "Success");
    }
}


//Show a modal with all the files
function paintFoundFilesToVendor(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '';
        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFiletoMerge pull-left' data-id='"+file.id+"'>"+
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.name+"'>" +
            "<span class='col-md-6'><strong>"+file.name+"</strong></span>" +
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

$(document).on('hidden.bs.modal', '#selectFilesToAttachModal', function(){
    if(filesToMerge.length>0)
        ajaxCallback({'FILES':filesToMerge},'getFiles','backGetFilesToVendor');
    else
        $('#emailToVendorsModal').modal('show');
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

$(document).on('change','#selectVendor',function(){
    if($(this).val() == 0)
        $('#emailToVendor').val('');
    else
        $('#emailToVendor').val($(this).val());
});

$(document).on('click','.rmvFromSelectedF',function(){
    var fid =$(this).data('fid');
    var index = filesToMerge.indexOf(fid);
    if(index>-1){
        filesToMerge.splice(index,1);
        $('#attachmeCont_'+fid).remove();
    }
});

$(document).on('click','#emToVendor',function(){
    if(currentProject.id == -1){
        $('#selectOptionClientS').val(0);
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
    else{
        var newOpt = '<option value="0">Select Vendor</option>' +
            '<option value="jdh@ip-pages.com">Jerry D. Haynes</option>' +
        '<option value="MIKERIES@aol.com">Michael Ries</option>' +
        '<option value="attorneylev@gmail.com">Lev Iwashko</option>' +
        '<option value="thompson.sandra.jeann@gmail.com">Sandra Thompson</option>' +
        '<option value="lana.assaf@hotmail.com">Lana</option><option value="jorgedef@hotmail.com">Jorge 2D</option>' +
                     '<option value="nmartines@ip-pages.com">Natalie</option>' +
                     '<option value="JDavid_Allen@baylor.edu">David Allen</option>';
        $('#selectVendor').html('');
        $('#selectVendor').append(newOpt);
        $('#selectVendor').val(0);
        $('#emailToVendor').val('');
        $('#subjEmToVendor').val('');
        $('#bodyToVend').val('');
        $('#attachments-container-toVendor').html('');
        $('#emailToVendorsModal').modal('show');
    }
});

//jorgedef@hotmail.com