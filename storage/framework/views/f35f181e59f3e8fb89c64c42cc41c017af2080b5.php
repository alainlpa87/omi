
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/report.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/chartist/chartist.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap-datetimepicker.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/plugins/bootstrap/dataTables.bootstrap.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('/plugins/bootstrap/buttons.dataTables.min.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.loadingModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.loadingModalAjax', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container-fluid">
        <div class="row rowTop">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="col-md-12 col-xs-12" style="border: 1px solid blue">
                    <p>Assign Leads</p>
                    <select class="consultantSelect">
                        <option value="-1" selected>Select Consultant</option>
                        <?php $__currentLoopData = $consultants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($consultant->id); ?>"><?php echo e($consultant->usr); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select class="leadAmount">
                        <option value="0">Amount of Leads</option>
                        <option value="100">100 Leads</option>
                        <option value="200">200 Leads</option>
                        <option value="300">300 Leads</option>
                        <option value="1">1 Lead</option>
                    </select>
                    <div class="col-md-12">
                        <button class="btn btn-default btnAssignLeads padding5" id="btnAssignLeads"><i class="fa fa-paper-plane-o"></i> Assing Leads</button>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12" style="border: 1px solid blue;margin-top: 10px;">
                    <p>Fix Contracts</p>
                    <input type="text" class="form-control cleanBorder" id="project" placeholder="Project PIN"/>
                    <select class="contractTypeSelect">
                        <option value="-1" selected>Select Type</option>
                        <option value="IMG">IMG ($449)</option>
                        <option value="IGUP">IGUP ($430)</option>
                        <option value="IIG">IIG ($879)</option>
                    </select>
                    <div class="col-md-12">
                        <button class="btn btn-default btnFixContract padding5" id="btnFixContract"><i class="fa fa-paper-plane-o"></i> Fix Contract</button>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12" style="border: 1px solid blue;margin-top: 10px;">
                    <p>Delete Duplicate Project</p>
                    <input type="text" class="form-control cleanBorder" id="projectDuplicate" placeholder="Project PIN"/>
                    <div class="col-md-12">
                        <button class="btn btn-default btnFixDuplicate padding5" id="btnFixDuplicate"><i class="fa fa-paper-plane-o"></i>Delete Duplicate</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
            </div>
            
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="col-md-12 col-xs-12">

                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/fix.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>