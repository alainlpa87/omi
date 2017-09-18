<link href="<?php echo e(asset('/css/pdf.css')); ?>" rel="stylesheet">

<?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
<p class="iconMargin">
    <img src="<?php echo e(asset('/img/contracts/logo.png')); ?>" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<table align="center" width="100%">
    <tr>
        <th>Client Name:</th>
        <td><?php echo e($project->lead->fname." ".$project->lead->lname); ?></td>
        <th>Invention Name:</th>
        <td><?php echo e($project->ideaName); ?></td>
    </tr>
    <?php if(strlen($project->coInventor)==0): ?>
        <tr>
            <th>Address:</th>
            <td><?php echo e($project->lead->street." ".$project->lead->street2); ?></td>
            <th>Consultant:</th>
            <td><?php echo e(ucwords($project->consultant->fname." ".$project->consultant->lname)); ?></td>
        </tr>
        <tr>
            <th>City/State:</th>
            <td><?php echo e($project->lead->city.", ".$project->lead->state); ?></td>
            <th>Date:</th>
            <td><?php echo e(date("F j, Y")); ?></td>
        </tr>
        <tr>
            <th>Zip:</th>
            <td><?php echo e($project->lead->zip); ?></td>
            <th>File:</th>
            <td><?php echo e($project->lead->fileno); ?> - <?php echo e($project->id); ?></td>
        </tr>
    <?php else: ?>
        <tr>
            <th>Co-inventor:</th>
            <td><?php echo e($project->coInventor); ?></td>
            <th>Consultant:</th>
            <td><?php echo e(ucwords($project->consultant->fname." ".$project->consultant->lname)); ?></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td><?php echo e($project->lead->street." ".$project->lead->street2); ?></td>
            <th>Date:</th>
            <td><?php echo e(date("F j, Y")); ?></td>
        </tr>
        <tr>
            <th>City/State:</th>
            <td><?php echo e($project->lead->city.", ".$project->lead->state); ?></td>
            <th>File:</th>
            <td><?php echo e($project->lead->fileno); ?> - <?php echo e($project->id); ?></td>
        </tr>
        <tr>
            <th>Zip:</th>
            <td><?php echo e($project->lead->zip); ?></td>
            <td></td>
        </tr>
    <?php endif; ?>
</table>
<br><br>
<h3><strong>Invention Marketing Guide Upgrade Proposal</strong></h3>
<br>
<ul class="circle">
    <table width="85%">
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 35px">MOST<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; POPULAR</strong></td>
            <td width="12%">&nbsp;</td>
        </tr>
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: darkgray;"><strong style="margin-left: 20px">SILVER<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e(money_format('%.0n', $prices->plan1)); ?></strong></td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 35px">GOLD<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e(money_format('%.0n', $prices->plan2)); ?></strong></td>
            <td width="12%" style="border-bottom: 1px solid;text-align:center;vertical-align:middle;background-color: #ddd;"><strong style="margin-left: 20px">PLATINUM<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e(money_format('%.0n', $prices->plan3)); ?></strong></td>
        </tr>
        <tr>
            <td><li><b>Registered Attorney Patent Search & Legal Opinion</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
        </tr>
        <tr>
            <td>
                <li>
                    <b>Investor Strategy Package</b>
                    <ul class="chk_square">
                        <li>Pricing Strategies</li>
                        <li>Packaging Suggestions</li>
                        <li>Suggested Legal Protection</li>
                        <li>How To Beat Competitors</li>
                    </ul>
                </li>
            </td>
            <td style="background-color: darkgray;"><div class="col-md-3" style="margin-left: 60%"><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3" style="margin-left: 60%" ><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3" style="margin-left: 60%" ><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>PowerPoint Momentum Tool<sup class="black">TM</sup></b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%"><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Manufacturing Consideration</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%" ><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%" ><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%" ><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>Press Release</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%"><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%"><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%"><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
        </tr>
        <tr>
            <td><li><b>2D Design</b></li></td>
            <td style="background-color: darkgray;"><div class="col-md-3 " style="margin-left: 60%"><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #FAEFA6;"><div class="col-md-3 " style="margin-left: 60%"><img src="<?php echo e(asset('/img/unchk_square.png')); ?>" alt=""></div></td>
            <td style="background-color: #ddd;"><div class="col-md-3 " style="margin-left: 60%"><img src="<?php echo e(asset('/img/chk_square.png')); ?>" alt=""></div></td>
        </tr>
        <tr>
            <td><li><strong>Investment Protection:</strong> Amount of IIG investment will be<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;credited towards <strong>FULL</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;payment patent protection plan</li></td>
            <td style="text-align:center;vertical-align:middle;background-color: darkgray"><strong style="margin-left: 60%"><?php echo e(money_format('%.0n', $prices->plan4)); ?></strong></td>
            <td style="text-align:center;vertical-align:middle;background-color: #FAEFA6;"><strong style="margin-left: 60%"><?php echo e(money_format('%.0n', $prices->plan5)); ?></strong></td>
            <td style="text-align:center;vertical-align:middle;background-color: #ddd;"><strong style="margin-left: 60%"><?php echo e(money_format('%.0n', $prices->plan6)); ?></strong></td>
        </tr>
        <tr>
            <td width="64%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
        </tr>
        <tr>
            <td width="64%"><strong style="color: red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select your package:&nbsp;</strong></td>
            <td width="12%"><img src="<?php echo e($price == $prices->plan1 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" style="margin-left: 20px" alt=""> <strong>&nbsp; <?php echo e(money_format('%.0n', $prices->plan1)); ?></strong></td>
            <td width="12%"><img src="<?php echo e($price == $prices->plan2 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" style="margin-left: 20px" alt=""> <strong>&nbsp; <?php echo e(money_format('%.0n', $prices->plan2)); ?></strong></td>
            <td width="12%"><img src="<?php echo e($price == $prices->plan3 ?asset('/img/chk_square.png'):asset('/img/unchk_square.png')); ?>" style="margin-left: 30%" alt=""> <strong>&nbsp; <?php echo e(money_format('%.0n', $prices->plan3)); ?></strong></td>
        </tr>
    </table>
