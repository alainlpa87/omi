<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<br>

<p align="center" style="position: fixed;top: 0;" class="padd_cover">
    <img src="{{asset('img/ilc_logo.jpg')}}" alt="" name="Object1" width="250" height="96"  align="center">
</p>
<br>
<table style="margin-top: 150px;width: 100%;">
    <tr style="width: 100%;"><td class="pSmall" style="width: 50% !important;">{{$ilc->invFname." ".$ilc->invLname}}</td><td align="right" class="pSmall" style="width: 50% !important;">{{$date}}</td></tr>
    <tr><td class="pSmall">{{$ilc->street.", ".$ilc->city.", ".$ilc->state.", ".$ilc->zip}}</td></tr>
</table>
<br>
<p ><b>RE: ILC Account # {{$ilc->fileno}}</b></p>
<p> Dear {{$ilc->invFname." ".$ilc->invLname}},</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As per your written request, your contract with International Licensing Consultants has been
    cancelled, effective {{$date}}. Though the process of marketing new inventions is often a risky and
    uncertain challenge, ILC is and has always been committed to providing the best networking and
    licensing service possible to each of our clients.
</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Therefore, we will offer the courtesy of reaching out to you should we receive feedback from a
    manufacturer that was recently contacted on your behalf, in order to see if you would like to reconsider
    your decision before we decline the interested manufacturer’s submission request.</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It has truly been a privilege working with you and although we regret your decision for a
    premature departure from our services, we genuinely wish you much success, if you choose to market
    {{$ilc->inventionName}}, independently.
</p>
<br>
<p >Most Sincerely,</p>
<br>
<p style="color: limegreen;font-weight:bold;">Asia Wynder</p>
<p >Marketing Director</p>
<p >International Licensing Consultants</p>
<div class="myFooter">
    <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
    <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
    <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
</div>
