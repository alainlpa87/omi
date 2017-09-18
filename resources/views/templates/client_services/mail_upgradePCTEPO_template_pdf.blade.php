<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">


<!--page 1-->
<p align="center" class="padd_cover">
    <img src="{{ asset('/img/logo.png') }}" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
    <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
</p>
<br>
<p align="left">
    {{date("F j, Y")}}<br><br>
    {{ucwords($client->fname." ".$client->lname)}}<br>
    {{$client->street}}<br>
    {{$client->city.", ".$client->state." ".$client->zip}}<br>
    {{"File No. ".$client->fileno}}
</p>
<p class="pSmall">Dear {{ucwords($client->fname." ".$client->lname).","}}</p>
<p class="pSmall">We are pleased to inform you of another “milestone” achievement.  You’ve been committed to the
    pursuing of your invention for almost a year now. Most inventors fail to make it through even
    their 1st month for many different reasons. Through Patent Services, you’ve been successful at
    leveraging the necessary expertise required for progress. For this reason, we feel the need to
    say CONGRATULATIONS on a magnificent accomplishment!
</p>
<p class="pSmall">
    With this in mind, we are communicating to remind you that your Utility Patent Application number {{$pcs->patentAppNo}}
    for the {{$project->ideaName}} is due for an upgrade on {{$pcs->getUpgradeDue()}}.
</p>
<p class="pSmall">
    <img src="{{$plan_4 == "1" ? asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt="" > &nbsp;&nbsp;<b class="pSmall">PLAN 4</b>- EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ 7,949
</p>
<p class="pSmall">
    3.1.4.1. PATENT SERVICES USA, INC. will facilitate and coordinate the documentation and European Union
    Community Design Patent Application process, by working with the INVENTOR and independent registered
    patent attorney regarding the patent application process.
</p>
<p class="pSmall">
    3.1.4.2. PATENT SERVICES USA, INC. shall use best efforts to engage an Independent Licensing Agent
    (hereinafter and as defined above, “ILA”) to schedule six (6) to eight (8) national and/or international
    invention trade shows, every Twelve (12) months; for a period of two (2) years attended by ILA as explained
    in Exhibit B of this Agreement, which is incorporated herein by reference.
</p>
<p class="pSmall">
    3.1.4.3. The INVENTOR’S invention shall be posted on the website(s) of the ILA for a period of two (2) years,
    at the sole discretion of the ILA
</p>
<p class="pSmall">
    3.1.4.4. PATENT SERVICES USA, INC. shall engage a Computer Animation Specialist who will design a threedimensional
    animated prototype for the INVENTOR’S invention. The illustration will be used by the ILA in connection with
    rendering the services of ILA as explained in Exhibit A of this Agreement.
</p>
<p class="pSmall">
    3.1.4.5. Upon initial submission of invention to Patent Services USA, INC., Patent Services USA, INC.’s
    experienced product review team shall review INVENTOR’S invention. Throughout the term of this Agreement,
    PATENT SERVICES USA, INC. shall provide customer service support to INVENTOR in connection with the progress
    of its services as stated herein.
</p>
<p class="pSmall">
    <img src="{{$plan_5 == "1" ? asset('/img/chk_square.png'):asset('/img/unchk_square.png')}}" alt="" > &nbsp;&nbsp;<b class="pSmall">PLAN 5</b>-  PATENT COOPERATION TREATY (HEREINAFTER “PCT”) PROGRAM  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ 8,949
</p>
<p class="pSmall">
    The PCT is an international treaty administered by the World Intellectual Property Organization,  between more than 125 countries (Paris Convention Member States).
</p>
<p class="pSmall">
    3.1.5.1. PATENT SERVICES USA, INC. will facilitate and coordinate the necessary documentation by working with the INVENTOR and registered patent attorney regarding the international patent application filing.
</p>
<p style="font-size: 12px;">
    Disclaimer: PATENT SERVICES is not a law firm and does not provide legal advice or legal opinion.  PATENT SERVICES shall engage an Independent Registered Patent Attorney and/or Patent Agent to assist in certain matters relating to the services described herein.
</p>


<div class="page-break"></div>

