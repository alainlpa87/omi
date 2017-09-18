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
<p> Dear {{$ilc->fname." ".$ilc->lname}},</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We regret to inform you that our records indicate your contract with International Licensing
    Consultants has expired as of {{$date}}. It has truly been a privilege working with you on your product,
    {{$ilc->inventionName}}, and we hope you do not choose to merely abandon the idea. The marketing of
    new inventions is often a risky and uncertain challenge, and we must commend you for assessing that
    risk and meeting that challenge with consistent excitement.
</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As a courtesy to you, we will maintain your marketing webpage, just in-case we receive
    feedback from a manufacturer that was recently contacted on your behalf. Should a manufacturer
    desire a submission, we will proceed as formerly explained and agreed upon under the original
    contractual terms. <span style="text-decoration: underline;">Please note that this extension is only for six (6) months and is based solely on
    documented interest in your idea, by a manufacturer.</span></p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We would again like to thank you very much for being our client, and we wish you much
    success in the future. Should you have any need for our marketing services on a new product idea
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