</ul>
<br>
<div class="page-break"></div>

<h3><strong>Legal Disclosure and Information</strong></h3>
<p>
    1. This proposal is made between Patent Services USA and all Inventors named herewith in order to execute this Invention Initiative Guide Proposal (the agreement) for
    the Invention Initiative Guide outlined on the reverse side of this page.
</p>
<p>
    2. This agreement does not execute a patent application, does not provide patent protection of any kind and does not substitute for the legal advice of a registered
    patent attorney.  The Inventors understands that all patent searches and legal opinions are provided by our affiliate Registered Patent Attorney.  We may
    utilize one or more Registered Patent Attorneys to expedite all patent searches.  The search is a thorough search of files on record at the United States Patent and
    Trademark Office.  The Inventors authorize Patent Services USA to provide the results of the patent search and legal opinion from any and all Registered Patent
    Attorneys as part of the Invention Initiative Guide.  Inventors acknowledge that Patent Services USA will deliver the services outlined in this agreement within a three
    (3) to five (5) week timeframe which constitutes a reasonable amount of time due to work scheduling of attorneys, draftsmen, production personnel and other factors
    beyond any control of Patent Services USA.
</p>
<p>
    3. New invention innovation and / or product innovation involves a high degree of risk.  Inventor agrees that a patent is the most secure form of legal protection for a
    new invention.  Only a small percentage of inventions become commercially successful.   Patent Services USA does not make any promises, claims or guarantees
    that an invention will ever make a profit, have commercial success, any positive results or result in any kind of financial gain.
</p>
<p>
    4. This Invention Initiative Guide represents the entire agreement between all parties, whether written, verbal, expressed or implied.  Any and all other agreements or
    suggestions are void.  This agreement shall not be modified without the expressed written approval of Patent Services USA and at least one authorized officer or
    representative. This agreement is not a release of any material submitted to Patent Services USA without the expressed written consent of the inventor.
</p>
<p>
    5. The Inventor shall not, nor shall attempt to circumvent or bypass the activities of Patent Services USA by negotiating directly or indirectly with any prospective patent
    assistance service providers without the express written permission of the Patent Services USA. Any attempt by the INVENTOR to circumvent or bypass the activities
    of the Patent Services USA shall be construed as a material breach in violation of this Section and shall trigger the termination of this Agreement without any
    recourse whatsoever by INVENTOR.
</p>
<p>
    6. The Inventor acknowledges Patent Services USA does not engage in the business of invention development or marketing services.  No inventors have received a net
    financial profit as a result of PATENT SERVICES USA. No inventors have contracted with Patent Services USA for invention promotion services during the past five
    (5) years.  Patent Services USA does not perform market evaluations or give opinions of marketing potential on any invention submitted for review.  Patent Services
    USA has no customers that purchase marketing promotion services.  No inventors have received licensing agreements for their inventions as a direct result of any
    invention promotion services through Patent Services USA. In the past 10 years, the officers of Patent Services USA, either individually or collectively, assisted Global Licensing Partners
    in its efforts to research inventions.  Patent Services USA only provides patent assistance services and informational materials related to the
    invention industry.
</p>
<p>
    7. All disputes concerning the understanding, meaning or interpretation of any and all parts of this agreement, including the rights, duties, relationships or obligations of
    either party under this agreement shall be settled through the American Arbitration Association (AAA), in the county of Miami-Dade, State of Florida, in accordance
    with all rules and regulations.  All claims must be made within three (3) months of occurrence.  Inventors agree to indemnify and hold harmless Patent Services USA
    and its affiliates, employees, contractors, successors and assigns, including, all Registered Patent Attorneys from any and all claims which might be raised by any
    third party for any reason relating to the invention or the services provided by Patent Services USA, including, but not limited to, any claim of infringement of
    intellectual property (copyright, trademark and patent) relating to the inventions as a result of the use contemplated herein of the inventions, in any form submitted by
    Inventor to Patent Services USA.
</p>
<p>
    8. All information contained in this and all other documents are proprietary and the exclusive property of Patent Services USA, which reserves all rights.  All proprietary
    information and property is protected by Trademark and Copyright.
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
    10. The Invention Initiative Guide contains a Market Analysis which may result in a negative outcome.  All inventors / clients have a seven (7) calendar day right of
    rescission from the signature date of the agreement to cancel for a refund.  The cancellation request must be received at our corporate headquarters located at
    12000 Biscayne Boulevard, Suite 700 North Miami, FL 33181, via certified mail only.  Due to work scheduling of attorneys, draftsmen, production personnel and other
    factors beyond any control, Patent Services USA reserves the first right to refuse all refund requests if the market analysis occurs after the seven (7) calendar day
    rescission period stated above.
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