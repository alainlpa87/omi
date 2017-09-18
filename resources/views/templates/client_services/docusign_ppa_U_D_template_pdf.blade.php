<link href="{{ asset('/css/pdf.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
@if(setlocale(LC_MONETARY, 'en_US'))
    @endif
            <!--page 1-->
    <p class="iconMargin">
        <img src="{{ asset('/img/logo.png') }}" alt="" name="Object1" width="200" height="150" id="Object1" align="center">
        <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>
<h1 style="margin-left: 35%"><strong>PATENT PROTECTION AGREEMENT</strong></h1>

    <p class="pSmall">
        <strong>THIS PATENT PROTECTION AGREEMENT</strong>, (hereinafter, the "Agreement") entered into and effective as of
        the day of <span class="subTitle">{{((isset($project) && ($project->getProjectProduction() != null)))?date("F jS\, Y",strtotime($project->getProjectProduction()->shippingDate)):date("F jS\, Y")}}</span>
        ("Effective Date") by and between <strong>PATENT SERVICES USA, INC.</strong>, a Florida Corporation
        (hereinafter, the "Patent Services USA, INC.") and <span class="subTitle">{{isset($project)?$project->lead->fname." ".$project->lead->lname:"Client's Name"}}</span>
        an Individual (hereinafter, the "INVENTOR").
    </p>
    <p class="subTitle iconMargin" align="center"><strong>TERMS OF AGREEMENT</strong></p>
    <p class="pSmall">
        INVENTOR represents that he is the inventor and further represents that he is the exclusive owner of all rights, titles and interests to said invention, the <span class="subTitle">{{isset($project)?$project->ideaName:"INVENTION NAME"}}</span> (hereinafter, "Invention"); and
    </p>
    <p class="pSmall">
        Patent Services USA, Inc. is a clearinghouse for inventors which provides referrals to outside independent contractors including but not limited to draftsmen, artists, writers, colleges, universities, private market evaluators and independent registered patent attorneys who may be able to assist the inventors in taking their inventions to the market. All direct communication with the United States Patent and Trademark Office (hereinafter "USPTO"), whether written, verbal, electronic, digital, and in any other form whatsoever is performed through independent attorneys, registered patent attorneys and/or agents.
    </p>
    <p class="pSmall">
        INVENTOR wishes to obtain patent protection assistance and Patent Services USA, Inc. wishes to provide INVENTOR with patent protection assistance services for the Invention as set forth herein; and
    </p>
    <p class="pSmall">
        In consideration of the mutual promises and agreements as set forth herein and for other good and valuable consideration, the receipt and sufficiency of which are hereby acknowledged, the parties intending to be legally bound, do hereby agree that the foregoing Agreements are incorporated herein by reference and made a part hereof as though set forth at length throughout this Agreement and do further agree as follows:
    </p>

    <ol class="pSmall">
        <li>
            <strong>Appointment of Patent Services USA, Inc.</strong> INVENTOR hereby engages Patent Services USA, Inc. to provide the patent protection assistance for the Invention.
            <ol class="pSmall" type="none">
                <li>
                    <strong>1.1 Various Patent Protection Services.</strong> Patent Services USA, Inc. provides six (6) Patent Protection Plans which are particularly described in Section 3. INVENTOR agrees and acknowledges Patent Services USA, Inc. has provided all necessary disclosures to the INVENTOR as provided under 35 U.S.C. 297 (a) in the Invention Initiative Guide Agreement which has been previously executed by INVENTOR.
                </li>
            </ol>
        </li>
        <li>
            <strong>Term.</strong> The initial term of this Agreement (the "Initial Term") shall commence on the Effective Date and shall continue for a period of twenty-four (24) months unless terminated earlier or extended as provided herein.
        </li>
        <li>
            <strong>Plan Fee.</strong> INVENTOR hereby agrees to make payments to Patent Services USA, Inc. as indicated in Section 3 in accordance with the plan(s) selected by the INVENTOR in Section 3.  All payments will be made in U.S. Dollars and shall be due upon signing of this Agreement. The provisions of Exhibit A, relating to payment services and schedule shall be incorporated herein by reference and the services to be rendered by Patent Services USA, Inc. shall be offered in accordance with the provisions of Exhibit A and plan(s) selected by the INVENTOR in Section 3. If there is any conflict in connection with the services to be rendered by Patent Services USA, Inc. as stated in Section 3 and Exhibit A, then the provisions of Exhibit A shall control.
        </li>
        <br><br><br><br><br><br><br><br><br>
        <table width="99%">
            <tr>
                <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
                <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
            </tr>
        </table>
        <div class="page-break"></div>
        <ol class="pSmall" type="none">
            <li>
                <strong>3.1 SERVICE PLAN DESCRIPTIONS.</strong> INVENTOR acknowledges that INVENTOR understands all terms and benefits offered in the plan(s) selected below:
                <ol class="pSmall" type="none">
                    <li>
                        <strong>3.1.1. PLAN 1 – UNITED STATES UTILITY PATENT APPLICATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{money_format('%(#10n', $contract->ppaPrices()->plan1)}}<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROGRAM</strong>
                        <ol class="pSmall" type="none">
                            <li>
                                <strong>3.1.1.1.</strong> Patent Services USA, Inc. will facilitate and coordinate the documentation and filing of United States Nonprovisional (Utility) Patent Application process by working with the INVENTOR and independent registered patent attorney and/or independent patent agent regarding the patent application process. Patent Services USA, Inc. shall pay the United States Utility patent application filing fee.
                            </li>
                            <li>
                                <strong>3.1.1.2.</strong> Patent Services USA, Inc. will facilitate and coordinate the Technical Illustration of United States Utility Patent Application by working with the INVENTOR and independent professional patent illustrator regarding the Technical Illustrations.
                            </li>
                            <li>
                                <strong>3.1.1.3.</strong> Patent Services USA, Inc. shall use best efforts to engage an Independent Licensing Affiliate (hereinafter "ILA") to schedule six (6) to eight (8) national and/or international invention trade shows every twelve (12) months for a period of two (2) years, attended by ILA as explained in Exhibit B of this Agreement, which is incorporated herein by reference.
                            </li>
                            <li>
                                <strong>3.1.1.4.</strong> The INVENTOR's invention shall be posted on the website(s) of the ILA for a period of two (2) years, at the sole discretion of the ILA.
                            </li>
                            <li>
                                <strong>3.1.1.5.</strong> Patent Services USA, Inc. shall engage a Computer Animation Specialist who will design a three-dimensional animated prototype video, sell sheet and 3D-printed model (if applicable) for the INVENTOR's invention. This design package will be used by the ILA in connection with rendering the services of ILA as explained in Exhibit A of this Agreement.
                            </li>
                            <li>
                                <strong>3.1.1.6.</strong> Throughout the term of this Agreement, Patent Services USA, Inc. shall provide customer service support to INVENTOR in connection with the progress of its services as stated herein.
                            </li>
                        </ol>
                    </li>
                    <li>
                        <strong>3.1.2. PLAN 2 – UNITED STATES DESIGN PATENT APPLICATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{money_format('%(#10n', $contract->ppaPrices()->plan2)}}<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROGRAM</strong>
                        <ol class="pSmall" type="none">
                            <li>
                                <strong>3.1.2.1.</strong> Patent Services USA, Inc. will facilitate and coordinate the documentation and filing of United States Design Patent Application process by working with the INVENTOR and independent registered patent attorney and/or independent patent agent regarding the patent application process. Patent Services USA, Inc. shall pay the United States Design patent application filing fee.
                            </li>
                            <li>
                                <strong>3.1.2.2.</strong> Patent Services USA, Inc. will facilitate and coordinate the Technical Illustration of United States Design Patent Application by working with the INVENTOR and independent professional patent illustrator regarding the Technical illustrations [up to seven (7) different viewpoints including front, back, left, right, top, bottom and 3-sided perspective].
                            </li>
                            <li>
                                <strong>3.1.2.3.</strong> Patent Services USA, Inc. shall engage a Computer Animation Specialist who will design a three-dimensional, animated prototype video, sell sheet and 3D printed model (if applicable) for the INVENTOR's invention.
                            </li>
                            <li>
                                <strong>3.1.2.4.</strong> Throughout the term of this Agreement, Patent Services USA, Inc. shall provide customer service support to INVENTOR in connection with the progress of its services as stated herein.
                            </li>
                        </ol>
                    </li>
                    <li>
                        <strong>3.1.3. PLAN 3 - UNITED STATES TRADEMARK APPLICATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{money_format('%(#10n', $contract->ppaPrices()->plan3)}}<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROGRAM</strong>
                        <ol class="pSmall" type="none">
                            <li>
                                <strong>3.1.3.1.</strong> Patent Services USA, Inc. will facilitate and coordinate the documentation relating to trademark search by working with the INVENTOR and an independent registered patent attorney or agent. Patent Services USA, Inc. shall pay the United States Trademark filing fee.
                            </li>
                            <li>
                                <strong>3.1.3.2.</strong> Based on the results of the trademark search and upon INVENTOR's approval, Patent Services USA, Inc. will facilitate and coordinate the documentation relating to trademark application with the INVENTOR and an independent attorney.
                            </li>
                            <li>
                                <strong>3.1.3.3.</strong> Throughout the term of this Agreement, Patent Services USA, Inc. shall provide customer service support to INVENTOR in connection with the progress of its services as stated herein.
                            </li>
                        </ol>
                    </li>
                    <li>
                        <strong>3.1.4. PLAN 4 - UNITED STATES COPYRIGHT APPLICATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{money_format('%(#10n', $contract->ppaPrices()->plan4)}}<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROGRAM</strong>
                        <ol class="pSmall" type="none">
                            <li>
                                <strong>3.1.4.1.</strong> Patent Services USA, Inc. will facilitate and coordinate the documentation relating to copyright search by working with the INVENTOR and an independent registered patent attorney or agent. Patent Services USA, Inc. shall pay the United States Copyright filing fee.
                            </li>
                            <li>
                                <strong>3.1.4.2.</strong> Based on the results of the copyright search and upon INVENTOR's approval, Patent Services USA, Inc. will facilitate and coordinate the documentation relating to copyright application with the INVENTOR and an independent attorney.
                            </li>
                            <br><br>
                            <table width="99%">
                                <tr>
                                    <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
                                    <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
                                </tr>
                            </table>
                            <div class="page-break"></div>
                            <li>
                                <strong>3.1.4.3.</strong> Throughout the term of this Agreement, Patent Services USA, Inc. shall provide customer service support to INVENTOR in connection with the progress of its services as stated herein.
                            </li>
                        </ol>
                    </li>
                    <li>
                        <strong>3.1.5. PLAN 5 – EUROPEAN UNION DESIGN PATENT APPLICATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{money_format('%(#10n', $contract->ppaPrices()->plan5)}}<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROGRAM</strong>
                        <ol class="pSmall" type="none">
                            <li>
                                <strong>3.1.5.1.</strong> Patent Services USA, Inc. will facilitate and coordinate the documentation and filling of European Union Community Design Patent Application process by working with the INVENTOR and independent registered patent attorney regarding the patent application process. Patent Services USA, Inc. shall pay the European Union Design patent application filing fee.
                            </li>
                            <li>
                                <strong>3.1.5.2.</strong> Patent Services USA, Inc. will facilitate and coordinate the Technical Illustration of European Union Community Design Patent Application by working with the INVENTOR and independent professional patent illustrator regarding the Technical Illustrations [up to seven (7) different viewpoints including front, back, left, right, top, bottom and 3-sided perspective].
                            </li>
                            <li>
                                <strong>3.1.5.3.</strong> Patent Services USA, Inc. shall use best efforts to engage an Independent Licensing Affiliate (hereinafter and as defined above "ILA") to schedule six (6) to eight (8) national and/or international invention trade shows every twelve (12) months for a period of two (2) years, attended by ILA as explained in Exhibit B of this Agreement, which is incorporated herein by reference.
                            </li>
                            <li>
                                <strong>3.1.5.4.</strong> The INVENTOR's invention shall be posted on the website(s) of the ILA for a period of two (2) years, at the sole discretion of the ILA.
                            </li>
                            <li>
                                <strong>3.1.5.5.</strong> Patent Services USA, Inc. shall engage a Computer Animation Specialist who will design a three-dimensional animated prototype video, sell sheet and 3D-printed model (if applicable) for the INVENTOR's invention. This design package will be used by the ILA in connection with rendering the services of ILA as explained in Exhibit A of this Agreement.
                            </li>
                            <li>
                                <strong>3.1.5.6.</strong> Throughout the term of this Agreement, Patent Services USA, Inc. shall provide customer service support to INVENTOR in connection with the progress of its services as stated herein.
                            </li>
                        </ol>
                    </li>
                    <li>
                        <strong>3.1.6. PLAN 6 – PATENT COOPERATION TREATY <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(HEREINAFTER "PCT") PROGRAM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{money_format('%(#10n', $contract->ppaPrices()->plan6)}}</strong>
                        <ol class="pSmall" type="none">
                            <p>
                                The PCT is an international treaty administered by the World Intellectual Property Organization, between more than 152 countries (International Patent Cooperation Union).
                            </p>
                            <li>
                                <strong>3.1.6.1.</strong> Patent Services USA, Inc. will facilitate and coordinate the necessary documentation by working with the INVENTOR and independent registered patent attorney regarding the PCT application filing. Patent Services USA, Inc. shall pay the PCT application filing fee. Inventor will be responsible to pay fees to each country from which he or she wishes to receive patent protection.
                            </li>
                            <li>
                                <strong>3.1.6.2.</strong> Patent Services USA, Inc. shall use best efforts to engage an Independent Licensing Agent (hereinafter and as defined above, "ILA") to schedule six (6) to eight (8) national and/or international invention trade shows every twelve (12) months for a period of two (2) years, attended by ILA as explained in Exhibit B of this Agreement, which is incorporated herein by reference.
                            </li>
                            <li>
                                <strong>3.1.6.3.</strong> The INVENTOR's invention shall be posted on the website(s) of the ILA for a period of two (2) years, at the sole discretion of the ILA.
                            </li>
                            <li>
                                <strong>3.1.6.4.</strong> Patent Services USA, Inc. shall engage a Computer Animation Specialist who will design a three-dimensional animated prototype video, sell sheet and 3D printed model (if applicable) for the INVENTOR's invention. This design package will be used by the ILA in connection with rendering the services of ILA as explained in Exhibit A of this Agreement.
                            </li>
                            <li>
                                <strong>3.1.6.5.</strong> Throughout the term of this Agreement, Patent Services USA, Inc. shall provide customer service support to INVENTOR in connection with the progress of its services as stated herein.
                            </li>
                        </ol>
                    </li>
                </ol>
            </li>
            <br><br><br><br><br><br><br><br>
            <table width="99%">
                <tr>
                    <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
                    <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
                </tr>
            </table>
            <div class="page-break"></div>

            <p align="center" style="font-size: 26px !important;"><b>DISCOUNTED  PACKAGES</b></p>
            <p align="center" style="font-size: 20px !important;color: red !important;">COMBINE PLANS AND SAVE</p>
            <p align="center" style="font-size: 15px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="">&nbsp;<b>PKG A - {{money_format('%(#10n', $contract->ppaPrices()->plan7)}}</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 1 - UNITED STATES UTILITY PATENT APPLICATION PROGRAM</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 2 - UNITED STATES DESIGN PATENT APPLICATION PROGRAM</b></p>
            <p align="center" style="font-size: 15px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="" >&nbsp;<b>PKG B - {{money_format('%(#10n', $contract->ppaPrices()->plan8)}}</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 1 - UNITED STATES UTILITY PATENT APPLICATION PROGRAM</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 5 - EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM</b></p>
            <p align="center" style="font-size: 15px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="" >&nbsp;<b>PKG C - {{money_format('%(#10n', $contract->ppaPrices()->plan9)}}</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 1 - UNITED STATES UTILITY PATENT APPLICATION PROGRAM</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 2 - UNITED STATES DESIGN PATENT APPLICATION PROGRAM</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 5 - EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM</b></p>
            <p align="center" style="font-size: 15px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="" >&nbsp;<b>PKG D - {{money_format('%(#10n', $contract->ppaPrices()->plan10)}}</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 1 - UNITED STATES UTILITY PATENT APPLICATION PROGRAM</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 2 - UNITED STATES DESIGN PATENT APPLICATION PROGRAM</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 6 - PATENT COOPERATION TREATY (HERINAFTER "PCT")</b></p>
            <p align="center" style="font-size: 15px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="">&nbsp;<b>PKG E - {{money_format('%(#10n', $contract->ppaPrices()->plan11)}}</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 1 - UNITED STATES UTILITY PATENT APPLICATION PROGRAM</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 2 - UNITED STATES DESIGN PATENT APPLICATION PROGRAM</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 5 - EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM</b></p>
            <p align="left" style="font-size: 15px !important;"><b>PLAN 6 - PATENT COOPERATION TREATY (HERINAFTER "PCT") PROGRAM</b></p>
            <p align="center" style="font-size: 20px !important;color: red !important;">ADDITIONAL DISCOUNTS</p>
            <p align="left" style="font-size: 15px !important;"><b>ADD US TRADEMARK AND US COPYRIGHT APPLICATION PROGRAMS <br>
                    TO ANY OF THE ABOVE PACKAGES FOR ONLY &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; {{money_format('%(#10n', $contract->ppaPrices()->plan12)}}</b></p>

            <br>
        <table width="99%">
            <tr>
                <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
                <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
            </tr>
        </table>
        <div class="page-break"></div>
        <li>
            <strong>3.2</strong> Notwithstanding any other provision of this agreement, the INVENTOR expressly agrees that the independent registered patent attorney engaged by Patent Services USA, Inc. shall work on matters in connection with the utility patent application and related non-final office actions with the United States Patent and Trademark Office (hereinafter "USPTO") as stated herein. In the event that there is a final rejection of such nonprovisional (utility) patent application then the independent registered patent attorney shall provide his or her recommendation to the INVENTOR's file to either proceed with: (1) the request for continued examination (hereinafter "RCE"), which shall not include a continuation application, divisional application and/or continuation-in-part application; (2) a design patent application for any subject matter within the utility application capable of protection under a design patent or (3) an appeal of the final rejection based upon the current status of the pending claims. INVENTOR shall pay any applicable fee if independent registered patent attorney recommends proceeding with RCE and Patent Services USA, Inc. shall pay the filing fee if the independent registered patent attorney recommends proceeding with the design patent application. Patent Services USA, Inc. shall not pay the applicable fee if independent registered patent attorney recommends proceeding with an appeal. Patent Services USA, Inc. will not be liable for maintenance fees required by the USPTO nor will it be responsible to pay issuance fees or publication fees. Patent Services USA, Inc. will only follow the independent registered patent attorney's recommendation to the INVENTOR's file.
        </li>
        <p>
            <strong>
                IT IS HEREBY AGREED THAT INVENTOR SHALL NOT BE HELD RESPONSIBLE FOR ANY ADDITIONAL EXPENSES INCURRED OR ASSESSED BY PATENT SERVICES USA, INC. OTHER THAN THOSE STATED IN THIS AGREEMENT IN CONNECTION WITH THE ATTORNEYS' FEES, ANY USPTO FEES, OR ANY OTHER FEES OR COSTS WITHIN OR BEYOND THE SCOPE OF THIS AGREEMENT.
            </strong>
        </p>
        <li>
            <strong>3.3</strong> Execution of the services covered by this Agreement is contingent upon strikes, accidents, delays of carriers, delays of delivery, delays of personnel or other causes unavoidable or beyond the control of Patent Services USA, Inc. If the performance of this Agreement or any obligation under this Agreement is prevented, restricted, or interfered with by causes beyond either party's reasonable control ("force majeure"), and if the party is unable to carry out its obligations and gives the other party prompt written notice of such event, then the obligations of the party invoking this provision shall be suspended to the extent necessary by such event. The term force majeure shall include, without limitation, acts of god, fire, explosion, vandalism, storm or other similar occurrence, orders or acts of military or civil authority, or by national emergencies, insurrections, riots, wars, supplier failures, shortages, breaches, or delays. The excused party shall use reasonable efforts under the circumstances to avoid or remove such causes of non-performance and shall proceed to perform with reasonable dispatch whenever such causes are removed or ceased. An act or omission shall be deemed within the reasonable control of a party if committed, omitted, or caused by such party, or its employees, officers, agents, or affiliates.
        </li>
    </ol>
    <li>
        <strong>Title.</strong> Title to the Inventions will be and shall remain vested with the INVENTOR.
    </li>
    <li>
        <strong>Warranty and Indemnity.</strong> INVENTOR shall indemnify and hold harmless Patent Services USA, Inc. and any third party contractor or subcontractor and each of their owners, officers, managers, members, shareholders, partners, contractors, employees and directors, from and against any claim of infringement of Intellectual Property (copyright, trademark and patent) relating to the Inventions as a result of the use contemplated herein of the Inventions, in any form submitted by INVENTOR to Patent Services USA, Inc.  INVENTOR shall indemnify and hold harmless Patent Services USA, Inc., and any third party sublicensee, and each of their owners, officers, managers, members, shareholders, partners, contractors, employees and directors against all claims, obligations or liabilities including court costs and attorneys' fees, arising out of the INVENTOR's tortious or unauthorized acts, misrepresentations, omissions, failure to perform his/her obligations hereunder, breach, or any acts not expressly authorized in writing, related to or beyond the scope of this Agreement.
    </li>
    <li>
        <strong>Confidentiality.</strong> Each party agrees that during the term of this Agreement and thereafter (a) it will use Confidential Information belonging to the other party solely for the purpose(s) for which it was disclosed hereunder and (b) it will not disclose Confidential Information belonging to the other party to any third party (other than its employees and/or professional advisors on a need-to-know basis who are bound by obligations of nondisclosure and limited use at least as stringent as those contained herein).  The parties further agree that except as necessary to perform their respective obligations hereunder or otherwise expressly required by law, they will not publicly announce or otherwise disclose any of the terms and conditions of this Agreement. In the event either party is requested or ordered by a court of competent jurisdiction to disclose Confidential Information belonging to the other party, such party will give the other party immediate notice of such request or order and, at the other party's request and expense, resist such a request or order to the fullest extent permitted by law. Each party will promptly return to the other upon request any or all Confidential Information of the other then in its possession or under its control. The provisions of this Section 6 will survive any termination of this Agreement.
    </li>
    <br><br><br>
    <table width="99%">
        <tr>
            <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
            <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
        </tr>
    </table>
    <div class="page-break"></div>
        <li>
            <strong>Relationship of Parties.</strong>
            <ol style="list-style-type: none;">
                <li>
                    <strong>7.1.</strong> This Agreement and the relations established hereby between INVENTOR and Patent Services USA, Inc. do not constitute a partnership, joint venture, or similar endeavor between INVENTOR and Patent Services USA, Inc. nor does it constitute a contract of employment. Each party will act under this Agreement as an independent party and independent contractor and not as the employee of the other party and that each party retains sole and absolute discretion in the manner and means of carrying out the services described herein.
                </li>
                <li>
                    <strong>7.2.</strong> Patent Services USA, Inc will act as your agent in communication with attorneys retained on INVENTOR's behalf and all those communications shall remain confidential with attorney as though attorney was communicating with INVENTOR personally. Patent Services USA, Inc shall not direct, regulate or interfere with the patent attorney's professional judgment in rendering his/her legal opinion.
                </li>
                <li>
                    <br>
                    This Agreement shall not be construed as a partnership or joint venture and neither party hereto shall be liable for any obligations incurred by the other party except as expressly provided herein.
                </li>
            </ol>
        </li>
    <li>
        <strong>Further Warranties and Representations of INVENTOR.</strong> The INVENTOR warrants and represents the following:
        <ol class="pSmall" type="none">
            <li>
                <strong>8.1.</strong> The INVENTOR hereby warrants that INVENTOR is the exclusive owner of the Invention. This Agreement has been duly authorized, executed and delivered by INVENTOR and, assuming due authorization, execution and delivery by INVENTOR, constitutes the legal, valid and binding obligation of INVENTOR enforceable against INVENTOR in accordance with its terms.
            </li>
            <li>
                <strong>8.2.</strong> The INVENTOR further warrants that no contract to which the INVENTOR is a party prevents it from concluding this transaction, nor is the consent of any third party, not otherwise mentioned herein required therefore neither the entering into nor the delivery of this Agreement nor the completion of the transaction contemplated herein will result in the violation of any contract to which INVENTOR is a party or by which INVENTOR is bound, or any applicable law.
            </li>
            <li>
                <strong>8.3.</strong> The INVENTOR shall not, nor shall it attempt to circumvent or bypass the activities of Patent Services USA, Inc. by negotiating directly or indirectly with any prospective Patent Services USA, INC. service providers without the express written permission of the Patent Services USA, Inc. Any attempt by the INVENTOR to circumvent or bypass the activities of the Patent Services USA, Inc. shall be construed as a material breach in violation of this Section and shall trigger the termination of this Agreement without any recourse whatsoever by INVENTOR.
            </li>
            <li>
                <strong>8.4.</strong> That upon request of Patent Services USA, Inc., the INVENTOR shall provide Patent Services USA, Inc., or its nominees, all information related to the Invention.
            </li>
            <li>
                <strong>8.5.</strong> The INVENTOR shall defend, at its own expense, all infringement actions that may be brought against it, or Patent Services USA, Inc., or Patent Services USA, Inc.'s contractors or subcontractors, based upon or related to the manufacture, use or sale of the invention.
            </li>
            <li>
                <strong>8.6.</strong> The INVENTOR expressly agrees and acknowledges that the INVENTOR shall timely provide any and all information including but not limited to specimens, descriptions or other details required to file an application with USPTO pursuant to the plan selected by the INVENTOR and that it is agreed by the INVENTOR that Patent Services USA, Inc. shall not pay any additional costs or fees in connection with any delays caused by the INVENTOR in submitting information requested by Patent Services USA, Inc.,  It is expressly agreed by the INVENTOR if an extension has to be filed with USPTO in connection with a pending application of the INVENTOR due to delay caused by the INVENTOR then the INVENTOR shall pay all additional costs or fees to proceed with such pending application.
            </li>
            <li>
                <strong>8.7.</strong> The INVENTOR expressly agrees that the INVENTOR shall keep all contact information including but not limited to addresses, phone numbers, email addresses current with Patent Services USA, Inc. during the Term of this Agreement or any renewal thereof. It is hereby acknowledged by the INVENTOR that Patent Services USA, Inc. shall send correspondence pursuant to the provisions of this Agreement to the INVENTOR through electronic communication at the email address provided by the INVENTOR to Patent Services USA, Inc.
            </li>
        </ol>
    </li>
    <li>
        <strong>Warranties and Representations of Patent Services USA, Inc.</strong> Patent Services USA, Inc. warrants and represents the following:
        <ol class="pSmall" type="none">
            <li>
                <strong>9.1.</strong> Neither the entering into nor the delivery of this Agreement nor the completion of the transaction contemplated hereby by Patent Services USA, Inc. will result in the violation of any contract to which Patent Services USA, Inc. is a party or by which Patent Services USA, Inc. is bound.
            </li>
            <li>
                <strong>9.2.</strong> Patent Services USA, Inc. and its personnel shall comply with all applicable statutes, rules and regulations governing all aspects of the services to be performed under this Agreement.
            </li>
            <li>
                <strong>9.3.</strong> Patent Services USA, Inc. shall use its best efforts to provide the services as set forth herein and to otherwise exercise the rights granted pursuant to this Agreement.
            </li>
            <li>
                <strong>9.4.</strong> Patent Services USA, Inc. is not a law firm and does not provide legal advice or legal opinion. Patent Services USA, Inc. shall engage independent registered patent attorneys and/or patent agents to assist in certain matters relating to the services described herein.  These patent services will include up to three (3) actions in an attempt to resolve patent application modifications or rejections through USPTO and/or any patent examiner as deemed necessary by an independent registered patent attorney.  Any further actions required in connection with the Invention other than those stated in Section 9.4 shall be the sole responsibility of the INVENTOR.
            </li>
            <br><br>
            <table width="99%">
                <tr>
                    <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
                    <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
                </tr>
            </table>
            <div class="page-break"></div>
            <li>
                <strong>9.5.</strong> Other than the foregoing representations and warranties, Patent Services USA, Inc. makes no warranties, express or implied, with respect to the quality of the services to be provided hereunder or any results to be achieved, and hereby expressly disclaims the existence of any such representations or warranties. Patent Services USA, Inc. shall have no liability for any indirect, incidental, or consequential damages caused to the INVENTOR, as a result of any failure on the part of Patent Services USA, Inc. in the performance of its duties hereunder, nor shall Patent Services USA, Inc. have any liability, with respect to any infringement of patents or other rights of third parties.
            </li>
            <li>
                <strong>9.6.</strong> PATENT SERVICES USA, INC. DOES NOT GUARANTEE THE COMMERCIAL, ECONOMIC OR TECHNICAL VIABILITY FOR ANY OF THE INVENTIONS AND FURTHER DISCLAIMS ANY LIABILITY FOR ANY DAMAGES SUFFERED AS A RESULT OF THE COMMERCIAL, ECONOMIC OR TECHNICAL FAILURE OF ANY OF THE INVENTIONS.
            </li>
        </ol>
    </li>
    <li>
        <strong>Amendments and Waivers.</strong> None of the provisions of this Agreement may be amended or waived except by a writing signed by the INVENTOR and PATENT SERVICES USA, INC. ENTERED INTO FOR VALUABLE CONSIDERATION. Any waiver by either party of any breach of this Agreement by the other party is not to be deemed a continuing waiver of other breaches of the same nature or of any other provisions of this Agreement.
    </li>
    <li>
        <strong>Successors and Assigns.</strong> This Agreement will be binding upon, and serve to the benefit of, the parties and their respective successors and permitted assigns.
    </li>
    <li>
        <strong>Notices.</strong> Any notice, waiver, demand or other communication required or permitted by this Agreement must be in writing and shall be deemed to have been received when delivered to Patent Services USA, Inc.'s place of business. If delivered by messenger, when sent, or; if mailed, on the third business day after deposit in the United States mail, certified or registered postage prepaid, return receipt requested, or, if faxed, telexed, or telegraphed, six hours after being dispatched by fax, telegram, or telex; or if emailed, next business day after the day when the email was sent, in every case addressed to the party to be notified as follows:

        <p>
        <br>
        <table width="75%">
            <tr>
                <td width="60%">If to PATENT SERVICES USA, INC:</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <strong>PATENT SERVICES USA, INC.</strong><br>
                    12000 Biscayne Boulevard<br>
                    Suite 700<br>
                    North Miami, Florida 33181<br>
                    Phone: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    support@ownmyinvention.com
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>If to INVENTOR:</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    {{isset($project)?$project->lead->fname." ".$project->lead->lname:"Client's Name"}}<br>
                    {{isset($project)?$project->lead->street:""}}<br>
                    {{isset($project)?$project->lead->street2:""}}<br>
                    {{isset($project)?$project->lead->phone:""}}<br>
                    {{isset($project)?$project->lead->email:""}}
                </td>
            </tr>
        </table>
        <br>
        </p>
    </li>
    <li>
        <strong>Remedies.</strong> It is understood and agreed that all provisions of this Agreement are fundamental and essential for the protection of Patent Services USA, Inc.'s legitimate business interests, and in the event of any breach or threatened breach of the provisions of this Agreement by the INVENTOR, Patent Services USA, Inc. will suffer irreparable harm and its remedies at law will be inadequate. Accordingly, in the event of a breach or attempted breach of this Agreement by the INVENTOR, Patent Services USA, Inc. will be entitled, in addition to all other rights or remedies which may be available to Patent Services USA, Inc., to seek injunctive and other equitable relief, without any showing of irreparable harm or damage. In the event Patent Services USA, Inc. seeks such relief, it shall not be required to post a bond or provide other security. All remedies available for breach of this Agreement are cumulative and may be exercised concurrently or separately. The exercise of one remedy will not be deemed an election of such remedy to the exclusion of other remedies.
    </li>
    <li>
        <strong>Termination.</strong> In the event of a violation of any term or condition of this Agreement by the INVENTOR, Patent Services USA, Inc. may terminate this Agreement at any time. The termination of the Agreement shall not prejudice any rights or remedies which shall have accrued to Patent Services USA, Inc. prior to the date of such termination.
    </li>
    <li>
        <strong>Further Assurances.</strong> The parties agree to execute such other documents and provide such further assurances, if any, as may be reasonably required from time to time to give effect to the provisions of this Agreement.
    </li>
    <br><br><br><br>
    <table width="99%">
        <tr>
            <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
            <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
        </tr>
    </table>
    <div class="page-break"></div>
    <li>
        <strong>Limitation of Liability.</strong> In no event shall Patent Services USA, Inc. be liable to the INVENTOR for any indirect, special, incidental, consequential or punitive damages, including without limitations, loss of profit, revenue, data or use, or for similar costs, whether in an action, in contract or tort or based on warranty or other claim, even if Patent Services USA, Inc. has been advised of the possibility of such damages. Patent Services USA, Inc. shall be liable only for its own willful misfeasance and bad faith and no other party to this Agreement shall have any rights whatsoever under this Agreement against Patent Services USA, Inc. for any action taken or not taken by it. During the Term, and continuing after the expiration or termination of this Agreement, the INVENTOR shall indemnify Patent Services USA, Inc., and each of its affiliates and shall hold Patent Services USA, Inc. harmless from any loss, liability, damage, cost or expense arising out of any claims or suits which may be brought or made against Patent Services USA, Inc., or any of its affiliates, by reason of: (i) any breach of the covenants and undertakings hereunder; and (ii) Patent Services USA, Inc.'s noncompliance with any applicable federal, state or local laws or with any other applicable regulations.
    </li>
    <li>
        <strong>Definitions.</strong> For purposes of this Agreement, the following words and expressions have the following meanings:
        <ol class="pSmall" type="none">
            <li>
                <strong>17.1.</strong> "Confidential Information" means, with respect to either party, all information in any written or other form whatsoever, relating directly or indirectly to the present or potential business, operations, corporate or financial condition of such party or to data, know-how, materials, supplier or customer lists or other similar information belonging to such party which is not at the relevant time (i) generally known to the public (through no act or omission in violation of this Agreement), (ii) furnished to the receiving party by a third party having the lawful right to do so or (iii) acquired by the receiving party from a source other than the disclosing party, provided that the receiving party immediately notifies the disclosing party of any such acquisition.
            </li>
            <li>
                <strong>17.2.</strong> "Invention(s)" mean the product concept described in the Invention Initiative Guide previously received by the INVENTOR.
            </li>
            <li>
                <strong>17.3.</strong> "Person" means an individual, a corporation, a partnership, a trust, an unincorporated organization, any business entity or a government or any agency or political subdivision thereof.
            </li>
            <li>
                <strong>17.4.</strong> "U.S. Dollars" means the currency of the United States of America.
            </li>
        </ol>
    </li>
    <li>
        <strong>Mediation and Arbitration.</strong> Any disputes between the parties hereto, whether arising under this Agreement or otherwise, which the parties cannot resolve between themselves using good faith shall be:
        <ol class="pSmall" type="none">
            <li>
                <strong>18.1.</strong> Referred to a court certified mediator of the Circuit Court in Miami-Dade County, Florida and any mediation shall be held in Miami-Dade County, Florida. The cost of said mediation shall be paid for by INVENTOR.
            </li>
            <li>
                <strong>18.2.</strong> In the event that said dispute is not resolved in mediation, the parties shall submit the dispute to a neutral arbitrator residing in Miami-Dade County, Florida. The arbitration shall be held in Miami-Dade County, Florida. In the event that the parties are unable to agree upon an arbitrator within fifteeen (15) days of the date on which either party requests arbitration of a matter, the arbitrator shall be provided by the American Arbitration Association. The prevailing party shall recover all fees and costs of said arbitration. The parties further agree that full discovery shall be allowed to each party to the arbitration and a written award shall be entered forthwith. Any and all types of relief that would otherwise be available in Court shall be available to both parties in the arbitration. The decision of the arbitrator shall be final and binding.  Arbitration shall be the exclusive legal remedy of the parties. Judgment upon the award may be entered in any court of competent jurisdiction.
            </li>
            <li>
                <strong>18.3.</strong> If either party refuses to comply with a ruling or decision of the arbitrator and a lawsuit is brought to enforce said ruling or decision, it is agreed that the party not complying with the ruling or decision of the arbitrator shall pay the court costs and reasonable attorney's fees (including Trial and Appellate attorney's fees) incurred in enforcing the ruling or decision of the arbitrator. Each of the parties hereto hereby (i) consents to the exclusive jurisdiction of any state or federal court located within Miami-Dade County, Florida; (ii) irrevocably agrees that all actions or proceedings which are brought to enforce ruling or decision of the arbitrator must be litigated in such courts, and (iii) each of the parties waives any objections which it may have based on improper value or forum non-convenience to the conduct of any proceeding in such court.
            </li>
            <li>
                <strong>18.4.</strong> Any rights of injunctive relief shall be in addition to and not in derogation or limitation of any other legal rights.
            </li>
            <li>
                <strong>18.5.</strong> The parties hereby covenant and agree that they will use their best efforts to settle all disputes amicably prior to initiating any formal proceedings.
            </li>
        </ol>
    </li>
    <li>
        <strong>Interpretation of Agreement.</strong> The parties acknowledge that this Agreement is the product of mutual efforts by the parties and their respective agents. This Agreement shall be interpreted neither more favorable in favor of one party, nor less favorably in favor of another party.
    </li>
    <li>
        <strong>Entire Agreement.</strong> This Agreement constitutes the entire understanding of the parties and supersedes all prior discussions, negotiations, and understandings, whether oral or written, with respect to its subject matter.
    </li>
        <br><br><br><br><br><br>
        <table width="99%">
            <tr>
                <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
                <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
            </tr>
        </table>
        <div class="page-break"></div>
    <li>
        <strong>Modification.</strong> No change or modification of this Agreement shall be valid unless it is in writing and signed by all the parties who are bound by the terms of this Agreement.
    </li>

    <li>
        <strong>Severability.</strong> If any provision of this Agreement is held invalid, unenforceable, or void by a court of competent jurisdiction, this Agreement shall be considered divisible as to such provision, and the remainder of the Agreement shall be valid and binding as though such provision were not included in this Agreement.
    </li>
    <li>
        <strong>Benefits; Binding Effects.</strong> This Agreement shall be binding upon and shall operate for the benefit of the parties hereto and their respective heirs, personal representative, administrators, successors, and assigns.
    </li>
    <li>
        <strong>Venue and Jurisdiction.</strong> Should a lawsuit be necessary to enforce this Agreement the parties agree that jurisdiction and venue are waived and suit shall be brought in Miami-Dade County, Florida.
    </li>
    <li>
        <strong>Further Cooperation.</strong> From and after the date of this Agreement, each of the parties hereto agrees to execute whatever additional documentation or instruments are necessary to carry out the intent and purposes of this Agreement.
    </li>
    <li>
        <strong>Construction.</strong> To the extent the provisions of this Agreement conflict with the provisions of any other written or oral contracts between the parties, the provisions of this Agreement shall govern.
    </li>
    <li>
        <strong>Truth of Agreements.</strong> The agreements and/or preamble contained on page 1 of this Agreement are true and correct and are hereby incorporated into this Agreement.
    </li>
    <li>
        <strong>Gender.</strong> Wherever the context shall so require, all words herein in any gender shall be deemed to include the masculine, feminine or neutral gender; all singular words shall include the plural, and all plural words shall include the singular.
    </li>
    <li>
        <strong>No-Waivers.</strong> The waiver by any party of any other party's breach of any provision of this Agreement shall not operate nor be construed as a waiver of any subsequent breach, and the waiver by any party to exercise any right or remedy shall not operate nor be construed as a waiver or bar to the exercise of such right or remedy upon the occurrence of any subsequent breach. No action on the part of either party to this Agreement shall be interpreted as a waiver unless such action shall be in writing.
    </li>
    <li>
        <strong>Headings.</strong> Headings in this Agreement are for convenience only and shall not be used to interpret or construe its provisions.
    </li>
    <li>
        <strong>Governing Law.</strong> This Agreement shall be governed by the laws of the State of Florida (without regard to the laws that might be applicable under principles of conflicts of law) as to all matters, including, but not limited to, matters of validity, construction, effect and performance.
    </li>
    <li>
        <strong>Counterparts.</strong> This Agreement may be executed in two or more parts, each of which shall be deemed an original but all of which together shall be one and the same instrument.
    </li>
    <li>
        <strong>Original Copy.</strong> A facsimile or electronic copy of this Agreement and any signatures affixed hereto shall be considered for all purposes as originals.
    </li>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <table width="99%">
        <tr>
            <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
            <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
        </tr>
    </table>
    <div class="page-break"></div>

    <li>
        The INVENTOR acknowledges their consent to this Agreement via Electronic Signature. This agreement and any counterparts to
        this agreement will be deemed an original. To expedite the process of entering into this Agreement, the INVENTOR acknowledges
        that Electronic Transmissions of the Agreement will be equivalent to original documents. "Electronic Transmission" will mean
        copies that are reproduced or transmitted as complete and accurate reproductions and transmissions of this original. The INVENTOR has a
        three (3) calendar day right-of-rescission from the signature date of the agreement to cancel for a refund. The cancellation request must
        be received at our corporate headquarters located at 12000 Biscayne Boulevard, Suite 700, North Miami, FL 33181, via certified mail only.
        Due to work scheduling of attorneys, draftsmen, production personnel and other factors beyond any control, Patent Services USA, Inc. reserves the first
        right to refuse all refund requests after the three (3) calendar day rescission period stated above.
    </li>
