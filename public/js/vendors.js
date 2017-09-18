var currentProject;
var filesToMerge;
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
    $(document).on('click','.printBusinessVendor',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printBusinessVendors?ID="+id);
    });

    //print project
    $(document).on('click','.printProject',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printProject?ID="+id);
    });

    //save 1 in completed field on the database
    $(document).on('click','.completeProject',function(e){
        var id = $(this).data('production');
        $("#container_"+id).fadeOut(600, function(){
            $(this).remove();
        });
        ajaxCall({'ID':id},'completeProjectWriter','Project Completed','ERROR');
    });

    //Load all accessible files for a project
    $(document).on('click','.openFilesVendor',function(e){
        var id = $(this).data('id');
        var uid = $('#spanUser').data('id');
        ajaxCallback({'ID':id, 'UID':uid},'loadFilesVendor','paintFoundFiles');
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
            "<span class='col-md-10'><strong>"+file.name+"</strong></span>" +
            "</div>";
        });
        $('.container-founds').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });
        $('#vendorsFilesModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

//expande or collapse the Find Sub input
$("#inputFindSub").expandable({
    width: 180,
    duration: 300
});

//show the uploadFilesAdmin modal for one specific project.
$(document).on('click','.uploadFilesVendorProject',function(e){
    myDropzone.removeAllFiles(true);
    $('#closeUploadFile').attr('projectId',$(this).data('id'));
    $('#fileAdvice').remove();
    $('#closeUploadFile').before('<span id="fileAdvice" style="float: left;color: red;">*** The name of the file must contain the fileno of the project.</span>');
    $('#uploadFileModal').modal('show');
});

//show the uploadFilesAdmin modal for several projects at the same time.
$(document).on('click','.btnUploadSeveralFiles',function(e){
    $('#closeUploadFile').attr('projectId',0);
    $('#fileAdvice').remove();
    $('#closeUploadFile').before('<span id="fileAdvice" style="float: left;color: red;">*** The name of the file must contain the fileno of the project.</span>');
    myDropzone.removeAllFiles(true);
    $('#uploadFileModal').modal('show');
});

//Call to find Project when is pressed  enter key and Search Projects by fname, lname, phone, email or fileno
$("#inputFindSub").keypress(function(e) {
    if(e.which == 13 && $(this).val().length>0)
        ajaxCallback({'PARAMS':$(this).val()},'findProjectVendors','paintFoundProjectsVendorCallback');
});

//paint projects from Find Sub
function paintFoundProjectsVendorCallback(projects){
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
    $('#inputFindSub').val('');
});

////////////EMAIL TO PSU////////////
///////////////////////////////////
$(document).on('click','.checkFile',function(){
    if($(this).prop('checked')){
        filesToMerge.push($(this).data('id'));
    }else{
        var index = filesToMerge.indexOf($(this).data('id'));
        if(index>-1)
            filesToMerge.splice(index,1);
    }
});

//add attachment to email to vendor
$(document).on('click','.attachFileattachFileAttToCS',function(){
    $('#emailToCSFromAttModal').modal('hide');
    //search the files available for ilc
    ajaxCallback({'ID':currentProject.id},'loadFilesProduction','paintFoundFilesToEm');
});

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
    if(filesToMerge.length>0){
        ajaxCallback({'FILES':filesToMerge},'getFiles','backGetFilesToCS');
    }else
        $('#emailToCSFromAttModal').modal('show');
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
        ajaxCallback({'PID':currentProject.id,'FILES':filesToMerge,'NOTES':text,'SUBJ':subj,'EMAIL':email,'TO':'prod'},'sendEmailFromAttToCS','emailToCSBack')
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

