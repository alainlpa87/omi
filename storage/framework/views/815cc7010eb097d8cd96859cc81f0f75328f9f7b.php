<div class="col-md-12  divContract">
    <form method="post" action="<?php echo e(url('launch/clientServices/signed')); ?>" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="<?php echo e($document); ?>">
        <input type="hidden" name="project_id" value="<?php echo e($project_id); ?>">
        <p class="pLogo">
            <img src="<?php echo e(asset('/img/contracts/logo.png')); ?>" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>
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
                    <p class="pull-left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;" >Doc Code: Oath</b></p>
                    <p class="pull-left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;">Document Description: Oath or declaration filed</b></p>
                </td>
                <td colspan="1">
                    <p  class="superSmall pull-right">PTO/AIA/08 (11-15)</p><br>
                    <p  class="superSmall pull-right">Approved for use through 4/30/2017. OMB 0651-0032</p>
                </td>
            </tr>
            <tr style="margin-top: 0px !important;padding-top: 0px !important;">
                <td colspan="3" style="padding-top: 0px !important;margin-top: 0px !important;">
                    <p class="superSmall pull-right">U.S. Patent and Trademark Office; U.S. DEPARTMENT OF COMMERCE</p>
                    <p class="superSmall pull-right">Under the Paperwork Reduction Act of 1995, no persons are required to respond to a collection of information unless it contains a valid OMB control number.</p>
                </td>
            </tr>
        </table>

        <div class="table-responsive">
            <table class="border-round table" style="border-spacing: 0;">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="10%">
                    <col width="20%">
                    <col width="20%">
                    <col width="30%">
                </colgroup>
                <tr style="padding: 0px;margin: 0px;">
                    <td rowspan="4" colspan="4" style="border-right: 1px solid black;padding: 0px !important;margin: 0px !important;"> 
                        <p style="margin-left: 50px;"><strong>DECLARATION FOR UTILITY OR DESIGN PATENT</strong></p>
                        <p style="margin-left: 100px;"><strong>APPLICATION (37 CFR 1.63) </strong></p>
                    </td>
                    <td colspan="1" class="inner-border"> <p>Attorney Docket<br> Number</p></td>
                    <td colspan="1" style="border-bottom: 1px solid black;width: 30% !important;"><?php echo e($client->fileno); ?></td>
                </tr>
                <tr style="padding: 0px;margin: 0px;">
                    <td  class="inner-border"> <p style="font-size: 14px;">First Named Inventor </p></td>
                    <td  style="border-bottom: 1px solid black;"><p style="text-align: center; "><?php echo e(ucwords($client->fname." ".$client->lname)); ?></p></td>
                </tr>
                <tr style="padding: 0px;margin: 0px;">
                    <td colspan="2" style="border-bottom: 1px solid black"> <p style="font-size: 14px;margin: 2px 0px 1px 100px;"> COMPLETE IF KNOWN </p></td>
                </tr>
                <tr style="padding: 0px;margin: 0px;">
                    <td colspan="1"  class="inner-border"> <p style="font-size: 14px;">Application Number </p></td>
                    <td colspan="1" style="border-bottom: 1px solid black"></td>
                </tr>
                <tr style="padding: 0px;margin: 0px;">
                    <td rowspan="3" style="width: 5% !important;padding: 0px !important;margin: 0px !important;" colspan="1">&nbsp;<img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></td>
                    <td rowspan="3" style="width: 15% !important;padding: 0px !important;margin: 0px !important;" colspan="1"><p class="pSmall">Declaration Submitted With Initial Filing</p></td>
                    <td rowspan="3" style="width: 10% !important;padding: 0px !important;margin: 0px !important;" colspan="1">OR &nbsp;<img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""></td>
                    <td rowspan="3" style="width: 20% !important;padding: 0px !important;margin: 0px !important;" colspan="1" style="border-right: 1px solid black"><p class="pSmall">Declaration Submitted<br>  After Initial Filing<br></b> (surcharge  (37 CFR 1.16(f)) required)</p></td>
                    <td  class="inner-border" style="border-left: 1px black solid;"> <p style="font-size: 14px;">Filing Date</p></td>
                    <td style="border-bottom: 1px solid black">
                    </td>
                </tr>
                <tr style="padding: 0px;margin: 0px;">
                    <td class="inner-border" style="border-left: 1px black solid;"> <p style="font-size: 14px;"> Art Unit </p></td>
                    <td style="border-bottom: 1px solid black"></td>
                </tr>
                <tr style="padding: 0px;margin: 0px;">
                    <td style="border-right: 1px solid black;border-left: 1px black solid;"> <p style="font-size: 14px;">Examiner Name </p></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 col-xs-12 vendorBox" style="border: 2px solid black;">
            <p align="center" style="border: 1px black solid;">
                <?php if($document=="declarationU"): ?>
                    <?php echo e(strtoupper($pcs->titleofinvention)); ?>

                <?php else: ?>
                    <?php echo e(strtoupper($pcs->titleofinventionD)); ?>

                <?php endif; ?>
            </p>
            <p class="mySmall" style="padding-top: 0px !important;text-align: center;"><i>(Title of the Invention)</i></p>
            <p class="pSmall" style="margin: 0px 0px 10px 10px !important;">As a below named inventor, I hereby declare that:</p>
            <p class="pSmall" style="margin: 0px 0px 10px 10px !important;">This declaration is directed to: </p>
            <p class="pSmall"> &nbsp;<img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> The attached application, </p>
            <p> OR</p>
            <p class="pSmall" style="margin: 0px 0px 10px 10px !important;">&nbsp;<img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt="">
                United States Application Number or PCT International application number ________________________________ </p>
            <p class="pSmall" style="margin: 0px 0px 10px 10px !important;">filed on _________________________________.</p>
            <p class="pSmall" style="margin: 0px 0px 10px 10px !important;">The above-identified application was made or authorized to be made by me.</p>
            <p class="pSmall" style="margin: 0px 0px 10px 10px !important;"> I believe I am the original inventor or an original joint inventor of a claimed invention in the application.</p>
            <p class="pSmall" style="margin: 0px 0px 10px 10px !important;"> I hereby acknowledge that any willful false statement made in this declaration is punishable under 18 U.S.C. 1001<br> by fine or imprisonment of not more than five (5) years, or both. </p>
            <table class="border-normal table" style="padding-bottom: 0px;margin-bottom: 0px;">
                <tr>
                    <td style="width: 20%;;margin: 0px !important;padding: 0px 0px 0px 10px !important;border-bottom: 1px solid black;"><p align="left" class="pSmall" style="margin: 0px 0px 10px 0px !important;padding: 0px !important;">Direct all correspondence to:</p></td>
                    <td style="width: 5%;margin: 0px !important;padding: 0px !important;border-bottom: 1px solid black;">&nbsp;<img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></td>
                    <td style="width: 20%;margin: 0px !important;padding: 0px !important;border-bottom: 1px solid black;"><p class="pSmall" style="margin: 0px 0px 10px 0px !important;padding: 0px !important;">The address associated with Customer Number:</p></td>
                    <td style="width: 20% !important;margin: 0px !important;padding: 0px !important;border-bottom: 1px solid black;"><textarea id="cust_number" name="cust_number" rows="1" cols="10" style="width: 100px !important;height: 30px !important;margin: 10px 0px 10px 10px !important;padding: 0px !important;border: 1px solid black;" disabled="disabled"><?php echo e($attorney->customer_number); ?></textarea></td>
                    <td style="width: 10%;margin: 0px !important;padding: 0px !important;border-bottom: 1px solid black;">OR &nbsp;<img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""></td>
                    <td colspan="2" style="width: 25%;border-bottom: 1px solid black;"><p align="left" class="pSmall" style="margin: 0px 0px 10px 0px!important;">Correspondence address below</p></td>
                </tr>
                <tr>
                    <td colspan="7" style="border-bottom: 1px solid black;"><p class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;">Name </p></td>
                </tr>
                <tr>
                    <td colspan="7" style="border-bottom: 1px solid black;">
                        <p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;"> Address <br>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="inner-border">
                        <p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;">City
                        </p>
                    </td>
                    <td colspan="2" class="inner-border">
                        <p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;">State
                        </p>
                    </td>
                    <td colspan="2" style="border-bottom: 1px solid black;">
                        <p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;">Zip
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"  class="inner-border">
                        <p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;">

                        </p>
                    </td>
                    <td colspan="2"  class="inner-border">
                        <p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;">Telephone
                        </p>
                    </td>
                    <td colspan="3"  style="border-bottom: 1px solid black;">
                        <p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;">Email
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        
        <p class="superSmall" style="padding: 0px !important;margin: 0px !important;text-align: left;">This collection of information is required by 35 U.S.C. 115 and 37 CFR 1.63. The information is required to obtain or retain a benefit by the public which is to file (and by the USPTO to process) an application. Confidentiality is governed by 35 U.S.C. 122 and 37 CFR 1.11 and 1.14. This collection is estimated to take 21 minutes to complete, including gathering, preparing, and submitting the completed application form to the USPTO. Time will vary depending upon the individual case. Any comments on the amount of time you require to complete this form and/or suggestions for reducing this burden, should be sent to the Chief Information Officer, U.S. Patent and Trademark Office, U.S. Department of Commerce, P.O. Box 1450, Alexandria, VA 22313-1450. DO NOT SEND FEES OR COMPLETED FORMS TO THIS ADDRESS. SEND TO: Commissioner for Patents, P.O. Box 1450, Alexandria, VA 22313-1450. </p>
        <p class="superSmall" style="padding: 0px !important;margin: 0px !important;text-align: center;">If you need assistance in completing the form, call 1-800-PTO-9199 and select option 2. </p>




        <table class="table" style="width: 100%;border:2px solid black;border-radius: 25px 25px 25px 25px !important;margin-bottom: 10px !important;" >
            <tr>
                <td><p style="text-align: center;"><strong>DECLARATION — Utility or Design Patent Application </strong></p></td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="border-normal table" style="padding-bottom: 0px;margin-bottom: 0px;">
                <tr>
                    <td colspan="7" style="border-bottom: 1px solid black;">
                        <p style="text-align: center;"> <strong>WARNING:</strong></p>
                        <p class="pSmall" style="text-align: left;">Petitioner/applicant is cautioned to avoid submitting personal information in documents filed in a patent application that may contribute to identity theft. Personal information</p>
                        <p class="pSmall" style="text-align: left;">such as social security numbers, bank account numbers, or credit card numbers (other than a check or credit card authorization form PTO-2038 submitted for payment purposes) is never required by the USPTO to support a </p>
                        <p class="pSmall" style="text-align: left;">petition or an application. If this type of personal information is included in documents submitted to the USPTO, petitioners/applicants should consider redacting such personal information from the</p>
                        <p class="pSmall" style="text-align: left;">documents before submitting them to the USPTO. Petitioner/applicant is advised that the record of a patent application is available to the public after publication of the application (unless a <p>
                        <p class="pSmall" style="text-align: left;">non-publication request in compliance with 37 CFR 1.213(a) is made in the application) or issuance of a patent. Furthermore, the record from an abandoned application may also be available to the public</p>
                        <p class="pSmall" style="text-align: left;">if the application is referenced in a published application or an issued patent (see 37 CFR 1.14). Checks and credit card authorization forms PTO-2038 submitted for payment purposes are not retained in the</p>
                        <p class="pSmall" style="text-align: left;">application file and therefore are not publicly available. Petitioner/applicant is advised that documents which form the record of a patent application (such as the PTO/SB/01) are placed into the Privacy Act system of</p>
                        <p class="pSmall" style="text-align: left;">records DEPARTMENT OF COMMERCE, COMMERCE-PAT-7, System name: <i>Patent Application Files</i> . Documents not retained in an application file (such as the PTO-2038) are placed into the Privacy Act system of COMMERCE/PAT-TM-10,</p>
                        <p class="pSmall" style="text-align: left;">System name: <i>Deposit Accounts and Electronic Funds Transfer Profiles</i> .</p>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="7" style="border-bottom: 1px solid black;"><p class="mySmall" style="margin-left: 25px !important;"> <b>LEGAL NAME OF SOLE OR FIRST INVENTOR: </b></p></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid black;" colspan="7">
                        <p style="font-size: 13px; padding-top: 0px;margin-top: 0px;">(E.g., Given Name (first and middle (if any)) and Family Name or Surname)</p>
                        <p><?php echo e(ucwords($client->fname)." ".ucwords($client->lname)); ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid black;border-right: 1px solid black;" colspan="5">
                        <div class="col-md-3 pull-left">
                            <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;">Inventor’s<br>Signature</p>
                        </div>
                        <div class="col-md-9 pull-right">
                            <div class="sigPad" id="signt_dec" style="padding-top: 5px;">
                                <div class="sig sigWrapper current">
                                    <canvas class="pad" width="290" height="50"></canvas>
                                    <input type="hidden" name="output" class="output">
                                </div>
                                <ul class="sigNav">
                                    <li class="clearButton" style="display: list-item;margin: 0px !important;"><a href="#clear" style="font-size: 11px !important;">Clear</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td style="border-bottom: 1px solid black;" colspan="2">
                        <p style="padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 5px;font-size: 13px;">Date (Optional)</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;">Residence: City </p>
                        <p style="margin-top: 0px !important;"><?php echo e($client->city); ?></p>
                    </td>
                    <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;">State </p>
                        <p style="margin-top: 0px !important;"><?php echo e($client->state); ?></p>
                    </td>
                    <td colspan="3" style="border-bottom: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;">Country</p>
                        <p style="margin-top: 0px !important;"><?php echo e($client->country); ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid black;" colspan="7">
                        <p style="font-size: 13px; padding-top: 0px;margin-top: 0px;margin-left: 0px;padding-left: 0px">Mailing Address</p>
                        <p style="margin-top: 0px !important;"><?php echo e($client->street); ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">City </p>
                        <p style="margin-top: 0px !important;"><?php echo e($client->city); ?></p>
                    </td>
                    <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">State </p>
                        <p style="margin-top: 0px !important;"><?php echo e($client->state); ?></p>
                    </td>
                    <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">Zip </p>
                        <p style="margin-top: 0px !important;"><?php echo e($client->zip); ?></p>
                    </td>
                    <td colspan="2" style="border-bottom: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">Country </p>
                        <p style="margin-top: 0px !important;"><?php echo e($client->country); ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="7"><p class="verySmall" style="margin-left: 100px !important;"><input type="checkbox" id="add_inv" name="add_inv"> &nbsp;&nbsp;Additional inventors are being named on the <input type="number" style="height: 20px;width: 60px;"> supplemental sheet(s) PTO/AIA/10 attached hereto </p> </td>
                </tr>
            </table>
        </div>
        <br>
        <p style="font-size: 22px !important;text-align: center;"><strong>Privacy Act Statement</strong></p>
        <p class="pSmall" style="text-align: left;"><b>The Privacy Act of 1974 (P.L. 93-579)</b> requires that you be given certain information in connection
            with your submission of the attached form related to a patent application or patent. Accordingly, pursuant to the requirements
            of the Act, please be advised that: (1) the general authority for the collection of this information is 35 U.S.C. 2(b)(2); (2)
            furnishing of the information solicited is voluntary; and (3) the principal purpose for which the information is used by the U.S.
            Patent and Trademark Office is to process and/or examine your submission related to a patent application or patent. If you do not
            furnish the requested information, the U.S. Patent and Trademark Office may not be able to process and/or examine your submission,
            which may result in termination of proceedings or abandonment of the application or expiration of the patent.
        </p>
        <p class="pSmall" style="text-align: left;">The information provided by you in this form will be subject to the following routine uses: </p>
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
    </form>
</div>
