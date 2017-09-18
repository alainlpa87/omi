//start the counter for inactivity
/*$(document).idleTimeout({
    redirectUrl: 'logout',       // redirect to this url
    idleTimeLimit: 600,//300            // 15 seconds 'No activity' time limit in seconds.
    activityEvents: 'click keypress scroll wheel mousewheel',    // separate each event with a space
    dialogDisplayLimit: 60,       // Time to display the warning dialog before logout (and optional callback) in seconds
    sessionKeepAliveTimer: false  // Set to false to disable pings.
});*/


//Create Appointments Modal.
$('#btnAppointment').click(function(e){
    $("#formAppointment")[0].reset();
    $('#appointmentModal').modal('show');
});

//Submit Appointment.
$('#submitbtnAppointment').click(function(e){
    var fakeDate = $("#dateAppointment").val();
    var note = $("#noteAppointment").val();
    if(fakeDate != '' && note != ''){
        var res = fakeDate.replace("-", "");
        var date = new Date(res);
        var stamp = date.getFullYear()+ "-" +(date.getMonth() + 1) + "-" + date.getDate()+" "+date.getHours() + ":" + date.getMinutes()+ ":00"
        var data = {'DATE': stamp,'NOTE':note};
        ajaxCall(data,'createAppointment',"Appointment Saved.","");
    }else{
        toastr.error("All fields are required.","Error!!");
    }

});

//load Appointment on time.
function loadAppointments()
{
    ajaxCallback('','loadAppointment','showAppointment');
}

//show the appointment in a new window
function showAppointment(id)
{
    if(id != "-1"){
        open('showAppointment?ID='+id, 'alerta', 'width=500, height=305, left=300, top=200, location=no, directories=no, menubar=no, status=no, toolbar=no, scroolbar=no ');
    }
}
//initialize Appointment DateTimePicker
function initializeDateTimePicker(){
    $("#dateAppointment").datetimepicker({
        isRTL: 'false',
        format: "dd MM yyyy - HH:ii P",
        showMeridian: true,
        autoclose: true,
        pickerPosition: "bottom-left",
        todayBtn: true
    });
}
//log out the consultant from the system
$('#spanUser').click(function(){
    ajaxCallback('','logout','reloadWindow');
});

//change the phone the consultant want to use
$('#spanPhone').click(function(){
    if($('#userDID').html()==$(this).data('phone'))
        $('#userDID').html($(this).data('phone2'));
    else
        $('#userDID').html($(this).data('phone'));
    setCurrentConsultantPhone($('#userDID').html());
});

//Look if there is new mails in the DB for the current consultant
function mailsys()
{
    ajaxCallback('','mailsys','paintNewInbox');
}
//Set the new total of mails for the current consultant
function paintNewInbox(total)
{
   $('#userInbox').html(total);
}
//Load the callers ranking from the DB
function leaders()
{
    ajaxCallback('','leaders','paintCallers');
}
//Paint the caller ranking in the left side
function paintCallers(callers)
{
    var htmlCallers = '';
    $.each(callers,function( key,caller )
    {
        htmlCallers+="<div class='leader col-md-12'><span><strong>"+caller.usr+"</strong><span class='cantCalls'>"+caller.cant+"</span></span></div>";
    });
    if(htmlCallers=="")
        htmlCallers+="<div class='leader col-md-12'><span><strong>No calls for Today</strong></span></div>";
    $('.container-callers').html(htmlCallers);
}
//show Settings Modal
$('#spanSettings').click(function(e){
    $('#settingsModal').modal('show');
});


//Change names voice messages
$('.setVMName').click(function(e){
    var id = $(this).attr("data-vm");
    var newName = $('#vmName_'+id).val();
    ajaxCall({VM: id,TITLE: newName},'setNameVM',"","");
    $('#vmName_'+id).css('border','1px solid darkgreen');
});
//Save DID2
$('.setDID2').click(function(e){
    var newDID2 = $('#settingsDID2').val();
    if(validatePhone(newDID2))
    {
        ajaxCall({VALUE: newDID2,COLUMN: 'did2'},'updateConsultantInfo',"","");
        $('#settingsDID2').css('border','1px solid darkgreen');
    }
    else
        $('#settingsDID2').css('border','1px solid red');

});
//Save leadNotiOpt
$('.setAllowTextNotification').click(function(e){
    var leadNotiOpt = $('#settingsAllowText').val();
    ajaxCall({VALUE: leadNotiOpt,COLUMN: 'leadNotiOpt'},'updateConsultantInfo',"","");
    $('#settingsAllowText').css('border','1px solid darkgreen');

});
//allow use extention number as outgoing DID
$('#useExt').click(function(e){
    var request = $(this).is(":checked")?"ENABLED":"DISABLED";
    ajaxCall({'REQUEST':request},'useExt',request=='ENABLED'?'Use Ext allowed successfully.':'Disabled Use Ext successfully.','We couldn\'t complete the action requested right now, please try later.');
});

