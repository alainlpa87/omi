<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
<p align="center" class="padd_cover">
    <img src="{{asset('img/ilc_logo.jpg')}}" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
</p>
<br><br>
<p style="text-align: center;"><b><u>Required Documents for Clients' Files from Patent Services:</u></b></p>
<br><br>
<p class="pSmall">Name of Inventor(s): <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ucwords($client->fname." ".$client->lname)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> </p>
<p class="pSmall">Name of Product: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ucwords($project->ideaName)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
<p class="pSmall">Industry: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ucwords($pcs->industry)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Patent pending #:<u>&nbsp;&nbsp;&nbsp;&nbsp;{{$project->clientServicesProject()->patentAppNo}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
<br><br>
<ol class="olSmaller">
    <li>
        Client Information ..........................................................................................................................  &nbsp;<img src="{{asset('/img/chk_square.png') }}" alt="">
    </li>
    <li>
        Product Description ........................................................................................................................ &nbsp;<img src="{{asset('/img/chk_square.png') }}" alt="">
    </li>
    <li>
        Patent Office Graphic Illustration .................................................................................................. &nbsp;<img src="{{asset('/img/chk_square.png') }}" alt="">
    </li>
    <li>
        Patent Application & Patent Pending Status .................................................................................. &nbsp;<img src="{{asset('/img/chk_square.png') }}" alt="">
        <br>
        <strong>a.&nbsp; IMG </strong><img src="{{ $img == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>b.&nbsp; Provisional </strong><img src="{{ $prov == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>c.&nbsp; Utility </strong><img src="{{ $ut == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>d.&nbsp; US Design </strong><img src="{{ $design == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>e.&nbsp; PCT </strong><img src="{{ $pct == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br>
        <strong>f.&nbsp; EPO </strong><img src="{{ $epo == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>g.&nbsp; Trademark </strong><img src="{{ $tm == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>h.&nbsp; CopyRight </strong><img src="{{ $cr == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>i.&nbsp; Upgrade </strong><img src="{{ $upg == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </li>
    <li>
        Market Evaluation ........................................................................................................................... &nbsp;<img src="{{asset('/img/chk_square.png') }}" alt="">
    </li>
</ol>

<table width="100%">
    <tr style="margin-bottom: 0px !important;">
        <td style="margin-bottom: 0px !important;">
            <p align="left" style="margin-bottom: 0px !important;" class="pSmall"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
        </td>
        <td style="margin-bottom: 0px !important;margin-right: 0px !important;">
            <p align="center" style="margin-bottom: 0px !important;" class="pSmall"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
        </td>
    </tr>
    <tr style="margin-top: 0px !important;">
        <td style="margin-top: 0px !important;">
            <p align="left" style="margin-top: 0px !important;" class="pSmall">ILC Representative</p>
        </td>
        <td style="margin-top: 0px !important;">
            <p  style="margin-top: 0px !important;" align="center" class="pSmall" >Patent Services Representative</p>
        </td>
    </tr>
    <tr>
        <td>
            <p align="left" style="margin-bottom: 0px !important;" class="pSmall">_________________________</p>
        </td>
        <td>
           <img style="position: absolute;top: -10px !important;margin-left: 100px;" src="{{asset('/img/leslieSignature.png')}}"><br><p align="center" style="margin-top: 0px !important;z-index: 100;">__________________________</p>
        </td>
    </tr>
    <tr>
        <td><p style="margin-top:  0px !important;margin-left: 80px;" class="pSmall" >Signature<p></td>
        <td><p style="margin-top: 0px !important;" align="center" class="pSmall" >Signature </p></td>
    </tr>
    <tr>
        <td><p style="margin-top: 0px !important;"  class="pSmall" ><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><p></td>
        <td><p style="margin-top: 0px !important;"  align="center" class="pSmall" ><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pcs->marketingAgrSent_created_at}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p></td>
    </tr>
    <tr>
        <td><p style="margin-top: 0px !important;margin-left: 80px;"  class="pSmall" >Date<p></td>
        <td><p style="margin-top: 0px !important;"  align="center"class="pSmall" >Date </p></td>
    </tr>
</table>