<link href="<?php echo e(asset('/css/pdf.css')); ?>" rel="stylesheet">

<p class="iconMargin">
    <img src="<?php echo e(asset('/img/contracts/logo.png')); ?>" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<table class="totalTable">
    <tr>
        <td>
            <?php echo e($project->lead->fname." ".$project->lead->lname); ?>

        </td>
        <td></td>
        <td></td>
        <td style="text-align: right !important;">
            <?php echo e(date("F d, Y")); ?>

        </td>
    </tr>
    <tr><td colspan="4"><?php echo e($project->lead->street); ?></td></tr>
    <tr><td colspan="4"><?php echo strlen($project->lead->street2)>0?$project->lead->street2:""; ?></td></tr>
    <tr><td colspan="4"><?php echo e($project->lead->city.", ".$project->lead->state." ".$project->lead->zip); ?></td></tr>
</table>
<br>
<p>
    Dear <?php echo e($project->lead->fname); ?>,
</p>
<p>
    We're working hard to find ways for inventors to commercialize their new products quickly before their market opportunity passes.<strong> As a result,
    we are pleased to provide you with a new service offering to help you launch your product concept to manufacturers.</strong>
</p>
<p >
    Establishing the proper foundation for your invention idea remains essential to making your case for selling or licensing your product concept
    to manufacturers. In order to build a strong, credible case, your invention idea requires thoughtful preparation and independent analysis supporting
    it. We're pleased to introduce our new <strong>Inventor's Marketing Guide</strong>, streamlined to focus on the elements critical to communicating the benefits of your
    new product innovations to manufacturers.
</p>
<p>
    We've prepared a scope of work identifying the project elements that will be developed for your product concept and delivered to you in your
    <strong>Inventor's Marketing Guide</strong>. This guide is designed to present and communicate your invention idea in a clear and concise manner, giving you
    the tools you need to move toward your goal of successfully documenting, protecting and licensing your new product!  Your guide will detail
    five (5) critical facets of your invention idea that are crucial to the foundation of your product:
</p>
<ol>
    <li>Detailed Product Description</li>
    <li>Product Risk Assessment and Disclosure</li>
    <li>Independent Product Marketability Analysis</li>
    <li>Product Illustrations</li>
    <li>Allied Guidance and Education Tools</li>
</ol>
<p>
    All of your product research will be prepared through independent, contracted professionals to ensure that your invention receives an unbiased analysis.
    Once you receive your <strong>Inventor's Marketing Guide</strong>, you'll be empowered to make informed decisions about the business opportunity that your invention idea
    represents. If your product receives a favorable independent marketing assessment, we can continue working with you to establish provisional patent protection.
    Once we've assisted you in protecting your intellectual property, then our licensing affiliate can assist you in the marketing and licensing of your invention
    to manufacturers. Working for you exclusively on a contingency fee basis, the licensing affiliate provides tradeshow representation, website marketing, color
    brochures, press releases and more at no out of pocket expense to you!
</p>
<p>
    We invite you to contact Patent Services today to review your proposal! Of course, you've had additional time to think about your product idea, so we're asking
    some additional questions to ensure that we have the most up to date information on your concept. After printing, reviewing, signing, and dating the accompanying
    documents, please do make a copies for your own records. You may then return the original documents to us. Your investment may be made by check or money order or
    by completing the attached Credit Card Authorization form. If you wish, you may fax the completed documents and credit card authorization form to us at: <strong>800-886-7951</strong>
    or mail it to 12000 Biscayne Blvd Suite 700 North Miami, FL 33181.    </p>
<p>
    We are committed to delivering excellence and value to clients seeking professional patenting services. And we appreciate the opportunity to work with you now on
    your project!
</p>
<p>
    <br>Sincerely,<br><br>
    Client Services<br>
    Patent Services USA
</p>
<br>

<div class="page-break"></div>

