/**
 * Created by jllopiz on 3/15/2017.
 */
$(document).ready(function(e) {
    $('#test').scrollToFixed();

    $('.res-nav_click').click(function(){
        $('.main-nav').slideToggle();
        return false

    });


    //color-box
    var scrn_wdt	=	$( window ).width();
    if(scrn_wdt>1000){
        var wd= '729px'; var mxh= '635px';var ht	= '450px';
    }else if(scrn_wdt<300){
        var wd	= '229px';	var ht= '130px'; 	var mxh	= '130px';
    }else if(scrn_wdt<550){
        var wd	= '80%';	var ht= '245px';	var mxh	= '105px';
    }else{
        var wd	= '80%';	var ht	= '';		var mxh	= '70%';}
    $(".youtube").colorbox({iframe:true, innerWidth:wd, innerHeight:ht});

});

wow = new WOW(
    {
        animateClass: 'animated',
        offset:       100
    }
);
wow.init();

$(window).load(function(){

    $('.main-nav li a.menu, .servicelink').bind('click',function(event){
        var $anchor = $(this);

        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 102
        }, 1500,'easeInOutExpo');
        /*
         if you don't want to use the easing effects:
         $('html, body').stop().animate({
         scrollTop: $($anchor.attr('href')).offset().top
         }, 1000);
         */
        event.preventDefault();
    });
});

$(window).load(function(){


    var $container = $('.portfolioContainer'),
        $body = $('body'),
        colW = 375,
        columns = null;


    $container.isotope({
        // disable window resizing
        resizable: true,
        masonry: {
            columnWidth: colW
        }
    });

    $(window).smartresize(function(){
        // check if columns has changed
        var currentColumns = Math.floor( ( $body.width() -30 ) / colW );
        if ( currentColumns !== columns ) {
            // set new column count
            columns = currentColumns;
            // apply width to container manually, then trigger relayout
            $container.width( columns * colW )
                .isotope('reLayout');
        }

    }).smartresize(); // trigger resize to set container width
    $('.portfolioFilter a').click(function(){
        $('.portfolioFilter .current').removeClass('current');
        $(this).addClass('current');

        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector
        });
        return false;
    });

});

function Next()
{
    $('#firstBlock').css('display','none');
    $('.btnNextIndex').css('display','none');
    $('#secondBlock').css('display','block');
    $('.btnBackIndex').css('display','inline');
    $('.btnSubmitIndex').css('display','inline');
}
function Back()
{
    $('#secondBlock').css('display','none');
    $('#firstBlock').css('display','block');
    $('.btnNextIndex').css('display','inline');
    $('.btnBackIndex').css('display','none');
    $('.btnSubmitIndex').css('display','none');
}
function submitLayoutHeader()
{
    if($('#patent_register').val() == '-1'){
        $("#patent_register").css("border","1px solid red");
        toastr.error("You need to select one answer to the questions.","You had forgotten something!");
    }else if($('#new_lead_18').val() == '-1'){
        $("#new_lead_18").css("border","1px solid red");
        toastr.error("You need to select one answer to the questions.","You had forgotten something!");
    }else{
        $('#categoryH').val($('#txt_answer_1').val());
        $('#areLeast18H').val($('#new_lead_18').val());
        $('#patentH').val($('#patent_register').val());
        $('#formLaravel').submit();
    }
}

$(document).on('click','#sendInfo', function () {
    var fname = $('#fnameSubHeader').val();
    var lname = $('#lnameSubHeader').val();
    var email = $('#emailSubHeader').val();
    var phone = $('#dphonenoSubHeader').val();

    if( fname.trim() == ''){
        $("#fnameSubHeader").css("border","1px solid red");
        toastr.error("The first name can't be empty.","You had forgotten something!");
    }else if(lname.trim() == ''){
        $("#lnameSubHeader").css("border","1px solid red");
        toastr.error("The last name can't be empty.","You had forgotten something!");
    }else if(email.trim() == ''){
        $("#emailSubHeader").css("border","1px solid red");
        toastr.error("The email can't be empty.","You had forgotten something!");
    }else if (!validateEmail(email)){
        $("#emailSubHeader").css("border","1px solid red");
        toastr.error("Incorrect format for email provided", "You had forgotten something!");
    }else if (phone.trim() == ''){
        toastr.error("We want to talk with you, please provide us your phone number!", "You had forgotten something!");
    }else if (!validatePhone(phone)){
        toastr.error("Incorrect format for phone number provided", "You had forgotten something!");
    }else{
        $('#fnameLaravel').val(fname);
        $('#lnameLaravel').val(lname);
        $('#emailLaravel').val(email);
        $('#dphoneLaravel').val(phone);
        $('#submitRequestModal').modal('show');
    }
});

function validateEmail(email){
    if(email != ''){
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }else{
        return false;
    }
}

//validate phone
function validatePhone(phone){
    phone = phone.replace(/[^\d]/g, '');
    var isnum = /^\d+$/.test(phone);
    if (!isnum || !(phone.length == 10 || phone.length == 11) || (phone[0]=='0') || (phone[0] == '1' && phone.length != 11) )
        return false;
    return true;
}