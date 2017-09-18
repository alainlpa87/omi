$(document).ready(function(e){
    //setInterval("mailsys()", 60000);
    table = $('#tableDataManufacturer').DataTable( {
        dom: 'pBfrtip',
        "pageLength": 10,
        buttons: [
            //'print'
        ]
    } );
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
});

//create new manufacturer
$(document).on('click','#btnCreateManufacturer',function(){
    $('#btnSaveManufacturer').data('id','-1');
    $('#createManufacturerModal').modal('show');
});

//edit manufacturer info
$(document).on('click','.editManufacturer',function(){
    var manufacturerId = $(this).data('id');
    $('#btnSaveManufacturer').data('id',manufacturerId);
    ajaxCallback({'ID':manufacturerId},'loadManufacturer','backLoadManufacturer')

});

//show modal createNotes
$(document).on('click','.showModalCreateNote',function(){
    var manufacturerId = $(this).data('id');
    $('#btnCreateNote').data('id',manufacturerId);
    $('#noteManf').val("");
    ajaxCallback({'ID':manufacturerId},'loadManufacturerNotes','backLoadManufacturerNotes')
});

function backLoadManufacturerNotes(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '<div class="fileHeader"><span class="col-md-8">Files</span><span class="col-md-4">Date</span></div>';
        $.each(files,function( key,file )
        {
            var date = file.created_at.split(" ")[0].split("-")[1]+"-"+file.created_at.split(" ")[0].split("-")[2]+"-"+file.created_at.split(" ")[0].split("-")[0]+" "+file.created_at.split(" ")[1];
            htmlFiles+= "<div class='noteLink col-md-12' style='border-bottom: 1px solid;'>"+
                        "<div class='col-md-8'>"+file.notes+"</div>"+
                        "<div class='col-md-4' style='padding: 0px'>"+date+"</div>"+
                        "</div>";
        });
    }
    $('#divNotes').html(htmlFiles);
    $('#manufacturerNotesModal').modal('show');
}

//create manufacturer notes
$(document).on('click','#btnCreateNote',function(){
    var manufacturerId = $(this).data('id');
    var note = $('#noteManf').val();
    if(note != ""){
        ajaxCall({'ID':manufacturerId,'NOTES':note},'createNoteManufacturer',"Notes created successfully.","We couldn't create the note, please try later");
    }else{
        toastr.error("Notes is empty", "You had forgotten something!");
    }

});

function backLoadManufacturer(manufacturer){
    $('#manufacturerName').val(manufacturer.name);
    $('#manufacturerEmail').val(manufacturer.email);
    $('#manufacturerPhone').val(manufacturer.phone);
    $('#manufacturerFName').val(manufacturer.fname);
    $('#manufacturerLName').val(manufacturer.lname);
    $('#industrySelect').val(manufacturer.industry_id);
    if(manufacturer.hasNda == 1)
        $('#nda').prop('checked',true);
    else
        $('#nda').prop('checked',false);
    if(manufacturer.ndaSign == 1)
        $('#ndaSign').prop('checked',true);
    else
        $('#ndaSign').prop('checked',false);
    if(manufacturer.manfNda == 1)
        $('#manfNda').prop('checked',true);
    else
        $('#manfNda').prop('checked',false);
    if(manufacturer.cSignManfNda == 1)
        $('#cSignManfNda').prop('checked',true);
    else
        $('#cSignManfNda').prop('checked',false);
    if(manufacturer.manfNoNda == 1)
        $('#manfNoNda').prop('checked',true);
    else
        $('#manfNoNda').prop('checked',false);
    $('#createManufacturerModal').modal('show');
}

