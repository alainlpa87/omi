
<?php $__env->startSection('title'); ?>
    Client Services View
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/clientServices.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/uploadFile.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.loadingModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.admin.tools.adminLoadingModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <a href="<?php echo e(url('files/omi/Online_Tutorial.pdf')); ?>"  target="_blank">Vendor Dialer Tutorial</a>
                <br>
                <a href="<?php echo e(url('files/omi/Client_Services_Tutorial.pdf')); ?>"  target="_blank">Client Services Tutorial</a>
                <br><br><br>
                <div class="panel-group" id="accordionAtt">
                    <?php $__currentLoopData = $arrayAtt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordionAtt" href="#collapseAtt_<?php echo e($att['user']); ?>">
                                    <h4 style="color: white;"><?php echo e($att['attorneyName']); ?></h4>
                                </a>
                            </div>
                            <div id="collapseAtt_<?php echo e($att['user']); ?>" class="panel-collapse collapse">
                                <div class="panel-body borderBlue">
                                    <a  href="<?php echo e(url('reportAtt?ATT='.$att['aid'])); ?>" target="_blank" class="actionQuestions">
                                        <p class="boxAttorney">
                                            Total projects sent: <span><?php echo e($att['total']); ?></span><br>
                                            Prov sent: <span><?php echo e($att['countProv']); ?></span><br>
                                            Utility sent: <span><?php echo e($att['countU']); ?></span><br>
                                            Design sent: <span><?php echo e($att['countU_D']); ?></span><br>
                                            Details :
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-md-12 col-xs-1 noPadding">
                    <button class="btn btn-default btnAppointment padding5" id="btnAppointment"><i class="fa fa-calendar"></i> Create New Task</button>
                </div>
                <div class="col-md-12 col-xs-1 noPadding">
                    <button class="btn btn-primary showTicketsView" id="showTicketsAdmin">MANAGE TICKETS</button>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: <?php echo e(WHO_IS_WIDTH); ?>px;">
                </div>
                <br><br><br><br>
                <div class="col-md-12 divSelectOptionAdmin">
                    <select  id="selectOptionClientS" style="width: 170px;">
                        <option value="0"><?php echo e(SELECT_ACTION); ?></option>
                        <option value="ttry">WE TRY TO REACH YOU</option>
                        <option value="tm-letter">SEND TRADEMARK LETTER</option>
                        <option value="ATT_COVERSHEET">SEND COVERSHEET TO ATTORNEY</option>
                        <option value="UPG_COVERSHEET">SEND UPGRADE COVERSHEET TO ATTORNEY</option>
                        <option value="ILC_COVERSHEET">SEND ILC COVERSHEET</option>
                        <option value="TM_COVERSHEET">SEND TRADEMARK COVERSHEET</option>
                        <option value="RESEND_TM_COVERSHEET" style="background: #fdd49a;">RE-SEND TRADEMARK COVERSHEET</option>
                        <option value="CR_COVERSHEET">SEND COPYRIGHT COVERSHEET</option>
                        <option value="RESEND_CR_COVERSHEET" style="background: #fdd49a;">RE-SEND COPYRIGHT COVERSHEET</option>
                        <option value="TR_ALLOWANCE">SEND TRADEMARK NOTICE OF ALLOWANCE</option>
                        <option value="TR_OFFICE_ACTION">SEND TRADEMARK OFFICE ACTION</option>
                        <option value="NON_F_OFFICE_ACTION">SEND NON FINAL OFFICE ACTION</option>
                        <option value="F_OFFICE_ACTION">SEND FINAL OFFICE ACTION</option>
                        <option value="NOTICE_OF_ALLOWANCE">SEND NOTICE OF ALLOWANCE(PATENT)</option>
                        
                        <option value="PCT_EPO_TOATT">SEND PCT OR EPO TO ATT</option>
                        <option value="pct-quest">SEND PCT APPLICATION</option>
                        
                        <option value="PCT_APP">SEND PCT FILING RECEIPT</option>
                        <option value="REVISION_ATT">SEND REVISION TO ATTORNEY</option>
                        <option value="EMAIL_CLIENT">SEND EMAIL TO CLIENT</option>
                        <option value="EMAIL_VENDOR">SEND EMAIL TO VENDOR</option>
                    </select>
                </div>
                <div class="clear"></div>
                <h5 class="last15Title">Last 15</h5>
                <div class="col-md-12 col-xs-12 container-last"></div>
            </div>

            
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePhase1">
                                <h4 class="panel-title titleContainers">
                                    Phase 1 - INTAKE
                                </h4>
                            </a>
                        </div>
                        <div id="collapsePhase1" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-phase1">
                                    <?php if($projectsPCS = $allPCS->where('phase',0)): ?><?php endif; ?>
                                    <?php $__currentLoopData = $projectsPCS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectClientS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($project = $projectClientS->project): ?><?php endif; ?>
                                        <?php echo $__env->make('intranet.clientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePhase2">
                                <h4 class="panel-title titleContainers">
                                    Phase 2 - DRAFTING
                                </h4>
                            </a>
                        </div>
                        <div id="collapsePhase2" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-phase2">
                                    <?php if($projectsPCS = $allPCS->where('phase',1)): ?><?php endif; ?>
                                    <?php $__currentLoopData = $projectsPCS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectClientS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($project = $projectClientS->project): ?><?php endif; ?>
                                        <?php echo $__env->make('intranet.clientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePhase3">
                                <h4 class="panel-title titleContainers">
                                    Phase 3 - REVIEW & APPROVAL
                                </h4>
                            </a>
                        </div>
                        <div id="collapsePhase3" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-phase3">
                                    <?php if($projectsPCS = $allPCS->where('phase',2)): ?><?php endif; ?>
                                    <?php $__currentLoopData = $projectsPCS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectClientS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($project = $projectClientS->project): ?><?php endif; ?>
                                        <?php echo $__env->make('intranet.clientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePhase4">
                                <h4 class="panel-title titleContainers">
                                    Phase 4 - PATENT PENDING
                                </h4>
                            </a>
                        </div>
                        <div id="collapsePhase4" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-phase4">
                                    <?php if($projectsPCS = $allPCS->where('phase',3)): ?><?php endif; ?>
                                    <?php $__currentLoopData = $projectsPCS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectClientS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($project = $projectClientS->project): ?><?php endif; ?>
                                        <?php echo $__env->make('intranet.clientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePhase5">
                                <h4 class="panel-title titleContainers">
                                    Phase 5 - 3D IMAGE (PROV 2D IMG)
                                </h4>
                            </a>
                        </div>
                        <div id="collapsePhase5" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-phase5">
                                    <?php if($projectsPCS = $allPCS->where('phase',4)): ?><?php endif; ?>
                                    <?php $__currentLoopData = $projectsPCS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectClientS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($project = $projectClientS->project): ?><?php endif; ?>
                                        <?php echo $__env->make('intranet.clientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePhase6">
                                <h4 class="panel-title titleContainers">
                                    Phase 6 - 3D MODEL
                                </h4>
                            </a>
                        </div>
                        <div id="collapsePhase6" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-phase6">
                                    <?php if($projectsPCS = $allPCS->where('phase',5)): ?><?php endif; ?>
                                    <?php $__currentLoopData = $projectsPCS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectClientS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($project = $projectClientS->project): ?><?php endif; ?>
                                        <?php echo $__env->make('intranet.clientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePhase7">
                                <h4 class="panel-title titleContainers">
                                    Phase 7 - EXAMINATION
                                </h4>
                            </a>
                        </div>
                        <div id="collapsePhase7" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-phase7">
                                    <?php if($projectsPCS = $allPCS->where('phase',6)): ?><?php endif; ?>
                                    <?php $__currentLoopData = $projectsPCS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectClientS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($project = $projectClientS->project): ?><?php endif; ?>
                                        <?php echo $__env->make('intranet.clientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePhase8">
                                <h4 class="panel-title titleContainers">
                                    Phase 8 - RECOMMENDATIONS
                                </h4>
                            </a>
                        </div>
                        <div id="collapsePhase8" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-phase8">
                                    <?php if($projectsPCS = $allPCS->where('phase',7)): ?><?php endif; ?>
                                    <?php $__currentLoopData = $projectsPCS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectClientS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($project = $projectClientS->project): ?><?php endif; ?>
                                        <?php echo $__env->make('intranet.clientServices.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('intranet.tools.appointmentModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.admin.tools.adminLoadingModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.iframePrint', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.UploadFileModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.clientServicesFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.resendLegalDocsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.whoIsThisModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.reminderPCTEPOModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.csNotesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.filingRFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.legalMaintenanceModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.selectFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('omi.tools.recoverPsswdModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.selectFilesToAttachModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.designCoversheetModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.upgCoversheetToAttModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.clientServices.tools.emailCSModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.emailToVendorsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/clientservices.js")); ?>"></script>
    
    <script src="<?php echo e(asset("plugins/jquery/dropzone.js")); ?>"></script>
    <script src="<?php echo e(asset("js/uploadFile/uploadFileClientServices.js")); ?>"></script>

    <script src="<?php echo e(asset("/plugins/bootstrap/moment.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepicker.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>