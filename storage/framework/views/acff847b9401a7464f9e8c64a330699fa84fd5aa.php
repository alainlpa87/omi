<link href="<?php echo e(asset('/css/pdf_client.css')); ?>" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
    <!--page 1-->
    <p align="center" class="padd_cover">
        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
        <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>
    <p class="subTitle" align="center">DUE DILIGENCE REVIEW</p>
    <p>
        It is the policy of PATENT SERVICES USA. to insure all clients that our Invention Initiative Guide
        Consultants and employees are providing accurate information, therefore avoiding confusion or
        misunderstandings.  Please take a moment to review this form and return it to us promptly.  If you
        have any questions about any of the statements listed below, your Invention Initiative Guide
        Consultant will address the issue with you.  Your prompt cooperation in this regard is appreciated.
    </p>
    <ol class="pSmaller">
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
        <li>
            The Inventor acknowledges their consent to this Agreement via Electronic Signature. This agreement and any counterparts to
            this agreement will be deemed an original. To expedite the process of entering into this Agreement, the Inventor acknowledges
            that Electronic Transmissions of the Agreement will be equivalent to original documents. “Electronic Transmission" will mean
            copies that are reproduced or transmitted as complete and accurate reproductions and transmissions of this original.
        </li>
    </ol>
<table align="center" width="98%" style="">
    <tr style="padding: 5px !important;">
        <td>INVENTOR SIGNATURE: </td>
        <td colspan="2">______________________________________________</td>
    </tr>
    <tr style="padding: 5px !important;">
        <td>INVENTOR NAME: </td>
        <td>
            <?php if(isset($fname)): ?>
                <span><?php echo e($fname); ?></span>
            <?php else: ?>
                <span>___________________________</span>
            <?php endif; ?>
        </td>
        <td>DATE: </td>
        <td style="width: 50%;">
            <span>___________________</span>
        </td>
    </tr>
    <tr style="padding: 5px !important;margin-top: 10px;">
        <td style="width: 50%;">FILENO: <?php echo e($client->fileno); ?></td>
        <td style="width: 50%;">Consultant Name: <?php echo e(ucwords($client->consultant->fname." ".$client->consultant->lname)); ?></td>
    </tr>
</table>
<br>
<div class="page-break"></div>
    <!--page 2-->
    <p align="center" class="padd_cover">
        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
        <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>
    <p class="subTitle" align="center">SERVICE QUALITY QUESTIONNAIRE</p>
    <p>Complete this questionnaire. Your responses will be kept completely confidential. Your Invention Initiative
        Guide Consultant(s) will not read this questionnaire.  We appreciate your cooperation.
    </p>
    <p></p>
<table width="96%" style="margin-left:10px;">
    <tr>
        <td><strong style="font-size: 14px !important;">INVENTOR NAME:</strong> <?php echo e(ucwords($client->fname." ".$client->lname)); ?></td>
        <td ><strong style="font-size: 14px !important;">DATE:</strong> _____________________</td>
    </tr>
    <?php if(strlen($project->coInventor)!=0): ?>
        <tr>
            <td width="65%"><strong style="font-size: 14px !important;">CO-INVENTORS NAME:</strong> <?php echo e($project->coInventor); ?></td>
            <td width="35%">&nbsp;</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td><strong style="font-size: 14px !important;">FILE #:</strong> <?php echo e($client->fileno); ?></td>
        <td><strong style="font-size: 14px !important;">INVENTION TITLE:</strong> <?php echo e($project->ideaName); ?></td>
    </tr>
    <tr>
        <td colspan="2"><strong style="font-size: 14px !important;">CONSULTANT(S) Names:</strong> <?php echo e(ucwords($client->consultant->fname." ".$client->consultant->lname)); ?></td>
    </tr>
