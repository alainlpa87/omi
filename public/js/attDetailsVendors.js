var currentDate,table = null;
$(document).ready(function(e){
    table = $('#tableDataStats').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    currentDate = $('.selectedMonth').val();
    $('#titleChart').css('display','inline');
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
});
//events
//search attorney details for the last month including today
$(document).on('click','#btnAttorneyStats',function(e){
    var data = {'MONTH':$('.selectedMonth').val(),'ATT':$(this).data('pin')};
    ajaxCallback(data,'reportAttSelectMonthVendors','paintStats');
});
//create a table with the stats
function paintStats(data)
{
    var name = $('#btnAttorneyStats').data('name');
    if(table!=null)
        table.destroy();
    $('#tableDataBodyStats').html('');
    $('#titleChart').text($(".selectedMonth option:selected").text()+" Attorney Details ("+name+")");
    $.each(data,function(i,data_attorney){
        var aux;
        if(data_attorney[3]!='')
            aux=data_attorney[3];
        else
            aux = "N/A";
        var tr="<tr><th>"+data_attorney[0]+"</th><th>"+data_attorney[1]+"</th><th>"+data_attorney[2]+"</th><th>"+ aux+"</th></tr>";
        $('#tableDataBodyStats').append($(tr));
    });
    table = $('#tableDataStats').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
    $('#tableDataStats').css('display','block');
}