<p class="pSmall">
    3.1.5.2. PATENT SERVICES USA, INC. shall use best efforts to engage an Independent Licensing Agent
    (hereinafter and as defined above, “ILA”) to schedule six (6) to eight (8) national and/or international
    invention trade shows, every Twelve (12) months; for a period of two (2) years attended by ILA as explained
    in Exhibit B of this Agreement, which is incorporated herein by reference.
</p>
<p class="pSmall">
    3.1.5.3. The INVENTOR’S invention shall be posted on the website(s) of the ILA for a period of two (2)
    years, at the sole discretion of the ILA.
</p>
<p class="pSmall">
    3.1.5.4. PATENT SERVICES USA, INC. shall engage a Computer Animation Specialist who will design a
    threedimensional animated prototype for the INVENTOR’S invention. The illustration will be used by
    the ILA in connection with rendering the services of ILA as explained in Exhibit A of this Agreement.
</p>
<p class="pSmall">
    3.1.5.5. Upon initial submission of invention to Patent Services USA, INC., Patent Services USA, INC.’s
    experienced product review team shall review INVENTOR’S invention. Throughout the term of this Agreement,
    PATENT SERVICES USA, INC. shall provide customer service support to INVENTOR in connection with the
    progress of its services as stated herein.
</p>
<p class="pSmall">
    Your assigned Independent Registered Patent Attorney can draft and file for a <b class="pSmall">EUROPEAN UNION DESIGN PATENT</b>
    and / or a <b class="psmall">PATENT COOPERATION TREATY APPLICATION</b>.  We ask that you give us no less than six (10) weeks’
    notice prior to the stated expiration date above.  Your consent to continue, or your decision to decline,
    may be indicated by signing and returning this letter to us immediately with the upgrade fee if applicable.
    If you have any questions, call our client services department at 1-877-652-4908, ext. 211 for assistance.
    We hope to continue our mutual efforts with you.
</p>
<table width="100%">
    <tr style="margin-bottom: 0px !important;">
        <td style="margin-bottom: 0px !important;">
            <p align="left" style="margin-bottom: 0px !important;">____________________________</p>
        </td>
        <td style="margin-bottom: 0px !important;">
            <img style="position: absolute;top: -4px !important;" src="{{asset('files/projects/'.$client->fileno.'/signature_upgLetter_inv.jpg')}}"><br><p style="margin-top: 0px !important;z-index: 100;">_____________________</p>
        </td>
    </tr>
    <tr style="margin-top: 0px !important;">
        <td style="margin-top: 0px !important;">
            <p align="left" style="margin-top: 0px !important;">Patent Services, Inc<br>Authorized Representative  </p>
        </td>
        <td style="margin-top: 0px !important;">
            <p style="margin-top: 0px !important;">(Inventor name), Inventor</p>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            @if(File::exists('files/projects/'.$client->fileno.'/signature_upgLetter_coInv.jpg'))
                <img style="position: absolute;top: -4px !important;" src="{{asset('files/projects/'.$client->fileno.'/signature_upgLetter_coInv.jpg')}}"><br><p style="margin-top: 0px !important;z-index: 100;">_____________________</p>
            @else
                ____________________________
            @endif
        </td>
    </tr>
    <tr>
        <td></td>
        <td><p style="margin-top: 0px !important;">(Co-Inventor name), Co-Inventor </p></td>
    </tr>
</table>
<br><br>
<p align="right" class="pSmall"> Sincerely, </p>
<p align="right" class="pSmall NoMargin">Client Support Services </p>
<p align="right" class="pSmall NoMargin">PATENT SERVICES </p>
<p align="right" class="pSmall NoMargin">12000 Biscayne Blvd Suite # 700 </p>
<p align="right" class="pSmall NoMargin">North Miami, FL 33181 </p>
<p align="right" class="pSmall NoMargin">1-888-344-6836 ext. 237 </p>
<p align="right" class="pSmall NoMargin">1-800-886-7951 Fax</p>
<br><br><br><br><br><br>
<p style="font-size:12px;">Disclaimer: PATENT SERVICES is not a law firm and does not provide legal advice or legal opinion.  PATENT SERVICES shall engage an Independent Registered Patent Attorney and/or Patent Agent to assist in certain matters relating to the services described herein. </p>


<div class="page-break"></div>