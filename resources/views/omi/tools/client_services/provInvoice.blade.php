<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
        <input type="hidden" name="document" value="provInvoice">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p class="pLogo">
            <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>
        <br>
        <p style="text-align: left;">
            {{date("F j, Y")}}<br><br>
            {{ucwords($client->fname." ".$client->lname)}}<br>
            {{$client->street}}<br>
            {{$client->city.", ".$client->state." ".$client->zip}}<br>
            {{"File No. ".$client->fileno}}
        </p>
        <p class="pSmall">The following represents your payment status for the Patent Protection Agreement executed with our company.</p>
        <div class="col-md-12 col-xs-12" style="border-bottom: 3px solid black;">
            <div class="row">
                <div class="col-md-6 col-xs-12"> <p class="NoMargin pSmall">Amount received by PS: {{"$ ".number_format($amountBy,2)}}</p></div>
                <div class="col-md-6 col-xs-12"> <p class="NoMargin pSmall" >Balance due: {{"$ ".number_format($balanceBy,2)}}</p></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12"><p class="NoMargin pSmall">Date received: {{$dateBy}}</p></div>
                <div class="col-md-6 col-xs-12"><p class="NoMargin pSmall">Percentage paid: {{$percentageBy."%"}}</p></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <p class="NoMargin pSmall">Contract Amount: {{"$ ".number_format($contractBy,2)}}</p>
                </div>
            </div>
        </div>

        <table align="center" width="100%" style="border-bottom: 3px solid;">
            <tr>
                <td>
                    <p class="pSmall">
                        If you have any questions, call our client services department at 1-877-652-4908, ext. 211 for assistance.  We hope to continue our mutual efforts with you.
                    </p>
                </td>
            </tr>
        </table>
        <br>
        <p class="pSmall">
            <input type="checkbox" name="wishNoProv" id="wishNoProv" value="1"> I do wish to file a non-provisional application related to and before expiration of the provisional
            application mentioned above and expressly authorize Patent Services to cause such application to be drafted and filed by an Independent Registered Patent
            Attorney.
        </p>
        <p class="pSmall">
            <input type="checkbox" name="understandLose" id="understandLose" value="1">  Understanding that I will lose the rights established by my current pending provisional application,
            I will not be filing or otherwise pursuing a non-provisional application that corresponds to the provisional application mentioned above.
        </p>

        <div class="col-md-12 col-xs-12">
            <div class="row">
                <div class="col-md-6">
                    <p style="margin-bottom: 0px !important;text-align: left;" class="pSmall">____________________________</p>
                    <p style="margin-top: 0px !important;text-align: left;" class="pSmall">Patent Services, Inc<br>Authorized Representative  </p>
                </div>

                <div class="col-md-offset-2 col-md-4">
                    <div class="col-xs-4 sigPad sign-add-d">
                        <ul class="sigNav">
                            <li class="clearButton" style="display: list-item;"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="sig sigWrapper current">
                            <canvas class="pad" width="290" height="50"></canvas>
                            <input type="hidden" name="output" class="output">
                        </div>
                    </div>
                    <p style="margin-top: 0px !important;text-align: right;" class="pSmall" >(Inventor name), Inventor</p>
                </div>

            </div>
        </div>
        @if($project->coInventor != "")
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-offset-8 col-md-4">
                        <div class="col-xs-4 sigPad sign-add-d">
                            <ul class="sigNav">
                                <li class="clearButton" style="display: list-item;"><a href="#clear">Clear</a></li>
                            </ul>
                            <div class="sig sigWrapper current">
                                <canvas class="pad" width="290" height="50"></canvas>
                                <input type="hidden" name="output2" class="output">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p style="margin-top: 0px !important;text-align: right;" class="pSmall" >(Co-Inventor name), Co-Inventor </p>
        @endif
        <br>
        <p class="verySmall" >Disclaimer: PATENT SERVICES is not a law firm and does not provide legal advice or legal opinion.  PATENT SERVICES shall engage an Independent Registered Patent Attorney and/or Patent Agent to assist in certain matters relating to the services described herein.  </p>
    </form>
</div>