<p class="iconMargin">
    <img src="<?php echo e(asset('/img/contracts/logo.png')); ?>" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<table align="center"  width="100%">
    <tr>
        <td><strong>Client Name:</strong></td>
        <td><?php echo e($project->lead->fname." ".$project->lead->lname); ?></td>
        <td><strong>Invention Name:</strong></td>
        <td><?php echo e($project->ideaName); ?></td>
    </tr>
    <?php if(strlen($project->coInventor)==0): ?>
        <tr>
            <td><strong>Address:</strong></td>
            <td><?php echo e($project->lead->street."".$project->lead->street2); ?></td>
            <td><strong>Consultant:</strong></td>
            <td><?php echo e(ucwords($project->consultant->fname." ".$project->consultant->lname)); ?></td>
        </tr>
        <tr>
            <td><strong>City/State:</strong></td>
            <td><?php echo e($project->lead->city.", ".$project->lead->state); ?></td>
            <td><strong>Date:</strong></td>
            <td><?php echo e(date("F j, Y")); ?></td>
        </tr>
        <tr>
            <td><strong>Zip:</strong></td>
            <td><?php echo e($project->lead->zip); ?></td>
            <td><strong>File:</strong></td>
            <td><?php echo e($project->lead->fileno); ?> - <?php echo e($project->id); ?></td>
        </tr>
    <?php else: ?>
        <tr>
            <td><strong>Co-inventor:</strong></td>
            <td><?php echo e($project->coInventor); ?></td>
            <td><strong>Consultant:</strong></td>
            <td><?php echo e(ucwords($project->consultant->fname." ".$project->consultant->lname)); ?></td>
        </tr>
        <tr>
            <td><strong>Address:</strong></td>
            <td><?php echo e($project->lead->street." ".$project->lead->street2); ?></td>
            <td><strong>Date:</strong></td>
            <td><?php echo e(date("F j, Y")); ?></td>
        </tr>
        <tr>
            <td><strong>City/State:</strong></td>
            <td><?php echo e($project->lead->city.", ".$project->lead->state); ?></td>
            <td><strong>File:</strong></td>
            <td><?php echo e($project->lead->fileno); ?> - <?php echo e($project->id); ?></td>
        </tr>
        <tr>
            <td><strong>Zip:</strong></td>
            <td><?php echo e($project->lead->zip); ?></td>
        </tr>
    <?php endif; ?>
</table>
<br>
<h3><strong>Inventor's Marketing Guide Proposal</strong></h3>
<ul class="ul14">
    <li>Detailed Product Description</li>
    <li>
        <b>Private or University Based Marketing Analysis</b>
        <ul class="chk_square">
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Social Factors</li>
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Business Risk Factors</li>
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Demand Analysis Factors</li>
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Market Acceptance Factors</li>
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Competitive Factors</li>
        </ul>
    </li>
    <li>Preliminary Invention Illustration</li>
    <li>Conclusion and Recommendation</li>
</ul>
<p class="priceLeft">
    <strong>Total Price: $<?php print(number_format($price,2,'.',',')); ?></strong>
    <span class="red"> Offer valid for 48 Hours.</span>
</p>
<table cellspacing="10" class="rect totalTable">
    <tr>
        <td colspan="4" style="padding-bottom:25px;">
            <strong> Client Authorization:</strong><br><br>
            <strong>By signing below, I agree to all terms and conditions outlined in this Inventor's Marketing Guide Proposal</strong>
        </td>
    </tr>
    <tr>
        <td class="signInputs">Inventor</td>
        <td class="signInputs">Date</td>
        <td class="signInputs"> Co-Inventor</td>
        <td class="signInputs">Date</td>
    </tr>
</table>
<br>
<p class="priceLeft">
    <strong>Authorized PATENT SERVICES USA Representative:</strong> Rick Blake
</p>
<p class="shadow">
    12000 Biscayne Boulevard, Suite 700 / North Miami, FL 33181 Phone: 1-877-652-4908 / Fax: 1-800-886-7951
