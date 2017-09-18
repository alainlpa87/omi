<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/createDocusignCSDocs')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="psa">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p align="center" class="title"><strong>Agreement for Patent Services</strong></p>
        <p>
            This Agreement for Patent Services (the "Agreement") is entered into by and between <u>&nbsp;&nbsp;&nbsp;&nbsp;{{$attorney->fname." ".$attorney->lname}}  &nbsp;&nbsp;&nbsp;&nbsp;</u> (“PATENT FIRM”) and <strong><u class="verySmall">{{ucwords($client->fname." ".$client->lname)}}</u>
                @if(strlen($project->coInventor)!=0)
                    and <u>{{$project->coInventor}}</u>
                @endif
            </strong> residing at the address of <strong><u>{{isset($client->street)?$client->street." ".$client->street2:"address"}}</u></strong> ("INVENTOR").  By executing this
            agreement, INVENTOR represents that all parties with any ownership or security interest (by way of example and not limitation, other inventors or
            assignees) in any property involved in this engagement are parties to this Agreement.
        </p>
        <p><strong><u>1. Scope of Professional Services-</u></strong></p>
        <p>
            Unless otherwise indicated in a separate written addendum countersigned by the parties, PATENT FIRM is hereby
            retained by INVENTOR solely to provide United States Patent and Trademark Office (the "USPTO") patent application and
            prosecution services and to perform other activities reasonably related thereto (the "Patent Services"). The terms of this Agreement
            will govern all Patent Services undertaken by PATENT FIRM for INVENTOR. PATENT FIRM works on behalf of INVENTOR,
            and not any of INVENTOR’s agents or any individuals associated with INVENTOR.
        </p>
        <p>
            PATENT FIRM shall endeavor to provide INVENTOR with effective and efficient Patent Services. PATENT FIRM will
            also take reasonable steps to keep INVENTOR informed of their matters related to the Patent Services. If INVENTOR at any time
            has any questions or concerns, please contact PATENT FIRM. Due to the unpredictable nature of patent prosecution matters,
            PATENT FIRM makes no representations, warranties, promises or guarantees to INVENTOR about the outcome of INVENTOR's
            matters related to the Patent Services provided hereunder.
        </p>
        <p><strong><u >AGENTS OF INVENTOR</u></strong></p>
        <p>
            Initially it is expected that INVENTOR will be represented by Patent Services USA, Inc. of Florida as INVENTOR's agent
            (here in "AGENT"). Given that INVENTOR is engaging PATENT FIRM through AGENT representing INVENTOR then
            PATENT FIRM and INVENTOR acknowledge that AGENT is INVENTOR's representative and properly providing any fees
            and/or instructions to PATENT FIRM, which PATENT FIRM always assumes, in good faith, are completely according to
            INVENTOR's knowledge and wishes. Hence, INVENTOR takes official notice that compensation to PATENT FIRM for all work
            under this agreement is provided by INVENTOR's AGENT, and not INVENTOR. INVENTOR acknowledges all service fees paid
            to PATENT FIRM by AGENT are specially arranged flat-fees for specifically procured patent services, which flat fees are earned
            upon receipt, thus no special trust account segregation or hourly billing/invoice accounting is required under 37 CFR 10.112(c).
            INVENTOR acknowledges that PATENT FIRM has provided disclosure of this relationship to INVENTOR under 10.68(a)(1) and
            INVENTOR accordingly provides full consent to PATENT FIRM to be so compensated by such AGENT of INVENTOR. Both
            PATENT FIRM and INVENTOR acknowledge that all of the foregoing provisions and understandings shall transfer to any newly
            appointed agent(s) of INVENTOR. INVENTOR agrees to consult exclusively with AGENT regarding any counseling or questions
            related to the nature, timing, or requirements to establish or maintain any US or foreign patent rights.
        </p>
        <p><strong><u >2. Other INVENTOR's; Conflicts.</u></strong></p>
        <p>
            INVENTOR understands, agrees and acknowledges that PATENT FIRM represents a wide range of INVENTOR's, some
            of which may be or become customers, vendors, or competitors of INVENTOR. It is possible that at some point during the course
            of PATENT FIRM's representation of INVENTOR, a conflict could arise between INVENTOR and PATENT FIRM's other
            INVENTOR's. If you are concerned about any relationships we might have with particular companies or individuals, please bring
            those concerns to our attention.
        </p>
        <p>
            Should PATENT FIRM discover, at any time, a potential conflict which under applicable law would prevent PATENT
            FIRM from providing Patent Services to INVENTOR it will promptly bring the matter to INVENTOR's attention. By signing this
            agreement, INVENTOR agrees that PATENT FIRM may represent companies in any way that does not present a direct subject
            matter conflict which under applicable law would prevent PATENT FIRM from providing Patent Services to INVENTOR.
        </p>
        <p ><strong><u >3. Confidentiality</u></strong></p>
        <p>
            INVENTOR may wish to deliver to PATENT FIRM such proprietary and confidential information and materials as INVENTOR desires to disclose
            for the sole purpose of allowing PATENT FIRM to provide the Patent Services. In accordance with the attorney/agent-INVENTOR relationship,
            this any such information is privileged information.
        </p>
        <p>
            INVENTOR agrees and acknowledges that it is in INVENTOR's best interests to preserve the confidentiality of all communications between
            PATENT FIRM and INVENTOR. If INVENTOR discloses these communications to any third-party, INVENTOR jeopardizes the privileged nature
            of the communications. PATENT FIRM hereby advises INVENTOR not to disclose privileged information to any third parties and INVENTOR
            does so at its own peril.
        </p>
        <p>
            Moreover, no information shall be considered confidential or property unless INVENTOR marks any such written material "CONFIDENTIAL". If
            any such material is delivered orally, INVENTOR shall reduce such oral information to writing, label such writing "CONFIDENTIAL" and deliver
            said writing to PATENT FIRM within thirty (30) days of oral disclosure by INVENTOR in order for said information to be deemed confidential
            hereunder. PATENT FIRM agrees to maintain any such information and materials in secrecy and shall not, except to the extent authorized by
            INVENTOR in writing, knowingly use such information and materials for any purpose other than the use contemplated hereby. PATENT FIRM
            will use all reasonable diligence to prevent unauthorized use or disclosure by PATENT FIRM of such confidential information; provided, that
            PATENT FIRM shall have the right to disclose such information and materials to its necessary personnel, which shall include employees, and to
            independent searchers, consultants, subcontractors and USPTO and/or other patent office personnel who have agreed to maintain the confidential
            nature of such information and materials and to the USPTO and/or other patent office personnel.. All such necessary personnel have agreed to
            maintain the confidential nature of such information and materials. Notwithstanding the foregoing, PATENT FIRM shall not be bound with respect
            to any of the disclosed INVENTOR information that:
        </p>
        <ol type="A">
            <li>Is, or subsequently becomes, part of the public domain through no fault of PATENT FIRM.</li>
            <li>At the time of its receipt from INVENTOR was already known by PATENT FIRM.</li>
            <li>Comes into the possession of PATENT FIRM from a third party having the right to disclose thereto.</li>
            <li>Is disclosed by PATENT FIRM pursuant to a valid order issued by a court or government agency, provided that the PATENT FIRM
                provides (a) prior written notice to the INVENTOR of such obligation and (b) an opportunity to oppose such disclosure.</li>
        </ol>
        <p><strong><u>4. General Notices</u></strong></p>
        <p>
            TERMINATION; REJECTION:
        </p>
        <p >
            Upon termination or rejection of this Agreement for any reason, INVENTOR may request an updated agreement from PATENT FIRM; provided,
            however, that (a) PATENT FIRM shall have no obligation to furnish said updated agreement and (b) all terms and conditions contained in any
            updated agreement are subject to change in PATENT FIRM's sole discretion.
        </p>
        <p>
            MASTER AGREEMENT:
        </p>
        <p>
            This Agreement shall serves as a master agreement between the parties. Unless otherwise quoted in writing by PATENT FIRM, each project, task,
            or patent application and/or prosecution services INVENTOR project shall be quoted or estimated separately in writing and must be individually
            negotiated between PATENT FIRM and INVENTOR based on the then-current fee schedule as published on PATENT FIRM's web site. Unless
            otherwise stated expressly in writing, all Patent Services related to all INVENTOR Project shall be governed by this Agreement and any such
            writing shall be deemed an addendum to this Agreement.
        </p>
        <p>
            FOREIGN PATENT RIGHTS:
        </p>
        <p>
            INVENTOR agrees and acknowledges that INVENTOR has 12 months from the filing date of a provisional patent application ("PPA") with the
            USPTO to file a patent application abroad or under the Patent Cooperation Treaty (the "PCT") to preserve the right to priority under the Paris
            Convention based on the filing date of the PPA. INVENTOR agrees and acknowledges that if no PPA was filed by INVENTOR, the 12-month
            priority deadline under the Paris Convention is measured from the earliest USPTO effective filing date of any non-provisional patent application
            filed by INVENTOR. Any PCT filings desired by INVENTOR should be procured by INVENTOR within 10 months after the earliest U.S. filing
            date and may be subject to a separate written agreement between the parties. INVENTOR agrees to consult exclusively with AGENT regarding any
            counseling or questions related to the nature, timing, or requirements of any foreign patent applications.
        </p>
        <p>
            EFFORT:
        </p>
        <p>
            PATENT FIRM will attempt to obtain a patent on behalf of INVENTOR by negotiating with the USPTO using patent law and related procedures,
            but does not guarantee that a strong patent, or any patent, will be allowed by the USPTO. Moreover, INVENTOR agrees and acknowledges that the
            quality (by way of example, and not limitation, patent scope and effectiveness in litigation or licensing), likelihood of allowance, and/or validity of
            any patent application and/or prosecution service tends to be at least commensurate with the novelty, strength and scope of INVENTOR's invention
            disclosure submitted. To that end, INVENTOR agrees to work with AGENT to establish INVENTOR’s top invention protection priorities to claim
            (usually the top three most valuable) and INVENTOR's most basic (i.e., broadest), yet novel, invention version. The Utility patent application
            prepared by PATENT FIRM will typically include 10 to 20 claims, which PATENT FIRM will make best efforts to formally draft to at least cover
            such top invention claim priorities, and likewise for the supporting patent specification. When retained for patent prosecution work, PATENT
            FIRM will likewise make best efforts to win patent protection which at least consist of claiming INVENTOR's detailed invention design and/or all
            stated protection priorities and/or all stated novelties. If any known, INVENTOR agrees to work with AGENT to identify and provide the closest
            known prior art which is required to be cited to the USPTO; wherein, in none received, PATENT FIRM assume there is no known prior art to be
            cited. INVENTOR agrees and acknowledges that PATENT FIRM shall assume that the claim priorities provided by INVENTOR have been
            sufficiently narrowed to focus on strong, core novelties and avoid any known prior art.
        </p>
        <p>
            TYPES OF PATENT PROTECTION:
        </p>
        <p>
            Ornamental designs that have only aesthetic, visual qualities are protected by Design Patents, and inventions that have functional usefulness that
            solve some kind of problem are protected by Utility patents. It is common to protect the function or manufacture of an article with a Utility patent,
            and the outward appearance of the same article with a Design patent. Generally, design patents protect the same or obvious variations to the look of
            the article, whereby the functionality of the article is not relevant. INVENTOR acknowledges that often Design patents have more limited value
            especially relative to Utility patents.
        </p>
        <p>
            DRAWINGS:
        </p>
        <p>
            PATENT FIRM shall use best efforts to ensure that all formal drawings created and provided by PATENT FIRM will be accepted by the USPTO.
            Any corrections to these drawings required by the USPTO will be at PATENT FIRM's expense. However, drawings provided by INVENTOR or a
            draftsman hired by INVENTOR are not guaranteed by PATENT FIRM in any way and INVENTOR shall be solely responsible for their acceptance
            by the USPTO. Any work required by PATENT FIRM to complete and/or formalize such drawings will be at additional charge, which will be
            quoted by PATENT FIRM to INVENTOR and paid by INVENTOR to PATENT FIRM within 30 days of receipt of such quote. PATENT FIRM
            shall have no obligation to complete and/or formalize any such drawing unless and until payment is received from INVENTOR. In some cases, it
            may be advisable to formalize a drawing professionally. If professional drawings are required, PATENT FIRM would be happy to make
            recommendations to INVENTOR. Notwithstanding the foregoing, INVENTOR shall be solely responsible for any such professional drawings and
            any related third-party fees.
        </p>
        <p>
            PRIOR ART:
        </p>
        <p>
            Under applicable United States patent law (including 35 U.S.C. §102 (b)), INVENTOR acknowledges that INVENTOR has a duty to inform the
            USPTO if any events or circumstances occurred more than a year prior to filing a PPA or non-provisional patent application with USPTO. Such
            events include, but are not limited to: INVENTOR's invention that is the subject of a PPA or non-provisional patent application was (a) sold or
            offered for sale in the U.S., (b) described in a printed publication or claimed in a patent anywhere, or (c) disclosed to or used by the public within the
            United States more than one year prior to filing.
        </p>
        <p><b>BY LAW YOU MUST DO THE FOLLOWING OR RISK ANY FUTURE RELATED PATENT BECOMING INVALID:</b>
            If you have related (in any way) US or foreign or international (e.g., a PCT) patent application prosecution which has discovered prior-art (e.g., in a search report or
            foreign patent office action) not already cited to the USPTO, then the USPTO requires that it must be promptly submitted in an Information
            Disclosure Statement (IDS). INVENTOR acknowledges its obligation to provide the USPTO with a list of the prior-art cited for filing under the IDS
            procedure. Generally, the USPTO requires the filing of an IDS with copies of all relevant publications (patents or otherwise) known to the inventor.
        </p>
        <p>
            The IDS is usually filed before receiving the official filing receipt from the USPTO, yet may be filed at any time. If INVENTOR becomes aware of
            any references which are relevant to patentability during the pendency of the patent a Supplemental IDS should be filed disclosing the references;
            for example, in a related US patent application or a foreign patent office cites patents against a foreign counterpart of the US application. Likewise,
            the USPTO requires applicants to disclose to the USPTO, within 2 months of the filing date of any subsequent patent application filing, any patent
            applications that an applicant and/or (co)owner have filed, even if they are unrelated. Lack of this timely disclosure carries unspecified penalties
            and can harm your patent rights. INVENTOR acknowledges that it is imperative that INVENTOR timely disclose such information to the USPTO
            along with any patent filing. INVENTOR further acknowledges to timely provide the USPTO this information and notice even if INVENTOR
            believes PATENT FIRM should already be aware of the information for any reason; otherwise INVENTOR risks any future patent becoming being
            rendered invalid (e.g., by presumed inequitable conduct).
        </p>
        <p>
            PATENT PENDING:
        </p>
        <p>
            INVENTOR understands that it is illegal to claim patent pending status prior to the date a patent application is properly filed. A PPA provides
            patent pending status for one year from the filing date of the PPA and then expires. A PPA never becomes a patent. A utility patent that claims
            priority to the PPA must be filed by INVENTOR before the PPA expires- PATENT FIRM may not provide INVENTOR a deadline reminder.
            There is no PPA for design patents. If a utility or design patent application is to be filed by PATENT FIRM based on a PPA, INVENTOR must
            request a fee quote and fund such application within 9 months after the filing date of the PPA.
        </p>
        <p>
            SUBMISSIONS:
        </p>
        <p>
            INVENTOR agrees that AGENT will handle and is responsible for accepting, storing, managing, and/or returning any physical delivery of any kind
            of materials or properties contemplated under 37 CFR 112(c), which, for example, INVENTOR may wish to have received, maintained or returned
            related to the rendering of patent services. INVENTOR agrees that PATENT FIRM has no responsibility whatsoever to receive, maintain or return
            any of INVENTOR's physical material or properties, and AGENT will instead support INVENTOR in this regard.
        </p>
        <p >
            NON-PUBLICATION:
        </p>
        <p>
            INVENTOR understands that if a foreign or international patent will be filed that claims priority to a US patent application then INVENTOR must
            allow the US patent application to be published by USPTO 18 months after the earliest US filing date. Otherwise, generally, if no foreign patent
            rights are sought by INVENTOR, INVENTOR should file a non-publication request with the USPTO. The non-publication request must be filed
            contemporaneous with the US Utility patent application, and can never be filed afterwards; however, it may be later rescinded. INVENTOR must
            indicate to PATENT FIRM that a non-publication request should be filed. If PATENT FIRM does not receive non-publication request instructions
            and corresponding signed/dated form from INVENTOR (no later than contemporaneous with INVENTOR's signed oath), PATENT FIRM will
            assume INVENTOR does not wish a non-publication request to be filed.
        </p>
        <p >
            CORRESPONDENCE ADDRESS AND COMMUNICATIONS:
        </p>
        <p>
            INVENTOR agrees to consult with AGENT regarding USPTO correspondence options, wherein AGENT may forward to PATENT FIRM for
            proper handling. PATENT FIRM will assume that correspondence and maintenance fee address is to be in INVENTOR's name/address to receive
            the USPTO correspondence. INVENTOR agrees to promptly forward all USPTO correspondence received to AGENT. INVENTOR will also
            indicate to AGENT each inventor's citizenship if not the US. PATENT FIRM will assume all inventors are US citizens unless otherwise indicated.
        </p>
        <p>
            MAINTENANCE FEES:
        </p>
        <p>
            INVENTOR understands that maintenance fees are due every 3.5 to 4 years after a utility patent is issued by the USPTO. <strong class="verySmall">IT IS THE SOLE
                RESPONSIBILITY OF INVENTOR TO REMEMBER ALL FEES DUE DATES AND TIMELY PAY ALL FEES.  FAILURE TO PAY ANY
                FEES WHEN DUE MAY JEOPARDIZE THE VALIDITY OF APPLICABLE PATENT(S) AND/OR PATENT APPLICATION(S)</strong>.
        </p>
        <p><strong><u>5.  Termination of PATENT FIRM's Representation</u></strong></p>
        <p>
            In addition to the automatic termination provisions contained in Section 4 of this Agreement, either INVENTOR or
            PATENT FIRM may terminate PATENT FIRM's representation of INVENTOR at any time for any reason upon written notice to
            the other party. At the time PATENT FIRM's representation of INVENTOR concludes, all unpaid fees and costs for Patent
            Services rendered become due and payable. PATENT FIRM will retain INVENTOR's files and any submitted materials (e.g.,
            without limitation, prototypes, photographs, drawings, etc.) for a period of one (1) month after the time of termination, beyond
            which PATENT FIRM may have the files and material destroyed or otherwise discarded. Upon conclusion of PATENT FIRM's
            representation, PATENT FIRM is no longer responsible for taking any further action (including, but not limited to, responding to
            USPTO Office Actions or filing of patent applications or attending to payment of maintenance or annuity fees) on INVENTOR's
            behalf. INVENTOR also acknowledges and agrees that if PATENT FIRM's representation is concluded, that PATENT FIRM may
            withdraw as INVENTOR's representative in any of INVENTOR’s matters, or administrative proceeding, or other matters before the
            USPTO or any other governing body (such as, without limitation, WIPO for PCT), and to substitute INVENTOR in said matter or
            proceeding as INVENTOR's own attorney.
        </p>
        <p>
            All permitted remedies contained in this Agreement shall not be deemed to be exclusive remedies for any breach of this Agreement, but
            shall be in addition to all other remedies available at law or in equity.  The definitions and notices contained in this Agreement and the rights and
            obligations contained in sections 4 ("Fees, Costs and Bills"), 5 ("Termination"), 6 ("Limitation of Liability"), 8 ("Dispute Resolution"), 10
            ("Controlling Law"), and 11 ("Miscellaneous") will survive any termination or expiration of this Agreement.
        </p>
        <p><strong><u>6. Limitation of Liability; Disclaimer of Warranties; Indemnification</u></strong></p>
        <p><strong>TO THE FURTHEST EXTENT PERMITTED UNDER 35 U.S.C. §§1-376 AND ALL RELATED REGULATIONS (THE "PATENT
                ACT") AND ALL OTHER APPLICABLE LAWS, IN NO EVENT WILL EITHER PARTY BE LIABLE FOR ANY INDIRECT, INCIDENTAL,
                CONSEQUENTIAL, SPECIAL OR EXEMPLARY DAMAGES OR LOST PROFITS ARISING OUT OF OR IN CONNECTION WITH THIS AGREEMENT, EVEN IF A PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH
                DAMAGES. Some jurisdictions do not allow limitation or exclusion of incidental or consequential damages, so the above limitation or exclusion of incidental or consequential damages, so the above limitation or exclusion may not apply to INVENTOR in all
                circumstances.  TO THE FURTHEST EXTENT
            </strong></p>
        <p><strong>
                PERMITTED UNDER THE PATENT ACT AND ALL OTHER APPLICABLE LAWS, IN NO EVENT SHALL EITHER PARTY’S
                TOTAL LIABILITY FOR ANY DAMAGES, DIRECT OR INDIRECT, IN CONNECTION WITH THE PATENT SERVICES OR
                ANY OTHER SERVICES RENDERED BY ONE PARTY TO ANOTHER EXCEED THE AMOUNT PAID HEREUNDER
                DURING THE SIX MONTH PERIOD PRIOR TO THE CAUSE OF ACTION ACCRUING, WHETHER SUCH LIABILITY
                ARISES FROM ANY CLAIM BASED UPON CONTRACT, WARRANTY, TORT OR OTHERWISE.</strong>
        </p>
        <p>
            <strong>INVENTOR agrees to be solely responsible for any damages caused by corruption, viruses, and etc contained within any PATENT FIRM
                electronic files.</strong>
        </p>
        <p>
            <strong>To the furthest extent permitted under the Patent Act 37 C.F.R. §10.78, INVENTOR expressly understands
                and agrees to indemnify and hold PATENT FIRM, and its agents, employees, successors and assigns, harmless from
                any expense, injury, loss or damage incurred in connection with any legal action arising out of or related to:</strong> (a)
            PATENT FIRM service(s) or PATENT FIRM work product(s); (b) the actions or inactions by third party service provider(s) that
            PATENT FIRM reasonably relies upon (e.g., without limitation, online payment service(s), web hosting, USPTO, contractors, and
            the US postal service); (c) the failure to meet a patent bar date or any other kind of deadline if INVENTOR has not given PATENT
            FIRM sufficient written notice as set forth herein; (d) PATENT FIRM providing filing services on behalf of INVENTOR, whereby
            PATENT FIRM acts as INVENTOR's proxy but solely files with a patent office, or treaty organization, material substantially
            produced, or authored, by INVENTOR (and not PATENT FIRM), even if PATENT FIRM has reviewed or revised the material; (e)
            any claim by the USPTO and/or INVENTOR against any agent, employee or contractor of PATENT FIRM; (f) the cost of
            procurement of substitute service(s) resulting from any service(s) procured; or (g) the lack of or inaccurate disclosure to
            INVENTOR of any kind of future filing deadline(s) or requirement(s) relevant to preserving and/or establishing INVENTOR's
            intellectual property rights. By executing this agreement, INVENTOR expressly gives full permission to PATENT FIRM to take
            any action PATENT FIRM deems necessary to meet an imminent official deadline; for example, without limitation, if INVENTOR
            cannot be contacted by email, PATENT FIRM filing a patent application in INVENTOR's name before a PPA expiration without
            signed filing papers, payment of official filing fees, and/or receiving INVENTOR's authorization.
        </p>

        <p><strong><u>7. Necessary Time Deadlines; Disclosure by INVENTOR; INVENTOR Responsibility</u></strong></p>
        <p>
            Unless otherwise agreed upon in writing, PATENT FIRM will have no obligation to meet any due date (including,
            without limitation, bar dates, office action response dates, priority filing dates, PPA expiration date, prosecution response deadline,
            and/or patent application filing dates) imposed by INVENTOR, the USPTO or any other governmental body unless PATENT FIRM
            has all information reasonably necessary to meet such due dates (including receipt of all applicable payments) at least 60 days prior
            to any such due date. In particular, INVENTOR and PATENT FIRM acknowledge that INVENTOR must both engage PATENT
            FIRM under this agreement and provided all information reasonably necessary for PATENT FIRM's work to begin, both at least 60
            days prior to any deadline or due date.
        </p>
        <p>
            INVENTOR shall disclose in writing to PATENT FIRM prior to INVENTOR's execution of this Agreement and again
            upon engagement all applicable pending patent bar date(s) or any other kind of patent related filing deadlines. PATENT FIRM and
            INVENTOR acknowledge that INVENTOR is solely and ultimately responsible and liable for establishing and/or verifying all
            required future actions, and the timing thereof, required to preserve and/or establish INVENTOR's intellectual property rights,
            including, but not limited to, U.S., or International, or other filing deadlines and/or requirements.
        </p>
        <p>
            Furthermore, except to the extent prohibited by any applicable law, PATENT FIRM and INVENTOR further
            acknowledge that if any work product produced under this Agreement, directly or indirectly, in whole or in part, is filed by
            INVENTOR with the USPTO, or any other patent office, INVENTOR shall be completely and solely responsible and liable for
            timely and properly satisfying any and all requirements set forth by applicable patent law, including, without limitation, meeting all
            applicable current or future filing deadlines; making all required fee payments; and satisfying all other filing requirements that are
            directly, or indirectly, related to the filed work product.
        </p>
        <p><strong><u>8. Dispute Resolution</u></strong></p>
        <p>COOPERATION; CERTAIN INVENTOR CLAIMS:</p>
        <p>
            We do not anticipate having any disagreements with INVENTOR about the quality, cost or appropriateness of our
            services, but if any concerns about these matters arise, please notify us immediately. The parties agree to endeavor to resolve any
            disagreements in a fair and amicable manner. If, for some reason, the parties are not able to resolve any disputes raised by
            INVENTOR, then the parties acknowledge that PATENT FIRM and INVENTOR will litigate all disputes for which the USPTO
            has jurisdiction before the USPTO in accordance with the relevant provisions of the Patent Act 35 U.S.C. § 31 and 37 C.F.R. Part
            10, whereby the Commissioner of Patents may order that PATENT FIRM pay full or partial restitution to INVENTOR based on the
            merits of the case, or may indicate or determine that no action can or will be taken to resolve the dispute; whereby, PATENT FIRM
            and INVENTOR acknowledge that the Commissioner of Patent's judgment on the dispute, or decision that no action can or will be
            taken by the USPTO to resolve the dispute, may be entered in any court that has jurisdiction over the matter and INVENTOR will
            be estopped from bringing, in any court or dispute resolution forum, the same or any additional claims arising out of or related to
            the dispute against PATENT FIRM. In particular, PATENT FIRM and INVENTOR expressly waive any right to litigate in any
            court (including, but not limited to any small claims court, city, state, federal, or international court) any dispute, claim, or
            controversies arising out of or relating to this Agreement, or any other agreement executed and delivered pursuant to this
            Agreement, or the negotiation, breach, validity, termination or performance hereof and thereof or the transactions contemplated
            hereby and thereby, including claims related to work product quality, fraud or fraud in the inducement.
        </p>
        <p>MEDIATION:</p>
        <p>Should the USPTO venue, judgment, or decision that no action will be taken be found to be unenforceable as a matter of
            law, or if PATENT FIRM is the initiatof a claim that results in a dispute, PATENT FIRM and INVENTOR acknowledge to, in
            good faith, settle the dispute through mediation in {{$attorney->location}} conducted by a mediator to be mutually selected. The
            initiating party will pay all costs of the mediator. Each party will cooperate fully and fairly with the mediator and will attempt to
            reach a mutually satisfactory compromise to the dispute. If the dispute is not resolved within thirty (30) days after it is referred to
            the mediator, then PATENT FIRM and INVENTOR may initiate an arbitration as specified herein.
        </p>
        <p>ARBITRATION:</p>
        <p>All disputes, claims, or controversies arising out of or relating to this Agreement, or any other agreement executed and delivered
            pursuant to this Agreement, or the negotiation, breach, validity, termination or performance hereof and thereof or the transactions
            contemplated hereby and thereby, that are not resolved by mutual agreement, or as prescribed above, shall be resolved solely and
            exclusively by binding arbitration to be conducted before the American Arbitration Association (the "AAA") or its successor. The
            parties understand and agree that this arbitration provision shall apply equally to claims of fraud or fraud in the inducement. The
            arbitration shall be held in {{$attorney->location}} before a single arbitrator and shall be conducted in accordance with the
            Commercial Arbitration Rules of the AAA, unless specifically modified herein. The arbitration shall comply with and be governed
            by the provisions of the {{explode(',',$attorney->location)[1]}} Arbitration Act, {{explode(',',$attorney->location)[1]}} Code of Civil Procedure sections 1280 1294.2. The parties covenant
            and agree that the arbitration shall commence within sixty (60) days of the date on which a written demand for arbitration is filed by
            any party hereto, unless an extension of time is mutually agreed upon by all parties to the arbitration proceeding. In connection
            with the arbitration proceeding, the arbitrator shall have the power to order the production of documents by each party and any
            third-party witnesses. In addition, each party may take a single depositions as of right, and the arbitrator may in his or her
            discretion allow additional depositions upon good cause shown by the moving party. However, the arbitrator shall not have the
            power to order the answering of interrogatories or the response to requests for admission. In connection with any arbitration, each
            party shall provide to the other, no later than fourteen (14) business days before the date of the arbitration, the identity of all persons
            that may testify at the arbitration (other than rebuttal witnesses), a copy of all documents (other than rebuttal documents) that may
            be introduced at the arbitration or considered or used by a party's witness or expert, and a summary of the expert's opinions and the
            basis for said opinions (other than rebuttal expert summaries). The arbitrator shall have the right to determine a fair amount of time
            for the preparation and submission of rebuttal documents and rebuttal expert summaries. The arbitrator's decision and award shall
            be made and delivered within sixty (60) days of the conclusion of the arbitration. The arbitrator's decision shall set forth a reasoned
            basis for any award of damages or finding of liability. The parties covenant and agree that they will participate in the arbitration in
            good faith. All parties to the arbitration agree to pay their own costs and expenses related to or arising from the arbitration process
            (including without limitation, travel, and attorney's fees). The initiating party of the dispute will pay the fees and expenses charged
            by AAA. This Section 9 applies equally to requests for temporary, preliminary or permanent injunctive relief, except that in the
            case of temporary or preliminary injunctive relief any party may proceed in court without prior arbitration for the limited purpose of
            avoiding immediate and irreparable harm. The provisions of this Section 9 shall be enforceable in any court of competent
            jurisdiction.
        </p>
        <p><strong><u >9. Controlling Law</u></strong></p>
        <p>The validity, interpretation, and performance of this Agreement will be controlled and construed in all respects under the
            laws of the United States of America and by the laws of the State of {{explode(',',$attorney->location)[1]}}.
        </p>
        <p><strong><u>10. Miscellaneous</u></strong></p>
        <p>INVENTOR acknowledges the importance of informing PATENT FIRM of all relevant facts and cooperating with
            PATENT FIRM's effort in performing the Patent Services. INVENTOR also understands that all notices and communications from
            PATENT FIRM will be sent by email when ever possible, and, hence, INVENTOR appreciates the importance of keeping PATENT
            FIRM continually informed of INVENTOR's current email and physical address and telephone number. By signing this agreement,
            INVENTOR attests there are no other known entities with ownership interest (by way of example and not limitation, other inventors
            or assignees) in any property involved in the present engagement. INVENTOR further agrees that all terms and obligations of this
            agreement transfer to any assignee or other inventors in such property, and that, at any time, all parties with ownership interest in
            such property are obligated to promptly enter into, and sign a service agreement to be provided by PATENT FIRM.r</p>
        <p>
            By signing this Agreement, INVENTOR affirms that it understands that it is encouraged to consult with independent legal
            counsel before signing this letter and agreeing to the terms of the Agreement. INVENTOR also affirms that it is voluntarily signing
            this Agreement. This agreement will not take effect, and PATENT FIRM will have no obligation to provide Patent Services, until
            INVENTOR returns a signed copy of this letter and complies with all other terms and conditions (including all condition
            precedents) contained herein. Furthermore, This Agreement may be amended only by an instrument in writing signed by the parties
            hereto. No waivers of or exceptions to any term, condition or provision of this Agreement, in any one or more instances, shall be
            deemed to be, or construed as, a further or continuing waiver of any such term, condition or provision. This Agreement shall inure
            to the benefit of and be binding upon the parties hereto and their respective heirs, successors, assigns, administrators, executors and
            other legal representatives. Neither party may assign this Agreement without the prior written consent of the other party, which
            consent shall not be unreasonably withheld; provided, however, INVENTOR may assign this Agreement to an affiliate, a successor
            in connection with a merger, acquisition or other consolidation, or to the purchaser in connection with the sale of all or substantially
            all of INVENTOR's assets, without the need for prior written consent.
        </p>
        <p>
            All Section headings and captions are inserted solely for convenience of reference, are not to be considered a part of this
            Agreement and shall not affect the meaning or interpretation hereof. This Agreement shall be construed without regard to the party
            responsible for the preparation of the same, and shall be deemed to have been prepared jointly by the parties; any ambiguity or
            uncertainty existing herein shall not be interpreted against either party, but according to the application of other rules of contract
            interpretation that are applied if an ambiguity or uncertainty exists.
        </p>
        <p>This Agreement constitutes the entire agreement between the parties relating to this subject matter and supersedes all
            prior or contemporaneous agreements concerning such subject matter, written or oral. If any and all clauses, provisions, or parts of
            this Agreement is held by a court of law to be unenforceable, illegal, invalid, or ineffective for any reason, (a) that provision shall
            be deemed amended to achieve an economic effect that is as near as possible to that provided by the original provision and (b) the
            legality, validity and enforceability of the remaining provisions of this Agreement shall not be affected thereby.
        </p>
        <p style="text-align: center;">I HAVE READ, I UNDERSTAND AND I AGREE TO THE FOREGOING TERMS.</p>

    </form>
    <br>
    <p style="text-align: right">
        Thank you,<br>
        Client Support Services<br>
        Patent Services USA, INC.<br>
        12000 Biscayne Blvd., Suite # 700<br>
        North Miami, FL 33181<br>
        1-888-344-6836<br>
        1-800-886-7951 (fax)<br>
        Email: clientservices@ownmyinvention.com
    </p>
    <p class="pSmall">
        DISCLAIMER:<br>
        This email message is for the sole use of the intended recipient(s) and may contain confidential and
        privileged information. Any unauthorized review, use, disclosure or distribution is prohibited. If you are not
        the intended recipient, please contact the sender by reply email and destroy all copies of the original
        message.
    </p>
</div>