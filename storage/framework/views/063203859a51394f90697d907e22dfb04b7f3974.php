<link href="<?php echo e(asset('/css/pdf.css')); ?>" rel="stylesheet">

<p class="iconMargin">
    <img  src="<?php echo e(asset('/img/contracts/logo.png')); ?>" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<br>
<br>
<table align="center" width="100%">
    <tr>
        <td><strong>Client Name:</strong></td>
        <td><?php echo e($project->lead->fname." ".$project->lead->lname); ?></td>
        <td><strong>Invention Name:</strong></td>
        <td><?php echo e($project->ideaName); ?></td>
    </tr>
    <?php if(strlen($project->coInventor)==0): ?>
        <tr>
            <td><strong>Address:</strong></td>
            <td><?php echo e($project->lead->street." ".$project->lead->street2); ?></td>
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
</p>
<div class="page-break"></div>

<h3><strong>Legal Disclosure and Information</strong></h3>
<p>
    1. This proposal is made between PATENT SERVICES USA and all Inventors named here with in order to execute this Inventor’s Marketing Guide
    Proposal (the agreement) for the Inventor’s Marketing Guide outlined on the reverse side of this page.
</p>
<p>
    2. This agreement does not execute a patent application, does not provide patent protection of any kind and does not substitute for the legal
    advice of a registered patent attorney.  Inventors acknowledge that PATENT SERVICES USA will deliver the services outlined in this agreement
    within a three (3) to five (5) week timeframe which constitutes a reasonable amount of time due to work scheduling of professionals, draftsmen,
    production personnel and other factors beyond any control of PATENT SERVICES USA.
</p>
<p>
    3. New invention innovation and / or product innovation involves a high degree of risk.  Inventor agrees that a patent is the most secure form of legal
    protection for a new invention.  Only a small percentage of inventions become commercially successful. PATENT SERVICES USA does not make any promises,
    claims or guarantees that an invention will ever make a profit, have commercial success, any positive results or result in any kind of financial gain.
</p>
<p>
    4. This Inventor’s Marketing Guide represents the entire agreement between all parties, whether written, verbal, expressed or implied.  Any and all other agreements
    or suggestions are void.  This agreement shall not be modified without the expressed written approval of PATENT SERVICES USA and at least one authorized officer
    or representative. This agreement is not a release of any material submitted to PATENT SERVICES USA without the expressed written consent of the inventor.
</p>
<p>
    5. The Inventor shall not, nor shall it attempt to circumvent or bypass the activities of PATENT SERVICES USA by negotiating directly or indirectly with any prospective
    patent assistance service providers without the express written permission of the PATENT SERVICES USA Any attempt by the INVENTOR to circumvent or bypass the activities
    of the PATENT SERVICES USA shall by construed as a material breach in violation of this Section and shall trigger the termination of this Agreement without any recourse
    whatsoever by INVENTOR.
</p>
<p>
    6. The Inventor acknowledges PATENT SERVICES USA does not engage in the business of invention development or marketing services.  No inventors have received a net financial
    profit as a result of PATENT SERVICES USA.  No inventors have contracted with PATENT SERVICES USA for invention promotion services during the past five (5) years.  PATENT
    SERVICES USA does not perform market evaluations or give opinions of marketing potential on any invention submitted for review.  PATENT SERVICES USA has no customers that
    purchase marketing promotion services.  No inventors have received licensing agreements for their inventions as a direct result of any invention promotion services through
    PATENT SERVICES USA.  In the past 10 years, the officers of PATENT SERVICES USA, either individually or collectively, assisted Global Licensing Partners in its efforts to
    research inventions.  PATENT SERVICES USA only provides patent assistance services and informational materials related to the invention industry.
</p>
<p>
    7. All disputes concerning the understanding, meaning or interpretation of any and all parts of this agreement, including the rights, duties, relationships or obligations
    of either party under this agreement shall be settled through the American Arbitration Association (AAA), in the county of Miami-Dade, State of Florida, in accordance with
    all rules and regulations.  All claims must be made within three (3) months of occurrence.  Inventors agree to indemnify and hold harmless PATENT SERVICES USA and its affiliates,
    employees, contractors, successors and assigns, including, all Registered Patent Attorneys from any and all claims which might be raised by any third party for any reason relating
    to the invention or the services provided by PATENT SERVICES USA., including, but not limited to, any claim of infringement of intellectual property (copyright, trademark and patent)
    relating to the inventions as a result of the use contemplated herein of the inventions, in any form submitted by Inventor to PATENT SERVICES USA.
</p>
<p>
    8. All information contained in this and all other documents are proprietary and the exclusive property of PATENT SERVICES USA., which reserves all rights.  All proprietary information
    and property is protected by Trademark and Copyright.
</p>
<p>
    9. The Inventor acknowledges their consent to this Agreement via Electronic Signature. This agreement and any counterparts to
    this agreement will be deemed an original. To expedite the process of entering into this Agreement, the Inventor acknowledges
    that Electronic Transmissions of the Agreement will be equivalent to original documents. “Electronic Transmission" will mean
    copies that are reproduced or transmitted as complete and accurate reproductions and transmissions of this original.
    Signatories have the option to opt out and sign with a paper signature instead.
</p>
<div class="page-break"></div>

<p>
    10.  The Inventor’s Marketing Guide contains a Market Analysis which may result in a negative outcome.  All inventors / clients have a seven (7) calendar day right
    of rescission from the signature date of the agreement to cancel for a refund.  The cancellation request must be received at our corporate headquarters located
    at 12000 Biscayne Boulevard, Suite 700 North Miami, FL 33181, via certified mail only.  Due to work scheduling of professionals, draftsmen, production personnel
    and other factors beyond any control, PATENT SERVICES USA, reserves the first right to refuse all refund requests if the market analysis occurs after the seven
    (7) calendar day rescission period stated above.
</p>
<table cellspacing="10" style="font-size: 14px;">
    <tr>
        <td colspan="5" style="padding-bottom:25px;"><strong> Client Authorization:</strong><br><br>
            <strong>By signing below, I agree to all terms and conditions outlined in this Inventor's Marketing Guide Proposal</strong>
        </td>
    </tr>
    <tr>&nbsp;</tr>
</table>
<br><br><br>
<table cellspacing="10" style="font-size: 14px;">
    <tr>
        <td> </td>
        <td>________________________________</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>________________________________</td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td> </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature &nbsp;</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date &nbsp;</td>
        <td> </td>
        <td> </td>
    </tr>
</table>