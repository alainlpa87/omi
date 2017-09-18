<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="applicationCoverPagePCT">
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
        <p>Enclosed you will find the following paperwork:</p>
        <ul>
            <li>PCT Application</li>
            <li>PCT Patent drawings</li>
            <li>PCT Request (sign in Box No. X and return)</li>
            <li>Micro Entity (sign above your name and return</li>
            <li>PCT Questionnaires (complete and return)</li>
        </ul>
        <p>Please note that this application is required to be approved before filing it with the PCT Office.</p>
        <p><input type="radio" name="approveRadio" value="1">{{strlen($client->coInventor)>0?"We":"I"}}, {{isset($client->fname)?ucwords($client->fname." ".$client->lname.(strlen($client->coInventor)>0?" & ".$client->coInventor:"")) :""}}, approve the drafted PCT application to be submitted to the United States Patent and Trademark Office.</p>
        <p>
            <input type="radio" name="approveRadio" value="0">{{strlen($client->coInventor)>0?"We":"I"}},  {{isset($client->fname)?ucwords($client->fname." ".$client->lname.(strlen($client->coInventor)>0?" & ".$client->coInventor:"")) :""}}, do not approve the drafted PCT application.
        </p>
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