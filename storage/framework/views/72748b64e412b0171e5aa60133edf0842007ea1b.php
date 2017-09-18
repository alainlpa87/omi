<link href="<?php echo e(asset('/css/pdf_client.css')); ?>" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
<table style="width: 100%;">
    <colgroup>
        <col width="20%">
        <col width="15%">
        <col width="65%">
    </colgroup>
    <tr >
        <td colspan="2">
            <p align="left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;" >Doc Code: PA..</b></p>
            <p align="left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;">Document Description: Power of Attorney</b></p>
        </td>
        <td colspan="1">
            <p align="right" class="superSmall">PTO/AIA/82A (07-13)</p>
            <p align="right" class="superSmall">Approved for use through 11/30/2014. OMB 0651-0051</p>
        </td>
    </tr>
    <tr style="margin-top: 0px !important;padding-top: 0px !important;">
        <td colspan="3" style="padding-top: 0px !important;margin-top: 0px !important;">
            <p align="right" class="superSmall">U.S. Patent and Trademark Office; U.S. DEPARTMENT OF COMMERCE</p>
            <p class="superSmall">Under the Paperwork Reduction Act of 1995, no persons are required to respond to a collection of information unless it contains a valid OMB control number.</p>
        </td>
    </tr>
</table>

<table class="border-round">
    <tr>
        <td>
            <p align="center" class="mySmall"><b>TRANSMITTAL FOR POWER OF ATTORNEY TO ONE OR MORE</b></p>
            <p align="center" class="mySmall"><b>REGISTERED PRACTITIONERS</b></p>
        </td>

    </tr>
</table>

