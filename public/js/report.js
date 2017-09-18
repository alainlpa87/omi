var consultantPhone,currentDate,table = null;
$(document).ready(function(e){
    currentDate = new Date();
    consultantPhone = $('#userDID').html();

    //dates range
    $('#datetimepickerStart').datetimepicker();
    $('#datetimepickerEnd').datetimepicker({
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

    $('#selectOptionAdmin').change(function(e){
        optionAdmin($(this).val());
    });
});

//events
//
$(document).on('click','#btnContracts',function(e){
    var consultant = $('.consultantSelect').val();
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        consultantContractReport(consultant,startDate,endStart);
    }
});
$(document).on('click','#btnSubmissions',function(e){
    var consultant = $('.consultantSelect').val();
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        consultantSubmissionReport(consultant,startDate,endStart);
    }
});
$(document).on('click','#btnSold',function(e){
    var consultant = $('.consultantSelect').val();
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        consultantSoldReport(consultant,startDate,endStart);
    }
});
//event to search for transactions and to paint a chart ok
$(document).on('click','#btnTransactions',function(e){
    var consultant = $('.consultantSelect').val();
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        transactionPerConsultantReport(consultant,startDate,endStart);
    }
});
//event to search leads per consulant and to paint a chart ok
$(document).on('click','#btnLeadsPerConsultant',function(e){
    var consultant = $('.consultantSelect').val();
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        leadsPerConsultantReport(consultant,startDate,endStart);
    }
});
//event to search submissions by source and to paint a chart ok
$(document).on('click','#btnSubBySource',function(e){
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        projectBySourceReport(startDate,endStart);
    }
});
//event to search leads with submissions by source and to paint a chart
$(document).on('click','#btnLeadWithSubBySource',function(e){
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        leadWithProjectBySourceReport(startDate,endStart);
    }
});
//event to search PH1 Paid by source and to paint a chart
$(document).on('click','#btnPh1BySource',function(e){
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        ph1PaidBySourceReport(startDate,endStart);
    }
});
$(document).on('click','#btnGrossLead',function(e){
    var source = $('.sourceSelect').val();
    if(source!=-1 && $('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        grossLeadsBySourceReport(source,startDate,endStart);
    }
});
$(document).on('click','#btnLeadsBySource',function(e){
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
    {
        var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        leadsBySourceReport(startDate,endStart);
    }
});
$(document).on('click','#btnLeads3dCall',function(e){
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null)
    {
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        leadsCalled3DayIntervalReport(startDate);
    }
});
$(document).on('click','#btnLeads3dCallPerConsultant',function(e){
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null)
    {
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        leadsCalled3DayIntervalPerConsultantReport(startDate);
    }
});
$(document).on('click','.btnDeleteFunding',function(e){
    var id = $(this).data('id');
    ajaxCall({'ID':id},'deleteProjectsInFundingWithPayment','Funding project hide successfully.');
    $('#tr_'+id).remove();
});
$(document).on('click','#btFunding',function(e){
    ajaxCallback({},'projectsInFundingWithPayment','paintProjectsInFunding');
});
$(document).on('click','#btnCalls',function(e){
    if($('#datetimepickerStart').data("DateTimePicker").date()!=null)
    {
        var consultant = $('.consultantSelect').val();
        var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
        callsPerHourPerConsultant(consultant,startDate);
    }
});
function callsPerHourPerConsultant(consultant,startDate)
{
    var data = {'CONSULTANT':consultant,'STARTDATE':startDate};
    ajaxCallback(data,'callsPerHourPerConsultant','paintCallsPerHourPerConsultant');
}
function paintCallsPerHourPerConsultant(data)
{
    $('.infoChart').html('');
    $('#titleChart').text("CALLS PER HOUR FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var labels = data.LABEL;
    var seriesInfo = data.SERIES;
    var series =[];
    var totals=data.TOTALS;
    $.each(totals,function(key,data){
        var p="<p>"+(key+':00')+": "+data+"</p>";
        if(key=="08"||key=="09")
            $('.infoChart').prepend($(p));
        else
            $('.infoChart').append($(p));
    });
    series.push(seriesInfo);
    buildBarChart(labels,seriesInfo);
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','block');
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
}
function paintProjectsInFunding(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("PROJECTS IN FUNDING");
    var thead= $('<tr><th>FILENO</th><th>PIN</th><th>TYPE</th><th>PRICE</th><th>PAID</th><th>LAST PAYMENT DATE</th><th>CONSULTANT</th><th>ACTION</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>PIN</th><th>TYPE</th><th>PRICE</th><th>PAID</th><th>LAST PAYMENT DATE</th><th>CONSULTANT</th><th>ACTION</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        if(consultant!="TOTAL")
        {
            var tr="";
            var pin=-1;
            $.each(data_consultant,function(key,value){
                tr+='<th>'+value+'</th>';
               if(key=="PIN")
               pin=value;
            });
            var btnDelete = "<th><button class='btn btn-danger btnDeleteFunding' data-id='"+pin+"'>HIDE</button></th>";
            tr+=btnDelete+'</tr>';
            tr = "<tr id='tr_"+pin+"'>"+tr;
            $('#tableDataBody').append($(tr));
        }
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
    document.title = "STATISTIC VIEW - FUNDING ACCOUNTS";
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

//FUNCTIONS WITH TABLE
//call the report contract Outs
function consultantContractReport(consultant,startDate,endStart)
{
    var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'STARTEND':endStart};
    if(consultant!=-1)
        ajaxCallback(data,'consultantContractReport','paintContractReport');
    else
        ajaxCallback(data,'consultantContractReport','paintAllContractReport');
}
function paintContractReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("CONTRACTS SENT REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>FILENO</th><th>DATE</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>DATE</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
       if(consultant!="TOTAL")
       {
           var tr="<tr>";
           $.each(data_consultant,function(key,value){
               tr+='<th>'+value+'</th>';
           });
           tr+='</tr>';
           $('#tableDataBody').append($(tr));
       }
       else
       {
           var p="<p>"+consultant+":"+data_consultant+"</p>";
           $('.infoChart').append($(p));
       }
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
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - CONTRACT REPORT";
}
function paintAllContractReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("CONTRACTS SENT REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>CONSULTANT</th><th>TOTAL</th><th>FILENOS</th></tr>');
    var tfoot= $('<tr><th>CONSULTANT</th><th>TOTAL</th><th>FILENOS</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        if(consultant!="TOTAL")
        {
            var tr="<tr><th>"+consultant+"</th>";
            $.each(data_consultant,function(key,value){
                tr+='<th>'+value+'</th>';
            });
            tr+='</tr>';
            $('#tableDataBody').append($(tr));
        }
        else
        {
            var p="<p>"+consultant+":"+data_consultant+"</p>";
            $('.infoChart').append($(p));
        }
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
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - CONTRACT REPORT";
}


//Money Report
$(document).on('click','#btnMonthlyMoneyReport',function(e){
    ajaxCallback({},'monthlyMoneyReport','paintMonthlyMoneyReport');
});

function paintMonthlyMoneyReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("MONEY REPORT");
    var thead= $('<tr><th>SALES REP</th><th>FILENO</th><th>PIN</th><th>PHASE</th><th>AMOUNT</th><th>NOTE</th><th>DATE</th></tr>');
    var tfoot= $('<tr><th>SALES REP</th><th>FILENO</th><th>PIN</th><th>PHASE</th><th>AMOUNT</th><th>NOTE</th><th>DATE</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        if(consultant!="TOTAL")
        {
            var tr="<tr>";
            var tran = '';
            $.each(data_consultant,function(key,value){

                if(key == 'TRANSACTION'){
                    tran = value;
                }else if(key == 'NOTE'){
                    tr+='<th style="cursor: pointer;" class="selNote" data-id="'+tran+'" id ="note_'+tran+'">'+value+'</th>';
                }else{
                    tr+='<th>'+value+'</th>';
                }
            });
            tr+='</tr>';
            $('#tableDataBody').append($(tr));
        }
        else
        {
            var p="<p>"+consultant+":"+data_consultant+"</p>";
            $('.infoChart').append($(p));
        }
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
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - MONEY REPORT";
}

$(document).on('click','#btnPaymentInAndNotSentToVendor',function(e){
    ajaxCallback({},'paymentInAndNotSentToVendor','paintPaymentInAndNotSentToVendor');
});

function paintPaymentInAndNotSentToVendor(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("Payment In And Not Sent To Vendor Yet");
    var thead= $('<tr><th>FILENO</th><th>PIN</th><th>TYPE</th><th>DATE OF PAYMENT</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>PIN</th><th>TYPE</th><th>DATE OF PAYMENT</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        if(consultant!="TOTAL")
        {
            var tr="<tr>";
            var tran = '';
            $.each(data_consultant,function(key,value){

                tr+='<th>'+value+'</th>';
            });
            tr+='</tr>';
            $('#tableDataBody').append($(tr));
        }
        else
        {
            var p="<p>"+consultant+":"+data_consultant+"</p>";
            $('.infoChart').append($(p));
        }
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
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - VENDOR REPORT";
}

$(document).on('click','#btnMonthlyMoneyReportCSV',function(e){
    ajaxCallback([],'monthlyMoneyReportCSV','paintMonthlyMoneyReportCSV');
});

function paintMonthlyMoneyReportCSV(data){
    window.open(data);
}

//add Notes modal.
$(document).on('click','.selNote',function(e){
    var id = $(this).data('id');
    var value = $(this).html();
    $('#submitMonthlyReportNotes').data('id',id);
    $('#noteMonthlyReport').val(value);
    $('#monthlyReportNotesModal').modal('show');
});

//edit Notes modal.
$(document).on('click','#submitMonthlyReportNotes',function(e){
    var id=$(this).data('id');
    var note = $('#noteMonthlyReport').val();
    $('#note_'+id).html(note);
    ajaxCall({'ID': id,'VALUE': note}, 'monthlyReportSaveNotes', "Note Saved","ERROR!!!!");
});

//call the report request status
function consultantSubmissionReport(consultant,startDate,endStart)
{
    var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'STARTEND':endStart};
    if(consultant!=-1)
        ajaxCallback(data,'consultantSubmissionReport','paintRequestReport');
    else
        ajaxCallback(data,'consultantSubmissionReport','paintRequestAllReport');
}
//Finished
function paintRequestReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("SUBMISSIONS REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>FILENO</th><th>PIN</th><th>DATE</th><th>LEADSOURCE</th><th>ADMIN STATUS</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>PIN</th><th>DATE</th><th>LEADSOURCE</th><th>ADMIN STATUS</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(list,data_consultant){
        if(list=="APPROVED"||list=="NEEDSMOREINFO"||list=="REJECTED")
        {
            var p="<p>"+list+":"+data_consultant.length+"</p>";
            $('.infoChart').append($(p));
            $.each(data_consultant,function(key,value){
                var tr="<tr>";
                tr+='<th>'+value.FILENO+'</th>';
                tr+='<th>'+value.PIN+'</th>';
                tr+='<th>'+value.DATE+'</th>';
                tr+='<th>'+value.LEADSOURCE+'</th>';
                tr+='<th>'+list+'</th></tr>';
                $('#tableDataBody').append($(tr));
            });
        }
        else if(list=="LEADSOURCE")
        {
            $.each(data_consultant,function(key,value){
                var p="<p>"+key+": "+value+"</p>";
                $('.infoChart').append($(p));
            });
        }
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
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - SUBMISSION REPORT";
}
//Finished
function paintRequestAllReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("SUBMISSIONS REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>CONSULTANT</th><th>FILENO</th><th>PIN</th><th>DATE</th><th>LEADSOURCE</th><th>ADMIN STATUS</th></tr>');
    var tfoot= $('<tr><th>CONSULTANT</th><th>FILENO</th><th>PIN</th><th>DATE</th><th>LEADSOURCE</th><th>ADMIN STATUS</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(list,data_consultant){
        if(list=="APPROVED"||list=="NEEDSMOREINFO"||list=="REJECTED")
        {
            var p="<p>"+list+":"+data_consultant.length+"</p>";
            $('.infoChart').append($(p));
            $.each(data_consultant,function(key,value){
                var tr="<tr>";
                tr+='<th>'+value.CONSULTANT+'</th>';
                tr+='<th>'+value.FILENO+'</th>';
                tr+='<th>'+value.PIN+'</th>';
                tr+='<th>'+value.DATE+'</th>';
                tr+='<th>'+value.LEADSOURCE+'</th>';
                tr+='<th>'+list+'</th></tr>';
                $('#tableDataBody').append($(tr));
            });
        }
        else if(list=="LEADSOURCE")
        {
            $.each(data_consultant,function(key,value){
                var p="<p>"+key+": "+value+"</p>";
                $('.infoChart').append($(p));
            });
        }
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
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - SUBMISSION REPORT"
}

$(document).on('click','#btnPersonalPH2ClosingRatio',function(e){
    var consultant = $('.consultantSelect').val();
    if(consultant!=-1){
        if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
        {
            var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
            var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
            var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'STARTEND':endStart};
            ajaxCallback(data,'personalPH2ClosingRatio','paintPersonalPH2ClosingRatio');
        }
    }
});

function paintPersonalPH2ClosingRatio(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("CONTRACTS SOLD REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>FILENO</th><th>DATE</th><th>PAID</th><th>PH2 Concultant</th><th>PPA</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>DATE</th><th>PAID</th><th>PH2 Concultant</th><th>PPA</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        if(consultant!="TOTAL")
        {
            var tr="<tr>";
            $.each(data_consultant,function(key,value){
                $.each(value,function(key1,value1){
                    tr+='<th>'+value1+'</th>';
                });
            });
            tr+='</tr>';
            $('#tableDataBody').append($(tr));
        }
        else
        {
            var p="<p>TOTAL: "+data_consultant['TOTAL']+"</p>"+"<p>SOLD: "+data_consultant['SOLD']+"</p>"+"<p>CLOSING RATIO: "+data_consultant['CLOSING RATIO']+"</p>";
            $('.infoChart').append($(p));
        }
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
    $('.infoChart').css('display','block');
}

$(document).on('click','#btnTeamLeadPH2ClosingRatio',function(e){
    var consultant = $('.consultantSelect').val();
    if(consultant!=-1){
        if($('#datetimepickerStart').data("DateTimePicker").date()!=null && $('#datetimepickerEnd').data("DateTimePicker").date()!=null)
        {
            var endStart =dateToString($('#datetimepickerEnd').data("DateTimePicker").date()._d);
            var startDate = dateToString($('#datetimepickerStart').data("DateTimePicker").date()._d);
            var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'STARTEND':endStart};
            ajaxCallback(data,'teamLeadPH2ClosingRatio','paintTeamLeadPH2ClosingRatio');
        }
    }
});

function paintTeamLeadPH2ClosingRatio(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("CONTRACTS SOLD REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>FILENO</th><th>PHASE1 DATE OF PAYMENT</th><th>PAID</th><th>PHASE1 Concultant</th><th>PPA</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>PHASE1 DATE OF PAYMENT</th><th>PAID</th><th>PHASE1 Concultant</th><th>PPA</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        if(consultant!="TOTAL")
        {
            var tr="<tr>";
            $.each(data_consultant,function(key,value){
                $.each(value,function(key1,value1){
                    tr+='<th>'+value1+'</th>';
                });
            });
            tr+='</tr>';
            $('#tableDataBody').append($(tr));
        }
        else
        {
            var p="<p>TOTAL: "+data_consultant['TOTAL']+"</p>"+"<p>SOLD: "+data_consultant['SOLD']+"</p>"+"<p>CLOSING RATIO: "+data_consultant['CLOSING RATIO']+"</p>";
            $('.infoChart').append($(p));
        }
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
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - CLOSING RATIO"
}



function consultantSoldReport(consultant,startDate,endStart)
{
    var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'STARTEND':endStart};
    if(consultant!=-1)
        ajaxCallback(data,'consultantSoldReport','paintSoldReport');
    else
        ajaxCallback(data,'consultantSoldReport','paintSoldAllReport');
}
function paintSoldReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("CONTRACTS SOLD REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>FILENO</th><th>DATE</th><th>TYPE</th><th>PAID</th></tr>');
    var tfoot= $('<tr><th>FILENO</th><th>DATE</th><th>TYPE</th><th>PAID</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        if(consultant!="TOTAL")
        {
            var tr="<tr>";
            $.each(data_consultant,function(key,value){
                $.each(value,function(key1,value1){
                    tr+='<th>'+value1+'</th>';
                });
            });
            tr+='</tr>';
            $('#tableDataBody').append($(tr));
        }
        else
        {
            var p="<p>"+consultant+": "+data_consultant+"</p>";
            $('.infoChart').append($(p));
        }
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
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - SOLD REPORT"
}
function paintSoldAllReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("CONTRACTS SOLD REPORT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var thead= $('<tr><th>CONSULTANT</th><th>FILENO</th><th>DATE</th><th>TYPE</th><th>PAID</th></tr>');
    var tfoot= $('<tr><th>CONSULTANT</th><th>FILENO</th><th>DATE</th><th>TYPE</th><th>PAID</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        if(consultant!="TOTAL")
        {
            $.each(data_consultant,function(key,value){
                var tr="<tr><th>"+key+"</th>";
                $.each(value,function(key1,value1){
                    tr+='<th>'+value1+'</th>';
                });
                tr+='</tr>';
                $('#tableDataBody').append($(tr));
            });
        }
        else
        {
            var p="<p>"+consultant+": "+data_consultant+"</p>";
            $('.infoChart').append($(p));
        }
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
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - SOLD REPORT"
}
//call the report request status
function leadsCalled3DayIntervalReport(startDate)
{
    var data = {'STARTDATE':startDate};
    ajaxCallback(data,'leadsCalled3DayIntervalReport','paintLeadsCalled3DayIntervalReport');

}
//ok
function paintLeadsCalled3DayIntervalReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("Quantity of leads that are in 3-day since last call");
    var thead= $('<tr><th>INTERVAL</th><th>LEADS NOT CALLED</th></tr>');
    var tfoot= $('<tr><th>INTERVAL</th><th>LEADS NOT CALLED</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(interval,data){
        var tr= $('<tr><th>'+(interval==0?0: (interval*3-2)+" - "+(interval*3))+'</th><th>'+data.Total+'</th></tr>');
        $('#tableDataBody').append(tr);
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
    document.title = "STATISTIC VIEW - LEADS CALLED REPORT"
}
//call the report request status
function leadsCalled3DayIntervalPerConsultantReport(startDate)
{
    var data = {'STARTDATE':startDate};
    ajaxCallback(data,'leadsCalled3DayIntervalPerConsultantReport','paintLeadsCalled3DayIntervalPerConsultantReport');

}
//ok
function paintLeadsCalled3DayIntervalPerConsultantReport(data)
{
    if(table!=null && table!=[])
        table.destroy();
    $('#tableDataHead').html('');
    $('#tableDataFoot').html('');
    $('#tableDataBody').html('');
    $('.infoChart').html('');
    $('#titleChart').text("Quantity of leads that are in 3-day since last call");
    var thead= $('<tr><th>CONSULTANT</th><th>0</th><th>1-3</th><th>4-6</th><th>7-9</th><th>10-12</th><th>13-15</th><th>16-18</th><th>19-21</th></tr>');
    var tfoot= $('<tr><th>CONSULTANT</th><th>0</th><th>1-3</th><th>4-6</th><th>7-9</th><th>10-12</th><th>13-15</th><th>16-18</th><th>19-21</th></tr>');
    $('#tableDataHead').append(thead);
    $('#tableDataFoot').append(tfoot);
    $.each(data,function(consultant,data_consultant){
        var tr="<tr><th>"+consultant+"</th>";
        $.each(data_consultant,function(key,value){
            tr+='<th>'+value+'</th>';
        });
        tr+='</tr>';
        $('#tableDataBody').append($(tr));
    });
    table = $('#tableData').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
    $('.chart').css('display','none');
    $('.divTable').css('display','inline');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','none');
    document.title = "STATISTIC VIEW - LEADS CALLED REPORT"
}
//call the report request status
function leadsPerConsultantReport(consultant,startDate,endStart)
{
   var data = {'CONSULTANT':consultant,'STARTDATE':startDate,'STARTEND':endStart};
   if(consultant!=-1)
        ajaxCallback(data,'leadsPerConsultantReport','paintLeadsPerConsultantReport');
    else
        ajaxCallback(data,'leadsPerConsultantReport','paintLeadsPerConsultantAllReport');
}
//FUNCTIONS WITH CHART
function paintLeadsPerConsultantReport(data)
{
    var labels=[];
    var series=[];
    $('.infoChart').html('');
    var p = '<p>TOTAL OF LEAD: '+data['TOTAL']+"</p>";
    $('.infoChart').append($(p));
    $.each(data,function(key,value){
        if(key!="TOTAL" && key!="UNLOADED")
        {
            labels.push(key.length==0?"DEF":key);
            series.push(value);
            var p="<p>"+key+": "+value+"</p>";
            $('.infoChart').append($(p));
        }
        else if( key=="UNLOADED")
        {
            var p="<p> UNLOADED LEADS: "+value+"</p>";
            $('.infoChart').append($(p));
        }
    });
    $('#titleChart').text("LEADS PER CONSULTANT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','block');
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
    buildBarChart(labels,series);
    document.title = "STATISTIC VIEW - LEADS PER CONSULTANT REPORT"
}
function paintLeadsPerConsultantAllReport(data)
{
    var labels=[];
    var series=[];
    $('.infoChart').html('');
    var p = '<p>TOTAL OF LEAD: '+data['TOTAL']+"</p>";
    $('.infoChart').append($(p));
    $.each(data,function(key,value){
        if(key!="TOTAL")
        {

            labels.push(key.length==0?"DEF":key);
            series.push(value);
            var p="<p>"+key+": "+value+"</p>";
            $('.infoChart').append($(p));
        }
    });
    $('#titleChart').text("LEADS PER CONSULTANT FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','block');
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
    buildBarChart(labels,series);
    document.title = "STATISTIC VIEW - LEADS PER CONSULTANT REPORT"
}
//call the report request status
function transactionPerConsultantReport(consultant_id,startDate,endDate)
{
    var data = {'STARTDATE':startDate,'STARTEND':endDate,'CONSULTANT':consultant_id};
    if(consultant_id!=-1)
        ajaxCallback(data,'transactionPerConsultantReport','paintTransactionPerConsultantReport');
    else
        ajaxCallback(data,'transactionReport','paintTransactionReport');
}

function paintTransactionPerConsultantReport(data)
{
    $('.infoChart').html('');
    $('#titleChart').text("TRANSACTIONS FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var labels = data.LABEL;
    var seriesInfo = data.SERIES;
    var series =[];
    var totals=data.TOTALS;

    var htmlInfo = "";
    var subLeads = "";
    var subNew = "";
    var subPh1 = "";
    var p = "";
    $.each(totals,function(key,data){
        if(key == "PH-1 CALLS" || key == "PH-2 CALLS"){
            subPh1 += '<p style="padding-left: 8%;background-color: black">'+key+' Calls: '+data+'</p>'
        }else if(key == "Lead"){
            subLeads = '<p style="padding-left: 8%;background-color: black">'+key+' Calls: '+data+'</p>'
        }else if(key == "New" || key == "Recycle"){
            subNew += '<p style="padding-left: 20%;">'+key+': '+data+'</p>'
        }else if(key == "CALL"){
            htmlInfo = '<p>'+key+': '+data+'</p>'
        }else{
            p+="<p>"+key+": "+data+"</p>";
        }
    });
    htmlInfo = htmlInfo+subLeads+subNew+subPh1+p
    $('.infoChart').append($(htmlInfo));
    $.each(seriesInfo,function(day,data){
        var seriesRow = [];
        $.each(data,function(leadsource,value){
            seriesRow.push(value);
        });
        series.push(seriesRow);
    });
    buildLinesChart(labels,series);
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','block');
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
    document.title = "STATISTIC VIEW - TRANSACTIONS PER CONSULTANT REPORT"
}
function paintTransactionReport(data)
{
    $('.infoChart').html('');
    $('#titleChart').text("TRANSACTIONS FOR "+$(".consultantSelect option:selected").text().toUpperCase());
    var labels = data.LABEL;
    var seriesInfo = data.SERIES;
    var series =[];
    var totals=data.TOTALS;

    var htmlInfo = "";
    var subLeads = "";
    var subNew = "";
    var subPh1 = "";
    var p = "";
    $.each(totals,function(key,data){
        if(key == "PH-1 CALLS" || key == "PH-2 CALLS"){
            subPh1 += '<p style="padding-left: 8%;background-color: black">'+key+' Calls: '+data+'</p>'
        }else if(key == "Lead"){
            subLeads = '<p style="padding-left: 8%;background-color: black">'+key+' Calls: '+data+'</p>'
        }else if(key == "New" || key == "Recycle"){
            subNew += '<p style="padding-left: 20%;">'+key+': '+data+'</p>'
        }else if(key == "CALL"){
            htmlInfo = '<p>'+key+': '+data+'</p>'
        }else{
            p+="<p>"+key+": "+data+"</p>";
        }
    });
    htmlInfo = htmlInfo+subLeads+subNew+subPh1+p
    $('.infoChart').append($(htmlInfo));
    $.each(seriesInfo,function(day,data){
        var seriesRow = [];
        $.each(data,function(leadsource,value){
            seriesRow.push(value);
        });
        series.push(seriesRow);
    });
    buildLinesChart(labels,series);
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - TRANSACTIONS PER CONSULTANT REPORT"
}

//call the report request status
function leadsBySourceReport(startDate,endStart)
{
    var data = {'STARTDATE':startDate,'STARTEND':endStart};
    ajaxCallback(data,'leadsBySourceReport','paintLeadsBySourceReport');
}

function paintLeadsBySourceReport(data)
{
    $('.infoChart').html('');
    $('#titleChart').text("LEADS BY SOURCE");
    var p = '<p>TOTAL OF LEAD: '+data['TOTAL']+"</p>";
    $('.infoChart').append($(p));
    var labels = data.LABEL;
    var seriesInfo = data.SERIES;
    var series =[];
    var totals=data.TOTALS;
    $.each(totals,function(key,data){
        var p="<p>"+key+": "+data+"</p>";
        $('.infoChart').append($(p));
    });
    $.each(seriesInfo,function(day,data){
        var seriesRow = [];
        $.each(data,function(leadsource,value){
            seriesRow.push(value);
        });
        series.push(seriesRow);
    });
    buildLinesChart(labels,series);
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - LEADS BY SOURCE REPORT"
}

//call the report request status
function projectBySourceReport(startDate,endStart)
{
    var data = {'STARTDATE':startDate,'STARTEND':endStart};
    ajaxCallback(data,'projectBySourceReport','paintProjectBySourceReport');
}

function paintProjectBySourceReport(data)
{
    $('.infoChart').html('');
    $('#titleChart').text("PROJECTS BY SOURCE");
    var p = '<p>TOTAL OF PROJECTS: '+data['TOTAL']+"</p>";
    $('.infoChart').append($(p));

    var labels = data.LABEL;
    var seriesInfo = data.SERIES;
    var series =[];
    var totals=data.TOTALS;
    $.each(totals,function(key,data){
        var p="<p>"+(key.length>0?key:"N/A")+": "+data+"</p>";
        $('.infoChart').append($(p));
    });
    $.each(seriesInfo,function(day,data){
        var seriesRow = [];
        $.each(data,function(leadsource,value){
            seriesRow.push(value);
        });
        series.push(seriesRow);
    });
    buildLinesChart(labels,series);
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - PROJECT BY SOURCE REPORT"
}

//call the report request status
function ph1PaidBySourceReport(startDate,endStart)
{
    var data = {'STARTDATE':startDate,'STARTEND':endStart};
    ajaxCallback(data,'ph1PaidBySourceReport','paintPh1PaidBySourceReport');
}

function paintPh1PaidBySourceReport(data)
{
    $('.infoChart').html('');
    $('#titleChart').text("Paid PH1 BY SOURCE");
    var p = '<p>TOTAL OF PH1: '+data['TOTAL']+"</p>";
    $('.infoChart').append($(p));

    var labels = data.LABEL;
    var seriesInfo = data.SERIES;
    var series =[];
    var totals=data.TOTALS;
    $.each(totals,function(key,data){
        var p="<p>"+(key.length>0?key:"N/A")+": "+data+"</p>";
        $('.infoChart').append($(p));
    });
    $.each(seriesInfo,function(day,data){
        var seriesRow = [];
        $.each(data,function(leadsource,value){
            seriesRow.push(value);
        });
        series.push(seriesRow);
    });
    buildLinesChart(labels,series);
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - PH1 Paid BY SOURCE REPORT"
}

//call the report request status
function leadWithProjectBySourceReport(startDate,endStart)
{
    var data = {'STARTDATE':startDate,'STARTEND':endStart};
    ajaxCallback(data,'leadWithProjectBySourceReport','paintLeadWithProjectBySourceReport');
}

function paintLeadWithProjectBySourceReport(data)
{
    $('.infoChart').html('');
    $('#titleChart').text("LEADS WITH PROJECT BY SOURCE");
    var p = '<p>TOTAL OF LEAD: '+data['TOTAL']+"</p>";
    $('.infoChart').append($(p));

    var labels = data.LABEL;
    var seriesInfo = data.SERIES;
    var series =[];
    var totals=data.TOTALS;
    $.each(totals,function(key,data){
        var p="<p>"+(key.length>0?key:"N/A")+": "+data+"</p>";
        $('.infoChart').append($(p));
    });
    $.each(seriesInfo,function(day,data){
        var seriesRow = [];
        $.each(data,function(leadsource,value){
            seriesRow.push(value);
        });
        series.push(seriesRow);
    });
    buildLinesChart(labels,series);
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','block');
    document.title = "STATISTIC VIEW - LEADS WITH PROJECTS BY SOURCE REPORT"
}

//call the report request status
function grossLeadsBySourceReport(source,startDate,endStart)
{
    var data = {'STARTDATE':startDate,'STARTEND':endStart,'SOURCE':source};
    ajaxCallback(data,'grossLeadsBySourceReport','paintGrossLeadsBySourceReport');
}

function paintGrossLeadsBySourceReport(data)
{
    $('.ct-chart').html('');
    var source = $('.sourceSelect').val();
    $('#titleChart').text(source+' Lead Report');
    var link = $("<a href='"+data+"'> "+source+" Report</a>");
    $('.ct-chart').append(link);
    $('.chart').css('display','inline');
    $('.divTable').css('display','none');
    $('#titleChart').css('display','inline');
    $('.infoChart').css('display','none');
    document.title = "STATISTIC VIEW - GROSS LEADS BY SOURCE REPORT"
}

function buildBarChart(labels,series)
{
    $('.ct-chart').html('');
    var chart = new Chartist.Bar('.ct-chart', {
        labels:labels,
        series: series
    }, {
        distributeSeries: true
    });
    var durations = 500;

    chart.on('draw', function(data) {
        data.element.animate({
            opacity: {
                // The delay when we like to start the animation
                begin: 1000,
                // Duration of the animation
                dur: durations,
                // The value where the animation should start
                from: 0,
                // The value where it should end
                to: 1
            }
        });
    });
}
function buildLinesChart(labels,series)
{
    $('.ct-chart').html('');
    var chart = new Chartist.Line('.ct-chart', {
        labels: labels,
        series: series
    }, {
        low: 0
    });

    // Let's put a sequence number aside so we can use it in the event callbacks
    var delays = 80,
    durations = 500;

// On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
    chart.on('draw', function(data) {
        if(data.type === 'line') {
            // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
            data.element.animate({
                opacity: {
                    // The delay when we like to start the animation
                    begin: delays + 1000,
                    // Duration of the animation
                    dur: durations,
                    // The value where the animation should start
                    from: 0,
                    // The value where it should end
                    to: 1
                }
            });
        }
        else if(data.type === 'label' && data.axis === 'x') {
            data.element.animate({
                y: {
                    begin: delays,
                    dur: durations,
                    from: data.y + 100,
                    to: data.y,
                    // We can specify an easing function from Chartist.Svg.Easing
                    easing: 'easeOutQuart'
                }
            });
        }
        else if(data.type === 'label' && data.axis === 'y') {
            data.element.animate({
                x: {
                    begin: seq * delays,
                    dur: durations,
                    from: data.x - 100,
                    to: data.x,
                    easing: 'easeOutQuart'
                }
            });
        }
        else if(data.type === 'point') {
            data.element.animate({
                x1: {
                    begin: delays,
                    dur: durations,
                    from: data.x - 10,
                    to: data.x,
                    easing: 'easeOutQuart'
                },
                x2: {
                    begin:  delays,
                    dur: durations,
                    from: data.x - 10,
                    to: data.x,
                    easing: 'easeOutQuart'
                },
                opacity: {
                    begin:  delays,
                    dur: durations,
                    from: 0,
                    to: 1,
                    easing: 'easeOutQuart'
                }
            });
        }
        else if(data.type === 'grid') {
            // Using data.axis we get x or y which we can use to construct our animation definition objects
            var pos1Animation = {
                begin:  delays,
                dur: durations,
                from: data[data.axis.units.pos + '1'] - 30,
                to: data[data.axis.units.pos + '1'],
                easing: 'easeOutQuart'
            };

            var pos2Animation = {
                begin:  delays,
                dur: durations,
                from: data[data.axis.units.pos + '2'] - 100,
                to: data[data.axis.units.pos + '2'],
                easing: 'easeOutQuart'
            };

            var animations = {};
            animations[data.axis.units.pos + '1'] = pos1Animation;
            animations[data.axis.units.pos + '2'] = pos2Animation;
            animations['opacity'] = {
                begin: delays,
                dur: durations,
                from: 0,
                to: 1,
                easing: 'easeOutQuart'
            };
            data.element.animate(animations);
        }
    });
}

// Load set payment modal
$('#btnSetPayment').click(function(e){
    $('#setPaymentProjectModal').modal('show');
});
//set the payment for the select project
$('#setPaymentProjectButton').click(function(e){
    var cType = $('#setPaymentContractType').val();
    var price = $('#setPaymentPrice').val();
    var id = $('#setPaymentPin').val();
    var notes = $('#setPaymentNotes').val();
    var signed = $('#setPaymentContract').is(":checked")?1:0;
    var refund = $('#refund').is(":checked")?1:0;
    price = price.length==0?0:price;
    syncAjaxCallback({'ID':id,'PRICE':price,'CTYPE':cType,'SIGNED':signed,'NOTES':notes,'REFUND':refund},'setPaymentCompleteProject',"paymentSellNotification");
});
function paymentSellNotification(response)
{
    if(response==-1)
    {
        swal({title: "We couldn't set the payment,We couldn't find any "+$('#setPaymentContractType').val()+" contract for the PIN "+$('#setPaymentPin').val(),
                type: "info",
                showCancelButton: false,
                confirmButtonColor: "#8CD4F5",
                confirmButtonText: "Ok",
                closeOnConfirm: true },
            function(){
                document.title = "Projects View";
            });
        return ;
    }
    else if(response==-2)
    {
        swal({title: "We couldn't set the payment. The contract is already paid.",
                type: "info",
                showCancelButton: false,
                confirmButtonColor: "#8CD4F5",
                confirmButtonText: "Ok",
                closeOnConfirm: true },
            function(){
                document.title = "Projects View";
            });
        return ;
    }
    swal({title: "Payment saved successfully for the "+$('#setPaymentContractType').val()+" contract for the PIN "+$('#setPaymentPin').val(),
            type: "info",
            showCancelButton: false,
            confirmButtonColor: "#8CD4F5",
            confirmButtonText: "Ok",
            closeOnConfirm: true },
        function(){
            document.title = "Projects View";
        });
    $('#setPaymentPrice').val('');
    $('#setPaymentPin').val('');
    $('#setPaymentContract').prop("checked",false);
    $('#refund').prop("checked",false);
    $('#setPaymentNotes').val('');
}

//Features that admin has in his view.
function optionAdmin(value) {
    $("#adminActionForm").trigger('reset');
    switch (value) {
        case 'R-L':
            ajaxCallback('', 'allConsultants', 'allConsultantsReassignLeadCallback');
            break;
        case 'R-A':
            $('#consultantList').text('');
            $('#consultantList').val('');
            ajaxCallback('', 'allConsultants', 'allConsultantsReassignAllLeadCallback');
            break;
    }


    $('#submitAdminAction').unbind().click(function(e){
    var fileno  = $('#filenoAdminAction').val();
    if($('#adminActionModal .modal-title').html() == 'REASSIGN LEAD'){
        var consultantId = $('#selectConsultantAdmin').val();
        var reason = $('#reasonAdminAction').val();
        if(fileno != "" && reason != ""){
            ajaxCall({'FILENO':fileno, 'CONSULTANT':consultantId, 'REASON':reason},'reassignLead',"Lead Reassigned successfully.","We couldn't reassign the Lead., There is no lead with that fileno.");
        }else{
            toastr.error("Something is missing.","Error!!");
        }

    }else if($('#adminActionModal .modal-title').html() == 'REASSIGN MORE LEAD'){
        var toConsultantId = $('#selectToConsultantAdmin').val();
        var fromConsultantId = $('#selectFromConsultantAdmin').val();
        var reason = $('#reasonAdminAction').val();
        var amount = $('#amountAdminAction').val();
        var all = $('#reassignAdminAllLeads').is(':checked');
        var random = $('#reassignAdminRandom').is(':checked');
        if(all == false && amount == ''){
            toastr.error("You need an amount of leads or check all the leads.","Error!!");
            return;
        }
        if(random == false && toConsultantId <=0){
            toastr.error("Please select a consultant to assign the leads or select random.","Error!!");
            return;
        }

        if(fromConsultantId > 0){
            $('#reassignMessage').attr('consultant',fromConsultantId);
            ajaxCallback({'FROM':fromConsultantId, 'TO':toConsultantId, 'RANDOM':random,'REASON':reason, 'AMOUNT':amount, 'ALL':all},'reassignAllLead',"reassignAllLeadCallback");
            $('#adminActionModal').css('z-index','9998');
            $('#adminLoadingModal').modal('show');
        }else{
            toastr.error("Something is missing.","Error!!");
        }

    }
});
}

//show modal with fields to reassign one lead
function allConsultantsReassignLeadCallback(users){
    var select = '<label class="control-label col-md-4">TO</label><div class="col-md-8"><select  id="selectConsultantAdmin"><option value="0">SELECT_CONSULTANT</option>';
    $.each(users,function(key,user){
        select +='<option value="'+user.id+'">'+user.usr+'</option>';
    });
    select +='</select></div>';
    $('.reassignAdminAction').html(select);
    $('.createSubAdminAction').css('display','none');
    $('.createLeadAdminAction').css('display','none');
    $('.reassignAdminActionAllForms').css('display','none');
    $('#selectOptionAdmin').val(0);
    $('.reassignAdminActionForms').css('display','block');
    $('.filenoDivAdminAction').css('display','block');
    $('#adminActionModal .modal-title').html('REASSIGN LEAD');
    $('#adminActionModal').modal('show');
}

//after reassign all leads see if left submissions
function reassignAllLeadCallback(count){
    $('#adminActionModal').css('z-index','9999');
    $('#adminLoadingModal').modal('hide');
    if(count > 0){
        $('#reassignMessage').html("You need to reassign "+count+" submission from this consultant.");
        $('#reassignMessage').attr('sub',count);
        ajaxCallback('','allConsultants','reassignAllSubsCallback');
    }else{
        swal({title: "Action completed successfully.",
            type: "info",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
}

//show modal with fields to reassign all subs
function reassignAllSubsCallback(users){
    var select = '<label class="control-label col-md-4">TO</label><div class="col-md-8"><select  id="selectConsultantAdmin"><option value="0">SELECT_CONSULTANT</option>';
    $.each(users,function(key,user){
        select +='<option value="'+user.id+'">'+user.usr+'</option>';
    });
    select +='</select></div>';

    $('.reassignAdminCombo').html(select);
    $('#adminActionModal').modal('hide');
    $(document).on('click','#addConsultantFromCombo',function(action){
        event.preventDefault();
        event.stopPropagation();
        if($('#consultantList').text() != '' && $('#consultantList').text().split(",").length + 1 > $('#reassignMessage').attr("sub")){
            swal({title: "You reach the maximum number of consultants,because the number of consultants can't be greater than the number of subs. ",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }else if ($('#consultantList').text().indexOf($('#selectConsultantAdmin').val()) >= 0){
            swal({title: "you have that user in the list already.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
        }else{
            if($('#consultantList').val() == ''){
                $('#consultantList').val($('#selectConsultantAdmin :selected').text());
                $('#consultantList').text($('#selectConsultantAdmin').val());
            }else{
                $('#consultantList').val($('#consultantList').val()+','+$('#selectConsultantAdmin :selected').text());
                $('#consultantList').text($('#consultantList').text()+','+$('#selectConsultantAdmin').val());
            }
        }
    });
    $(document).on('click','#reassignAllSubmit',function(action){
        if ($('#consultantList').text() != ''){
            var list = $('#consultantList').text()
            var amount = $('#reassignMessage').attr("sub");
            var from = $('#reassignMessage').attr('consultant')
            ajaxCallback( {'LEADS':amount,'FROM':from,'TO':list},'reassignAllLeadWithSub','reassignAllLeadWithSubCallback');
            $('#adminReassignLeadWithSubModal').css('z-index','9998');
            $('#adminLoadingModal').modal('show');
        }else{
            swal({title: "you need at least one user in the list.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }
    });
    $('#adminReassignLeadWithSubModal').modal('show');
}

function reassignAllLeadWithSubCallback(){
    $('#adminLoadingModal').modal('hide');
    $('#adminReassignLeadWithSubModal').modal('hide');
    swal({title: "Action completed successfully.",
        type: "info",
        showCancelButton: false,
        confirmButtonText: "Ok",
        closeOnConfirm: true });
}

//show modal with fields to reassign one lead
function allConsultantsReassignAllLeadCallback(users){
    var selectTo = '<label class="control-label col-md-4">TO</label><div class="col-md-8"><select  id="selectToConsultantAdmin"><option value="0">SELECT_CONSULTANT</option>';
    var selectFrom = '<label class="control-label col-md-4">FROM</label><div class="col-md-8"><select  id="selectFromConsultantAdmin"><option value="0">SELECT_CONSULTANT</option>';

    var options = '';
    $.each(users,function(key,user){
        options +='<option value="'+user.id+'">'+user.usr+'</option>';
    });
    selectTo += options+'</select></div>';
    selectFrom += options+'</select></div>';

    $('.reassignAdminAction').html(selectFrom);
    $('.reassignAdminAll').html(selectTo);
    $('.createSubAdminAction').css('display','none');
    $('.createLeadAdminAction').css('display','none');
    $('.filenoDivAdminAction').css('display','none');
    $('#selectOptionAdmin').val(0);
    $('.reassignAdminActionForms').css('display','block');
    $('.reassignAdminActionAllForms').css('display','block');
    $('#adminActionModal .modal-title').html('REASSIGN MORE LEAD');
    $('#adminActionModal').modal('show');
}