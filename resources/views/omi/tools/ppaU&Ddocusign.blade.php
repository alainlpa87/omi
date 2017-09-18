<div class="col-md-12  divContract">
    <p class="pLogo">
        <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
        <br><i>Giving the edge to Inventors!</i>
    </p>
    <p class="pTitle"><strong>PATENT PROTECTION AGREEMENT</strong></p>
    <h4><strong>CHECK PLANS:</strong></h4>
    <table width="100%">
        <tr>
            <td><input type="checkbox" id="plan1" name="plan1" class="plans" data-val="{{$contract->ppaPrices()->plan1}}"> PLAN 1 – UNITED STATES UTILITY PATENT APPLICATION PROGRAM</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan1)}}</td>
        </tr>
        @if($contract->halfPrice)
            <tr>
                <td><input type="checkbox" id="halfPlan" name="planh" class="plans" data-id="halfPlan" data-val="{{round($contract->ppaPrices()->plan1/2)}}" style="margin-left: 30px;"> HALF PAYMENT – A PROVISIONAL WILL BE FILED</td>
                <td>{{money_format('%(#10n', round($contract->ppaPrices()->plan1/2))}}</td>
            </tr>
        @endif
        <tr>
            <td><input type="checkbox" id="plan2" name="plan2" class="plans" data-val="{{$contract->ppaPrices()->plan2}}"> PLAN 2 – UNITED STATES DESIGN PATENT APPLICATION PROGRAM</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan2)}}</td>
        </tr>
        <tr>
            <td><input type="checkbox" id="plan3" name="plan3" class="plans" data-val="{{$contract->ppaPrices()->plan3}}"> PLAN 3 – UNITED STATES TRADEMARK APPLICATION PROGRAM</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan3)}}</td>
        </tr>
        <tr>
            <td><input type="checkbox" id="plan4" name="plan4" class="plans" data-val="{{$contract->ppaPrices()->plan4}}"> PLAN 4 - UNITED STATES COPYRIGHT APPLICATION PROGRAM</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan4)}}</td>
        </tr>
        <tr>
            <td><input type="checkbox" id="plan5" name="plan5" class="plans" data-val="{{$contract->ppaPrices()->plan5}}"> PLAN 5 - EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan5)}}</td>
        </tr>
        <tr>
            <td><input type="checkbox" id="plan6" name="plan6" class="plans" data-val="{{$contract->ppaPrices()->plan6}}"> PLAN 6 – PATENT COOPERATION TREATY (HEREINAFTER “PCT”) PROGRAM</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan6)}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr style="border-top-color: black; border-top-width: 1px; border-top-style: solid;">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><input type="checkbox" id="plan7" name="plan7" class="plans" data-val="{{$contract->ppaPrices()->plan7}}"> PKG A :</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan7)}}</td>
        </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 1 – UNITED STATES UTILITY PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 2 – UNITED STATES DESIGN PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
        <tr>
            <td><input type="checkbox" id="plan8" name="plan8" class="plans" data-val="{{$contract->ppaPrices()->plan8}}"> PKG B :</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan8)}}</td>
        </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 1 – UNITED STATES UTILITY PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 5 - EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
        <tr>
            <td><input type="checkbox" id="plan9" name="plan9" class="plans" data-val="{{$contract->ppaPrices()->plan9}}"> PKG C :</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan9)}}</td>
        </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 1 – UNITED STATES UTILITY PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 2 – UNITED STATES DESIGN PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 5 - EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
        <tr>
            <td><input type="checkbox" id="plan10" name="plan10" class="plans" data-val="{{$contract->ppaPrices()->plan10}}"> PKG D :</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan10)}}</td>
        </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 1 – UNITED STATES UTILITY PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 2 – UNITED STATES DESIGN PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 6 – PATENT COOPERATION TREATY (HEREINAFTER “PCT”) PROGRAM</p></td>
                    <td></td>
                </tr>
        <tr>
            <td><input type="checkbox" id="plan11" name="plan11" class="plans" data-val="{{$contract->ppaPrices()->plan11}}"> PKG E :</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan11)}}</td>
        </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 1 – UNITED STATES UTILITY PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 2 – UNITED STATES DESIGN PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 5 - EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 6 – PATENT COOPERATION TREATY (HEREINAFTER “PCT”) PROGRAM</p></td>
                    <td></td>
                </tr>
        <tr>
            <td><input type="checkbox" id="plan12" name="plan12" class="plans" data-val="{{$contract->ppaPrices()->plan12}}"> TM & CR ADD ON :</td>
            <td>{{money_format('%(#10n', $contract->ppaPrices()->plan12)}}</td>
        </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 3 - UNITED STATES TRADEMARK APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 4 - UNITED STATES COPYRIGHT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
    </table>

    <p class="pPrice" style="margin-right: 4%; border-right-width: 25px; float: right;">Total Price: $ <span id="tPrice">0.00</span></p>
    <br>


    <div class="" hidden="hidden">
        <div class="col-md-12 col-xs-12">
            <p>
                Client Authorization:
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
    <p class="agree" hidden="hidden">
        <input type="checkbox" id="chk" checked><label class="labelAgree" for="chk">&nbsp;I Agree</label>
        <a style="color: red" id="seeLink">See Legal Disclosure and Information</a>
    </p>
    <br>
    <div class="divRepresentative">
        <br>
        <strong class="tam14">Authorized PATENT SERVICES USA Representative:</strong>
        Rick Blake
    </div>
    <div align="center" style="margin-top:6px; margin-bottom: 10px;" class="shadow">
        12000 Biscayne Boulevard, Suite 700 / North Miami, FL 33181 Phone: 1-877-652-4908 / Fax: 1-800-886-7951
    </div>
</div>