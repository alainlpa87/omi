var currentProject,currentIlcV;
$(document).ready(function(e){
    setInterval("mailsys()", 60000);
    setInterval("loadAppointments()", 60000);
    initializeDateTimePicker();
    currentProject = {id:-1};
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
    portletEvents();

    $('.pickDate').datepicker({});

});

//Return the id of the current project.
function getCurrentProject(){
    return currentProject.id;
}

//events for portlets
function portletEvents()
{
    //set the current project as selected
    $(document).on('click','.portlet',function(e){

        if(currentProject.id!=$(this).data('id'))
        {
            currentProject = {
                id:$(this).data('id'),
                phone:$('#phone_p_'+$(this).data('id')).html(),
                email:$('#email_p_'+$(this).data('id')).html()
            };
            currentIlcV = {
                id:$(this).data('iid')
            };
            $('.inputCurrentPhone').val(currentProject.phone);
            $('.portlet-selected').removeClass('portlet-selected');
            $(this).addClass('portlet-selected');

        }
    });



    ////print business profile
    //$(document).on('click','.printBusiness',function(e){
    //    var id = $(this).data('id');
    //    $("#iframePrint").attr('src', "printBusinessProfileAdmin?ID="+id);
    //});


    //print project
    $(document).on('click','.printProjectILCVendors',function(e){
        var id = $(this).data('id');
        $("#iframePrint").attr('src', "printProjectAdmin?ID="+id);
    });

    //show the uploadFiles modal.
    $(document).on('click','.uploadFilesILCVendors',function(e){
        if(currentProject.id == -1){
            swal({title: "You must click in the project!",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
        }else{
            myDropzone.removeAllFiles(true);
            $('#uploadFileModal').modal('show');
        }
    });

//Load all accessible files for a project
    $(document).on('click','.openFilesILCVendors',function(e){
        var id = $(this).data('id');
        ajaxCallback({'ID':id},'loadFilesILCVendors','paintFoundFiles');
    });
}

//Show a modal with all the files
function paintFoundFiles(files){
    var htmlFiles = '';
    if(files.length>0)
    {
        htmlFiles = '</div> <div class="fileHeader"> <span class="col-md-6 col-md-push-1">Files</span><span class="col-md-3 col-md-push-1">Date</span></div>';

        $.each(files,function( key,file )
        {
            htmlFiles+="<div id='fileFound_"+file.id+"' class='fileFound'> " +
            "<input type='button' class='showFile btn btn-primary col-md-1 pull-right' value='open' data-url='"+file.url+"' data-name='"+file.name+"'>" +
            "<span class='col-md-6 col-md-push-1'><strong>"+file.name+"</strong></span>" +
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

        $('#ILCVendorsFilesModal').modal('show');
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
        toastr.error('We can\'t delete this file now.',"Error");
    }
}

//expande or collapse the Find Sub input
$("#inputFindSub").expandable({
    width: 180,
    duration: 300
});

//Call to find Project when is pressed  enter key and Search Projects by fname, lname, phone, email or fileno
$("#inputFindSub").keypress(function(e) {
    if(e.which == 13 && $(this).val().length>0){
        $('#adminLoadingModal').modal('show');
        ajaxCallback({'PARAMS':$(this).val().trim()},'findProjectILCVendors','paintFoundProjectsILCVendorsCallback');
    }
});

//paint projects from Find Sub
function paintFoundProjectsILCVendorsCallback(projects){
    if(projects.length>0)
    {
        //Hide the current portlets
        $('.container-portlets').css('display','none');
        //Clean the container for previous search
        $('.container-added-portlets').html('');
        for(var i =0;i<projects.length;i++){
            var project = $(projects[i]);
            //if exists the portlet searched in the current view, move it for the search result view
            var ident = '#container_'+project.data('id');
            if($(ident).length!=0)
            {
                //add a field called exists to know if it was showed previously
                project.attr('data-exists',1);
                $('#container_'+project.data('id')).remove();
            }
            $('.container-added-portlets').append(project);
        }
        //unselected all the projects in the view
        $('.portlet-selected').removeClass('portlet-selected');
        currentProject = {id:-1};
        $('.container-portlets-found').css('display','inline');
        $('.pickDate').datepicker({});
        $('select.select').each(function(){
            var title = $(this).attr('title');
            if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
            $(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                .after('<span class="select btn-warning">' + title + '</span>')
                .change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().text(val);
                })
        });
        $('#adminLoadingModal').modal('hide');
    }
    else{
        $('#adminLoadingModal').modal('hide');
        toastr.error('Sorry no matches',"No Matches");
    }
}

//Close search result box and show again portlets
$('.close-portlets-found').click(function(e){
    $('.container-added-portlets').find( ".portlet").each(function(e){
        if($(this).data('exists')==1){
            var portlet = $(this);
            $('.container-portlets-new').append(portlet);
            switch ($(this).data('state')){
                case 0:
                    $('.container-portlets-new').append(portlet);
                    break;
                case 1:
                    $('.container-portlets-returned').append(portlet);
                    break;
                case 2:
                    $('.container-portlets-overdue').append(portlet);
                    break;
                default :
                    break;
            }
        }
    });
    $('.portlet-selected').removeClass('portlet-selected');
    currentProject = {id:-1};
    $('.container-portlets').css('display','inline');
    $('.container-portlets-found').css('display','none');
    $('.container-added-portlets').html('');
    $('#inputFindSub').val('');
});

//slide the accordion
$(document).on('click','.indicator',function(e){
    var id = $(this).data('id');
    $('.indicator').each(function(e){
        var idT = $(this).data('id');
        if(idT!=id)//projects not selected
        {
            //hide the tab and changed the arrow position
            $(".portlet_tab_content_"+idT).css('display', 'none');
            $("#container_"+idT).css('height', '40px');
            $("#portletBody_"+idT).addClass('hide');
            $("#indicator_"+idT).removeClass('fa-chevron-up');
            $("#indicator_"+idT).addClass('fa-chevron-down');
            $("#navTabs_"+idT).addClass('invisible');
        }
    });
    //changed to visible
    if($("#portletBody_"+id).hasClass('hide')){
        $(".portlet_tab_content_"+id).css('display', 'block');
        $("#container_"+id).css('height', 'auto');
        $("#portletBody_"+id).removeClass('hide');
        $("#navTabs_"+id).removeClass('invisible');
        $("#indicator_"+id).removeClass('fa-chevron-down');
        $("#indicator_"+id).addClass('fa-chevron-up');
    }else{ //changed to hide
        $(".portlet_tab_content_"+id).css('display', 'none');
        $("#container_"+id).css('height', '40px');
        $("#portletBody_"+id).addClass('hide');
        $("#navTabs_"+id).addClass('invisible');
        $("#indicator_"+id).removeClass('fa-chevron-up');
        $("#indicator_"+id).addClass('fa-chevron-down');
    }
});