</ol>
    <p>&nbsp;</p>
<h1 style="margin-left: 38%"><strong>PATENT PROTECTION AGREEMENT</strong></h1>
    <p>&nbsp;</p>
<h1><strong>CHECK PLANS:</strong></h1>
<p style="margin-left: 25%">
    <img src="{{ isset($plans) && $plans[0] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PLAN 1  &nbsp;
    <img src="{{ isset($plans) && $plans[1] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PLAN 2  &nbsp;
    <img src="{{ isset($plans) && $plans[2] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PLAN 3  &nbsp;
    <img src="{{ isset($plans) && $plans[3] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PLAN 4  &nbsp;
    <img src="{{ isset($plans) && $plans[4] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PLAN 5  &nbsp;
    <img src="{{ isset($plans) && $plans[5] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PLAN 6 &nbsp;
</p>
<br>
<h1><strong>CHECK PACKAGES:</strong></h1>
<p style="margin-left: 25%">
    <img src="{{ isset($plans) && $plans[6] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PKG A  &nbsp;
    <img src="{{ isset($plans) && $plans[7] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PKG B  &nbsp;
    <img src="{{ isset($plans) && $plans[8] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PKG C  &nbsp;
    <img src="{{ isset($plans) && $plans[9] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PKG D  &nbsp;
    <img src="{{ isset($plans) && $plans[10] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> PKG E  &nbsp;
    <img src="{{ isset($plans) && $plans[11] == 'true' ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> TM & CR ADD ON &nbsp;
