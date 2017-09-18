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
    if($('#ideaName') != undefined){
        var projectId = $('#ideaName').data('id');
        ajaxCallback({'ID':projectId},'../../loadFilesLaunch','loadFilesLaunchCallback');
    }
})

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
//save the questions in the DB
function saveProjectData(id)
{

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

$(document).on('click','#showOnlyDoc', function () {
    var pid = $(this).data('pid');
    doc = $(this).data('doc');
    $('#acceptElectronicSign').data('pid',pid);
    $('#acceptElectronicSign').data('oneDoc',1);
    $('#signModal').modal('show');
});

$(document).on('click','#showDocsDiv', function () {
    var pid = $(this).data('pid');
    $('#acceptElectronicSign').data('pid',pid);
    $('#acceptElectronicSign').data('onedoc',-1);
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