//save the manufacturer
$(document).on('click','#btnSaveManufacturer',function(){
    var manufacturerId = $(this).data('id');
    if($('#manufacturerName').val() == ''){
        toastr.error("Name field is empty", "You had forgotten something!");
        $('#manufacturerName').css('border-color','red');
    }else if($('#industrySelect').val()== '-1'){
        toastr.error("Industry field is empty", "You had forgotten something!");
        $('#industrySelect').css('border-color','red');
    }else{
        var name = $('#manufacturerName').val();
        var email = $('#manufacturerEmail').val();
        var phone = $('#manufacturerPhone').val();
        var fname = $('#manufacturerFName').val();
        var lname = $('#manufacturerLName').val();
        var industry = $('#industrySelect').val();
        var nda = $('#nda').is(':checked')?1:0;
        var ndaSign = $('#ndaSign').is(':checked')?1:0;
        var manfNda = $('#manfNda').is(':checked')?1:0;
        var cSignManfNda = $('#cSignManfNda').is(':checked')?1:0;
        var manfNoNda = $('#manfNoNda').is(':checked')?1:0;
        ajaxCallback({'ID':manufacturerId, 'NAME':name, 'INDUSTRY':industry, 'NDA':nda, 'NDASIGN':ndaSign,'MANFNDA':manfNda,'MANFNONDA':manfNoNda, 'CSIGNMANF':cSignManfNda,'EMAIL':email,'PHONE':phone,'FNAME':fname,'LNAME':lname}, 'saveManufacturer', 'backSaveManufacturer');
    }
});

// reflect the changes after edit or create manufacturer
function backSaveManufacturer(result){
    var name = $('#manufacturerName').val();
    var email = $('#manufacturerEmail').val();
    var phone = $('#manufacturerPhone').val();
    var fname = $('#manufacturerFName').val();
    var lname = $('#manufacturerLName').val();
    var industry = $('#industrySelect option:selected').text();
    var nda = $('#nda').is(':checked')?'YES':'NO';
    var ndaSign = $('#ndaSign').is(':checked')?'YES':'NO';
    var manfNda = $('#manfNda').is(':checked')?'YES':'NO';
    var cSignManfNda = $('#cSignManfNda').is(':checked')?'YES':'NO';
    var manfNoNda = $('#manfNoNda').is(':checked')?'YES':'NO';
    var table = $('#tableDataManufacturer').DataTable();
    if(result[0]=='new'){
        var mid = result[1];
        var newRow =['<span id="manfName_'+mid+'">'+name+'</span>','<span  id="indType_'+mid+'">'+industry+'</span>','<span id="manfEmail_'+mid+'">'+email+'</span>','<span id="manfPhone_'+mid+'">'+phone+'</span>','<span id="manfFName_'+mid+'">'+fname+'</span>','<span id="manfLName_'+mid+'">'+lname+'</span>','<span id="ndaSign_'+mid+'">'+ndaSign+'</span>','<span id="hasNda_'+mid+'">'+nda+'</span>','<span id="manfNda_'+mid+'">'+manfNda+'</span>','<span id="cSignManfNda_'+mid+'">'+cSignManfNda+'</span>','<span id="manfNoNda_'+mid+'">'+manfNoNda+'</span>','<i class="fa fa-folder-open loadManufacturerFiles" title="Load Files" style="color: lightskyblue;margin-left: 7px;cursor: pointer;" data-id="'+mid+'"></i> <i class="fa fa-upload uploadManufacturerFile" title="Upload File" style="color: lightskyblue;margin-left: 7px;cursor: pointer;" data-id="'+mid+'"></i><i class="fa fa-edit editManufacturer" style="color: lightskyblue;margin-left: 15px;" data-id="'+mid+'"></i> <i class="fa fa-times-circle-o deleteManufacturer" style="display: inline !important;margin-left: 7px;color: red" data-id="'+mid+'"></i>'];
        //$('#tableDataBodyManufacturer').append(newRow);
        table
            .row.add( newRow )
            .draw()
        //$('manfName_'+mid).parent().parent().attr('id', 'rowManufacturer_'+mid);
        toastr.success('Manufacturer saved!!')
    }else if(result[0]=='edit'){
        var mid =$('#btnSaveManufacturer').data('id');

       /////////updating the datatable/////////////

        var updatedRow =['<span id="manfName_'+mid+'">'+name+'</span>','<span id="indType_'+mid+'">'+industry+'</span>','<span id="manfEmail_'+mid+'">'+email+'</span>','<span id="manfPhone_'+mid+'">'+phone+'</span>','<span id="manfFName_'+mid+'">'+fname+'</span>','<span id="manfLName_'+mid+'">'+lname+'</span>','<span id="ndaSign_'+mid+'">'+ndaSign+'</span>','<span id="hasNda_'+mid+'">'+nda+'</span>','<span id="manfNda_'+mid+'">'+manfNda+'</span>','<span id="cSignManfNda_'+mid+'">'+cSignManfNda+'</span>','<span id="manfNoNda_'+mid+'">'+manfNoNda+'</span>','<i class="fa fa-folder-open loadManufacturerFiles" title="Load Files" style="color: lightskyblue;margin-left: 7px;cursor: pointer;" data-id="'+mid+'"></i> <i class="fa fa-upload uploadManufacturerFile" title="Upload File" style="color: lightskyblue;margin-left: 7px;cursor: pointer;" data-id="'+mid+'"></i><i class="fa fa-edit editManufacturer" style="color: lightskyblue;margin-left: 7px;" data-id="'+mid+'"></i> <i class="fa fa-times-circle-o deleteManufacturer" style="display: inline !important;margin-left: 7px;color: red" data-id="'+mid+'"></i>'];

        $('#tableDataManufacturer').dataTable().fnUpdate( updatedRow, $('tr#rowManufacturer_'+mid));

        location.reload();
        toastr.success('Manufacturer saved!!')
    }else
        toastr.error('An error has happened, please try later')
    $('#createManufacturerModal').modal('hide');
}