</p>
    <p>&nbsp;</p>
<h1 style="margin-left: 35%"><strong>INVENTOR APPROVAL AND ACCEPTANCE</strong></h1>
    <p>&nbsp;</p>
<h1><strong>IN WITNESS WHEREOF, THE PARTIES HERETO AGREE TO THE TERMS AND CONDITIONS AS STATED IN THIS PATENT PROTECTION AGREEMENT.</strong></h1>
    <p>&nbsp;</p>
<p>
    <table width="100%">
        <tr>
            @if(isset($inventor_name))

                <td>By:</td>              <td style="text-decoration: underline;"> {{isset($inventor_name)?$inventor_name:''}}</td>                  <td>Date: </td>                   <td style="text-decoration: underline;"> {{isset($inventor_date)?$inventor_date:''}}</td>

            @else
                <td>By:</td>              <td>______________________________________</td>                  <td>Date: </td>                   <td>______________________________________</td>
            @endif
        </tr>
        <tr>
            <td>&nbsp;</td>           <td>Inventor Authorized Signature</td>                       <td>&nbsp;</td>                  <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>           <td>&nbsp;</td>                                             <td>&nbsp;</td>                   <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>           <td><strong>Corporate Acceptance:  Patent Services USA, INC.</strong></td>                    <td>&nbsp;</td>                   <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>           <td>&nbsp;</td>                    <td>&nbsp;</td>                   <td>&nbsp;</td>
        </tr>
        <tr>
            <td>By:</td>              <td> <img style="position: absolute;top: -20px !important;" src="{{asset('/img/leslieSignature.png')}}"><br><p style="margin-top: 0px !important;z-index: 100;">_____________________________________</p></td>                  <td>Date: </td>                   <td style="text-decoration: underline;">_____________{{date("m-d-Y")}}_______________</td>
        </tr>
        <tr>
            <td>&nbsp;</td>           <td>PATENT SERVICES USA, INC. Authorized Representative</td>    <td>&nbsp;</td>                   <td>&nbsp;</td>
        </tr>
    </table>
