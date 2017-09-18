var currentProject;
var filesToMerge;//array to save the order of the files to make a merge
var command;
$(document).ready(function(e){
    currentProject = {id:-1};
    filesToMerge=[];
    portletEvents();
    setInterval("callIntervalFunction()", 60000);
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
    $(document).on('click','.printBusinessAttCS',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printBusinessAttCS?ID="+id);
    });


    //Load all accessible files for a project
    $(document).on('click','.openFilesAttCS',function(e){
        var id = $(this).data('id');
        ajaxCallback({'ID':id},'loadFilesAttCS','paintFoundFiles');
    });

    $(document).on('click','.indicator',function(e){
        var id = $(this).data('aid');
        $('.indicator').each(function(e){
            var idT = $(this).data('aid');
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
            "<span class='col-md-7'><strong>"+file.name+"</strong></span>"+
            "<span class='col-md-3'><strong>"+file.created+"</strong></span>"+
            "</div>";
        });
        $('.container-founds').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });
        command = 'common';
        $('#attCSFilesModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

//expande or collapse the Find Sub input
$("#inputFindSubAttCS").expandable({
    width: 180,
    duration: 300
});

//show the uploadFilesAdmin modal for one specific project.
$(document).on('click','.uploadFilesAttCSProject',function(e){
    myDropzone.removeAllFiles(true);
    var mode = $(this).data('command');
    $('.aux-class-att').data('command',mode);
    $('#closeUploadFile').data('aid',$(this).data('aid'));
    $('#fileAdvice').remove();
    $('#closeUploadFile').before('<span id="fileAdvice" style="float: left;color: red;">*** The name of the file must contain the fileno of the project.</span>');
    $('#uploadFileModal').modal('show');
});

//Call to find Project when is pressed  enter key and Search Projects by fname, lname, phone, email or fileno
$("#inputFindSubAttCS").keypress(function(e) {
    if(e.which == 13 && $(this).val().length>0)
        ajaxCallback({'PARAMS':$(this).val()},'findProjectAttCS','paintFoundProjectsAttCSCallback');
});

//paint projects from Find Sub
function paintFoundProjectsAttCSCallback(projects){
    if(projects.length>0)
    {
        //Hide the current portlets
        $('.container-portlets').css('display','none');
        //Clean the container for previous search
        $('.container-added-portlets').html('');
        for(var i =0;i<projects.length;i++){
            $('.container-added-portlets').append($(projects[i]));
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
    $('.portlet-selected').removeClass('portlet-selected');
    currentProject = {id:-1};
    //hide the search and show portlets
    $('.container-portlets').css('display','inline');
    $('.container-portlets-found').css('display','none');
    $('.container-added-portlets').html('');
    $('#inputFindSubAttCS').val('');
});


//change the field completed of the attorneyClientServices
$(document).on('click','.finishAttCS',function(e){
    /*
     //se kito pk no estaba accurate
     //abilita y desabilita los botones para subir los ficheros segun los diferentes estados
     var mode = $(this).data('command');
     if(mode == 'NORMAL'){
     $('#uploadFilingR').prop("disabled","disabled");
     //$('#uploadLegalM').prop("disabled","disabled");
     $('#uploadPatentApp').removeAttr("disabled");
     }else if(mode == 'APP'){
     $('#uploadPatentApp').prop("disabled","disabled");
     //$('#uploadLegalM').prop("disabled","disabled");
     $('#uploadFilingR').removeAttr("disabled");
     }else if(mode = 'SEARCH'){
     $('#uploadPatentApp').prop("disabled","disabled");
     $('#uploadFilingR').prop("disabled","disabled");
     $('#uploadLegalM').removeAttr("disabled");
     }*/
    $('.uploadFilesAttCSProject').data('aid',$(this).data('aid'));
    $('#attCSFinishModal').modal('show');

});

//change the field completed of the attorneyClientServices
$(document).on('click','.approveTandCR',function(e){
    ajaxCallback({'ID':$(this).data('id'),'PARAMS':'APPROVE'},'approveOrRejectTMandCR','hideProject');
});
$(document).on('click','.rejectTandCR',function(e){
    $('#rejectCRorTMNotes').html("");
    $('#rejectCRorTMNotes').val("");
    var id = $(this).data('id');
    $('#submitbtnAttRejectCRorTM').data('id',id);
    $('#attRejectCRorTMNotesModal').modal('show');
});
$(document).on('click','#submitbtnAttRejectCRorTM',function(e){
    ajaxCallback({'ID':$(this).data('id'),'PARAMS':'REJECT','REASON':$('#rejectCRorTMNotes').val()},'approveOrRejectTMandCR','hideProject');
});

function hideProject(proj_id){
    if(proj_id!="-1" && proj_id!="0"){
        $('#container_'+proj_id).remove();
        toastr.success('Files sent!!!','Success');
    }else if(proj_id=="0")
        toastr.success('Files sent!!!','Success');
    else
        toastrr.error('An error has happened, please try later','Error');
    window.location = "attClientServices";
}

var command;
//Show a modal with all the files
function paintFoundFilesToEm(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '';
        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFile pull-left' data-id='"+file.id+"'>"+
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.name+"'>" +
            "<span class='col-md-6'><strong>"+file.name+"</strong></span>" +
            "</div>";
        });
        $('.container-founds').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });
        $('#attCSFilesModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('hidden.bs.modal', '#emailToCSFromAttModal', function(){
    filesToMerge=[];
});

