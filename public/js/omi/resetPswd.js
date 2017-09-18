/**
 * Created by jllopiz on 10/12/2016.
 */
//
$(document).on('click','#recoverPswd',function(){
    $('#recoverPModal').modal('show');
});

$(document).on('click','#recoverPswdBttn',function(){
    var email = $('#emailToRecoverPswd').val();
    if(email != '' && $('#emailToRecoverPswd')[0].checkValidity()){
        ajaxCall({'EMAIL':email},'resetPasswordFromLogin','The password was reset it and sent it to your email.','The email provide dont match with our system.');
    }else{
        swal({title: "Please insert a valid email address.",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true }
        );
    }
});