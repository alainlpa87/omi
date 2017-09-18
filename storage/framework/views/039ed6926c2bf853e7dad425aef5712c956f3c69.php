
<?php $__env->startSection('title','Patent Services USA'); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/common.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap-datetimepicker.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-3">
                    <b>Select a Project</b>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="selectProjectTicket" id="selectProjectTicket">
                        <option value="-1">Select Project</option>
                        <?php $__currentLoopData = $projectsFromLead; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($proj->id); ?>"><?php echo e(ucwords($proj->ideaName)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                <div class="col-md-3">
                    <b>Ticket Subject</b>
                </div>
                <div class="col-md-4">
                    <input type="text" name="ticketName" id="ticketName"  class="form-control">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                <div class="col-md-3">
                    <b>Describe the problem</b>
                </div>
                <div class="col-md-6">
                    <textarea rows="15" cols="30" name="ticketText" id="ticketText"  class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                <div class="col-md-offset-7 col-md-2">
                    <button id="createTicket" class="btn btn-primary" style="width: 100%;">OPEN</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('omi.layout.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>