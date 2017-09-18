$(document).ready(function(e){
    $(".ccinfo").show();
    $(":radio[name=cctype]").click(function()
    {
        if($(this).hasClass("isPayPal"))
        {
            $(".ccinfo").slideUp("fast");
            $('.checkinfo').slideUp("fast");
        }
        else if($(this).hasClass("isCheck"))
        {
            $('.checkinfo').slideDown("fast");
            $(".ccinfo").slideUp("fast");
        }
        else
        {
            $(".ccinfo").slideDown("fast");
            $(".checkinfo").slideUp("fast");
        }
        resetCCHightlight();
    });
    $('#project_price').autoNumeric('init');
    $("input[name=ccn]").bind('paste', function(e) {
        var el = $(this);
        setTimeout(function() {
            var text = $(el).val();
            resetCCHightlight();
            checkNumHighlight(text);
        }, 100);
    });
    if($('#errorText').length>0)
    {
        swal({title:$('#errorText').val(),
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
    }
});
//Functions js from Authorize.Net
var selectedCard = "";
function isValidCardNumber (strNum)
{
    var nCheck = 0;
    var nDigit = 0;
    var bEven  = false;
    for (n = strNum.length - 1; n >= 0; n--)
    {
        var cDigit = strNum.charAt(n);
        if(isDigit (cDigit))
        {
            nDigit = parseInt(cDigit, 10);
            if (bEven)
            {
                if ((nDigit *= 2) > 9)
                    nDigit -= 9;
            }
            nCheck += nDigit;
            bEven = ! bEven;
        }
        else if (cDigit != ' ' && cDigit != '.' && cDigit != '-')
        {
            return false;
        }
    }
    return (nCheck % 10) == 0;
}
function isExpiryDate(year, month)
{
    var today = new Date();
    var expiry = new Date(year, month);
    if (today.getTime() > expiry.getTime())	return false;
    else return true;
}
function isNum(argvalue)
{
    argvalue = argvalue.toString();

    if (argvalue.length == 0)
        return false;
    for (var n = 0; n < argvalue.length; n++)
        if (argvalue.substring(n, n+1) < "0" || argvalue.substring(n, n+1) > "9")
            return false;
    return true;
}
function isDigit (c)
{
    var strAllowed = "1234567890";
    return (strAllowed.indexOf (c) != -1);
}
function isCardTypeCorrect(strNum, type)
{
    var nLen = 0;
    for (var n = 0; n < strNum.length; n++)
    {
        if (isDigit (strNum.substring (n,n+1)))
            ++nLen;
    }
    if (type == 'V')
        return ((strNum.substring(0,1) == '4') && (nLen == 13 || nLen == 16));
    else if (type == 'A')
        return ((strNum.substring(0,2) == '34' || strNum.substring(0,2) == '37') && (nLen == 15));
    else if (type == 'M')
        return ((strNum.substring(0,2) == '51' || strNum.substring(0,2) == '52'
        || strNum.substring(0,2) == '53' || strNum.substring(0,2) == '54'
        || strNum.substring(0,2) == '55') && (nLen == 16));
    else if (type == 'D')
        return ((strNum.substring(0,4) == '6011' || strNum.substring(0,3) == '622'
        || strNum.substring(0,2) == '64' || strNum.substring(0,2) == '65') && (nLen == 16));
    else if(type == 'DI')
        return ((strNum.substring(0,3) == '300' || strNum.substring(0,3) == '301' || strNum.substring(0,3) == '302' || strNum.substring(0,3) == '303' || strNum.substring(0,3) == '304'
        || strNum.substring(0,3) == '305' || strNum.substring(0,2) == '36'  || strNum.substring(0,2) == '38') && (nLen == 14));
    else
        return false;
}
function highlightCard(strNum){

    if((strNum.substring(0,1) == '4') ){
        return "V";
    } else if((strNum.substring(0,2) == '34' || strNum.substring(0,2) == '37')){
        return "A";
    } else if((strNum.substring(0,2) == '51' || strNum.substring(0,2) == '52'
        || strNum.substring(0,2) == '53' || strNum.substring(0,2) == '54'
        || strNum.substring(0,2) == '55')){
        return "M";
    } else if((strNum.substring(0,4) == '6011' || strNum.substring(0,3) == '622'
        || strNum.substring(0,2) == '64' || strNum.substring(0,2) == '65')){
        return "D";
    } else if((strNum.substring(0,3) == '300' || strNum.substring(0,3) == '301' || strNum.substring(0,3) == '302' || strNum.substring(0,3) == '303' || strNum.substring(0,3) == '304'
        || strNum.substring(0,3) == '305' || strNum.substring(0,2) == '36'  || strNum.substring(0,2) == '38')){
        return "DI";
    } else {
        return false;
    }
}
function checkNumHighlight(strNum)
{
    previewCCResult(strNum);
    if(selectedCard=="")
    {
        var cctype = highlightCard(strNum);
        if(cctype==false){}else {
            //$("img.cardhide:not([class*="+cctype+"]").fadeTo("fast",0.1);
            selectedCard = cctype;
            $(":radio[value="+cctype+"]").attr("checked","checked");
            $(":radio[value="+cctype+"]").prop('checked', true);
            $("img.cardhide:not([class*="+cctype+"])").each( function() {
                $(this).fadeTo("fast",0.1);
            });
        }
    }
    else if(strNum=="")
    {
        $("img.cardhide").fadeTo("fast",1);
        selectedCard = "";
        $(":radio[name=cctype]").attr("checked","");
    }
}
function checkNumHighlightCheck(strNum)
{
    previewCCResultCheck(strNum);
    if(selectedCard==""){
        var cctype = highlightCard(strNum);
        if(cctype==false){}else {
            //$("img.cardhide:not([class*="+cctype+"]").fadeTo("fast",0.1);
            selectedCard = cctype;
            $(":radio[value="+cctype+"]").attr("checked","checked");
            $("img.cardhide:not([class*="+cctype+"])").each( function() {
                $(this).fadeTo("fast",0.1);
            });
        }
    }
    else if(strNum=="")
    {
        $("img.cardhide").fadeTo("fast",1);
        selectedCard = "";
        $(":radio[name=cctype]").attr("checked","");
    }
}
function resetCCHightlight()
{
    selectedCard = "";
    $("img.cardhide").fadeTo("fast",1);
}
function previewCCResult(strNum)
{
    if(isValidCardNumber(strNum) && strNum.length>13){
        $(".ccresult").html("");
    } else {
        $(".ccresult").html("<span class='error'>Invalid Number</span>");
    }
}
function previewCCResultCheck(strNum)
{
    if(strNum.length<=18){
        $(".ccresult").html("");
    } else {
        $(".ccresult").html("<span class='error'>Invalid Number</span>");
    }
}

function checkForm()
{
    var err=0;
    var cctype='';
    var typesArray = $('.cctype');
    $.each($( "input[name='cctype']" ),function(ctype){
        if($(this).is(':checked'))
        cctype = $(this).val();
    });
    var reqFields = ["fname","lname","address","city","state","zip","email"];
    var reqFields_cc=["ccn", "ccname","exp1","exp2","cvv"];
    var reqFields_cb=["rnumber","anumber","bkname","accttype"];
    $.each(reqFields,function(pos,value){
        if (document.getElementById(value).value==0) {
            if (err==0)
            {
                document.getElementById(value).focus();
            }
            $('#'+value).css('background-color','lightblue');
            err=1;
        }
    });
    if(err==1)
    {
        swal({title: "You need to type your billing information. Please check your full name, address, city, state, zip and email.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return false;
    }
    if(cctype=="")
    {
        swal({title: "You need to select your method of payment. Please select VISA, MASTERCARD, AmEx, DISCOVER, Echeck or Paypal.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return false;
    }
    if(cctype!="PP" && cctype!="E")
    {
        $.each(reqFields_cc,function(pos,value){
            if (document.getElementById(value).value==0)
            {
                if (err==0)
                {
                    document.getElementById(value).focus();
                }
                $('#'+value).css('background-color','lightblue');
                err=1;
            }
        });
        if(err==0)
        {
            //check credit card.
            var ccn = document.getElementById("ccn").value;
            if(!isValidCardNumber(ccn))
            {
                swal({title: "Invalid credit card number. Please check your input and try again",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonText: "Ok",
                    closeOnConfirm: true });
                err=1;
            }
            if(isExpiryDate(document.getElementById("exp2").value,document.getElementById("exp1").value)==false)
            {
                swal({title: "Credit Card expiry date is in the past! Please adjust your input.",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonText: "Ok",
                    closeOnConfirm: true });
                err=1;
            }
            if(!isCardTypeCorrect(ccn,cctype))
            {
                swal({title: "Your credit card number doesn't match with the type selected. Please check credit card type.",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonText: "Ok",
                    closeOnConfirm: true });
                err=1;
            }
        }
        else
        {

            var nameE="";
            if(document.getElementById('ccname').value==0)
                nameE = "Name on the card";
            if(document.getElementById('ccn').value==0)
                nameE = "Credit card number";
            if(document.getElementById('exp1').value==0)
                nameE = "Expiration month";
            if(document.getElementById('exp2').value==0)
                nameE = "Expiration year";
            if(document.getElementById('cvv').value==0){
                if($('#cvv').val().length==0){
                    swal({title: "Please Check again. Your CVV code can't be empty.",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonText: "Ok",
                        closeOnConfirm: true });
                    return false;
                }else{
                    nameE = "A CVV code of "+$('#cvv').val()+" cannot be accepted by the card processor. Please use a different card or contact your consultant directly.";
                    swal({title: nameE,
                        type: "error",
                        showCancelButton: false,
                        confirmButtonText: "Ok",
                        closeOnConfirm: true });
                    return false;
                }
            }
            swal({title: "Please check your "+nameE+" and try again",
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
                closeOnConfirm: true });
            return false;
        }
    }
    if(err==1)
        return false;
    if(cctype=="E")
    {
        $.each(reqFields_cb,function(pos,value)
        {
            if (document.getElementById(value).value==0)
            {
                if (err==0)
                {
                    document.getElementById(value).focus();
                }
                $('#'+value).css('background-color','lightblue');
                err=1;
            }
        });
    }
    var reg1 = /(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/; // not valid
    var reg2 = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,5}|[0-9]{1,3})(\]?)$/; // valid
    if (document.getElementById('email').value==0 || !reg2.test(document.getElementById('email').value))
    {
        if (err==0)
        {
            document.getElementById('email').focus();
        }
        $('#email').css('background-color','lightblue');
        err=1;
    }
    if($('#project_price').val()<=0)
    {
        $('#project_price').css('background-color','lightblue');
        swal({title: "The amount has to be bigger than zero.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return false;
    }
    if (err==0)
    {
        return true;
    }
    else
    {
        swal({title: "Please complete all highlited fields to continue.",
            type: "error",
            showCancelButton: false,
            confirmButtonText: "Ok",
            closeOnConfirm: true });
        return false;
    }
}

function checkFieldBack(fieldObj)
{
    if(fieldObj.id=="cvv")
    {
        if(fieldObj.value.length>2)
            fieldObj.style.backgroundColor='#F8F8F8';
    }
    else
    {
        if (fieldObj.value!=0) {
            fieldObj.style.backgroundColor='#F8F8F8';
        }
    }
}
function noAlpha(obj)
{
    reg = /[^0-9.,]/g;
    obj.value =  obj.value.replace(reg,"");
}