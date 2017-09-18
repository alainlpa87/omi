<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="trademark_letter">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p class="pLogo">
            <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
            <br><i>Giving the edge to Inventors!</i>
        </p>
        <p align="left" class="pSmall">
            {{date("F j, Y")}}<br><br>
        </p>
        <p class="pSmall">Dear {{ucwords($client->fname." ".$client->lname).","}}</p>
        <p class="pSmall">Please be advised, the United States Patent and Trademark Office has found your Trademark too closely
            descriptive of your actual invention. Therefore, registration for your trademark will be refused.</p>
        <p class="pSmall">If the Trademark merely describes the goods or services, then it is too closely descriptive and will
            be rejected.  For example, trying to trademark "snow shovel" for a snow shovel, or "car jack" for a car jack, will
            not work.  The trademark should NOT give any indication of the goods being offered for sale.  Examples of excellent
            trademarks would be the following: “Apple" for computers or "Nissan" for cars, or "BIC" for ink pens, or "Sharpie"
            for a yellow highlighter. </p>
        <p class="pSmall">
            The Independent Registered Patent Attorney has prepared and submitted preliminary Trademark information and requires
            this additional supporting document.  In order to complete the final phase of your application to the United States
            Patent and Trademark Office, the Registered Patent Attorney is requesting this “time-sensitive” information from you,
            in order to avoid any future filing inconsistencies and to expedite your filing promptly.  The attorney requires this
            completed information returned to us as soon as possible.
        </p>
        <div class="row">
            <div class="col-md-4">
                <p class="pSmall">1. &nbsp;&nbsp;&nbsp;Enter the new mark here: </p>
            </div>
            <div class="col-md-3" style="padding-top: 5px !important;">
                <input type="text" name="mark" class="form-control">
            </div>
        </div>
        <p class="pSmall" style="padding-left: 20px !important;">With our goal and responsibility to providing excellent service to you, we can help better inform and
            guide you.  Our organization will facilitate the work and engaging your independent registered patent attorney to continue
            working to represent you before the USPTO examiner.  Contact our office at your earliest convenience so that we can discuss
            your situation further.  We will continue to keep you apprised of any further actions or events.</p>
        <div>
            <div class="col-md-12 col-xs-12">
                <div class="col-xs-4 sigPad" id="smoothed">
                    <ul class="sigNav">
                        <li class="clearButton" style="display: list-item;"><a href="#clear">Clear</a></li>
                    </ul>
                    <div class="sig sigWrapper current">
                        {{--<div class="typed" style="display: none; font-size: 24.375px;"></div>--}}
                        <canvas class="pad" width="290" height="50"></canvas>
                        <input type="hidden" name="output" class="output">
                    </div>
                    <p class="drawItDesc">Client signature</p>
                </div>
                <div class="col-md-4 col-xs-12 pull-right">
                    <div class='input-group date' id='trademark_letter_date' style="margin-top: 45px;">
                        <input type='text' class="form-control" name="trademark_letter_date" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                    <p class="drawItDesc"  style="display: block;margin-bottom: 20px;">Date</p>
                </div>
            </div>
        </div>
    </form>
    <p style="text-align: right">
        Thank you,<br>
        Client Support Services<br>
        Patent Services USA, INC.<br>
        12000 Biscayne Blvd., Suite # 700<br>
        North Miami, FL 33181<br>
        1-888-344-6836 ext. 237<br>
        1-800-886-7951 (fax)
    </p>
    <p class="pSmall">
        DISCLAIMER:<br>
        This email message is for the sole use of the intended recipient(s) and may contain confidential and
        privileged information. Any unauthorized review, use, disclosure or distribution is prohibited. If you are not
        the intended recipient, please contact the sender by reply email and destroy all copies of the original
        message.
    </p>
</div>