$(document).on('hidden.bs.modal', '#attCSFilesModal', function(){
    if(command=='email' && filesToMerge.length>0){
        ajaxCallback({'FILES':filesToMerge},'getFiles','backGetFilesToCS');
    }
});

$(document).on('click','.checkFile',function(){
    if($(this).prop('checked')){
        filesToMerge.push($(this).data('id'));
    }else{
        var index = filesToMerge.indexOf($(this).data('id'));
        if(index>-1)
            filesToMerge.splice(index,1);
    }
});

//paint the files selected for send email to vendor
function backGetFilesToCS(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.','Error');
    else{
        var html ='';
        for(var i=0; i< result.length;i ++){
            html+='<div id="attachmeCont_'+result[i].id+'" class="col-md-8"><p class="pull-left">'+result[i].fileName+'</p> <i class="fa fa-remove rmvFromSelectedF" style="color: red;cursor: pointer;"  data-fid="'+result[i].id+'"></i></div>';
        }
        $('#attachments-container-toCS').html(html);
    }
    $('#emailToCSFromAttModal').modal('show');
}

//send the email to vendor
$(document).on('click','#sendEmToCS',function(){
    var subj = $('#subjEmToCS').val();
    var text =  $('#bodyToVend').val();
    var email = $('#vendor_email').data('email');
    if($.trim(subj) == ''){
        toastr.error("The subject is empty.", "You had forgotten something!");
    }else if($.trim(text) == ''){
        toastr.error("The email body is empty.", "You had forgotten something!");
    }else{
        ajaxCallback({'PID':currentProject.id,'FILES':filesToMerge,'NOTES':text,'SUBJ':subj,'EMAIL':email,'TO':'cs'},'sendEmailFromAttToCS','emailToCSBack')
    }
});

function emailToCSBack(result){
    if(result == -1)
        toastr.error("An error has happened,please try later.", "Error");
    else{
        $('#emailToCSFromAttModal').modal('hide');
        toastr.success("Email to PSU sent!!", "Success");
    }
}

//add attachment to email to vendor
$(document).on('click','.attachFileattachFileAttToCS',function(){
    $('#emailToCSFromAttModal').modal('hide');
    command = 'email';
    //search the files available for ilc
    ajaxCallback({'ID':currentProject.id},'loadFilesAttCS','paintFoundFilesToEm');
});

$(document).on('click','.rmvFromSelectedF',function(){
    var fid =$(this).data('fid');
    var index = filesToMerge.indexOf(fid);
    if(index>-1){
        filesToMerge.splice(index,1);
        $('#attachmeCont_'+fid).remove();
    }
});

$(document).on('click','#emToCSBtn',function(){
    if(currentProject.id == -1){
        swal({title: "You must select one project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
    else{
        $('#subjEmToCS').val('');
        $('#bodyToVend').val('');
        $('#attachments-container-toCS').html('');
        $('#emailToCSFromAttModal').modal('show');
    }
});