<table class="border-normal" style="margin-bottom: 0px !important;">
    <tr>
        <td colspan="5" style="border-bottom: 1px solid black;">
            <p class="mySmall" style="margin-left: 10px !important;margin-right: 10px !important;"><u>NOTE:</u> This form is to be submitted with the Power of Attorney by Applicant form(PTO/AIA/82B)
                to identify the application to which the Power of Attorney is directed, in accordance with 37 CFR 1.5. If the Power of
                Attorney by Applicant form is not accompanied by this transmittal form or an equivalent, the Power of Attorney will
                not be recognized in the application.
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="width: 33%;" class="inner-border"><p class="mySmall">Application Number</p></td>
        <td colspan="3" style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
        <td colspan="2" class="inner-border"><p class="mySmall">Filing Date</p></td>
        <td colspan="3" style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
        <td colspan="2" class="inner-border"><p class="mySmall">First Named Inventor </p></td>
        <td colspan="3" style="border-bottom: 1px solid black;"><p class="mySmall" align="left"><b><?php echo e(ucwords($client->fname." ".$client->lname)); ?></b></p></td>
    </tr>
    <tr>
        <td colspan="2" class="inner-border"><p class="mySmall">Title </p></td>
        <td colspan="3" style="border-bottom: 1px solid black;"><?php if($design == 0): ?><?php echo e(strtoupper($pcs->titleofinvention)); ?> <?php else: ?><?php echo e(strtoupper($pcs->titleofinventionD)); ?> <?php endif; ?></td>
    </tr>
    <tr>
        <td colspan="2" class="inner-border"><p class="mySmall">Art Unit</p></td>
        <td colspan="3" style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
        <td colspan="2" class="inner-border"><p class="mySmall">Examiner Name</p></td>
        <td colspan="3" style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
        <td colspan="2" class="inner-border"><p class="mySmall">Attorney Docket Number</p></td>
        <td colspan="3" style="border-bottom: 1px solid black;"><?php echo e($client->fileno); ?></td>
    </tr>
    <tr>
        <td colspan="5" style="border-bottom: 1px solid black;"><p class="mySmall" align="center" style="margin-bottom: 0px !important;">SIGNATURE of Applicant or Patent Practitioner </p></td>
    </tr>
    <tr>
        <td colspan="1" class="inner-border"><p class="mySmall">Signature</p></td>
        <td colspan="2" class="inner-border">
            <?php if($coInvIndex==0): ?>
                <img src="<?php echo e(asset('files/projects/'.$fileno.'/signature_poa.jpg')); ?>">
            <?php else: ?>
                <img src="<?php echo e(asset('files/projects/'.$fileno.'/signature_poa_coInv'.$coInvIndex.'.jpg')); ?>">
            <?php endif; ?>
        </td>
        <td colspan="1" class="inner-border" style="width: 10%;"><p class="mySmall">Date</p></td>
        <td colspan="1" style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
        <td colspan="1" class="inner-border"><p class="mySmall">Name </p></td>
        <td colspan="2" class="inner-border">
            <p class="mySmall" align="left">
                <?php if($coInvIndex==0): ?>
                    <?php echo e(ucwords($client->fname." ".$client->lname)); ?>

                <?php else: ?>
                    <?php echo e(ucwords($coInvs[$coInvIndex - 1])); ?>

                <?php endif; ?>
            </p>
        </td>
        <td colspan="1" class="inner-border"><p class="mySmall">Registration <br>Number</p></td>
        <td colspan="1" style="border-bottom: 1px solid black;"></td>
    </tr>
    <tr>
        <td colspan="1" class="inner-border"><p class="mySmall">Title (if Applicant is a juristic entity)</p></td>
        <td colspan="4" style="border-bottom: 1px solid black;">
        </td>
    </tr>
    <tr>
        <td colspan="2" class="inner-border"><p class="mySmall">Applicant Name (if Applicant is a juristic entity)</p></td>
        <td colspan="3" style="border-bottom: 1px solid black;">
        </td>
    </tr>
    <tr>
        <td colspan="5" style="border-bottom: 1px solid black;"><p class="verySmall">NOTE: This form must be signed in accordance with 37 CFR 1.33. See 37 CFR 1.4(d)for signatures requirements and certifications.If more than one applicant, use multiple forms.</p></td>
    </tr>
    <tr>
        <td colspan="5"><p class="verySmall"> &nbsp;<img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""> &nbsp;&nbsp;&nbsp;*Total of <u>&nbsp;&nbsp;<?php echo e($coInvCount+1); ?>&nbsp;&nbsp;</u> forms are submitted.</p></td>
    </tr>
</table>
<p style="font-size: 11px; margin: 0.0em !important;padding: 0.0em !important;" align="left">This collection of information is required by 37 CFR 1.31, 1.32 and 1.33. The information is required to
    obtain or retain a benefit by the public which is to file (and by the USPTO to process) an application. Confidentiality is
    governed by 35 U.S.C. 122 and 37 CFR 1.11 and 1.14. This collection is estimated to take 3 minutes to complete, including
    gathering, preparing, and submitting the completed application form to the USPTO. Time will vary depending upon the individual
    case.  Any comments on the amount of time you require to complete this form and/or suggestions for reducing this burden,
    should be sent to the Chief Information Officer, U.S. Patent and Trademark Office, U.S. Department of Commerce, P.O. Box 1450,
    Alexandria, VA 22313-1450. DO NOT SEND FEES OR COMPLETED FORMS TO THIS ADDRESS. SEND TO: Commissioner for Patents, P.O. Box
    1450, Alexandria, VA 22313-1450.
</p>
<p style="font-size: 11px; margin: 0.0em !important;padding: 0.0em !important;" align="center">If you need assistance in completing the form, call 1-800-PTO-9199 and select option 2. </p>

