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

