
<?php $__env->startSection('title','Patent Services USA'); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap-datetimepicker.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/css/sign.css')); ?>" rel="stylesheet" type="text/css" >
<?php $__env->stopSection(); ?>
<?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
        <?php if($contract->type=="IMG"): ?>
            <?php echo $__env->make('omi.tools.imgDocusign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($contract->type=="IIG"): ?>
                <?php echo $__env->make('omi.tools.iigDocusign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($contract->type=="IGUP"): ?>
                <?php echo $__env->make('omi.tools.igupDocusign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($contract->type=="PPA" && $ContractType == 'Utility'): ?>
                <?php echo $__env->make('omi.tools.ppaUtilitydocusign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($contract->type=="PPA" && $ContractType == 'U_D'): ?>
                <?php echo $__env->make('omi.tools.ppaU&Ddocusign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($contract->type=="PPA" && $ContractType == 'Provisional'): ?>
                <?php echo $__env->make('omi.tools.ppaIMGdocusign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($contract->type=="PPA" && $ContractType == 'IMG'): ?>
                <?php echo $__env->make('omi.tools.ppaIMGdocusign', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php if($from=="sign"): ?>
            <form action="<?php echo e(url("launch/prepareDocusignContract")); ?>"  name="formSign" onsubmit="return checkFormSign();" method="post" enctype="multipart/form-data">
                <input type="hidden" name="ID" value="<?php echo e($contract->id); ?>">
                <input type="hidden" name="inventor_name_hidden" id="inventor_name_hidden">
                <input type="hidden" name="inventor_date_hidden" id="inventor_date_hidden">
                <input type="hidden" name="cinventor_name_hidden" id="cinventor_name_hidden">
                <input type="hidden" name="cinventor_date_hidden" id="cinventor_date_hidden">
                <div class="col-md-12 margin-top-20 margin-bottom-20">
                    <p align="center" id="acceptTerms">
                        <button class="btn-submit" type="submit" onclick="$('#formSign').submit();">
                            <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>SIGN CONTRACT
                        </button>
                    </p>
                </div>
            </form>
        <?php elseif($from=="signPPA" || $contract->type=="PPA" ): ?>
            <form action="<?php echo e(url("launch/prepareDocusignContract")); ?>"  name="formSign" onsubmit="return checkFormSign();" method="post" enctype="multipart/form-data">
                <input type="hidden" name="ID" value="<?php echo e($contract->id); ?>">
                <input type="hidden" name="contract_type_hidden" id="contract_type_hidden" value="<?php echo e($ContractType); ?>">
                <input type="hidden" name="inventor_name_hidden" id="inventor_name_hidden">
                <input type="hidden" name="inventor_date_hidden" id="inventor_date_hidden">
                <input type="hidden" name="cinventor_name_hidden" id="cinventor_name_hidden">
                <input type="hidden" name="cinventor_date_hidden" id="cinventor_date_hidden">
                
                <input type="hidden" name="hidden_plan1" id="hidden_plan1">
                <input type="hidden" name="hidden_plan2" id="hidden_plan2">
                <input type="hidden" name="hidden_plan3" id="hidden_plan3">
                <input type="hidden" name="hidden_plan4" id="hidden_plan4">
                <input type="hidden" name="hidden_plan5" id="hidden_plan5">
                <input type="hidden" name="hidden_plan6" id="hidden_plan6">
                <input type="hidden" name="hidden_plan7" id="hidden_plan7">
                <input type="hidden" name="hidden_plan8" id="hidden_plan8">
                <input type="hidden" name="hidden_plan9" id="hidden_plan9">
                <input type="hidden" name="hidden_plan10" id="hidden_plan10">
                <input type="hidden" name="hidden_plan11" id="hidden_plan11">
                <input type="hidden" name="hidden_plan12" id="hidden_plan12">

                
                <input type="hidden" name="hidden_price" id="hidden_price">

                <div class="col-md-12 margin-top-20 margin-bottom-20">
                    <p align="center" id="acceptTerms">
                        <button class="btn-submit" type="submit" onclick="$('#formSign').submit();">
                            <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>SIGN CONTRACT
                        </button>
                    </p>
                </div>
            </form>
        <?php else: ?>
            
            <form action="<?php echo e(url("launch/prepareDocusignContract")); ?>"  name="formSign" method="post" onsubmit="return checkFormSign();" enctype="multipart/form-data" hidden="hidden">
                <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                <input type="hidden" name="contract_id" value="<?php echo e($contract->id); ?>">
                <input type="hidden" name="inventor_name_hidden" id="inventor_name_hidden">
                <input type="hidden" name="inventor_date_hidden" id="inventor_date_hidden">
                <input type="hidden" name="cinventor_name_hidden" id="cinventor_name_hidden">
                <input type="hidden" name="cinventor_date_hidden" id="cinventor_date_hidden">
                <input type="hidden" name="newPrice_hidden" id="newPrice_hidden">
                <div class="col-md-12 margin-top-20 margin-bottom-20">
                    <p align="center" id="acceptTerms">
                        <button class="btn-submit" type="submit" onclick="$('#formSign').submit();">
                            <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>SIGN CONTRACT
                        </button>
                    </p>
                </div>
            </form>

                <form action="<?php echo e(url("launch/prepareDocusignContract")); ?>"  name="formSignDocusign" onsubmit="return checkFormSign();" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="ID" value="<?php echo e($contract->id); ?>">
                    <input type="hidden" name="newPrice_hidden1" id="newPrice_hidden1">
                    <div class="col-md-12 margin-top-20 margin-bottom-20">
                        <p align="center" id="acceptTermsDocu">
                            <button class="btn-submit" type="submit" onclick="$('#formSignDocusign').submit();">
                                <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>SIGN CONTRACT
                            </button>
                        </p>
                    </div>
                </form>
        <?php endif; ?>

            
            <div class="col-md-12">
                <img src="<?php echo e(asset('/img/logos/uiaNew.png')); ?>" width="12%" alt="United Inventors Association Of America" style="margin-right: 5%;margin-left: 15%;">
                <img src="<?php echo e(asset('/img/logos/google.jpg')); ?>" width="10%" alt="Google Reviews" style="margin-right: 5%;">
                <img src="<?php echo e(asset('/img/logos/bbb.png')); ?>" width="18%" alt="Better Business Bureau" style="margin-right: 5%;">
                <img src="<?php echo e(asset('/img/logos/shopper.png')); ?>" width="13%" alt="Shopper Apprived" style="margin-right: 5%;">
                <img src="<?php echo e(asset('/img/logos/customersReview.png')); ?>" width="10%" alt="Review of Patent Services USA Inc">
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("/js/omi/sign.js")); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('omi.layout.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>