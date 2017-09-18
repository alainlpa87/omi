
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/vendor.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid">
        <input type="hidden" data-email="<?php echo e($consultant->email); ?>" id="vendor_email">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="col-md-12 col-xs-2 noPadding">
                    <button class="btn btn-default btnUploadSeveralFiles padding5" id="btnUploadSeveralFiles"><i class="fa fa-upload"></i> UPLOAD FILES</button>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: <?php echo e(WHO_IS_WIDTH); ?>px;">
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <button class="btn btn-primary" id="emToCSBtn">SEND EMAIL TO PSU</button>
                </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
            
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="groupProjects">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseNew" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        New Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseNew" class="panel-collapse collapse <?php echo e(count($projectsNew)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-new">
                                        <?php $__currentLoopData = $projectsNew; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($project = $projectp->project): ?><?php endif; ?>
                                            <?php echo $__env->make('intranet.vendors.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseReturned" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        Returned Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseReturned" class="panel-collapse collapse <?php echo e(count($projectsReturned)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-returned">
                                        <?php $__currentLoopData = $projectsReturned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($project = $projectp->project): ?><?php endif; ?>
                                            <?php echo $__env->make('intranet.vendors.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOverdue">
                                    <h4 class="panel-title titleContainers">
                                        Overdue Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseOverdue" class="panel-collapse collapse <?php echo e(count($projectsLate)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-overdue">
                                        <?php $__currentLoopData = $projectsLate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($project = $projectp->project): ?><?php endif; ?>
                                            <?php echo $__env->make('intranet.vendors.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('intranet.tools.iframePrint', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.vendors.tools.vendorFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.UploadFileModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.emailToPSUFromVendorsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.attCSFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("plugins/jquery/dropzone.js")); ?>"></script>
    <script src="<?php echo e(asset("js/uploadFile/uploadFileVendors.js")); ?>"></script>
    <script src="<?php echo e(asset("js/vendors.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>