</p>

<div class="page-break"></div>

<table cellspacing="7" align="center" class="rect">
    <tr>
        <td colspan="3" align="center" style="font-size:16px;text-align: center !important;">Payment Authorization</td>
    </tr>
    <tr>
        <td colspan="3"><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""> I am enclosing my check / money order in the amount of $ ______________________</td>
    </tr>
    <tr>
        <td><img src="<?php echo e(asset('/img/chk_square.png')); ?>"> Visa / MasterCard</td>
        <td><img src="<?php echo e(asset('/img/chk_square.png')); ?>"> American Express</td>
        <td><img src="<?php echo e(asset('/img/chk_square.png')); ?>"> Discover</td>
    </tr>
    <tr>
        <td>Credit Card Number: ___________________________</td>
        <td>Expiration Date: _____________</td>
        <td> Amount $ _______________</td>
    </tr>
    <tr>
        <td> Name as Appears on Card: ___________________________</td>
        <td colspan="2"> Billing Address (if different): ____________________________________</td>
    </tr>
    <tr>
        <td>Card Holder Signature: ___________________________</td>
        <td colspan="2">Authorized Signature (Inventor): _________________________________</td>
    </tr>
</table>
<h3><strong>Legal Disclosure and Information</strong></h3>
<p class="pSmaller">
    This proposal is made between PATENT SERVICES USA and all Inventors named here with in order to execute this Inventor's Marketing Guide
    Proposal (the agreement) for the Inventor's Marketing Guide outlined on the reverse side of this page.
</p>
<p class="pSmaller">
    This agreement does not execute a patent application, does not provide patent protection of any kind and does not substitute for the legal
    advice of a registered patent attorney.  Inventors acknowledge that PATENT SERVICES USA will deliver the services outlined in this agreement
    within a three (3) to five (5) week timeframe which constitutes a reasonable amount of time due to work scheduling of professionals, draftsmen,
    production personnel and other factors beyond any control of PATENT SERVICES USA.
</p>
<p class="pSmaller">
    New invention innovation and / or product innovation involves a high degree of risk.  Inventor agrees that a patent is the most secure form of legal
    protection for a new invention.  Only a small percentage of inventions become commercially successful. PATENT SERVICES USA does not make any promises,
    claims or guarantees that an invention will ever make a profit, have commercial success, any positive results or result in any kind of financial gain.
</p>
<p class="pSmaller">
    The Inventor's Marketing Guide contains a Market Analysis which may result in a negative outcome.  All inventors / clients have a seven (7) calendar day right
    of rescission from the signature date of the agreement to cancel for a refund.  The cancellation request must be received at our corporate headquarters located
    at 12000 Biscayne Boulevard, Suite 700 North Miami, FL 33181, via certified mail only.  Due to work scheduling of professionals, draftsmen, production personnel
    and other factors beyond any control, PATENT SERVICES USA, reserves the first right to refuse all refund requests if the market analysis occurs after the seven
    (7) calendar day rescission period stated above.
</p>
<p class="pSmaller">
    This Inventor's Marketing Guide represents the entire agreement between all parties, whether written, verbal, expressed or implied.  Any and all other agreements
    or suggestions are void.  This agreement shall not be modified without the expressed written approval of PATENT SERVICES USA and at least one authorized officer
    or representative. This agreement is not a release of any material submitted to PATENT SERVICES USA without the expressed written consent of the inventor.
</p>
<p class="pSmaller">
    The Inventor shall not, nor shall it attempt to circumvent or bypass the activities of PATENT SERVICES USA by negotiating directly or indirectly with any prospective
    patent assistance service providers without the express written permission of the PATENT SERVICES USA Any attempt by the INVENTOR to circumvent or bypass the activities
    of the PATENT SERVICES USA shall by construed as a material breach in violation of this Section and shall trigger the termination of this Agreement without any recourse
    whatsoever by INVENTOR.