</table>
<ol class="olQuestions" style="font-size: 12px !important;">
    <li>
        Was our staff courteous at all times?
        <?php if(isset($staffRadio)): ?>
            <img src="<?php echo e($staffRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e($staffRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php else: ?>
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php endif; ?>
        <?php if(isset($staffInput)): ?>
            <span style="text-decoration: underline;"><?php echo e($staffInput); ?></span>
        <?php else: ?>
            <span>__________________________________________________________________</span>
        <?php endif; ?>
    </li>
    <li>
        Were we able to address all of your questions to your satisfaction?
        <?php if(isset($satisfactionRadio)): ?>
            <img src="<?php echo e($satisfactionRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e($satisfactionRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php else: ?>
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php endif; ?>
    </li>
    <li>
        When working with one or more of our Consultants:
        <ol type="A">
            <li>
                Were they helpful?
                <?php if(isset($helpfulRadio)): ?>
                    <img src="<?php echo e($helpfulRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e($helpfulRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php else: ?>
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php endif; ?>
                <?php if(isset($helpfulInput)): ?>
                    <span style="text-decoration: underline;"><?php echo e($helpfulInput); ?></span>
                <?php else: ?>
                    <span>__________________________________________________________________</span>
                <?php endif; ?>
            </li>
            <li>
                Did they answer all of your questions?
                <?php if(isset($questionsRadio)): ?>
                    <img src="<?php echo e($questionsRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e($questionsRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php else: ?>
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php endif; ?>
                <?php if(isset($questionsInput)): ?>
                    <span style="text-decoration: underline;"><?php echo e($questionsInput); ?></span>
                <?php else: ?>
                    <span>__________________________________________________________________</span>
                <?php endif; ?>
            </li>
            <li>
                Did they discuss the risks that are involved and that there are no guarantees of success?<br>
                <?php if(isset($risksRadio)): ?>
                    <img src="<?php echo e($risksRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e($risksRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php else: ?>
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php endif; ?>
                <?php if(isset($risksInput)): ?>
                    <span style="text-decoration: underline;"><?php echo e($risksInput); ?></span>
                <?php else: ?>
                    <span>__________________________________________________________________</span>
                <?php endif; ?>
            </li>
            <li>
                Did they make any guarantees of any kind?
                <?php if(isset($guaranteesRadio)): ?>
                    <img src="<?php echo e($guaranteesRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e($guaranteesRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php else: ?>
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php endif; ?>
                <?php if(isset($guaranteesInput)): ?>
                    <span style="text-decoration: underline;"><?php echo e($guaranteesInput); ?></span>
                <?php else: ?>
                    <span>__________________________________________________________________</span>
                <?php endif; ?>
            </li>
            <li>
                Were they knowledgeable?
                <?php if(isset($knowledgeableRadio)): ?>
                    <img src="<?php echo e($knowledgeableRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e($knowledgeableRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php else: ?>
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php endif; ?>
                <?php if(isset($knowledgeableInput)): ?>
                    <span style="text-decoration: underline;"><?php echo e($knowledgeableInput); ?></span>
                <?php else: ?>
                    <span>__________________________________________________________________</span>
                <?php endif; ?>
            </li>
            <li>
                Did they explain that we are not patent attorneys, and that all work is performed by a registered
                patent attorney?
                <?php if(isset($explainRadio)): ?>
                    <img src="<?php echo e($explainRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e($explainRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php else: ?>
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php endif; ?>
                <?php if(isset($explainInput)): ?>
                    <span style="text-decoration: underline;"><?php echo e($explainInput); ?></span>
                <?php else: ?>
                    <span>__________________________________________________________________</span>
                <?php endif; ?>
            </li>
            <li>
                Did they make any promises or representations to you not contained in our Patent Protection
                Agreements?
                <?php if(isset($promisesRadio)): ?>
                    <img src="<?php echo e($promisesRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e($promisesRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php else: ?>
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php endif; ?>
                <?php if(isset($promisesInput)): ?>
                    <span style="text-decoration: underline;"><?php echo e($promisesInput); ?></span>
                <?php else: ?>
                    <span>__________________________________________________________________</span>
                <?php endif; ?>
            </li>
            <li>
                Did they discuss and explain all costs involved in the programs?
                <?php if(isset($costsRadio)): ?>
                    <img src="<?php echo e($costsRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e($costsRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php else: ?>
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php endif; ?>
            </li>
            <li>
                Are you satisfied with the <strong><u>Invention Initiative Guide</u></strong> on your invention?<br>
                <?php if(isset($iigRadio)): ?>
                    <img src="<?php echo e($iigRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e($iigRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php else: ?>
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
                    <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
                <?php endif; ?>
                <?php if(isset($iigInput)): ?>
                    <span style="text-decoration: underline;"><?php echo e($iigInput); ?></span>
                <?php else: ?>
                    <span>__________________________________________________________________</span>
                <?php endif; ?>
            </li>
        </ol>
    </li>
    <li>
        Is everything clear about our program at this time?
        <?php if(isset($clearRadio)): ?>
            <img src="<?php echo e($clearRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e($clearRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php else: ?>
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php endif; ?>
        <?php if(isset($clearInput)): ?>
            <span style="text-decoration: underline;"><?php echo e($clearInput); ?></span>
        <?php else: ?>
            <span>__________________________________________________________________</span>
        <?php endif; ?>
    </li>
    <li>
        Were all of our documents easy to read and understand?
        <?php if(isset($readRadio)): ?>
            <img src="<?php echo e($readRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e($readRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php else: ?>
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php endif; ?>
        <?php if(isset($readInput)): ?>
            <span style="text-decoration: underline;"><?php echo e($readInput); ?></span>
        <?php else: ?>
            <span>__________________________________________________________________</span>
        <?php endif; ?>
    </li>
    <li>
        How do you find communicating with our company so far?
        <?php if(isset($companyInput)): ?>
            <span style="text-decoration: underline;"><?php echo e($companyInput); ?></span>
        <?php else: ?>
            <span >______________________________________________________________</span>
        <?php endif; ?>
    </li>
    <li>How satisfied are you with our company?
        <?php if(isset($satisfiedInput)): ?>
            <span style="text-decoration: underline;"><?php echo e($satisfiedInput); ?></span>
        <?php else: ?>
            <span >____________________________________________________________________________</span>
        <?php endif; ?>
    </li>
    <li>Did you visit our web-site www.ownmyinvention.com?
        <?php if(isset($webRadio)): ?>
            <img src="<?php echo e($webRadio == 1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e($webRadio == 0 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php else: ?>
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> YES
            <img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""> NO
        <?php endif; ?>
        <?php if(isset($webInput)): ?>
            <span style="text-decoration: underline;"><?php echo e($webInput); ?></span>
        <?php else: ?>
            <span >____________________________________________________</span>
        <?php endif; ?>
        <br><br>
        What was your opinion of the site?
        <?php if(isset($opinionInput)): ?>
            <span style="text-decoration: underline;"><?php echo e($opinionInput); ?></span>
        <?php else: ?>
            <span >__________________________________________________________________________________</span>
        <?php endif; ?>
    </li>
