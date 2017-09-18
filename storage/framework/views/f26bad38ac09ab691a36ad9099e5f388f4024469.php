
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/clientServices.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/buttons.dataTables.min.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <h4 class="totalProjects">Projects with Open Tickets</h4>
                      <?php $__currentLoopData = $projectsWithTicket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projTicket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12 col-xs-6" style="margin-top: 5px;cursor: pointer;">
                            <a data-toggle="collapse">
                                <i>
                                    <h4 class="panel-title showTickets" data-pid="<?php echo e($projTicket->project_id); ?>"><span style="color: red">&bull;</span><?php echo e("Fileno: ".$projTicket->lead->fileno." PIN: ".$projTicket->project_id); ?>:</h4>
                                </i>
                            </a>
                        </div><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <button class="btn btn-primary" id="goHome" style="width: 100%;">HOME</button>
            </div>
            <div class="page-container">
                <div class="leadroll">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                            <div class="panel-group" id="accordionTickets">
                                <h3 class="col-md-12 hidden" id="csHeader">Client Services Tickets</h3>
                                <div class="col-md-12 col-xs-12" id="csTickets"></div>
                                <h3 class="col-md-12 hidden" id="prodHeader">Production Tickets</h3>
                                <div class="col-md-12 col-xs-12" id="prodTickets"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
    <?php echo $__env->make('intranet.tools.loadingModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/ticket.js")); ?>"></script>
    
    <script src="<?php echo e(asset("plugins/jquery/dropzone.js")); ?>"></script>

    <script src="<?php echo e(asset("/plugins/bootstrap/moment.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepicker.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/jquery.dataTables.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.buttons.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/buttons.print.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>