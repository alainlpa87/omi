$(document).ready(function(e){

});

function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}

//validate email
function validateEmail(email){
    if(email != ''){
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }else{
        return false;
    }
}

//validate Best time to call
function validateBestTimeToCall(time){
    var regex = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/;
    return regex.test(time);
}

//validate phone
function validatePhone(phone){
    phone = phone.replace(/[^\d]/g, '');
    var isnum = /^\d+$/.test(phone);
    if (!isnum || !(phone.length == 10 || phone.length == 11) || (phone[0]=='0') || (phone[0] == '1' && phone.length != 11) )
        return false;
    return true;
}

function validateZip(zip){
    return /^\d+$/.test(zip);
}

//validate ideaConcept.
$("#product_desc").keyup(function(){
    $('#labelCount').html($("#product_desc").val().length);
    if($("#product_desc").val().length > 120){
        $("#product_desc").css("border-color","");
    }
});

$("#product_desc").blur(function(){
    if($("#product_desc").val().length < 120){
        $("#product_desc").css("border-color","border-color","red");
        toastr.error("Minimum characters not reached yet.", "You had forgotten something!");
    }
});

//validate hisidea.
$("#when_how").keyup(function(){
    $('#labelCount1').html($("#when_how").val().length);
    if($("#when_how").val().length > 12){
        $("#when_how").css("border-color","");
    }
});

$("#when_how").blur(function(){
    if($("#when_how").val().length < 12){
        $("#when_how").css("border-color","red");
        toastr.error("Minimum characters not reached yet.", "You had forgotten something!");
    }
});

//validate probidea.
$("#problem_solve").keyup(function(){
    $('#labelCount2').html($("#problem_solve").val().length);
    if($("#problem_solve").val().length > 10){
        $("#problem_solve").css("border-color","");
    }
});

$("#problem_solve").blur(function(){
    if($("#problem_solve").val().length < 10){
        $("#problem_solve").css("border-color","red");
        toastr.error("Minimum characters not reached yet.", "You had forgotten something!");
    }
});

$(document).on('change','#isApp', function(){
    var value = $(this).val();
    if(value == 1)
        $('#selectLanguage').removeClass('hidden');
    else
        $('#selectLanguage').addClass('hidden');
});