//clean modal
$(document).on('hidden.bs.modal','#createManufacturerModal',function(){
    $('#manufacturerName').val('');
    $('#manufacturerPhone').val('');
    $('#manufacturerEmail').val('');
    $('#manufacturerFName').val('');
    $('#manufacturerLName').val('');
    $('#industrySelect').val(-1);
    $('#nda').prop('checked',false);
    $('#ndaSign').prop('checked',false);
    $('#manufacturerName').css('border-color','black');
    $('#industrySelect').css('border-color','black');
});

//delete manufacturer
$(document).on('click','.deleteManufacturer',function(e){
    var id=$(this).data('id');
    $("#rowManufacturer_"+id).fadeOut(600, function(){
        $(this).remove();
    });
    ajaxCallback({'ID': id}, 'deleteManufacturer', 'deleteManfBack');
});

function deleteManfBack(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.')
    else{
        table
            .row( $('#manfNoNda_'+result).closest('tr') )
            .remove()
            .draw();
        toastr.success('Manufacturer Deleted!!')
    }
}

$(document).on('click','.uploadManufacturerFile',function(){
    $('#closeUploadFile').data('manufacturer',$(this).data('id'));
    myDropzone.removeAllFiles(true);
    $('#headUploadFM').text('Drag and Drop or Select Add Files to Upload Files');
    $('#uploadFileModal').modal('show');
});

$(document).on('click','.loadManufacturerFiles',function(e){
    var id = $(this).data('id');
    ajaxCallback({'MID':id},'loadFilesManufacturer','paintFilesManufacturer');
});

function paintFilesManufacturer(files){
    var htmlFiles = '';
    if(files[0].length>0)
    {
        htmlFiles = '<div class="fileHeader"><span class="col-md-6">Files</span><span class="col-md-3">Date</span></div>';
        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='button' class='deleteFile btn btn-primary col-md-1 pull-right' value='delete' data-id='"+file.id+"'>" +
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.fileName+"'>" +
            "<span class='col-md-6'><strong>"+file.name+"</strong></span>" +
            "<span class='col-md-3'><strong>"+file.created+"</strong></span>"+
            "</div>";
        });
        $('.container-founds').html(htmlFiles);
        $('.showFile').click(function(e){
            var url = $(this).data("url");
            var name = $(this).data("name");
            window.open(url,name);
        });

        $('.deleteFile').click(function(e){
            var fileId = $(this).data("id");
            ajaxCallback({'FILE':fileId},'deleteFiles','deleteFilesCallback');
        });

        $('#filesModalILC').modal('show');
    }
    else
        toastr.error('This project doesn\'t have files',"No Files");
}

//delete file from the modal
function deleteFilesCallback(id){
    if(id != "-1"){
        $("#fileFound_"+id).fadeOut(600, function(){
            $(this).remove();
        });
    }else{
        toastr.error('We can\'t delete this file now.',"Error.");
    }
}