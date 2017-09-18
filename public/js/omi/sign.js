$(document).ready(function(e){
    var defaultDate = new Date();
    $('#trademark_letter_date').datetimepicker({
        defaultDate: defaultDate
    });
    $('#mark_used_bef').datetimepicker({
        //defaultDate: defaultDate
    });
    $('#inventor_birthday').datetimepicker({
        defaultDate: defaultDate
    });
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
                window.location.href='launch';
            });
    else
        swal({title: "Contract signed successfully.",
            type: "info",
            showCancelButton: false,
            confirmButtonColor: "#8CD4F5",
            confirmButtonText: "Ok",
            closeOnConfirm: true },
            function(){
                window.location.href='launch';
        });
}
function checkFormSign()
{
    if($('#contract_type_hidden').length >0){
        var checked = 0;
        switch ($("#contract_type_hidden").val()){
            case 'Utility':
                $('#hidden_plan1').val($("#plan1").is(':checked'));
                $('#hidden_plan2').val($("#plan2").is(':checked'));
                $('#hidden_plan3').val($("#plan3").is(':checked'));
                $('#hidden_plan4').val($("#plan4").is(':checked'));
                if($('#plan5').length >0){
                    $('#hidden_plan5').val($("#plan5").is(':checked'));
                }
                if($('#plan6').length >0){
                    $('#hidden_plan6').val($("#plan6").is(':checked'));
                }
                for (i = 1; i < 7; i++) {
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
                if($('#plan9').length >0){
                    $('#hidden_plan9').val($("#plan9").is(':checked'));
                }
                if($('#plan10').length >0){
                    $('#hidden_plan10').val($("#plan10").is(':checked'));
                }
                if($('#plan11').length >0){
                    $('#hidden_plan11').val($("#plan11").is(':checked'));
                }
                if($('#plan12').length >0){
                    $('#hidden_plan12').val($("#plan12").is(':checked'));
                }
                for (i = 1; i < 13; i++) {
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

    if($('#hidden_price').length >0){
        var finalPrice = $('#tPrice').html().replace(/[^0-9]+/g,"");
        $('.plansIig').each(function (index, value) {
            if ($(this).prop('checked')){
                finalPrice = $(this).data('val');
            }
        });
        $('#newPrice_hidden').val(finalPrice);

        //test docusign
        if($('#newPrice_hidden1').length >0)
            $('#newPrice_hidden1').val(finalPrice);
    }
    return true;
}

//behavior of PPA plans
$(document).on('click','.plans',function(e) {

    var price = $('#tPrice').html().replace(/[^0-9]+/g, "");
    var priceaux = parseInt(price, 10);
    var actuallyprice = $(this).data('val');

    if($(this).data('id') == 'halfPlan' && !$('#plan1').prop('checked')){
        priceaux += $(this).data('val');
        $('#plan1').prop('checked',true);
        $('#tPrice').text(priceaux.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
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

//behavior of IIG, IGUP plans
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

//show info in the plans of the contracts
$(document).on('click','#hide_show_PoU',function(e){
    if($('#hide_show_PoU').data('hide')=="1"){
        $('#list_PoU').removeClass('hide');
        $('#hide_show_PoU').data('hide',0);
        $("#indicator_PoU").removeClass('fa-chevron-down');
        $("#indicator_PoU").addClass('fa-chevron-up');
    }else{
        $('#list_PoU').addClass('hide');
        $('#hide_show_PoU').data('hide',1);
        $("#indicator_PoU").removeClass('fa-chevron-up');
        $("#indicator_PoU").addClass('fa-chevron-down');
    }
});

$('#hide_show_PoU').css( 'cursor', 'pointer' );

//show info in the plans of the contracts
$(document).on('click','#hide_show_InvStrat',function(e){
    if($('#hide_show_InvStrat').data('hide')=="1"){
        $('#list_InvStrat').removeClass('hide');
        $('#hide_show_InvStrat').data('hide',0);
        $("#indicator_InvSt").removeClass('fa-chevron-down');
        $("#indicator_InvSt").addClass('fa-chevron-up');
    }else{
        $('#list_InvStrat').addClass('hide');
        $('#hide_show_InvStrat').data('hide',1);
        $("#indicator_InvSt").removeClass('fa-chevron-up');
        $("#indicator_InvSt").addClass('fa-chevron-down');
    }
});

$('#hide_show_InvStrat').css( 'cursor', 'pointer' );

// to avoid electronic signature of the pct psa
function pctPsaSign(){
    swal({title: "A manual signature is needed for this document. Please print, sign, and return via email, fax, upload, or mail. If you need a hard copy mailed it is available by request.",
        type: "error",
        showCancelButton: false,
        confirmButtonText: "Ok",
        closeOnConfirm: true });
    return false;
}