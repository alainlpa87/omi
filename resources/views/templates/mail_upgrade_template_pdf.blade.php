<link href="{{ asset('/css/pdf.css') }}" rel="stylesheet">
{{--Page #1--}}
<p class="iconMargin">
    <img src="{{asset('/img/contracts/logo.png')}}" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<div>
    <table width="100%">
        <tr>
            <td>
                {{$project->lead->fname." ".$project->lead->lname}}
            </td>
            <td></td>
            <td></td>
            <td style="text-align: right !important;">
                {{date("F d, Y")}}
            </td>
        </tr>
        <tr><td colspan="4">{{$project->lead->street}}</td></tr>
        <tr><td colspan="4">{!!strlen($project->lead->street2)>0?$project->lead->street2:""!!}</td></tr>
        <tr><td colspan="4">{{$project->lead->city.", ".$project->lead->state." ".$project->lead->zip}}</td></tr>
    </table>
</div>
<p>
    Dear {{$project->lead->fname}},
</p>
<p>
    Congratulations! You’ve taken an important step toward making your invention dream a reality. You’ve shown
    confidence and commitment in your invention by hiring Patent Services USA to complete your Invention Marketing
    Guide. We’re now working to arrange and coordinate the professional services needed to properly research and
    document critical aspects of your product idea as outlined in the proposal you completed and returned to us. We have
    attached, herein, a receipt for the Invention Marketing Guide.
</p>
<p >
    Your consultant, <strong>{{$project->consultant->fname." ".$project->consultant->lname}}</strong>, will be contacting you regularly over the next 3 to 5 weeks to keep you informed
    on the progress of the work to complete your Invention Marketing Guide. Once your guide is completed, your
    consultant will be reviewing the work with you to discuss your next steps.
</p>
<p>
    Your Invention Marketing Guide is an important tool to help both you and manufacturers understand the marketability
    of your new invention idea. As you recall, the Invention Marketing Guide eliminated a portion of the scope of work that
    was presented to you in our original proposal to complete an Invention Initiative Guide for your product.
</p>
<p>
    If you would like to upgrade your research program to include the entire scope of work presented to you in the original
    Invention Initiative Guide proposal, you may still do so. In order to ensure that you receive all of the work combined into
    one professional presentation, we ask that you complete the attached Invention Guide Upgrade Proposal and return
    that to our office along with the indicated investment within 2 weeks of your initial investment into the Invention
    Marketing Guide.
</p>
<p>
    We are committed to delivering excellence and value to clients seeking professional patenting services. And we
    appreciate this opportunity to support your invention goals.
</p>
<p>
    <br>Sincerely,<br><br>
    Client Services<br>
    Patent Services USA<br>
    12000 Biscayne Blvd Ste. 700<br>
    North Miami, FL 33181<br>
    1-877-652-4908 ext. 211<br>
    1-800-886-7951 Fax<br>
    www.ownmyinvention.com
</p>

<div class="page-break"></div>
{{--Page #2--}}
<p class="iconMargin">
    <img src="{{asset('/img/contracts/logo.png')}}" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<table align="center" width="100%">
    <tr>
        <th>Client Name:</th>
        <td>{{$project->lead->fname." ".$project->lead->lname}}</td>
        <th>Invention Name:</th>
        <td>{{$project->ideaName}}</td>
    </tr>
    @if(strlen($project->coInventor)==0)
        <tr>
            <th>Address:</th>
            <td>{{$project->lead->street."".$project->lead->street2}}</td>
            <th>Consultant:</th>
            <td>{{ucwords($project->consultant->fname." ".$project->consultant->lname)}}</td>
        </tr>
        <tr>
            <th>City/State:</th>
            <td>{{$project->lead->city.", ".$project->lead->state}}</td>
            <th>Date:</th>
            <td>{{date("F j, Y")}}</td>
        </tr>
        <tr>
            <th>Zip:</th>
            <td>{{$project->lead->zip}}</td>
            <th>File:</th>
            <td>{{$project->lead->fileno}} - {{$project->id}}</td>
        </tr>
    @else
        <tr>
            <th>Co-inventor:</th>
            <td>{{$project->coInventor}}</td>
            <th>Consultant:</th>
            <td>{{ucwords($project->consultant->fname." ".$project->consultant->lname)}}</td>
        </tr>
        <tr>
            <th>Address:</th>
            <td>{{$project->lead->street." ".$project->lead->street2}}</td>
            <th>Date:</th>
            <td>{{date("F j, Y")}}</td>
        </tr>
        <tr>
            <th>City/State:</th>
            <td>{{$project->lead->city.", ".$project->lead->state}}</td>
            <th>File:</th>
            <td>{{$project->lead->fileno}} - {{$project->id}}</td>
        </tr>
        <tr>
            <th>Zip:</th>
            <td>{{$project->lead->zip}}</td>
            <td></td>
        </tr>
    @endif
</table>
<br><br>
<h3><strong>Invention Marketing Guide Upgrade Proposal</strong></h3>
<br>
<ul class="circle">
    <table width="85%">
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 35px">MOST<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; POPULAR</strong></td>
            <td width="12%">&nbsp;</td>
        </tr>
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: darkgray;"><strong style="margin-left: 20px">SILVER<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$430</strong></td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 35px">GOLD<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$630</strong></td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #ddd;"><strong style="margin-left: 20px">PLATINUM<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$930</strong></td>
        </tr>
        <tr>
            <td><li><b>Registered Attorney Patent Search & Legal Opinion</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td>
                <li>
                    <b>Investor Strategy Package</b>
                    <ul class="chk_square">
                        <li>Pricing Strategies</li>
                        <li>Packaging Suggestions</li>
                        <li>Suggested Legal Protection</li>
                        <li>How To Beat Competitors</li>
                    </ul>
                </li>
            </td>
            <td style="background-color: darkgray;"><div class="col-md-3" style="margin-left: 60%"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3" style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3" style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>PowerPoint Momentum Tool<sup class="black">TM</sup></b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Manufacturing Consideration</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Press Release</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>2D Design</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><strong>Investment Protection:</strong> Amount of IIG investment will be<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;credited towards <strong>FULL</strong> payment<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;patent protection plan</li></td>
            <td style="text-align:center;vertical-align:middle;background-color: darkgray"><strong style="margin-left: 60%">$500</strong></td>
            <td style="text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 60%">$750</strong></td>
            <td style="text-align:center;vertical-align:middle;background-color: #ddd;"><strong style="margin-left: 60%">$1,000</strong></td>
        </tr>
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
        </tr>
        <tr>
            <td width="64%"><strong style="color: red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select your package:&nbsp;</strong></td>
            <td width="12%"><img src="{{asset('/img/unchk_square.png')}}" style="margin-left: 20px" alt=""> <strong>&nbsp; $430</strong></td>
            <td width="12%"><img src="{{asset('/img/unchk_square.png')}}" style="margin-left: 20px" alt=""> <strong>&nbsp; $630</strong></td>
            <td width="12%"><img src="{{asset('/img/unchk_square.png')}}" style="margin-left: 30%" alt=""> <strong>&nbsp; $930</strong></td>
        </tr>
    </table>
</ul>
<br>
<table cellspacing="10" class="rect">
    <tr>
        <td colspan="5" style="padding-bottom:25px;"><strong> Client Authorization:</strong><br><br>
            <strong>By signing below, I agree to all terms and conditions outlined in this Invention Guide Upgrade Proposal</strong>
        </td>
    </tr>
    <tr>
        <td style="border-top:solid black 1px;"> Inventor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style="border-top:solid black 1px;" width="100">Date&nbsp;&nbsp;&nbsp;</td>
        <td width="25"></td>
        <td style="border-top:solid black 1px;"> Co-Inventor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style="border-top:solid black 1px;">Date&nbsp;&nbsp;&nbsp;</td>
        <td width="5"></td>
    </tr>
</table>
<div style="margin-top:-7px;margin-left:7px;">
    <br>
    <strong>Authorized PATENT SERVICES USA Representative:</strong>
    Rick Blake
</div>
<div align="center" style="margin-top:6px;" class="shadow">
    12000 Biscayne Boulevard, Suite 700 / North Miami, FL 33181 Phone: 1-877-652-4908 / Fax: 1-800-886-7951
</div>

<div class="page-break"></div>
{{--Page #3--}}
<table cellspacing="10" align="center" class="rect">
    <tr>
        <th colspan="3" align="center" style="font-size:16px;text-align: center !important;">Payment Authorization</th>
    </tr>
    <tr>
        <td colspan="3"><img src="{{asset('/img/chk_square.png')}}" alt=""> I am enclosing my check / money order in the amount of $ ______________________</td>
    </tr>
    <tr>
        <td width="39%"><img src="{{asset('/img/chk_square.png')}}" alt=""> Visa / MasterCard</td>
        <td width="32%"><img src="{{asset('/img/chk_square.png')}}" alt=""> American Express</td>
        <td width="29%"><img src="{{asset('/img/chk_square.png')}}" alt=""> Discover</td>
    </tr>
    <tr>
        <td>Credit Card Number: ___________________________</td>
        <td>Expiration Date: _____________</td>
        <td> Amount $ _____________</td>
    </tr>
    <tr>
        <td> Name as Appears on Card: ___________________________</td>
        <td colspan="2"> Billing Address (if different): ____________________________________</td>
    </tr>
    <tr>
        <td>Card Holder Signature: ___________________________</td>
        <td colspan="2">Authorized Signature (Inventor): _________________________________</td>
    </tr>
</table>
<h3><strong>Legal Disclosure and Information</strong></h3>
<p>
    This proposal is made between Patent Services USA and all Inventors named herewith in order to execute this Invention Initiative Guide
    Proposal (the agreement) for the Invention Initiative Guide outlined on the reverse side of this page.
</p>
<p>
    This agreement does not execute a patent application, does not provide patent protection of any kind and does not substitute for the legal advice
    of a registered patent attorney. The Inventors understands that all patent searches and legal opinions are provided by our affiliate
    Registered Patent Attorney. We may utilize one or more Registered Patent Attorneys to expedite all patent searches. The search is a thorough
    search of files on record at the United States Patent and Trademark Office. The Inventors authorize Patent Services USA to provide the results
    of the patent search and legal opinion from any and all Registered Patent Attorneys as part of the Invention Initiative Guide. Inventors
    acknowledge that Patent Services USA will deliver the services outlined in this agreement within a three (3) to five (5) week timeframe which
    constitutes a reasonable amount of time due to work scheduling of attorneys, draftsmen, production personnel and other factors beyond any
    control of Patent Services USA.
</p>
<p>
    New invention innovation and / or product innovation involves a high degree of risk. Inventor agrees that a patent is the most secure form of
    legal protection for a new invention. Only a small percentage of inventions become commercially successful. Patent Services USA does not
    make any promises, claims or guarantees that an invention will ever make a profit, have commercial success, any positive results or result in
    any kind of financial gain.
</p>
<p>
    The Invention Initiative Guide contains a Market Analysis which may result in a negative outcome. All inventors / clients have a seven (7)
    calendar day right of rescission from the signature date of the agreement to cancel for a refund. The cancellation request must be received at
    our corporate headquarters located at 12000 Biscayne Boulevard, Suite 700 North Miami, FL 33181, via certified mail only. Due to work
    scheduling of attorneys, draftsmen, production personnel and other factors beyond any control, Patent Services USA reserves the first right to
    refuse all refund requests if the market analysis occurs after the seven (7) calendar day rescission period stated above.
</p>
<p>
    This Invention Initiative Guide represents the entire agreement between all parties, whether written, verbal, expressed or implied. Any and all
    other agreements or suggestions are void. This agreement shall not be modified without the expressed written approval of Patent Services USA
    and at least one authorized officer or representative. This agreement is not a release of any material submitted to Patent Services USA without
    the expressed written consent of the inventor.
</p>
<p>
    The Inventor shall not, nor shall attempt to circumvent or bypass the activities of Patent Services USA by negotiating directly or indirectly with
    any prospective patent assistance service providers without the express written permission of the Patent Services USA. Any attempt by the
    INVENTOR to circumvent or bypass the activities of the Patent Services USA shall be construed as a material breach in violation of this Section
    and shall trigger the termination of this Agreement without any recourse whatsoever by INVENTOR.
</p>
<p>
    The Inventor acknowledges Patent Services USA does not engage in the business of invention development or marketing services. No inventors
    have received a net financial profit as a result of PATENT SERVICES USA. No inventors have contracted with Patent Services USA for
    invention promotion services during the past five (5) years. Patent Services USA does not perform market evaluations or give opinions of
    marketing potential on any invention submitted for review. Patent Services USA has no customers that purchase marketing promotion services.
    No inventors have received licensing agreements for their inventions as a direct result of any invention promotion services through Patent
    Services USA. In the past 10 years, the officers of Patent Services USA, either individually or collectively, assisted Global Licensing Partners in its
    efforts to research inventions. Patent Services USA only provides patent assistance services and informational materials related to the invention
    industry.
</p>
<p>
    All disputes concerning the understanding, meaning or interpretation of any and all parts of this agreement, including the rights, duties,
    relationships or obligations of either party under this agreement shall be settled through the American Arbitration Association (AAA), in the
    county of Miami-Dade, State of Florida, in accordance with all rules and regulations. All claims must be made within three (3) months of
    occurrence. Inventors agree to indemnify and hold harmless Patent Services USA and its affiliates, employees, contractors, successors and
    assigns, including, all Registered Patent Attorneys from any and all claims which might be raised by any third party for any reason relating to the
    invention or the services provided by Patent Services USA, including, but not limited to, any claim of infringement of intellectual property
    (copyright, trademark and patent) relating to the inventions as a result of the use contemplated herein of the inventions, in any form submitted by
    Inventor to Patent Services USA.
</p>
<p>
    All information contained in this and all other documents are proprietary and the exclusive property of Patent Services USA, which reserves all
    rights. All proprietary information and property is protected by Trademark and Copyright.
</p>
<p>
    The Inventor acknowledges their consent to this Agreement via Electronic Signature. This agreement and any counterparts to this agreement
    will be deemed an original. To expedite the process of entering into this Agreement, the Inventor acknowledges that Electronic Transmissions of
    the Agreement will be equivalent to original documents. “Electronic Transmission" will mean copies that are reproduced or transmitted as
    complete and accurate reproductions and transmissions of this original. Signatories have the option to opt out and sing with a paper signature
    instead.
</p>
