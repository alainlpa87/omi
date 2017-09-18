<div class="col-md-12  divContract">
    <p class="pLogo">
        <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
        <br><i>Giving the edge to Inventors!</i>
    </p>
    <p class="pTitle"><strong>@if($contract->iigUpgrade == 1)Invention Initiative Guide Upgrade Proposal @else Invention Initiative Guide Proposal
            <i style="color:green" class="fa fa-question-circle" data-toggle="tooltip" title="Innovation starts with an idea. And when this idea is pursued, it can be turned into an invention that has the potential of becoming a brand new product which can then be launched into the marketplace!

Sounds easy, right? In reality, it is not.

The process of taking an innovation from an idea to a marketable product takes time, effort and money. And, if caution is not exercised, you can end up with little, or even nothing. Proper research and evaluation will save you time, effort and money and often, heartbreak and disappointment.

The patent process itself is expensive and takes time, taking a product to market after getting a patent is even more expensive and takes, even more, time. So it is best to get as much information as possible before you push forward. In fact, experts strongly recommend that you start with a detailed patent search that MUST include a legal opinion and follow that with an OBJECTIVE evaluation of your invention idea for marketability.
"></i>@endif</strong></p>
    <br>
    <ul class="circle">
        <table width="90%">
            <tr>
                <td width="64%">&nbsp;</td>
                <td width="12%">&nbsp;</td>
                <td width="12%" style="text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong>MOST POPULAR</strong></td>
                <td width="12%">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: darkgray;"><strong>SILVER<br>{{money_format('%.0n', $prices->plan1)}}</strong></td>
                <td style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong>GOLD<br>{{money_format('%.0n', $prices->plan2)}}</strong></td>
                <td style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #ddd;"><strong>PLATINUM<br>{{money_format('%.0n', $prices->plan3)}}</strong></td>
            </tr>
            <tr>
                <td><li><strong>Detailed Product Description</strong></li></td>
                <td style="background-color: darkgray;" align="center"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;" align="center"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;" align="center"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td>
                    <li>
                        <b style="border: 1px solid;" id="hide_show_PoU" data-hide="1">Private or University Based Marketing Analysis &nbsp;&nbsp;<i class="fa fa-chevron-down" id="indicator_PoU" style="border-left: 1px solid;"></i></b>
                        <i style="color:green" class="fa fa-question-circle" data-toggle="tooltip" title="Our network of universities follows guidelines and criteria that were established by the PIES System.

PIES stands for “Preliminary Innovation Evaluation System” and was developed in 1974 with funding provided by the National Science Foundation. PIES is currently in its 12th edition which was implemented in October 2006. PIES uses 32 different criteria to evaluate the commercial potential of your invention idea; these criteria are based on years of research and new product experience and provide a risk profile of your project along with the detailed strategy that you can use to take your product to the marketplace. Additionally, a PIES evaluation also provides support for developing future strategies and planning as you move along the process.

Because of Conflict of Interest USPTO warns of patent marketing companies who conduct in house market evaluation.
"></i>
                        <ul class="chk_square hide" id="list_PoU">
                            <li>Social Factors</li>
                            <li>Business Risk Factors</li>
                            <li>Demand Analysis Factors</li>
                            <li>Market Acceptance Factors</li>
                            <li>Competitive Factors</li>
                        </ul>
                    </li>
                </td>
                <td style="background-color: darkgray;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td><li><b>Registered Attorney Patent Search & Legal Opinion</b>
                        <i style="color:green" class="fa fa-question-circle" data-toggle="tooltip" title="Will provide objective analysis and explanation of the previously issued patents prior art search result instead of leaving you to figure out what the results mean and whether you should move forward or not. Such a legal opinion can save you money and time by helping you decide whether it makes sense to apply for a patent for your invention idea or not.

Furthermore, if you decide to proceed with filing a patent application, the legal opinion can increase the chances of success and can also decrease the cost, effort & number of prosecutions by highlighting elements of your invention that are, indeed, patentable. Lastly, a legal opinion can also provide potential defense support in case of any lawsuits are brought against you in the future for patent infringement.

