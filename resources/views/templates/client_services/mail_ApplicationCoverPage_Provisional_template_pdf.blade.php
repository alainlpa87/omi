<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

    <!--page 1-->
    <p align="center" class="padd_cover">
        <img src="{{ asset('/img/logo.png') }}" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
        <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>

    <br><br>
<table width="96%" style="margin-left:10px;">
    <tr>
        <td>Patent Services</td>
        <td> </td>
    </tr>
    <tr>
        <td>12000 Biscayne Blvd Suite # 700</td>
        <td> </td>
    </tr>
    <tr>
        <td>North Miami, FL 33181</td>
        <td> </td>
    </tr>
</table>
<br>
<p>Dear {{isset($fname)?ucwords($fname):""}},</p>
<br>
<p>Enclosed you will find the following paperwork:</p>
<ul>
    <li>Provisional application</li>
    <li>Patent drawings</li>
    <li>Micro Entity</li>
</ul>
<br>
<p><img src="{{ $approved == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> {{strlen($co_inventor)>0?"We":"I"}} {{isset($fname)?ucwords($fname):""}} approve the drafted provisional patent application to be submitted to the United States Patent and Trademark Office.</p>
<p><img src="{{ $approved == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""> {{strlen($co_inventor)>0?"We":"I"}} {{isset($fname)?ucwords($fname):""}} do not approve the drafted provisional patent application.</p>
<p>Any questions do not hesitate to contact us.</p>
<br>
<p>
    Sincerely,<br>
    Client Support Services<br>
    PATENT SERVICES<br>
    12000 Biscayne Blvd., Suite # 700<br>
    North Miami, FL 33181<br>
    1-888-344-6836<br>
    1-800-886-7951 (fax)<br>
</p>
<br><br><br>
<p style="color: #808080;font-size: x-small">Disclaimer: Patent Services is not a law firm and does not provide legal advice or legal opinion.  Patent Services shall engage an Independent Registered Patent Attorney and/or Patent Agent to assist in certain matters relating to the services described herein.  </p>