</ol>
<p style="text-align: right;">Initial:
    <?php if(isset($fname)): ?>
        <span style="text-decoration: underline;"><?php echo e(strtoupper($client->fname[0].$client->lname[0])); ?></span>
    <?php endif; ?>
</p>

<div class="page-break"></div>
<!--page 5-->
<p>9. &nbsp;&nbsp;Do you have any general comments or suggestions?</p>
<?php if(isset($commentsInput)): ?>
    <p style="text-decoration: underline;"><?php echo e($commentsInput); ?></p>
<?php else: ?>
    <p>_____________________________________________________________________________________<br>
        _____________________________________________________________________________________<br>
        _____________________________________________________________________________________</p>
<?php endif; ?>
<p>10. &nbsp;&nbsp;Please include a testimonial reflecting your experience working with PATENT SERVICES USA.(optional).</p>
<?php if(isset($testimonialInput)): ?>
    <p style="text-decoration: underline;"><?php echo e($testimonialInput); ?></p>
<?php else: ?>
    <p>_____________________________________________________________________________________<br>
        _____________________________________________________________________________________<br>
        _____________________________________________________________________________________</p>
<?php endif; ?>

<p>
    Thank you for your cooperation in completing this form. Your answers and input will help us to assist you better
    in the future. Please sign your name below and return this to us with all documents required.
</p>
<br>
<br>
<table align="center" width="98%" style="">
    <tr style="padding: 5px !important;">
        <td>INVENTOR SIGNATURE: </td>
        <td style="width: 50%;">___________________________</td>
        <td>DATE: </td>
        <td style="width: 50%;"><span>___________________</span></td>
    </tr>
</table>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<p style="text-align: right;">Initial:
    <?php if(isset($fname)): ?>
        <span style="text-decoration: underline;"><?php echo e(strtoupper($client->fname[0].$client->lname[0])); ?></span>
    <?php endif; ?>
</p>
<div class="page-break"></div>
<!--page 6-->
    <p align="center" class="padd_cover">
        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
        <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>
    <p class="subTitle" align="center">GRAPHIC ILLUSTRATION APPROVAL INSTRUCTIONS</p>
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
    <p>If you have any questions, please contact us at:</p>
    <br>
    <p class="NoMargin textCenter"><strong>PATENT SERVICES USA.</strong></p>
    <p class="NoMargin textCenter"><strong>12000 Biscayne Boulevard Suite 700</strong></p>
    <p class="NoMargin textCenter"><strong>North Miami, Florida 33181</strong></p>
    <p class="NoMargin textCenter"><strong>1-888-344-6836</strong></p>
    <p class="NoMargin textCenter"><strong>1-800-886-7951</strong></p>
    <p class="NoMargin textCenter"><strong>info@ownmyinvention.com</strong></p>
<div class="page-break"></div>
<!--page 7-->
    <p align="center" class="padd_cover">
        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
        <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
    </p>
    <p class="subTitle" align="center">INDEPENDENT LICENSING AGENT INTERNET ACCOUNT</p>
    <p>
        Your invention will be featured on the website of one of our Independent Licensing Affiliates (ILA).
        The Online Showcase will be made available to you within 60 to 90 days after signing the ILA Agreement.  All website content is made available at the sole discretion of the ILA.  You
        will be listed under the following categories:</p>
    <p><strong>MAIN CATEGORY:</strong>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php if(isset($mainCategory)): ?>
            <span style="text-decoration: underline"><?php echo e($mainCategory); ?></span>
        <?php else: ?>
            <span >_________________</span>
        <?php endif; ?>
    </p>
    <p><strong>SUB  CATEGORY:</strong>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php if(isset($subCategory)): ?>
            <span style="text-decoration: underline"><?php echo e($subCategory); ?></span>
        <?php else: ?>
            <span >_________________</span>
        <?php endif; ?>
    </p>
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
<br>
    <p class="NoMargin textCenter" style="font-size: 20px !important;"><strong>We look forward to the launch of your</strong></p>
    <p class="NoMargin textCenter" style="font-size: 20px !important;"><strong>personal website in the</strong></p>
    <p class="NoMargin textCenter" style="font-size: 20px !important;"><strong>near future!</strong></p>