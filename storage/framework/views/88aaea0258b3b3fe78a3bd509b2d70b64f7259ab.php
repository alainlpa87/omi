<link href="<?php echo e(asset('/css/pdf_client.css')); ?>" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
<p align="left" class="superSmall">
    Doc Code: MES.GIB
</p>
<p align="let" class="superSmall">
    Document Description: Certification of Micro Entity Status (Gross Income Basis)
</p>
<p align="right" class="superSmall" style="position: relative;top: -10px;">
    PTO/SB/15A (03-13)
</p>
<div style="border: 2px solid black;">
    <div style="border-bottom: 1px solid black;">
        <p class="pSmall" align="center" style="margin-bottom: 0px !important;"><b>CERTIFICATION OF MICRO ENTITY STATUS </b></p>
        <p class="pSmall" align="center" style="margin-top: 0px !important;">(GROSS INCOME BASIS)</p>
    </div>
    <table style="width: 100% !important;border-collapse: collapse !important;">
        <tr>
            <td class="inner-border" style="width: 50% !important;"><p class="superSmall" style="margin: 0px 0px 20px 5px !important;">Application Number or Control Number (if applicable):</p></td>
            <td style="border-bottom: 1px solid black;width: 50% !important;"><p class="superSmall" style="margin: 0px 0px 20px 5px !important;">Patent Number (if applicable):</p><span style="margin-top: 0px !important; "></span></td>
        </tr>
        <tr>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;"><p class="superSmall" style="margin: 0px 0px 0px 5px !important;">First Named Inventor:</p><span style="margin-top: 0px !important; "><?php echo e(ucwords($client->fname." ".$client->lname)); ?></span></td>
            <td style="border-bottom: 1px solid black;"><p class="superSmall" style="margin: 0px 0px 0px 5px !important;">Title of Invention:</p><span style="margin-top: 0px !important; "><?php if($design == 0): ?> <?php echo e(strtoupper($pcs->titleofinvention)); ?><?php else: ?><?php echo e(strtoupper($pcs->titleofinventionD)); ?><?php endif; ?></span></td>
        </tr>
    </table>
    <div style="border-bottom: 1px solid black;">
        <p class="pSmall">The applicant hereby certifies the following— </p>
        <p class="pSmall" style="margin: 15px 5px 15px 20px !important;">(1) <b>SMALL ENTITY REQUIREMENT -</b> The applicant
            qualifies as a small entity as defined in 37 CFR 1.27. </p>
        <p class="pSmall" style="margin: 15px 5px 15px 20px !important;">(2) <b>APPLICATION FILING LIMIT -</b> Neither the
            applicant nor the inventor nor a joint inventor has been named as the inventor or a joint inventor on more than
            four previously filed U.S. patent applications, excluding provisional applications and international applications
            under the Patent Cooperation Treaty (PCT) for which the basic national fee under 37 CFR 1.492(a) was not paid, and
            also excluding patent applications for which the applicant has assigned all ownership rights or is obligated to assign
            all ownership rights as a result of the applicant’s previous employment.</p>
        <p class="pSmall" style="margin: 15px 5px 15px 20px !important;">(3) <b>GROSS INCOME LIMIT ON APPLICANTS AND INVENTORS -</b>
            Neither the applicant nor the inventor nor a joint inventor, in the calendar year preceding the calendar year in which
            the applicable fee is being paid, had a gross income, as defined in section 61(a) of the Internal Revenue Code of 1986
            (26 U.S.C. 61(a)), exceeding the “Maximum Qualifying Gross Income” reported on the USPTO website at
            <a href="http://www.uspto.gov/patents/law/micro_entity.jsp">http://www.uspto.gov/patents/law/micro_entity.jsp</a> which is equal to three times the median household income for that
            preceding calendar year, as most recently reported by the Bureau of the Census.</p>
        <p class="pSmall" style="margin: 15px 5px 15px 20px !important;">(4) <b>GROSS INCOME LIMIT ON PARTIES WITH AN “OWNERSHIP
                INTEREST” -</b> Neither the applicant nor the inventor nor a joint inventor has assigned, granted, or conveyed, nor is
                under an obligation by contract or law to assign, grant, or convey, a license or other ownership interest in the
                application concerned to an entity that, in the calendar year preceding the calendar year in which the applicable
                fee is being paid, had a gross income, as defined in section 61(a) of the Internal Revenue Code of 1986, exceeding
                the “Maximum Qualifying Gross Income” reported on the USPTO website at <a href="http://www.uspto.gov/patents/law/micro_entity.jsp">http://www.uspto.gov/patents/law/micro_entity.jsp</a>
                which is equal to three times the median household income for that preceding calendar year, as most recently reported by
                the Bureau of the Census.</p>
    </div>
    <table style="width: 100% !important;border-collapse: collapse !important;">
        <tr>
            <td  style="border-bottom: 1px solid black;" colspan="6">
                <p class="superSmall" style="margin: 0px 0px 0px 0px !important;" align="center">SIGNATURE by a party set forth in 37 CFR 1.33(b)</p>
            </td>
        </tr>
        <tr>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;"><p class="superSmall" style="margin: 0px 0px 20px 5px !important;">Signature</p></td>
            <td colspan="5" style="border-bottom: 1px solid black;">
                <?php if($coInvIndex==0): ?>
                    <img src="<?php echo e(asset('files/projects/'.$fileno.'/signature_mE.jpg')); ?>">
                <?php else: ?>
                    <img src="<?php echo e(asset('files/projects/'.$fileno.'/signature_mE_coInv'.$coInvIndex.'.jpg')); ?>">
                <?php endif; ?>

            </td>
        </tr>
        <tr>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;"><p class="superSmall" style="margin: 0px 0px 20px 5px !important;">Name</p></td>
            <td colspan="5" style="border-bottom: 1px solid black;"><p class="mySmall" style="text-align: left;margin-bottom: 3px !important;margin-top: 3px !important;"><b>
                        <?php if($coInvIndex==0): ?>
                            <?php echo e(ucwords($client->fname." ".$client->lname)); ?>

                        <?php else: ?>
                            <?php echo e(ucwords($coInvs[$coInvIndex - 1])); ?>

                        <?php endif; ?>
                    </b></p></td>
        </tr>
        <tr>
            <td class="inner-border"><p class="superSmall" style="margin: 0px 0px 20px 5px !important;">Date </p></td>
            <td class="inner-border"></td>
            <td class="inner-border"><p class="superSmall" style="margin: 0px 0px 20px 5px !important;">Telephone </p></td>
            <td class="inner-border"></td>
            <td class="inner-border" style="width: 35% !important;"><p class="superSmall" style="margin: 0px 0px 20px 5px !important;">Registration No. </p></td>
            <td style="border-bottom: 1px solid"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="border-right: 1px solid black;">
                &nbsp;<img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt="">
            </td>
            <td>
                <p class="superSmall">There is more than one inventor and I am one of the inventors who are jointly identified as the applicant. Additional certification form(s) signed by the other joint inventor(s) are included with this form. </p>
            </td>
        </tr>
    </table>
