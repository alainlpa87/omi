<div class="col-md-12  divContract">
    <p class="pLogo">
        <img src="<?php echo e(asset('/img/contracts/logo.png')); ?>" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
        <br><i>Giving the edge to Inventors!</i>
    </p>
    <p class="pTitle"><strong>PATENT PROTECTION AGREEMENT</strong></p>
    <h4><strong>SELECT PLANS:</strong></h4>
    <table width="100%">
        <tr>
            <td><input type="checkbox" id="plan1" name="plan1" class="plans" data-val="<?php echo e($contract->ppaPrices()->plan1); ?>"> PLAN 1 – UNITED STATES UTILITY PATENT APPLICATION PROGRAM</td>
            <td><?php echo e(money_format('%(#10n', $contract->ppaPrices()->plan1)); ?></td>
        </tr>
        <?php if($contract->halfPrice): ?>
            <tr>
                <td><input type="checkbox" id="halfPlan" name="planh" class="plans" data-id="halfPlan" data-val="<?php echo e(round($contract->ppaPrices()->plan1/2)); ?>" style="margin-left: 30px;"> HALF PAYMENT – A PROVISIONAL WILL BE FILED</td>
                <td><?php echo e(money_format('%(#10n', round($contract->ppaPrices()->plan1/2))); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td><input type="checkbox" id="plan2" name="plan2" class="plans" data-val="<?php echo e($contract->ppaPrices()->plan2); ?>"> PLAN 2 - UNITED STATES TRADEMARK APPLICATION PROGRAM</td>
            <td><?php echo e(money_format('%(#10n', $contract->ppaPrices()->plan2)); ?></td>
        </tr>
        <tr>
            <td><input type="checkbox" id="plan3" name="plan3" class="plans" data-val="<?php echo e($contract->ppaPrices()->plan3); ?>"> PLAN 3 - UNITED STATES COPYRIGHT APPLICATION PROGRAM</td>
            <td><?php echo e(money_format('%(#10n', $contract->ppaPrices()->plan3)); ?></td>
        </tr>
        <tr>
            <td><input type="checkbox" id="plan4" name="plan4" class="plans" data-val="<?php echo e($contract->ppaPrices()->plan4); ?>"> PLAN 4 – PATENT COOPERATION TREATY (HEREINAFTER “PCT”) PROGRAM</td>
            <td><?php echo e(money_format('%(#10n', $contract->ppaPrices()->plan4)); ?></td>
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
            <td><input type="checkbox" id="plan5" name="plan5" class="plans" data-val="<?php echo e($contract->ppaPrices()->plan5); ?>"> PKG A : </td>
            <td><?php echo e(money_format('%(#10n', $contract->ppaPrices()->plan5)); ?></td>
        </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 1 – UNITED STATES UTILITY PATENT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 4 – PATENT COOPERATION TREATY (HEREINAFTER “PCT”) PROGRAM</p></td>
                    <td></td>
                </tr>
        <tr>
            <td><input type="checkbox" id="plan6" name="plan6" class="plans" data-val="<?php echo e($contract->ppaPrices()->plan6); ?>"> TM & CR ADD ON : </td>
            <td><?php echo e(money_format('%(#10n', $contract->ppaPrices()->plan6)); ?></td>
        </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 2 - UNITED STATES TRADEMARK APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="margin-left: 30px;margin-bottom: 0px">PLAN 3 - UNITED STATES COPYRIGHT APPLICATION PROGRAM</p></td>
                    <td></td>
                </tr>
    </table>
    <br>
    <p class="pPrice" style="margin-right: 9%; border-right-width: 25px; float: right;">Total Price: $ <span id="tPrice">0.00</span></p>

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