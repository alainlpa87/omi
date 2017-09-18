
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
                        <?php if($docCS->signdate!=""): ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" data-doc = "<?php echo e($docCS->document); ?>" data-id="<?php echo e($project_CS->project_id); ?>"
                                   href="<?php echo e(route('launch/clientServices/sign',"DOCUMENT=".$docCS->document."&ID=".$project_CS->project_id)); ?>"
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
                                <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="doc<?php echo e($docCS->name); ?>" id="doc<?php echo e($docCS->name); ?>">
                                    <input type="hidden" name="DOCUMENT" value="<?php echo e($docCS->document); ?>">
                                    <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#doc<?php echo e($docCS->name); ?>').submit();" >
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
                                </form>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if($project_CS->agreementExt_sent!="0000-00-00 00:00:00" && $project_CS->agreementExt_rcvd == "0000-00-00 00:00:00"): ?>
                        <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="agreementExt" id="agreementExt">
                            <input type="hidden" name="DOCUMENT" value="agreementExtension">
                            <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#agreementExt').submit();" >
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">AGREEMENT EXTENSION</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if($docs_signed['type'] != 'NA'&& $project_CS->completed != 2): ?>
            <div class="row panel-primary container-legal-docs" id="appPack">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">Patent Application</h4>
                </div>
                <div class="panel-body">
                    <?php if($docs_signed['dec'] == -1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docDec" id="docDec">
                                <input type="hidden" name="DOCUMENT"
                                <?php if($docs_signed['type']=='PAU'): ?>
                                       value="declarationU"
                                        <?php elseif($docs_signed['type']=='PAD'): ?>
                                       value="declarationD"
                                        <?php endif; ?>>
                                <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                <a class="dashboard-stat dashboard-stat-light blue-soft"  onclick="$('#docDec').submit();"> 
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">Declaration</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if($coInvCount>0 && $docs_signed['add_dec'] == -1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docAddDec" id="docAddDec">
                                <input type="hidden" name="DOCUMENT"
                                <?php if($docs_signed['type']=='PAU'): ?>
                                       value="addDeclarationU"
                                        <?php elseif($docs_signed['type']=='PAD'): ?>
                                       value="addDeclarationD"
                                       <?php endif; ?>
                                       value="">
                                <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                <a class="dashboard-stat dashboard-stat-light blue-soft"  onclick="$('#docAddDec').submit();"> 
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">Additional Declaration</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if($docs_signed['poa'] == -1): ?>
                        <?php if(!File::exists("files/projects/".$client->fileno."/signature_poa.jpg")): ?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docPOA" id="docPOA">
                                    <input type="hidden" name="DOCUMENT"
                                    <?php if($docs_signed['type']=='PAU'): ?>
                                           value="poaU"
                                            <?php elseif($docs_signed['type']=='PAD'): ?>
                                           value="poaD"
                                           <?php endif; ?>
                                           value="">
                                    <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                    <input type="hidden" name="COINVINDEX" value="0">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPOA').submit();"> 
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">POA</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php for($i=1;$i<$coInvCount+1;$i++): ?> 
                        <?php if(!File::exists("files/projects/".$client->fileno."/signature_poa_coInv".$i.".jpg")): ?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docPOACoInv_<?php echo e($i); ?>" id="docPOACoInv_<?php echo e($i); ?>">
                                    <input type="hidden" name="DOCUMENT"
                                    <?php if($docs_signed['type']=='PAU'): ?>
                                           value="poaU"
                                            <?php elseif($docs_signed['type']=='PAD'): ?>
                                           value="poaD"
                                            <?php endif; ?>>
                                    <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                    <input type="hidden" name="COINVINDEX" value="<?php echo e($i); ?>">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPOACoInv_<?php echo e($i); ?>').submit();"> 
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">POA <?php echo e($coInvs[$i-1]); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php if($docs_signed['microEntity'] == -1): ?>
                        <?php if(!File::exists("files/projects/".$client->fileno."/signature_mE.jpg")): ?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" id="docMEntity">
                                    <input type="hidden" name="DOCUMENT"
                                    <?php if($docs_signed['type']=='PAU'): ?>
                                           value="microEntityU"
                                            <?php elseif($docs_signed['type']=='PAD'): ?>
                                           value="microEntityD"
                                            <?php elseif($docs_signed['type']=='PROV'): ?>
                                           value="microEntityP"
                                            <?php endif; ?>>
                                    <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                    <input type="hidden" name="COINVINDEX" value="0">
                                    <span style="cursor: pointer;" class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docMEntity').submit();" >
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">Micro Entity</p>
                                            </div>
                                        </div>
                                    </span>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php for($i=1;$i<$coInvCount+1;$i++): ?> 
                        <?php if(!File::exists("files/projects/".$client->fileno."/signature_mE_coInv".$i.".jpg")): ?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docMECoInv_<?php echo e($i); ?>" id="docMECoInv_<?php echo e($i); ?>">
                                    <input type="hidden" name="DOCUMENT"
                                    <?php if($docs_signed['type']=='PAU'): ?>
                                           value="microEntityU"
                                            <?php elseif($docs_signed['type']=='PAD'): ?>
                                           value="microEntityD"
                                            <?php elseif($docs_signed['type']=='PROV'): ?>
                                           value="microEntityP"
                                            <?php endif; ?>>
                                    <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                    <input type="hidden" name="COINVINDEX" value="<?php echo e($i); ?>">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docMECoInv_<?php echo e($i); ?>').submit();" > 
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">Micro Entity <?php echo e($coInvs[$i-1]); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php endfor; ?>
                    <?php endif; ?>
                    
                    <?php if($project_CS->appSent_created_at!="" && $project_CS->patentAppApproved_created_at == "" || $project_CS->appSentD_created_at!="0000-00-00 00:00:00" && $project_CS->patentAppApprovedD_created_at == "0000-00-00 00:00:00"): ?>
                        <div class="col-md-9" id="patent_app_docs" style="border: 1px solid black;padding-left: 0px !important;padding-right: 0px !important;padding-top: 10px !important;">
                            <?php $__currentLoopData = $urlsPA; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urlPA): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dashboard-stat dashboard-stat-light blue-soft col-md-4"
                                   href="<?php echo e($urlPA); ?>" target="_blank" style="margin-left: 20px;">
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 70%;">Patent Application Docs</p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-2">
                                <a class="fa fa-check-circle-o fa-3x patent-app-up hvr-grow " style="line-height: 50px !important;margin-left: 20px;" aria-hidden="true" data-prop="<?php echo e($allDocsSigned); ?>" data-type="<?php echo e($docs_signed['type']); ?>" data-id="<?php echo e($project_CS->project_id); ?>" href="#"></a>
                                <br>
                                <a class="fa fa-times-circle-o fa-3x patent-app-down hvr-grow " style="line-height: 50px !important;margin-left: 20px;" aria-hidden="true" data-type="<?php echo e($docs_signed['type']); ?>" data-id="<?php echo e($project_CS->project_id); ?>" href="#"></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if($upLetterSign  == 1 || $provInvoiceSign == 1 || $upgLetterPCTSign  == 1 || $pctPSASign == 1): ?>
            <div class="row panel-primary container-legal-docs">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">PCT/EPO-----------Provisional Invoice</h4>
                </div>
                <div class="panel-body">
                    <?php if($upLetterSign  == 1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docPCTEPO" id="docPCTEPO">
                                <input type="hidden" name="DOCUMENT" value="upgradePCTEPO">
                                <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPCTEPO').submit();">
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">PCT/EPO</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if($upgLetterPCTSign  == 1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docPCT" id="docPCT">
                                <input type="hidden" name="DOCUMENT" value="upgradePCT">
                                <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPCT').submit();">
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">PCT</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if($provInvoiceSign  == 1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docProvInv" id="docProvInv">
                                <input type="hidden" name="DOCUMENT" value="provInvoice">
                                <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docProvInv').submit();">
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">Provisional<br> Invoice</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if($pctPSASign  == 1): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" onsubmit="return pctPsaSign();" name="docPCTPSA" id="docPCTPSA">
                                <input type="hidden" name="DOCUMENT" value="PCT_PSA">
                                <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPCTPSA').submit();">
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">PCT PSA</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if($ilcNeedSign == 1 || $ilcPatentedC == 1): ?>
            <div class="row panel-primary container-legal-docs">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">ILC</h4>
                </div>
                <div class="panel-body">
                    <?php if($ilcNeedSign == 1): ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <h5>Release ILC from any obligation</h5>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <?php if($ilcNeedSign == 1): ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docILC" id="docILC">
                                    <input type="hidden" name="DOCUMENT" value="ilc_agreement">
                                    <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docILC').submit();">
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">ILC</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="docReleaseForm" id="docReleaseForm">
                                    <input type="hidden" name="DOCUMENT" value="ilc_release">
                                    <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docReleaseForm').submit();">
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">Release Form</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php if($ilcPatentedC == 1): ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <form method="post" action="<?php echo e(url('launch/clientServices/sign')); ?>" name="patentedContract" id="patentedContract">
                                    <input type="hidden" name="DOCUMENT" value="patentedContract">
                                    <input type="hidden" name="ID" value="<?php echo e($project_CS->project_id); ?>">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#patentedContract').submit();" >
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">ILC PATENTED CONTRACT</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        <?php endif; ?>
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


<?php echo $__env->make('omi.layout.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>