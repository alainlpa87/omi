
<?php $__env->startSection('title'); ?>
    Manufacturers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/report.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/admin.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/uploadFile.css')); ?>" rel="stylesheet">
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
        <div class="rowTop col-md-12 col-lg-12">
            <div class="col-md-2 col-xs-12 col-lg-2 container-tools-left ">
                <div class="container-dialer">
                    <div class="col-md-12 col-lg-12">
                        <button class="btn btn-default btnCreateManufacturer padding5" style="width: 100%;margin-left: 15px !important;" id="btnCreateManufacturer"><i class="fa fa-plus"></i> Create Manufacturer</button>
                    </div>
                </div>
            </div>
            
            
            
            <div class="col-md-12  col-xs-12 col-lg-12 col-lg-pull-3 col-md-pull-3 container-portlets" style="margin-top: 40px !important;">
                <div class="table-scrollable" style="width: 100% !important;">
                    <table id="tableDataManufacturer" class="table table-striped table-bordered" cellspacing="0" >
                        <thead id="tableDataHeadManufacturer">
                        <tr>
                            
                            <td align="center"><strong>NAME</strong></td>
                            <td  align="center">INDUSTRY</td>
                            <td  align="center">EMAIL</td>
                            <td  align="center">PHONE</td>
                            <td  align="center">CONTACT NAME</td>
                            <td  align="center">CONTACT LNAME</td>
                            <td  align="center"><strong>ILC NDA SIGN</strong></td>
                            <td  align="center"><strong>WEBSITE NDA SIGN</strong></td>
                            <td  align="center"><strong>MANF NDA</strong></td>
                            <td  align="center"><strong>CT SIGN MANF NDA</strong></td>
                            <td  align="center"><strong>WANT'S NO NDA</strong></td>
                            <td  align="center"><strong> <span class="label label-sm label-info" title=""></span>ACTIONS</strong></td>
                        </tr>
                        </thead>
                        <tbody id="tableDataBodyManufacturer">
                        <?php for($i=0;$i<count($manufacturers);$i++): ?>
                            <tr class="rd" id="rowManufacturer_<?php echo e($manufacturers[$i]->id); ?>">
                                
                                <td align="center" style="padding: 0px !important;">
                                   <span id="manfName_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e(ucwords($manufacturers[$i]->name)); ?> </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($manufacturers[$i]->industry_id == $industry->id): ?>
                                            <span id="indType_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e($industry->type); ?> </span>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td align="center" style="padding: 2px !important;">
                                    <span id="manfEmail_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e($manufacturers[$i]->email); ?> </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfPhone_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e($manufacturers[$i]->phone); ?> </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfFName_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e(ucwords($manufacturers[$i]->fname)); ?> </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfLName_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e(ucwords($manufacturers[$i]->lname)); ?> </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="ndaSign_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e($manufacturers[$i]->ndaSign == 1? 'YES' : 'NO'); ?></span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="hasNda_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e($manufacturers[$i]->hasNda == 1? 'YES' : 'NO'); ?></span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfNda_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e($manufacturers[$i]->manfNda == 1? 'YES' : 'NO'); ?></span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="cSignManfNda_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e($manufacturers[$i]->cSignManfNda == 1? 'YES' : 'NO'); ?></span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfNoNda_<?php echo e($manufacturers[$i]->id); ?>"> <?php echo e($manufacturers[$i]->manfNoNda == 1? 'YES' : 'NO'); ?></span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <i class="fa fa-folder-open loadManufacturerFiles" title="Load Files" style="color: lightskyblue;margin-left: 7px;cursor: pointer;" data-id="<?php echo e($manufacturers[$i]->id); ?>"></i>
                                    <i class="fa fa-upload uploadManufacturerFile" title="Upload File" style="color: lightskyblue;margin-left: 7px;cursor: pointer;" data-id="<?php echo e($manufacturers[$i]->id); ?>"></i>
                                    <i class="fa fa-edit editManufacturer" title="Edit Manufacturer" style="color: orange;margin-left: 7px;cursor: pointer;" data-id="<?php echo e($manufacturers[$i]->id); ?>"></i>
                                    <i class="fa fa-file-text showModalCreateNote" title="Notes" style="color: orange;margin-left: 7px;cursor: pointer;" data-id="<?php echo e($manufacturers[$i]->id); ?>"></i>
                                    <i class="fa fa-times-circle-o deleteManufacturer" title="Remove Manufacturer" style="display: inline !important;margin-left: 7px;color: red;cursor: pointer;" data-id="<?php echo e($manufacturers[$i]->id); ?>"></i>
                                </td>
                            </tr>
                        <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $__env->make('intranet.ILC.tools.createManufacturerModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.manufacturerNotesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.UploadFileModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.ILC.tools.ILCFilesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/manufacturer.js")); ?>"></script>
    <script src="<?php echo e(asset("plugins/jquery/dropzone.js")); ?>"></script>
    <script src="<?php echo e(asset("js/uploadFile/uploadFileManufacturer.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/jquery.dataTables.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.buttons.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/buttons.print.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>