<div class="page-break"></div>
<!--page 2-->
<table style="width: 100%;">
    <colgroup>
        <col width="20%">
        <col width="15%">
        <col width="65%">
    </colgroup>
    <tr >
        <td colspan="2">
            <p align="left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;" >Doc Code: PA..</b></p>
            <p align="left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;">Document Description: Power of Attorney</b></p>
        </td>
        <td colspan="1">
            <p align="right" style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">PTO/AIA/82B (07-13)</p>
            <p align="right" style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">Approved for use through 11/30/2014. OMB 0651-0051</p>
        </td>
    </tr>
    <tr style="margin-top: 0px !important;padding-top: 0px !important;">
        <td colspan="3" style="padding-top: 0px !important;margin-top: 0px !important;">
            <p align="right" style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">U.S. Patent and Trademark Office; U.S. DEPARTMENT OF COMMERCE</p>
            <p align="right" style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">Under the Paperwork Reduction Act of 1995, no persons are required to respond to a collection of information unless it contains a valid OMB control number.</p>
        </td>
    </tr>
</table>

<table class="border-round">
    <tr>
        <td>
            <p align="center" style="font-size: 18px !important;margin-top: 0px !important;margin-bottom: 0px !important;"><b>POWER OF ATTORNEY BY APPLICANT </b></p>
        </td>

    </tr>
</table>

