/**
 * Created by jllopiz on 5/6/2016.
 */
$(document).ready(function(e){
    pendingAlert();
});

function pendingAlert(){
    //////////////// PCT or EPO without pay
    var text = "";
    $('.pending_app_filed').each(function (index, value){
        var fileno = $(this).data('fileno');
        var pin = $(this).data('pin');
        var fname = $(this).data('clientfn');
        var lname = $(this).data('clientln');
        var msg = "<div style='background-color: burlywood; margin-bottom: 10px !important;border: 1px solid;' class='row'>" +
            "<div style='border-right:1px solid;display: inline;' class='col-md-3'>Fileno: " + fileno + "</div>" +
            "<div  style='border-right:1px solid;display: inline;padding-left: 10px;' class='col-md-2 '>PIN: " + pin + "</div>" +
            "<div style='display: inline;border-right:1px solid;' class='col-md-3 '>Client: " + fname +" " + lname + "</div>" +
            "<div style='display: inline;margin-left: 20px;padding-left: 0px !important;padding-right: 0px !important;' class='col-md-4 '><input type='checkbox' class='sentToILC' style='display: inline;margin-bottom: 1px;'  data-pin='"+pin+"'>(Check after send.)" +
            "</div></div>";
        text+=msg;
    });
    if(text!=""){
        var html ="<table>" + text + "</table>";
        $('.container-files').html(html);
    }

}

$(document).on('click','.sentToILC',function(){
    var pin = $(this).data('pin');
    ajaxCall({'PIN':pin},'send3D','The 3D Design was check sent.','An error has happened, please try later.');
});


