<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="declaration">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p class="pLogo">
            <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
        <br><i>Giving the edge to Inventors!</i>
    </p>
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
                    <p class="pull-left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;" >Doc Code: P.A</b></p>
                    <p class="pull-left" style="margin: 0px !important;padding: 0px !important;"><b style="font-size: 12px;">Document Description: Power of Attorney</b></p>
                </td>
                <td colspan="1">
                    <p  class="superSmall pull-right">PTO/AIA/08 (06-12)</p><br>
                    <p  class="superSmall pull-right">Approved for use through 01/31/2014. OMB 0651-0032</p>
                </td>
            </tr>
            <tr style="margin-top: 0px !important;padding-top: 0px !important;">
                <td colspan="3" style="padding-top: 0px !important;margin-top: 0px !important;">
                    <p class="superSmall pull-right">U.S. Patent and Trademark Office; U.S. DEPARTMENT OF COMMERCE</p>
                    <p class="superSmall pull-right">Under the Paperwork Reduction Act of 1995, no persons are required to respond to a collection of information unless it contains a valid OMB control number.</p>
                </td>
            </tr>
        </table>

        <table class="border-round">
            <tr>
                <td>
                    <p style="text-align: center;" class="mySmall"><b>TRANSMITTAL FOR POWER OF ATTORNEY TO ONE OR MORE</b></p>
                    <p style="text-align: center;" class="mySmall"><b>REGISTERED PRACTITIONERS</b></p>
                </td>

            </tr>
        </table>

        <table class="border-normal" style="margin-bottom: 0px !important;">
            <tr>
                <td colspan="4" style="border-bottom: 1px solid black;">
                    <p class="mySmall" style="margin-left: 10px !important;margin-right: 10px !important;"><u>NOTE:</u> This form is to be submitted with the Power of Attorney by Applicant form(PTO/AIA/82B or equivalent)
                        to identify the application to which the Power of Attorney is directed, in accordance with 37 CFR 1.5. If the Power of
                        Attorney by Applicant form is not accompanied by this transmittal form or an equivalent, the Power of Attorney will
                        not be recognized in the application.
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="width: 33%;" class="inner-border"><p class="mySmall">Application Number</p></td>
                <td colspan="3" style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td colspan="1" class="inner-border"><p class="mySmall">Filing Date</p></td>
                <td colspan="3" style="border-bottom: 1px solid black;"></td>
            </tr><tr>
                <td colspan="1" class="inner-border"><p class="mySmall">First Named Inventor </p></td>
                <td colspan="3" style="border-bottom: 1px solid black;"><p class="mySmall">{{ucwords($client->fname)}}</p></td>
            </tr><tr>
                <td colspan="1" class="inner-border"><p class="mySmall">Title </p></td>
                <td colspan="3" style="border-bottom: 1px solid black;"></td>
            </tr><tr>
                <td colspan="1" class="inner-border"><p class="mySmall">Art Unit</p></td>
                <td colspan="3" style="border-bottom: 1px solid black;"></td>
            </tr><tr>
                <td colspan="1" class="inner-border"><p class="mySmall">Examiner Name</p></td>
                <td colspan="3" style="border-bottom: 1px solid black;"></td>
            </tr><tr>
                <td colspan="1" class="inner-border"><p class="mySmall">Attorney Docket Number</p></td>
                <td colspan="3" style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td colspan="4" style="border-bottom: 1px solid black;"><p class="mySmall" style="margin-bottom: 0px !important;text-align: center;">SIGNATURE of Applicant or Patent Practitioner </p></td>
            </tr>
            <tr>
                <td class="inner-border" style="width: 20%"><p class="mySmall">Signature</p></td>
                <td class="inner-border" style="width: 40%">
                    <div class="sigPad col-md-12" id="signt_poa_2" style="padding-top: 5px;width:100% !important;">
                        <div class="sig sigWrapper current col-md-8" style="margin-left: 40px;margin-bottom: 10px;width: 200px !important;">
                            <canvas class="pad" width="180px" height="50"></canvas>
                            <input type="hidden" name="output1" class="output">
                        </div>
                        <div class="col-md-4">
                            <ul class="sigNav" style="float:left;margin-left: 50px;">
                                <li class="clearButton" style="display: list-item;margin: 0px !important;"><a href="#clear" style="font-size: 11px !important;">Clear</a></li>
                            </ul>
                        </div>
                    </div>
                </td>
                <td colspan="1" class="inner-border" style="width: 10%;"><p class="mySmall">Date</p></td>
                <td colspan="1" style="border-bottom: 1px solid black;width: 30%;"></td>
            </tr>
            <tr>
                <td colspan="1" class="inner-border"><p class="mySmall">Name </p></td>
                <td colspan="1" class="inner-border">{{ucwords($client->fname." ".$client->lname)}}</td>
                <td colspan="1" class="inner-border"><p class="mySmall">Telephone </p></td>
                <td colspan="1" style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td colspan="1" class="inner-border"><p class="mySmall">Registration Number</p></td>
                <td colspan="3" style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td colspan="4" style="border-bottom: 1px solid black;"><p class="verySmall">NOTE: This form must be signed in accordance with 37 CFR 1.33. See 37 CFR 1.4(d)for signatures requirements and certifications.</p></td>
            </tr>
            <tr>
                <td colspan="4"><p class="verySmall"> &nbsp;<img src="{{asset('/img/unchk_square.png') }}" alt=""> &nbsp;&nbsp;&nbsp;*Total of ____________ forms are submitted.</p></td>
            </tr>
        </table>
        <p class="superSmall" style="text-align: left;">This collection of information is required by 37 CFR 1.31, 1.32 and 1.33. The information is required to
            obtain or retain a benefit by the public which is to file (and by the USPTO to process) an application. Confidentiality is
            governed by 35 U.S.C. 122 and 37 CFR 1.11 and 1.14. This collection is estimated to take 3 minutes to complete, including
            gathering, preparing, and submitting the completed application form to the USPTO. Time will vary depending upon the individual
            case.  Any comments on the amount of time you require to complete this form and/or suggestions for reducing this burden,
            should be sent to the Chief Information Officer, U.S. Patent and Trademark Office, U.S. Department of Commerce, P.O. Box 1450,
            Alexandria, VA 22313-1450. DO NOT SEND FEES OR COMPLETED FORMS TO THIS ADDRESS. SEND TO: Commissioner for Patents, P.O. Box
            1450, Alexandria, VA 22313-1450.
        </p>
        <p class="superSmall" style="text-align: center;">If you need assistance in completing the form, call 1-800-PTO-9199 and select option 2. </p>

        <table class="border-round">
            <tr>
                <td>
                    <p style="text-align: center;font-size: 18px !important;margin-top: 0px !important;margin-bottom: 0px !important;"><b>POWER OF ATTORNEY BY APPLICANT </b></p>
                </td>

            </tr>
        </table>

        <div style="border: 2px solid black;">
            <div style="width: 100%;border-bottom:2px solid black;padding:0px !important;margin: 0px !important;">
                <p style="font-size: 13px;padding:0px !important;margin: 0px 0px 0px 10px !important;">I hereby revoke all previous powers of attorney given in the application identified in the attached transmittal  letter.</p>
            </div>
            <div style="width: 100%;border-bottom:2px solid black;padding:0px !important;margin: 0px !important;">
                <p class="pSmall" style="margin-bottom: 0px !important;padding: 0px !important;">
                    &nbsp;<img src="{{asset('/img/chk_square.png') }}" alt="">
                    I hereby appoint Practitioner(s) associated with the following Customer Number as my/our attorney(s) or agent(s),
                    and to transact all business in the United States Patent and Trademark Office connected therewith for the application referenced
                    in the attached transmittal letter (form PTO/AIA/82A or  equivalent):
                    <textarea style="width: 100px !important;height: 30px !important;margin-left: 10px;"></textarea>
                </p>
                <span style="margin-left: 10px;">OR</span>
                <p class="pSmall" style="margin-bottom: 0px !important;padding: 0px !important;">
                    &nbsp;<img src="{{asset('/img/unchk_square.png') }}" alt="">
                    I hereby appoint Practitioner(s) named below as my/our attorney(s) or agent(s), and to transact all business in the
                    United States Patent and Trademark Office connected therewith for the application referenced in the attached transmittal
                    letter (form PTO/AIA/82A or equivalent):
                </p>
                <table class="border-normal" style="width: 95% !important;margin-left: 18px !important;margin-bottom: 6px !important;">
                    <tr>
                        <td style="width: 35% !important;" class="inner-border"><p class="pSmall" style="text-align: center;margin: 0px !important;padding: 0px !important;">Name</p></td>
                        <td style="width: 13% !important;" class="inner-border"><p class="pSmall" style="text-align: center;margin: 0px !important;padding: 0px !important;">Registration Number</p></td>
                        <td rowspan="6" style="width: 4% !important;" class="inner-border"></td>
                        <td style="width: 35% !important;" class="inner-border"><p  class="pSmall" style="text-align: center;margin: 0px !important;padding: 0px !important;">Name</p></td>
                        <td style="width: 13% !important;border-bottom: 1px solid black;"><p class="pSmall" style="text-align: center;margin: 0px !important;padding: 0px !important;">Registration Number</p></td>
                    </tr>
                    <tr>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td class="inner-border">&nbsp;</td>
                        <td style="border-bottom: 1px solid black;">&nbsp;</td>
                    </tr>
                </table>
            </div>
            <div style="padding: 0px !important;margin: 0px !important;">
                <p class="pSmall" style="margin-top: 0px !important;">Please recognize or change the correspondence address for the application identified in the attached transmittal letter to: </p>
                <p class="mySmall" style="padding-left: 15px !important;">
                    <img src="{{asset('/img/unchk_square.png') }}" alt=""> The address associated with the above-mentioned Customer Number.<br>
                    <b class="pSmall">OR</b>
                </p>
                <p class="mySmall" style="margin-bottom: 0px !important;padding-bottom: 0px !important;padding-left: 15px !important;">
                    <span><img src="{{asset('/img/unchk_square.png') }}" alt="" style="margin-bottom: 0px !important;"> The address associated with  Customer Number: <textarea style="width: 100px !important;height: 30px !important;margin-left: 10px;"></textarea></span>
                    <br>
                    <b class="pSmall" style="margin-bottom: 0px !important;padding-bottom: 0px !important;">OR</b>
                </p>
            </div>
            <table class="border-normal" style="margin-top: 0px !important;">
                <tr>
                    <td class="inner-border" style="width: 20% !important;">
                        <p class="mySmall" style="padding:3px 0px 0px 15px !important;margin: 0px !important;">
                            <img src="{{asset('/img/unchk_square.png') }}" alt="" style="margin: 0px !important;">
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
                <p class="pSmall" style="margin-bottom: 0px !important;margin-top: 0px !important;">I am the Applicant:</p>
                <p class="mySmall" style="margin-left: 15px !important;margin-bottom: 0px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="" style="margin: 0px !important;">&nbsp;Inventor or Joint Inventor </p>
                <p class="mySmall" style="margin-left: 15px !important;margin-bottom: 0px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="" style="margin: 0px !important;">&nbsp;Legal Representative of a Deceased or Legally Incapacitated Inventor </p>
                <p class="mySmall" style="margin-left: 15px !important;margin-bottom: 0px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="" style="margin: 0px !important;">&nbsp;Assignee or Person to Whom the Inventor is Under an Obligation to Assign </p>
                <p class="mySmall" style="margin-left: 15px !important;margin-bottom: 0px !important;padding-right: 10px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="" style="margin: 0px !important;">&nbsp;Person Who Otherwise Shows Sufficient Proprietary Interest (e.g., a petition under 37 CFR 1.46(b)(2) was granted in the</p>
                <p class="pSmall" style="margin-left: 28px !important;margin-top: 0px !important;margin-bottom: 0px !important;">application or is concurrently being filed with this document)</p>
            </div>
            <table class="border-normal">
                <tr>
                    <td colspan="4" style="border-bottom: 1px solid black;"><p class="mySmall" style="text-align: center;margin-bottom: 0px !important;">SIGNATURE of Applicant for Patent </p></td>
                </tr>
                <tr>
                    <td style="width: 25% !important;" class="inner-border"><p class="mySmall" style="margin-bottom: 0px !important;">Signature </p></td>
                    <td style="width: 40% !important;" class="inner-border">
                        <div class="sigPad col-md-12" id="signt_poa" style="padding-top: 5px;width:100% !important;">
                            <div class="sig sigWrapper current col-md-8" style="margin-left: 40px;margin-bottom: 10px;width: 200px !important;">
                                <canvas class="pad" width="180px" height="50"></canvas>
                                <input type="hidden" name="output" class="output">
                            </div>
                            <div class="col-md-4">
                                <ul class="sigNav" style="float:left;margin-left: 50px;">
                                    <li class="clearButton" style="display: list-item;margin: 0px !important;"><a href="#clear" style="font-size: 11px !important;">Clear</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td style="width: 10% !important;" class="inner-border"><p class="mySmall" style="margin-bottom: 0px !important;">Date</p></td>
                    <td style="width: 25% !important;border-bottom: 1px solid black;"></td>
                </tr>
                <tr>
                    <td class="inner-border"><p class="mySmall" style="margin-bottom: 0px !important;">Name</p></td>
                    <td class="inner-border"><p class="nySmall">{{ucwords($client->fname." ".$client->lname)}}</p></td>
                    <td class="inner-border"><p class="mySmall" style="margin-bottom: 0px !important;">Telephone</p></td>
                    <td style="border-bottom: 1px solid black;"></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid black;"><p class="mySmall" style="margin-bottom: 0px !important;">Title and Company </p></td>
                    <td colspan="3" style="border-bottom: 1px solid black;"></td>
                </tr>
            </table>
            <div style="width: 100%;border-bottom:2px solid black;padding:0px !important;margin: 0px !important;">
                <p style="font-size: 11px;padding:0px !important;margin: 0px 0px 0px 10px !important;"><u>NOTE:</u> Signature - This form must be signed by the applicant in accordance with 37 CFR 1.33. See 37 CFR 1.4 for signature requirements and certifications. Submit multiple forms for more than one signature, see below *. </p>
            </div>
            <div style="width: 100%;margin: 0px !important;">
                <p style="font-size: 11px;padding:0px !important;margin: 0px 0px 2px 10px !important;"><img src="{{asset('/img/unchk_square.png') }}" alt="" style="margin: 0px !important;">&nbsp;*Total of ____________ forms are submitted.</p>
            </div>
        </div>
        <p class="superSmall">This collection of information is required by 37 CFR 1.31, 1.32 and 1.33. The information is required to obtain or retain a benefit
            by the public which is to file (and by the USPTO to process) an application. Confidentiality is governed by 35 U.S.C. 122 and 37
            CFR 1.11 and 1.14. This collection is estimated to take 3 minutes to complete, including gathering, preparing, and submitting the
            completed application form to the USPTO. Time will vary depending upon the individual case. Any comments on the amount of time you
            require to complete this form and/or suggestions for reducing this burden, should be sent to the Chief Information Officer,  U.S.
            Patent and Trademark Office, U.S. Department of Commerce, P.O. Box 1450, Alexandria, VA 22313-1450. DO NOT SEND FEES OR COMPLETED
            FORMS TO THIS ADDRESS. SEND TO: Commissioner for Patents, P.O. Box 1450, Alexandria, VA 22313-1450.</p>
        <p style="text-align: center;" class="superSmall">If you need assistance in completing the form, call 1-800-PTO-9199 and select option 2.   </p>
        <div class="col-md-12">
            <p style="text-align: center;margin-top: 30px !important;">Privacy Act Statement </p>
            <p style="text-align: left;" class="mySmall">The <strong style="font-size: 13px !important;">Privacy Act of 1974 (P.L. 93-579)</strong> requires that you be given
                certain information in connection with your submission of the attached form related to a patent application or patent.
                Accordingly, pursuant to the requirements of the Act, please be advised that: (1) the general authority for the collection
                of this information is 35 U.S.C. 2(b)(2); (2) furnishing of the information solicited is voluntary; and (3) the principal
                purpose for which the information is used by the U.S. Patent and Trademark Office is to process and/or examine your submission
                related to a patent application or patent. If you do not furnish the requested information, the U.S. Patent and Trademark Office
                may not be able to process and/or examine your submission, which may result in termination of proceedings or abandonment of the
                application or expiration of the patent. </p>
            <p class="mySmall" style="text-align: center;margin-top: 10px !important;">The information provided by you in this form will be subject to the following routine uses:  </p>
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
    </form>
</div>