//Save notino
$('.setTextNotificationNumber').click(function(e){
    var notino = $('#settingsTextNotificationNumber').val();
    if(validatePhone(notino))
    {
        ajaxCall({VALUE: notino,COLUMN: 'notino'},'updateConsultantInfo',"","");
        $('#settingsTextNotificationNumber').css('border','1px solid darkgreen');
    }
    else
        $('#settingsTextNotificationNumber').css('border','1px solid red');

});
//Call load Messages from DB
$('#spanInbox').click(function(e){
    ajaxCallback('','loadInbox','paintInbox');
});

$(document).on('click','.checkFinish',function(e){
    var id = $(this).data('id');
    ajaxCall({'ID':id,'STATUS':($(this).prop('checked')?1:0)},'finishMsgCs','Saved','Sorry something went wrong');
});
//Paint the messages in the modal
function paintInbox(messages)
{
    $('.container-inbox-payment-new').html('');
    $('.container-inbox-payment-old').html('');
    $('.container-inbox-client-new').html('');
    $('.container-inbox-client-old').html('');
    $('.container-inbox-files-new').html('');
    $('.container-inbox-files-old').html('');
    $('.container-inbox-production-new').html('');
    $('.container-inbox-production-old').html('');
    $('.container-inbox-clientServices-new').html('');
    $('.container-inbox-clientServices-old').html('');
    $('.container-inbox-ilc-new').html('');
    $('.container-inbox-ilc-old').html('');
    var messagesHtml = '';
    var total=0;
    //News messages
    for(var i=0;i<messages['NEWPAYMENT'].length;i++)
    {
        messagesHtml+="<div class='inboxMessage newMessage'><p><strong>"+messages['NEWPAYMENT'][i].subject+"</strong></p><span>"+messages['NEWPAYMENT'][i].message+"</span></div>";
        total++;
    }
    if(messages['NEWPAYMENT'].length>0)
    {
        $('#counMessagePayment').html(" "+messages['NEWPAYMENT'].length+" <i class='fa fa-envelope-o'></i>");
    }
    else
        $('#counMessagePayment').html(" 0 <i class='fa fa-envelope-o'></i>");
    $('.container-inbox-payment-new').html(messagesHtml.length>0?messagesHtml:"You don't have new messages.");

    messagesHtml = '';
    for(var i=0;i<messages['NEWCLIENT'].length;i++)
    {
        messagesHtml+="<div class='inboxMessage newMessage'><p><strong>"+messages['NEWCLIENT'][i].subject+"</strong></p><span>"+messages['NEWCLIENT'][i].message+"</span></div>";
        total++;
    }
    if(messages['NEWCLIENT'].length>0)
    {
        $('#counMessageClient').html(" "+messages['NEWCLIENT'].length+" <i class='fa fa-envelope-o'></i>");
    }
    else
        $('#counMessageClient').html(" 0 <i class='fa fa-envelope-o'></i>");
    $('.container-inbox-client-new').html(messagesHtml.length>0?messagesHtml:"You don't have new messages.");

    messagesHtml = '';
    for(var i=0;i<messages['NEWFILE'].length;i++)
    {
        messagesHtml+="<div class='inboxMessage newMessage'><p><strong>"+messages['NEWFILE'][i].subject+"</strong></p><span>"+messages['NEWFILE'][i].message+"</span></div>";
        total++;
    }
    if(messages['NEWFILE'].length>0)
    {
        $('#counMessageFiles').html(" "+messages['NEWFILE'].length+" <i class='fa fa-envelope-o'></i>");
    }
    else
        $('#counMessageFiles').html(" 0 <i class='fa fa-envelope-o'></i>");
    $('.container-inbox-files-new').html(messagesHtml.length>0?messagesHtml:"You don't have new messages.");

    messagesHtml = '';
    for(var i=0;i<messages['NEWPRODUCTION'].length;i++)
    {
        messagesHtml+="<div class='inboxMessage newMessage'><p><strong>"+messages['NEWPRODUCTION'][i].subject+"</strong></p><span>"+messages['NEWPRODUCTION'][i].message+"</span></div>";
        total++;
    }
    if(messages['NEWPRODUCTION'].length>0)
    {
        $('#counMessageProduction').html(" "+messages['NEWPRODUCTION'].length+" <i class='fa fa-envelope-o'></i>");
    }
    else
        $('#counMessageProduction').html(" 0 <i class='fa fa-envelope-o'></i>");
    $('.container-inbox-production-new').html(messagesHtml.length>0?messagesHtml:"You don't have new messages.");

    messagesHtml = '';
    for(var i=0;i<messages['NEWCLIENTSERVICES'].length;i++)
    {
        messagesHtml+="<div class='inboxMessage newMessage'><p><strong>"+messages['NEWCLIENTSERVICES'][i].subject+"</strong></p><span>"+messages['NEWCLIENTSERVICES'][i].message+"</span></div>";
        total++;
    }
    if(messages['NEWCLIENTSERVICES'].length>0)
    {
        $('#counMessageClientServices').html(" "+messages['NEWCLIENTSERVICES'].length+" <i class='fa fa-envelope-o'></i>");
    }
    else
        $('#counMessageClientServices').html(" 0 <i class='fa fa-envelope-o'></i>");
    $('.container-inbox-clientServices-new').html(messagesHtml.length>0?messagesHtml:"You don't have new messages.");

    messagesHtml = '';
    for(var i=0;i<messages['NEWILC'].length;i++)
    {
        messagesHtml+="<div class='inboxMessage newMessage'><p><strong>"+messages['NEWILC'][i].subject+"</strong></p><span>"+messages['NEWILC'][i].message+"</span></div>";
        total++;
    }
    if(messages['NEWILC'].length>0)
    {
        $('#counMessageILC').html(" "+messages['NEWILC'].length+" <i class='fa fa-envelope-o'></i>");
    }
    else
        $('#counMessageILC').html(" 0 <i class='fa fa-envelope-o'></i>");
    $('.container-inbox-ilc-new').html(messagesHtml.length>0?messagesHtml:"You don't have new messages.");


    //Old Messages
    messagesHtml = '';
    for(var i=0;i<messages['OLDPAYMENT'].length;i++)
    {

        if($('#spanUser').data('id') == '25'){
            messagesHtml+="<div class='inboxMessage oldMessage'><p><strong>"+messages['OLDPAYMENT'][i].subject+"</strong>&nbsp;&nbsp;<input type='checkbox' "+(messages['OLDPAYMENT'][i].finish == 1?checked='checked':'')+" id='finish_"+messages['OLDPAYMENT'][i].id+"' class='checkFinish' data-id='"+messages['OLDPAYMENT'][i].id+"'></p><span>"+messages['OLDPAYMENT'][i].message+"</span></div>";
        }else{
            messagesHtml+="<div class='inboxMessage oldMessage'><p><strong>"+messages['OLDPAYMENT'][i].subject+"</strong></p><span>"+messages['OLDPAYMENT'][i].message+"</span></div>";
        }
        total++;
    }
    $('.container-inbox-payment-old').html(messagesHtml.length>0?messagesHtml:"You don't have messages.");
    messagesHtml = '';
    for(var i=0;i<messages['OLDCLIENT'].length;i++)
    {
        if(messages['OLDCLIENT'][i].createdBy == 'CONSULTANT'){
            messagesHtml+="<div class='inboxMessage oldMessageConsultant'><p><strong>"+messages['OLDCLIENT'][i].subject+"</strong></p><span>"+messages['OLDCLIENT'][i].message+"</span></div>";
        }else{
            messagesHtml+="<div class='inboxMessage oldMessage'><p><strong>"+messages['OLDCLIENT'][i].subject+"</strong></p><span>"+messages['OLDCLIENT'][i].message+"</span></div>";
        }
        total++;
    }
    $('.container-inbox-client-old').html(messagesHtml.length>0?messagesHtml:"You don't have messages.");
    messagesHtml = '';
    for(var i=0;i<messages['OLDFILE'].length;i++)
    {
        messagesHtml+="<div class='inboxMessage oldMessage'><p><strong>"+messages['OLDFILE'][i].subject+"</strong></p><span>"+messages['OLDFILE'][i].message+"</span></div>";
        total++;
    }
    $('.container-inbox-files-old').html(messagesHtml.length>0?messagesHtml:"You don't have messages.");
    messagesHtml = '';
    for(var i=0;i<messages['OLDPRODUCTION'].length;i++)
    {
        messagesHtml+="<div class='inboxMessage oldMessage'><p><strong>"+messages['OLDPRODUCTION'][i].subject+"</strong></p><span>"+messages['OLDPRODUCTION'][i].message+"</span></div>";
        total++;
    }
    $('.container-inbox-production-old').html(messagesHtml.length>0?messagesHtml:"You don't have messages.");
    messagesHtml = '';
    for(var i=0;i<messages['OLDCLIENTSERVICES'].length;i++)
    {
        if($('#spanUser').data('id') == '25'){
            messagesHtml+="<div class='inboxMessage oldMessage'><p><strong>"+messages['OLDCLIENTSERVICES'][i].subject+"</strong>&nbsp;&nbsp;<input type='checkbox' "+(messages['OLDCLIENTSERVICES'][i].finish == 1?checked='checked':'')+" id='finish_"+messages['OLDCLIENTSERVICES'][i].id+"' class='checkFinish' data-id='"+messages['OLDCLIENTSERVICES'][i].id+"'></p><span>"+messages['OLDCLIENTSERVICES'][i].message+"</span></div>";
        }else{
            messagesHtml+="<div class='inboxMessage oldMessage'><p><strong>"+messages['OLDCLIENTSERVICES'][i].subject+"</strong></p><span>"+messages['OLDCLIENTSERVICES'][i].message+"</span></div>";
        }
        total++;
    }
    $('.container-inbox-clientServices-old').html(messagesHtml.length>0?messagesHtml:"You don't have messages.");
    if(total>0)
        $('#inboxModal').modal('show');
    else
        toastr.error('You don\'t have messages to show','Not Found');

    messagesHtml = '';
    for(var i=0;i<messages['OLDILC'].length;i++)
    {
        if($('#spanUser').data('id') == '25'){
            messagesHtml+="<div class='inboxMessage oldMessage'><p><strong>"+messages['OLDILC'][i].subject+"</strong>&nbsp;&nbsp;<input type='checkbox' "+(messages['OLDILC'][i].finish == 1?checked='checked':'')+" id='finish_"+messages['OLDILC'][i].id+"' class='checkFinish' data-id='"+messages['OLDILC'][i].id+"'></p><span>"+messages['OLDILC'][i].message+"</span></div>";
        }else{
            messagesHtml+="<div class='inboxMessage oldMessage'><p><strong>"+messages['OLDILC'][i].subject+"</strong></p><span>"+messages['OLDILC'][i].message+"</span></div>";
        }
        total++;
    }
    $('.container-inbox-ilc-old').html(messagesHtml.length>0?messagesHtml:"You don't have messages.");
    if(total>0)
        $('#inboxModal').modal('show');
    else
        toastr.error('You don\'t have messages to show','Not Found');
}

