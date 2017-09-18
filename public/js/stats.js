var currentDate,table = null;
$(document).ready(function(e){
    table = $('#tableDataStats').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    currentDate = $('.selectedMonth').val();
    $('#tableDataProduction').css('display','none');
    $('#tableDataProductionProgressReport').css('display','none');
    $('#titleChart').css('display','inline');
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
});
//events
//search consultant scores for the last 14 days including today
$(document).on('click','#btnScores',function(e){
   ajaxCallback([],'consultantScores','paintScores');
});

//create a table with the scores
function paintScores(data)
{
    if(table!=null)
        table.destroy();
    $('#tableDataBodyScores').html('');
    $('#titleChart').text("CONSULTANT SCORE FOR THE LAST 14 DAYS");
    $.each(data,function(consultant,data_consultant){
        var tr="<tr><th>"+consultant+"</th>";
        $.each(data_consultant,function(key,value){
            tr+='<th>'+value+'</th>';
        });
        tr+='</tr>';
        $('#tableDataBodyScores').append($(tr));
    });
    table = $('#tableDataScores').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    $('#tableDataScores').css('display','block');
    $('#tableDataStats').css('display','none');
    $('#tableDataProduction').css('display','none');
    $('#tableDataProductionProgressReport').css('display','none');
    $('.infoChart').css('display','none');
}
//search consultant stats for the last month including today
$(document).on('click','#btnStats',function(e){
    var data = {'MONTH':$('.selectedMonth').val()};
    ajaxCallback(data,'consultantStats','paintStats');
});
//create a table with the stats
function paintStats(data)
{
    if(table!=null)
        table.destroy();
    $('#tableDataBodyStats').html('');
    $('#titleChart').text($(".selectedMonth option:selected").text()+" Numbers");
    $.each(data,function(consultant,data_consultant){
        if(consultant!="TOTAL")
        {
            var tr="<tr><th>"+consultant+"</th>";
            $.each(data_consultant,function(key,value){
                tr+='<th>'+value+'</th>';
            });
            tr+='</tr>';
            $('#tableDataBodyStats').append($(tr));
        }else{
            var p="<p>Calls: "+data_consultant['CALLS']+"</p>"+"<p>SUBS: "+data_consultant['SUBS']+"</p>"+"<p>CONT: "+data_consultant['CONT']+"</p>"+"<p>PH1: "+data_consultant['PH1']+"</p>"+"<p>IMG: "+data_consultant['IMG']+"</p>";
            $('.infoChart').html("");
            $('.infoChart').append($(p));
        }
    });
    table = $('#tableDataStats').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    $('#tableDataStats').css('display','block');
    $('.infoChart').css('display','block');
    $('#tableDataScores').css('display','none');
    $('#tableDataProduction').css('display','none');
    $('#tableDataProductionProgressReport').css('display','none');
}

//search consultant production for the next 2 months
$(document).on('click','#btnProduction',function(e){
    ajaxCallback([],'consultantProduction','paintProduction');
});
//create a table with the production
function paintProduction(data)
{
    if(table!=null)
        table.destroy();
    $('#tableDataBodyProduction').html('');
    $('#titleChart').text("Consultant's Projects");
    $.each(data,function(pos,data_consultant){
        var tr="<tr>";
        $.each(data_consultant,function(key,value){
            tr+='<th>'+value+'</th>';
        });
        tr+='</tr>';
        $('#tableDataBodyProduction').append($(tr));
    });
    table = $('#tableDataProduction').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    $('#tableDataProduction').css('display','block');
    $('#tableDataStats').css('display','none');
    $('#tableDataScores').css('display','none');
    $('#tableDataProductionProgressReport').css('display','none');
    $('.infoChart').css('display','none');
}

//productionProgressReport
$(document).on('click','#productionProgressReport',function(e){
    ajaxCallback([],'productionProgressReport','paintProductionProgress');
});
//create a table with the productionProgressReport
function paintProductionProgress(data)
{
    if(table!=null)
        table.destroy();
    $('#tableDataBodyProductionProgressReport').html('');
    $('#titleChart').text("Production Progress Report");
    $.each(data,function(pos,data_consultant){
        var tr="<tr>";
        $.each(data_consultant,function(key,value){
            tr+='<th>'+value+'</th>';
        });
        tr+='</tr>';
        $('#tableDataBodyProductionProgressReport').append($(tr));
    });
    table = $('#tableDataProductionProgressReport').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    $('#tableDataProduction').css('display','none');
    $('#tableDataStats').css('display','none');
    $('#tableDataScores').css('display','none');
    $('#tableDataProductionProgressReport').css('display','block');
    $('.infoChart').css('display','none');
}

//productionProgressReport CSV
$(document).on('click','#productionProgressReportCSV',function(e){
    ajaxCallback([],'productionProgressReportCSV','paintProductionProgressCSV');
});
//create a table with the productionProgressReport
function paintProductionProgressCSV(data)
{
    window.open(data);
}