<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="applicationCoverPageUtility">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p class="pLogo">
            <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>
        <p>
            Patent Services USA, INC.<br>
            12000 Biscayne Blvd., Suite # 700<br>
            North Miami, FL 33181
        </p>
        <p>Dear {{isset($client->fname)?ucwords($client->fname." ".$client->lname.(strlen($client->coInventor)>0?" & ".$client->coInventor:"")) :""}},</p>
        <br>
        <p>Enclosed you will find the following paperwork:</p>
        <ul>
            <li>Utility application</li>
            <li>Patent drawings</li>
            <li>Power of Attorney</li>
            <li>Declaration</li>
            <li>Micro Entity</li>
        </ul>
        <p>Please note that this application is required to be approved and forms need to be signed before filing it with the USPTO.  Please be advised that the documents only require your signature. Your patent attorney will complete everything else.</p>
        <p>Any questions do not hesitate to contact us.</p>
        <p class="textRight">
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
            Patent Services is not a law firm and does not provide legal advice or legal opinion.  Patent Services shall engage an Independent Registered Patent Attorney and/or Patent Agent to assist in certain matters relating to the services described herein.
        </p>
    </form>
</div>