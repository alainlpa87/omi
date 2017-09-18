<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="pct_questionnaire">
        <input type="hidden" name="project_id" value="{{$project_id}}">
    <p class="subTitle" align="center"><strong>PCT Questionnaire</strong></p>
    <p>
        Title of the Work: <input type="text" class="form-control" name="titleInput">
    </p>
    <p>
        Name and address of the Owner:
        <input type="text" class="form-control" name=nameInput"" placeholder="Name">
        <input type="text" class="form-control" name="addressInput" placeholder="Address">
    </p>
    <p>
        Author's Date of Birth: <input type="text" class="form-control" name="dateOfBirthInput">
    </p>
    <p>
        Author's Nationality: <input type="text" class="form-control" name="nationalityInput">
    </p>
    <p>
        Citizen of: <input type="text" class="form-control" name="citizenInput">
    </p>
    <p>
        Domiciled in: <input type="text" class="form-control" name="domiciledInput">
    </p>
    <p >
        Complete and return the questionnaire to Patent Services, if you need further assistance, please do not hesitate to
        contact us.  Once again, we wish you continued success and happy inventing!
    </p>
    <p class=" pSmall">Best regards,</p>
    <p>
        Client Support Services<br>
        Patent Services USA, INC.<br>
        12000 Biscayne Blvd., Suite # 700<br>
        North Miami, FL 33181<br>
        1-888-344-6836<br>
        1-800-886-7951 (fax)<br>
        Email: clientservices@ownmyinvention.com
    </p>
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
        </form>
</div>