<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<!--page 1-->
<p align="center" class="padd_cover">
    <img src="{{asset('img/logo.png')}}" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
    <br><i style="font-size: 16px;color: darkblue;">Giving the edge to Inventors!</i>
</p>
<p class="textRight">
    {{date("m/d/Y")}}
</p>
<p>
    Dear {{isset($fname)?$fname:"Client’s Name"}},
</p>
<p>
    Please be advised, the United States Patent and Trademark Office has found your Trademark too
    closely descriptive of your actual invention. Therefore, registration for your trademark will be refused.
</p>
<p>
    <strong>
        If the Trademark merely describes the goods or services, then it is too closely descriptive
        and will be rejected.  For example, trying to trademark "snow shovel" for a snow shovel, or "car
        jack" for a car jack, will not work.  The trademark should NOT give any indication of the goods
        being offered for sale.  Examples of excellent trademarks would be the following: “Apple" for
        computers or "Nissan" for cars, or "BIC" for ink pens, or "Sharpie" for a yellow highlighter.
    </strong>
</p>
<p>
    The Independent Registered Patent Attorney has prepared and submitted preliminary Trademark
    information and requires this additional supporting document.  In order to complete the final phase of your
    application to the United States Patent and Trademark Office, the Registered Patent Attorney is
    requesting this “time-sensitive” information from you, in order to avoid any future filing inconsistencies and
    to expedite your filing promptly.  The attorney requires this completed information returned to us as soon
    as possible.
</p>
<ol>
    <li>
        Enter the new mark here: <u>&nbsp;&nbsp;{{$mark}}&nbsp;&nbsp;</u><br>
        With our goal and responsibility to providing excellent service to you, we can help better inform and
        guide you.  Our organization will facilitate the work and engaging your independent registered patent
        attorney to continue working to represent you before the USPTO examiner.  Contact our office at your
        earliest convenience so that we can discuss your situation further.  We will continue to keep you
        apprised of any further actions or events.
    </li>
</ol>
<table style="margin-bottom: 0px !important;">
    <tr>
        <td>
            <img src="{{asset('files/projects/'.$fileno.'/signature.jpg')}}"><br><p style="margin-top: 0px !important;margin-left: 10px;;z-index: 100;">_____________________</p>
        </td>
        <td>
            <br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;on <u>&nbsp;&nbsp;{{$day}}&nbsp;&nbsp;</u> day of <u>&nbsp;&nbsp;{{$month}}&nbsp;&nbsp;</u>, {{$year}}
        </td>
    </tr>
</table>
{{--<p>--}}
    {{--<img src="{{asset('files/projects/'.$fileno.'/signature.jpg')}}">&nbsp;&nbsp; on <u>&nbsp;&nbsp;{{$day}}&nbsp;&nbsp;</u> day of <u>&nbsp;&nbsp;{{$month}}&nbsp;&nbsp;</u>, {{$year}}--}}
{{--</p>--}}
<p style="margin-top:0px;padding-top: 0px;">
    Client Signature
</p>
<p class="textRight" style="width: 100%;">
    Thank you,<br>
    Client Support Services<br>
    Patent Services USA, INC.<br>
    12000 Biscayne Blvd., Suite # 700<br>
    North Miami, FL 33181<br>
    1-888-344-6836<br>
    1-800-886-7951 (fax)<br>
    Email: clientservices@ownmyinvention.com
</p>
<p class="pSmall">
    DISCLAIMER:<br>
    This email message is for the sole use of the intended recipient(s) and may contain confidential and
    privileged information. Any unauthorized review, use, disclosure or distribution is prohibited. If you are not
    the intended recipient, please contact the sender by reply email and destroy all copies of the original
    message.
</p>