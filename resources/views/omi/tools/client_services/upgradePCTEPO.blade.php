<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="upgradeLetter">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p class="pLogo">
            <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>
        <br>
        <p style="text-align: left;">
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
            With this in mind, we are communicating to remind you that your Utility Patent Application number
            for the is due for an upgrade on.
        </p>
        <p class="pSmall">
            <input type="checkbox" name="plan_4" id="plan_4" value="1" > &nbsp;&nbsp;<b class="pSmall">PLAN 4</b>- EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ 7,949
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
            <input type="checkbox" name="plan_5" id="plan_5" value="1"> &nbsp;&nbsp;<b class="pSmall">PLAN 5</b>-  PATENT COOPERATION TREATY (HEREINAFTER “PCT”) PROGRAM  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ 6,949
        </p>
        <p class="pSmall">
            The PCT is an international treaty administered by the World Intellectual Property Organization,  between more than 125 countries (Paris Convention Member States).
        </p>
        <p class="pSmall">
            3.1.5.1. PATENT SERVICES USA, INC. will facilitate and coordinate the necessary documentation by working with the INVENTOR and registered patent attorney regarding the international patent application filing.
        </p>

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
        <table width="80%">
            <tr style="margin-bottom: 0px !important;">
                <td style="margin-bottom: 0px !important;padding-left: 60px;">
                    <p  style="margin-bottom: 0px !important;text-align: left;">____________________________</p>
                </td>
                <td style="margin-bottom: 0px !important;">
                    <div class="pull-right">
                        <div class="sigPad sign-add-d" id="signt_inv"  style="padding-top: 5px;">
                            <div class="sig sigWrapper current">
                                <canvas class="pad" width="290" height="50"></canvas>
                                <input type="hidden" name="output_1" class="output">
                            </div>
                            <ul class="sigNav">
                                <li class="clearButton" style="display: list-item;margin: 0px !important;"><a href="#clear" style="font-size: 11px !important;">Clear</a></li>
                            </ul>
                        </div>
                    </div>
                    {{--<p style="margin-bottom: 0px !important;text-align: right"> ____________________________</p>--}}
                </td>
            </tr>
            <tr style="margin-top: 0px !important;">
                <td style="margin-top: 0px !important;padding-left: 60px;">
                    <p style="margin-top: 0px !important;text-align: left">Patent Services, Inc<br>Authorized Representative  </p>
                </td>
                <td style="margin-top: 0px !important;text-align: right;padding-right: 20px;">
                    <p style="margin-top: 0px !important;text-align: right">(Inventor name), Inventor</p>
                </td>
            </tr>
        </table>
        <br>
        @if($project->coInventor != "")
        <table width="80%">
            <tr>
                <td>
                    <div class="pull-right">
                        <div class="sigPad sign-add-d" id="signt_coinv"  style="padding-top: 5px;">
                            <div class="sig sigWrapper current">
                                <canvas class="pad" width="290" height="50"></canvas>
                                <input type="hidden" name="output_2" class="output">
                            </div>
                            <ul class="sigNav">
                                <li class="clearButton" style="display: list-item;margin: 0px !important;"><a href="#clear" style="font-size: 11px !important;">Clear</a></li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-top: 0px !important;text-align: right;">(Co-Inventor name), Co-Inventor </p>
                </td>
            </tr>
        </table>
        @endif
        <br><br>

        {{--<p style="text-align: center;"><b>PAYMENT</b></p>--}}
        {{--<p class="pSmall">Inventor Name: &nbsp;&nbsp;<input type="text" name="inv_name" style="width: 300px;"> &nbsp;&nbsp;File #: &nbsp;&nbsp;<input type="number" name="fileno"></p>--}}
        {{--<p class="pSmall">Credit/debit card: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="card_type" value="american"> American Express&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="card_type" value="mastercard"> MasterCard&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="card_type" value="visa"> Visa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="card_type" value="discover"> Discover Card </p>--}}
        {{--<p class="pSmall">Card Number:--}}
            {{--&nbsp;&nbsp;&nbsp;&nbsp;--}}
            {{--<input type="number" min="0" max="9" name="cardNo_1" style="width: 20px;height: 20px;">--}}
            {{--<input type="number" min="0" max="9" name="cardNo_2" style="width: 20px;height: 20px;">--}}
            {{--<input type="number" min="0" max="9" name="cardNo_3" style="width: 20px;height: 20px;">--}}
            {{--<input type="number" min="0" max="9" name="cardNo_4" style="width: 20px;height: 20px;"> ---}}
            {{--<input type="number" min="0" max="9" name="cardNo_5" style="width: 20px;height: 20px;">--}}
            {{--<input type="number" min="0" max="9" name="cardNo_6" style="width: 20px;height: 20px;">--}}
            {{--<input type="number" min="0" max="9" name="cardNo_7" style="width: 20px;height: 20px;">--}}
            {{--<input type="number" min="0" max="9" name="cardNo_8" style="width: 20px;height: 20px;"> ---}}
            {{--<input type="number" min="0" max="9" name="cardNo_9" style="width: 20px;height: 20px;">--}}
            {{--<input type="number" min="0" max="9" name="cardNo_10" style="width: 20px;height: 20px;">--}}
            {{--<input type="number" min="0" max="9" name="cardNo_11" style="width: 20px;height: 20px;">--}}
            {{--<input type="number" min="0" max="9" name="cardNo_12" style="width: 20px;height: 20px;">--}}
            {{--&nbsp;&nbsp;Expiration Date:&nbsp;&nbsp;--}}
            {{--<input type="number" min="0" max="99" name="cardExpMM" placeholder="mm" style="width: 50px;height: 20px;">/--}}
            {{--<input type="number" min="0" max="99" name="cardExpYY" placeholder="yy" style="width: 50px;height: 20px;">--}}
        {{--</p>       --}}
        {{--<p class="pSmall">Amt. to be charged: $ _______________________  &nbsp;<img src="{{asset('/img/unchk_square.png') }}" alt=""> Payment by Check/Money Order $ ____________________ </p>--}}
        {{--<p class="pSmall">Print name as it appears on the card: __________________________________________</p>--}}
        {{--<p class="pSmall">Signature: __________________________________________________ Date:_____________________________ </p>--}}
        {{--<p>__________________________________________________________________________________</p>--}}
        {{--<br>--}}
        <p style="text-align: right" class="pSmall"> Sincerely, </p>
        <p style="text-align: right" class="pSmall NoMargin">Client Support Services</p>
        <p style="text-align: right" class="pSmall NoMargin">PATENT SERVICES </p>
        <p style="text-align: right" class="pSmall NoMargin">12000 Biscayne Blvd Suite # 700 </p>
        <p style="text-align: right" class="pSmall NoMargin">North Miami, FL 33181 </p>
        <p style="text-align: right" class="pSmall NoMargin">1-888-344-6836 ext. 237 </p>
        <p style="text-align: right" class="pSmall NoMargin">1-800-886-7951 Fax</p>
        <p style="font-size:12px;">Disclaimer: PATENT SERVICES is not a law firm and does not provide legal advice or legal opinion.  PATENT SERVICES shall engage an Independent Registered Patent Attorney and/or Patent Agent to assist in certain matters relating to the services described herein. </p>
    </form>
</div>