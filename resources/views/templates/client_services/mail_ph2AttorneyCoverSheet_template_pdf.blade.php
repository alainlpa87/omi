<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

    <!--page 1-->
    <p align="center" class="padd_cover">
        <img src="{{ asset('/img/logo.png') }}" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
        <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>

    <br><br>
<table width="96%" style="margin-left:10px;">
    <tr>
        <td><strong>INVENTOR LEGAL NAME: {{ucwords($client->fname." ".$client->lname)}}</strong></td>
        <td> </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><strong>CO-INVENTOR LEGAL NAME: {{strlen($project->coInventor)>0?ucwords($project->coInventor):"N/A"}}</strong></td>
        <td> </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><strong>INVENTOR ADDRESS:  {{$client->street." ".$client->street2.", ".$client->city.", ".$client->state." ".$client->zip}}</strong></td>
        <td> </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><strong>FILE #: {{$client->fileno}}</strong></td>
        <td> </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><strong>EMAIL ADDRESS: {{$client->email}}</strong></td>
        <td> </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><strong>PH #: {{$client->phone}}</strong></td>
        <td> </td>
    </tr>
</table>
<br><br> <br><br>
<table width="96%" style="margin-left:10px;">
    <tr>
        <td><img src="{{ $provisional == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""><strong> Provisional</strong></td>
        <td><img src="{{ $utility == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""><strong> Utility</strong></td>
        <td><img src="{{ $design == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""><strong> Design </strong></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><img src="{{ $epo == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""><strong> EPO</strong></td>
        <td><img src="{{ $pct == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""><strong> PCT</strong></td>
        <td><img src="{{ $upgrade == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""><strong> Upgrade </strong></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><img src="{{ $trademark == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""><strong> Trademark</strong></td>
        <td><img src="{{ $copyright == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png') }}" alt=""><strong> Copyright</strong></td>
        <td>&nbsp;</td>
    </tr>
</table>
<br><br>
<p>INCLUDED: </p>
<br>
<table width="96%" style="margin-left:10px;">
    <tr>
        <td><img src="{{ asset('/img/chk_square.png')}}" alt=""><strong> Agreement for Patent Services</strong></td>
        <td>&nbsp;</td>
        <td><img src="{{asset('/img/chk_square.png')}}" alt=""><strong> Graphic Illustration</strong></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><img src="{{ asset('/img/chk_square.png')}}" alt=""><strong> Product Description</strong></td>
        <td>&nbsp;</td>
        <td><img src="{{ asset('/img/chk_square.png')}}" alt=""><strong> Business Profile, Confidential Submission Form, Drawings, Photos etc. </strong></td>
    </tr>
</table>