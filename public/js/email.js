var listMsgTemplate= null;

//Send Emails Lead
$('#selectSendEmail').change(function(e){
    var lead = getCurrentLead();
    if(lead != -1){
        var action = $(this).val();
        var text = (action == 'submissionKit'?"You want to send a Submission Kit?":(action == 'emailConsInfo'?"You want to send a Consultant Info Email?":"You want to send a Trying To Reach You Email?"));
        swal({
                title: "Are you sure?",
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true },
            function(isConfirm){
                if (isConfirm) {
                    switch (action){
                        case 'submissionKit':
                            ajaxCall({'LEAD':lead},'submissionKit',"Email Sent.","Only 1 email per week.");
                            break;
                        case 'emailConsInfo':
                            ajaxCall({'LEAD':lead},'emailConsInfo',"Email Sent.","Only 1 email per week.");
                            break;
                        case 'tryingToReachYou':
                            ajaxCall({'LEAD':lead},'tryingToReachYou',"Email Sent.","Only 1 email per week.");
                            break;
                    }
                }else{
                    $('#selectSendEmail').val(0);
                }
            }
        );
    }else{
        toastr.error("Select a Lead First.","Error!!");
    }
});

//Send Emails Project


$('#selectSendEmailProject').unbind().change(function(e){
    var project = getCurrentProject();
    if(project != -1){
        var action = $(this).val();
        if(action == 'sendMsg'){
            ajaxCallback({'PROJECT':project},'getMsgTemplate','sendMsgCallBack');
            return;
        }else
        {
            var text = (action == 'JVA'?"You want to send a JVA?":"You want to send a Image Text?");
            swal({
                    title: "Are you sure?",
                    text: text,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true },
                function(isConfirm){
                    if (isConfirm) {
                        switch (action){
                            case 'JVA':
                                ajaxCall({'PROJECT':project},'joinVentAgrmt',"Email Sent.","");
                                break;
                            case 'imgMsg':
                                var phone = $('#inputCurrentPhone').val();
                                var consultantPhone = getCurrentConsultantPhone();
                                ajaxCall({'FROM':consultantPhone, 'TO':phone, 'COMMAND':'mms'},'smsOut',"Message Sent.","");
                                break;
                        }
                    }else{
                        $('#selectSendEmailProject').val(0);
                    }
                }
            );
        }
    }else{
        toastr.error("Select a Project First.","Error!!");
    }
});

//Show a modal to send the message
function sendMsgCallBack(messages)
{
    listMsgTemplate = messages;
    $.each(messages , function(index, value){
        var option = '<option value="'+(parseInt(index)+1)+'">'+value.TITLE+'</option>'
        $('#messages').append(option);
    });

    msgBodyEvents();
    var phone = $('#inputCurrentPhone').val();
    $('#messages').val(0);
    $('#msg_body').html("");
    $('#msg_body').val("");
    $('#sendTextModal').find('#msg_number').val(phone);
    $('#sendTextModal').modal('show');
}

function msgBodyEvents(){
    $('#msg_body').keyup(function(e){

        $('#spanCountCaract').html($('#msg_body').val().length+' of 160 caracters');
        if($('#msg_body').val().length/160>1 )
        {
            $('.agreewarn').remove();
            $('#spanCountCaract').css('color','red').after("&nbsp;&nbsp;<span class='agreewarn'><i class='fa fa-arrow-up'></i>&nbsp;This text will be send in "+(Math.floor(($('#msg_body').val().length/160))+1)+" messages.</span>");
        }
        else
        {
            $('.agreewarn').remove();
            $('#spanCountCaract').css('color','black');
        }
    })

    $('#messages').change(function(e){
        $('#msg_body').html(listMsgTemplate[parseInt($('#messages').val())-1].TEXT.replace(/\<br>/g, '\n'));
        $('#msg_body').val(listMsgTemplate[parseInt($('#messages').val())-1].TEXT.replace(/\<br>/g, '\n'));
        $('#spanCountCaract').html($('#msg_body').val().length+' of 160 caracters');
        if($('#msg_body').val().length/160>1 )
        {
            $('.agreewarn').remove();
            $('#spanCountCaract').css('color','red').after("&nbsp;&nbsp;<span class='agreewarn'><i class='fa fa-arrow-up'></i>&nbsp;This text will be send in "+(Math.floor(($('#msg_body').val().length/160))+1)+" messages.</span>");
        }
    })

    $('#modalSendMSG').unbind().click(function(){
        var phone = $('#msg_number').val();
        var consultantPhone = getCurrentConsultantPhone();
        var sms = $('#msg_body').val().replace(/\r?\n/g, '<br>');
        ajaxCall({'SMS': sms, 'FROM':consultantPhone, 'TO':phone, 'COMMAND':'smsSub'},'smsOut',"Message Sent.","");
        $('#selectSendEmailProject').val(0);
    })
}
