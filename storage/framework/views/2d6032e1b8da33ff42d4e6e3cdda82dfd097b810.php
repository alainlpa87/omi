
<?php $__env->startSection('title','Patent Services USA'); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap-datetimepicker.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/css/sign.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(asset('/plugins/docusign/assets/jquery.signaturepad.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/pdf_client.css')); ?>" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
<?php $__env->stopSection(); ?>
<?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php if($document=="trademark_too_descriptive"): ?>
                <?php echo $__env->make('omi.tools.client_services.trademark_too_descriptive', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="trademark"): ?>
                <?php echo $__env->make('omi.tools.client_services.trademark_copyright', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="ddr"): ?>
                <?php if($project_id==8305): ?>
                    <?php echo $__env->make('omi.tools.client_services.ddrDocusign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php else: ?>
                    <?php echo $__env->make('omi.tools.client_services.ddr', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($document=="applicationCoverPagePCT"): ?>
                <?php echo $__env->make('omi.tools.client_services.applicationCoverPagePCT', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="applicationCoverPageProvisional"): ?>
                <?php echo $__env->make('omi.tools.client_services.applicationCoverPageProvisional', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="applicationCoverPageUtility"): ?>
                <?php echo $__env->make('omi.tools.client_services.applicationCoverPageUtility', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="ph2AttorneyCoverSheet"): ?>
                <?php echo $__env->make('omi.tools.client_services.ph2AttorneyCoverSheet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="pct_questionnaire"): ?>
                <?php echo $__env->make('omi.tools.client_services.pct_questionnaire', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="copyrightQuestionnaire"): ?>
                <?php echo $__env->make('omi.tools.client_services.copyrightQuestionnaire', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="agreementPSA"): ?>
                <?php if($project_id==8305): ?>
                    <?php echo $__env->make('omi.tools.client_services.psaDocusign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php else: ?>
                    <?php echo $__env->make('omi.tools.client_services.agreementPSA', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($document=="declarationU" || $document=="declarationD"): ?>
                <?php echo $__env->make("omi.tools.client_services.declaration",array('document'=>$document), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="addDeclarationU" || $document=="addDeclarationD"): ?>
                <?php echo $__env->make("omi.tools.client_services.add_declaration",array('document'=>$document), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="poaU" || $document=="poaD"): ?>
                <?php echo $__env->make("omi.tools.client_services.doc_poa",array('document'=>$document), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="microEntityU" || $document=="microEntityD" || $document=="microEntityP"): ?>
                <?php echo $__env->make("omi.tools.client_services.doc_microEntity",array('document'=>$document), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="upgradePCTEPO"): ?>
                <?php echo $__env->make("omi.tools.client_services.upgradePCTEPO", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="upgradePCT"): ?>
                <?php echo $__env->make("omi.tools.client_services.upgradePCT", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="provInvoice"): ?>
                <?php echo $__env->make("omi.tools.client_services.provInvoice", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="ilc_agreement"): ?>
                <?php echo $__env->make("omi.tools.client_services.ilc", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="ilc_release"): ?>
                <?php echo $__env->make("omi.tools.client_services.ilc_release", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="trademark_letter"): ?>
                <?php echo $__env->make("omi.tools.client_services.trademark_letter", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="PCT_PSA"): ?>
                <?php echo $__env->make("omi.tools.client_services.PCTPSA", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="agreementExtension"): ?>
                <?php echo $__env->make("omi.tools.client_services.agreementExtension", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($document=="patentedContract"): ?>
                <?php echo $__env->make("omi.tools.ilc.ilc_patented_contract", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <div class="col-md-12 margin-top-20 margin-bottom-20">
                <p align="center">
                    <button class="btn-submit" type="submit" onclick="$('#formSign').submit();">
                        <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>I ACCEPT THE TERMS
                    </button>
                </p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    
    <script src="<?php echo e(asset("/js/omi/sign.js")); ?>"></script>
    <script src="<?php echo e(asset("/js/omi/client_services.js")); ?>"></script>
    
    <script src="<?php echo e(asset("/plugins/docusign/jquery.signaturepad.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/docusign/assets/json2.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/docusign/assets/bezier.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/docusign/assets/numeric-1.2.6.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('omi.layout.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>