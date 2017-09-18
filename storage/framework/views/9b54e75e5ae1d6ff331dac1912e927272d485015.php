
<?php $__env->startSection('title','Legal View'); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/vendor.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if($search =0): ?><?php endif; ?>
    <div class="container-fluid">
        <input type="hidden" data-email="<?php echo e($consultant->email); ?>" id="vendor_email">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="panel-heading backBlue">
                    <a  href="<?php echo e(url('reportAttVendors?ATT='.$consultant->id)); ?>" target="_blank" class="actionQuestions">
                        <p class="boxAttorney" style="color: #ffffff">
                            Monthly Report
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSubAttCS" placeholder="FIND SUB" style="width: <?php echo e(WHO_IS_WIDTH); ?>px;">
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <button class="btn btn-primary" id="emToCSBtn">SEND EMAIL TO PSU</button>
                </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
            
            <?php if($newCRAndTM != ""): ?>
                <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-newTmandCR">
                    <p><b>We have sent you new TM or CR forms. Please read and confirm that the forms are complete within 7 days. If they are not complete, please deny and state what is missing. Thank you.</b></p>
                    <?php $__currentLoopData = $newCRAndTM; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectN): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($project = $projectN->projectclientservices->project): ?><?php endif; ?>
                            <div class="portlet col-md-12 portlet-new" id="container_<?php echo e($projectN->id); ?>"  style="height: 40px" data-id = "<?php echo e($project->id); ?>" data-request-id="<?php echo e($project->id); ?>">
                                <div class="box call">
                                    <div class="portlet-title">
                                        <div class="indicator caption" style="z-index: 100;width: 93%;" data-id="<?php echo e($project->id); ?>" data-aid="<?php echo e($projectN->id); ?>">
                                            NEW <?php echo e($projectN->type); ?> - <?php echo e($project->lead->fileno); ?>

                                            <a target="_blank" href="<?php echo e(asset('/files/projects/'.$project->lead->fileno.'/'.$project->id.'/'.($projectN->type == 'TM'?'trademarkCoverSheet.pdf':'copyRightCoverSheet.pdf'))); ?>" style="margin-left: 20%">FILE INFO <i class="fa fa-file-pdf-o"></i></a>
                                            <span class="rejectTandCR" data-id="<?php echo e($projectN->id); ?>" style="float: right;margin-left: 5%" title="REJECT">
                                                <i class="fa fa-thumbs-down fa-2x red"></i>
                                            </span>
                                            <span class="approveTandCR" data-id="<?php echo e($projectN->id); ?>" style="float: right;" title="APPROVE">
                                                <i class="fa fa-thumbs-up fa-2x green"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="groupProjects">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseNewAttCS" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        New Applications
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseNewAttCS" class="panel-collapse collapse <?php echo e(count($projectsNew)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-new">
                                        <?php $__currentLoopData = $projectsNew; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectN): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($project = $projectN->projectclientservices->project): ?><?php endif; ?>
                                            <?php echo $__env->make('intranet.attorneyClientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTMandCR" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        CR AND TM
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseTMandCR" class="panel-collapse collapse <?php echo e(count($tmAndCr)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-new">
                                        <?php $__currentLoopData = $tmAndCr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectN): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($project = $projectN->projectclientservices->project): ?><?php endif; ?>
                                            <?php echo $__env->make('intranet.attorneyClientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseReturnedAttCS" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        Revision Due
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseReturnedAttCS" class="panel-collapse collapse <?php echo e(count($projectsReturned)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-returned">
                                        <?php $__currentLoopData = $projectsReturned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectN): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($project = $projectN->projectclientservices->project): ?><?php endif; ?>
                                            <?php echo $__env->make('intranet.attorneyClientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseAppAprovedAttCS">
                                    <h4 class="panel-title titleContainers">
                                        Patent Applications Pending Filing
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseAppAprovedAttCS" class="panel-collapse collapse <?php echo e(count($projectAppAprvd)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-overdue">
                                        <?php $__currentLoopData = $projectAppAprvd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectN): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($project = $projectN->projectclientservices->project): ?><?php endif; ?>
                                            <?php echo $__env->make('intranet.attorneyClientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOverdueAttCS">
                                    <h4 class="panel-title titleContainers">
                                        Past Due Drafting Applications
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseOverdueAttCS" class="panel-collapse collapse <?php echo e(count($projectsLate)>0?"in":""); ?>">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-overdue">
                                        <?php $__currentLoopData = $projectsLate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectN): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($project = $projectN->projectclientservices->project): ?><?php endif; ?>
                                            <?php echo $__env->make('intranet.attorneyClientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php echo $__env->make('intranet.tools.iframePrint', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.attCSFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.attorneyClientServices.tools.attRejectCRorTMNotesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.attorneyClientServices.tools.finishAttModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.emailToPSUFromVendorsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.UploadFileModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("plugins/jquery/dropzone.js")); ?>"></script>
    <script src="<?php echo e(asset("js/uploadFile/uploadFileAttCS.js")); ?>"></script>
    <script src="<?php echo e(asset("js/attClientServices.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>