</p>
<br>
    <p>_______________________________________________________________________________________________________</p>
<br>
<p><strong>FOR OFFICIAL USE ONLY – DO NOT WRITE BELOW</strong></p>
<p>
<table width="100%">
    <tr>
        <td>Date Received:</td>        <td>_____________________</td>                       <td>Amount Received: $</td>                   <td>____________</td>
    </tr>
    <tr>
        <td>Balance Due:</td>          <td>_____________________</td>                       <td>Percentage (%) Paid: </td>                <td>___________%</td>
    </tr>
</table>
</p>




    <br><br><br><br><br><br><br><br>
    <table width="99%">
        <tr>
            <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
            <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
        </tr>
    </table>
    <div class="page-break"></div>

    <h1 align="center"><strong>EXHIBIT A</strong></h1>
    <h1 align="center"><strong>PAYMENT SERVICES AND SCHEDULE</strong></h1>

    <ol class="pSmall" type="I">
        <li>
            <strong class="subTitle">Half Payment Service Schedule:</strong>
            <br><br>
            <ol class="pSmall" type="A">
                <li>
                    Invention Initiative Welcome Package confirming the opening of the INVENTOR's file is mailed within thirty (30) days after the payment is received by Patent Services USA, Inc.
                </li>
                <li>
                    Quality Assurance Questionnaire is mailed to the INVENTOR in the above mentioned Invention Initiative Welcome Package.
                </li>
                <li>
                    Trade Show Representation (if applicable) will be provided to the INVENTOR for a period of twelve (12) months. The INVENTOR shall be made aware of trade show availability, which is scheduled by ILA affiliate.
                </li>
                <li>
                    INVENTOR shall be provided with placement and exposure on the ILA's website (if applicable) for a period of twelve (12) months, at the sole discretion of the ILA.
                </li>
                <li>
                    All the INVENTOR's information will be forwarded to the independent registered patent attorney or independent patent agent, who will begin work on the Provisional Patent (Patent-Pending) Application.  This shall be provided to the INVENTOR approximately sixty (60) days after payment, approved artwork and written invention description is received by Patent Services USA, Inc.
                </li>
                <li>
                    Inventor shall be provided with a 2-D graphic illustration of the invention.
                </li>
                <li>
                    The INVENTOR may upgrade from Provisional Patent protection to Full Nonprovisional (Utility) Patent protection within twelve (12) months of signing this Agreement.  An additional charge of $849.00 shall apply in order to initiate this upgrade.
                </li>
            </ol>
        </li>
        <br><br>
        <li>
            <strong class="subTitle">Full Payment Service Schedule:</strong>
            <br><br>
            <ol class="pSmall" type="A" start="8">
                <li>
                    All services as listed above in Half Payment Service Schedule.
                </li>
                <li>
                    All documentation relating to the patent search received from the independent registered patent attorney will be forwarded to the INVENTOR by Patent Services USA, INC. These results are provided to the INVENTOR approximately forty-five (45) days after establishing a Provisional Patent (Pending) status as stated above in Section I (E).
                </li>
                <li>
                    A Trademark search will be performed by independent attorneys and shall be provided to the INVENTOR approximately ninety (90) days after full payment is received by Patent Services USA, Inc.
                </li>
                <li>
                    Patent Services USA, Inc. shall compile all documents for the INVENTOR and send those documents to the independent registered patent attorney or independent patent agent (if applicable). These documents are completed approximately ninety (90) days after the INVENTOR officially obtains Provisional Patent (Patent-Pending) status as stated above in Section I (E).
                </li>
                <li>
                    A Trademark Application is prepared (if applicable). This service will be provided to the INVENTOR approximately ninety (90) days after the services listed above in Section II (J) are completed.
                </li>
                <li>
                    The INVENTOR shall be provided with the Copyright documents approximately ninety (90) days after full payment is received by Patent Services USA, Inc.
                </li>
                <li>
                    European Union Community Design Patent Application will begin immediately after a full Nonprovisional (Utility) United States Patent Application is filed and a "filing receipt" is received from the United States Patent and Trademark Office (hereinafter "USPTO").  The filing receipt shall be provided to the INVENTOR (if applicable).
                </li>
                <li>
                    Patent Services USA, Inc. shall engage a Computer Animation Specialist who will design a three-dimensional animated prototype for the INVENTOR's invention.
                </li>
            </ol>
        </li>
        <p>&nbsp;</p>
        <li>
            All items under the Full Payment Service Schedule and Half Payment Service Schedule are measured in approximate time frames.  The times frames may vary based on Patent Services USA, Inc. contractor and/or sub-contractor workloads and schedules, as well as, circumstances beyond the control of Patent Services USA, INC., including the referred independent registered patent attorneys or independent patent agents, USPTO and/or the European Patent Office (hereinafter "EPO").
        </li>
        <p>&nbsp;</p>
        <li>
            The prices listed in the Agreement are subject to change based on service level changes provided by USPTO, EPO, independent registered patent attorneys or independent patent agents, and/or Patent Services USA, Inc. price changes.  However, once the INVENTOR has made a payment to Patent Services USA, Inc. for the services outlined in this Agreement, no price adjustments shall be made other than as agreed by the parties in writing.
        </li>
    </ol>



    <br><br>
    <table width="99%">
        <tr>
            <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
            <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
        </tr>
    </table>
    <div class="page-break"></div>

    <h1 align="center"><strong>EXHIBIT B</strong></h1>
    <h1 align="center"><strong>AFFILIATE TRADE SHOW REPRESENTATION</strong></h1>

    <p>With respect to Patent Services USA, INC., Independent Licensing Affiliates (ILA) and trade show representation, the INVENTOR agrees with the following terms and acknowledges the information as stated below</p>

    <ol class="pSmall" type="A">
        <li>
            Patent Services USA, Inc. utilizes the services of one or more ILA as providers of all trade show and industry representation.
        </li>
        <p>&nbsp;</p>
        <li>
            Patent Services USA, Inc. will use best efforts to coordinate six (6) to eight (8) national and/or international trade shows per calendar year.  The scheduling of trade shows is the sole responsibility of the ILA, who reserves the right to substitute or cancel any and all trade shows as needed.  Any trade show scheduled by the ILA will also be posted on the Patent Services USA, Inc. website at www.ownmyinvention.com
        </li>
        <p>&nbsp;</p>
        <li>
            All trade show representation provided by the ILA is done using various methods of operation. One specific method may be by the establishment of a tradeshow booth, which allows the ILA to review selected "generic" information with industry participants on a confidential basis.  The ILA may engage in numerous activities which may include walking the tradeshow floors, stopping by other booths on display or organizing confidential meetings and presentations. The ILA will make every attempt to establish meaningful communication with manufacturing representatives, their agents or any other industry organizations or professionals on behalf of any / all assigned Patent Services USA, Inc. clients.  At no time will the confidential details of any Patent Services USA, Inc. client information be released to any potential interested third party at a tradeshow without the proper execution of necessary confidentiality/non-compete agreements. Any information discussed will be for the sole purpose of establishing an interest in a specific category of ideas or inventions.
        </li>
        <p>&nbsp;</p>
        <li>
            After the ILA attends a trade show, an attendance report shall be generated by the ILA and delivered to Patent Services USA, Inc. with specifics of client progress and any "generic" interest initiated through trade shows.
        </li>
        <p>&nbsp;</p>
        <li>
            Patent Services USA, Inc. will make a diligent effort to notify INVENTOR, within a reasonable and timely manner, as to any expressed interest in an idea, from any industry manufacturing representatives, their agents or any other industry organization or professional, through any appropriate verbal or written communication.   Patent Services USA, Inc. will make a diligent effort to guide the INVENTOR on how to continue the communication to any interested manufacturing representative, their agents or any other industry organization or professional, in accordance with the standards set in the "Invention Initiative Guide" prepared for the INVENTOR prior to being referred to the ILA.
        </li>
        <p>&nbsp;</p>
        <li>
            If no interest is generated at a trade show, through the efforts of the ILA, Patent Services USA, Inc. shall NOT be required to notify the INVENTOR.
        </li>
        <p>&nbsp;</p>
        <li>
            Trade show representation through the ILA will remain in effect for a period of two (2) years from the Effective Date of the Agreement.
        </li>
    </ol>

    <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <table width="99%">
        <tr>
            <td class="footPage">File No.: {{isset($project)?$project->lead->fileno:'000000'}}</td>
            <td class="textRight"><span class="footPage">Inventor(s) Initial:</span></span> <span style="text-decoration: underline;">{{isset($project)?strtoupper($project->lead->fname[0].$project->lead->lname[0]):''}}</span></td>
        </tr>
    </table>
    <div class="page-break"></div>
