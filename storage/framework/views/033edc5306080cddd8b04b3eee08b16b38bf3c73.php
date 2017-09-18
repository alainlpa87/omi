<div id="submitRequestModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Complete Your Profile</h4>
            </div>
            <div class="modal-body col-md-12">
                <div id="firstBlock">
                    <p><strong>What category does your invention idea fall into?</strong></p>
                    <div class="col-md-6 col-xs-6">
                        <div class="col-md-12 fixCategories">
                            <label>
                                <input name="txt_answer_1" id="txt_answer_1" type="radio" value="Automotive" checked="checked">
                            </label>
                            <span class="labletxt">Automotive</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value=">Bathroom Items"></label>
                            <span>Bathroom Items</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Baby Products"></label>
                            <span>Baby Products </span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Clothing"></label>
                            <span>Clothing</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Computers"></label>
                            <span>Computers</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Cosmetics"></label>
                            <span>Cosmetics</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Electronics"></label>
                            <span>Electronics</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Eco-Friendly / Green"></label>
                            <span>Eco-Friendly / Green </span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Equipment"></label>
                            <span>Equipment</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Exercise &amp; Health"></label>
                            <span>Exercise &amp; Health</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Food Products"></label>
                            <span>Food Products</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Housewares"></label>
                            <span>Housewares</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Hunting &amp; Fishing"></label>
                            <span>Hunting &amp; Fishing</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Jewelry"></label>
                            <span>Jewelry</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Kitchen Items"></label>
                            <span>Kitchen Items</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Marine"></label>
                            <span>Marine</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Novelties"></label>
                            <span>Novelties</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Pets"></label>
                            <span>Pets</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Sports"></label>
                            <span>Sports</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Tools"></label>
                            <span>Tools</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Toys &amp; Games"></label>
                            <span>Toys &amp; Games</span>
                        </div>
                        <div class="col-md-12 fixCategories">
                            <label><input name="txt_answer_1" id="txt_answer_1" type="radio" value="Other"></label>
                            <span>Other</span>
                        </div>
                    </div>
                </div>
                <div id="secondBlock" style="display: none;">
                    <div class="col-md-12">
                        <p>Do you currently hold a patent for your idea or invention? *</p>
                        <select name="patent_register" id="patent_register" class="form-control">
                            <option value="-1"> Select </option>
                            <option value="0">I Do Not Have A Patent</option>
                            <option value="1">I Have A Patent</option>
                        </select>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <p>Are you at least 18 years of age? *</p>
                        <select name="new_lead_18" id="new_lead_18" class="form-control">
                            <option value="-1"> Select </option>
                            <option value="1">I Am</option>
                            <option value="0">I Am Not</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btnNextIndex" onclick="Next();">NEXT</button>
                <button type="button" onclick="Back();" class="btn btn-default btnBackIndex" id="registerNoContinue" style="display: none;">Back</button>
                <button type="button" class="btn btn-primary btnSubmitIndex" onclick="submitLayoutHeader();" style="display: none;">Yes, take me there</button>
            </div>
        </div>
    </div>
    <form action="<?php echo e(url('register')); ?>" method="post" id="formLaravel" >
        <input type="hidden" id="emailLaravel" name="EMAIL">
        <input type="hidden" id="fnameLaravel" name="FNAME">
        <input type="hidden" id="lnameLaravel" name="LNAME">
        <input type="hidden" id="dphoneLaravel" name="PHONE">
        <input type="hidden" id="categoryH" name="CATEGORY">
        <input type="hidden" id="patentH" name="PATENT">
        <input type="hidden" id="areLeast18H" name="ARELEAST18">
    </form>
</div>
