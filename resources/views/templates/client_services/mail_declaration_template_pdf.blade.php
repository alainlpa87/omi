<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
<table style="width: 100%;">
    <colgroup>
        <col width="20%">
        <col width="15%">
        <col width="65%">
    </colgroup>
    <tr >
        <td colspan="2">
            <p align="left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;" >Doc Code: Oath</b></p>
            <p align="left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;">Document Description: Oath or declaration filed</b></p>
        </td>
        <td colspan="1">
            <p align="right" class="superSmall">PTO/AIA/08 (11-15)</p>
            <p align="right" class="superSmall">Approved for use through 4/30/2017. OMB 0651-0032</p>
        </td>
    </tr>
    <tr style="margin-top: 0px !important;padding-top: 0px !important;">
        <td colspan="3" style="padding-top: 0px !important;margin-top: 0px !important;">
            <p align="right" class="superSmall">U.S. Patent and Trademark Office; U.S. DEPARTMENT OF COMMERCE</p>
            <p align="right" class="superSmall">Under the Paperwork Reduction Act of 1995, no persons are required to respond to a collection of information unless it contains a valid OMB control number.</p>
        </td>
    </tr>
</table>

<table class="border-round" style="border-spacing: 0;">
    <colgroup>
        <col width="5%">
        <col width="15%">
        <col width="10%">
        <col width="20%">
        <col width="20%">
        <col width="30%">
    </colgroup>
    <tr style="padding: 0px;margin: 0px;">
        <td rowspan="4" colspan="4" style="border-right: 1px solid black;padding: 0px !important;margin: 0px !important;"> {{--width: 50%;--}}
            <p align="center"  style="padding: 0px !important;margin: 0px !important;"><strong>DECLARATION FOR UTILITY OR</strong></p>
            <p align="center" style="padding: 0px;margin: 0px;"><strong>DESIGN </strong></p>
            <p align="center" style="padding: 0px;margin: 0px;"><strong>PATENT APPLICATION</strong></p>
            <p align="center" style="padding: 0px;margin: 0px;"><strong>(37 CFR 1.63)</strong></p>
        </td>
        <td colspan="1" class="inner-border"> <p class="mySmall" align="left" style="margin: 0px !important;">Attorney Docket<br> Number</p></td>{{--style="width: 20%;"--}}
        <td colspan="1" style="border-bottom: 1px solid black;width: 30% !important;">{{$client->fileno}}</td>
    </tr>
    <tr style="padding: 0px;margin: 0px;">
        <td  class="inner-border"> <p class="mySmall" style="margin: 0px !important;">First Named Inventor </p></td>
        <td  style="border-bottom: 1px solid black;"><p align="left" style="margin: 0px !important;">{{ucwords($client->fname." ".$client->lname)}}</p></td>
    </tr>
    <tr style="padding: 0px;margin: 0px;">
        <td colspan="2" style="border-bottom: 1px solid black"> <p class="mySmall" align="center"> COMPLETE IF KNOWN </p></td>
    </tr>
    <tr style="padding: 0px;margin: 0px;">
        <td colspan="1"  class="inner-border"> <p class="mySmall" >Application Number </p></td>
        <td colspan="1" style="border-bottom: 1px solid black">{{--$pcs->patentAppNo--}}</td>
    </tr>
    <tr style="padding: 0px;margin: 0px;">
        <td rowspan="3" style="width: 5% !important;padding: 0px !important;margin: 0px !important;" colspan="1">&nbsp; <img src="{{asset('/img/chk_square.png') }}" alt=""></td>
        <td rowspan="3" style="width: 15% !important;padding: 0px !important;margin: 0px !important;" colspan="1"><p class="pSmall">Declaration Submitted With Initial Filing</p></td>
        <td rowspan="3" style="width: 10% !important;padding: 0px !important;margin: 0px !important;" colspan="1">OR &nbsp;<img src="{{asset('/img/unchk_square.png') }}" alt=""></td>
        <td rowspan="3" style="width: 20% !important;padding: 0px !important;margin: 0px !important;" colspan="1" style="border-right: 1px solid black"><p class="pSmall">Declaration Submitted<br>  After Initial Filing<br></b> (surcharge  (37 CFR 1.16(f)) required)</p></td>
        <td  class="inner-border" style="border-left: 1px black solid;"> <p class="mySmall">Filing Date</p></td>
        <td style="border-bottom: 1px solid black"></td>
    </tr>
    <tr style="padding: 0px;margin: 0px;">
        <td class="inner-border" style="border-left: 1px black solid;"> <p class="mySmall"> Art Unit </p></td>
        <td style="border-bottom: 1px solid black"></td>
    </tr>
    <tr style="padding: 0px;margin: 0px;">
        <td style="border-right: 1px solid black;border-left: 1px black solid;"> <p class="mySmall">Examiner Name </p></td>
        <td></td>
    </tr>
