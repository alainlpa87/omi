<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="{{$document}}">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p class="pLogo">
            <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>
        <link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
        <!--page 1-->
        <p class="superSmall" style="text-align: right;" >
            PTO/AIA/10 (06-12)
        </p>
        <p class="superSmall" style="text-align: right;">
            Approved for use through 01/31/2014. OMB 0651-0032
        </p>
        <p class="superSmall pull-right" style="text-align: right;">
            U.S. Patent and Trademark Office; U.S. DEPARTMENT OF COMMERCE
        </p>
        <p class="superSmall pull-right" style="text-align: right;">
            Under the Paperwork Reduction Act of 1995, no persons are required to respond to a collection of information unless it contains a valid OMB control number.
        </p>

        <table class="border-round">
            <tr>
                <td style="width: 50%;border-right: 1px solid black;font-size: 15px !important;"><b>SUPPLEMENTAL SHEET FOR DECLARATION</b></td>
                <td style="width: 50%;padding-left: 10px;">
                    <p  style="padding: 0px;margin: 0px;font-size:13px !important"><b>ADDITIONAL INVENTOR(S)</b></p>
                    <p  style="padding: 0px;margin: 0px;font-size:13px">Supplemental Sheet (for PTO/AIA/08,09)</p>
                    <p  align="right" style="padding: 0px;margin: 0px;font-size:12px"> Page <input type="number" name="pag" id="pag" style="width: 60px;height: 20px;"> of <input type="number" name="pag_tot" id="pag_tot" style="width: 60px;height: 20px;"> </p>
                </td>
            </tr>
        </table>
        <div class="table-responsive">
        <table class="border-normal table">
            <colgroup>
                <col width="22%">
                <col width="22%">
                <col width="22%">
                <col width="12%">
                <col width="22%">
            </colgroup>
            @for($i = 0; $i < $coInvCount;$i++)
                <tr>
                    <td colspan="5" style="border-bottom: 1px solid black;padding-top: 10px;"><b style="font-size: 14px;">Legal Name of Additional Joint Inventor, if any: </b> </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid black;" colspan="5">
                        <p style="font-size: 13px; padding-top: 0px;margin-top: 0px;">(E.g., Given Name (first and middle (if any)) and Family Name or Surname)</p>
                        <p>{{$coInvs[$i]}}</p>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid black;border-right: 1px solid black;" colspan="4">
                        <div class="col-md-3 pull-left">
                            <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 0px;">Inventor’s<br>Signature</p>
                        </div>
                        <div class="col-md-9 pull-right">
                            <div class="sigPad sign-add-d" id="signt_s_add_{{$i}}"  style="padding-top: 5px;">
                                <div class="sig sigWrapper current">
                                    <canvas class="pad" width="290" height="50"></canvas>
                                    <input type="hidden" name="output{{$i}}" class="output">
                                </div>
                                <ul class="sigNav">
                                    <li class="clearButton" style="display: list-item;margin: 0px !important;"><a href="#clear" style="font-size: 11px !important;">Clear</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td style="border-bottom: 1px solid black;" colspan="1">
                        <p style="padding-left: 0px;margin-left: 0px;padding-top: 0px;margin-top: 5px;font-size: 13px;">Date (Optional)</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">
                            Residence: City
                            <input type="text" name="residence_{{$i}}" class="form-control">
                        </p>
                    </td>
                    <td colspan="1" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">
                            State
                            <input type="text" name="state_{{$i}}" class="form-control">
                        </p>
                    </td>
                    <td colspan="2" style="border-bottom: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">
                            Country
                            <input type="text" name="country_{{$i}}" class="form-control">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid black;" colspan="5">
                        <p style="font-size: 13px; padding-bottom: 0px;margin-bottom: 0px;margin-left: 0px;padding-left: 0px">
                            Mailing Address
                            <input type="text" name="mAddress_{{$i}}" class="form-control">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">
                            City
                            <input type="text" name="city_{{$i}}" class="form-control">
                        </p>
                    </td>
                    <td colspan="1" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">
                            State
                            <input type="text" name="state1_{{$i}}" class="form-control">
                        </p>
                    </td>
                    <td colspan="1" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">
                            Zip
                            <input type="text" name="zip_{{$i}}" class="form-control">
                        </p>
                    </td>
                    <td colspan="1" style="border-bottom: 1px solid black;">
                        <p style="font-size: 13px;padding-left: 0px;margin-left: 0px;padding-bottom: 0px;margin-bottom: 0px;">
                            Country
                            <input type="text" name="country1_{{$i}}" class="form-control">
                        </p>
                    </td>
                </tr>
            @endfor
        </table>
        </div>
        <div style="padding-left: 10px;">
            <p style="text-align: left;"  class="superSmall">
                This collection of information is required by 35 U.S.C. 115 and 37 CFR 1.63. The information is required
                to obtain or retain a benefit by the public which is to file (and by the USPTO to process) an application.
                Confidentiality is governed by 35 U.S.C. 122 and 37 CFR 1.11 and 1.14. This collection is estimated to take
                21 minutes to complete, including gathering, preparing, and submitting the completed application form to the
                USPTO. Time will vary depending upon the individual case. Any comments on the amount of time you require to
                complete this form and/or suggestions for reducing this burden, should be sent to the Chief Information Officer,
                U.S. Patent and Trademark Office, U.S. Department of Commerce, P.O. Box 1450, Alexandria, VA 22313-1450. DO NOT
                SEND FEES OR COMPLETED FORMS TO THIS ADDRESS. SEND TO: Commissioner for Patents, P.O. Box 1450, Alexandria, VA
                22313-1450.
            </p>
            <p class="superSmall" style="margin-top: 10px !important;text-align: center">If you need assistance in completing the form, call 1-800-PTO-9199 (1-800-786-9199) and select option 2. </p>
        </div>
        <div class="col-md-12">
            <p style="margin-top: 30px !important;text-align: center"> Privacy Act Statement </p>
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
    </form>
</div>