
<?php $__env->startSection('title','Patent Services USA'); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/common.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/payment.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <h1 align="center"><strong>Patent Services Payment Terminal</strong></h1>


    <?php if($contract->project->id==8305): ?>
        <form id="formPayment" name="formPayment" method="post" action="<?php echo e(url('processTestPayment')); ?>" onsubmit="return checkForm();" enctype="multipart/form-data">
            <div class="col-md-6 col-sm-12 col-xs-12 boxPaymentInfo">
                <!-- PROJECT BLOCK -->
                <h2 class="subTitles">Project Information</h2>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Project Name: <strong><?php echo e($project->ideaName); ?></strong></label>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Contract Type: <strong><?php echo e($contract->type); ?></strong></label>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label class="col-md-3">Amount:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="text" id="project_price" onkeyup="checkFieldBack(this);" disabled="disabled" name="project_price" class="form-control" value="<?php echo e(money_format("%i", $contract->type!="PPA"?$contract->price - $contract->paid:$contract->ppaTotalPrice() - $contract->paid)); ?>">
                    </div>
                </div>
                <br><br>
                <!-- BILLING BLOCK -->
                <h2 class="subTitles">Billing Information</h2>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" id="fname" name="fname" placeholder="First Name" class="form-control" value="<?php echo e($project->lead->fname); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control" value="<?php echo e($project->lead->lname); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" id="address" name="address" placeholder="Address" class="form-control" value="<?php echo e($project->lead->street); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" id="city" name="city" placeholder="City" class="form-control" value="<?php echo e($project->lead->city); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <?php if($country = $project->lead->country): ?><?php endif; ?>
                        <?php echo $__env->make('omi.tools.country', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <?php if($state = $project->lead->state): ?><?php endif; ?>
                        <?php echo $__env->make('omi.tools.state', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" id="zip" name="zip" placeholder="ZIP/Postal Code" class="form-control" value="<?php echo e($project->lead->zip); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                        <input type="email" id="email" name="email" placeholder="E-mail" class="form-control" value="<?php echo e($project->lead->email); ?>">
                    </div>
                </div>
                <!-- BILLING BLOCK -->
            </div>

            <!-- CREDIT CARD BLOCK -->
            <div class="col-md-6 col-sm-12 col-xs-12 boxPaymentInfo">
                <h2 class="subTitles">Credit Card Information</h2>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Credit Card Type:</label>
                    <div class="input-group">
                        <input name="cctype" type="radio" value="V" class="lft-field" checked/> <img src="<?php echo e(asset('img/payment/ico_visa.jpg')); ?>" align="absmiddle" class="cardhide V"/>
                        <input name="cctype" type="radio" value="M" class="lft-field"/> <img src="<?php echo e(asset('img/payment/ico_mc.jpg')); ?>" align="absmiddle" class="cardhide M"/>
                        <input name="cctype" type="radio" value="A" class="lft-field"/> <img src="<?php echo e(asset('img/payment/ico_amex.jpg')); ?>" align="absmiddle" class="cardhide A"/>
                        <input name="cctype" type="radio" value="D" class="lft-field"/> <img src="<?php echo e(asset('img/payment/ico_disc.jpg')); ?>" align="absmiddle" class="cardhide D"/>

                        <?php if($project->echeck): ?>
                            <input name="cctype" type="radio" value="E" class="lft-field isCheck"/> <img src="<?php echo e(asset('img/payment/eCheck.png')); ?>" align="absmiddle" class="cardhide D"/>
                        <?php endif; ?>
                        <input name="cctype" type="radio" value="PP" class="lft-field isPayPal"/> <img src="<?php echo e(asset('img/payment/ico_paypal.png')); ?>" align="absmiddle" class="lft-field paypal cardhide PP"/>
                    </div>
                </div>
                <div class="ccinfo">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                            <input name="ccn" id="ccn" placeholder="Card Number" type="text" class="form-control"  onkeyup="checkNumHighlight(this.value);checkFieldBack(this);noAlpha(this);" value="" onkeypress="checkNumHighlight(this.value);noAlpha(this);" onblur="checkNumHighlight(this.value);" onchange="checkNumHighlight(this.value);" maxlength="16" />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input name="ccname" id="ccname" placeholder="Name on Card" type="text" class="form-control"  onkeyup="checkFieldBack(this);"  />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <select name="exp1" id="exp1" class="form-control" onchange="checkFieldBack(this);">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <select name="exp2" id="exp2" class="form-control" onchange="checkFieldBack(this);">
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input name="cvv" id="cvv" placeholder="CVV" type="text" maxlength="5" class="form-control"  onkeyup="checkFieldBack(this);noAlpha(this);"/>
                        </div>
                    </div>
                </div>
                <div class="checkinfo" style="display: none;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <input name="rnumber" id="rnumber" placeholder="Routing Number" type="text" class="form-control"  onkeyup="checkNumHighlightCheck(this.value);checkFieldBack(this);noAlpha(this);" value="" onkeypress="checkNumHighlightCheck(this.value);noAlpha(this);" onblur="checkNumHighlightCheck(this.value);" onchange="checkNumHighlightCheck(this.value);" maxlength="9" />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <input name="anumber" id="anumber" placeholder="Account Number" type="text" class="form-control"  onkeyup="checkNumHighlightCheck(this.value);checkFieldBack(this);noAlpha(this);" value="" onkeypress="checkNumHighlightCheck(this.value);noAlpha(this);" onblur="checkNumHighlightCheck(this.value);" onchange="checkNumHighlightCheck(this.value);" maxlength="20" />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <input name="bkname" id="bkname" placeholder="Bank Name" type="text" class="form-control"  onkeyup="checkFieldBack(this);"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <select name="accttype" id="accttype" class="form-control" onchange="checkFieldBack(this);">
                                <option value="">Please Select</option>
                                <option value="Personal Checking"  >Personal Checking</option>
                                <option value="Business Checking"  >Business Checking</option>
                                <option value="Savings" >Savings</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="submit-btn">
                    <input type="hidden" name="contract_id" value="<?php echo e($contract->id); ?>">
                    <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                    <input src="<?php echo e(asset('img/payment/btn_submit.jpg')); ?>" type="image" name="submit" />
                </div>
                <?php if(isset($error)): ?>
                    <input type="hidden" id="errorText" value="<?php echo e($error); ?>">
                <?php endif; ?>
            </div>
            <!-- CREDIT CARD BLOCK -->
        </form>
    <?php else: ?>
        <form id="formPayment" name="formPayment" method="post" action="<?php echo e(url('process')); ?>" onsubmit="return checkForm();" enctype="multipart/form-data">
            <div class="col-md-6 col-sm-12 col-xs-12 boxPaymentInfo">
                <!-- PROJECT BLOCK -->
                <h2 class="subTitles">Project Information</h2>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Project Name: <strong><?php echo e($project->ideaName); ?></strong></label>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Contract Type: <strong><?php echo e($contract->type); ?></strong></label>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label class="col-md-3">Amount:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="text" id="project_price" onkeyup="checkFieldBack(this);" name="project_price" class="form-control" value="<?php echo e(money_format("%i", $contract->type!="PPA"?$contract->price - $contract->paid:$contract->ppaTotalPrice() - $contract->paid)); ?>">
                    </div>
                </div>
                
                
                <!-- PROJECT BLOCK -->
                <br><br>
                <!-- BILLING BLOCK -->
                <h2 class="subTitles">Billing Information</h2>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" id="fname" name="fname" placeholder="First Name" class="form-control" value="<?php echo e($project->lead->fname); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control" value="<?php echo e($project->lead->lname); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" id="address" name="address" placeholder="Address" class="form-control" value="<?php echo e($project->lead->street); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" id="city" name="city" placeholder="City" class="form-control" value="<?php echo e($project->lead->city); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <?php if($country = $project->lead->country): ?><?php endif; ?>
                        <?php echo $__env->make('omi.tools.country', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <?php if($state = $project->lead->state): ?><?php endif; ?>
                        <?php echo $__env->make('omi.tools.state', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" id="zip" name="zip" placeholder="ZIP/Postal Code" class="form-control" value="<?php echo e($project->lead->zip); ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                        <input type="email" id="email" name="email" placeholder="E-mail" class="form-control" value="<?php echo e($project->lead->email); ?>">
                    </div>
                </div>
                <!-- BILLING BLOCK -->
            </div>

            <!-- CREDIT CARD BLOCK -->
            <div class="col-md-6 col-sm-12 col-xs-12 boxPaymentInfo">
                <h2 class="subTitles">Credit Card Information</h2>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Credit Card Type:</label>
                    <div class="input-group">
                        <input name="cctype" type="radio" value="V" class="lft-field" checked/> <img src="<?php echo e(asset('img/payment/ico_visa.jpg')); ?>" align="absmiddle" class="cardhide V"/>
                        <input name="cctype" type="radio" value="M" class="lft-field"/> <img src="<?php echo e(asset('img/payment/ico_mc.jpg')); ?>" align="absmiddle" class="cardhide M"/>
                        <input name="cctype" type="radio" value="A" class="lft-field"/> <img src="<?php echo e(asset('img/payment/ico_amex.jpg')); ?>" align="absmiddle" class="cardhide A"/>
                        <input name="cctype" type="radio" value="D" class="lft-field"/> <img src="<?php echo e(asset('img/payment/ico_disc.jpg')); ?>" align="absmiddle" class="cardhide D"/>

                        <?php if($project->echeck): ?>
                            <input name="cctype" type="radio" value="E" class="lft-field isCheck"/> <img src="<?php echo e(asset('img/payment/eCheck.png')); ?>" align="absmiddle" class="cardhide D"/>
                        <?php endif; ?>
                        <input name="cctype" type="radio" value="PP" class="lft-field isPayPal"/> <img src="<?php echo e(asset('img/payment/ico_paypal.png')); ?>" align="absmiddle" class="lft-field paypal cardhide PP"/>
                    </div>
                </div>
                <div class="ccinfo">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                            <input name="ccn" id="ccn" placeholder="Card Number" type="text" class="form-control"  onkeyup="checkNumHighlight(this.value);checkFieldBack(this);noAlpha(this);" value="" onkeypress="checkNumHighlight(this.value);noAlpha(this);" onblur="checkNumHighlight(this.value);" onchange="checkNumHighlight(this.value);" maxlength="16" />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input name="ccname" id="ccname" placeholder="Name on Card" type="text" class="form-control"  onkeyup="checkFieldBack(this);"  />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <select name="exp1" id="exp1" class="form-control" onchange="checkFieldBack(this);">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <select name="exp2" id="exp2" class="form-control" onchange="checkFieldBack(this);">
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input name="cvv" id="cvv" placeholder="CVV" type="text" maxlength="5" class="form-control"  onkeyup="checkFieldBack(this);noAlpha(this);"/>
                        </div>
                    </div>
                </div>
                <div class="checkinfo" style="display: none;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <input name="rnumber" id="rnumber" placeholder="Routing Number" type="text" class="form-control"  onkeyup="checkNumHighlightCheck(this.value);checkFieldBack(this);noAlpha(this);" value="" onkeypress="checkNumHighlightCheck(this.value);noAlpha(this);" onblur="checkNumHighlightCheck(this.value);" onchange="checkNumHighlightCheck(this.value);" maxlength="9" />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <input name="anumber" id="anumber" placeholder="Account Number" type="text" class="form-control"  onkeyup="checkNumHighlightCheck(this.value);checkFieldBack(this);noAlpha(this);" value="" onkeypress="checkNumHighlightCheck(this.value);noAlpha(this);" onblur="checkNumHighlightCheck(this.value);" onchange="checkNumHighlightCheck(this.value);" maxlength="20" />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <input name="bkname" id="bkname" placeholder="Bank Name" type="text" class="form-control"  onkeyup="checkFieldBack(this);"  />
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                            <select name="accttype" id="accttype" class="form-control" onchange="checkFieldBack(this);">
                                <option value="">Please Select</option>
                                <option value="Personal Checking"  >Personal Checking</option>
                                <option value="Business Checking"  >Business Checking</option>
                                <option value="Savings" >Savings</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="submit-btn">
                    <input type="hidden" name="contract_id" value="<?php echo e($contract->id); ?>">
                    <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                    <input src="<?php echo e(asset('img/payment/btn_submit.jpg')); ?>" type="image" name="submit" />
                </div>
                <?php if(isset($error)): ?>
                    <input type="hidden" id="errorText" value="<?php echo e($error); ?>">
                <?php endif; ?>
            </div>
            <!-- CREDIT CARD BLOCK -->
        </form>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("js/autoNumeric.js")); ?>"></script>
    <script src="<?php echo e(asset("/js/omi/payment.js")); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('omi.layout.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>