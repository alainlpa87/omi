$(document).ready(function(e){
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    portletEvents();
});


//events for portlets
function portletEvents()
{
   //load in the form the data for the consultant
    $(document).on('click','.btnManageConsultant',function(e){
        var id = $('.consultantSelect').val();
        if(id==-1)
        {
            $('.btnSaveConsultant').html('Create Consultant');
            $('h3ManageInfo').html('Create Consultant');
            $('#consultantData').trigger("reset");
        }
        else
        {
            ajaxCallback({'ID':id},'loadDataConsultant','loadFormConsultant');
            $('.btnSaveConsultant').html('Update Consultant');
            $('h3ManageInfo').html('Update Consultant');
        }
    });
    $(document).on('click','.btnSaveConsultant',function(e){
        updateDataConsultant();
    });
}
//load in the form the data for the consultant
function loadFormConsultant(data)
{
    var consultant = data['consultant'];
    var shedule = data['shedule'];
    if(consultant!=-1)
    {
        $('#fname').val(consultant.fname);
        $('#lname').val(consultant.lname);
        $('#username').val(consultant.usr);
        $('#password').val(consultant.password);
        $('#did').val(consultant.did);
        $('#did2').val(consultant.did2);
        $('#ext').val(consultant.ext);
        $('#email').val(consultant.email);
        $('#shift').val(consultant.shift);
        $('#type').val(consultant.utype);
        $('#token').val(consultant.remember_token);

        if(consultant.leads)
            $('#leads').prop('checked',true);
        else
            $('#leads').prop('checked',false);

        if(consultant.oldleadslikenew)
            $('#oldLeads').prop('checked',true);
        else
            $('#oldLeads').prop('checked',false);

        if(consultant.oldleads21)
            $('#oldLeads21').prop('checked',true);
        else
            $('#oldLeads21').prop('checked',false);

        $('#allowToWorkFromHome').prop('checked',false);
        $('#noAllowToWorkFromHomeAtAll').prop('checked',false);
        if(shedule != -1){
            if(shedule.dayException == 'week')
                $('#allowToWorkFromHome').prop('checked',true);
            else
                $('#allowToWorkFromHome').prop('checked',false);

            if(shedule.hOutsideMade >= 25200)
                $('#noAllowToWorkFromHomeAtAll').prop('checked',true);
            else
                $('#noAllowToWorkFromHomeAtAll').prop('checked',false);
        }

        if(consultant.allowRecording)
            $('#allowRecording').prop('checked',true);
        else
            $('#allowRecording').prop('checked',false);

        if(consultant.imi)
            $('#imi').prop('checked',true);
        else
            $('#imi').prop('checked',false);

        /*if(consultant.cmp)
            $('#cmp').prop('checked',true);
        else
            $('#cmp').prop('checked',false);

        if(consultant.cmf)
            $('#cmf').prop('checked',true);
        else
            $('#cmf').prop('checked',false);*/

        if(consultant.live)
            $('#live').prop('checked',true);
        else
            $('#live').prop('checked',false);

        if(consultant.live_n)
            $('#live_n').prop('checked',true);
        else
            $('#live_n').prop('checked',false);

        /*if(consultant.n42)
            $('#n42').prop('checked',true);
        else
            $('#n42').prop('checked',false);

        if(consultant.seo)
            $('#seo').prop('checked',true);
        else
            $('#seo').prop('checked',false);
*/
        if(consultant.omi)
            $('#omi').prop('checked',true);
        else
            $('#omi').prop('checked',false);

        if(consultant.def)
            $('#def').prop('checked',true);
        else
            $('#def').prop('checked',false);

        /*if(consultant.pal)
            $('#pal').prop('checked',true);
        else
            $('#pal').prop('checked',false);*/
    }
    else
    {

    }

}
function updateDataConsultant()
{
    var id =$('.consultantSelect').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var did = $('#did').val();
    var token = $('#token').val();
    var did2 = $('#did2').val();
    var ext = $('#ext').val();
    var email = $('#email').val();
    var shift = $('#shift').val();
    var type = $('#type').val();
    var leads = $('#leads').is(':checked')?1:0;
    var oldLeads = $('#oldLeads').is(':checked')?1:0;
    var oldLeads21 = $('#oldLeads21').is(':checked')?1:0;
    var allowToWorkFromHome = $('#allowToWorkFromHome').is(':checked')?1:0;
    var noAllowToWorkFromHomeAtAll = $('#noAllowToWorkFromHomeAtAll').is(':checked')?1:0;
    var allowRecording = $('#allowRecording').is(':checked')?1:0;
    var imi = $('#imi').is(':checked')?1:0;
    /*var cmp = $('#cmp').is(':checked')?1:0;
    var cmf = $('#cmf').is(':checked')?1:0;
    var cmr = $('#cmr').is(':checked')?1:0;*/
    var live =$('#live').is(':checked')?1:0;
    var live_n =  $('#live_n').is(':checked')?1:0;
   /* var n42 = $('#n42').is(':checked')?1:0;
    var seo = $('#seo').is(':checked')?1:0;*/
    var omi = $('#omi').is(':checked')?1:0;
    var def = $('#def').is(':checked')?1:0;
    //var pal = $('#pal').is(':checked')?1:0;
    if(fname==""||username==""||did==""||ext=="")
    {
        toastr.error('The first name, username, did and ext can\'t be empty',"Error!!");
        return false;
    }
    ajaxCall({'ID':id,'FNAME':fname,'LNAME':lname,'USR':username,'PASSWORD':password,'DID':did,'DID2':did2,'EXT':ext,
    'EMAIL':email,'SHIFT':shift,'TYPE':type,'LEADS':leads,'NOTALLOWTOWORKFROMHOMEATALL':noAllowToWorkFromHomeAtAll,'WORKFROMHOMEOFFICEHOURS':allowToWorkFromHome,'OLDLEADS':oldLeads,'OLDLEADS21':oldLeads21,'ALLOWRECORDING':allowRecording,'IMI':imi,'CMP':0,'CMF':0,'CMR':0,
    'LIVE':live,'LIVE_N':live_n,'N42':0,'SEO':0,'OMI':omi,'DEF':def,'PAL':0,'TOKEN':token},'updateDataConsultant','Consultant '+(id==-1?"created":"updated")+" successfully.",'we couldn\'t  '+(id==-1?"created":"updated")+" the consultant.There is already a consultant with the same username.");
}