</table>
<div class="col-md-12 vendorBox" style="border: 2px solid black;">
    <p align="center" class="pSmall" style="border: 1px black solid;">@if($design == 0) {{strtoupper($pcs->titleofinvention)}}@else{{strtoupper($pcs->titleofinventionD)}}@endif</p>
    <p align="center" class="mySmall" style="padding-top: 0px !important;margin-top: 0px !important;"><i>(Title of the Invention)</i></p>
    <p align="left" class="pSmall" style="margin: 0px 0px 0px 5px !important;">As a below named inventor, I hereby declare that:</p>
    <p align="left" class="pSmall" style="margin: 0px 0px 0px 5px !important;">This declaration is directed to: </p>
    <p align="left" class="pSmall"> <img src="{{asset('/img/unchk_square.png') }}" alt=""> The attached application, </p>
    <p> OR</p>
    <p align="left" class="pSmall" style="margin: 0px 0px 5px 5px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="">
        United States Application Number or PCT International application number ________________________________ </p>
    <p class="pSmall" style="margin: 0px 0px 0px 5px !important;">filed on _________________________________.</p><br>
    <p class="pSmall" style="margin: 0px 0px 0px 5px !important;">The above-identified application was made or authorized to be made by me.</p>
    <p class="pSmall" style="margin: 0px 0px 0px 5px !important;"> I believe I am the original inventor or an original joint inventor of a claimed invention in the application.</p>
    <p class="pSmall" style="margin: 0px 0px 0px 5px !important;"> I hereby acknowledge that any willful false statement made in this declaration is punishable under 18 U.S.C. 1001<br> by fine or imprisonment of not more than five (5) years, or both. </p>
    <table class="border-normal" style="padding-bottom: 0px;margin-bottom: 0px;">
        <tr>
            <td style="width: 20%;;margin: 0px !important;padding: 0px 0px 0px 10px !important;border-bottom: 1px solid black;"><p align="left" class="pSmall" style="margin: 0px 0px 10px 0px !important;padding: 0px !important;">Direct all correspondence to:</p></td>
            <td style="width: 5%;margin: 0px !important;padding: 0px !important;border-bottom: 1px solid black;"><img src="{{asset('/img/chk_square.png') }}" alt="" style="margin: 0px 0px 10px 10px !important;"></td>
            <td style="width: 20%;margin: 0px !important;padding: 0px !important;border-bottom: 1px solid black;"><p align="left" class="pSmall" style="margin: 0px 0px 10px 0px !important;padding: 0px !important;">The address associated with Customer Number:</p></td>
            <td style="width: 20% !important;margin: 0px !important;padding: 0px !important;border-bottom: 1px solid black;"><textarea rows="1" cols="10" style="width: 100px !important;height: 30px !important;margin: 10px 0px 10px 10px !important;padding: 0px !important;" disabled="disabled">{{$attorney->customer_number}}</textarea></td>
            <td style="width: 10%;margin: 0px !important;padding: 0px !important;border-bottom: 1px solid black;">OR <img src="{{asset('/img/unchk_square.png') }}" alt="" style="margin: 0px 0px 10px 10px;"></td>
            <td colspan="2" style="width: 25%;border-bottom: 1px solid black;"><p align="left" class="pSmall" style="margin: 0px 0px 10px 0px!important;">Correspondence address below</p></td>
        </tr>
        <tr>
            <td colspan="7" style="border-bottom: 1px solid black;"><p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;height: 28px">Name <br>&nbsp; </p></td>
        </tr>
        <tr>
            <td colspan="7" style="border-bottom: 1px solid black;"><p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;height: 28px">Address <br>&nbsp; </p></td>
        </tr>
        <tr>
            <td colspan="3" class="inner-border"><p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;height: 28px">City <br>&nbsp; </p></td>
            <td colspan="2" class="inner-border"><p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;height: 28px">State <br>&nbsp; </p></td>
            <td colspan="2" style="border-bottom: 1px solid black;"><p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;height: 28px">Zip <br>&nbsp; </p></td>
        </tr>
        <tr>
            <td colspan="2"  class="inner-border"><p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;height: 28px">Country <br>&nbsp; </p></td>
            <td colspan="2"  class="inner-border"><p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;height: 28px">Telephone <br>&nbsp; </p></td>
            <td colspan="3"  style="border-bottom: 1px solid black;"><p align="left" class="pSmall" style="padding-top:0px !important;margin-top: 0px !important;height: 28px">Email <br>&nbsp; </p></td>
        </tr>
    </table>
