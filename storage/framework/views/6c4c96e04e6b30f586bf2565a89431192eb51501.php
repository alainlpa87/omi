
<?php $__env->startSection('title','Patent Services USA'); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/clientServices.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap-datetimepicker.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/css/sign.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(asset('/plugins/docusign/assets/jquery.signaturepad.css')); ?>" rel="stylesheet" type="text/css" >
<?php $__env->stopSection(); ?>
<?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php if($project_CS->existReturned()): ?>
            <div class="row  panel-primary container-legal-docs">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">Returned Documents</h4>
                </div>
                <div class="panel-body">
                    <?php $__currentLoopData = $project_CS->getDocsCS(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docCS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($docCS->notes_resend!=""): ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-light blue-soft"
                                   href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=".$docCS->document."&ID=".$project_CS->project_id)); ?>"
                                   title="Reason: <?php echo e($docCS->notes_resend); ?>"  data-toggle="tooltip" data-placement="bottom"   >
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;"><?php echo e($docCS->name); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if($project_CS->existNoReturned()): ?>
            <div class="row panel-primary container-legal-docs">
                <div class="panel-heading heading-docs"> 
                    <h4 class="modal-title subTitlesCS">Documents</h4>
                </div>
                <div class="panel-body">
                    <?php if($project_CS->getDocsCS()!=null): ?>
                        <?php $__currentLoopData = $project_CS->getDocsCS(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docCS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($docCS->notes_resend=="" && $docCS->belong_PA != 1): ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft"
                                       href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=".$docCS->document."&ID=".$project_CS->project_id)); ?>">
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;"><?php echo e($docCS->name); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if($project_CS->appSent_created_at!="" && $project_CS->completed == 1 && $project_CS->patentAppApproved_created_at == ""): ?>
            <div class="row panel-primary container-legal-docs">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">Patent Application</h4>
                </div>
                <div class="panel-body">
                    <?php if($docs_signed['dec'] == -1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light blue-soft"
                               href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=declaration&ID=".$project_CS->project_id)); ?>">
                                <div class="visual">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <p style="font-size: 80%;">Declaration</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($coInvCount>0 && $docs_signed['add_dec'] == -1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light blue-soft"
                               href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=add_declaration&ID=".$project_CS->project_id)); ?>">
                                <div class="visual">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <p style="font-size: 80%;">Additional Declaration</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($docs_signed['poa'] == -1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light blue-soft"
                               href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=poa&ID=".$project_CS->project_id)); ?>">
                                <div class="visual">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <p style="font-size: 80%;">POA</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($docs_signed['microEntity'] == -1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light blue-soft"
                               href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=microEntity&ID=".$project_CS->project_id)); ?>">
                                <div class="visual">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <p style="font-size: 80%;">Micro Entity</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="border: 1px solid black;padding-left: 0px !important;padding-right: 0px !important;">
                        <a class="dashboard-stat dashboard-stat-light blue-soft"
                           href="<?php echo e($urlPA); ?>" target="_blank">
                            <div class="visual">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <p style="font-size: 70%;">Patent Application</p>
                                </div>
                            </div>
                        </a>
                        <a class="fa fa-check-circle-o fa-3x patent-app-up hvr-grow" aria-hidden="true" data-prop="<?php echo e($allDocsSigned); ?>" data-id="<?php echo e($project_CS->project_id); ?>" href="#"></a>
                        <a class="fa fa-times-circle-o fa-3x patent-app-down pull-right hvr-grow" aria-hidden="true" data-id="<?php echo e($project_CS->project_id); ?>" href="#"></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if($upLetterSign  == 1 || $provInvoiceSign == 1): ?>
            <div class="row panel-primary container-legal-docs">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">PCT/EPO-----------Provisional Invoice</h4>
                </div>
                <div class="panel-body">
                    <?php if($upLetterSign  == 1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light blue-soft"
                               href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=upgradePCTEPO&ID=".$project_CS->project_id)); ?>">
                                <div class="visual">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <p style="font-size: 80%;">PCT/EPO</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($provInvoiceSign  == 1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light blue-soft"
                               href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=provInvoice&ID=".$project_CS->project_id)); ?>">
                                <div class="visual">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <p style="font-size: 80%;">Provisional Invoice</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if($ilcNeedSign == 1): ?>
            <div class="row panel-primary container-legal-docs">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">ILC</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <h5>Release ILC from any obligation</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light blue-soft"
                               href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=ilc&ID=".$project_CS->project_id)); ?>">
                                <div class="visual">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <p style="font-size: 80%;">ILC</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light blue-soft"
                               href="<?php echo e(route('launch_sandbox/clientServices/sign',"DOCUMENT=ilc_release&ID=".$project_CS->project_id)); ?>">
                                <div class="visual">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <p style="font-size: 80%;">Release Form</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("/js/omi/sign.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/docusign/jquery.signaturepad.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/docusign/assets/json2.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('omi.layout.headSandbox', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>