function validateEmail(email)
{
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function validatePhone(phone)
{
    var isnum = /^\d+$/.test(phone);
    if (!isnum || !(phone.length == 10 || phone.length == 11) || (phone[0]=='0') || (phone[0] == '1' && phone.length != 11) )
        return false;
    return true;
}
function formatAMPM(date)
{
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

//redirect to login if 401 error is sent
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function() {
        if($('#loadingModalAjax').length>0)
        {
            $('#loadingModalAjax').removeClass('fade in');
            $('#loadingModalAjax').addClass('show in');
        }
    },
    complete: function() {
        if($('#loadingModalAjax').length>0)
        {
            $('#loadingModalAjax').removeClass('show in');
            $('#loadingModalAjax').addClass('fade in');
        }
    },error: function(jqXHR, exception) {
        if (jqXHR.status === 401) {
            window.location = 'login';
        } else {

        }
    }
});

function ajaxCall(data,url,successMessage,errorMessage)
{
    $.ajax({type: 'POST',url:url,
        data: data,
        success: function(res)
        {
            if(successMessage.length>0)
            {
                if(res=="1")
                    toastr.success(successMessage,"Success!!");
                else
                    toastr.error(errorMessage,"Error!!");
            }
        }
    });
}
function ajaxCallback(data,url,functionName)
{
    $.ajax({type: 'POST',url:url,
        data: data,
        success: function(res)
        {
            eval(functionName + '(' + res + ')');
        }
    });
}
function syncAjaxCallback(data,url,functionName)
{
    $.ajax({type: 'POST',url:url,
        data: data,
        async: false,
        success: function(res)
        {
            eval(functionName + '(' + res + ')');
        }
    });
}
function reloadWindow(url)
{
    if(typeof url =="undefined")
        window.location.reload();
    else
        window.location=url;
}
function isMobile()
{
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4)))
        return true;
    return false;
}
function today()
{
    var today = new Date();
    var month = today.getMonth()+1;
    var day = today.getDate();
   return (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day+ '-' +today.getFullYear();
}
function initializeMap()
{
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
        center: new google.maps.LatLng(25.88500, -80.1600),
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.SATELLITE
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(25.886769, -80.165),
        map: map
    });
}
function footerMap()
{
    google.maps.event.addDomListener(window, 'load', initializeMap());
}
function validPrice(stringPrice,intPrice)
{
    var cleanPrice =parseInt(stringPrice.replace(",",""));
    return !isNaN(cleanPrice) &&cleanPrice>=intPrice;
}
function dateToString(date)
{
    var dateSplit = date.toString().split(' ');
    return dateSplit[1]+" "+dateSplit[2]+","+dateSplit[3];
}
function cleanIframe(iframeId)
{
    var html='';
    var iframe = document.getElementById(iframeId);
    iframe.contentWindow.document.open();
    iframe.contentWindow.document.write(html);
    iframe.contentWindow.document.close();
}