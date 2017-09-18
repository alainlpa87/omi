<link href="<?php echo e(asset('/css/pdf_client.css')); ?>" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
    <p align="center" class="padd_cover">
        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
        <br><i style="font-size: 16px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>
    <p class="textRight  pSmall">
        <?php echo e(date("m/d/Y")); ?>

    </p>
    <p class=" pSmall" style="margin-bottom: 0px !important;">
        Dear <?php echo e(isset($fname)?$fname:"Client’s Name"); ?>,
    </p>
    <p class="psmall" style="margin-bottom: 0px !important;margin-top: 0px !important;">Congratulations on taking the next important step towards the development of your new invention—Full Patent Protection!  This is a tremendous accomplishment that few inventors ever begin.  Your courage and entrepreneurial spirit will carry you forward, step by step, to realizing your dream of becoming an accomplished inventor!</p>
    <p class="pSmall" style="margin-bottom: 0px !important;margin-top: 0px !important;">We have received the Due Diligence materials, allowing us to submit your Patent Services Agreement to the Independent Registered Patent Attorney.  In order to submit your Copyright Application to the United States Patent and Trademark Office, the Independent Registered Patent Attorney, must receive the following requirements.</p>
    <p class="textCenter pSmall" style="margin-top: 0px !important;">
        <strong>
            <u>
            Trademark Questionnaire
            </u>
        </strong>
    </p>
    <p class=" pSmall">
        Owner of Mark (Name): ________<u><?php echo e($ownerMark); ?></u>_____________
    </p>
    <p class=" pSmall">
        Country of Citizenship: ________<u><?php echo e($countryCitizenship); ?></u>___________
    </p>
    <p class=" pSmall">
        Street Address: _____________<u><?php echo e($address); ?></u>___________________
    </p>
    <p class=" pSmall">
        City, State, Zip: ___________<u><?php echo e($cityStateZip); ?></u>___________________
    </p>
    <p class=" pSmall">
        Phone Number: _______________<u><?php echo e($phone); ?></u>_________________
    </p>
    <p class=" pSmall">
        E-mail Address: _____________<u><?php echo e($email); ?></u>___________________
    </p>
    <p class=" pSmall">
        Enter the mark here: _________<u><?php echo e($mark); ?></u>__________________
    </p>
    <p class=" pSmall">
        Has the mark been used? _<u><?php echo e($markDate == ''?"No": "Yes"); ?></u>_____  Date of first use: <?php echo e($markDate == ''?"   N/A": $markDate); ?>

    </p>
    <p style="margin-bottom: 0px !important;">
        <strong  class=" pSmall">Describe the Goods and/or Services</strong> for a single item (<i>e.g.,</i> pants), or multiple items (<i>e.g.,</i>, pants
        shoes) with which the mark will be used:
    </p>
    <p>___________________<u><?php echo e($descGoods); ?></u>______________________________________________</p>
    <p  class=" pSmall" style="margin-bottom: 0px !important;">
        Describe how the mark has been used (<i>e.g.,</i> printed on the cartons of boxes;printed or stamped on the goods;labels attached
        to the goods;in advertising,<i>e.g.,</i> building signs;magazine/newspaper;flyers;brochures,etc.):
    </p>
    <p>____________________<u><?php echo e($descMarkUse); ?></u>______________________________________________</p>
    <p>
        Attached Specimen?<?php echo e($attachedS); ?>

    </p>
    <p style="margin-bottom: 0px !important;"><strong  class=" pSmall">Description of Specimen:</strong></p>
    <p><u><?php echo e($descSpecimen); ?></u></p>

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
<p class="textRight pSmall" style="width: 100%;">Inventor (s) Initial: <span style="text-decoration: underline;"><?php echo e(strtoupper($client->fname[0].$client->lname[0])); ?></span></p>
