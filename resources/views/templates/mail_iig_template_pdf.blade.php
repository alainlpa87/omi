<link href="{{ asset('/css/pdf.css') }}" rel="stylesheet">
{{--Page #1--}}
<p class="iconMargin">
    <img src="{{asset('/img/contracts/logo.png')}}" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<br>
<div>
    <p>
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
    </p>
</div>
<br>
<p>
    Dear {{$project->lead->fname}},
</p>
<br>
<p>
    Congratulations!  You’ve taken the first steps toward establishing your <b>Intellectual Property</b> and turning your invention
    concept into reality. Here at PATENT SERVICES USA, we’re now working to arrange and schedule the professional services needed
    to properly research and document your product idea. Researchers around the world understand the importance of independent
    verification to establish a strong, credible case supporting your <b>Intellectual Property’s</b> potential.  Your own invention idea
    deserves the same thoughtful preparation and independent analysis supporting it.  Establishing the proper foundation for your
    idea now is critical to making your case for both patenting and licensing your Intellectual Property. We’ve taken the time to
    thoroughly review and understand the product information you’ve presented to us. Through our discussions and assessment, our
    team has prepared a plan of action to assist you in moving forward. As your Consultant explained to you, we’ve prepared a scope
    of work identifying the project elements that will be developed and delivered to you in your <b>Invention Initiative Guide</b>. This
    guide is designed to present and communicate your invention idea in a clear and concise manner, giving you the tools you need
    to move toward your goal of successfully documenting, protecting and licensing your new product!
</p>
<br>
<p >
    All of your product research will be prepared through independent, contracted professionals to ensure that your invention receives an
    unbiased analysis. Once you receive your <b>Invention Initiative Guide</b>, you’ll be empowered to make informed decisions about the business
    opportunity that your <b>Intellectual Property</b> represents. If your product receives a favorable <b>Marketing Assessment</b> and <b>Legal Opinion Of
    Patentability</b>, we can continue working with you to establish your patent protection.  <span style="font-style: italic;"><b>We are confident enough to provide your project
    with “Investment Protection”, in which up tp 70% of your initial Research and Development and Patent Search cost, will be credited towards
    your full Patent Protection Plan.</b></span> Once we have established Patent Pending, Then you can work through our licensing affiliate to assist
    you in marketing and licensing your invention and <b>Intellectual Property</b> entirely on a contingency fee basis!
</p>
<br>
<p>
    Contact your Consultant today to review your proposal!  Your investment may be made by Debit Card, Credit Card or Electronic Check (online)
    or by completing the attached Credit Card Authorization form. If you wish, you may fax the completed documents and credit card authorization
    form to us at: 800-886-7951. We are committed to delivering excellence and value to clients seeking professional patenting services.  And we
    appreciate the opportunity to work with you now on your project!
</p>
<br><br>
<p>
    <br>Sincerely,<br><br>
    Client Services<br>
    Patent Services USA
</p>
<br>


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
<h3><strong>Invention Initiative Guide Proposal</strong></h3>
<ul class="circle">
    <table width="85%">
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 35px">MOST <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; POPULAR</strong></td>
            <td width="12%">&nbsp;</td>
        </tr>
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: darkgray;"><strong style="margin-left: 20px">SILVER<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$879</strong></td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 35px">GOLD<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$1,079</strong></td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #ddd;"><strong style="margin-left: 20px">PLATINUM<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$1,379</strong></td>
        </tr>
        <tr>
            <td><li>Detailed Product Description</li></td>
            <td style="background-color: darkgray;" align="center"><div class="col-md-3 " style="margin-left: 60%" style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;" align="center"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;" align="center"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td>
                <li>
                    <b>Private or University Based Marketing Analysis</b>
                    <ul class="chk_square">
                        <li>Social Factors</li>
                        <li>Business Risk Factors</li>
                        <li>Demand Analysis Factors</li>
                        <li>Market Acceptance Factors</li>
                        <li>Competitive Factors</li>
                    </ul>
                </li>
            </td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" style="margin-left: 25%"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Registered Attorney Patent Search & Legal Opinion</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Preliminary Patent Illustration</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Conclusion and Recommendation</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
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
            <td width="12%"><img src="{{asset('/img/unchk_square.png')}}" style="margin-left: 20px" alt=""> <strong>&nbsp; $879</strong></td>
            <td width="12%"><img src="{{asset('/img/unchk_square.png')}}" style="margin-left: 20px" alt=""> <strong>&nbsp; $1,079</strong></td>
            <td width="12%"><img src="{{asset('/img/unchk_square.png')}}" style="margin-left: 30%" alt=""> <strong>&nbsp; $1,379</strong></td>
        </tr>
    </table>
</ul>
<table cellspacing="10" class="rect">
    <tr>
        <td colspan="5" style="padding-bottom:25px;"><strong> Client Authorization:</strong><br><br>
            <strong>By signing below, I agree to all terms and conditions outlined in this Invention Initiative Guide Proposal</strong>
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
<div align="center" style="margin-top:3px;" class="shadow">
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
    <tr>
        <td colspan="3" style="text-align: center;"><strong>Please make all investments payable to PATENT SERVICES USA.</strong></td>
    </tr>
</table>
<h3><strong>Legal Disclosure and Information</strong></h3>
<p class="pSmaller">
    This proposal is made between PATENT SERVICES USA, Inc. (PATENT SERVICES) and all Inventors named herewith (The Inventor) in order
    to execute this Invention Initiative Guide Proposal (the agreement) for the Invention Initiative Guide outlined on the reverse side of this page.
</p>
<p class="pSmaller">
    This agreement does not execute a patent application, does not provide patent protection of any kind and does not substitute for the legal advice
    of a registered patent attorney. The Inventor understands that all patent searches and legal opinions are provided by our affiliate
    Registered Patent Attorneys. We may utilize one or more Registered Patent Attorneys to expedite all patent searches. The search is a thorough
    search of files on record at the United States Patent and Trademark Office. The Inventor authorizes PATENT SERVICES to provide the results
    of the patent search and legal opinion from any and all Registered Patent Attorneys as part of the Invention Initiative Guide. The Inventor
    acknowledges that PATENT SERVICES will deliver the services outlined in this agreement within a six (6) to eight (8) week timeframe, which
    constitutes a reasonable amount of time for scheduling attorneys, draftsmen, production personnel and other factors beyond any control of
    PATENT SERVICES.
</p>
<p class="pSmaller">
    Invention and new product innovation involves a high degree of risk. Inventor agrees that a patent is the most secure form of legal protection for
    a new invention. Only a small percentage of inventions become commercially successful. PATENT SERVICES does not make any promises,
    claims or guarantees that an invention will ever make a profit, have commercial success, any positive results or result in any kind of financial
    gain.
</p>
<p class="pSmaller">
    The Invention Initiative Guide contains a Market Analysis which may result in a negative outcome. The Inventor has a seven (7) calendar day
    right of rescission from the signature date of the agreement to cancel for a refund. The cancellation request must be received at our corporate
    headquarters located at 12000 Biscayne Boulevard, Suite 700 North Miami, FL 33181, via certified mail only. Due to work scheduling of
    attorneys, draftsmen, production personnel and other factors beyond any control, PATENT SERVICES reserves the first right to refuse all refund
    requests after the seven (7) calendar day rescission period stated above.
</p>
<p class="pSmaller">
    This Invention Initiative Guide Proposal represents the entire agreement between all parties, whether written, verbal, expressed or implied. Any
    and all other agreements or suggestions are void. This agreement shall not be modified without the expressed written approval of PATENT
    SERVICES and at least one authorized officer or representative. This agreement is not a release of any material submitted to PATENT
    SERVICES without the expressed written consent of the inventor.
</p>
<p class="pSmaller">
    The Inventor shall not, nor shall attempt to circumvent or bypass the activities of PATENT SERVICES by negotiating directly or indirectly with
    any prospective patent assistance service providers without the express written permission of the PATENT SERVICES Any attempt by the
    INVENTOR to circumvent or bypass the activities of the PATENT SERVICES shall be construed as a material breach in violation of this Section
    and shall trigger the termination of this Agreement without any recourse whatsoever by INVENTOR.
</p>
<p class="pSmaller">
    The Inventor acknowledges PATENT SERVICES does not engage in the business of invention development or marketing services. No inventors
    have received a net financial profit as a result of PATENT SERVICES. No inventors have contracted with PATENT SERVICES for invention
    promotion services during the past five (5) years. PATENT SERVICES does not perform market evaluations or give opinions of marketing
    potential on any invention submitted for review. PATENT SERVICES has no customers that purchase marketing promotion services. No
    inventors have received licensing agreements for their inventions as a direct result of any invention promotion services through PATENT
    SERVICES. In the past 10 years, the officers of PATENT SERVICES, either individually or collectively, assisted Global Licensing Partners in its
    efforts to research inventions. PATENT SERVICES only provides patent assistance services and informational materials related to the invention industry.
</p>
<p class="pSmaller">
    All disputes concerning the understanding, meaning or interpretation of any and all parts of this agreement, including the rights, duties,
    relationships or obligations of either party under this agreement shall be settled through the American Arbitration Association (AAA), in the
    county of Miami-Dade, State of Florida, in accordance with all rules and regulations. All claims must be made within three (3) months of
    occurrence. The Inventor agrees to indemnify and hold harmless PATENT SERVICES and its affiliates, employees, contractors, successors and
    assigns, including, all Registered Patent Attorneys from any and all claims which might be raised by any third party for any reason relating to the
    invention or the services provided by PATENT SERVICES, including, but not limited to, any claim of infringement of intellectual property
    (copyright, trademark and patent) relating to the inventions as a result of the use contemplated herein of the inventions, in any form submitted by
    Inventor to PATENT SERVICES.
</p>
<p class="pSmaller">
    All information contained in this and all other documents are proprietary and the exclusive property of PATENT SERVICES, which reserves all
    rights. All proprietary information and property is protected by Trademark and Copyright.
</p>
<div class="page-break"></div>
{{--Page #4--}}
<p class="iconMargin">
    <img src="{{asset('/img/contracts/logo.png')}}" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<table align="center"  width="100%">
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
            <td>{{$project->lead->fileno}}</td>
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
            <td>{{$project->lead->fileno}}</td>
        </tr>
        <tr>
            <th>Zip:</th>
            <td>{{$project->lead->zip}}</td>
            <td></td>
        </tr>
    @endif
</table>
<h3><strong>Invention Initiative Guide Proposal</strong></h3>
<ul class="circle">
    <table width="85%">
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 35px">MOST <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; POPULAR</strong></td>
            <td width="12%">&nbsp;</td>
        </tr>
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: darkgray;"><strong style="margin-left: 20px">SILVER<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$879</strong></td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 35px">GOLD<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$1,079</strong></td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #ddd;"><strong style="margin-left: 20px">PLATINUM<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$1,379</strong></td>
        </tr>
        <tr>
            <td><li>Detailed Product Description</li></td>
            <td style="background-color: darkgray;" align="center"><div class="col-md-3 " style="margin-left: 60%" style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;" align="center"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;" align="center"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td>
                <li>
                    <b>Private or University Based Marketing Analysis</b>
                    <ul class="chk_square">
                        <li>Social Factors</li>
                        <li>Business Risk Factors</li>
                        <li>Demand Analysis Factors</li>
                        <li>Market Acceptance Factors</li>
                        <li>Competitive Factors</li>
                    </ul>
                </li>
            </td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" style="margin-left: 25%"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Registered Attorney Patent Search & Legal Opinion</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Preliminary Patent Illustration</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Conclusion and Recommendation</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
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
            <td width="12%"><img src="{{asset('/img/unchk_square.png')}}" style="margin-left: 20px" alt=""> <strong>&nbsp; $879</strong></td>
            <td width="12%"><img src="{{asset('/img/unchk_square.png')}}" style="margin-left: 20px" alt=""> <strong>&nbsp; $1,079</strong></td>
            <td width="12%"><img src="{{asset('/img/unchk_square.png')}}" style="margin-left: 30%" alt=""> <strong>&nbsp; $1,379</strong></td>
        </tr>
    </table>
</ul>
<table cellspacing="10" class="rect">
    <tr>
        <td colspan="5" style="padding-bottom:25px;"><strong> Client Authorization:</strong><br><br>
            <strong>By signing below, I agree to all terms and conditions outlined in this Invention Initiative Guide Proposal</strong>
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
<div align="center" style="margin-top:3px;" class="shadow">
    12000 Biscayne Boulevard, Suite 700 / North Miami, FL 33181 Phone: 1-877-652-4908 / Fax: 1-800-886-7951
</div>

<div class="page-break"></div>
{{--Page #5--}}
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
    <tr>
        <td colspan="3" style="text-align: center;"><strong>Please make all investments payable to PATENT SERVICES USA.</strong></td>
    </tr>
</table>
<h3><strong>Legal Disclosure and Information</strong></h3>
<p class="pSmaller">
    This proposal is made between PATENT SERVICES USA, Inc. (PATENT SERVICES) and all Inventors named herewith (The Inventor) in order
    to execute this Invention Initiative Guide Proposal (the agreement) for the Invention Initiative Guide outlined on the reverse side of this page.
</p>
<p class="pSmaller">
    This agreement does not execute a patent application, does not provide patent protection of any kind and does not substitute for the legal advice
    of a registered patent attorney. The Inventor understands that all patent searches and legal opinions are provided by our affiliate
    Registered Patent Attorneys. We may utilize one or more Registered Patent Attorneys to expedite all patent searches. The search is a thorough
    search of files on record at the United States Patent and Trademark Office. The Inventor authorizes PATENT SERVICES to provide the results
    of the patent search and legal opinion from any and all Registered Patent Attorneys as part of the Invention Initiative Guide. The Inventor
    acknowledges that PATENT SERVICES will deliver the services outlined in this agreement within a six (6) to eight (8) week timeframe, which
    constitutes a reasonable amount of time for scheduling attorneys, draftsmen, production personnel and other factors beyond any control of
    PATENT SERVICES.
</p>
<p class="pSmaller">
    Invention and new product innovation involves a high degree of risk. Inventor agrees that a patent is the most secure form of legal protection for
    a new invention. Only a small percentage of inventions become commercially successful. PATENT SERVICES does not make any promises,
    claims or guarantees that an invention will ever make a profit, have commercial success, any positive results or result in any kind of financial
    gain.
</p>
<p class="pSmaller">
    The Invention Initiative Guide contains a Market Analysis which may result in a negative outcome. The Inventor has a seven (7) calendar day
    right of rescission from the signature date of the agreement to cancel for a refund. The cancellation request must be received at our corporate
    headquarters located at 12000 Biscayne Boulevard, Suite 700 North Miami, FL 33181, via certified mail only. Due to work scheduling of
    attorneys, draftsmen, production personnel and other factors beyond any control, PATENT SERVICES reserves the first right to refuse all refund
    requests after the seven (7) calendar day rescission period stated above.
</p>
<p class="pSmaller">
    This Invention Initiative Guide Proposal represents the entire agreement between all parties, whether written, verbal, expressed or implied. Any
    and all other agreements or suggestions are void. This agreement shall not be modified without the expressed written approval of PATENT
    SERVICES and at least one authorized officer or representative. This agreement is not a release of any material submitted to PATENT
    SERVICES without the expressed written consent of the inventor.
</p>
<p class="pSmaller">
    The Inventor shall not, nor shall attempt to circumvent or bypass the activities of PATENT SERVICES by negotiating directly or indirectly with
    any prospective patent assistance service providers without the express written permission of the PATENT SERVICES Any attempt by the
    INVENTOR to circumvent or bypass the activities of the PATENT SERVICES shall be construed as a material breach in violation of this Section
    and shall trigger the termination of this Agreement without any recourse whatsoever by INVENTOR.
</p>
<p class="pSmaller">
    The Inventor acknowledges PATENT SERVICES does not engage in the business of invention development or marketing services. No inventors
    have received a net financial profit as a result of PATENT SERVICES. No inventors have contracted with PATENT SERVICES for invention
    promotion services during the past five (5) years. PATENT SERVICES does not perform market evaluations or give opinions of marketing
    potential on any invention submitted for review. PATENT SERVICES has no customers that purchase marketing promotion services. No
    inventors have received licensing agreements for their inventions as a direct result of any invention promotion services through PATENT
    SERVICES. In the past 10 years, the officers of PATENT SERVICES, either individually or collectively, assisted global licensing partners in its
    efforts to research inventions. PATENT SERVICES only provides patent assistance services and informational materials related to the invention industry.
</p>
<p class="pSmaller">
    All disputes concerning the understanding, meaning or interpretation of any and all parts of this agreement, including the rights, duties,
    relationships or obligations of either party under this agreement shall be settled through the American Arbitration Association (AAA), in the
    county of Miami-Dade, State of Florida, in accordance with all rules and regulations. All claims must be made within three (3) months of
    occurrence. The Inventor agrees to indemnify and hold harmless PATENT SERVICES and its affiliates, employees, contractors, successors and
    assigns, including, all Registered Patent Attorneys from any and all claims which might be raised by any third party for any reason relating to the
    invention or the services provided by PATENT SERVICES, including, but not limited to, any claim of infringement of intellectual property
    (copyright, trademark and patent) relating to the inventions as a result of the use contemplated herein of the inventions, in any form submitted by
    Inventor to PATENT SERVICES.
</p>
<p class="pSmaller">
    All information contained in this and all other documents are proprietary and the exclusive property of PATENT SERVICES, which reserves all
    rights. All proprietary information and property is protected by Trademark and Copyright.
</p>

<div class="page-break"></div>
{{--pAGE # 4--}}
<h3><strong>CLIENT INFORMATION AND CORRECTION FORM</strong></h3>
<p>
    In keeping with our company policy to maintain accurate information on all client activities, we ask that you review the Invention Initiative Guide Proposal (Page 2 & 3).
    <strong><span style="text-decoration:underline;">THIS FORM IS PART OF THE ENTIRE AGREEMENT.</span></strong> This correction form must be returned to us with the copy of the Invention Initiative Guide Proposal.
    Any missing pages could delay us from beginning work on your project.
</p>
<h3><strong>INVENTOR INFORMATION CORRECTION</strong></h3>

<table cellspacing="10" align="center" class="rect" width="90%">
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Inventor Name:</span></td>
        <td colspan="2" class="trLine"><span class="spanProfile">Co-Inventor:</span></td>
    </tr>
    <tr>
        <td colspan="4" class="trLine"><span class="spanProfile">Company Name (if applicable):</span></td>
    </tr>
    <tr>
        <td class="trLine" colspan="2"><span class="spanProfile">State of Incorporation (if applicable):</span> </td>
        <td class="trLine" colspan="2"><span class="spanProfile"> Entity Type: (if applicable):</span> </td>
    </tr>
    <tr>
        <td class="trLine" colspan="2"><span class="spanProfile">Street Address:</span> </td>
        <td class="trLine"><span class="spanProfile"> Apt/Suite: </span> </td>
        <td class="trLine"><span class="spanProfile">City:</span> </td>
    </tr>
    <tr>
        <td class="trLine"><span class="spanProfile">State:</span> </td>
        <td class="trLine"><span class="spanProfile"> Zip: </span> </td>
        <td class="trLine"><span class="spanProfile">Home Tel:</span> </td>
        <td class="trLine"><span class="spanProfile">Mobile:</span></td>
    </tr>
    <tr>
        <td colspan="4" class="trLine"><span class="spanProfile"> INVENTION NAME:</span> </td>
    </tr>
</table>
<br>
<p>
    If you wish to authorize us to communicate with a co-inventor(s) or you want your co-inventor(s) given
    consideration and/or mention on any patent application, enter their complete information below.  You may
    also deselect a co-inventor by keeping a copy of this form or requesting it for future reference.  We must
    have both signatures of the inventor and co-inventor to acknowledge the change.<br>
</p>
<table cellspacing="10" align="center" class="rect" width="90%">
    <tr><td colspan="2"><span style="text-align: center;">CO-INVENTOR INFORMATION</span></td></tr>
    <tr>
        <td class="trLine"><span class="spanProfile">First Co-Inventor Name:</span></td>
        <td class="trLine"><span class="spanProfile">Sign:</span></td>
    </tr>
    <tr>
        <td class="trLine"><span class="spanProfile">Second Co-Inventor Name:</span> </td>
        <td class="trLine"><span class="spanProfile"> Sign:</span> </td>
    </tr>
    <tr>
        <td class="trLine"><span class="spanProfile">Third Co-Inventor Name:</span> </td>
        <td class="trLine"><span class="spanProfile"> Sign:</span> </td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Primary Inventor Authorized Signature:</span> </td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Corporate Officer Authorized Signature (if necessary):</span> </td>
    </tr>
</table>
<br>
<table cellspacing="15" class="notesTable">
    <tr>
        <td><img src="{{asset('/img/contracts/unchk_square.png')}}" alt="">&nbsp;<strong>Check here to add a co-inventor</strong></td>
    </tr>
    <tr>
        <td><img src="{{asset('/img/contracts/unchk_square.png')}}" alt="">&nbsp;<strong>Check here to delete a co-inventor</strong></td>
    </tr>
</table>
<h5 class="alignLeft"> <strong>Additional Comments to Changes:</strong> </h5>
<div class="rect notesTable"></div>
<br>
<table class="notesTable">
    <tr>
        <td class="red"><img src="{{asset('/img/contracts/unchk_square.png')}}" alt="">  ALL INFORMATION IS CORRECT AND NO CORRECTIONS ARE NECESSARY AT THIS TIME</td>
    </tr>
</table>

<div class="page-break"></div>
{{--Page # 5  OK--}}
<div class="iconMargin">
    <img src="{{ asset('/img/contracts/logo_gray.png')}}" alt="" name="Object1" width="124" height="95" id="Object1" align="center">
    <br><i style="font-size:90%;">Giving the edge to Inventors!</i>
</div>
<h3><strong>INVENTOR PRODUCT AND BUSINESS PROFILE</strong></h3>
<table cellspacing="12">
    <tr>
        <th>INVENTOR NAME: {{$project->lead->fname." ".$project->lead->lname}} </th>
        <th>FILE NUMBER: {{$project->lead->fileno}}</th>
    </tr>
    <tr>
        <th colspan="2">INVENTION NAME: __________________________________________</th>
    </tr>
    <tr>
        <th colspan="2">INVENTION DETAILED DESCRIPTION:</th>
    </tr>
</table>
<br><br><br>
<p class="questions">Tell us when and how you thought of your invention:</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">How does your new invention WORK, OPERATE or FUNCTION?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">How is your new invention DIFFERENT from other similar ideas? <b>(Uniqueness)</b></p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">What similar product is on the market now? (Similar, but not the same)</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">What PROBLEM does your idea solve? What are the advantages and benefits of your idea\'s solution?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">How much will it cost to produce your idea?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>


<div class="page-break"></div>
{{--Page # 6  OK--}}
<p class="questions">How much will you sell it for?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">What technical field(s) does your project fall into?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">What companies, groups of people, products, processes or services could use your idea?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>

<p class="questions">What upgrades or modifications can you suggest to improve functionality, packaging, appeal, versatility, mechanics or affordability to a manufacturer or end user?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">Describe the environment (wet, dry, temperature, pressure, light, dark, etc.) in which your idea will function?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">If your idea is a "device", what does it consume or produce? And what powers it? (Manual, electricity, gasoline, sunlight, water power, batteries, etc.)</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<div class="page-break"></div>
{{--Page # 7  OK--}}
<h3 class="underline alignLeft"><strong>Inventor Profile:</strong></h3>
<table cellspacing="15" style="font-size: 14px;width: 100%;">
    <tr>
        <td class="trLine"><span class="spanProfile">Date of Birth:</span></td>
        <td class="trLine"><span class="spanProfile">Married (Y/N):</span></td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Spouse Name:</span></td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Children's Names:</span></td>
    </tr>
    <tr>
        <td class="trLine"><span class="spanProfile">College:</span> </td>
        <td class="trLine"><span class="spanProfile">Degree:</span> </td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Profession:</span></td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Hobbies:</span> </td>
    </tr>
</table>
<br>
<p class="questions">
    <strong>Any additional comments or information you wish to volunteer about yourself (inventor),any co-inventors or the invention:</strong>
</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
{{--Page # 8 OK --}}
<div class="page-break"></div>
<h3><strong>GRAPHIC ILLUSTRATION PAGE</strong></h3>
<p>
    Continue your description by hand sketching the major working parts of your invention. You can also attach
    pictures, technical drawings and other professionally prepared renditions of your idea to this page. When
    drawing, use dark lead pencils, black ink or firmly press on the graph sheet when sketching your idea. If you feel
    that your prior submitted artwork is sufficient, please write “REFER TO PREVIOUS DRAWING” across the graph
    page. <strong>If you have a prototype, please attach photos of your product idea.</strong>
</p>
<table align="center" class="show" style="width:100%">
    @for($i=0;$i<21;$i++)
        <tr align="center">
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
        </tr>
    @endfor
</table>
<br>
<h3 class="alignLeft"><strong>Drawing Notes/Comments:</strong> </h3>
<div class="rect notesTable"></div>