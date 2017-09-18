/**
 * Created by jllopiz on 5/6/2016.
 */
$(document).ready(function(e){
    pendingAlert();
});

function pendingAlert(){
    // pending intro calls
    var text = "";
    $('.ilc_pending_intro').each(function (index, value){
        var fileno = $(this).data('fileno');
        var name = $(this).data('name');
        var phone = $(this).data('phone');
        var iid = $(this).data('iid');
        var msg = "<div id='pendingIntro_"+iid+"' style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='border-right:1px solid;display: inline;' class='col-md-2 col-sm-3 '>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;display: inline;padding-left: 10px;' class='col-md-2 col-sm-3 '>Name: " + name + "</div>" +
            "<div style='display: inline;' class='col-md-3 col-sm-3 '>Phone: " + phone + "</div>" +
            "<div style='display: inline;' class='col-md-5 col-sm-3'><button type='button' id='closeIlcIntro_"+iid+"'  style='display: inline;height: 20px;margin-bottom: 1px;margin-right: 30px;'  class='btn btn-danger btn-sm pull-right closeIlcIntro' data-iid='"+iid+"'><i class='fa fa-times' aria-hidden='true'></i></button>" +
            "</div></div>";
        text+=msg;
    });
    if(text!=""){
        var html ="<table>" + text + "</table>";
        $('.container-pendingIntro').html(html);
    }
    //////// pending expirations
    var text = "";
    $('.ilc_pending_expiration').each(function (index, value){
        var fileno = $(this).data('fileno');
        var name = $(this).data('name');
        var phone = $(this).data('phone');
        var iid = $(this).data('iid');
        var msg = "<div id='pendingExpiration_"+iid+"' style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='border-right:1px solid;display: inline;' class='col-md-2 col-sm-3 '>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;display: inline;padding-left: 10px;' class='col-md-2 col-sm-3 '>Name: " + name + "</div>" +
            "<div style='display: inline;' class='col-md-3 col-sm-3 '>Phone: " + phone + "</div>" +
            //"<div style='display: inline;' class='col-md-5 col-sm-3'><button type='button' id='closeIlcIntro_"+iid+"'  style='display: inline;height: 20px;margin-bottom: 1px;margin-right: 30px;'  class='btn btn-danger btn-sm pull-right closeExpiration' data-iid='"+iid+"'><i class='fa fa-times' aria-hidden='true'></i></button>" +
            "</div></div>";
        text+=msg;
    });
    if(text!=""){
        var html ="<table>" + text + "</table>";
        $('.container-pendingExpiration').html(html);
    }
}

$(document).on('click','.closeIlcIntro',function(){
    var iid = $(this).data('iid');
    ajaxCallback({'IID':iid},'removePendingIntroCall','backRemoveIntroCall')
});

function backRemoveIntroCall(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.');
    else{
        $('#pendingIntro_'+result).hide();
    }
}

