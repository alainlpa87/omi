var consultantPhone,currentDate,table = null;
$(document).ready(function(e){
    currentDate = new Date();
    consultantPhone = $('#userDID').html();

    //dates range
    $('#datetimepickerStart').datepicker({});
    $('#datetimepickerEnd').datepicker({
        useCurrent: false //Important! See issue #1075
    });
    $("#datetimepickerStart").on("dp.change", function (e) {
        $('#datetimepickerEnd').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepickerEnd").on("dp.change", function (e) {
        $('#datetimepickerStart').data("DateTimePicker").maxDate(e.date);
    });
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
});


$(document).on('click','#btnPatentSearchReport',function(e){
    var consultant = $('.consultantSelect').val();
    var startDate =  $('#datetimepickerStartInput').val()
    var endDate = $('#datetimepickerEndInput').val();
    if(startDate != '' && endDate != '' && consultant > 0)
    {
        var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'ENDDATE':endDate};
        ajaxCallback(data,'patentSearchProgressReport','paintPatentSearchProgressReport');
    }else{
        toastr.error("You have to select the date first.","Error!!!");
        return false;
    }
});

$(document).on('click','#btnPatentSearchReportCSV',function(e){
    var consultant = $('.consultantSelect').val();
    var startDate =  $('#datetimepickerStartInput').val()
    var endDate = $('#datetimepickerEndInput').val();
    if(startDate != '' && endDate != '' && consultant > 0)
    {
        var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'ENDDATE':endDate};
        ajaxCallback(data,'patentSearchProgressReportCSV','paintCSVReport');
    }else{
        toastr.error("You have to select the date first.","Error!!!");
        return false;
    }
});

function paintCSVReport(data){
    window.open(data);
}

function paintPatentSearchProgressReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("PATENT SEARCH REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>FILENO</th><th>INVENTOR</th><th>DATE SENT</th><th>DATE RECEIVED</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>INVENTOR</th><th>DATE SENT</th><th>DATE RECEIVED</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        var tr="<tr>";
        $.each(data_consultant,function(key,value){
            tr+='<th>'+value+'</th>';
        });
        tr+='</tr>';
        $('#tableDataBody').append($(tr));
    });
    table = $('#tableData').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    $('.chart').css('display','none');
    $('.divTable').css('display','inline');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','none');
}

$(document).on('click','#btnCSReport',function(e){
    var consultant = $('.consultantSelect').val();
    var startDate =  $('#datetimepickerStartInput').val()
    var endDate = $('#datetimepickerEndInput').val();
    if(startDate != '' && endDate != '' && consultant > 0)
    {
        var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'ENDDATE':endDate};
        ajaxCallback(data,'cSReport','paintCSReport');
    }else{
        toastr.error("You have to select all the parameters","Error!!!");
        return false;
    }
});

$(document).on('click','#btnCSReportCSV',function(e){
    var consultant = $('.consultantSelect').val();
    var startDate =  $('#datetimepickerStartInput').val()
    var endDate = $('#datetimepickerEndInput').val();
    if(startDate != '' && endDate != '' && consultant > 0)
    {
        var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'ENDDATE':endDate};
        ajaxCallback(data,'cSReportCSV','paintCSVReport');
    }else{
        toastr.error("You have to select all the parameters","Error!!!");
        return false;
    }
});

function paintCSReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("CLIENT SERVICES REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>FILENO</th><th>INVENTOR</th><th>TYPE</th><th>DATE SENT</th><th>DATE RECEIVED</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>INVENTOR</th><th>TYPE</th><th>DATE SENT</th><th>DATE RECEIVED</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        var tr="<tr>";
        $.each(data_consultant,function(key,value){
            tr+='<th>'+value+'</th>';
        });
        tr+='</tr>';
        $('#tableDataBody').append($(tr));
    });
    table = $('#tableData').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    $('.chart').css('display','none');
    $('.divTable').css('display','inline');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','none');
}

$(document).on('click','#btnPsaDdrReport',function(e){
    var startDate =  $('#datetimepickerStartInput').val()
    var endDate = $('#datetimepickerEndInput').val();
    if(startDate != '' && endDate != '')
    {
        var data = {'STARTDATE':startDate,'ENDDATE':endDate};
        ajaxCallback(data,'psaDdrReport','paintPsaDdrReport');
    }else{
        toastr.error("You have to select the date first.","Error!!!");
        return false;
    }
});

$(document).on('click','#btnPsaDdrReportCSV',function(e){
    var startDate =  $('#datetimepickerStartInput').val()
    var endDate = $('#datetimepickerEndInput').val();
    if(startDate != '' && endDate != '')
    {
        var data = {'STARTDATE':startDate,'ENDDATE':endDate};
        ajaxCallback(data,'psaDdrReportCSV','paintCSVReport');
    }else{
        toastr.error("You have to select the date first.","Error!!!");
        return false;
    }
});

function paintPsaDdrReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("PSA and DDR Report");
    var thead= $('<tr><th>FILENO</th><th>INVENTOR</th><th>DATE SENT</th><th>PSA DATE RECEIVED</th><th>DDR DATE RECEIVED</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>INVENTOR</th><th>DATE SENT</th><th>PSA DATE RECEIVED</th><th>DDR DATE RECEIVED</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        var tr="<tr>";
        $.each(data_consultant,function(key,value){
            tr+='<th>'+value+'</th>';
        });
        tr+='</tr>';
        $('#tableDataBody').append($(tr));
    });
    table = $('#tableData').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    $('.chart').css('display','none');
    $('.divTable').css('display','inline');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','none');
}

//pct and epo

$(document).on('click','#btnPctEpoReport',function(e){
    var startDate =  $('#datetimepickerStartInput').val()
    var endDate = $('#datetimepickerEndInput').val();
    if(startDate != '' && endDate != '')
    {
        var data = {'STARTDATE':startDate,'ENDDATE':endDate};
        ajaxCallback(data,'pctAndEpo','paintPctEpoReport');
    }else{
        toastr.error("You have to select the date first.","Error!!!");
        return false;
    }
});

$(document).on('click','#btnPctEpoReportCSV',function(e){
    var startDate =  $('#datetimepickerStartInput').val()
    var endDate = $('#datetimepickerEndInput').val();
    if(startDate != '' && endDate != '')
    {
        var data = {'STARTDATE':startDate,'ENDDATE':endDate};
        ajaxCallback(data,'pctAndEpoCSV','paintCSVReport');
    }else{
        toastr.error("You have to select the date first.","Error!!!");
        return false;
    }
});

function paintPctEpoReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("PCT and EPO REPORT");
    var thead= $('<tr><th>FILENO</th><th>INVENTOR</th><th>TYPE</th><th>DATE SENT</th><th>DATE RECEIVED</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>INVENTOR</th><th>TYPE</th><th>DATE SENT</th><th>DATE RECEIVED</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        var tr="<tr>";
        $.each(data_consultant,function(key,value){
            tr+='<th>'+value+'</th>';
        });
        tr+='</tr>';
        $('#tableDataBody').append($(tr));
    });
    table = $('#tableData').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    $('.chart').css('display','none');
    $('.divTable').css('display','inline');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','none');
}
