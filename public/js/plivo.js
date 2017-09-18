var consultantPhone = null;

//connect
$('#btnConnect').click(function(e){
    consultantPhone = getCurrentConsultantPhone();
    ajaxCall({'PHONE':consultantPhone},'callHome',"","");
});

//dial a number
$('#btnDial').click(function(e){
    var phone = $('#inputCurrentPhone').val();
    if(phone != ''){
        var data = {'FROM':consultantPhone,'TO':phone};
        ajaxCall(data,'boss',"","");
        var lead = getCurrentLead();
        var d = new Date();
        var datestring = d.getFullYear() + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" +("0" + d.getDate()).slice(-2) + " " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2)+ ":" + ("0" + d.getSeconds()).slice(-2);
        $('#last_c_'+lead).html(datestring);
        $('#container_'+lead).attr('data-last',datestring);
    }
});

//HangUp
$('#btnHangUp').click(function(e){
    ajaxCall('','hanger',"","");
});

//dial a number
$('#btnSendTextLead').click(function(e){
    var phone = $('#inputCurrentPhone').val();
    if(phone != ''){
        var msg = $('#selectSendText').val();
        var data = {'FROM':consultantPhone,'TO':phone,COMMAND:'smsLead',MSG:msg};
        ajaxCall(data,'smsOut',"Message sent successfully.","");
    }
});

//Record a Call
$('#btnRecordCall').click(function(e){
    var phone = $('#inputCurrentPhone').val();
    if(phone != ''){
        if($('#btnRecordCall i').hasClass('fa-microphone')){
            ajaxCallback({'TO':phone},'recordCall','callbackRecordCall');
        }else if($('#btnRecordCall i').hasClass('fa-stop')){
            var recordId = $('#btnRecordCall').attr('recordId');
            ajaxCallback({'RECORD':recordId},'stopRecordCall','callbackRecordCall');
        }

    }
});

//Leave VM
$('#btnLeaveVM').click(function(e){
    var phone = $('#inputCurrentPhone').val();
    var vm = $('#selectLeaveVM').val();
    if(phone != ''){
        var msg = $('#selectSendText').val();
        var data = {'TO':phone,VM:vm};
        ajaxCall(data,'sendvm',"","");
    }
});

//function call it in record call callback
function callbackRecordCall(param)
{
    if(param == 'STOP'){
        $('#btnRecordCall').attr('recordId','');
        $('#btnRecordCall').html('<i class="fa fa-microphone"></i> Stop Recorder');
    }else{
        $('#btnRecordCall').attr('recordId',param);
        $('#btnRecordCall').html('<i class="fa fa-stop"></i> Stop Recorder');
    }
}
//Set the voice messages
$(".setvm").click(function(event)
{
    var id = $(this).attr("data-vm");
    consultantPhone = getCurrentConsultantPhone();
    ajaxCall({VM: id,TO: consultantPhone},'vmBoss',"","");
});