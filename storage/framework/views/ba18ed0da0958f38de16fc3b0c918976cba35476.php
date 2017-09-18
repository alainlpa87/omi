
<?php $__env->startSection('title'); ?>
    Projects View
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.loadingModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12 col-xs-2 noPadding">
                        <button class="btn btn-default btnConnect padding5" id="btnConnect"><i class="fa fa-cogs"></i> <?php echo e(CONNECT); ?></button>
                    </div>
                    <div class="col-md-12 col-xs-8

                     noPadding">
                        <input type="text" class="editableval inputCurrentPhone" id="inputCurrentPhone" placeholder="Phone"/>
                    </div>
                    <?php if($consultant->allowRecording == 1): ?>
                    <div class="pull-right col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-danger btnRecordCall padding5" id="btnRecordCall"><i class="fa fa-microphone"></i> <?php echo e(RECORD_CALL); ?></button>
                    </div>
                    <?php endif; ?>
                    <div class="pull-right col-md-6 col-xs-1 noPadding">
                        <button class="btn btn-default btnHangUp padding5" id="btnHangUp"><?php echo e(HANG_UP); ?></button>
                    </div>
                    <div class="pull-right col-md-6 col-xs-1 noPadding">
                        <button class="btn btn-success btnDial padding5" id="btnDial"><i class="fa fa-phone"></i> <?php echo e(DIAL); ?></button>
                    </div>
                    <div class="col-xs-1 extraDiv"></div>
                    <div class="col-md-6 col-xs-3 noPadding">
                        <select class="selectSendText" id="selectSendText">
                            <option value="1">INFO</option>
                            <option value="2">SCREEN</option>
                            <option value="3">CALL</option>
                            <option value="4">MISSED</option>
                            <option value="159">OPTIONS</option>
                            <option value="217">SCAMS</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-1 noPadding">
                        <button class="btn btn-default btnSendText padding5" id="btnSendTextLead"><i class="fa fa-mobile"></i> <?php echo e(SEND_TEXT); ?></button>
                    </div>
                    <div class="col-md-6 col-xs-3 noPadding">
                        <select class="selectLeaveVM" id="selectLeaveVM">
                            <?php $__currentLoopData = $voiceMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vm->id); ?>"><?php echo e($vm->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-1 noPadding">
                        <button class="btn btn-default btnLeaveVM padding5" id="btnLeaveVM"><i class="fa fa-volume-down"></i> <?php echo e(LEAVE_VM); ?></button>
                    </div>
                    <div class="col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-default btnAppointment padding5" id="btnAppointment"><i class="fa fa-calendar"></i> <?php echo e(APPOINTMENT); ?></button>
                    </div>
                    <div class="col-md-12 col-xs-6 noPadding">
                        <select class="script" id="scriptToReed">
                            <option value="0">--SCRIPT--</option>
                            <option value="/UPLOADEDFILES/scriptText1.pdf">Lead Call with Concept Review</option>
                            <option value="/UPLOADEDFILES/scriptText4.pdf">Overcoming Objections</option>
                            <option value="/UPLOADEDFILES/scriptText2.pdf">Contract Presentation and Close</option>
                            <option value="/UPLOADEDFILES/scriptText3.pdf">Do or Die Voicemail</option>
                        </select>
                    </div>
                    <div class="col-md-12 col-xs-6 noPadding">
                        <select class="selectSendEmail" id="selectSendEmailProject">
                            <option value="0"><?php echo e(SELECT_SEND_OPTION); ?></option>
                            <option value="JVA">JVA</option>
                            
                            <option value="sendMsg"><?php echo e(SEND_MSG); ?></option>
                        </select>
                    </div>
                    <div class="col-md-12 col-xs-7 noPadding">
                        <select class="selectSendArticle" id="selectSendArticle">
                            <option value="0"><?php echo e(SELECT_ARTICLE); ?></option>
                            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($article->id); ?>" title="<?php echo e($article->title); ?>"><?php echo e(strlen($article->title)>25?substr($article->title,0,23).'...':$article->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-default btnContractActions padding5" id="btnContractActions"><i class="fa fa-gavel"></i> <?php echo e(CONTRACT_ACTIONS); ?></button>
                    </div>
                    <div class="col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-default btnContractActions padding5" id="btnSetPayment"><i class="fa fa-money"></i> <?php echo e(PROJECT_SET_PAYMENT); ?></button>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <h4 class="totalProjects">Total Projects: <?php echo e(count($projects)); ?></h4>
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: <?php echo e(WHO_IS_WIDTH); ?>px;">
                </div>
                <div class="col-md-12 col-xs-12 container-callers"></div>
                <div class="clear"></div>
                <h5 class="last15Title">Last 15 projects</h5>
                <div class="col-md-12 col-xs-12 container-last"></div>
            </div>

            
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 boxFixedTop">
                <div id="paginator"></div>
                <div class="container-stages-href">
                    <button class="btn btn-default goToProjectStage" data-stage="SUBMISSIONS">SUBMISSIONS</button>
                    <button class="btn btn-default goToProjectStage" data-stage="CONCEPT">CONCEPT</button>
                    <button class="btn btn-default goToProjectStage" data-stage="PREP">PREP</button>
                    <button class="btn btn-default goToProjectStage" data-stage="CONTRACT">CONTRACT</button>
                    <button class="btn btn-default goToProjectStage" data-stage="WOM">WOM</button>
                    <button class="btn btn-default goToProjectStage" data-stage="WALKTHRU">WALKTHRU</button>
                    <button class="btn btn-default goToProjectStage" data-stage="PHASE2">PHASE2</button>
                    
                </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets marginContainer">
                <div class="container-submissions">
                    <a name="SUBMISSIONS" id="SUBMISSIONSSC"></a>
                    <h5 class="h5Stage" id="stageTitleSubmissions">----SUBMISSIONS---</h5>
                    <?php if($projects_review = $projects->where('stage','SUBMISSIONS')): ?><?php endif; ?>
                    <?php $__currentLoopData = $projects_review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('intranet.project.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($projects_empty = $projects->where('stage','')): ?><?php endif; ?>
                    <?php $__currentLoopData = $projects_empty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('intranet.project.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                </div>
                <div class="container-concept">
                    <a name="CONCEPT" id="CONCEPTSC"></a>
                    <h5 class="h5Stage" id="stageTitleConcept">----CONCEPT---</h5>
                    <?php if($projects_concept = $projects->where('stage','CONCEPT')): ?><?php endif; ?>
                    <?php $__currentLoopData = $projects_concept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('intranet.project.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                </div>
                <div class="container-prep">
                    <a name="PREP" id="PREPSC"></a>
                    <h5 class="h5Stage" id="stageTitlePrep">----PREP---</h5>
                    <?php if($projects_prep = $projects->where('stage','PREP')): ?><?php endif; ?>
                    <?php $__currentLoopData = $projects_prep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('intranet.project.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                </div>
                <div class="container-contract">
                    <a name="CONTRACT" id="CONTRACTSC"></a>
                    <h5 class="h5Stage" id="stageTitleContract">----CONTRACT---</h5>
                    <?php if($projects_contract = $projects->where('stage','CONTRACT')): ?><?php endif; ?>
                    <?php $__currentLoopData = $projects_contract; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('intranet.project.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                </div>
                <div class="container-wom">
                    <a name="WOM" id="WOMSC"></a>
                    <h5  class="h5Stage" id="stageTitleWom">----WOM---</h5>
                    <?php if($projects_wom = $projects->where('stage','WOM')): ?><?php endif; ?>
                    <?php $__currentLoopData = $projects_wom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('intranet.project.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                </div>
                <div class="container-walkthru">
                    <a name="WALKTHRU" id="WALKTHRUSC"></a>
                    <h5 class="h5Stage" id="stageTitleWalkthru">----WALKTHRU---</h5>
                    <?php if($projects_walkthru = $projects->where('stage','WALKTHRU')): ?><?php endif; ?>
                    <?php $__currentLoopData = $projects_walkthru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('intranet.project.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                </div>
                <div class="container-phase2">
                    <a name="PHASE2" id="PHASE2SC"></a>
                    <h5 class="h5Stage" id="stageTitlePhase2">---PHASE2---</h5>
                    <?php if($projects_phase2 = $projects->where('stage','PHASE2')): ?><?php endif; ?>
                    <?php $__currentLoopData = $projects_phase2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('intranet.project.portlet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="clear"></div>
                </div>
                <div class="container-archive"></div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found marginContainer" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
        </div>
    </div>

    
    <?php echo $__env->make('intranet.tools.appointmentModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.project.tools.sendTextModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.project.tools.resetPasswordModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.sendArticleModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.settingsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.project.tools.filesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.project.tools.contractActionsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.project.tools.setPaymentProjectModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.project.tools.setPPAProjectModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.project.tools.setStageAndDateModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.project.tools.shareNoteModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('intranet.tools.iframePrint', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/project.js")); ?>"></script>
    <script src="<?php echo e(asset("js/plivo.js")); ?>"></script>
    <script src="<?php echo e(asset("js/email.js")); ?>"></script>

    <script src="<?php echo e(asset("/plugins/bootstrap/moment.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepicker.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>