<div class="col-md-12" style="border: 2px solid black;">
    <div style="width: 100%;border-bottom:2px solid black;padding:0px !important;margin: 0px !important;">
        <p style="font-size: 11px;padding:0px !important;margin: 0px 0px 0px 10px !important;">I hereby revoke all previous powers of attorney given in the application identified in either the attached transmittal letter or the boxes below.</p>
    </div>
    <div style="width: 100%;border-bottom:2px solid black;padding:0px !important;margin: 0px !important;">
        <table class="border-normal" style="width: 70% !important;margin-left: 108px !important;">
            <tr>
                <td colspan="2" class="inner-border"><p class="mySmall"><b>Application Number</b> </p></td>
                <td colspan="1" style="border-bottom: 1px solid black;"><b>Filing Date</b></td>
            </tr>
            <tr>
                <td colspan="2" class="inner-border"><p class="mySmall"><br></p></td>
                <td colspan="1" style="border-bottom: 1px solid black;"><br></td>
            </tr>
        </table>
        <p align="center" class="superSmall">(Note: The boxes above may be left blank if information is provided on form PTO/AIA/82A.)</p>
        <p class="pSmall" style="margin-bottom: 0px !important;padding: 0px !important;font-size: 12px !important;">
            &nbsp;<img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt="">
            I hereby appoint Practitioner(s) associated with the following Customer Number as my/our attorney(s) or agent(s),
        </p>
        <p class="pSmall" style="margin:0px 0px 0px 10px !important;padding: 0px !important;font-size: 12px !important;">and to
            transact all business in the United States Patent and Trademark Office connected therewith for the application referenced
            in the attached transmittal letter (form PTO/AIA/82A) or identified above:</p>
        <textarea style="position: relative !important;top: -10px !important;margin-bottom: 0px !important;padding: 0px !important;margin-left: 490px !important;width: 100px !important;height: 20px !important; border: 1px solid black !important;"><?php echo e($attorney->customer_number); ?></textarea>
        <p style="margin-left: 20px !important; margin-top: 0px !important;padding-top: 0px !important;">OR</p>
        <p class="pSmall" style="margin-bottom: 0px !important;padding: 0px !important;font-size: 12px !important;">
            &nbsp;<img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt="">
            I hereby appoint Practitioner(s) named below as my/our attorney(s) or agent(s), and to transact all business in the
        </p>
        <p class="pSmall" style="margin:0px 0px 0px 20px !important;padding: 0px !important;font-size: 12px !important;">
            United States Patent and Trademark Office connected therewith for the application referenced in the attached transmittal letter (form PTO/AIA/82A) or identified above. (Note: Complete form PTO/AIA/82C.)
        </p>
    </div>
    <div style="padding: 0px !important;margin: 0px !important;">
        <p class="pSmall" style="margin-top: 0px !important;">Please recognize or change the correspondence address for the application identified in the attached transmittal letter or the boxes above to: </p>
        <p class="mySmall" style="padding-left: 15px !important;margin-bottom: 0px !important;">
            <img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""> The address associated with the above-mentioned Customer Number.<br>
            <b class="pSmall">OR</b>
        </p>
        <p class="mySmall" style="margin-bottom: 10px !important;padding-bottom: 0px !important;padding-left: 15px !important;">
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt="" style="margin-bottom: 0px !important;"> The address associated with  Customer Number:<br>
            <b class="pSmall" style="margin-bottom: 0px !important;padding-bottom: 0px !important;">OR</b>
            <textarea style="position: fixed !important;top: 400px;margin-left: 322px !important;
            width: 100px !important;height: 30px !important;padding: 0px;margin-bottom: 0px !important;">&nbsp;</textarea>
        </p>
    </div>
    <table class="border-normal" style="margin-top: 0px !important;">
        <tr>
            <td class="inner-border" style="width: 20% !important;">
                <p class="mySmall" style="padding:3px 0px 0px 15px !important;margin: 0px !important;">
                    Firm or<br>Individual Name
                </p>
            </td>
            <td colspan="5" style="border-bottom: 1px solid black;"></td>
        </tr>
        <tr>
            <td class="inner-border"><p class="mySmall" style="margin-top: 0px !important;padding: 0px !important;margin-bottom: 0px !important;">Address</p></td>
            <td colspan="5" style="border-bottom: 1px solid black;"></td>
        </tr>
        <tr>
            <td class="inner-border"><p class="mySmall" style="margin-top: 0px !important;">City </p></td>
            <td class="inner-border" style="width: 30%;"><p class="mySmall" style="margin-bottom: 0px !important;"></p></td>
            <td class="inner-border" style="width: 7%"><p class="mySmall" style="margin-bottom: 0px !important;">State</p></td>
            <td class="inner-border" style="width: 20%"><p class="mySmall" style="margin-bottom: 0px !important;"></p></td>
            <td class="inner-border" style="width: 3%"><p class="mySmall" style="margin-bottom: 0px !important;">Zip</p></td>
            <td style="border-bottom: 1px solid black;width: 20%;"></td>
        </tr>
        <tr>
            <td class="inner-border"><p class="mySmall">Country</p></td>
            <td colspan="5" style="border-bottom: 1px solid black;"></td>
        </tr>
        <tr>
            <td class="inner-border"><p class="mySmall" style="margin-top: 0px !important;">Telephone  </p></td>
            <td class="inner-border" ><p class="mySmall" style="margin: 0px !important;"></p></td>
            <td class="inner-border" ><p class="mySmall" style="margin: 0px !important;">Email</p></td>
            <td style="border-bottom: 1px solid black;" colspan="3"></td></tr>
    </table>
    <div style="padding: 0px !important;margin: 0px !important;">
        <p class="pSmall" style="margin-bottom: 0px !important;margin-top: 0px !important;">I am the Applicant (if the Applicant is a juristic entity, list the Applicant name in the box):</p>
         <textarea style="margin-left: 15px !important;width: 90% !important;height: 25px;"></textarea>
        <p class="superSmall" style="margin-left: 15px !important;margin-bottom: 0px !important;"><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt="" style="margin: 0px !important;">&nbsp;Inventor or Joint Inventor (title no required below)</p>
        <p class="superSmall" style="margin-left: 15px !important;margin-bottom: 0px !important;"><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt="" style="margin: 0px !important;">&nbsp;Legal Representative of a Deceased or Legally Incapacitated Inventor (title not required below)</p>
        <p class="superSmall" style="margin-left: 15px !important;margin-bottom: 0px !important;"><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt="" style="margin: 0px !important;">&nbsp;Assignee or Person to Whom the Inventor is Under an Obligation to Assign (provide signer’s title if applicant is a juristic entity)</p>
        <p class="superSmall" style="margin-left: 15px !important;margin-bottom: 0px !important;padding-right: 10px !important;"><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt="" style="margin: 0px !important;">&nbsp;Person Who Otherwise Shows Sufficient Proprietary Interest (e.g., a petition under 37 CFR 1.46(b)(2) was granted in the</p>
        <p class="superSmall" style="margin-left: 28px !important;margin-top: 0px !important;margin-bottom: 0px !important;">application or is concurrently being filed with this document) (provide signer’s title if applicant is a juristic entity)</p>
    </div>
    <table class="border-normal">
        <tr>
            <td colspan="4" style="border-bottom: 1px solid black;"><p class="mySmall" style="margin-bottom: 0px !important;" align="center">SIGNATURE of Applicant for Patent </p></td>
        </tr>
        <tr><td colspan="4" style="border-bottom: 1px solid black;"><p class="superSmall">The undersigned (whose title is supplied below) is authorized to act on behalf of the applicant(e.g.,where the applicant is a juristic entity).</p></td></tr>
        <tr>
            <td style="width: 25% !important;" class="inner-border"><p class="mySmall" style="margin-bottom: 0px !important;">Signature </p></td>
            <td style="width: 40% !important;" class="inner-border">
                <?php if($coInvIndex==0): ?>
                    <div style="width: 100%; height: 40px"><img src="<?php echo e(asset('files/projects/'.$fileno.'/signature_poa.jpg')); ?>"></div>
                <?php else: ?>
                    <div style="width: 100%; height: 40px"><img src="<?php echo e(asset('files/projects/'.$fileno.'/signature_poa_coInv'.$coInvIndex.'.jpg')); ?>"></div>
                <?php endif; ?>
            </td>
            <td style="width: 10% !important;" class="inner-border"><p class="mySmall" style="margin-bottom: 0px !important;">Date(Optional)</p></td>
            <td style="width: 25% !important;border-bottom: 1px solid black;"></td>
        </tr>
        <tr>
            <td class="inner-border"><p class="mySmall" style="margin-bottom: 0px !important;">Name</p></td>
            <td class="inner-border">
                <p class="mySmall" align="left">
                    <b>
                        <?php if($coInvIndex==0): ?>
                            <?php echo e(ucwords($client->fname." ".$client->lname)); ?>

                        <?php else: ?>
                            <?php echo e(ucwords($coInvs[$coInvIndex - 1])); ?>

                        <?php endif; ?>
                    </b>
                </p>
            </td>
            <td class="inner-border"><p class="mySmall" style="margin-bottom: 0px !important;">Telephone</p></td>
            <td style="border-bottom: 1px solid black;"></td>
        </tr>
        <tr>
            <td style="border-right: 1px solid black;"><p class="mySmall" style="margin-bottom: 0px !important;">Title</p></td>
            <td colspan="3" style="border-bottom: 1px solid black;"></td>
        </tr>
    </table>
    <div style="width: 100%;border-bottom:2px solid black;padding:0px !important;margin: 0px !important;">
        <p style="font-size: 11px;padding:0px !important;margin: 0px 0px 0px 10px !important;">NOTE:Signature - This form must be signed by the applicant in accordance with 37 CFR 1.33. See 37 CFR 1.4 for signature requirements and certifications.  If more than one applicant, use multiple forms.</p>
    </div>
    <div style="width: 100%;margin: 0px !important;">
        <p style="font-size: 11px;padding:0px !important;margin: 0px 0px 2px 10px !important;"><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""> &nbsp;&nbsp;&nbsp;*Total of <u>&nbsp;&nbsp;<?php echo e($coInvCount+1); ?>&nbsp;&nbsp;</u> forms are submitted.</p>
    </div>
