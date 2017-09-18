<link href="<?php echo e(asset('/css/pdf_client.css')); ?>" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<br>

<p align="center" style="position: fixed;top: 0;" class="padd_cover">
    <img src="<?php echo e(asset('img/ilc_logo.jpg')); ?>" alt="" name="Object1" width="250" height="96"  align="center">
</p>
<br>
<table style="margin-top: 150px;width: 100%;">
    <tr style="width: 100%;"><td class="pSmall" style="width: 50% !important;"><?php echo e($ilc->invFname." ".$ilc->invLname); ?></td><td align="right" class="pSmall" style="width: 50% !important;"><?php echo e($date); ?></td></tr>
    <tr><td class="pSmall"><?php echo e($ilc->street.", ".$ilc->city.", ".$ilc->state.", ".$ilc->zip); ?></td></tr>
</table>
<br>
<p ><b>RE: ILC Account # <?php echo e($ilc->fileno); ?></b></p>
<p> Dear <?php echo e($ilc->invFname." ".$ilc->invLname); ?>,</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We regret to inform you that our research indicates your pending
    utility patent for <?php echo e($ilc->inventionName); ?> has been abandoned by the USPTO and was officially recorded as abandoned.
</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You can verify this development by visiting: <a href="http://www.uspto.gov/patents/process/status/index.jsp">http://www.uspto.gov/patents/process/status/index.jsp</a>
    Upon arriving to the page, please select <b>Public Pair</b> (which can be found under the Check Status tab on the left
    side of the page). At this point, you would have to enter the security captcha as noted on the screen. After
    successfully passing this security feature, you will be directed to Search for Application. Our records note your
    utility application number as: <?php echo e($appNo); ?>. Please enter this number and press search, the next page will show your recorded status with the USPTO.</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Although, it has truly been a privilege working with you on your product, <span style="text-decoration: underline;">we regret to inform you that
    since your invention is no longer under the protection of a patent-pending status, ILC cannot further advocate or
    market your invention to manufacturers within the industry</span>. Therefore, we are separating from your initial
    contract and ceasing all networking on the behalf of your product.
</p>
<p  style="text-align: justify;line-height: 150%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The marketing of new inventions is often a risky and uncertain challenge and even though this particular
    invention was not rewarded a definitive patent, we must commend you for assessing that risk and meeting that
    challenge with consistent excitement. We would again like to thank you very much for being our client and
    should you have any need for our marketing services on a new product idea down the line, please do not hesitate
    to contact us.
</p>
<p >Most Sincerely,</p>
<p style="color: limegreen;font-weight:bold;">Asia Wynder</p>
<p >Marketing Director</p>
<p >International Licensing Consultants</p>
<div class="myFooter">
    <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
    <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
    <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
</div>
