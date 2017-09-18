
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/clientServices.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/uploadFile.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
    <div class="ilc_pending_introCall_hide">
        <?php $__currentLoopData = $pendingIntroCall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="ilc_pending_intro" data-fileno ="<?php echo e($pending->fileno); ?>" data-name="<?php echo e($pending->projectclientservices->project->lead->fname." ".$pending->projectclientservices->project->lead->lname); ?>" data-phone="<?php echo e($pending->projectclientservices->project->lead->phone); ?>" data-iid="<?php echo e($pending->id); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="ilc_pending_expiration_hide">
        <?php $__currentLoopData = $pendingExpiration; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="ilc_pending_expiration" data-fileno ="<?php echo e($pending->fileno); ?>" data-name="<?php echo e($pending->projectclientservices->project->lead->fname." ".$pending->projectclientservices->project->lead->lname); ?>" data-phone="<?php echo e($pending->projectclientservices->project->lead->phone); ?>" data-iid="<?php echo e($pending->id); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php if($tradeshowAlert == 1): ?>
        <div id="tradeshows"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>Trade Shows Call:</h5>
                    </div>
                    <div class="modal-body">
                        <div >
                           <p>One trade show just happened, to find the clients to call search in the ILC grid with the parameter "trade shows call".</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(count($pendingIntroCall)>0): ?>
    <div id="ilcPendingIntroCall"  aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                    <h5>FILES WITH PENDING INTRO CALL:</h5>
                </div>
                <div class="modal-body">
                    <div class="container-pendingIntro">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(count($pendingExpiration)>0): ?>
        <div id="ilcPendingExpiration"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>FILES WITH EXPIRATION IN A WEEK OR LESS:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-pendingExpiration">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("js/ilcPending.js")); ?>"></script>
    <script src="<?php echo e(asset("js/ilc.js")); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>