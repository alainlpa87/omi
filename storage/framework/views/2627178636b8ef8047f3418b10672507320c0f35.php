
<?php $__env->startSection('title'); ?>
    Lead View
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/lead.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    <?php if($est = ['CT','DE','DC','FL','KY','GA','IN','ME','MD','MA','MI','NH','NJ','NY','NC','OH','PA','RI','SC','VT','VA','WV']): ?><?php endif; ?>
    <?php if($cst = ['AL','AR','IA','KS','IL','LA','MN','MS','MO','NE','ND','OK','SD','TN','TX','WI']): ?><?php endif; ?>
    <?php if($mst = ['AZ','ID','MT','NM','UT','WY']): ?><?php endif; ?>
    <?php if($pst = ['CA','OR','WA','NV']): ?><?php endif; ?>
    <?php if($mdt = ['CO']): ?><?php endif; ?>
    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.loadingModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-default btnConnect padding5" id="btnConnect"><i class="fa fa-cogs"></i> <?php echo e(CONNECT); ?></button>
                    </div>
                    <div class="col-md-12 col-xs-8 noPadding">
                        <input type="text" class="editableval inputCurrentPhone" id="inputCurrentPhone" placeholder="Phone" />
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
                    <?php if(strpos(Session::get('user_type'), 'incubator') === false): ?>
                        <div class="col-md-12 col-xs-3 noPadding">
                            <select class="selectSendEmail" id="selectSendEmail">
                                <option value="0"><?php echo e(SELECT_EMAIL); ?></option>
                                <option value="submissionKit"><?php echo e(SUBMISSION_KIT); ?></option>
                                <option value="emailConsInfo"><?php echo e(CONSULTANT_INFO); ?></option>
                                <option value="tryingToReachYou"><?php echo e(TRYING_TO_REACH); ?></option>
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
                        <div class="col-md-12 col-xs-6 noPadding">
                            <select class="selectSendEmail" id="selectSendSms">
                                <option value="0"><?php echo e(SELECT_SEND_OPTION); ?></option>
                                <option value="sendMsg"><?php echo e(SEND_MSG); ?></option>
                            </select>
                        </div>
                        <div class="col-md-12 col-xs-2 noPadding">
                            <button class="btn btn-default createLeadBtn padding5" id="createLeadBtn"><i class="fa fa-plus"></i> <?php echo e(LIVE_CALL_REQUEST); ?></button>
                        </div>
                        <div class="col-md-12 col-xs-2 noPadding">
                            <button class="pull-right col-md-12 col-xs-1 btn btn-default padding5" id="needMoreLeads"><i class="fa fa-plus"></i>    <?php echo e(MORE_LEADS); ?></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <h4 class="totalLeads">Total Leads: <?php echo e(count($leads)); ?></h4>
                <div class="col-md-12 col-xs-4">
                    <input type="text" id="inputRestDays" class="editableval inputRestDays" placeholder="0" value="0">
                    <button class="btn btn-default padding5 btnRestDays" id="btnRestDays" data-active="0"><i class="fa fa-search-plus"></i> <?php echo e(REST_DAYS); ?></button>
                </div>
                <div class="col-md-12 col-xs-6">
                    <input type="text" class="editableval" id="whoString" placeholder="FIND LEAD" style="width: <?php echo e(WHO_IS_WIDTH); ?>px;">
                </div>
                <div class="col-md-12 col-xs-12 container-callers"></div>
                <div class="clear"></div>
                <h5 class="last15Title">Last 15 leads</h5>
                <div class="col-md-12 col-xs-12 container-last"></div>
            </div>
            
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('intranet.lead.lead', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <?php echo $__env->make('intranet.tools.appointmentModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.lead.tools.whoIsThisModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.sendArticleModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.settingsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.lead.tools.createLeadModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.project.tools.sendTextModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/lead.js")); ?>"></script>
    <script src="<?php echo e(asset("js/plivo.js")); ?>"></script>
    <script src="<?php echo e(asset("js/email.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>