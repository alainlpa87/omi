
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/production.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <input type="hidden" id="pendingPatentAppF" data-projpending="<?php echo e($pendingPatentAppF); ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                
                
                <p class="boxAttorney">Total projects sent this month: <span id="attorney2Available"><?php echo e($totalSend); ?></span></p>

                <?php $__currentLoopData = $attArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($attData = explode("-",$att)): ?><?php endif; ?>
                    <p class="boxAttorney">Total projects sent to <?php echo e($attData[0]); ?>: <span id="attorney1Available"><?php echo e($attData[1]); ?></span></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: <?php echo e(WHO_IS_WIDTH); ?>px;">
                </div>
                <div class="col-md-12">
                        <button class="btn btn-primary" id="sentLetterOfEngagement">Send LetterOfEng</button>
                    
                        <button class="btn btn-primary" id="sendProjects">Send Projects</button>
                    
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary showTicketsView" id="showTicketsProd">MANAGE TICKETS</button>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <button class="btn btn-primary" id="emToVendor">SEND EMAIL TO VENDOR</button>
                </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
            
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="groupQuestions">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseNew" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        New Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseNew" class="panel-collapse collapse <?php echo e(count($projectsProductionNew)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-new">
                                        <?php $__currentLoopData = $projectsProductionNew; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($project = $projectp->project): ?><?php endif; ?>
                                        <?php echo $__env->make('intranet.production.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSent" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        Sent Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseSent" class="panel-collapse collapse <?php echo e(count($projectsProductionSent)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-sent">
                                    <?php $__currentLoopData = $projectsProductionSent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($project = $projectp->project): ?><?php endif; ?>
                                    <?php echo $__env->make('intranet.production.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseCompleted" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        Completed Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseCompleted" class="panel-collapse collapse <?php echo e(count($projectsProductionCompleted)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-completed">
                                    <?php $__currentLoopData = $projectsProductionCompleted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($project = $projectp->project): ?><?php endif; ?>
                                    <?php echo $__env->make('intranet.production.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                            <div id="collapseReturned" class="panel-collapse collapse <?php echo e(count($projectsProductionReturned)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-returned">
                                    <?php $__currentLoopData = $projectsProductionReturned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($project = $projectp->project): ?><?php endif; ?>
                                    <?php echo $__env->make('intranet.production.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                            <div id="collapseOverdue" class="panel-collapse collapse <?php echo e(count($projectsProductionOverdue)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-overdue">
                                    <?php $__currentLoopData = $projectsProductionOverdue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($project = $projectp->project): ?><?php endif; ?>
                                    <?php echo $__env->make('intranet.production.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
    <?php echo $__env->make('intranet.production.tools.productionFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.production.tools.productionReturnProjectModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.production.tools.productionSelectAttorneyModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.production.tools.productionSetShippingDateModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.UploadFileModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.emailToVendorsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.selectFilesToAttachModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/production.js")); ?>"></script>
    <script src="<?php echo e(asset("plugins/jquery/dropzone.js")); ?>"></script>
    <script src="<?php echo e(asset("js/uploadFile/uploadFileProduction.js")); ?>"></script>

    <script src="<?php echo e(asset("/plugins/bootstrap/moment.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepicker.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>