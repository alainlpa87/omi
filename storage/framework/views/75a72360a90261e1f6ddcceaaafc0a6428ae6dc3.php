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
    <link href="<?php echo e(asset('/css/common.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('header_styles'); ?>

    <!--[if lt IE 9]>
    <script src="<?php echo e(asset('http://html5shim.googlecode.com/svn/trunk/html5.js')); ?>"></script>
   <![endif]-->
</head>
<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('intranet.tools.inboxModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- JavaScript ================================================== -->
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/plugins/jquery/jquery-ui.css')); ?>"  />

<script src="<?php echo e(asset('/plugins/jquery/jquery-1.11.3.js')); ?>" type="text/javascript"></script> <!-- jQuery -->
<script src="<?php echo e(asset('/plugins/jquery/jquery-ui.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/jquery/jquery.easing.1.3.js')); ?>" type="text/javascript"></script> <!-- jQuery easing -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
<script src="<?php echo e(asset('/js/tools.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset("js/autoNumeric.js")); ?>"></script>
<script src="<?php echo e(asset("/plugins/bootstrap/bootstrap.min.js")); ?>"></script>
<script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-switch.min.js")); ?>"></script>
<script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datetimepicker.min.js")); ?>"></script>
<script src="<?php echo e(asset("/plugins/sweetalert/sweetalert.min.js")); ?>"></script>
<script src="<?php echo e(asset("/plugins/jquery/store.min.js")); ?>"></script>
<script src="<?php echo e(asset("/plugins/jquery/jquery-idleTimeout.js")); ?>"></script>
<?php echo $__env->yieldContent('footer_scripts'); ?>

<!-- End Document
================================================== -->
