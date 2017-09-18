$(document).ready(function(e){
    var defaultDate = $('#datetimepickerStart').data('default')!="0000-00-00 00:00:00"?
        $('#datetimepickerStart').data('default'):new Date();
    $('#datetimepickerStart').datetimepicker({
        defaultDate: defaultDate
    });
});
$(document).on('focusin','.cleanBorder',function(e){
    $(this).css('border','1px solid lightgray');
});
$(document).on('click','.actionQuestions',function(e){
    var id = $(this).data('id');
    var ideaName =$('#ideaName').val();
    var descriptionExtra =$('#description').val();
    var hisIdea,similarProduct,probIdea,descIdea,uniIdea,payIdea,techField,costSpend,targetMarket,modifications,environment,device,addNotes= "";
    var complete = false;
    hisIdea =$('#hisIdea').val();
    similarProduct =$('#similarProduct').val();
    probIdea =$('#probIdea').val();
    descIdea =$('#descIdea').val();
    uniIdea =$('#uniIdea').val();
    payIdea =$('#payIdea').val();
    costSpend =$('#costSpend').val();
    targetMarket =$('#targetMarket').val();
    modifications =$('#modifications').val();
    environment =$('#environment').val();
    device =$('#device').val();
    addNotes =$('#addNotes').val();
    techField = $('#techField').val()?$('#techField').val().join():"";
    complete = true;
    var data = {'ID':id,'IDEANAME':ideaName,'DESCRIPTION':descriptionExtra,'HISIDEA':hisIdea,'SIMILARPRODUCT':similarProduct,'PROBIDEA':probIdea,
        'DESCIDEA':descIdea,'UNIIDEA':uniIdea,'PAYIDEA':payIdea,'TECHFIELD':techField,'COSTSPEND':costSpend,
        'TARGETMARKET':targetMarket,'MODIFICATIONS':modifications,'ENVIRONMENT':environment,'DEVICE':device,'ADDNOTES':addNotes,'COMPLETE':complete,'TYPE':2};
    ajaxCallback(data,'../updateDataProject',"saveSuccess");
});
$(document).on('click','#btnSaveProfile',function(e){
    var fname =$('#fname').val();
    var lname =$('#lname').val();
    var phone =$('#phone').val();
    var phone2 =$('#phone2').val();
    var email =$('#email').val();
    var street,city,state,zip,country,birth,spouse,children,college,degree,profession,hobby = "";
    var complete = false;
    if(fname.length==0)
    {
        $('#fname').css('border','1px solid red');
        swal({title: "We need your First Name",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
    if(!validateEmail(email))
    {
        $('#email').css('border','1px solid red');
        swal({title: "Invalid format for the email",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
    if(!validatePhone(phone))
    {
        $('#phone').css('border','1px solid red');
        swal({title: "Invalid format for the phone number",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
    if(phone2.length>0 && !validatePhone(phone2))
    {
        $('#phone2').css('border','1px solid red');
        swal({title: "Invalid format for the 2nd phone number",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
    if($('.groupAddress').length>0)
    {
        street =$('#address').val();
        city =$('#city').val();
        state =$('#state').val();
        zip =$('#zip').val();
        country =$('#country').val();

        birth = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        spouse =$('#spouse').val();
        children =$('#children').val();
        college =$('#college').val();
        degree =$('#degree').val();
        profession =$('#profession').val();
        hobby =$('#hobby').val();
        complete = true;
    }

    var data = {'FNAME':fname,'LNAME':lname,'PHONE':phone,'PHONE2':phone2,'EMAIL':email,
        'STREET':street,'CITY':city,'STATE':state,'ZIP':zip,'COUNTRY':country,
        'BIRTH':birth,'SPOUSE':spouse,'CHILDREN':children,'COLLEGE':college,'DEGREE':degree,'PROFESSION':profession,'HOBBY':hobby,'COMPLETE':complete};
    ajaxCallback(data,'updateDataLead',"saveSuccess");
});
$(document).on('click','.btnSaveProject',function(e){
    var next = $(this).data('next');
    var id = $(this).data('id');
    var ideaName =$('#ideaName').val();
    var descriptionExtra =$('#description').val();
    $('#description').val('');
    $('#description').html('');
    var hisIdea,similarProduct,probIdea,descIdea,uniIdea,payIdea,techField,costSpend,targetMarket,modifications,environment,device,addNotes= "";
    var complete = false;
    if(ideaName.length==0)
    {
        $('#ideaName').css('border','1px solid red');
        swal({title: "We need the name of your idea",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
    if($('.groupQuestions').length>0)
    {
        hisIdea =$('#hisIdea').val();
        similarProduct =$('#similarProduct').val();
        probIdea =$('#probIdea').val();
        descIdea =$('#descIdea').val();
        uniIdea =$('#uniIdea').val();
        payIdea =$('#payIdea').val();
        costSpend =$('#costSpend').val();
        targetMarket =$('#targetMarket').val();
        modifications =$('#modifications').val();
        environment =$('#environment').val();
        device =$('#device').val();
        addNotes =$('#addNotes').val();
        techField = $('#techField').val()?$('#techField').val().join():"";
        complete = true;
    }

    var data = {'ID':id,'IDEANAME':ideaName,'DESCRIPTION':descriptionExtra,'HISIDEA':hisIdea,'SIMILARPRODUCT':similarProduct,'PROBIDEA':probIdea,
        'DESCIDEA':descIdea,'UNIIDEA':uniIdea,'PAYIDEA':payIdea,'TECHFIELD':techField,'COSTSPEND':costSpend,
        'TARGETMARKET':targetMarket,'MODIFICATIONS':modifications,'ENVIRONMENT':environment,'DEVICE':device,'ADDNOTES':addNotes,'COMPLETE':complete,'TYPE':1};
    ajaxCallback(data,'../updateDataProject',"saveSuccess");
    $('#ideaConcept').html($('#ideaConcept').html()+"<br><br>"+descriptionExtra);
    if(next>0 && $('.groupQuestions').length>0)
    {
        var tab = $(this).data('tab');
        $('#collapse'+next).collapse('show');
        if(tab!=0)
            $('#collapse'+tab).collapse('hide');
    }
});
$(document).on('click','#btnSaveInventors',function(e){
    var coInventor =$('#coInventor').val();
    var coInventorRelation =$('#coInventorRelation').val();
    var occupation =$('#occupation').val();
    var tpaContact =$('#tpaContact').val();
    var patentSearch =$('#patentSearch').val();
    var patented =$('#patented').val();
    var id =$(this).data('id');
    var data = {'ID':id,'COINVENTOR':coInventor,'COINVENTORRELATION':coInventorRelation,
        'OCCUPATION':occupation,'TPACONTACT':tpaContact,'PATENTSEARCH':patentSearch,'PATENTED':patented};
    ajaxCallback(data,'../updateDataInventor',"saveSuccess");
});
$(document).on('click','.btnBack',function(e){
    var tab = $(this).data('tab');
    var back = $(this).data('back');
    $('#collapse'+back).collapse('show');
    if(tab!=0)
        $('#collapse'+tab).collapse('hide');

});
$(document).on('click','.btnSaveApproval',function(e){
    var notesApproval = $('#notesApproval').val();
    var id = $(this).data('id');
    var data = {'NOTES':notesApproval,'ID':id};
    ajaxCallback(data,'../updateApprovalNotes',"saveSuccess");
    $('.boxApproval').css('display','none');
    $('#ideaConcept').html($('#ideaConcept').html()+"<br><br>"+notesApproval);
});
//log out the current client from the launch center
$(document).on('click','#spanUser',function(e){
    ajaxCallback('','logout','reloadWindow');
});
//show the uploadFilesAdmin modal.
$(document).on('click','.linkUploadFileProject',function(e){
    myDropzone.removeAllFiles(true);
    command='common';
    $('#closeUploadFile').attr('projectId',$(this).data('id'));
    $('#uploadFileModal').modal('show');
});

//delete file from launch center.
$(document).on('click','.launchDeleteFile',function(e){
    var fileId = $(this).data("id");
    ajaxCallback({'FILE':fileId},'../../deleteFiles','deleteFilesCallback');

});

//callback of delete file from launch center
function deleteFilesCallback(id){
    if(id != "-1"){
        $("#divFile_"+id).fadeOut(600, function(){
            $('#divFile_'+fileId).remove();
        });
    }else{
        toastr.error('We can\'t delete this file now.',"Error.");
    }
}

//update list of files when modal hide
$('#uploadFileModal').on('hidden.bs.modal', function () {
    //add the file to the list of files
    if(command =='common' && $('#ideaName') != undefined){
        var projectId = $('#ideaName').data('id');
        ajaxCallback({'ID':projectId},'../../loadFilesLaunch','loadFilesLaunchCallback');
    }else if(command=='email' && $('#ideaName') != undefined){
        //show the attachments, call an ajax function to get the files and show them in the callback,
        // also u have to modify el upload file to adjust this new upload
        $('#uploadFileModal').modal('hide');
        $('#clientEmailModal').modal('show');
        var projectId = $('#ideaName').data('id');
        ajaxCallback({'COUNT':countFiles, 'PROJECTID':projectId},'../../getAttachmentsLaunch','backFromAttach');
    }
});

$(document).on('click','.showEmail', function () {
    $('#subjClientEmail').val('');
    $('#textClientEmail').val('');
    $('#attachments-container-clientEm').html('');
    $('#clientEmailModal').modal('show');
});

function backFromAttach(result){
    if(result != 0){
        var html ='';
        for(var i=0; i< result.length;i ++){
            html+='<div id="attachmeCont_'+result[i].id+'" class="col-md-8"><p class="pull-left">'+result[i].fileName+'</p> <i class="fa fa-remove removeAttachment" style="color: red;cursor: pointer;"  data-fid="'+result[i].id+'"></i></div>';
        }
        $('#attachments-container-clientEm').html(html);
    }
    command = '';
}

$(document).on('click','.removeAttachment',function(){
    var fid = $(this).data('fid');
    ajaxCallback({'FID':fid},'../removeAttachmentLaunch','backRemoveAttch');
});

function backRemoveAttch(result){
    if(result == -1)
        toastr.error("An error has happened, please try later", "Error!");
    else{
        countFiles--;
        $('#attachmeCont_'+result).remove();
    }
}

//callback of delete file from launch center
function loadFilesLaunchCallback(files){
    if(files.length>0){
        var projectId = '';
        var html = "<span class='fileListSpan'>LIST OF FILES:</span></br></br>";
        $.each(files,function( key,file ){
            projectId = file.projectId;
            html += "<div class='col-md-12 col-sm-12 col-xs-12' id='divFile_"+file.id+"'><span title='"+file.name+"'><a href='../../"+file.url+"' target='_blank'>"+(file.name.length>25?file.name.substring(0,23)+'...':file.name)+"</a></span><span title='Delete File' data-id='"+file.id+"' class='launchDeleteFile'><i class='fa fa-times '></i></span></div>";
        });
        $('#fileList_'+projectId).html(html);
    }
}

//save laravelLink into session before redirect to Learning Center
$(document).on('click','#changePass',function(e){
    var id = $(this).data('id');
    $('#submitbtnChangePassword').attr('lead',id);

    $(document).on('click','#submitbtnChangePassword',function(e){
        if($("#password").val()!=$('#confirmPassword').val()){
            $("#confirmPassword").css("border","1px solid red");
            swal({title: "Passwords don't match.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }else if($("#password").val().length < 7){
            $("#password").css("border","1px solid red");
            swal({title: "Password need a minimum of 7 characters.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }else if($("#oldPassword").val().length < 7){
            $("#oldPassword").css("border","1px solid red");
            swal({title: "Password need a minimum of 7 characters.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }else {
            var id = $(this).attr('lead');
            var old = $('#oldPassword').val();
            var newP = $('#password').val();
            ajaxCall({'LEAD':id,'OLD':old,'NEW':newP},'changePassword',"New password saved successfully.","We couldn't save the new password, Your old password do not match.");
            $('#changePasswordForm').trigger("reset");
            $('#changePasswordModal').modal('hide');
        }
    });

    $('#changePasswordModal').modal('show');
});

//save laravelLink into session before redirect to Learning Center
$(document).on('click','#addPlan',function(e){
    $('#addPpaPlanModal').modal('show');
});

function checkFormAddPlan()
{
    if($('#selectPlan').val()==0)
    {
        swal({title: "You need to select a plan.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return false;
    }
    return true;
}

function saveSuccess(data)
{
    if(data==1)
    swal({title: "Info updated successfully.",
        type: "info",
        showCancelButton: false,
        confirmButtonColor: "#8CD4F5",
        confirmButtonText: "Ok",
        closeOnConfirm: true });
}

$(document).on('click','.patent-app-up',function(e){
    e.preventDefault();
    var docsSign = $(this).data('prop');
    var pid=$(this).data('id');
    var type =$(this).data('type');
    if(docsSign=="-1")
        toastr.error("Some documents of the Paten App Package don't was signed yet.","Error");
    else
        ajaxCallback({'PID':pid,'TYPE':type},'../../../approvePatentApp','appPatentAppBack');

    return false;
});

function appPatentAppBack(result){
    if(result=="1"){
        toastr.success('The Patent Application was approved.');
        $('#patent_app_docs').hide();
    }else
        toastr.error('An error has happened, please try later.');
}

$(document).on('click','.patent-app-down',function(e){
    e.preventDefault();
    var pid=$(this).data('id');
    $('#returnPatentAppBtn').data('type',$(this).data('type'));
    var htmlFiles = "<div class='fileHeader'><span class='col-md-4'>Changes</div>"+
        "<div id='notesToReturn_"+pid+"' class='returnApp'>" +
        "<textarea rows='6' cols='40' id='returnNotes' data-pid='"+pid+"'></textarea></div>";
    $('.container-returnPatentApp').html(htmlFiles);
    $('#returnPatentAppModal').modal('show');
    return false;
});

$(document).on('click','#returnPatentAppBtn',function(e){
    var pid=$('#returnNotes').data('pid');
    var notes = $('#returnNotes').val();
    var type =$(this).data('type');
    $('#returnPatentAppModal').modal('hide');
    ajaxCallback({'PID':pid,'NOTES':notes,'TYPE':type},'../../../returnPatentAppByClient','returnedAppBack')
});

function returnedAppBack(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.',"Error");
    else{
        $('#appPack').hide();
        toastr.success('Patent App returned!!!',"Success");
    }
}

$(document).on('click','#editCoInventors',function(){
    $('#editCoInvModal').modal('show');
});


//open the modal to attach docs
var countFiles;
var command;
$(document).on('click','.attachFileClientEmail',function(){
        countFiles =0;
        command = 'email';
        $('#clientEmailModal').modal('hide');
        myDropzone.removeAllFiles(true);
        $('#closeUploadFile').attr('projectId',$(this).data('pid'));
        $('#uploadFileModal').modal('show');
});

//send the email from client
$(document).on('click','#sendClientEmail',function(){
    var subject = $('#subjClientEmail').val();
    var text =  $('#textClientEmail').val();
    var pid = $(this).data('pid');
    if(subject == ''){
        toastr.error("Subject field is empty.", "You had forgotten something!");
        $('#subjClientEmail').css('border-color','red');
    }else if(text == ''){
        toastr.error("Email text is empty.", "You had forgotten something!");
        $('#textClientEmail').css('border-color','red');
    }else{
        if(countFiles == null)
            countFiles =0;
        ajaxCall({'SUBJECT':subject, 'TEXT':text, 'PID':pid, 'COUNT':countFiles},'../../sendEmailClient','Email Sent.','An error has happened, please try later.');
        $('#clientEmailModal').modal('hide');
    }
});

$(document).on('click','#createTicket', function(){
    var pid = $('#selectProjectTicket').val();
    var name = $('#ticketName').val();
    var message = $('#ticketText').val();
    if(pid < 0){
        $('#selectProjectTicket').css('border','1px solid red');
        swal({title: "You must select a project!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }else if(name == ''){
        $('#ticketName').css('border','1px solid red');
        swal({title: "You miss the name of the ticket!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }else if(message == ''){
        $('#ticketText').css('border','1px solid red');
        swal({title: "You must describe the problem!",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }else{
        ajaxCallback({'PID':pid, 'NAME':name, 'MESSAGE':message}, 'createTicket', 'createTicketCallBack');
    }
});

function createTicketCallBack(result){
    if(result == -1)
        toastr.error('An error has happened, please try later',"Error.");
    else{
        toastr.success('Ticket opened!!!',"Success.");
        window.location.href = 'showTickets';
    }
}

$(document).on('click','.writeReply',function(){
    var tid =$(this).data('tid');
    $('#writeRticket_'+tid).removeClass('hidden');
    $('#cancelReplyTicket_'+tid).removeClass('hidden');
    $('#addReplyTicket_'+tid).removeClass('hidden');
});

$(document).on('click','.cancelReplyTicket',function(){
    var tid =$(this).data('tid');
    $('#writeRticket_'+tid).addClass('hidden');
    $('#cancelReplyTicket_'+tid).addClass('hidden');
    $('#addReplyTicket_'+tid).addClass('hidden');
});

$(document).on('click','.addReplyTicket',function(){
    var tid =$(this).data('tid');
    var message = $('#replyText_'+tid).val();
    ajaxCallback({'TICKETID':tid, 'MESSAGE':message},'createReply','createReplyCallBack');
});

function createReplyCallBack(result){
    var tid = result[0].ticket_id;
    var html = '<div class="col-md-8 col-sm-12 col-xs-12">'+
                    '<b class="col-md-4">'+ result[0].author+' : </b>'+
                    '<p class="pSmall col-md-8">'+ result[0].message+'</p>'+
                '</div>';
    $('#containerReplies_'+tid).append(html);
    $('#replyText_'+tid).val('');
    toastr.success('Reply post!',"Success.");
}

$(document).on('click','#openTicket',function(){
    window.location.href = 'showCreateTicket';
});

$(document).on('click','.closeTicket',function(){
    var tid = $(this).data('tid');
    ajaxCallback({'TID':tid},'closeTicket','closeTicketCallback')
});

function closeTicketCallback(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.','Error');
    else{
        $('#ticketContainer_'+result).hide();
        toastr.success('Ticket Closed!','Success');
    }
}


/*********** functions for sign legal documents ******************/
var doc;

$(document).on('click','#showDocsDiv', function () {
    var pid = $(this).data('pid');
    $('#acceptElectronicSign').data('pid',pid);
    $('#acceptElectronicSign').data('onedoc',-1);
    $('#signModal').modal('show');
});

$(document).on('click','#showOnlyDoc', function () {
    var pid = $(this).data('pid');
    doc = $(this).data('doc');
    $('#acceptElectronicSign').data('pid',pid);
    $('#acceptElectronicSign').data('oneDoc',1);
    $('#signModal').modal('show');
});

$(document).on('click','#acceptElectronicSign', function () {
    var pid = $(this).data('pid');
    var oneDoc = $(this).data('onedoc');
    if(oneDoc == 1)
        location.href = '../clientServices/sign?DOCUMENT='+doc+'&ID='+pid;
    else
        location.href = '../client_services/docs/'+pid;
});