$(document).on('click','#next', function () {
    var step = $(this).data('step');
    switch (step){
        case 1:
           if($('#first_name').val() == ''){
               toastr.error("First Name field is empty", "You had forgotten something!");
               $('#first_name').css('border-color','red');
           }else if($('#last_name').val() == ''){
               toastr.error("Last Name field is empty", "You had forgotten something!");
               $('#last_name').css('border-color','red');
           }else if(!validateEmail($("#email_address").val())){
               toastr.error("Email field is empty or incorrect format for email provided", "You had forgotten something!");
               $('#email_address').css('border-color','red');
           }else if ($("#phone_number").val() == ''){
               toastr.error("We want to talk with you, please provide us your phone number!", "You had forgotten something!");
               $('#phone_number').css('border-color','red');
           }else if (!validatePhone($("#phone_number").val())){
               toastr.error("Incorrect format for phone number provided", "You had forgotten something!");
               $('#phone_number').css('border-color','red');
           }else if($("#passw").val()==''){
               toastr.error("Password field is empty", "You had forgotten something!");
           }else if($("#passw").val().length < 7){
               toastr.error("Password field require 7 characters minimum.", "You had forgotten something!");
           }else if($("#passw").val()!=$('#passwordConfirm').val()){
               $("#passwordConfirm").css("border","1px solid red");
               toastr.error("Passwords don't match", "You had forgotten something!");
           }else{
               $('#step-1').css("display","none");
               $('#step-2').css("display","block");
               $(this).data('step',2);
               $('#back').data('step',2);
               $('#progress_bar').html('<span>Step 2 of 6</span>')
               $('#progress_bar').css('width','40%');
               $('#back').removeClass('hidden');
           }
            break;
        case 2:
            if($('#street').val() == ''){
                toastr.error("Address field is empty", "You had forgotten something!");
                $('#street').css('border-color','red');
            }else if($('#city').val() == ''){
                toastr.error("City field is empty", "You had forgotten something!");
                $('#city').css('border-color','red');
            }else if ($("#state").val() == ''){
                toastr.error("State field is empty", "You had forgotten something!");
                $('#state').css('border-color','red');
            }else if ($("#zip").val() == ''){
                toastr.error("Zip field is empty", "You had forgotten something!");
                $('#zip').css('border-color','red');
            }else if (!validateZip($("#zip").val())){
                toastr.error("Incorrect format for zip number provided", "You had forgotten something!");
                $('#zip').css('border-color','red');
            }else if ($("#country").val() == ''){
                toastr.error("Country field is empty", "You had forgotten something!");
                $('#country').css('border-color','red');
            }else{
                $('#step-2').css("display","none");
                $('#step-3').css("display","block");
                $(this).data('step',3);
                $('#back').data('step',3);
                $('#progress_bar').html('<span>Step 3 of 5</span>')
                $('#progress_bar').css('width','60%');
            }
            break;
        case 3:
            if($('#product_name').val() == ''){
                toastr.error("Please Provide more detail on your submission.", "You had forgotten something!");
                $('#product_name').css('border-color','red');
            }else if($('#product_desc').val().length < 120 ){
                toastr.error("Please Provide more detail on your submission.", "You had forgotten something!");
                $('#product_desc').css('border-color','red');
            }else if ($("#when_how").val().length <12){
                toastr.error("Please Provide more detail on your submission.", "You had forgotten something!");
                $('#when_how').css('border-color','red');
            }else if ($("#problem_solve").val().length <10){
                toastr.error("Please Provide more detail on your submission.", "You had forgotten something!");
                $('#problem_solve').css('border-color','red');
            }else if(!$('#statement').is(':checked')){
                toastr.error("Please check 'I Agree' to continue", "You had forgotten something!");
                $('.label-statement').css('color','red').after("&nbsp;&nbsp;<span class='agreewarn'><i class='fa fa-arrow-left'></i>&nbsp;Please check to continue.</span>");
            }else{
                $('#step-3').css("display","none");
                $('#step-4').css("display","block");
                $(this).data('step',4);
                $('#back').data('step',4);
                $('#progress_bar').html('<span>Step 4 of 5</span>')
                $('#progress_bar').css('width','80%');
            }
            break;
        case 4:
            ////////////////////////////////
            ///////////////////////////////
            var firstName = $('#first_name').val();
            var lastName = $('#last_name').val();
            var email =$("#email_address").val();
            var phone =$("#phone_number").val();
            var phone2=$("#2nd_phone").val();
            var passwrd = $("#passw").val();
            var address=$('#street').val();
            var suite = $('#suite').val();
            var city=$('#city').val();
            var state =$('#state').val();
            var zip =$('#zip').val();
            var country = $('#country').val();
            var prodName = $('#product_name').val();
            var prodDesc = $('#product_desc').val();
            var whenHow = $('#when_how').val();
            var similarProd = $('#similar_product').val();
            var problem=$('#problem_solve').val();
            var isApp = $('#isApp').val();
            var progLanguage = $('#selectLanguage').val();
            var statement = $('#statement').is(':checked');
            var allInventors =$('#list_inventors').val();
            var ocupationInv=$('#inv_ocupation').val();
            var thirdParty = $('#third_party').val();
            var attHired = $('#att_hired').val();
            var agencyHired = $('#licensing_hired').val();
            ajaxCallback({'FNAME':firstName,'LNAME':lastName,'EMAIL':email,'PHONE':phone,'PHONE2':phone2, 'PASSWORD':passwrd,'ADDRESS':address,
                'SUITE':suite,'CITY':city,'STATE':state,'ZIP':zip,'COUNTRY':country,'PNAME':prodName,
                'PDESC':prodDesc,'WHENHOW':whenHow,'SIMILAR':similarProd,'PROBLEM':problem,'ISAPP':isApp,'PLANGUAGE':progLanguage,
                'STATEMENT':statement,'ALLINV':allInventors,'OCUPATION':ocupationInv,'THIRDP':thirdParty,'ATTHIRED':attHired,
                'AGENCYHIRED':agencyHired},'submitCampaign',"backFromSumbit");

            break;
        default :

            break;
    }

});

function backFromSumbit(result){
    $('#step-4').css("display","none");
    $('#step-5').css("display","block");
    $(this).data('step',5);
    $('#back').data('step',5);
    $('#back').addClass('hidden');
    $('#next').addClass('hidden');
    $('#progress_bar').html('<span>Step 5 of 5</span>')
    $('#progress_bar').css('width','100%');
    swal({title: "Information Saved. We will contact you soon.",
            type: "info",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    return;
}

$(document).on('click','#back', function () {
    var step = $(this).data('step');
    if(step==2)
        $('#back').addClass('hidden');
    if(step>1){
        $('#step-'+step).css("display","none");
        var step1= step-1;
        $('#step-'+step1).css("display","block");
        $(this).data('step',step1);
        $('#next').data('step',step1);
        $('#progress_bar').html('<span>Step '+step1+' of 6</span>')
        switch (step1){
            case 1:
                $('#progress_bar').css('width','20%');
                break;
            case 2:
                $('#progress_bar').css('width','40%');
                break;
            case 3:
                $('#progress_bar').css('width','65%');
                break;
            case 4:
                $('#progress_bar').css('width','80%');
                break;
            default :
                break;
        }

    }
});