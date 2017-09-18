<div class="col-md-12  divContract">
    <form method="post" action="<?php echo e(url('launch/clientServices/signed')); ?>" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="copyrightQuestionnaire">
        <input type="hidden" name="project_id" value="<?php echo e($project_id); ?>">
        <p class="pLogo">
            <img src="<?php echo e(asset('/img/contracts/logo.png')); ?>" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>

        <p>
            Dear <?php echo e(isset($client)?ucwords($client->fname)." ".ucwords($client->lname):"Client’s Name"); ?>,
        </p>

        <p>Congratulations on taking the next important step towards the development of your new invention—Full Patent Protection!  This is a tremendous accomplishment that few inventors ever begin.  Your courage and entrepreneurial spirit will carry you forward, step by step, to realizing your dream of becoming an accomplished inventor!</p>
        <p>We have received the Due Diligence materials, allowing us to submit your Patent Services Agreement to the Independent Registered Patent Attorney.  In order to submit your Copyright Application to the United States Patent and Trademark Office, the Independent Registered Patent Attorney, must receive the following requirements.</p>
        <p class="subTitle" align="center"><strong>Copyright Questionnaire</strong></p>
        <p>
            Title of the Work: <input type="text" name="titleInput" class="form-control">
        </p>
        <p>
            Name and address of the Owner:
            <input type="text" name="nameInput" class="form-control" placeholder="Name">
            <input type="text" name="addressInput" class="form-control" placeholder="Address">
        </p>
        <table>
            <tr>
                <td><p>Author's Date of Birth:</p></td>
                <td>
                    <div class='input-group date' id='inventor_birthday' style="margin-left: 65px;">
                        <input type='text' name="dateOfBirthInput" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </td>
            </tr>
        </table>
        <p>
            Author's Nationality: <input type="text" name="nationalityInput" class="form-control">
        </p>
        <p>
            Citizen of: <input type="text" name="citizenInput" class="form-control">
        </p>
        <p>
            Domiciled in: <input type="text" name="domiciledInput" class="form-control">
        </p>
        <p>Briefly categorize (literary works, musical works, dramatic works, choreographic works, graphic/sculptural works, audiovisual works, sound recordings, and architectural works) and describe the material created by the author in which copyright is claimed:</p>
        <textarea name="categoryInput" class="form-control"></textarea>

        <p>Is the Author the Claimant of the copyright?
            <input type="radio" name="claimantRadio" value="1"> YES (Yes, unless ownership has been transferred)
            <input type="radio" name="claimantRadio" value="0"> NO
        </p>

        <p>Identify any pre-existing material in work:</p>
        <textarea name="materialsInput" class="form-control"></textarea>

        <p>Deposit Copy Included?
            <input type="radio" name="copyIncludeRadio" value="1"> YES (A copy of the work typically must be deposited with the U.S. Copyright Office)
            <input type="radio" name="copyIncludeRadio" value="0"> NO
        </p>
    </form>
    <p >
        Complete and return the questionnaire to Patent Services, if you need further assistance, please do not hesitate to
        contact us.  Once again, we wish you continued success and happy inventing!
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
</div>