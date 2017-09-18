
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


    <div class="cs_docs_without_sign_hide">
        <?php $__currentLoopData = $pendingPCTEPO; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="docs_without_sing" data-fileno ="<?php echo e($pending->fileno); ?>" data-pin="<?php echo e($pending->project_id); ?>" data-clientfn="<?php echo e($pending->project->lead->fname); ?>" data-clientln="<?php echo e($pending->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="cs_prov_hide">
        <?php $__currentLoopData = $pendingPROV; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="prov_to_expire" data-fileno ="<?php echo e($prov->fileno); ?>" data-pin="<?php echo e($prov->project_id); ?>" data-clientfn="<?php echo e($prov->project->lead->fname); ?>" data-clientln="<?php echo e($prov->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="we_followup_hide">
        <?php $__currentLoopData = $pendingEmailFollowUp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $we): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="we_followup" data-fileno ="<?php echo e($we->fileno); ?>" data-pin="<?php echo e($we->project_id); ?>" data-clientfn="<?php echo e($we->project->lead->fname); ?>" data-clientln="<?php echo e($we->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="pa_followup_hide">
        <?php $__currentLoopData = $pendingPtntAppFollowUp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="pa_followup" data-fileno ="<?php echo e($pa->fileno); ?>" data-pin="<?php echo e($pa->project_id); ?>" data-clientfn="<?php echo e($pa->project->lead->fname); ?>" data-clientln="<?php echo e($pa->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="tm_reminder_hide">
        <?php $__currentLoopData = $pendingPtntAppTM; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="tm_reminder" data-fileno ="<?php echo e($pcs->fileno); ?>" data-pin="<?php echo e($pcs->project_id); ?>" data-clientfn="<?php echo e($pcs->project->lead->fname); ?>" data-clientln="<?php echo e($pcs->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="cr_reminder_hide">
        <?php $__currentLoopData = $pendingPtntAppCR; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="cr_reminder" data-fileno ="<?php echo e($pcs->fileno); ?>" data-pin="<?php echo e($pcs->project_id); ?>" data-clientfn="<?php echo e($pcs->project->lead->fname); ?>" data-clientln="<?php echo e($pcs->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="upEm_reminder_hide">
        <?php $__currentLoopData = $pendingUpdEmail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="updEm_reminder" data-fileno ="<?php echo e($pcs->fileno); ?>" data-pin="<?php echo e($pcs->project_id); ?>" data-clientfn="<?php echo e($pcs->project->lead->fname); ?>" data-clientln="<?php echo e($pcs->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="expUt_reminder_hide">
        <?php $__currentLoopData = $pendingUtilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="expUt_reminder" data-pcsid="<?php echo e($pcs->id); ?>" data-fileno ="<?php echo e($pcs->fileno); ?>" data-pin="<?php echo e($pcs->project_id); ?>" data-clientfn="<?php echo e($pcs->project->lead->fname); ?>" data-clientln="<?php echo e($pcs->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="9months_follow_call_hide">
        <?php $__currentLoopData = $Months9FollowCall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $followCall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="9m_follow_call" data-fileno ="<?php echo e($followCall->fileno); ?>" data-pin="<?php echo e($followCall->project_id); ?>" data-clientfn="<?php echo e($followCall->project->lead->fname); ?>" data-clientln="<?php echo e($followCall->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="app_delay_hide">
        <?php $__currentLoopData = $pendingLateApp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appDelay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" class="app_delay" data-pcsid="<?php echo e($appDelay->id); ?>" data-fileno ="<?php echo e($appDelay->fileno); ?>" data-pin="<?php echo e($appDelay->project_id); ?>" data-clientfn="<?php echo e($appDelay->project->lead->fname); ?>" data-clientln="<?php echo e($appDelay->project->lead->lname); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php if(count($pendingPCTEPO)>0): ?>
    <div id="DocsWithOutSignModal"  aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                    <h5>SUBMISSIONS WITH MORE THAN 6 MONTHS WITHOUT SIGN PCT or EPO:</h5>
                </div>
                <div class="modal-body">
                    <div class="container-docs">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(count($pendingPROV)>0): ?>
    <div id="ProvWithOutSignModal"  aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bubble" style="padding-top:1px !important;height: 30px !important;">
                    <h5>SUBMISSIONS PROV THAT EXPIRES IN 3 MONTHS :</h5>
                </div>
                <div class="modal-body">
                    <div class="container-prov">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(count($pendingUpdEmail)>0): ?>
        <div id="updateEmailModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>Email Update Utility after 1 Year:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-updEm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(count($pendingUtilities)>0): ?>
        <div id="expiredUtModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>Utilities expired:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-expUt">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(count($pendingPtntAppTM)>0): ?>
        <div id="pendingTMModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TRADEMARK QUESTIONNAIRE WITHOUT SIGNATURE:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-tm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(count($pendingPtntAppCR)>0): ?>
        <div id="pendingCRModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>COPYRIGHT QUESTIONNAIRE WITHOUT SIGNATURE:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-cr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(count($pendingEmailFollowUp)>0): ?>
        <div id="CallFollowUpModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TODAY WELCOME EMAIL FOLLOW UP CALL:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-we">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(count($pendingPtntAppFollowUp)>0): ?>
        <div id="FollowUpModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TODAY PATENT APP FOLLOW UP WITH INVENTOR:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-pa">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(count($Months9FollowCall)>0): ?>
        <div id="CallFollow9MonthsModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TODAY 9 MONTHS FOLLOW UP CALL:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-9m">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(count($pendingLateApp)>0): ?>
        <div id="AppDelayModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TODAY 91 DAYS SINCE DOCUMENTS WAS SENT TO ATTORNEY:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-appDelay">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php echo $__env->make('intranet.tools.updateEmailSelectFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    
    
    <script src="<?php echo e(asset("js/alertNoSign.js")); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>