</p>
<p class="pSmaller">
    The Inventor acknowledges PATENT SERVICES USA does not engage in the business of invention development or marketing services.  No inventors have received a net financial
    profit as a result of PATENT SERVICES USA.  No inventors have contracted with PATENT SERVICES USA for invention promotion services during the past five (5) years.  PATENT
    SERVICES USA does not perform market evaluations or give opinions of marketing potential on any invention submitted for review.  PATENT SERVICES USA has no customers that
    purchase marketing promotion services.  No inventors have received licensing agreements for their inventions as a direct result of any invention promotion services through
    PATENT SERVICES USA.  In the past 10 years, the officers of PATENT SERVICES USA, either individually or collectively, assisted Global Licensing Partners in its efforts to
    research inventions.  PATENT SERVICES USA only provides patent assistance services and informational materials related to the invention industry.
</p>
<p class="pSmaller">
    All disputes concerning the understanding, meaning or interpretation of any and all parts of this agreement, including the rights, duties, relationships or obligations
    of either party under this agreement shall be settled through the American Arbitration Association (AAA), in the county of Miami-Dade, State of Florida, in accordance with
    all rules and regulations.  All claims must be made within three (3) months of occurrence.  Inventors agree to indemnify and hold harmless PATENT SERVICES USA and its affiliates,
    employees, contractors, successors and assigns, including, all Registered Patent Attorneys from any and all claims which might be raised by any third party for any reason relating
    to the invention or the services provided by PATENT SERVICES USA., including, but not limited to, any claim of infringement of intellectual property (copyright, trademark and patent)
    relating to the inventions as a result of the use contemplated herein of the inventions, in any form submitted by Inventor to PATENT SERVICES USA.
</p>
<p class="pSmaller">
    All information contained in this and all other documents are proprietary and the exclusive property of PATENT SERVICES USA., which reserves all rights.  All proprietary information
    and property is protected by Trademark and Copyright.
</p>
<div class="page-break"></div>

<p class="iconMargin">
    <img src="<?php echo e(asset('/img/contracts/logo.png')); ?>" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<table align="center"  width="100%">
    <tr>
        <td><strong>Client Name:</strong></td>
        <td><?php echo e($project->lead->fname." ".$project->lead->lname); ?></td>
        <td><strong>Invention Name:</strong></td>
        <td><?php echo e($project->ideaName); ?></td>
    </tr>
    <?php if(strlen($project->coInventor)==0): ?>
        <tr>
            <td><strong>Address:</strong></td>
            <td><?php echo e($project->lead->street."".$project->lead->street2); ?></td>
            <td><strong>Consultant:</strong></td>
            <td><?php echo e(ucwords($project->consultant->fname." ".$project->consultant->lname)); ?></td>
        </tr>
        <tr>
            <td><strong>City/State:</strong></td>
            <td><?php echo e($project->lead->city.", ".$project->lead->state); ?></td>
            <td><strong>Date:</strong></td>
            <td><?php echo e(date("F j, Y")); ?></td>
        </tr>
        <tr>
            <td><strong>Zip:</strong></td>
            <td><?php echo e($project->lead->zip); ?></td>
            <td><strong>File:</strong></td>
            <td><?php echo e($project->lead->fileno); ?></td>
        </tr>
    <?php else: ?>
        <tr>
            <td><strong>Co-inventor:</strong></td>
            <td><?php echo e($project->coInventor); ?></td>
            <td><strong>Consultant:</strong></td>
            <td><?php echo e(ucwords($project->consultant->fname." ".$project->consultant->lname)); ?></td>
        </tr>
        <tr>
            <td><strong>Address:</strong></td>
            <td><?php echo e($project->lead->street." ".$project->lead->street2); ?></td>
            <td><strong>Date:</strong></td>
            <td><?php echo e(date("F j, Y")); ?></td>
        </tr>
        <tr>
            <td><strong>City/State:</strong></td>
            <td><?php echo e($project->lead->city.", ".$project->lead->state); ?></td>
            <td><strong>File:</strong></td>
            <td><?php echo e($project->lead->fileno); ?></td>
        </tr>
        <tr>
            <td><strong>Zip:</strong></td>
            <td><?php echo e($project->lead->zip); ?></td>
        </tr>
    <?php endif; ?>
