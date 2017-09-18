<link href="<?php echo e(asset('/css/pdf_client.css')); ?>" rel="stylesheet" xmlns="http://www.w3.org/1999/html">

<br><br><br>

<p align="center" class="padd_cover">
    <img src="<?php echo e(asset('img/ilc_logo.jpg')); ?>" alt="" name="Object1" width="150" height="116"  align="center">
</p>
<h2 align="right" style="color: #808080;">SIC & NAICS CODES</h2>
<p class="pSmall">
    Dear <?php echo e(isset($client)?ucwords($client->fname." ".$client->lname):"Client’s Name"); ?>,
</p>
<p class="pSmall">
    As a continuing part of our service, we are pleased to provide you with your Standard Industrial Classification
    (SIC) and North American Industry Classification System (NAICS) codes as stated in our Agreement with you.
</p>
<p class="pSmall">
    The following codes have been researched and selected for you by our staff:
</p>
<?php if(isset($title1) && $title1 !=''): ?>
    <p class="pSmall" style="text-decoration: underline;"><b>2016 SIC DESCRIPTION</b></p>
    <p class="pSmall" style="text-decoration: underline;font-style: oblique;"><b><?php echo e($title1); ?></b></p>
    <p class="pSmall">
        <?php echo e($description1); ?>

        <br>
    <ul>
        <?php $__currentLoopData = $description11; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $descrp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="margin-left: 20px !important;" class="pSmall"><?php echo e($descrp); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    </p>
    <br><br>
<?php endif; ?>
<?php if(isset($title2) && $title2 != ''): ?>
    <p class="pSmall" style="text-decoration: underline;"><b>2016 NAICS DESCRIPTION</b></p>
    <p class="pSmall" style="text-decoration: underline;font-style: oblique;"><b><?php echo e($title2); ?></b></p>
    <p class="pSmall">
        <?php echo e($description2); ?>

        <br>
    <ul>
        <?php $__currentLoopData = $description22; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $descrp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="margin-left: 20px !important;" class="pSmall"><?php echo e($descrp); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    </p>
    <br><br>
<?php endif; ?>
<p class="pSmall">
    These SIC &amp; NAICS codes narrow down the specifics of your project area as close as possible. The
    Classification Headings are also included to provide you with an awareness of the category. Please be aware
    that in certain instances, these headings may or may not appear to directly relate to your product, as you
    understand it. However, the headings and codes are as close to product concept as possible.
</p>
<p class="pSmall">
    Our next step is to obtain the names and addresses of companies related to the above SIC & NAICS codes,
    and who in turn may be interested in your product. As the sole owner of your invention, you may however
    assist in this task by doing a little research on your own. The internet is a valuable tool when it comes to these
    types of searches, and after all, who better than you to know who may be interested in your product. Keep in
    mind, many companies have a broad and diversified manufacturing base. The name of the company may
    sound as if they specialize in one area only, but in reality they may be more diversified than you could ever
    imagine. One example is General Electric (GE ® ). You probably know the name, but did you know that they
    also specialize in adhesives and silicones, aircraft, appliances, healthcare, industrial parts, and they own
    NBC ® , Penske Trucks ® , and many other products and industries as well. So, don’t let the name of the
    company alone distract you. Some locations you may want to investigate are: <a>www.dnb.com</a> (Dun &
    Bradstreet ® ) and <a> www.thomasregister.com</a>. For any suggested companies or submissions, please just email
    them to <span style="text-decoration: underline;color: #008000;">info@successwithilc.com</span> or submit via regular mail to the company address. Don’t forget to include
    your product name with the submission so we can match up the information appropriately. Once again,
    welcome aboard, and good luck.
</p>

<p class="pSmall">Sincerely,</p>
<p class="mySmall" style="color: #008000">&nbsp;&nbsp;ASIA WYNDER</p>
<p class="mySmall">&nbsp;&nbsp;MARKETING DIRECTOR</p>
<p class="mySmall">&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>

<div class="myFooter">
    <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
    <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
    <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
</div>