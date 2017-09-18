$(document).on('focusin','.cleanBorder',function(e){
    $(this).css('border','1px solid lightgray');
});

// test if passwords match
$("#confirmPassword").blur(function(){
    $("#confirmPassword").css("border","");
    if($("#password").val()!=$('#confirmPassword').val()){
        $("#confirmPassword").css("border","1px solid red");
        swal({title: "Passwords don't match.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
});

// register a new lead
$(document).on('click','#btnSaveProfile',function(e){
    var fname =$('#fname').val();
    var lname =$('#lname').val();
    var phone =$('#phone').val();
    var email =$('#email').val();
    var password =$('#email').val();
    var confirmPassword =$('#email').val();
    var address =$('#address').val();
    var city =$('#city').val();
    var state =$('#state').val();
    var zip =$('#zip').val();
    var country =$('#country').val();
    if(fname.length==0)
    {
        $('#fname').css('border','1px solid red');
        swal({title: "We need your First Name",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
    if(lname.length==0)
    {
        $('#lname').css('border','1px solid red');
        swal({title: "We need your Last Name",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
    if(!validateEmail(email))
    {
        $('#email').css('border','1px solid red');
        swal({title: "Invalid format for the email",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }
    if(!validatePhone(phone))
    {
        $('#phone').css('border','1px solid red');
        swal({title: "Invalid format for the phone number. Use just Numbers.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }

    if($("#password").val().length < 7){
        $("#password").css("border","1px solid red");
        swal({title: "Password need a minimum of 7 characters.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }

    if($("#password").val()!=$('#confirmPassword').val()){
        $("#confirmPassword").css("border","1px solid red");
        swal({title: "Passwords don't match.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return;
    }

    var data = {'FNAME':fname,'LNAME':lname,'PHONE':phone,'EMAIL':email,'ADDRESS':address,'CITY':city,'STATE':state,'ZIP':zip};
    ajaxCallback(data,'continue2',"registerCallback");
});

//callback of register
function registerCallback(id){
    var pass = $("#password").val();
    var category =$('#category').val();
    var patent =$('#patent').val();
    var areL18 =$('#areLeast18').val();
    ajaxCallback({'PASSWORD':pass,'LEAD':id,'CATEGORY':category,'PATENT':patent,'ARE18':areL18},'savePassRegister',"savePassRegisterCallback");
}

//callback of register
function savePassRegisterCallback(value){
    swal({title: "Information Saved. We will contact you soon.",
        type: "info",
        showCancelButton: false,
        confirmButtonText: "Ok",
        closeOnConfirm: true },
    function(isConfirm){
        if (isConfirm) {
            window.location = "registerSuccess";
        }
    });
    return;
}