<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
    <p align="center" class="padd_cover">
        <img src="{{asset('img/logo.png')}}" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
        <br><i style="font-size: 16px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>
    <p class="textRight  pSmall">
        {{date("m/d/Y")}}
    </p>
    <p class=" pSmall">
        Dear {{isset($client)?ucwords($client->fname." ".$client->lname):"Client’s Name"}},
    </p>
    <p class="psmall">Congratulations on taking the next important step towards the development of your new invention—Full Patent Protection!  This is a tremendous accomplishment that few inventors ever begin.  Your courage and entrepreneurial spirit will carry you forward, step by step, to realizing your dream of becoming an accomplished inventor!</p>
    <p class="pSmall">We have received the Due Diligence materials, allowing us to submit your Patent Services Agreement to the Independent Registered Patent Attorney.  In order to submit your Copyright Application to the United States Patent and Trademark Office, the Independent Registered Patent Attorney, must receive the following requirements.</p>
    <p class="textCenter pSmall">
        <strong>
            <u>
            Trademark Questionnaire
            </u>
        </strong>
    </p>
    <p class=" pSmall">
        Owner of Mark (Name):  __________________________ &nbsp; Country of Citizenship: _________________________
    </p>
    <p class=" pSmall">
        Street Address:  ________________________________________
    </p>
    <p class=" pSmall">
        City, State, Zip: ________________________________________
    </p>
    <p class=" pSmall">
        Phone Number: __________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  E-mail Address: _______________________________
    </p>
    <p class=" pSmall">
        Enter the mark here: ________________________Has the mark been used?Date of first use: __________________
    </p>
    <p class=" pSmall">

    </p>
    <p>
        <strong  class=" pSmall">Describe the Goods and/or Services</strong> for a single item (<i>e.g.,</i> pants), or multiple items (<i>e.g.,</i>, pants
        shoes) with which the mark will be used:
    </p>
    <p>_________________________________________________________________</p>
    <p  class=" pSmall">
        <strong>Describe how the mark has been used (<i>e.g.,</i> printed on the cartons of boxes;printed or stamped on the goods;labels attached
        to the goods;in advertising,<i>e.g.,</i> building signs;magazine/newspaper;flyers;brochures,etc.):</strong>
    </p>
    <p>_________________________________________________________________</p>
    <p class="psmall">
        Attached Specimen?_____
    </p>
    <p><strong  class=" pSmall">Description of Specimen:</strong></p>

<br><br>
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
<p class="textRight pSmall" style="width: 100%;">Inventor (s) Initial: <span style="text-decoration: underline;"></span></p>