</table>
<br>
<h3><strong>Inventor's Marketing Guide Proposal</strong></h3>
<ul class="ul14">
    <li>Detailed Product Description</li>
    <li>
        <b>Private or University Based Marketing Analysis</b>
        <ul class="chk_square">
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Social Factors</li>
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Business Risk Factors</li>
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Demand Analysis Factors</li>
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Market Acceptance Factors</li>
            <li><img src="<?php echo e(asset('/img/contracts/check.jpg')); ?>">Competitive Factors</li>
        </ul>
    </li>
    <li>Preliminary Invention Illustration</li>
    <li>Conclusion and Recommendation</li>
</ul>
<p class="priceLeft">
    <strong>Total Price: $<?php print(number_format($price,2,'.',',')); ?></strong>
    <span class="red"> Offer valid for 48 Hours.</span>
</p>
<table cellspacing="10" class="rect totalTable">
    <tr>
        <td colspan="4" style="padding-bottom:25px;">
            <strong> Client Authorization:</strong><br><br>
            <strong>By signing below, I agree to all terms and conditions outlined in this Inventor's Marketing Guide Proposal</strong>
        </td>
    </tr>
    <tr>
        <td class="signInputs">Inventor</td>
        <td class="signInputs">Date</td>
        <td class="signInputs"> Co-Inventor</td>
        <td class="signInputs">Date</td>
    </tr>
</table>
<br>
<p class="priceLeft">
    <strong>Authorized PATENT SERVICES USA Representative:</strong> Rick Blake
</p>
<p class="shadow">
    12000 Biscayne Boulevard, Suite 700 / North Miami, FL 33181 Phone: 1-877-652-4908 / Fax: 1-800-886-7951
</p>

<div class="page-break"></div>

<table cellspacing="10" align="center" class="rect">
    <tr>
        <td colspan="3" align="center" style="font-size:16px;text-align: center !important;">Payment Authorization</td>
    </tr>
    <tr>
        <td colspan="3"><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""> I am enclosing my check / money order in the amount of $ ______________________</td>
    </tr>
    <tr>
        <td width="39%"><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""> Visa / MasterCard</td>
        <td width="32%"><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""> American Express</td>
        <td width="29%"><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""> Discover</td>
    </tr>
    <tr>
        <td>Credit Card Number: ___________________________</td>
        <td>Expiration Date: _____________</td>
        <td> Amount $ _____________</td>
    </tr>
    <tr>
        <td> Name as Appears on Card: ___________________________</td>
        <td colspan="2"> Billing Address (if different): ____________________________________</td>
    </tr>
    <tr>
        <td>Card Holder Signature: ___________________________</td>
        <td colspan="2">Authorized Signature (Inventor): _________________________________</td>
    </tr>
</table>
<h3><strong>Legal Disclosure and Information</strong></h3>
<p class="pSmaller">
    This proposal is made between PATENT SERVICES USA and all Inventors named here with in order to execute this Inventor's Marketing Guide
    Proposal (the agreement) for the Inventor's Marketing Guide outlined on the reverse side of this page.
</p>
<p class="pSmaller">
    This agreement does not execute a patent application, does not provide patent protection of any kind and does not substitute for the legal
    advice of a registered patent attorney.  Inventors acknowledge that PATENT SERVICES USA will deliver the services outlined in this agreement
    within a three (3) to five (5) week timeframe which constitutes a reasonable amount of time due to work scheduling of professionals, draftsmen,
    production personnel and other factors beyond any control of PATENT SERVICES USA.