</div>
<p align="center" class="superSmall" style="padding: 0px !important;margin: 0px !important;">[Page 1 of 2]</p>
<p align="left" class="superSmall" style="padding: 0px !important;margin: 0px !important;">This collection of information is required by 35 U.S.C. 115 and 37 CFR 1.63. The information is required to obtain or retain a benefit by the public which is to file (and by the USPTO to process) an application. Confidentiality is governed by 35 U.S.C. 122 and 37 CFR 1.11 and 1.14. This collection is estimated to take 21 minutes to complete, including gathering, preparing, and submitting the completed application form to the USPTO. Time will vary depending upon the individual case. Any comments on the amount of time you require to complete this form and/or suggestions for reducing this burden, should be sent to the Chief Information Officer, U.S. Patent and Trademark Office, U.S. Department of Commerce, P.O. Box 1450, Alexandria, VA 22313-1450. DO NOT SEND FEES OR COMPLETED FORMS TO THIS ADDRESS. SEND TO: Commissioner for Patents, P.O. Box 1450, Alexandria, VA 22313-1450. </p>
<p align="center" class="superSmall" style="padding: 0px !important;margin: 0px !important;">If you need assistance in completing the form, call 1-800-PTO-9199 and select option 2. </p>



<div class="page-break"></div>
<!--page 2-->
<p align="right" class="superSmall">
    PTO/AIA/10 (11-15)
</p>
<p align="right" class="superSmall">
    Approved for use through 4/30/2017. OMB 0651-0032
</p>
<p align="right" class="superSmall">
    U.S. Patent and Trademark Office; U.S. DEPARTMENT OF COMMERCE
</p>
<p align="right" class="superSmall">
    Under the Paperwork Reduction Act of 1995, no persons are required to respond to a collection of information unless it contains a valid OMB control number.
</p>
<br>
<table style="width: 100%;border:2px solid black;border-radius: 25px 25px 25px 25px !important;margin:0px 30px 10px 30px !important;">
    <tr>
        <td><p align="center"><strong>DECLARATION — Utility or Design Patent Application </strong></p></td>
    </tr>
</table>

