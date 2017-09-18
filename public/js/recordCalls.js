var currentProject;
var filesToMerge;//array to save the order of the files to make a merge
$(document).ready(function(e){
    setInterval("mailsys()", 60000);
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
});

$(document).on('click','.recordUrl', function(){
    var url = $(this).data('url');
    var win = window.open(url, '_blank');
});

$(document).on('click','.recordCallId',function(){
    var id = $(this).data('id');
    var phone = $('#spanPhone').data('phone');
    ajaxCall({'PHONE':phone, 'LIBRARY':id},'callLibrary',"","");
});

$('#trainingDocs').change(function(e){
    if($('#trainingDocs').val() != 0){
        window.open($(this).val(),'_blank');
        $('#trainingDocs').val(0);
    }
});

$(document).on('click','.checkLibrary', function(){
    if($(this).prop('checked'))
        var value = 1;
    else
        var value = 0;
    var lid = $(this).data('id');
    ajaxCall({'VALUE':value, 'LIBRARY':lid},'changeLibrary','Library changed!!','An error has happened, please try later.')
});

$(document).on('focus', '.setDescription', function(e){
    titleInventionCheck = $(this).val();
});

$(document).on('blur', '.setDescription', function(e){
    var value = $(this).val();
    var lid =$(this).data('id');
    if(titleInventionCheck != value)
        ajaxCall({'VALUE':value,'LIBRARY':lid},'changeDescription','Description saved!!','An error has happened, please try later.');
});

$(document).on('click','.deleteCall',function(e){
    var id = $(this).data('id')
    ajaxCallback({'ID':id},'deleteCall','deleteCallCallback');
});

function deleteCallCallback(id){
    $('#'+id).remove();
}

