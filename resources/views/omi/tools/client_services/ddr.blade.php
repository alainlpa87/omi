<div class="col-md-12  divContract">
    <form method="post" action="{{url('launch/clientServices/signed')}}" name="formSign"  id="formSign" >
        <input type="hidden" name="document" value="ddr">
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <p class="pLogo">
            <img src="{{asset('/img/contracts/logo.png')}}" alt="" name="Patent Services USA" width="165" height="126" id="patentLogo" align="center">
        <br><i>Giving the edge to Inventors!</i>
    </p>
    <p class="subTitle" align="center"><strong>DUE DILIGENCE REVIEW</strong></p>
    <p>
        It is the policy of PATENT SERVICES USA. to insure all clients that our Invention Initiative Guide
        Consultants and employees are providing accurate information, therefore avoiding confusion or
        misunderstandings.  Please take a moment to review this form and return it to us promptly.  If you
        have any questions about any of the statements listed below, your Invention Initiative Guide
        Consultant will address the issue with you.  Your prompt cooperation in this regard is appreciated.
    </p>

    <ol class="olSmaller">
        <li>
            I acknowledge that no profit projections of any kind were made to me by any Consultant(s) or other
            PATENT SERVICES USA.  representatives.
        </li>
        <li>
            I acknowledge that no Consultant(s) or other PATENT SERVICES USA.  representatives have made an
            oral statement or given me an opinion of my invention as to whether it will be a success.
        </li>
        <li>
            I agree that no Consultant(s) or other representatives of PATENT SERVICES USA., have stated that
            PATENT SERVICES USA.  will help subsidize or provide any funding to me or find funding for me.
        </li>
        <li>
            I understand that PATENT SERVICES USA.  does not provide legal advice and that the inventor will be
            referred to an Independent Licensing Affiliate and patent attorney and/or agent who will provide the patent
            services detailed in the Agreement signed with PATENT SERVICES USA.
        </li>
        <li>
            I understand that PATENT SERVICES USA cannot be aware of, or responsible for, the existence of
            similar products or concepts which may already be on the market, or which may be introduced at a later
            time.
        </li>
        <li>
            I understand that no party to these dealings, including PATENT SERVICES USA., the Independent
            Licensing Affiliate, the patent attorney and/or agent, or the United States Patent and Trademark Office
            can promise or guarantee that a patent will be issued.
        </li>
        <li>
            I understand that PATENT SERVICES USA., does not make or manufacture any kinds of prototypes or
            products.
        </li>
        <li>
            I understand that trade show representation are performed by Independent Licensing Affiliates (ILA)
            affiliated with PATENT SERVICES USA., and that any ILA representatives attending a tradeshow on my
            behalf is trying to establish contacts of companies who may have “potential” interest in reviewing my
            invention in the near future.  I further understand that specifics of my invention will be displayed or
            discussed at a trade show at the sole discretion of the ILA and it’s authorized licensing representatives.
        </li>
        <li>
            I understand that there are no guarantees of success and that new product development and invention
            promotion involve risk.  I further agree that no Invention Initiative Guide Consultant(s) or employee of
            PATENT SERVICES USA., has stated anything that would contradict this risk statement or lead me to  believe otherwise.
        </li>
        <li>
            I agree that no Invention Initiative Guide Consultant(s) or employee of PATENT SERVICES USA., has
            stated or implied that I must obtain patent protection immediately or I will lose my potential patent rights or
            miss my opportunity for profit.
        </li>
        <li>
            I acknowledge that PATENT SERVICES USA. is not an invention marketing, promotion or development company.
        </li>
        <li>
            I understand the time frames that PATENT SERVICES USA., outlined on the Patent Protection Agreement to ultimately obtain my patent(s).
        </li>
        <li>
            I believe that no oral statements made to me by my Invention Initiative Guide Consultant(s) are in
            contradiction to the written Patent Protection Agreement I signed with PATENT SERVICES USA.
        </li>
    </ol>
    <br><br>
    <p class="subTitle" align="center"><strong>SERVICE QUALITY QUESTIONNAIRE</strong></p>
    <p>Complete this questionnaire. Your responses will be kept completely confidential. Your Invention Initiative
        Guide Consultant(s) will not read this questionnaire.  We appreciate your cooperation.
    </p>
        <ol class="olQuestions">
            <li>
                Was our staff courteous at all times?
                <input type="radio" name="staffRadio" value="1"> YES
                <input type="radio" name="staffRadio" value="0"> NO
                <input type="text" name="staffInput" class="form-control"  maxlength="75">
            </li>
            <li>
                Were we able to address all of your questions to your satisfaction?
                <input type="radio" name="satisfactionRadio" value="1"> YES
                <input type="radio" name="satisfactionRadio" value="0"> NO
            </li>
            <li>
                When working with one or more of our Consultants:
                <ol type="A">
                    <li>
                        Were they helpful?
                        <input type="radio" name="helpfulRadio" value="1"> YES
                        <input type="radio" name="helpfulRadio" value="0"> NO
                        <input type="text" name="helpfulInput" class="form-control"  maxlength="75">
                    </li>
                    <li>
                        Did they answer all of your questions?
                        <input type="radio" name="questionsRadio" value="1"> YES
                        <input type="radio" name="questionsRadio" value="0"> NO
                        <input type="text" name="questionsInput" class="form-control"  maxlength="75">
                    </li>
                    <li>
                        Did they discuss the risks that are involved and that there are no guarantees of success?<br>
                        <input type="radio" name="risksRadio" value="1"> YES
                        <input type="radio" name="risksRadio" value="0"> NO
                        <input type="text" name="risksInput" class="form-control" maxlength="75">
                    </li>
                    <li>
                        Did they make any guarantees of any kind?
                        <input type="radio" name="guaranteesRadio" value="1"> YES
                        <input type="radio" name="guaranteesRadio" value="0"> NO
                        <input type="text" name="guaranteesInput" class="form-control" maxlength="75">
                    </li>
                    <li
                            >Were they knowledgeable?
                        <input type="radio" name="knowledgeableRadio" value="1"> YES
                        <input type="radio" name="knowledgeableRadio" value="0"> NO
                        <input type="text" name="knowledgeableInput" class="form-control" maxlength="75">
                    </li>
                    <li>
                        Did they explain that we are not patent attorneys, and that all work is performed by a registered
                        patent attorney?
                        <input type="radio" name="explainRadio" value="1"> YES
                        <input type="radio" name="explainRadio" value="0"> NO
                        <input type="text" name="explainInput" class="form-control" maxlength="75">
                    </li>
                    <li>
                        Did they make any promises or representations to you not contained in our Patent Protection
                        Agreements?
                        <input type="radio" name="promisesRadio" value="1"> YES
                        <input type="radio" name="promisesRadio" value="0"> NO
                        <input type="text" name="promisesInput" class="form-control" maxlength="75">
                    </li>
                    <li>
                        Did they discuss and explain all costs involved in the programs?
                        <input type="radio" name="costsRadio" value="1"> YES
                        <input type="radio" name="costsRadio" value="0"> NO
                    </li>
                    <li>
                        Are you satisfied with the <strong><u>Invention Initiative Guide</u></strong> on your invention?<br>
                        <input type="radio" name="iigRadio" value="1"> YES
                        <input type="radio" name="iigRadio" value="0"> NO
                        <input type="text" name="iigInput" class="form-control" maxlength="75">
                    </li>
                </ol>
            </li>
            <li>
                Is everything clear about our program at this time?
                 <input type="radio" name="clearRadio" value="1"> YES
                 <input type="radio" name="clearRadio" value="0"> NO
                <input type="text" name="clearInput" class="form-control" maxlength="75">
            </li>
            <li>
                Were all of our documents easy to read and understand?
                <input type="radio" name="readRadio" value="1"> YES
                <input type="radio" name="readRadio" value="0"> NO
                <input type="text" name="readInput" class="form-control" maxlength="75">
            </li>
            <li>How do you find communicating with our company so far?
                <input type="text" name="companyInput" class="form-control" maxlength="75"></li>
            <li>How satisfied are you with our company?
                <input type="text" name="satisfiedInput" class="form-control" maxlength="75"></li>
            <li>Did you visit our web-site www.ownmyinvention.com?
                <input type="radio" name="webRadio" value="1"> YES
                <input type="radio" name="webRadio" value="0"> NO
                <input type="text" name="webInput" class="form-control" maxlength="75">
                What was your opinion of the site?
                <input type="text" name="opinionInput" class="form-control" maxlength="75">
            </li>
            <li>
               Do you have any general comments or suggestions?
                <textarea name="commentsInput" class="form-control" maxlength="300"></textarea>
            </li>
            <li>
                Please include a testimonial reflecting your experience working with PATENT SERVICES USA.(optional)
                <textarea name="testimonialInput" class="form-control"  maxlength="300"></textarea>
            </li>
        </ol>
       <br><br>
        <p class="subTitle" align="center"><strong>GRAPHIC ILLUSTRATION APPROVAL INSTRUCTIONS</strong></p>
        <p>
            As mentioned in the cover letter, a copy of your approved artwork is required. It serves as the official
            approval of your patent art to be submitted to the United States Patent and Trademark Office
            (USPTO).
        </p>
        <p>
            <strong>
                From the Invention Initiative Guide prepared by PATENT SERVICES USA., make a clear
                photocopy of the artwork page with your modifications.  You may already have two (2)
                drawings and may return one of them with modifications.  Review the artwork carefully, then
                sign and date the bottom of the artwork page and mail it back to PATENT SERVICES USA.,
                within 15 days.  PATENT SERVICES USA., cannot proceed with your project without the
                approved artwork form.
            </strong>
        </p>
        <p>
            The artwork was prepared by a graphic illustrator using the information you originally provided
            PATENT SERVICES USA., along with our Invention Initiative Guide Consultant’s observations and
            the results of your Invention Initiative Guide.  The graphic illustration was prepared in accordance with
            the requirements established by the USPTO as first artwork submission for the patent process. The
            graphic illustration is not designed to highlight the needs and benefits of your project, only to meet
            USPTO requirements.
        </p>
        <p>
            Please be sure to treat your artwork as confidential material and keep the original in a safe location.
        </p>
        <br><br>
        <p class="subTitle" align="center"><strong>INDEPENDENT LICENSING AGENT INTERNET ACCOUNT</strong></p>
        <p>
            Your invention will be featured on the website of one of our Independent Licensing Affiliates (ILA).
            The Online Showcase will be made available to you within 60 to 90 days after signing the Patent
            Protection Agreement.  All website content is made available at the sole discretion of the ILA.  You
            will be listed under the following categories:</p>
        <p><strong>MAIN CATEGORY:</strong><input type="text" name="mainCategory" class="form-control" maxlength="75"></p>
        <p><strong>SUB  CATEGORY:</strong><input type="text" name="subCategory" class="form-control" maxlength="75"></p>
        <p>
            Your Online Showcase gives you, as well as, any interested party, global access to a brief overview
            of your invention.
        </p>
        <p>
            Instructions to view your Online Showcase will be forwarded to you within 60 to 90 days after the
            execution of your Patent Protection Agreement.</p>
        <p>
            Your Online Showcase allows any interested parties to view prevalent information on your invention,
            giving you a GLOBAL market presence!  You should direct all interested parties to view your web
            page once it is made available to you from the ILA, via secured username and password.
        </p>
        <p>
            <span style="text-decoration: underline;">SPECIAL NOTE</span>: All websites made available through our Independent Licensing Affiliates undergo
            periodic changes that benefit and enhance the overall presentation of your new invention.  All
            changes are transparent to visitors and will not affect you or any interested companies from viewing
            your invention.  Over the next several months, there may be many new features added to these
            websites that provide you and all visitors an opportunity to better experience your project.  From time
            to time, you will see new buttons and links on your personal homepage.  They may or may not be
            functional at the time you see them.  You will be updated on any new features and how they benefit
            you.
        </p>
        <p>
            Thank you for your cooperation in completing this form. Your answers and input will help us to assist you better
            in the future. Please sign your name below and return this to us with all documents required.
        </p>
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
                    <p class="drawItDesc">Draw your signature</p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <input type="text" id="inventor_name" name="inventor_name" style="margin-top: 45px;" class="form-control inputTableSign" placeholder="Inventor Full Name">
                    <p class="drawItDesc" style="display: block;margin-bottom: 20px;">Please Print Your Name</p>
                </div>
                {{--<div class="col-md-4 col-xs-12">--}}
                    {{--<div class='input-group date' id='inventor_date' style="margin-top: 45px;">--}}
                        {{--<input type='text' class="form-control" name="inventor_date" />--}}
                    {{--<span class="input-group-addon">--}}
                        {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                    {{--</span>--}}
                    {{--</div>--}}
                    {{--<p class="drawItDesc"  style="display: block;margin-bottom: 20px;">Date</p>--}}
                {{--</div>--}}
            </div>
        </div>
    </form>
    <p style="text-align: right">
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
        This email message is for the sole use of the intended recipient(s) and may contain confidential and
        privileged information. Any unauthorized review, use, disclosure or distribution is prohibited. If you are not
        the intended recipient, please contact the sender by reply email and destroy all copies of the original
        message.
    </p>
</div>