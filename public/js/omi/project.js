$(document).ready(function(e){
    events();
});

//Return the id of the current lead.
function events()
{
    //check agree terms.
    $('#chk').click(function(e){
        if($('#chk').is(':checked')){
            $('.labelAgree').css('color','white');
            $('.agreewarn').remove();
        }
    });

    //Show the confidencial review (Learn More).
    $(".moretrol, .moreblock").mouseup(function(){
        var $hit = 	$(".more" + $(this).attr("data-form"));
        $hit.toggle();
    });

    //format phone number
    $('.phones').keyup(function(e){
        var phone = this.value;
        if(phone.length < 14){
            phone = phone.replace(/[^0-9]+/g, '');
            phone = phone.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            this.value = phone;
        }else{
            this.value = phone.substring(0, 14);
        }
    });

    //validate email
    $("#email").blur(function() {
        $("#email").css("border","");
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if( !validateEmail($(this).val())) {
            $("#email").css("border","1px solid red");
            toastr.error("Email address not valid.", "Check the Email field.");
        }
    });

    //validate time to call.
    $("#dbtcall").blur(function() {
        if($(this).val() != ""){
            //var regex = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/;
            if($(this).val().length > 11 ) {//!validateBestTimeToCall($(this).val())
                toastr.error("Best Time to Call not valid, maximum of 11 characters.", "Check the Best Time to Call field.");
            }
        }
    });

    //red border in password count
    $("#password").keyup(function(){
        if($("#password").val().length > 0 && $("#password").val().length < 7){
            $("#cantCaract").css("border","1px solid red");
        }else{
            $("#cantCaract").css("border","")
        }
    });

    $("#password2").blur(function(){
        $("#password2").css("border","");
        if($("#password").val()!=$('#password2').val() && !$('#chkPass').is(':checked')){
            $("#password2").css("border","1px solid red");
            toastr.error("Passwords don't match", "You had forgotten something!");
        }
    });

    //change one box password or two.
    $('#chkPass').click(function(e){
        if($('#chkPass').is(':checked'))
        {
            $("#divPassword").css("display","none");
            $("#labelConfirmPass").html('Enter Password<sup class="req">*</sup>');
            $("#labelChkPass").css("margin-top","30px");
            $("#resetPass").css("display","block");
        }else{
            $("#divPassword").css("display","block");
            $("#labelConfirmPass").html('Confirm Password<sup class="req">*</sup>');
            $("#labelChkPass").css("margin-top","");
            $("#resetPass").css("display","none");
        }
    });

    //click first continue.
    $("#continue1").click(function(){
        continue1();
    });

    // click first back
    $("#back2").click(function(){
        $("#form2").hide();
        $("#form1").show();
        $(".head2").hide();
        $(".head1").show();
    });

    //click second continue.
    $("#continue2").click(function(){
        continue2();
    });

    // click second back
    $("#back3").click(function(){
        if($("#back3").attr('goBack') == '1'){
            $("#form3").hide();
            $("#form1").show();
            $(".head3").hide();
            $(".head1").show();
        }else{
            $("#form3").hide();
            $("#form2").show();
            $(".head3").hide();
            $(".head2").show();
        }
    });

    //validate ideaConcept.
    $("#ideaconcept").keyup(function(){
        $('#labelCount').html($("#ideaconcept").val().length);
        if(($("#ideaconcept").val().length + $("#ideaname").val().length) > 119){
            $("#ideaconcept").css("border-color","");
            $(".addwarn").html("&nbsp");
        }
    });

    $("#ideaconcept").blur(function(){
        if(($("#ideaconcept").val().length + $("#ideaname").val().length) < 119){
            $("#ideaconcept").css("border-color","border-color","red");
            $(".addwarn").html("&nbsp");
            toastr.error("Minimum characters not reached yet.", "You had forgotten something!");
        }
    });

    //validate hisidea.
    $("#hisidea").keyup(function(){
       $('#labelCount1').html($("#hisidea").val().length);
        if($("#hisidea").val().length > 11){
            $("#hisidea").css("border-color","");
            $(".addwarn1").html("&nbsp");
        }
    });

    $("#hisidea").blur(function(){
        if($("#hisidea").val().length < 11){
            $("#hisidea").css("border-color","red");
            $(".addwarn1").html("&nbsp");
            toastr.error("Minimum characters not reached yet.", "You had forgotten something!");
        }
    });

    //validate probidea.
    $("#probidea").keyup(function(){
        $('#labelCount2').html($("#probidea").val().length);
        if($("#probidea").val().length > 9){
            $("#probidea").css("border-color","");
            $(".addwarn2").html("&nbsp");
        }
    });

    $("#probidea").blur(function(){
        if($("#probidea").val().length < 9){
            $("#probidea").css("border-color","red");
            $(".addwarn2").html("&nbsp");
            toastr.error("Minimum characters not reached yet.", "You had forgotten something!");
        }
    });

    //click 3th continue.
    $("#continue3").click(function(){
        continue3();
    });

    //click submit (last step).
    $("#submit").click(function(){
        submit();
    });
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

//function called when client click continue1
function continue1(){
    if(!$('#chk').is(':checked')){
        $('.agreewarn').remove();
        $('.labelAgree').css('color','red').after("&nbsp;&nbsp;<span class='agreewarn'><i class='fa fa-arrow-left'></i>&nbsp;Please check 'I Agree' to continue.</span>");
        toastr.error("Please check 'I Agree' to continue", "You had forgotten something!");
    }else if ($("#fname").val() == ''){
        toastr.error("First Name field is empty", "You had forgotten something!");
    }else if ($("#lname").val() == ''){
        toastr.error("Last Name field is empty", "You had forgotten something!");
    }else if ($("#dphoneno").val() == ''){
        toastr.error("We want to talk with you, please provide us your phone number!", "You had forgotten something!");
    }else if (!validatePhone($("#dphoneno").val())){
        toastr.error("Incorrect format for phone number provided", "You had forgotten something!");
    }else if ($("#email").val() == ''){
        $("#email").css("border","1px solid red");
        toastr.error("Email field is empty", "You had forgotten something!");
    }else if (!validateEmail($("#email").val())){
        $("#email").css("border","1px solid red");
        toastr.error("Incorrect format for email provided", "You had forgotten something!");
    }else if($("#password").val()=='' && !$('#chkPass').is(':checked')){
        toastr.error("Password field is empty", "You had forgotten something!");
    }else if($("#password").val().length < 7 && !$('#chkPass').is(':checked')){
        toastr.error("Password field require 7 characters minimum.", "You had forgotten something!");
    }else if($("#password2").val().length < 7 && $('#chkPass').is(':checked')){
        $("#password2").css("border","1px solid red");
        toastr.error("Password field require 7 characters minimum.", "You had forgotten something!");
    }else if($("#password").val()!=$('#password2').val() && !$('#chkPass').is(':checked')){
        $("#password2").css("border","1px solid red");
        toastr.error("Passwords don't match", "You had forgotten something!");
    }else{
        var data = {
            EMAIL: $("#email").val(),
            PHONE: $("#dphoneno").val(),
            PHONE2: $("#ephoneno").val(),
            FNAME: $("#fname").val(),
            LNAME: $("#lname").val(),
            BESTCALL: $("#dbtcall").val(),
            PASSWORD: $('#password2').val()
        };
        syncAjaxCallback(data,'continue1','callbackContinue1');
    }
}

//function called when client click continue2
function continue2(){
    if ($("#address").val() == ''){
        toastr.error("Address field is empty", "You had forgotten something!");
    }else if ($("#city").val() == ''){
        toastr.error("City field is empty", "You had forgotten something!");
    }else if ($("#state").val() == ''){
        toastr.error("State field is empty", "You had forgotten something!");
    }else if ($("#zip").val() == ''){
        toastr.error("Zip field is empty", "You had forgotten something!");
    }else if ($("#country").val() == ''){
        toastr.error("Country field is empty", "You had forgotten something!");
    }else{
        var data = {
            EMAIL: $("#email").val(),
            PHONE: $("#dphoneno").val(),
            FNAME: $("#fname").val(),
            LNAME: $("#lname").val(),
            ADDRESS: $("#address").val(),
            CITY: $("#city").val(),
            STATE: $("#state").val(),
            ZIP: $("#zip").val(),
            PASSWORD: $('#password2').val()
        };
        syncAjaxCallback(data,'continue2','callbackContinue2');
    }
}

//function called in the callback answer for continue1
function callbackContinue1(param){
    if(param == "-1"){
        $("#form1").hide();
        $("#form2").show();
        $(".head1").hide();
        $(".head2").show();
    }else{
        $("#continue3").attr('leadId', param);
        $("#back3").attr('goBack', '1');
        $("#form1").hide();
        $("#form3").show();
        $(".head1").hide();
        $(".head3").show();
    }
}

//function called in the callback answer for continue2
function callbackContinue2(param){
        $("#continue3").attr('leadId', param);
        $("#back3").attr('goBack', '2');
        $("#form2").hide();
        $("#form3").show();
        $(".head2").hide();
        $(".head3").show();
}

//function called when client click continue2
function continue3(){
    if($("#ideaconcept").val().length + $("#ideaname").val().length<120){
        $(".addwarn").html("Please Provide more detail on your submission.").css("color","red");
        $("#ideaconcept").css("border-color","red");
    }
    else if($("#hisidea").val().length <12){
        $(".addwarn1").html("Please Provide more detail on your submission.").css("color","red");
        $("#hisidea").css("border-color","red");
    }
    else if($("#probidea").val().length <10){
        $(".addwarn2").html("Please Provide more detail on your submission.").css("color","red");
        $("#probidea").css("border-color","red");
    }else if($("#selectIsApp").val() != 0 && $("#selectLanguage").val() == 0){
        $(".addwarn3").html("Please Provide more detail on your submission.").css("color","red");
        $("#selectLanguage").css("border-color","red");
    }
    else{
        if($("#selectIsApp").val() == 0)
            var language = "NA";
        else
            var language = $("#selectLanguage").val();
        var data = {
            LEAD: $("#continue3").attr('leadId'),
            IDEANAME: $("#ideaname").val(),
            IDEACONCEPT: $("#ideaconcept").val(),
            HISIDEA: $("#hisidea").val(),
            SIMILARPRODUCT: $("#similar_products").val(),
            PROBIDEA: $("#probidea").val(),
            APP: $("#selectIsApp").val(),
            LANGUAGE: language
        };
        syncAjaxCallback(data,'continue3','callbackContinue3');
    }
}

//function called in the callback answer for continue2
function callbackContinue3(param){
    $("#submit").attr('projectId', param);
    $("#form3").hide();
    $("#form4").show();
    $(".head3").hide();
    $(".head4").show();
}

//function called when client click continue2
function submit(){
    var data = {
        PROJECT: $("#submit").attr('projectId'),
        OCCUPATION: $("#occupation").val(),
        TPACONTACT: $("#tpacontact").val(),
        PATSEARCH: $("#patsearch").val(),
        PATENTED: $("#patented").val(),
        PINVENTORS: $("#pinventors").val()
    };
    syncAjaxCallback(data,'submit','callbackSubmit');
}

//function called in the callback answer for continue2
function callbackSubmit(param){

    // Google Code for Remarketing Tag
    var google_conversion_id = 930107513;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    // END of Google Code for Remarketing Tag

    swal({title: "Information Saved. We will contact you soon.",
            type: "info",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true },
        function(isConfirm){
            if (isConfirm) {
                window.location = "launch/login";
            }
        });
    return;
}

$(document).on('change','#selectIsApp', function(){
    var value = $(this).val();
    if(value == 1)
        $('#select-language-container').removeClass('hidden');
    else
        $('#select-language-container').addClass('hidden');
});