At Patent Services USA, all our patent searches carry the objective legal opinion of a licensed US Based patent attorney (who can practice at the USPTO) behind it.
"></i></li></td>
                <td style="background-color: darkgray;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td><li><b>Preliminary Patent Illustration</b></li></td>
                <td style="background-color: darkgray;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td><li><strong>Conclusion and Recommendation</strong></li></td>
                <td style="background-color: darkgray;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td>
                    <li>
                        <b style="border: 1px solid;" id="hide_show_InvStrat" data-hide="1">Investor Strategy Package &nbsp;&nbsp;<i class="fa fa-chevron-down" id="indicator_InvSt" style="border-left: 1px solid;"></i></b>
                        <ul class="chk_square hide" id="list_InvStrat">
                            <li>Pricing Strategies</li>
                            <li>Packaging Suggestions</li>
                            <li>Suggested Legal Protection</li>
                            <li>How To Beat Competitors</li>
                        </ul>
                    </li>
                </td>
                <td style="background-color: darkgray;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td><li><b>PowerPoint Momentum Tool<sup class="black">TM</sup></b>
                        <i style="color:green" class="fa fa-question-circle" data-toggle="tooltip" title="A software package designed to create electronic presentations consisting of 10 series of separate pages or slides about your invention idea. Can be used to show case your product to potential manufacturers and investors. "></i></li></td>
                <td style="background-color: darkgray;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td><li><strong>Manufacturing Consideration</strong></li></td>
                <td style="background-color: darkgray;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;"><div class="col-md-3 col-md-offset-3" ><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td><li><strong>Press Release</strong>
                        <i style="color:green" class="fa fa-question-circle" data-toggle="tooltip" title="A press release is a written communication directed at members of the news media for the purpose of announcing your patent pending invention to attract manufacture and investors attention and interest."></i></li></td>
                <td style="background-color: darkgray;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td><li><strong>2D Design</strong>
                        <i style="color:green" class="fa fa-question-circle" data-toggle="tooltip" title="Your 2-dimensional design enables you to see your product to take shape. Design professionals use your input to create the initial visual representation of your invention using sophisticated computer modeling software. This completed design can be used to provide further guidance to bonded patent drafting experts preparing patent illustrations as required by the USPTO. This drawing can also be used to introduce your new product to manufacturers and investors alike."></i></li></td>
                <td style="background-color: darkgray;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
                <td style="background-color: #FAEFA6;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/unchk_square.png')}}" alt=""></div></td>
                <td style="background-color: #ddd;"><div class="col-md-3 col-md-offset-3"><img src="{{asset('/img/chk_square.png')}}" alt=""></div></td>
            </tr>
            <tr>
                <td><li><strong>Investment Protection:</strong> Amount of IIG investment will be credited<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;towards FULL payment patent protection plan</li></td>
                <td style="text-align:center;vertical-align:middle;background-color: darkgray"><strong>{{money_format('%.0n', $prices->plan4)}}</strong></td>
                <td style="text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong>{{money_format('%.0n', $prices->plan5)}}</strong></td>
                <td style="text-align:center;vertical-align:middle;background-color: #ddd;"><strong>{{money_format('%.0n', $prices->plan6)}}</strong></td>
            </tr>
            <tr>
                <td width="64%">&nbsp;</td>
                <td width="12%">&nbsp;</td>
                <td width="12%">&nbsp;</td>
                <td width="12%">&nbsp;</td>
            </tr>
            <tr>
                <td width="64%"><strong style="float: right;color: red">Select your package: &nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
                <td width="12%" style="text-align:center;vertical-align:middle;"> @if($contract->iigUpgrade == 1) &nbsp; @else <input type="checkbox" id="planSilver" name="planSilver" class="plansIig" checked data-val="{{$prices->plan1}}"> @endif</td>
                <td width="12%" style="text-align:center;vertical-align:middle;"> @if($contract->iigUpgrade == 1 && $contract->paid >= $prices->plan2) &nbsp; @else @if($contract->iigUpgrade == 1) <input type="checkbox" id="planGold" name="planGold" class="plansIig" data-val="{{$prices->plan2}}"> @else<input type="checkbox" id="planGold" name="planGold" class="plansIig" data-val="{{$prices->plan2}}"> @endif @endif</td>
                <td width="12%" style="text-align:center;vertical-align:middle;"><input type="checkbox" id="planPlatinum" name="planPlatinum" class="plansIig" data-val="{{$prices->plan3}}"></td>
            </tr>
        </table>
    </ul>
    @if($contract->iigUpgrade == 1) <p class="pPrice">Total Price: $<span id="tPrice"></span></p> @else <p class="pPrice">Total Price: $<span id="tPrice">{{$prices->plan1}}</span></p> @endif
    <input type="hidden" name="hidden_paid" id="hidden_paid" value="{{$contract->paid}}">
    <input type="hidden" name="hidden_iigUpgrade" id="hidden_iigUpgrade" value="{{$contract->iigUpgrade}}">

    <input type="hidden" name="hidden_price" id="hidden_price">

    <div align="center" style="padding:15px;">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <strong>Legal Disclosure and Information</strong>
        </button>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="well">
            <ol>
                <li>
                    <p class="par1">
                        This proposal is made between PATENT SERVICES USA, Inc. (PATENT SERVICES) and all Inventors named herewith (The Inventor)
                        in order to execute this Invention Initiative Guide Proposal (the agreement) for the Invention Initiative Guide outlined on
                        the reverse side of this page.
                    </p>
                </li>
                <li>
                    <p class="par1">
                        This agreement does not execute a patent application, does not provide patent protection of any kind
                        and does not substitute for the legal advice of a registered patent attorney.  The Inventor
                        understands that all patent searches and legal opinions are provided by our affiliate Registered Patent
                        Attorneys.  We may utilize one or more Registered Patent Attorneys to expedite all patent searches.  The
                        search is a thorough search of files on record at the United States Patent and Trademark Office.  The
                        Inventor authorizes PATENT SERVICES to provide the results of the patent search and legal opinion from
                        any and all Registered Patent Attorneys as part of the Invention Initiative Guide.  The Inventor acknowledges that
                        PATENT SERVICES will deliver the services outlined in this agreement within a six (6) to eight (8) week
                        timeframe, which constitutes a reasonable amount of time for scheduling attorneys, draftsmen,
                        production personnel and other factors beyond any control of PATENT SERVICES.
                    </p>
                </li>
                <li>
                    <p class="par1">
                        Invention and new product innovation involves a high degree of risk.  Inventor agrees that a
                        patent is the most secure form of legal protection for a new invention.  Only a small percentage of inventions
                        become commercially successful.  PATENT SERVICES does not make any promises, claims or guarantees that an
                        invention will ever make a profit, have commercial success, any positive results or result in any kind of financial
                        gain.
                    </p>
                </li>
                <li>
                    <p class="par1">
                        This Invention Initiative Guide Proposal represents the entire agreement between all parties, whether written, verbal,
                        expressed or implied.  Any and all other agreements or suggestions are void.  This agreement shall not be modified
                        without the expressed written approval of PATENT SERVICES and at least one authorized officer or representative.
                        This agreement is not a release of any material submitted to PATENT SERVICES without the expressed written consent
                        of the inventor.
                    </p>
                </li>
                <li>
                    <p class="par1">
                        The Inventor shall not, nor shall attempt to circumvent or bypass the activities of PATENT SERVICES by negotiating
                        directly or indirectly with any prospective patent assistance service providers without the express written permission
                        of the PATENT SERVICES Any attempt by the INVENTOR to circumvent or bypass the activities of the PATENT SERVICES
                        shall be construed as a material breach in violation of this Section and shall trigger the termination of this Agreement
                        without any recourse whatsoever by INVENTOR.
                    </p>
                </li>
                <li>
                    <p class="par1">
                        The Inventor acknowledges PATENT SERVICES does not engage in the business of invention development or marketing services.
                        No inventors have received a net financial profit as a result of PATENT SERVICES.  No inventors have contracted with
                        PATENT SERVICES for invention promotion services during the past five (5) years.  PATENT SERVICES does not perform
                        market evaluations or give opinions of marketing potential on any invention submitted for review.  PATENT SERVICES has
                        no customers that purchase marketing promotion services.  No inventors have received licensing agreements for their inventions
                        as a direct result of any invention promotion services through PATENT SERVICES.  In the past 10 years, the officers of
                        PATENT SERVICES, either individually or collectively, assisted Global Licensing Partners in its efforts to research
                        inventions.  PATENT SERVICES only provides patent assistance services and informational materials related to the invention
                        industry.
                    </p>
                </li>
                <li>
                    <p class="par1">
                        All disputes concerning the understanding, meaning or interpretation of any and all parts of this agreement,
                        including the rights, duties, relationships or obligations of either party under this agreement shall be settled
                        through the American Arbitration Association (AAA), in the county of Miami-Dade, State of Florida, in accordance
                        with all rules and regulations.  All claims must be made within three (3) months of occurrence.  The Inventor agrees
                        to indemnify and hold harmless PATENT SERVICES and its affiliates, employees, contractors, successors and
                        assigns, including, all Registered Patent Attorneys from any and all claims which might be raised by any third
                        party for any reason relating to the invention or the services provided by PATENT SERVICES, including,
                        but not limited to, any claim of infringement of intellectual property (copyright, trademark and patent) relating
                        to the inventions as a result of the use contemplated herein of the inventions, in any form submitted by Inventor
                        to PATENT SERVICES
                    </p>
                </li>
                <li>
                    <p class="par1">
                        All information contained in this and all other documents are proprietary and the exclusive property of
                        PATENT SERVICES, which reserves all rights.  All proprietary information and property is protected
                        by Trademark and Copyright.
                    </p>
                </li>
                <li>
                    <p class="par1">
                        The Inventor acknowledges their consent to this Agreement via Electronic Signature. This agreement and any counterparts to
                        this agreement will be deemed an original. To expedite the process of entering into this Agreement, the Inventor acknowledges
                        that Electronic Transmissions of the Agreement will be equivalent to original documents. “Electronic Transmission" will mean
                        copies that are reproduced or transmitted as complete and accurate reproductions and transmissions of this original.
                    </p>
                </li>
                <li>
                    <p class="par1">
                        The Invention Initiative Guide contains a Market Analysis which may result in a negative outcome.  The Inventor has
                        a seven (7) calendar day right of rescission from the signature date of the agreement to cancel for a refund.  The
                        cancellation request must be received at our corporate headquarters located at 12000 Biscayne Boulevard, Suite 700 North
                        Miami, FL 33181, via certified mail only.  Due to work scheduling of attorneys, draftsmen, production personnel and other
                        factors beyond any control, PATENT SERVICES reserves the first right to refuse all refund requests after the seven (7)
                        calendar day rescission period stated above.
                    </p>
                </li>
            </ol>
        </div>
    </div>
    <div class="tableSign" style="visibility: hidden;">
        <div class="col-md-12 col-xs-12">
            <p>
                Client Authorization:<br>
                By signing below, I agree to all terms and conditions outlined in this Invention Initiative Guide Proposal.
            </p>
        </div>
        <div class="col-md-12 col-xs-12">
            <div class="col-md-3 col-xs-12">
                <input type="text" id="inventor_name" class="form-control inputTableSign" placeholder="Inventor Full Name" value="test">
            </div>
            <div class="col-md-3 col-xs-12">
                <div class='input-group date' id='inventor_date'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <input type="text" id="coinventor_name" class="form-control inputTableSign"  placeholder="Co-Inventor Full Name">
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="form-group">
                    <div class='input-group date' id='coinventor_date'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="agree" style="visibility: hidden;">
        <input type="checkbox" id="chk" checked><label class="labelAgree" for="chk">&nbsp;I Agree</label>
        <a style="color: red" id="seeLink">See Legal Disclosure and Information</a>
    </p>
    <div class="divRepresentative">
        <br>
        <strong class="tam14">Authorized PATENT SERVICES USA Representative:</strong>
        Rick Blake
    </div>
    <div align="center" style="margin-top:6px; margin-bottom: 10px;" class="shadow">
        12000 Biscayne Boulevard, Suite 700 / North Miami, FL 33181 Phone: 1-877-652-4908 / Fax: 1-800-886-7951
    </div>
</div>