</div>
<p style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">This collection of information is required by 37 CFR 1.31, 1.32 and 1.33. The information is required to obtain or retain a benefit
    by the public which is to file (and by the USPTO to process) an application. Confidentiality is governed by 35 U.S.C. 122 and 37
    CFR 1.11 and 1.14. This collection is estimated to take 3 minutes to complete, including gathering, preparing, and submitting the
    completed application form to the USPTO. Time will vary depending upon the individual case. Any comments on the amount of time you
    require to complete this form and/or suggestions for reducing this burden, should be sent to the Chief Information Officer,  U.S.
    Patent and Trademark Office, U.S. Department of Commerce, P.O. Box 1450, Alexandria, VA 22313-1450. DO NOT SEND FEES OR COMPLETED
    FORMS TO THIS ADDRESS. SEND TO: Commissioner for Patents, P.O. Box 1450, Alexandria, VA 22313-1450.</p>
<p align="center" style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">If you need assistance in completing the form, call 1-800-PTO-9199 and select option 2.   </p>
<div class="page-break"></div>
<!--page 3-->
<table style="width: 100%;">
    <colgroup>
        <col width="20%">
        <col width="15%">
        <col width="65%">
    </colgroup>
    <tr >
        <td colspan="2">
        </td>
        <td colspan="1">
            <p align="right" style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">PTO/AIA/82C (07-13)</p>
            <p align="right" style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">Approved for use through 11/30/2014. OMB 0651-0051</p>
        </td>
    </tr>
    <tr style="margin-top: 0px !important;padding-top: 0px !important;">
        <td colspan="3" style="padding-top: 0px !important;margin-top: 0px !important;">
            <p align="right" style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">U.S. Patent and Trademark Office; U.S. DEPARTMENT OF COMMERCE</p>
            <p align="right" style="font-size: 10px; margin: 0.0em !important;padding: 0.0em !important;">Under the Paperwork Reduction Act of 1995, no persons are required to respond to a collection of information unless it contains a valid OMB control number.</p>
        </td>
    </tr>