<table class="border-normal" style="padding-bottom: 0px;margin-bottom: 0px;">
    <tr>
        <td colspan="7" style="border-bottom: 1px solid black;">
            <p align="center"> <strong>WARNING:</strong></p>
            <p class="pSmall" align="left">Petitioner/applicant is cautioned to avoid submitting personal information in documents filed in a patent application that
                may contribute to identity theft. Personal information such as social security numbers, bank account numbers, or credit
                card numbers (other than a check or credit card authorization form PTO-2038 submitted for payment purposes) is never
                required by the USPTO to support a petition or an application. If this type of personal information is included in
                documents submitted to the USPTO, petitioners/applicants should consider redacting such personal information from the
                documents before submitting them to the USPTO. Petitioner/applicant is advised that the record of a patent application
                is available to the public after publication of the application (unless a non-publication request in compliance with 37
                CFR 1.213(a) is made in the application) or issuance of a patent. Furthermore, the record from an abandoned application
                may also be available to the public if the application is referenced in a published application or an issued patent (see
                37 CFR 1.14). Checks and credit card authorization forms PTO-2038 submitted for payment purposes are not retained in the
                application file and therefore are not publicly available. Petitioner/applicant is advised that documents which form the
                record of a patent application (such as the PTO/SB/01) are placed into the Privacy Act system of records DEPARTMENT OF
                COMMERCE, COMMERCE-PAT-7, System name: <i>Patent Application Files</i> . Documents not retained in an application file (such as
                the PTO-2038) are placed into the Privacy Act system of COMMERCE/PAT-TM-10, System name: <i>Deposit Accounts and Electronic
                    Funds Transfer Profiles</i> .
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="7" style="border-bottom: 1px solid black;"><p class="mySmall" style="margin-left: 25px !important;"> <b>LEGAL NAME OF SOLE OR FIRST INVENTOR: </b></p></td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid black;" colspan="7">
            <p style="font-size: 13px; padding-top: 0px;margin-top: 0px;">(E.g., Given Name (first and middle (if any)) and Family Name or Surname)</p>
            <p style="margin-bottom: 0px !important;margin-top: 0px !important;">{{ucwords($client->fname." ".$client->lname)}}</p>
        </td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid black;border-right: 1px solid black;" colspan="5">
            <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;">
                Inventor’s Signature
                <img src="{{asset('files/projects/'.$fileno.'/signature_dec.jpg')}}" style="margin-top: 10px !important;margin-left: 20px !important;">
            </p>

        </td>
        <td style="border-bottom: 1px solid black;" colspan="2"><p style="padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;font-size: 13px;">Date (Optional)</p></td>
    </tr>
    <tr>
        <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
            <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;">Residence: City </p>
            <p style="margin-bottom: 0px !important;margin-top: 0px !important;">{{ucwords($client->city)}}</p>
        </td>
        <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
            <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;">State </p>
            <p style="margin-bottom: 0px !important;margin-top: 0px !important;">{{strtoupper($client->state)}}</p>
        </td>
        <td colspan="3" style="border-bottom: 1px solid black;">
            <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;">Country</p>
            <p style="margin-bottom: 0px !important;margin-top: 0px !important;">@if($client->country!=""){{$client->country}}@else US @endif</p>
        </td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid black;" colspan="7">
            <p style="font-size: 13px; padding-top: 0px;margin-top: 0px;margin-left: 0px;padding-left: 0px">Mailing Address</p>
            <p style="margin-bottom: 0px !important;margin-top: 0px !important;">{{$client->street}}</p>
        </td>
    </tr>
    <tr>
        <td colspan="1" style="border-bottom: 1px solid black;border-right: 1px solid black;">
            <p style="margin-top: 0px !important;font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">City </p>
            <p style="margin-bottom: 0px !important;margin-top: 0px !important;">{{$client->city}}</p>
        </td>
        <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
            <p style="margin-top: 0px !important;font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">State </p>
            <p style="margin-bottom: 0px !important;margin-top: 0px !important;">{{$client->state}}</p>
        </td>
        <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
            <p style="margin-top: 0px !important;font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">Zip </p>
            <p style="margin-bottom: 0px !important;margin-top: 0px !important;">{{$client->zip}}</p>
        </td>
        <td colspan="2" style="border-bottom: 1px solid black;">
            <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;margin-top: 0px !important;">Country </p>
            <p style="margin-bottom: 0px !important;margin-top: 0px !important;">{{$client->country}}</p>
        </td>
    </tr>
    <tr>
        <td colspan="7">
            <p class="verySmall" style="margin-left: 100px !important;">
                <img src="{{$sheetsCount == 0 ? asset('/img/unchk_square.png') : asset('/img/chk_square.png')}}" alt="">
                &nbsp;&nbsp;&nbsp;Additional inventors are being named on the <u>{{$sheetsCount>0 ? $sheetsCount : "___"}}</u>
                supplemental sheet(s) PTO/AIA/10 attached hereto
            </p>
            <br><br><br><br><br><br><br><br>
        </td>
    </tr>
</table>
<p class="verySmall" align="center" style="padding-top: 0px;margin-top: 0px;">[Page 2 of 2] </p>

<div class="page-break"></div>
<!--page 3-->
<br><br>
<p align="center" style="font-size: 22px !important;"><strong>Privacy Act Statement</strong></p>
<p align="left" class="pSmall"><b>The Privacy Act of 1974 (P.L. 93-579)</b> requires that you be given certain information in connection
    with your submission of the attached form related to a patent application or patent. Accordingly, pursuant to the requirements
    of the Act, please be advised that: (1) the general authority for the collection of this information is 35 U.S.C. 2(b)(2); (2)
    furnishing of the information solicited is voluntary; and (3) the principal purpose for which the information is used by the U.S.
    Patent and Trademark Office is to process and/or examine your submission related to a patent application or patent. If you do not
    furnish the requested information, the U.S. Patent and Trademark Office may not be able to process and/or examine your submission,
    which may result in termination of proceedings or abandonment of the application or expiration of the patent.
</p>
<p align="left" class="pSmall">The information provided by you in this form will be subject to the following routine uses: </p>
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