</p>
<p class="pSmaller">
    New invention innovation and / or product innovation involves a high degree of risk.  Inventor agrees that a patent is the most secure form of legal
    protection for a new invention.  Only a small percentage of inventions become commercially successful. PATENT SERVICES USA does not make any promises,
    claims or guarantees that an invention will ever make a profit, have commercial success, any positive results or result in any kind of financial gain.
</p>
<p class="pSmaller">
    The Inventor's Marketing Guide contains a Market Analysis which may result in a negative outcome.  All inventors / clients have a seven (7) calendar day right
    of rescission from the signature date of the agreement to cancel for a refund.  The cancellation request must be received at our corporate headquarters located
    at 12000 Biscayne Boulevard, Suite 700 North Miami, FL 33181, via certified mail only.  Due to work scheduling of professionals, draftsmen, production personnel
    and other factors beyond any control, PATENT SERVICES USA, reserves the first right to refuse all refund requests if the market analysis occurs after the seven
    (7) calendar day rescission period stated above.
</p>
<p class="pSmaller">
    This Inventor's Marketing Guide represents the entire agreement between all parties, whether written, verbal, expressed or implied.  Any and all other agreements
    or suggestions are void.  This agreement shall not be modified without the expressed written approval of PATENT SERVICES USA and at least one authorized officer
    or representative. This agreement is not a release of any material submitted to PATENT SERVICES USA without the expressed written consent of the inventor.
</p>
<p class="pSmaller">
    The Inventor shall not, nor shall it attempt to circumvent or bypass the activities of PATENT SERVICES USA by negotiating directly or indirectly with any prospective
    patent assistance service providers without the express written permission of the PATENT SERVICES USA Any attempt by the INVENTOR to circumvent or bypass the activities
    of the PATENT SERVICES USA shall by construed as a material breach in violation of this Section and shall trigger the termination of this Agreement without any recourse
    whatsoever by INVENTOR.
</p>
<p class="pSmaller">
    The Inventor acknowledges PATENT SERVICES USA does not engage in the business of invention development or marketing services.  No inventors have received a net financial
    profit as a result of PATENT SERVICES USA.  No inventors have contracted with PATENT SERVICES USA for invention promotion services during the past five (5) years.  PATENT
    SERVICES USA does not perform market evaluations or give opinions of marketing potential on any invention submitted for review.  PATENT SERVICES USA has no customers that
    purchase marketing promotion services.  No inventors have received licensing agreements for their inventions as a direct result of any invention promotion services through
    PATENT SERVICES USA.  In the past 10 years, the officers of PATENT SERVICES USA, either individually or collectively, assisted global licensing partners in its efforts to
    research inventions.  PATENT SERVICES USA only provides patent assistance services and informational materials related to the invention industry.
</p>
<p class="pSmaller">
    All disputes concerning the understanding, meaning or interpretation of any and all parts of this agreement, including the rights, duties, relationships or obligations
    of either party under this agreement shall be settled through the American Arbitration Association (AAA), in the county of Miami-Dade, State of Florida, in accordance with
    all rules and regulations.  All claims must be made within three (3) months of occurrence.  Inventors agree to indemnify and hold harmless PATENT SERVICES USA and its affiliates,
    employees, contractors, successors and assigns, including, all Registered Patent Attorneys from any and all claims which might be raised by any third party for any reason relating
    to the invention or the services provided by PATENT SERVICES USA., including, but not limited to, any claim of infringement of intellectual property (copyright, trademark and patent)
    relating to the inventions as a result of the use contemplated herein of the inventions, in any form submitted by Inventor to PATENT SERVICES USA.
</p>
<p class="pSmaller">
    All information contained in this and all other documents are proprietary and the exclusive property of PATENT SERVICES USA., which reserves all rights.  All proprietary information
    and property is protected by Trademark and Copyright.
</p>

<div class="page-break"></div>

