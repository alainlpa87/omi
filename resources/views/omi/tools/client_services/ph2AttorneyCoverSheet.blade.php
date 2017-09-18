<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="ph2AttorneyCoverSheet">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p class="pLogo">
            <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>
        <p>
            <strong>INVENTOR LEGAL NAME: {{ucwords($client->fname." ".$client->lname)}}</strong>
        </p>
        <p>
            <strong>CO-INVENTOR LEGAL NAME: {{strlen($client->coInventor)>0?ucwords($client->coInventor):"N/A"}}</strong>
        </p>
        <p>
            <strong>INVENTOR ADDRESS: {{$client->street." ".$client->street2.", ".$client->city.", ".$client->state." ".$client->zip}}</strong>
        </p>
        <p>
            <strong>FILE #: {{$client->fileno}}</strong>
        </p>
        <p>
            <strong>EMAIL ADDRESS: {{$client->email}}</strong>
        </p>
        <p>
            <strong>PH #: {{$client->phone}}</strong>
        </p>
        <div class="col-md-4"><input type="checkbox" name="provisional"><strong> Provisional</strong></div>
        <div class="col-md-4"><input type="checkbox" name="utility"><strong> Utility</strong></div>
        <div class="col-md-4"><input type="checkbox" name="design"><strong> Design</strong></div>
        <div class="col-md-4"><input type="checkbox" name="epo"><strong> EPO</strong></div>
        <div class="col-md-4"><input type="checkbox" name="pct"><strong> PCT</strong></div>
        <div class="col-md-4"><input type="checkbox" name="upgrade"><strong> Upgrade</strong></div>
        <div class="col-md-4"><input type="checkbox" name="trademark"><strong> Trademark</strong></div>
        <div class="col-md-4"><input type="checkbox" name="copyright"><strong> Copyright</strong></div>
        <p></p>
        <p  class="col-md-12 pSmall">
            <br><br>INCLUDED:
        </p>
        <div class="col-md-4"><input type="checkbox" name="agreement"><strong> Agreement for Patent Services</strong></div>
        <div class="col-md-8"><input type="checkbox" name="graphic"><strong> Graphic Illustration</strong></div>
        <div class="col-md-4"><input type="checkbox" name="product"><strong> Product Description</strong></div>
        <div class="col-md-8"><input type="checkbox" name="business"><strong> Business Profile, Confidential Submission Form, Drawings, Photos etc.</strong></div>
    </form>
</div>