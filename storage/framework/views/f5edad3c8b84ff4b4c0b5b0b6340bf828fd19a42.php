<div class="col-md-12  divContract">
    <form method="post" action="<?php echo e(url('launch/clientServices/signed')); ?>" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="trademark">
        <input type="hidden" name="project_id" value="<?php echo e($project_id); ?>">
        <p class="pLogo">
            <img src="<?php echo e(asset('/img/contracts/logo.png')); ?>" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>
        <p class="textRight">
            <?php echo e(date("m/d/Y")); ?>

        </p>
        <p>
            Dear <?php echo e(isset($client->fname)?ucwords($client->fname):"Client’s Name"); ?>,
        </p>
        <p>Congratulations on taking the next important step towards the development of your new invention—Full Patent Protection!  This is a tremendous accomplishment that few inventors ever begin.  Your courage and entrepreneurial spirit will carry you forward, step by step, to realizing your dream of becoming an accomplished inventor!</p>
        <p>We have received the Due Diligence materials, allowing us to submit your Patent Services Agreement to the Independent Registered Patent Attorney.  In order to submit your Copyright Application to the United States Patent and Trademark Office, the Independent Registered Patent Attorney, must receive the following requirements.</p>
        <p class="textCenter pSmall"  align="center">
            <strong><u>Trademark Questionnaire</u></strong>
        </p>
        <p class=" pSmall">
            Owner of Mark (Name): <input type="text" name="nameInput" class="form-control">
        </p>
        <p class=" pSmall">
            Country of Citizenship:<input type="text" name="nationalityInput" class="form-control">
        </p>
        <p class=" pSmall">
            Street Address: <input type="text" name="addressInput" class="form-control">
        </p>
        <p class=" pSmall">
            City, State, Zip: <input type="text" name="cityInput" class="form-control">
        </p>
        <p class=" pSmall">
            Phone Number: <input type="text" name="phoneInput" class="form-control">
        </p>
        <p class=" pSmall">
            E-mail Address: <input type="text" name="emailInput" class="form-control">
        </p>
        <div class="col-md-12">
            <div class="col-md-6" style="margin-left: -28px;">
                <p class=" pSmall">
                    Enter the mark here:<input type="text" name="markInput" class="form-control">
                </p>
            </div>
            <div class="col-md-6">
                <p class=" pSmall">
                    Has the mark been used?Date of first use:
                <div class='input-group date' id='mark_used_bef' style="margin-top: -10px;">
                    <input type='text' class="form-control" name="markDateInput"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                </div>
                </p>
            </div>
        </div>
        <p>
            <strong  class=" pSmall">Describe the Goods and/or Services</strong> for a single item (<i>e.g.,</i> pants), or multiple items (<i>e.g.,</i>, pants
            shoes) with which the mark will be used:
        </p>
        <p><input type="text" name="descGoodsInput" class="form-control"></p>
        <p>
            <strong  class=" pSmall">Describe how the mark has been used (<i>e.g.,</i> printed on the cartons of boxes;printed or stamped on the goods;labels attached
                to the goods;in advertising, <i>e.g.,</i> building signs ; magazine/newspaper; flyers; brochures, etc.):</strong>
        </p>
        <p><input type="text" name="descMarkUseInput" class="form-control"></p>
        <p class=" pSmall">
            Attached Specimen?
            <input type="radio" name="attached" value="Yes"> YES
            <input type="radio" name="attached" value="No"> NO
        </p>

        <p class="psmall">
            Description of Specimen
        </p>
        <p><textarea style="width: 100%;" name="descSpecimenInput" class="form-control"></textarea></p>
    </form>
    

    <p class="pMiniSmall">
        8.6. The INVENTOR expressly agrees and acknowledges that the INVENTOR shall timely provide any and all information including but not limited to specimens,
        descriptions or other details required to file an application with USPTO pursuant to the plan selected by the INVENTOR and that it is agreed by the INVENTOR that
        Patent Services shall not pay any additional costs or fees in connection with any delays caused by the INVENTOR in submitting information requested by –Patent
        Services.
    </p>
    <p class="pMiniSmall">
        DISCLAIMER:<br>
        This email message is for the sole use of the intended recipient(s) and may contain confidential and
        privileged information. Any unauthorized review, use, disclosure or distribution is prohibited. If you are not
        the intended recipient, please contact the sender by reply email and destroy all copies of the original
        message.
    </p>
</div>