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
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We regret to inform you that our records indicate your contract with International Licensing
    Consultants has expired as of {{$date}}. It has truly been a privilege working with you on your product,
    {{$ilc->inventionName}}, and we hope you do not choose to merely abandon the idea.
</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Should you desire to secure patent protection, beyond the provisional time restraint, please
    share proper documentation with us so that we may consider extending your contract and ideally
    continue marketing on your behalf with minimal delay. If you choose not, please know that the
    marketing of new inventions is often a risky and uncertain challenge and we commend you for
    assessing that risk and meeting that challenge with consistent excitement from the beginning.</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We would again like to thank you very much for being our client, and we wish you much
    success in the future. Also, if you have any need for our marketing services on a new product idea
    down the line, please do not hesitate to contact us.
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
