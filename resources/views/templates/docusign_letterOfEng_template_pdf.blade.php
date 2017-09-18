<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<p style="text-align: center;font-size: 18px;"><b>Patent Search with Patentability Opinion<br> Letter of Engagement</b> </p>
<!--  style="text-align: left;font-size: 16px;"--> <p style="text-align: left;font-size: 16px;"><b>Patent Search</b> which is a <b>search</b> of issued <b>patents</b> and published <b>patent</b> applications for
    inventions that might be considered important "prior art" references when applying for a <b>patent</b>.
    Prior art is anything that may determine whether an invention is novel or not.</p>
<p class="pSmall"><b>Patentability Opinion</b> which often goes together with a patent search, because a significant
    part of patentability is based on prior patents. A patentability opinion, therefore, searches prior art
    to find patents and inventions that are similar or that may present legal complexities. The
    patentability opinion also takes a broader look at the invention to determine if it meets the
    USPTO’s requirements for a patent, which includes being useful and nonobvious. This opinion,
    therefore, offers the inventor the most high-level overview of his or her invention.</p>
<p class="pSmall">The cost of a patent search with patentability opinion depends upon the technology involved
    and who is doing the search. If the invention is very complex or if it involves an area that is
    relatively obscure, the cost of a patent search will tend to be higher. <b>According to the
        American Intellectual Property Law Association (AIPLA), hiring a patent attorney to
        perform a search with patentability opinion can cost an average of $2,000.</b></p>
<p class="pSmall">The AIPLA supports this rate based on an economic survey developed and directed by their
    Law Practices Management Committee as AIPLA reports the annual income and related
    professional and demographic characteristics of intellectual property (IP) law attorneys and
    associated patent agents.</p>
<br><br><br>
<table>
    <tr style="margin-bottom: 0px !important;padding-bottom: 0px;">
        <td colspan="2" style="margin-bottom: 0px !important;padding-bottom: 0px;">
            <p >Attorney Name:&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td colspan="3" style="margin-bottom: 0px !important;padding-bottom: 0px;">
            <p >{{$attorney->fname." ".$attorney->lname}}</p>
        </td>
    </tr>
    <tr style="margin-bottom: 0px !important;">
        <td colspan="2" >
            <p >Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td colspan="3">
            <p  >{{str_replace('<br>',', ',$attorney->uuid)}}</p>
        </td>
    </tr>
    <tr style="margin-bottom: 0px !important;">
        <td colspan="2" >
            <p >Telephone:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td colspan="3">
            <p>
                @if($attorney->did != '')
                    {{$attorney->did}}
                @else
                    NA
                @endif
            </p>
        </td>
    </tr>
    <tr style="margin-bottom: 0px !important;">
        <td colspan="2" >
            <p >Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </td>
        <td colspan="3">
            <p >{{$attorney->email}}</p>
        </td>
    </tr>
</table>
<br><br><br>
<p class="pSmall">Patent Services USA frequently retains the above counsel for patent related services and has an
    ongoing business relationship with this law firm, we provide these attorneys substantial amount
    of work. However, pursuant to attorney code of ethics our patent attorneys are required to use
    their own judgment and should not be influenced by the amount of work that is provided to them
    by Patent Services USA.
</p>
<p class="pSmall">You should feel free to confirm with the patent attorney handling your work that they are
    exercising independent legal judgment.
</p>
<p class="pSmall">By signing this letter of engagement, you consent to and waive any potential conflict that could
    arise from the law firm representation and ongoing business relationship with Patent Services
</p>

<p class="myOtherFooter">Initials: &nbsp;&nbsp;&nbsp;<u>{{strtoupper($client->fname[0])}}</u>/<u>{{strtoupper($client->lname[0])}}</u></p>
<div class="page-break"></div>
<!--page 2-->
<p class="pSmall">USA. This expressly includes the fact that law
    firm’s personal financial interest creates a potential conflict.
</p>

<p class="pSmall">Of the funds that you have paid up to $150 is paid to the law firm which is only able to provide
    this special reduced rate to Patent Services USA because of the volume of business that they
    transact with us. This rate is not available to the public.
</p>
<p class="pSmall">By signing this letter of engagement, you consent to Patent Services USA's payment of attorney
    fee on your behalf.
</p>
<p class="pSmall">The Inventor acknowledges their consent to this Agreement via Electronic Signature. This
    agreement and any counterparts to this agreement will be deemed an original. To expedite the
    process of entering into this Agreement, the Inventor acknowledges that Electronic
    transmissions of the Agreement will be equivalent to original documents. "Electronic
    Transmission"; will mean copies that are reproduced or transmitted as complete and accurate
    reproductions and transmissions of this original. Signee has the option to opt out and sign with
    a paper signature instead.
</p>

<br><br><br><br><br>
<table>
    <tr style="margin-bottom: 0px !important;">
        <td align="center" style="width: 50%;">
            <p>Signature</p>
        </td>
        <td align="center" style="padding-left: 50px;">
            <p>Date</p>
        </td>
    </tr>
    <tr style="margin-bottom: 0px !important;">
        <td style="width: 50%;">
            <p>_______________________________</p>
        </td>
        <td style="padding-left: 65px;">
            <p>_______________________________</p>
        </td>
    </tr>
    <tr style="margin-bottom: 0px !important;">
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$client->fname." ".$client->lname}}
        </td>
        <td>
        </td>
    </tr>
    <tr style="margin-bottom: 0px !important;">
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$client->street.", ".$client->city." ".$client->state.", ".$client->zip}}
        </td>
        <td>
        </td>
    </tr>
    <tr style="margin-bottom: 0px !important;">
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$client->email}}
        </td>
        <td>
        </td>
    </tr>
    <tr style="margin-bottom: 0px !important;">
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$client->phone}}
        </td>
        <td>
        </td>
    </tr>
</table>
<p class="myOtherFooter">Initials: &nbsp;&nbsp;&nbsp;<u>{{strtoupper($client->fname[0])}}</u>/<u>{{strtoupper($client->lname[0])}}</u> </p>