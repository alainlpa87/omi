$(document).ready(function(e){
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    portletEvents();
    table = $('#tableCalls').DataTable( {
        dom: 'pBfrtip',
        buttons: [
            'print'
        ]
    } );
});


//events for portlets
function portletEvents()
{
   //load in the form the data for the consultant
    $(document).on('click','#btnRecordConsultant',function(e){
        var id = $('.consultantSelect').val();
        if(id==-1){
            toastr.error('Select one consultant.');
        }
        else{
            ajaxCall({'ID':id},'recordCallManager','We are recording the call.','This user is not in a call.');
            $('.consultantSelect').val("-1");
        }
    });

    $(document).on('click','.deleteCall',function(e){
        var id = $(this).data('id')
        ajaxCallback({'ID':id},'deleteCall','deleteCallCallback');
    });
}

//create a table with the calls
function deleteCallCallback(id){
    $('#'+id).remove();
}