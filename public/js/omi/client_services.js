$(document).ready(function(e){
    //var defaultDate = new Date();
    $('#filing_date').datetimepicker({
        //defaultDate: defaultDate
    });
    $('#date_opt').datetimepicker({
        //defaultDate: defaultDate
    });
    $('#date_opt_1').datetimepicker({
        //defaultDate: defaultDate
    });
    $('#date_opt_2').datetimepicker({
        //defaultDate: defaultDate
    });
    $('#date_opt_3').datetimepicker({
        //defaultDate: defaultDate
    });
    $('#card_exp').datepicker({
        //defaultDate: defaultDate
    });
    $('#smoothed').signaturePad({
        drawOnly:true,
        drawBezierCurves:true,
        lineTop:200
    });
    $('#signt_dec').signaturePad({
        drawOnly:true,
        drawBezierCurves:true,
        lineTop:200
    });
   $('.sign-add-d').signaturePad({
       drawOnly:true,
       drawBezierCurves:true,
       lineTop:200
   });
    $('#signt_mEntity').signaturePad({
        drawOnly:true,
        drawBezierCurves:true,
        lineTop:200
    });
    $('#signt_poa').signaturePad({
        drawOnly:true,
        drawBezierCurves:true,
        lineTop:200
    });
    $('#signt_poa_2').signaturePad({
        drawOnly:true,
        drawBezierCurves:true,
        lineTop:200
    });
    $('#coInv_agreementExt').signaturePad({
        drawOnly:true,
        drawBezierCurves:true,
        lineTop:200
    });
    $('.signPsa').signaturePad({
        drawOnly:true,
        drawBezierCurves:true,
        lineTop:200
    });
});


