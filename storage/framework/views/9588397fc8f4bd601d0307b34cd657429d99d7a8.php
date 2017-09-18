
<?php $__env->startSection('title'); ?>
    ILC View
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/admin.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/uploadFile.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/clientServices.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.loadingModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid">
        <input type="hidden" data-pending="<?php echo e($pending); ?>" id="pending_ilc">
        <div class="row">
            
                
            

            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12 divSelectOptionAdmin">
                    <select  id="selectOptionILC" style="width: 170px;">
                        <option value="0"><?php echo e(SELECT_ACTION); ?></option>
                        <option value="intro_pkg">SEND WELCOME PCKG</option>
                        <option value="intro_call_email">INTRO CALL EMAIL</option>
                        <option value="courtesy">SEND COURTESY UPDATE</option>
                        <option value="nda_to_manf">SEND ILC NDA TO MANF</option>
                        <option value="nda_to_client">SEND MANF NDA TO CT</option>
                        <option value="submission">SEND SUBMISSION TO MANF</option>
                        <option value="decline_email">CT REFUSES MANF NDA</option>
                        <option value="after_graphic"> AFTER GRAPHIC IS SENT TO VENDOR</option>
                        <option value="patented_contract">SEND ILC PATENTED CONTRACT</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <select  id="selectSeparationLetter" style="width: 170px;margin-top: 15px;">
                        <option value="0">SEPARATION_LETTER</option>
                        <option value="abandoned">SEND UTILITY ABANDONED LETTER</option>
                        <option value="client_request">SEND CLIENT REQUEST LETTER</option>
                        <option value="provisional">SEND PROVISIONAL LETTER</option>
                        <option value="utility">SEND UTILITY LETTER</option>
                    </select>
                </div>
                <div class="col-md-12 divNDAActions" style="margin-top: 15px;">
                    <button class="btn btn-primary" id="openNDAAction">NDA ACTIONS</button>
                </div>
                <div class="col-md-12" style="margin-top: 15px;">
                    <button class="btn btn-primary" id="emToCTBtn">SEND EMAIL TO CLIENT</button>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <button class="btn btn-primary" id="showPendingIntroCall">TODAY NOTIFICACION'S</button>
                </div>
            </div>

            
            <div class="col-md-10 col-xs-12 col-lg-10 container-table">
                
                    
                    
                
                    <div class="table-scrollable" style="width: 100% !important;">
                        <table id="tableDataIlc" class="table table-striped table-bordered" cellspacing="0" >
                            <thead id="tableDataHeadIlc">
                            <tr>
                                <td align="center"><strong style="cursor:pointer;"> <span class="label label-sm label-info" title=""></span></strong></td>
                                <td align="center"><strong style="cursor:pointer;"><span class="label label-sm label-info" title="">FILENO</span></strong></td>
                                <td align="center"><strong style="cursor:pointer;">CLIENT NAME</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> COORDINATOR</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> PATENT STATUS</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> IDEA NAME</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> PPA TYPE</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> INDUSTRY</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> APP NO</strong></td>
                                <td align="center" class="hidden"><strong> MANUFACTURERS</strong></td>
                                <td align="center" class="hidden"><strong> TRADE SHOWS CALL</strong></td>
                                <td align="center" class="hidden"><strong> PHONE</strong></td>
                            </tr>
                            </thead>
                            <tbody id="tableDataBodyIlc">
                            <?php for($i=0;$i<count($projectsILC);$i++): ?>
                                <tr class="rd" id="rowIlc_<?php echo e($projectsILC[$i]->id); ?>">
                                    <td align="center">
                                        <input type="checkbox" class="selectIlc pull-left" id="selectIlc_<?php echo e($projectsILC[$i]->id); ?>" data-id="<?php echo e($projectsILC[$i]->projectclientservices->project->id); ?>" data-iid="<?php echo e($projectsILC[$i]->id); ?>">
                                    </td>
                                    <td align="center">
                                        <span id="ilc_FileNo_<?php echo e($projectsILC[$i]->id); ?>"><span data-id="<?php echo e($projectsILC[$i]->id); ?>" data-pid="<?php echo e($projectsILC[$i]->projectclientservices->project->id); ?>" class="openIlcPortlet" style="text-decoration: underline;color: #0000CC;cursor: pointer;"><?php echo e(($projectsILC[$i]->fileno)); ?></span></span>
                                    </td>
                                    <td align="center">
                                        <span id="ilc_clientName_<?php echo e($projectsILC[$i]->id); ?>"> <?php echo e(ucwords($projectsILC[$i]->invFname." ".$projectsILC[$i]->invLname)); ?></span>
                                    </td>
                                    <td align="center">
                                       <span id="ilc_coordinator_<?php echo e($projectsILC[$i]->id); ?>" style="cursor: pointer;color: blue;" class="selCoord" data-iid="<?php echo e($projectsILC[$i]->id); ?>" data-val="<?php echo e($projectsILC[$i]->coordinator); ?>"><?php if($projectsILC[$i]->coordinator!=''): ?><?php echo e($projectsILC[$i]->coordinator); ?><?php else: ?> - <?php endif; ?></span>
                                    </td>
                                    <td align="center">
                                        <span id="ilc_patentStatus_<?php echo e($projectsILC[$i]->id); ?>" style="cursor: pointer;color: blue;" class="selPStatus" data-iid="<?php echo e($projectsILC[$i]->id); ?>" data-pid="<?php echo e($projectsILC[$i]->projectclientservices->project->id); ?>" data-val="<?php echo e($projectsILC[$i]->patent_status); ?>"><?php if($projectsILC[$i]->patent_status!=''): ?><?php echo e($projectsILC[$i]->patent_status); ?><?php else: ?> Select Patent Status <?php endif; ?> </span>
                                    </td>
                                    <td align="center">
                                        <span id="ilc_ideaName_<?php echo e($projectsILC[$i]->id); ?>"> <?php echo e($projectsILC[$i]->inventionName); ?></span>
                                    </td>
                                    <td align="center">
                                        <span id="ilc_ppaType_<?php echo e($projectsILC[$i]->id); ?>">
                                            <?php if($projectsILC[$i]->projectclientservices->hasType("D")): ?>
                                                Utilt & Design
                                            <?php elseif($projectsILC[$i]->projectclientservices->hasType("UT") || $projectsILC[$i]->projectclientservices->hasType("UPG_UT")): ?>
                                                Utility
                                            <?php elseif($projectsILC[$i]->projectclientservices->hasType("PROV")): ?>
                                                <?php if($projectsILC[$i]->projectclientservices->project->utility == 'IMG'): ?>
                                                    Provisional IMG
                                                <?php else: ?>
                                                    Provisional
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                    <td align="center" id="indType_<?php echo e($projectsILC[$i]->id); ?>">
                                        <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($projectsILC[$i]->industry_id == $industry->id): ?>
                                                <span> <?php echo e($industry->type); ?> </span>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td align="center">
                                        <span id="ilc_appNo_<?php echo e($projectsILC[$i]->id); ?>"><?php echo e($projectsILC[$i]->projectclientservices->patentAppNo); ?> </span>
                                    </td>
                                    <td class="hidden" id="manufacturersList_<?php echo e($projectsILC[$i]->id); ?>">
                                        <?php $__currentLoopData = $projectsILC[$i]->manufacturers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span ><?php echo e($manufacturer->name); ?> </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td class="hidden" id="tradeshowsCall_<?php echo e($projectsILC[$i]->id); ?>">
                                        <?php if($projectsILC[$i]->callTradeshow == 1): ?>
                                            <span>Trade Shows Call</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="hidden" id="tradeshowsCall_<?php echo e($projectsILC[$i]->id); ?>">
                                        <span><?php echo e($projectsILC[$i]->phone); ?></span>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('intranet.tools.iframePrint', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.UploadFileModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.ILCFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.whoIsThisModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.ilcCodesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.ilcNotesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.ndaTextModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.submissionEmailModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.ilcPortletModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.courtesyModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.declineEmailModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.ndaActionsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.selectCoordinatorModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.selectPatentStatusModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.emailILCModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.afterGraphicModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.introCallEmailModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.patentedContractEmailModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.ilcVendorModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.filesBackToVendorModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/ilc.js")); ?>"></script>
    
    <script src="<?php echo e(asset("plugins/jquery/dropzone.js")); ?>"></script>
    <script src="<?php echo e(asset("js/uploadFile/uploadFileILC.js")); ?>"></script>

    <script src="<?php echo e(asset("/plugins/bootstrap/moment.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepicker.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/jquery.dataTables.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.buttons.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/buttons.print.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>