
<?php $__env->startSection('title','Patent Services USA'); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/common.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/payment.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <h1 align="center"><strong>Patent Services Payment Terminal</strong></h1>
    <h2 class="subTitles">Payment Success!</h2>
    <?php if($contract->type!="PPA" && $complete == 1): ?>
        <p>Your payment was <strong>APPROVED</strong>! Please answer the questions as soon as you can in the project view.</p>
        <script type="text/javascript">
            var sa_values = { "site":12644 };
            function saLoadScript(src) {
                var js = window.document.createElement("script");
                js.src = src; js.type = "text/javascript";
                document.getElementsByTagName("head")[0].appendChild(js);
            }
            var d = new Date();
            if (d.getTime() - 172800000 > 1447169768000)
                saLoadScript("//www.shopperapproved.com/thankyou/rate/12644.js");
            else
                saLoadScript("//direct.shopperapproved.com/thankyou/rate/12644.js?d=" + d.getTime()); </script>
    <?php else: ?>
        <p>Your payment was <strong>APPROVED</strong>! </p>
    <?php endif; ?>
    <a class="btn btn-primary" href="<?php echo e(url('launch')); ?>">Go back to the Launch Center</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("js/autoNumeric.js")); ?>"></script>
    <script src="<?php echo e(asset("/js/omi/payment.js")); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('omi.layout.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>