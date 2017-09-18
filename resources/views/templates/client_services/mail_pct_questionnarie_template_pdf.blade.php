<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
    <p class="textCenter pSmall">
        <strong>
            <u>
                PCT Questionnaire
            </u>
        </strong>
    </p>
    <p class=" pSmall">
        Title of the Work: ___________________<u>{{$title}}</u>________________________
    </p>
    <p class=" pSmall">
        Name and address of the Owner:
    </p>
    <p class=" pSmall">
        ______________<u>{{$fname}}</u>__________________
    </p>
    <p class=" pSmall">
        ______________<u>{{$address}}</u>_________________
    </p>
    <p class=" pSmall">
        ________________<u>{{$title}}</u>_________________
    </p>
    <br>
    <p class=" pSmall">
        Author's Date of Birth: ______<u>{{$dateBirth}}</u>__________________
    </p>
    <p class=" pSmall">
        Author's Nationality: _________<u>{{$nationality}}</u>________________
    </p>
    <p class=" pSmall">
        Citizen of: _____________<u>{{$citizen}}</u>____________________
    </p>
    <p class=" pSmall">
        Domiciled in: ____________<u>{{$domiciled}}</u>___________________
    </p>
<p>
    <strong class=" pSmall">
        Complete and return the questionnaire to Patent Services, if you need further assistance, please do not hesitate to
        contact us.  Once again, we wish you continued success and happy inventing!
    </strong>
</p>
<p class=" pSmall">Best regards,</p>
<p class="pSmall">
    Client Support Services<br>
    Patent Services USA, INC.<br>
    12000 Biscayne Blvd., Suite # 700<br>
    North Miami, FL 33181<br>
    1-888-344-6836<br>
    1-800-886-7951 (fax)<br>
    Email: clientservices@ownmyinvention.com
</p>
<br><br><br><br><br>
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
<p class="textRight pSmall" style="width: 100%;">Inventor (s) Initial: <u>{{strtoupper($client->fname[0].$client->lname[0])}}</u></p>