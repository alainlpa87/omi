<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="agreementExt">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p align="center" style="text-decoration: underline;font-size: 18px;font-weight: bold;"><strong>AMENDMENT TO PATENT PROTECTION AGREEMENT</strong></p>
        <p>
            This First Amendment to Patent Protection Agreement (“Amendment”) is made by and between <b>Patent Services
                USA</b> (hereinafter “PATENT SERVICES USA”) and <b>{{ucwords($client->fname." ".$client->lname)}}</b> (hereinafter the “Inventor”).
        </p>
        <p><b>WHEREAS</b>, PATENT SERVICES USA and the Inventor entered into that certain Patent Protection Agreement date <b>{{date('m/d/Y',strtotime($pcs->rcvdDate))}}</b>
            the Agreement for patent protection assistance services for <b style="text-decoration: underline">two years</b> (hereinafter the "Invention");and,</p>
        <p>
            <b>WHEREAS</b>, the Agreement is scheduled to expire and be of no further force and effect pursuant to its terms and conditions on
            <b>{{date('m/d/Y',strtotime($pcs->rcvdDate.' +2 years -1 day'))}}</b> and,
        </p>
        <p>
            <b>WHEREAS</b>, the Inventor's patent application is still under review with no determination yet made by the patent examiner; and
        </p>
        <p> <b>WHEREAS</b>, PATENT SERVICES USA and the inventor now desire to extend the term of the Agreement and provide additional
            renewal terms for <b>one year</b>; and,
        </p>
        <p>
            <b>WHEREAS</b>, PATENT SERVICES USA and the Inventor hereby affirm that, as of the date hereof: (i) no breach or default by PATENT SERVICES
            USA or the Inventor has occurred; Inventor shall agree to pay an extension fee of $1495.00 as valuable consideration for this modification
            and (ii) the Agreement, and all the terms, covenants, conditions, provisions and agreements thereof, except as expressly modified by this
            Amendment are in full force and effect, with no defenses or offsets thereto.
        </p>
        <p>
            <b>NOW, THEREFORE</b>, in consideration of the mutual covenants contained in the Agreement and for other good
            and valuable consideration, the receipt and sufficiency of which is hereby acknowledged, PATENT SERVICES
            USA and the Inventor hereby agree as follows:
        </p>
        <p>
            &bull;PATENT SERVICES USA and the Inventor hereby extend and renew the terms and conditions of the
            Agreement and further acknowledge and agree that the Agreement is in full force and effect, and neither
            PATENT SERVICES USA nor the Inventor, as of the date hereof, is in breach under the terms of the
            agreement.
        </p>
        <p>
            &bull;The INVENTOR expressly agrees that the independent registered patent attorney engaged by PATENT
            SERVICES USA shall work on matters in connection with the pending application and related non final
            office actions with the United States Patent And Trademark Office (hereinafter “USPTO”) as stated herein
            PATENT SERVICES USA will only follow independent registered patent attorney recommendation to the
            client’s file.
        </p>
        <p>
            &bull;All capitalized terms shall have the meaning ascribed to them in the Agreement unless otherwise defined in
            this Amendment.
        </p>
        <p>
            &bull;Except as expressly set forth in this Amendment, all other terms and conditions of the Agreement shall
            remain in full force and effect. To the extent any provision contained in this Amendment conflicts with the
            terms of the Agreement, the terms and provisions of this Amendment shall prevail. PATENT SERVICES
            USA is not a law firm and does not provide legal advice or legal opinion. PATENT SERVICES USA shall
            engage independent registered patent attorneys and/or patent agents to assist in certain matters relating to
            the services described herein. These patent services will include up to three actions in an attempt to resolve
            patent application modification or rejections through USPTO and/or any patent examiner as deemed
            necessary by a independent registered patent attorney. Any further actions required in connection with the
            Invention other than those stated in Section 9.4 shall be the sole responsibility of the inventor.
        </p>
        <p>
            &bull;Notwithstanding any other provision of this agreement, the INVENTOR expressly agrees that the
            independent registered patent attorney engaged by PATENT SERVICES USA shall work on matters in
            connection with the utility patent application and related non final office actions with the United States
            Patent And Trademark Office (hereinafter “USPTO”) as stated herein. In the event that there is a final
            rejection of such utility patent application then the independent registered patent attorney shall provide his
            or her recommendation to the client’s file to either proceed with 1) the request for continued examination
            (“RCE”) which shall not include continuation application, divisional application and/or continuation-in- part
            application ( 2) a design patent application for any subject matter within the utility application capable of
            protection under a design patent. 3) an appeal of the final rejection based upon the current status of the
            pending claims. INVENTOR shall pay any applicable fee if independent registered patent attorney
            recommends proceeding with RCE and PATENT SERVICES USA shall pay the filing fee if the
            independent registered patent attorney recommends proceeding with the design patent application.
            PATENT SERVICES USA shall not pay the applicable fee if independent registered patent attorney
            recommends proceeding with an appeal. PATENT SERVICES USA will not be liable for maintenance fees
            required by the USPTO nor will it be responsible to pay issuance fees or publication fees. PATENT
            SERVICES USA will only follow independent registered patent attorney recommendation to the client’s
            file.
        </p>
        <p><b>IN WITNESS WHEREOF</b>, the parties execute and make effective this Amendment as of the
            date last signed by a party hereto.
        </p>
        <div class="col-md-12 col-xs-12">
            <div class="col-md-6">
                <div class="col-md-12 col-xs-12">
                    <p>Inventor Name: <span style="text-decoration: underline;">{{ucwords($client->fname." ".$client->lname)}}</span></p>
                </div>
                <div class="col-xs-4 sigPad" id="smoothed">
                    <ul class="sigNav">
                        <li class="clearButton" style="display: list-item;"><a href="#clear">Clear</a></li>
                    </ul>
                    <div class="sig sigWrapper current">
                        <div class="typed" style="display: none; font-size: 24.375px;"></div>
                        <canvas class="pad" width="298" height="53"></canvas>
                        <input type="hidden" name="output" class="output">
                    </div>
                    <p class="drawItDesc">Inventor signature</p>
                </div>
            </div>
            @if(count($coInvs) > 0)
                <div class="col-md-6">
                    <div class="col-md-12 col-xs-12">
                        <p>Inventor Name: <span style="text-decoration: underline;">{{ucwords($coInvs[0])}}</span></p>
                    </div>
                    <div class="col-xs-4 sigPad" id="coInv_agreementExt">
                        <ul class="sigNav">
                            <li class="clearButton" style="display: list-item;"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="sig sigWrapper current">
                            <div class="typed" style="display: none; font-size: 24.375px;"></div>
                            <canvas class="pad" width="298" height="53"></canvas>
                            <input type="hidden" name="output1" class="output">
                        </div>
                        <p class="drawItDesc">Inventor signature</p>
                    </div>
                </div>
            @endif
        </div>

    </form>

</div>