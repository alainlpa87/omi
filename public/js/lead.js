var consultantPhone,currentLead= null;
$(document).ready(function(e){
    callIntervalFunction();
    setInterval("callIntervalFunction()", 60000);
    initializeDateTimePicker();
    currentLead = {id:-1};
    consultantPhone = $('#userDID').html();
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    portletEvents();
    createLastVisitedBox("");
});
function createLastVisitedBox(newValue)
{
    $('.container-last').html('');
    var lastVisited = localStorage.getItem("lastVisitedLead")?localStorage.getItem("lastVisitedLead").split('-'):[];
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
    localStorage.setItem("lastVisitedLead",newLastVisited);
}
//call all our interval function
function callIntervalFunction(){
    loadNewLeads();
    loadAppointments();
    updateTime();
    mailsys();
    leaders();
}

//Return the id of the current lead.
function getCurrentLead()
{
    return currentLead.id;
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
    // update logs
    $(document).on('click','.updateLogs',function(e){
        var id = $(this).data('id');
        ajaxCallback({'ID':id},'updateLogsLead','updateLogsCallback');
    });

    $('#scriptToReed').change(function(e){
        if($('#scriptToReed').val() != 0){
            window.open($(this).val(),'_blank');
            $('#scriptToReed').val(0);
        }
    });

    //Update the color of the portlet when a flag is clicked
    $(document).on('click','.flag',function(e){
        var color = $(this).data('color');
        var id = $(this).data('id');
        var size = color=="black"?1:4;
        $('#container_'+id).css('border',size+'px solid '+color);
        $('#flag_portletBody_'+id).html(color);
        color =  color=="black"?"transparent":color;
        ajaxCall({'ID':id,'FLAG':color},'updateFlag',"","");
    });

    //Save in the DB the notes typed
    $(document).on('click','.btnUpdateNotes',function(e){
        var id = $(this).data('id');
        ajaxCall( {'ID':id,'NOTES':$('#notes_'+id).val()},'updateNotes',"Notes updated successfully.","We couldn't updated the notes, please try later");
    });

    //Send all the current information to the Controller and update it in the DB
    //Update the lead info in the Basic Tab and in the CurrentPhone input
    //Update phone2 checkable to allow it to be selected for the calls
    $(document).on('click','.btnUpdateLead',function(e){
        var id = $(this).data('id');
        var fname =$('#fname_'+id).val();
        var lname =$('#lname_'+id).val();
        var phone =$('#phone_'+id).val();
        var phone2 =$('#phone2_'+id).val();
        var email =$('#email_'+id).val();
        var street =$('#street_'+id).val();
        var street2 =$('#street2_'+id).val();
        var city =$('#city_'+id).val();
        var state =$('#state_'+id).val();
        var zip =$('#zip_'+id).val();
        if(validatePhone(phone) && (phone2.length==0 || validatePhone(phone2)))
        {
            var data = {'ID':id,'FNAME':fname,'LNAME':lname,'PHONE':phone,'PHONE2':phone2,'EMAIL':email,'STREET':street,'STREET2':street2,'CITY':city,'STATE':state,'ZIP':zip};
            ajaxCall(data,'updateBasicDataLead',"Lead updated successfully.","We couldn't updated the lead, please try later");

            var currentPhone = $('.checkPhone').is(":checked")?phone2:phone;
            $('.inputCurrentPhone').val(currentPhone);
            $('#phone_c_'+id).html(currentPhone);
            $('#email_c_'+id).html(email);
            $('#full_name_c_'+id).html(lname+", "+fname);

            if(phone2.length>0)
                $('#phone2_'+id).data('checkable',1);
            else
                $('#phone2_'+id).data('checkable',0);
        }
        else
            toastr.error("Invalid format for the phone number.","Error!!");
    });

    //Exclude a lead and save the reason for
    $(document).on('click','.btnRemoveLead',function(e){
        var id = $(this).data('id');
        var reason =$('#reason_'+id).val();
        ajaxCall({'ID':id,'REASON':reason},'deleteLead',"Lead removed successfully.","We couldn't removed the lead, please try later");
        $('#container_'+id).remove();
        currentLead = {id:-1};
        javascriptRecount();
    });

    //change the active phone for the lead to make a call
    $(document).on('click','.checkPhone',function(e){
        var isChecked=$(this).is(":checked");
        var phone2 = $('#phone2_'+currentLead.id).val();
        var phone1 = $('#phone_'+currentLead.id).val();
        if(isChecked)
        {
            if($('#phone2_'+currentLead.id).data('checkable')==1 && phone2.length>0 )
            {
                currentLead.phone = phone2;
                $('.inputCurrentPhone').val(phone2);
                $('#phone_c_'+currentLead.id).html(phone2);
            }
            else
                $(this).prop('checked', false);
        }
        else
        {
            currentLead.phone = phone1;
            $('.inputCurrentPhone').val(phone1);
            $('#phone_c_'+currentLead.id).html(phone1);
        }
    });

    //set as the current lead the portlet selected
    $(document).on('click','.portlet',function(e){

        if(currentLead.id!=$(this).data('id'))
        {
            var id =$(this).data('id');
            currentLead = {
                id:id,
                phone:$('#phone_'+id).val(),
                email:$('#email_'+id).val()
            };
            $('.inputCurrentPhone').val(currentLead.phone);
            $('.portlet-selected').removeClass('portlet-selected');
            $(this).addClass('portlet-selected');
            $('.checkPhone').prop('checked', false);
            $('#phone_c_'+currentLead.id).html(currentLead.phone);
            $('#selectSendEmail').val(0);
            createLastVisitedBox(id);
            $('#selectSendSms').val(0)
        }
    });
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
//Update the current time in all the portlets depends of his timezone
//Restore all the checked leads in the Modal
$('#restoreLeads').click(function(e){
    $.each($('.checkboxRestore'),function(value){
        if($(this).is(":checked"))
        {
            var id= $(this).data("id");
            ajaxCall({'ID':id},'restoreLead',"Lead restored successfully.","We couldn't restored the lead, please try later");
            ajaxCallback({'ID':id,'MOBILE':isMobile()?1:-1},'loadLead','paintNewLeads');
        }
    });
    $('#whoIsThisModal').modal('hide');
});
//Show Send Article Modal when an article is selected to be send
$('#selectSendArticle').change(function(e){
    if(currentLead.id!=-1)
    {
        $('#article_to_link').html($("#selectSendArticle option:selected").text());
        $('#email_to_link').html(currentLead.email);
        $('#phone_to_link').html(currentLead.phone);
        $('#lead_to_link').val(currentLead.id);
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
function updateTime()
{
    var now = new Date();
    $(".EST").html(formatAMPM(now));
    now.setHours(now.getHours()-1);
    $(".CST").html(formatAMPM(now));
    now.setHours(now.getHours()-1);
    //$(".MST").html(formatAMPM(now)); en horario de invierno
    $(".MDT").html(formatAMPM(now));
    now.setHours(now.getHours()-1);
    $(".PST").html(formatAMPM(now));
    $(".MST").html(formatAMPM(now));
    now.setHours(now.getHours()-1);
    $(".AST").html(formatAMPM(now));
    now.setHours(now.getHours()-2);
    $(".HST").html(formatAMPM(now));
}
//search for the unloaded leads
function loadNewLeads()
{
    var data = {'MOBILE':isMobile()?1:-1};
    ajaxCallback(data,'loadLeads','paintNewLeads');
}
//Paint new leads inside container-leads
function paintNewLeads(leads)
{
    for(var i=leads.length-1;i>=0;i--)
    {
        $('.container-portlets').prepend(leads[i]);
    }
    if(leads.length>0)
    {
        alert("You have new leads!");
        javascriptRecount();
    }

}
//Search leads by fname, lname, phone, email or fileno
function whoIsThis(params)
{
    ajaxCallback({'PARAMS':params},'findLead','paintFoundLeads');
}
//Show a modal with the result of search leads by some params
function paintFoundLeads(leads)
{
    var htmlFounds = '';
    if(leads.length>0)
    {
        $.each(leads,function( key,lead )
        {
            htmlFounds+="<div id='leadFound_"+lead.id+"' class='leadFound col-md-12 "+(lead.owned?"leadFoundOwned":"leadFoundNoOwned")+"'> " +
            "<input type='checkbox' class='checkboxRestore' data-id='"+lead.id+"' "+(lead.owned && lead.status == "EXCLUDE"?"":"disabled")+">" +
            "<span class='col-md-2'><strong>"+lead.fileno+"</strong></span>" +
            "<span class='col-md-7'>"+lead.fname+" "+lead.lname+"</span>" +
            "<span class='col-md-2'>"+lead.user+"</span>" +
            "</div>";
        });
        $('.container-founds').html(htmlFounds);
        //change the color if the lead Found is selected
        $('.checkboxRestore').click(function(e){
            var isChecked=$(this).is(":checked");
            var id = $(this).data("id");
            if(isChecked)
                $('#leadFound_'+id).addClass('leadFoundSelected');
            else
                $('#leadFound_'+id).removeClass('leadFoundSelected');
        });
        $('#whoIsThisModal').modal('show');
    }
    else
        toastr.error('Sorry no matches',"No Matches");
}
//Update the total leads showed in the view
function javascriptRecount()
{
    var visibles = $('.portlet:visible').length;
    var total = $(".portlet").length;
    $(".totalLeads").html("Total Leads: "+ (visibles==total ? total:(visibles + "/" + total)));
}
//Show or Hide portlets depends on days typed
$('#btnRestDays').click(function(e){
    var days  = $('#inputRestDays').val();
    if(days>0)
    {
        if($(this).data('active')==1)
        {
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-default');
            $(this).data('active',0);
            $(".dated").show();
            $(this).removeClass("dated");
            $('#inputRestDays').removeAttr('disabled');
            javascriptRecount();
        }
        else
        {
            $(this).removeClass('btn-default');
            $(this).addClass('btn-primary');
            $(this).data('active',1);
            var d = new Date();
            d.setDate(d.getDate() - days);
            $('#inputRestDays').attr('disabled','disabled');
            //$('#loadingModal').modal('show');
            $(".portlet").each(function()
            {
                if(Date.parse($(this).attr('data-last')) > d)
                {
                    $(this).hide();
                    $(this).addClass('dated');
                }
            });
            javascriptRecount();
            //$('#loadingModal').modal('hide');
        }
    }
    else
        toastr.error("Type the number of days first.","Error!!");
});
//Ask for more leads
$('#needMoreLeads').click(function(e){
    var totalLead = $(".portlet").length;
    if(totalLead >= 700)
        toastr.error('you have reached your maximum lead count.','SORRY.');
    else
        ajaxCall('','needMoreLeads','You will be able to see the leads in a few seconds','You have reached your maximum requests for today');
});
//move to the top the clicked lead
$(document).on('click','.lastProjectVisited',function(action){
    var id = $(this).data('id');
    if($('#container_'+id).length>0)
        $('html, body').animate({
            scrollTop: $('#container_'+id).offset().top-50
        }, 200);
});
//show create lead modal
$(document).on('click','.createLeadBtn',function(e){
    $("#createLeadForm").trigger('reset');
    $('#createLeadModal').modal('show');
});
//create New lead
$(document).on('click','#submitCreateLead',function(e){
    var fname = $('#fnameAction').val();
    var lname = $('#lnameAction').val();
    var email = $('#emailAction').val();
    var phone = $('#phoneAction').val();
    var street = $('#streetAction').val();
    var street2 = $('#street2Action').val();
    var city = $('#cityAction').val();
    var state = $('#stateAction').val();
    var zip = $('#zipAction').val();
    if(fname != "" && lname != "" && email != "" && phone != "" && street != "" && city != "" && state != "" && zip != "")
    {
        ajaxCallback({'FNAME':fname, 'LNAME':lname, 'EMAIL':email, 'PHONE':phone, 'STREET':street, 'STREET2':street2, 'CITY':city, 'STATE':state, 'ZIP':zip},'createNewLeadConsultant',"paintCreateLead");
    }
    else
    {
        toastr.error("Something is missing.","Error!!");
    }
});
function paintCreateLead(result)
{
    result.success==1?
        swal({title: "Lead "+result.fileno+" Created successfully. It will show you soon on the dialer.",
        type: "info",
        showCancelButton: false,
        confirmButtonColor: "#8CD4F5",
        confirmButtonText: "Ok",
        closeOnConfirm: true }):
        swal({title: "There is already a lead with the same email or phone. Fileno :"+result.fileno,
            type: "info",
            showCancelButton: false,
            confirmButtonColor: "#8CD4F5",
            confirmButtonText: "Ok",
            closeOnConfirm: true });
}

// updateLogsCallback
function updateLogsCallback(param){
    $('#portlet_tab_notes_'+currentLead.id+'_2 .logsTextarea').html(param);
}

//Send sms leads
$('#selectSendSms').unbind().change(function(e){
    if(currentLead.id != -1){
        var action = $(this).val();
        if(action == 'sendMsg'){
            ajaxCallback({'ID':currentLead.id},'getLeadMsgTemplate','sendMsgCallBack');
            return;
        }
    }else{
        toastr.error("Select a Lead First.","Error!!");
    }
});