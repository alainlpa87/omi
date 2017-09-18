<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
<p align="center" class="padd_cover">
    <img src="{{asset('img/logo.png')}}" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
    <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
</p>
<p align="left" class="pSmall">
    {{date("F j, Y")}}<br><br>
    {{ucwords($client->fname." ".$client->lname)}}<br>
    {{$client->street}}<br>
    {{$client->city.", ".$client->state." ".$client->zip}}<br>
    {{"File No. ".$client->fileno}}
</p>
<p class="pSmall">The following represents your payment status for the Patent Protection Agreement executed with our company.</p>
<table width="100%">
    <tr>
        <td><p class="NoMargin pSmall">Amount received by PS: {{"$ ".number_format($amountBy,2)}}</p></td>
        <td><p align="right" class="NoMargin pSmall" style="margin-right: 35px;">Balance due: {{"$ ".number_format($balanceBy,2)}}</p></td>
    </tr>
    <tr>
        <td><p class="NoMargin pSmall">Date received: {{$dateBy}}</p></td>
        <td><p align="right" class="NoMargin pSmall" style="margin-right: 35px;">Percentage paid: {{$percentageBy."%"}}</p></td>
    </tr>
    <tr>
        <td><p class="NoMargin pSmall">Contract Amount: {{"$ ".number_format($contractBy,2)}}</p></td>
    </tr>
</table>

<table align="center" width="100%" style="" class="tablePayment">
    <tr>
        <td colspan="4" class="tdNone">
                <span class="pSmall">
                    Please note that you are at least 50% paid. Therefore, when you make an additional payment now or in the
                    future, kindly complete the information below and send THIS FORM back to PATENT SERVICES USA.  with
                    your payment.
                </span>
        </td>
    </tr>
    <tr>
        <td colspan="3"><span class="pSmall">Inventor Name:</span></td>
        <td colspan="1"><span class="pSmall">File #:</span></td>
    </tr>
    <tr>
        <td width="40%" class="tdNone pSmall">Credit/debit card: <img src="{{asset('img/unchk_square.png')}}" alt=""> American Express</td>
        <td width="18%" class="tdNone pSmall"><img src="{{asset('img/unchk_square.png')}}" alt=""> MasterCard</td>
        <td width="17%" class="tdNone pSmall"><img src="{{asset('img/unchk_square.png')}}" alt=""> Visa</td>
        <td width="20%" class="tdNone pSmall"><img src="{{asset('img/unchk_square.png')}}" alt=""> Discover Card</td>
    </tr>
    <tr>
        <td colspan="2"><span class="pSmall">Credit Card Number:</span></td>
        <td colspan="2"><span class="pSmall">Expiration Date:</span></td>
    </tr>
    <tr>
        <td colspan="2"><span class="pSmall">Amt. to be charged: $</span></td>
        <td colspan="2"><span class="pSmall">Payment by Check/Money Order $</span></td>
    </tr>
    <tr>
        <td colspan="4"><span class="pSmall">Print name as Appears on Card:</span></td>
    </tr>
    <tr>
        <td colspan="2"><span class="pSmall">Signature:</span> </td>
        <td colspan="2"><span class="pSmall">Date:</span></td>
    </tr>
</table>
<table align="center" width="100%" style="border-bottom: 3px solid;">
    <tr>
        <td>
            <p class="pSmall">
                If you have any questions, call our client services department at 1-877-652-4908, ext. 211 for assistance.  We hope to continue our mutual efforts with you.
            </p>
        </td>
    </tr>
</table>
<br>
<p class="pSmall">
    <img src="{{asset('/img/unchk_square.png') }}" alt=""> I do wish to file a non-provisional application related to and before expiration of the provisional
    application mentioned above and expressly authorize Patent Services to cause such application to be drafted and filed by an Independent Registered Patent
    Attorney.
</p>
<p class="pSmall">
    <img src="{{asset('/img/unchk_square.png') }}" alt="">  Understanding that I will lose the rights established by my current pending provisional application,
    I will not be filing or otherwise pursuing a non-provisional application that corresponds to the provisional application mentioned above.
</p>
<table width="100%">
    <tr style="margin-bottom: 0px !important;">
        <td style="margin-bottom: 0px !important;">
            <p align="left" style="margin-bottom: 0px !important;" class="pSmall">____________________________</p>
        </td>
        <td style="margin-bottom: 0px !important;">
            <p align="right" style="margin-bottom: 0px !important;" class="pSmall"> ____________________________</p>
        </td>
    </tr>
    <tr style="margin-top: 0px !important;">
        <td style="margin-top: 0px !important;">
            <p align="left" style="margin-top: 0px !important;" class="pSmall">Patent Services, Inc<br>Authorized Representative  </p>
        </td>
        <td style="margin-top: 0px !important;">
            <p align="right" style="margin-top: 0px !important;" class="pSmall" >(Inventor name), Inventor</p>
        </td>
    </tr>
</table>
<p align="right" style="margin-bottom: 0px !important;" class="pSmall" >____________________________</p>
<p align="right" style="margin-top: 0px !important;" class="pSmall" >(Co-Inventor name), Co-Inventor </p>
<br>
<p class="verySmall" >Disclaimer: PATENT SERVICES is not a law firm and does not provide legal advice or legal opinion.  PATENT SERVICES shall engage an Independent Registered Patent Attorney and/or Patent Agent to assist in certain matters relating to the services described herein.  </p>