</div>


<div class="page-break"></div>
<!--page 2-->
<div class="col-md-12">
    <p align="center" style="margin-top: 30px !important;">Privacy Act Statement </p>
    <p align="left" class="mySmall">The <strong style="font-size: 13px !important;">Privacy Act of 1974 (P.L. 93-579)</strong> requires that you be given certain information in connection with your submission of the attached form related to a patent application or patent. Accordingly, pursuant to the requirements of the Act, please be advised that: (1) the general authority for the collection of this information is 35 U.S.C. 2(b)(2); (2) furnishing of the information solicited is voluntary; and (3) the principal purpose for which the information is used by the U.S. Patent and Trademark Office is to process and/or examine your submission related to a patent application or patent. If you do not furnish the requested information, the U.S. Patent and Trademark Office may not be able to process and/or examine your submission, which may result in termination of proceedings or abandonment of the application or expiration of the patent. </p>
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
            A record from this system of records may be disclosed, as a routine use, to the public after either publication of the application pursuant to 35 U.S.C. 122(b) or issuance of a patent pursuant to 35 U.S.C. 151. Further, a record may be disclosed, subject to the limitations of 37 CFR 1.14, as a routine use, to the public if the record was filed in an application which became abandoned or in which the proceedings were terminated and which application is referenced by either a published application, an application open to public inspection or an issued patent. 9
        </li>
        <li>
            A record from this system of records may be disclosed, as a routine use, to a Federal, State, or local law enforcement agency, if the USPTO becomes aware of a violation or potential violation of law or regulation.
        </li>
    </ol>
</div>