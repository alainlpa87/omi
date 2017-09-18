$(document).ready(function(e){
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    portletEvents();
});


//events for portlets
function portletEvents()
{
    $(document).on('click','.btnAssignLeads',function(e){
        var id = $('.consultantSelect').val();
        var leads = $('.leadAmount').val();
        if(id==-1 || leads == 0)
        {
            swal({title: "Select the consultant and the amount of leads.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }
        else
        {
            ajaxCall({'ID':id,'NUMBER':leads},'assignLead',"Leads Assigned successfully.","We couldn't assign the leads, please try later");
            $('.consultantSelect').val(-1);
            $('.leadAmount').val(0);
        }
    });
    $(document).on('click','.btnFixContract',function(e){
        var type = $('.contractTypeSelect').val();
        var project = $('#project').val();
        if(type==-1 || project == "")
        {
            swal({title: "You are missing some info.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }
        else
        {
            ajaxCall({'TYPE':type,'ID':project},'fixContract',"Contract Fixed successfully.","We couldn't fix the contract, please try later");
            $('.contractTypeSelect').val(-1);
            $('#project').val("");
        }
    });
    $(document).on('click','.btnFixDuplicate',function(e){
        var project = $('#projectDuplicate').val();
        if(project == "")
        {
            swal({title: "You are missing some info.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return;
        }
        else
        {
            ajaxCall({'ID':project},'fixDuplicateProject',"Duplicate Deleted successfully.","Project Doesn't exist or has a contract with payments");
            $('#projectDuplicate').val("");
        }
    });
}