$(document).on('click','.showTicketsView',function(){
    window.location.href = 'showTicketsToCS';
});

$(document).on('click','#btnShareNote',function(){
    $('.receiverNote').each(function (index, value){
        $(this).prop('checked',false);
        //if is a consultant
        if(($(this).data('rol') == 'consultant' || $(this).data('rol') == 'consultant,score') && $(this).data('usr') =='consultant'){
            $(this).parent().addClass('hidden');
        }
        if($(this).data('usr') == $(this).data('currentusr'))
            $(this).parent().addClass('hidden');

    });
    $('#noteToShare').val('');
    $('#shareNote').data('pid',$(this).data('pid'));
    $('#shareNoteModal').modal('show');
});

$(document).on('click','#shareNote', function () {
    var receivers =[];
    var sender='';
    var pid =
    $('.receiverNote').each(function (index, value){
        if(sender == '')
            sender = $(this).data('currentusr');
        if($(this).is(":checked"))
            receivers.push($(this).data('usr'));
    });

    if(currentProject.id == -1)
        swal({title: "You must select one project.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    else if(receivers.length == 0)
        swal({title: "You must select at least one receiver for the note.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    else if($('#noteToShare').val().trim() == '')
        swal({title: "You must write the note.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    else{
        ajaxCall({'PID':$(this).data('pid'),'NOTE':$('#noteToShare').val(),'TO':receivers,'FROM':sender},'shareNote','Note shared!!!!','An error has happened, please try later.');
    }

});



