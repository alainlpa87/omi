
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/clientServices.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>


    <div class="cs_pending_patentApp_filed_hide">
        <?php $__currentLoopData = $pendingPatentAppF; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="pending_app_filed" data-fileno ="<?php echo e($pending->fileno); ?>" data-pin="<?php echo e($pending->project_id); ?>" data-clientfn="<?php echo e($pending->project->lead->fname); ?>" data-clientln="<?php echo e($pending->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php if(count($pendingPatentAppF)>0): ?>
    <div id="PendingPatentAppModal"  aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                    <h5>Files with Patent App Filed since 3 months:</h5>
                </div>
                <div class="modal-body">
                    <div class="container-files">
                    </div>
                </div>
                
                    
                
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    
    
    <script src="<?php echo e(asset("js/alert3DDesign.js")); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>