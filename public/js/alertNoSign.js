/**
 * Created by jllopiz on 5/6/2016.
 */
$(document).ready(function(e){
    filesUpEm = [];
    signAlert();
});

function signAlert(){
    //////////////// PCT or EPO without pay
    var text = "";
    $('.docs_without_sing').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;width:20% !important;' class='col-md-2 col-sm-2 '>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;border-left:1px solid;display: inline;padding-left: 0px !important;padding-right: 0px !important;width:16% !important;' class='col-md-2 col-sm-2 '>PIN: " + pin + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;width:28% !important;' class='col-md-3 col-sm-3 '>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;width:36% !important;' class='col-md-5 col-sm-5'><button type='button' id='btnSendUpg_"+pin+"' style='display: inline;height: 20px;margin-bottom: 1px;' class='btn btn-primary btn-sm btnSendUpg' data-pin='"+pin+"'><span class='glyphicon glyphicon-envelope'></span>PCT/EPO </button><button type='button' id='btnSendUpgPCT_"+pin+"'  style='display: inline;height: 20px;margin-bottom: 1px;margin-left: 10px;'  class='btn btn-primary btn-sm btnSendUpgPCT' data-pin='"+pin+"'><span class='glyphicon glyphicon-envelope'></span>PCT</button><button type='button' id='closePCT_"+pin+"'  style='display: inline;height: 20px;margin-bottom: 1px;margin-left: 10px;'  class='btn btn-danger btn-sm closePCT' data-pin='"+pin+"'>X</button>" +
            "</div></div>";
        text+=msg;
    });
    if(text!=""){
        var html ="<table>" + text + "</table>";
        $('.container-docs').html(html);
    }
    /////////////PROVISIONALS to expire
    var text = "";
    $('.prov_to_expire').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='display: inlinepadding-left: 0px !important;padding-right: 0px !important;;' class='col-md-3 col-sm-3 col-xs-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;border-left:1px solid;display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-2 col-sm-2 col-xs-2'>PIN: " + pin + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-4 col-sm-4 col-xs-4'>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'><button type='button' id='btnSendProv_"+pin+"' style='display: inline;height: 20px;margin-bottom: 1px;' class='btn btn-primary btn-sm btnSendProv' data-pin='"+pin+"'> <span class='glyphicon glyphicon-envelope'></span> Send </button><button type='button' id='closeProv_"+pin+"' style='display: inline;height: 20px;margin-bottom: 1px;' class='btn btn-danger btn-sm closeProv' data-pin='"+pin+"'>X</button>" +
            "</div></div>";
        text+=msg;
    });
    if(text!=""){
        var html ="<table>" + text + "</table>";
        $('.container-prov').html(html);
    }
    //////////////WELCOME EMAIL CALL FOLLOW UP
    var textWE = "";
    $('.we_followup').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;border-left:1px solid;display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-2 col-sm-2 col-xs-2'>PIN: " + pin + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-4 col-sm-4 col-xs-4'>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'><button type='button' id='btnSendSMS_"+pin+"' style='display: inline;height: 20px;margin-bottom: 1px;' class='btn btn-primary btn-sm btnSendSMS' data-pin='"+pin+"'> <span class='glyphicon glyphicon-envelope'></span>Send Text</button>" +
            "</div></div>";
        textWE+=msg;
    });
    if(textWE!=""){
        var html ="<table>" + textWE + "</table>";
        $('.container-we').html(html);
    }
    //////////////PATENT APP CALL FOLLOW UP
    var textPA = "";
    $('.pa_followup').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;border-left:1px solid;display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-2 col-sm-2 col-xs-2'>PIN: " + pin + "</div>" +
            "<div style='padding-left: 0px !important;padding-right: 0px !important;display: inline;' class='col-md-4 col-sm-4 col-xs-4'>Client: " + fname +" " + lname + "</div>" +
            "<div style='padding-left: 0px !important;padding-right: 0px !important;display: inline;margin-left: 20px;' class='col-md-3 col-sm-3 col-xs-3'>" +
            "</div></div>";
        textPA+=msg;
    });
    if(textPA!=""){
        var html ="<table>" + textPA + "</table>";
        $('.container-pa').html(html);
    }
    /////////////TRADEMARKS without signature
    var textTM = "";
    $('.tm_reminder').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;border-left:1px solid;display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-2 col-sm-2 col-xs-2'>PIN: " + pin + "</div>" +
            "<div style='padding-left: 0px !important;padding-right: 0px !important;display: inline;' class='col-md-4 col-sm-4 col-xs-4'>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'><button type='button' id='btnReminderTM_"+pin+"' style='display: inline;height: 20px;margin-bottom: 1px;' class='btn btn-primary btn-sm btnReminderTM' data-pin='"+pin+"'> <span class='glyphicon glyphicon-envelope'></span> Send </button>" +
            "</div></div>";
        textTM+=msg;
    });
    if(textTM!=""){
        var html ="<table>" + textTM + "</table>";
        $('.container-tm').html(html);
    }
    /////////////COPYRIGHTS without signature
    var textCR = "";
    $('.cr_reminder').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='padding-left: 0px !important;padding-right: 0px !important;display: inline;' class='col-md-3 col-sm-3 col-xs-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;border-left:1px solid;display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-2 col-sm-2 col-xs-2'>PIN: " + pin + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-4 col-sm-4 col-xs-4'>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'><button type='button' id='btnReminderCR_"+pin+"' style='display: inline;height: 20px;margin-bottom: 1px;' class='btn btn-primary btn-sm btnReminderCR' data-pin='"+pin+"'> <span class='glyphicon glyphicon-envelope'></span> Send </button>" +
            "</div></div>";
        textCR+=msg;
    });
    if(textCR!=""){
        var html ="<table>" + textCR + "</table>";
        $('.container-cr').html(html);
    }
    /////////////update Emails after 1 year to utilities
    var textUpEm = "";
    $('.updEm_reminder').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='padding-left: 0px !important;padding-right: 0px !important;display: inline;' class='col-md-3 col-sm-3 col-xs-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;border-left:1px solid;display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-2 col-sm-2 col-xs-2'>PIN: " + pin + "</div>" +
            "<div style='display: inline;padding-right: 0px !important;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-4 col-sm-4 col-xs-4'>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline; padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'><button type='button' id='openFilesUpdEm_"+pin+"' style='display: inline;height: 20px;margin-bottom: 1px;margin-right: 5px !important;' class='btn btn-primary btn-sm openFilesUpdEm' data-pin='"+pin+"'> <span class='glyphicon glyphicon-envelope'></span>Send Update</button><button type='button' id='closeUpdate_"+pin+"' style='display: inline;height: 20px;margin-bottom: 1px;' class='btn btn-danger btn-sm closeUpdate' data-pin='"+pin+"'>X</button>" +
            "</div></div>";
        textUpEm+=msg;
    });
    if(textUpEm!=""){
        var html ="<table>" + textUpEm + "</table>";
        $('.container-updEm').html(html);
    }
    ///////////// expired utilities
    var textExpUt = "";
    $('.expUt_reminder').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var pcsid = $(this).data('pcsid');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;border-left:1px solid;display: inline;padding-left: 10px;' class='col-md-2 col-sm-2 col-xs-2'>PIN: " + pin + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-4 col-sm-4 col-xs-4'>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'><button type='button' id='closeExpFile_"+pcsid+"' style='display: inline;height: 20px;margin-bottom: 1px;' class='btn btn-primary btn-sm closeExpFile' data-pin='"+pin+"' data-pcsid='"+pcsid+"'> <span class='glyphicon glyphicon-envelope'></span>Close file</button>" +
            "</div></div>";
        textExpUt+=msg;
    });
    if(textExpUt!=""){
        var html ="<table>" + textExpUt + "</table>";
        $('.container-expUt').html(html);
    }
    //////////////9 MONTHS CALL FOLLOW UP
    var text9M = "";
    $('.9m_follow_call').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-left:1px solid;border-right:1px solid;display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-2 col-sm-2 col-xs-2'>PIN: " + pin + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-4 col-sm-4 col-xs-4'>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'>" +
            "</div></div>";
        text9M+=msg;
    });
    if(text9M!=""){
        var html ="<table>" + text9M + "</table>";
        $('.container-9m').html(html);
    }
    ///////////// app delay
    var textAppDelay = "";
    $('.app_delay').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var pcsid = $(this).data('pcsid');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='padding-left: 0px !important;padding-right: 0px !important;display: inline;' class='col-md-3 col-sm-3 col-xs-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-left:1px solid;border-right:1px solid;display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-2 col-sm-2 col-xs-2'>PIN: " + pin + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-4 col-sm-4 col-xs-4'>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-3 col-sm-3 col-xs-3'><button type='button' id='btnNotifyAppDelay_"+pin+"' style='display: inline;height: 20px;margin-bottom: 1px;' class='btn btn-primary btn-sm btnNotifyAppDelay' data-pcsid='"+pcsid+"'> <span class='glyphicon glyphicon-envelope'></span> Send </button><button type='button' id='closeAppDelay_"+pin+"' style='display: inline;height:20px;margin-bottom: 1px;' class='btn btn-danger btn-sm closeAppDelay' data-pcsid='"+pcsid+"'>X</button>" + //
            "</div></div>";
        textAppDelay+=msg;
    });
    if(textAppDelay!=""){
        var html ="<table>" + textAppDelay + "</table>";
        $('.container-appDelay').html(html);
    }
}