</table>

<table class="border-round">
    <tr>
        <td>
            <p align="center" style="font-size: 18px !important;margin-top: 0px !important;margin-bottom: 0px !important;"><b>POWER OF ATTORNEY BY APPLICANT </b></p>
        </td>

    </tr>
</table>

<div class="col-md-12" style="border: 2px solid black;">
    <div style="width: 100%;border-bottom:2px solid black;padding:0px !important;margin: 0px !important;">
        <p style="font-size: 13px;padding:0px !important;margin: 0px 0px 0px 10px !important;">No more than ten (10) patent practitioners total may be appointed as set forth below by name and registration number. This page need not be submitted if appointing the Patent Practitioner(s) associated with a Customer Number (see form PTO/AIA/82B):</p>
    </div>
    <br><br>
    <table class="border-normal" style="width: 80% !important;margin-left: 88px !important;">
        <tr>
            <td style="width: 80% !important;" class="inner-border"><p class="mySmall" align="center">Name</p></td>
            <td style="border-bottom: 1px solid black;">Registration Number</td>
        </tr>
        <tr>
            <td class="inner-border"><p class="mySmall"><br></p></td>
            <td style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
        <tr>
            <td  class="inner-border"><p class="mySmall"><br></p></td>
            <td  style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
        <tr>
            <td  class="inner-border"><p class="mySmall"><br></p></td>
            <td  style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
        <tr>
            <td  class="inner-border"><p class="mySmall"><br></p></td>
            <td  style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
        <tr>
            <td  class="inner-border"><p class="mySmall"><br></p></td>
            <td  style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
        <tr>
            <td  class="inner-border"><p class="mySmall"><br></p></td>
            <td  style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
        <tr>
            <td  class="inner-border"><p class="mySmall"><br></p></td>
            <td  style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
        <tr>
            <td class="inner-border"><p class="mySmall"><br></p></td>
            <td  style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
        <tr>
            <td  class="inner-border"><p class="mySmall"><br></p></td>
            <td  style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
        <tr>
            <td class="inner-border"><p class="mySmall"><br></p></td>
            <td style="border-bottom: 1px solid black;"><p class="mySmall"><br></p></td>
        </tr>
    </table>
    <br><br>
