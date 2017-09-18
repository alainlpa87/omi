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
        Congratulations! Your patent application has been filed to the United States Patent and
        Trademark Office by our Registered Patent Attorney and reached the patent pending
        status.  Enclosed you will find a copy of the electronic receipt, acknowledging the filing
        of the application, with application number {{isset($application_number)?$application_number:"14/831,027(Example)"}}.
    </p>
    <p>
        At this point we can begin the process of introducing you to our marketing affiliate
        International Licensing Consultants that will handle the networking and licensing of your
        product. Enclosed you will find the official, International Licensing Consultants
        Negotiations Agreement. After you have reviewed and approved the agreement, please
        initial and sign where indicated on page five (5 or 6) and return the entire original
        agreement, to Patent Services USA, INC. Once this information is received, we will
        forward this to an authorized ILC representative for further development.
    </p>
    <p>
        If your decision is to not proceed with the assistance of ILC, please sign the release letter
        attached. Please note that by signing this documentation, you have agreed to void any
        further support from International Licensing Consultants.
    </p>
    <p>
        If you have any questions don’t hesitate to contact me.
    </p>
<br>
<p>Thank you,</p>
<p>
    Client Support Services<br>
    Patent Services USA, INC.<br>
    12000 Biscayne Blvd., Suite # 700<br>
    North Miami, FL 33181<br>
    1-888-344-6836<br>
    1-800-886-7951 (fax)<br>
    Email: clientservices@ownmyinvention.com
</p>