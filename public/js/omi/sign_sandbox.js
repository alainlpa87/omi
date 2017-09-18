$(document).ready(function(e){
    var defaultDate = new Date();
    $('#inventor_date').datetimepicker({
        defaultDate: defaultDate
    });
    $('#coinventor_date').datetimepicker({
        defaultDate: defaultDate
    });
});
$(document).on('click','#acceptTerms',function(e){
    if($('#inventor_name').val().length==0)
    {
        swal({title: "We need your Full Name",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
    if(!$('#chk').is(':checked'))
    {
        swal({title: "We need your consent. Please check 'I Agree' checkbox.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        $('.agreewarn').remove();
        $('.labelAgree').css('color','red').after("<span class='agreewarn'><i class='fa fa-arrow-left'></i>&nbsp;Please check 'I Agree' to continue.</span>");
        return;
    }
    var id = $(this).data('id');
    var inventor_date = dateToString($('#inventor_date').data("DateTimePicker").date()._d);
    var cinventor_date = dateToString($('#coinventor_date').data("DateTimePicker").date()._d);
    var data={'ID':id,
        'INVENTOR_NAME':$('#inventor_name').val(),
        'INVENTOR_DATE':inventor_date,
        'CINVENTOR_NAME':$('#coinventor_name').val(),
        'CINVENTOR_DATE':cinventor_date };
    ajaxCallback(data,'../signedContract',"redirectLaunch");
});
//show legal disclosure
$(document).on('click','#seeLink',function(){
    if(!$( "#collapseExample" ).hasClass( "in" ))
        $('#collapseExample').addClass("in");
    $('#collapseExample').attr('aria-expanded',true);
    $('#collapseExample').css('height','auto');
});
//set to default the I agree checkbox when is click it
$(document).on('click','#chk',function(){
    if($('#chk').is(':checked'))
    {
        $(".labelAgree").css('color','inherit');
        $(".agreewarn").hide();
    }
});
//set to default the inventor_name input when is click it
$('#inventor_name').on('keyup',function(){
    $('#inventor_name').val().length==0? $('#inventor_name').css("border","1px solid red"):$("#inventor_name").css('border','1px solid #000000');
});
function redirectLaunch(result)
{
    if(result==-1)
        swal({title: "You can't sign this contract.It doesn't belong to you.",
                type: "info",
                showCancelButton: false,
                confirmButtonColor: "#8CD4F5",
                confirmButtonText: "Ok",
                closeOnConfirm: true },
            function(){
                window.location.href='launch_sandbox';
            });
    else
        swal({title: "Contract signed successfully.",
            type: "info",
            showCancelButton: false,
            confirmButtonColor: "#8CD4F5",
            confirmButtonText: "Ok",
            closeOnConfirm: true },
            function(){
                window.location.href='launch_sandbox';
        });
}
function checkFormSign()
{
    swal({title: "The client is redirected to Docusign",
        type: "error",
        showCancelButton: false,
        confirmButtonText: "Ok",
        closeOnConfirm: true });
    return false;
    if($('#contract_type_hidden').length >0){
        var checked = 0;
        switch ($("#contract_type_hidden").val()){
            case 'Utility':
                $('#hidden_plan1').val($("#plan1").is(':checked'));
                $('#hidden_plan2').val($("#plan2").is(':checked'));
                $('#hidden_plan3').val($("#plan3").is(':checked'));
                $('#hidden_plan4').val($("#plan4").is(':checked'));
                for (i = 1; i < 5; i++) {
                    if($('#hidden_plan'+i).val() == 'true'){
                        checked++;
                    }
                }
                break;
            case 'IMG':
                $('#hidden_plan1').val($("#plan1").is(':checked'));
                $('#hidden_plan2').val($("#plan2").is(':checked'));
                for (i = 1; i < 3; i++) {
                    if($('#hidden_plan'+i).val() == 'true'){
                        checked++;
                    }
                }
                break;
            case 'U_D':
                $('#hidden_plan1').val($("#plan1").is(':checked'));
                $('#hidden_plan2').val($("#plan2").is(':checked'));
                $('#hidden_plan3').val($("#plan3").is(':checked'));
                $('#hidden_plan4').val($("#plan4").is(':checked'));
                $('#hidden_plan5').val($("#plan5").is(':checked'));
                $('#hidden_plan6').val($("#plan6").is(':checked'));
                $('#hidden_plan7').val($("#plan7").is(':checked'));
                $('#hidden_plan8').val($("#plan8").is(':checked'));
                for (i = 1; i < 9; i++) {
                    if($('#hidden_plan'+i).val() == 'true'){
                        checked++;
                    }
                }
                break;
        }
        if(checked==0)
        {
            swal({title: "Check at least one plan.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return false;
        }
        var hP=$('#tPrice').html().replace(/[^0-9]+/g,"");
        $('#hidden_price').val(hP);
    }
    if($('#tPrice').length >0 && ($('#tPrice').html() == "" || $('#tPrice').html() == "NaN")){
        swal({title: "Check at least one plan.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return false;
    }
    if($('#inventor_name').val().length==0)
    {
        swal({title: "We need your Full Name",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return false;
    }
    if(!$('#chk').is(':checked'))
    {
        swal({title: "We need your consent. Please check 'I Agree' checkbox.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        $('.agreewarn').remove();
        $('.labelAgree').css('color','red').after("<span class='agreewarn'><i class='fa fa-arrow-left'></i>&nbsp;Please check 'I Agree' to continue.</span>");
        return false;
    }
    var inventor_name = $('#inventor_name').val();
    var cinventor_name = $('#coinventor_name').val();
    var inventor_date = dateToString($('#inventor_date').data("DateTimePicker").date()._d);
    var cinventor_date = dateToString($('#coinventor_date').data("DateTimePicker").date()._d);
    $('#inventor_name_hidden').val(inventor_name);
    $('#cinventor_name_hidden').val(cinventor_name);
    $('#inventor_date_hidden').val(inventor_date);
    $('#cinventor_date_hidden').val(cinventor_date);
    return true;
}

$(document).on('click','.plans',function(e) {

    if($(this).data('id') == 'halfPlan' && !$('#plan1').prop('checked')){
        swal({title: "Plan 1 Have to be selected.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        $(this).prop('checked',false);
        return;
    }

    if($('#halfPlan').length != 0 && $('#halfPlan').prop('checked') && $(this).attr("id") == 'plan1'){
        swal({title: "Uncheck Half Payment First.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        $(this).prop('checked',true);
        return;
    }
    var price = $('#tPrice').html().replace(/[^0-9]+/g, "");
    var priceaux = parseInt(price, 10);
    var actuallyprice = $(this).data('val');
    if ($('#halfPlan').length == 0) {
        if ($(this).prop('checked')) {
            priceaux += actuallyprice;
        } else {
            priceaux -= actuallyprice;
        }
        $('#tPrice').text(priceaux.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        return;
    } else if($(this).data('id') == 'halfPlan'){
        if ($(this).prop('checked')) {
            priceaux -= $(this).data('val');
            $('#tPrice').text(priceaux.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        }else{
            var val = 0;
            $('.plans').each(function (index, value) {
                if($(this).prop('checked')){
                    val +=parseInt($(this).data('val'), 10);
                }
            });
            $('#tPrice').text(val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
            return;
        }
    }else if($('#halfPlan').prop('checked')){
        if ($(this).prop('checked')) {
            priceaux += actuallyprice;
        } else {
            priceaux -= actuallyprice;
        }
        $('#tPrice').text(priceaux.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        return;
    }else{
        if ($(this).prop('checked')) {
            priceaux += actuallyprice;
        } else {
            priceaux -= actuallyprice;
        }
        $('#tPrice').text(priceaux.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        return;
    }
});

$(document).on('click','.plansIig',function(e) {

    if ($(this).prop('checked')) {
        var current = $(this);
        $('.plansIig').each(function (index, value) {
            if($(this)!= current){
                $(this).prop( "checked", false );
            }
        });
        current.prop( "checked", true );
        if($('#hidden_iigUpgrade').val() == 0){
            $('#tPrice').text(current.data('val').toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        }else{
            var finalPrice = current.data('val') - $('#hidden_paid').val()
            $('#tPrice').text(finalPrice.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        }

    } else {
        $('#planGold').prop( "checked", true );
        if($('#hidden_iigUpgrade').val() == 0){
            $('#tPrice').text($('#planGold').data('val').toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        }else{
            var finalPrice = $('#planGold').data('val') - $('#hidden_paid').val()
            $('#tPrice').text(finalPrice.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        }
    }
    return;
});