</div>
<div class="page-break"></div>
<div class="col-md-12">
    <p align="center" style="margin-top: 30px !important;">Privacy Act Statement </p>
    <p align="left" class="mySmall">The <strong style="font-size: 13px !important;">Privacy Act of 1974 (P.L. 93-579)</strong> requires that you be given
        certain information in connection with your submission of the attached form related to a patent application or patent.
        Accordingly, pursuant to the requirements of the Act, please be advised that: (1) the general authority for the collection
        of this information is 35 U.S.C. 2(b)(2); (2) furnishing of the information solicited is voluntary; and (3) the principal
        purpose for which the information is used by the U.S. Patent and Trademark Office is to process and/or examine your submission
        related to a patent application or patent. If you do not furnish the requested information, the U.S. Patent and Trademark Office
        may not be able to process and/or examine your submission, which may result in termination of proceedings or abandonment of the
        application or expiration of the patent. </p>
    <p align="left" class="mySmall" style="margin-top: 10px !important;">The information provided by you in this form will be subject to the following routine uses:  </p>
    <ol class="olSmaller">
        <li class="mySmall">
            The information on this form will be treated confidentially to the extent allowed under the Freedom of Information
            Act (5 U.S.C. 552) and the Privacy Act (5 U.S.C 552a). Records from this system of records may be disclosed to the
            Department of Justice to determine whether disclosure of these records is required by the Freedom of Information Act.
        </li>
        <li class="mySmall">
            A record from this system of records may be disclosed, as a routine use, in the course of presenting evidence to a court,
            magistrate, or administrative tribunal, including disclosures to opposing counsel in the course of settlement negotiations.
        </li>
        <li>
            A record in this system of records may be disclosed, as a routine use, to a Member of Congress submitting a request involving an individual, to whom the record pertains, when the individual has requested assistance from the Member with respect to the subject matter of the record.
        </li>
        <li>
            A record in this system of records may be disclosed, as a routine use, to a contractor of the Agency having need for the information in order to perform a contract. Recipients of information shall be required to comply with the requirements of the Privacy Act of 1974, as amended, pursuant to 5 U.S.C. 552a(m).
        </li>
        <li>
            A record related to an International Application filed under the Patent Cooperation Treaty in this system of records may be disclosed, as a routine use, to the International Bureau of the World Intellectual Property Organization, pursuant to the Patent Cooperation Treaty.
        </li>
        <li>
            A record in this system of records may be disclosed, as a routine use, to another federal agency for purposes of National Security review (35 U.S.C. 181) and for review pursuant to the Atomic Energy Act (42 U.S.C. 218(c)).
        </li>
        <li>
            A record from this system of records may be disclosed, as a routine use, to the Administrator, General Services, or his/her designee, during an inspection of records conducted by GSA as part of that agency’s responsibility to recommend improvements in records management practices and programs, under authority of 44 U.S.C. 2904 and 2906. Such disclosure shall be made in accordance with the GSA regulations governing inspection of records for this purpose, and any other relevant (i.e., GSA or Commerce) directive. Such disclosure shall not be used to make determinations about individuals.
        </li>
        <li>
            A record from this system of records may be disclosed, as a routine use, to the public after either publication of the application pursuant to 35 U.S.C. 122(b) or issuance of a patent pursuant to 35 U.S.C. 151. Further, a record may be disclosed, subject to the limitations of 37 CFR 1.14, as a routine use, to the public if the record was filed in an application which became abandoned or in which the proceedings were terminated and which application is referenced by either a published application, an application open to public inspection or an issued patent.
        </li>
        <li>
            A record from this system of records may be disclosed, as a routine use, to a Federal, State, or local law enforcement agency, if the USPTO becomes aware of a violation or potential violation of law or regulation.
        </li>
    </ol>
</div>