<h3><strong>CLIENT INFORMATION AND CORRECTION FORM</strong></h3>
<p>
    In keeping with our company policy to maintain accurate information on all client activities, we ask that you review the Inventor's Marketing Guide Proposal.
    <strong><span style="text-decoration:underline;">THIS FORM IS PART OF THE ENTIRE AGREEMENT.</span></strong> This correction form must be returned to us with the copy of the Inventor's Marketing Guide Proposal.
    Any missing pages could delay us from beginning work on your project.
</p>
<h3><strong>INVENTOR INFORMATION CORRECTION</strong></h3>

<table cellspacing="10" align="center" class="rect" width="90%">
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Inventor Name:</span></td>
        <td colspan="2" class="trLine"><span class="spanProfile">Co-Inventor:</span></td>
    </tr>
    <tr>
        <td colspan="4" class="trLine"><span class="spanProfile">Company Name (if applicable):</span></td>
    </tr>
    <tr>
        <td class="trLine" colspan="2"><span class="spanProfile">State of Incorporation (if applicable):</span> </td>
        <td class="trLine" colspan="2"><span class="spanProfile"> Entity Type: (if applicable):</span> </td>
    </tr>
    <tr>
        <td class="trLine" colspan="2"><span class="spanProfile">Street Address:</span> </td>
        <td class="trLine"><span class="spanProfile"> Apt/Suite: </span> </td>
        <td class="trLine"><span class="spanProfile">City:</span> </td>
    </tr>
    <tr>
        <td class="trLine"><span class="spanProfile">State:</span> </td>
        <td class="trLine"><span class="spanProfile"> Zip: </span> </td>
        <td class="trLine"><span class="spanProfile">Home Tel:</span> </td>
        <td class="trLine"><span class="spanProfile">Mobile:</span></td>
    </tr>
    <tr>
        <td colspan="4" class="trLine"><span class="spanProfile"> INVENTION NAME:</span> </td>
    </tr>
</table>
<br>
<p>
    If you wish to authorize us to communicate with a co-inventor(s) or you want your co-inventor(s) given
    consideration and/or mention on any patent application, enter their complete information below.  You may
    also deselect a co-inventor by keeping a copy of this form or requesting it for future reference.  We must
    have both signatures of the inventor and co-inventor to acknowledge the change.<br>
</p>
<table cellspacing="10" align="center" class="rect" width="90%">
    <tr><td colspan="2"><span style="text-align: center;">CO-INVENTOR INFORMATION</span></td></tr>
    <tr>
        <td class="trLine"><span class="spanProfile">First Co-Inventor Name:</span></td>
        <td class="trLine"><span class="spanProfile">Sign:</span></td>
    </tr>
    <tr>
        <td class="trLine"><span class="spanProfile">Second Co-Inventor Name:</span> </td>
        <td class="trLine"><span class="spanProfile"> Sign:</span> </td>
    </tr>
    <tr>
        <td class="trLine"><span class="spanProfile">Third Co-Inventor Name:</span> </td>
        <td class="trLine"><span class="spanProfile"> Sign:</span> </td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Primary Inventor Authorized Signature:</span> </td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Corporate Officer Authorized Signature (if necessary):</span> </td>
    </tr>
</table>
<br>
<table cellspacing="15" class="notesTable">
    <tr>
        <td><img src="<?php echo e(asset('/img/contracts/unchk_square.png')); ?>" alt="">&nbsp;<strong>Check here to add a co-inventor</strong></td>
    </tr>
    <tr>
        <td><img src="<?php echo e(asset('/img/contracts/unchk_square.png')); ?>" alt="">&nbsp;<strong>Check here to delete a co-inventor</strong></td>
    </tr>
</table>
<h5 class="alignLeft"> <strong>Additional Comments to Changes:</strong> </h5>
<div class="rect notesTable"></div>
<br>
<table class="notesTable">
    <tr>
        <td><img src="<?php echo e(asset('/img/contracts/unchk_square.png')); ?>" alt="">  ALL INFORMATION IS CORRECT AND NO CORRECTIONS ARE NECESSARY AT THIS TIME</td>
    </tr>