$(document).on('click','.btnNotifyAppDelay',function(){
    var pcsid =$(this).data('pcsid');
    ajaxCallback({'PID':pcsid},'notifyAppDelayToClient','notifyDelayBack')
});

function notifyDelayBack(result){
    if(result!= -1){
        $('#btnNotifyAppDelay_'+result).parent().parent().hide();
        toastr.success('Email sent!!','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.btnSendSMS',function(){
   var pid =$(this).data('pin');
    ajaxCallback({'PID':pid},'sendTextIntroCall','sendTextBack')
});

function sendTextBack(result){
    if(result!= -1){
        $('#btnSendSMS_'+result).parent().parent().hide();
        toastr.success('Text sent!!','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.btnSendUpg',function(){
    var pin = $(this).data('pin');
    ajaxCallback({'PIN':pin},'sendUpgrade','sendUpgBack');
});

$(document).on('click','.btnSendUpgPCT',function(){
    var pin = $(this).data('pin');
    ajaxCallback({'PIN':pin},'sendUpgradeOnlyPCT','sendUpgPCTBack');
});

function sendUpgBack(result){
    if(result!= -1){
        $('#btnSendUpg_'+result).parent().parent().hide();
        toastr.success('The Upgrade Letter was sent.','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

function sendUpgPCTBack(result){
    if(result != -1){
        $('#btnSendUpgPCT_'+result).parent().parent().hide();
        toastr.success('The Upgrade Letter was sent.','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.btnSendProv',function(){
    var pin = $(this).data('pin');
    ajaxCallback({'PIN':pin},'sendProvInvoice','sendProvBack');
});

function sendProvBack(result){
    if(result != -1){
        $('#btnSendProv_'+result).parent().parent().hide();
        toastr.success('The Provisional Invoice  was sent.','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.btnReminderCR',function(){
    var pin = $(this).data('pin');
    ajaxCallback({'PIN':pin,'TYPE':'COPYRIGHT'},'sendReminderTMCR','reminderCRBack');
});

function reminderCRBack(result){
    if(result != -1){
        $('#btnReminderCR_'+result).parent().parent().hide();
        toastr.success('The CopyRight Reminder Email  was sent.','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.btnReminderTM',function(){
    var pin = $(this).data('pin');
    ajaxCallback({'PIN':pin,'TYPE':'TRADEMARK'},'sendReminderTMCR','reminderTMBack');
});

function reminderTMBack(result){
    if(result != -1){
        $('#btnReminderTM_'+result).parent().parent().hide();
        toastr.success('The Trademark Reminder  was sent.','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

//Load all accessible files for a project
$(document).on('click','.openFilesUpdEm',function(e){
    var id = $(this).data('pin');
    $('#sendIds').data('pin',id);
    ajaxCallback({'ID':id},'loadFilesAdmin','paintFilesUpdEm');
});

function paintFilesUpdEm(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '</div> <div class="fileHeader"> <span class="col-md-2">Send to Attorney</span> <span class="col-md-1 col-md-offset-5">Legal</span><span class="col-md-1">CLIENT-LEGAL</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='checkbox' class='checkFile col-md-1'data-filename='"+file.fileName+"' data-id='"+file.id+"' data-action='internal'"+">"+
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.fileName+"'>" +
            "<span class='col-md-6 '><strong>"+file.fileName+"</strong></span>" +
            "</div>";
        });
        $('.container-filesUpdEm').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });

        $('#updateEmailFilesModal').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

$(document).on('click','.checkFile',function(){
    if($(this).prop('checked')){
        filesUpEm.push($(this).data('id'));
    }else{
        var index = filesUpEm.indexOf($(this).data('id'));
        if(index>-1)
            filesUpEm.splice(index,1);
    }
});

$(document).on('hidden.bs.modal', '#updateEmailFilesModal', function(){
    filesUpEm=[];
});

$(document).on('click','#sendIds',function(){
    var pin = $(this).data('pin');
    ajaxCallback({'ID':pin,'FILES':filesUpEm},'updateEmailAfterYear','updateEmailBack')
    $('#updateEmailFilesModal').modal('hide');
})

function updateEmailBack(result){
    if(result != -1){
        $('#openFilesUpdEm_'+result).parent().parent().hide();
        toastr.success('The Update Email was sent!!!!','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.closeExpFile',function(){
    var pin = $(this).data('pcsid');
    ajaxCallback({'PIN':pin},'closeUtilityExp','closeExpBack');
});

function closeExpBack(result){
    if(result != -1){
        $('#closeExpFile_'+result).parent().parent().hide();
        toastr.success('The file was closed!!!','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.closePCT',function(){
    var pid = $(this).data('pin');
    ajaxCallback({'ID':pid,'ACTION':'PCTEPO'},'removeAlert','removeAlertBack');
});

function removeAlertBack(result){
    if(result!= -1){
        $('#btnSendUpg_'+result).parent().parent().hide();
        toastr.success('Alert removed!!','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.closeProv',function(){
    var pid = $(this).data('pin');
    ajaxCallback({'ID':pid,'ACTION':'PROV'},'removeAlert','removeAlertProvBack');
});


function removeAlertProvBack(result){
    if(result != -1){
        $('#btnSendProv_'+result).parent().parent().hide();
        toastr.success('Alert removed!!','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.closeUpdate',function(){
    var pid = $(this).data('pin');
    ajaxCallback({'ID':pid,'ACTION':'UPDATE'},'removeAlert','removeAlertUpdBack');
});

function removeAlertUpdBack(result){
    if(result!= -1){
        $('#openFilesUpdEm_'+result).parent().parent().hide();
        toastr.success('Alert removed!!','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}

$(document).on('click','.closeAppDelay',function(){
    var pin = $(this).data('pcsid');
    ajaxCallback({'PIN':pin},'ignoreNotifyAppDelay','closeAppDelay');
});

function closeAppDelay(result){
    if(result != -1){
        $('#closeAppDelay_'+result).parent().parent().hide();
        toastr.success('The file was closed!!!','Success');
    }else
        toastr.error('An error has happened, please try later.','Error');
}