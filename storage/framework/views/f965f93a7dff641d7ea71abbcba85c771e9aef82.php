<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap-switch.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap-datetimepicker.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.min.css"/>
    <link href="<?php echo e(asset('/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(asset('https://fonts.googleapis.com/css?family=Knewave')); ?>" rel='stylesheet' type='text/css'>
    <?php echo $__env->yieldContent('header_styles'); ?>
    <script src="<?php echo e(asset('https://html5shim.googlecode.com/svn/trunk/html5.js')); ?>"></script>

</head>
<!-- Body -->
<!-- Part 1: #Header -->


<div class="">
    <div class="header_style">
        <div class="container-fluid">
            <div class="col-md-4 col-xs-12 logo-blue">
                <img style="vertical-align:text-bottom;" src="<?php echo e(asset('img/logos/icologo_lg.png')); ?>" alt="" width="48">
                PATENT SERVICES
            </div>
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                    <li id="mailto"><a href="mailto:#"><i class="fa fa-envelope-o"></i><span> info@ownmyinvention.com</span></a></li>
                    <li id="pphone">
                        <a href="tel:8883446836">
                            <span class="callup">Questions? Call us! </span>
                            <i class="fa fa-phone phn"></i>
                            <span>888-344-6836</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

<?php echo $__env->yieldContent('content'); ?>

<!--======================Footer============================ -->
<div class="pre-footer" data-user="" data-pin="">
    <div class="container">

    <div class="row">

        <div class="col-md-6 col-sm-6 pre-footer-col">
            <h2>Inventors Welcome</h2>
            <p>Patents aren't just for big biz.  We offer free consultation and support for independent inventors.  Strength comes in numbers.</p><a class="btn-call" href='sub'><i class="fa fa-rocket margin-right-10"></i>Get Started FREE</a>
        </div>
        <div class="col-md-3 col-xs-12">
            <h2>Contact Us</h2>
            <address>
                <strong> Patent Services USA </strong><br>
                12000 Biscayne Blvd., Suite 700<br>
                North Miami, FL 33181<br>
            </address>
        </div>
        <div class="col-md-3 col-xs-12">
            <h2>&nbsp;</h2>
            <address>
                Phone: 1-888-34-INVENT(46836)<br>
                Phone UK: +44 7441 907200<br>
                Fax: 1-800-886-7951<br>
                Email: <a href="mailto:admin@ownmyinvention.com">admin@ownmyinvention.com</a><br>
            </address>
        </div>
        <!-- END BOTTOM CONTACTS -->
        <div class="col-md-12">
            <p class="col-md-6">©2012-2014 PATENT SERVICES. All Rights Reserved.<img class="medalions" src="<?php echo e(asset('img/logos/wht_seal.png')); ?>" alt="Platinum Medalion" width="15%"><a href="https://www.inventpalooza.com/" target="_blank"><img class="medalions" src="<?php echo e(asset('img/logos/palooza_200.png')); ?>" alt="InventPalooza" width="20%"></a></p>
            <ul class="col-md-3 ulFooter">
                <li><a href="../../../terms-and-conditions.php">Terms and Conditions</a></li>
                <li><a href="../../../legal.php">Legal</a></li>
                <li><a href="../../../privacy.php">Privacy</a></li>
            </ul>
            <div class="col-md-3">
                <span>
                    <a target="_blank" href="//www.facebook.com/PatentServicesUSA"><img style="vertical-align:middle;margin-left:10px;" src="<?php echo e(asset('/img/social/fb.png')); ?>"></a>
                   <a target="_blank" href="//plus.google.com/+OwnMyInvention"><img style="vertical-align:middle;margin-left:10px;" src="<?php echo e(asset('/img/social/g+.png')); ?>"></a>
                   <a target="_blank" href="//www.linkedin.com/company/patent-services-usa"><img style="vertical-align:middle;margin-left:10px;" src="<?php echo e(asset('/img/social/linkedin.png')); ?>"></a>
                   <a target="_blank" href="//twitter.com/patsvcusa"><img style="vertical-align:middle;margin-left:10px;" src="<?php echo e(asset('/img/social/twitter.png')); ?>"></a>
                    <a target="_blank" href="//www.pinterest.com/PatSvcUSA/"><img style="vertical-align:middle;margin-left:10px;" src="<?php echo e(asset('/img/social/pintreste.png')); ?>"></a>
                </span>
            </div>
        </div>
        <div id="map-canvas" class="col-md-12" style="width:100%;"></div>
    </div>
</div>
</div>
<!-- =====================End Footer============================= -->

<!-- JavaScript
  ================================================== -->
<script src="<?php echo e(asset('/plugins/jquery/jquery-1.11.3.js')); ?>" type="text/javascript"></script> <!-- jQuery -->
<script src="<?php echo e(asset('/plugins/jquery/jquery.easing.1.3.js')); ?>" type="text/javascript"></script> <!-- jQuery easing -->

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script src="<?php echo e(asset("/plugins/bootstrap/bootstrap.min.js")); ?>"></script>
<script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-switch.min.js")); ?>"></script>
<script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datetimepicker.min.js")); ?>"></script>
<script src="<?php echo e(asset("/plugins/sweetalert/sweetalert.min.js")); ?>"></script>
<script src="<?php echo e(asset("js/autoNumeric.js")); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset("/js/tools.js")); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset("js/omi/project.js")); ?>" type="text/javascript"></script>
<?php echo $__env->yieldContent('footer_scripts'); ?>

<script type="text/javascript">
    $(document).ready(footerMap());
</script>
<!-- End Document
================================================== -->