</table>

<div class="page-break"></div>

<div class="iconMargin">
    <img src="<?php echo e(asset('/img/contracts/logo_gray.png')); ?>" alt="" name="Object1" width="124" height="95" id="Object1" align="center">
    <br><i style="font-size:90%;">Giving the edge to Inventors!</i>
</div>
<h3><strong>INVENTOR PRODUCT AND BUSINESS PROFILE</strong></h3>
<table cellspacing="12">
    <tr>
        <td>INVENTOR NAME: <?php echo e($project->lead->fname." ".$project->lead->lname); ?> </td>
        <td>FILE NUMBER: <?php echo e($project->lead->fileno); ?></td>
    </tr>
    <tr>
        <td colspan="2">INVENTION NAME: __________________________________________</td>
    </tr>
    <tr>
        <td colspan="2">INVENTION DETAILED DESCRIPTION:</td>
    </tr>
</table>
<br><br><br>
<p class="questions">Tell us when and how you thought of your invention:</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">How does your new invention WORK, OPERATE or FUNCTION?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">How is your new invention DIFFERENT from other similar ideas? <b>(Uniqueness)</b></p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">What similar product is on the market now? (Similar, but not the same)</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">What PROBLEM does your idea solve? What are the advantages and benefits of your idea\'s solution?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">How much will it cost to produce your idea?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>


<div class="page-break"></div>

<p class="questions">How much will you sell it for?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">What technical field(s) does your project fall into?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">What companies, groups of people, products, processes or services could use your idea?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">What upgrades or modifications can you suggest to improve functionality, packaging, appeal, versatility, mechanics or affordability to a manufacturer or end user?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">Describe the environment (wet, dry, temperature, pressure, light, dark, etc.) in which your idea will function?</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="questions">If your idea is a "device", what does it consume or produce? And what powers it? (Manual, electricity, gasoline, sunlight, water power, batteries, etc.)</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<div class="page-break"></div>

<h3 class="underline alignLeft"><strong>Inventor Profile:</strong></h3>
<table cellspacing="15" style="font-size: 14px;width: 100%;">
    <tr>
        <td class="trLine"><span class="spanProfile">Date of Birth:</span></td>
        <td class="trLine"><span class="spanProfile">Married (Y/N):</span></td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Spouse Name:</span></td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Children's Names:</span></td>
    </tr>
    <tr>
        <td class="trLine"><span class="spanProfile">College:</span> </td>
        <td class="trLine"><span class="spanProfile">Degree:</span> </td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Profession:</span></td>
    </tr>
    <tr>
        <td colspan="2" class="trLine"><span class="spanProfile">Hobbies:</span> </td>
    </tr>
</table>
<br>
<p class="questions">
    <strong>Any additional comments or information you wish to volunteer about yourself (inventor),any co-inventors or the invention:</strong>
</p>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>
<p class="blackLine"><br>

<div class="page-break"></div>
<h3><strong>GRAPHIC ILLUSTRATION PAGE</strong></h3>
<p>
    Continue your description by hand sketching the major working parts of your invention. You can also attach
    pictures, technical drawings and other professionally prepared renditions of your idea to this page. When
    drawing, use dark lead pencils, black ink or firmly press on the graph sheet when sketching your idea. If you feel
    that your prior submitted artwork is sufficient, please write “REFER TO PREVIOUS DRAWING” across the graph
    page. <strong>If you have a prototype, please attach photos of your product idea.</strong>
</p>
<table align="center" class="show" style="width:100%">
    <?php for($i=0;$i<21;$i++): ?>
        <tr align="center">
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
            <td class="show" height="20" width="20"></td>
        </tr>
    <?php endfor; ?>
</table>
<br>
<h3 class="alignLeft"><strong>Drawing Notes/Comments:</strong> </h3>
<div class="rect notesTable"></div>