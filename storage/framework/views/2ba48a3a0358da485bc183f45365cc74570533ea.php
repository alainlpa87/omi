
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
    
    <?php echo $__env->make('intranet.tools.loadingModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.loadingModalAjax', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid">
        <div class="row rowTop">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12 col-xs-8">
                        <select class="selectedMonth col-md-6 col-xs-6 noPadding">
                            <option value="01" <?php echo e(date("m")=="01"?"selected":""); ?>>January</option>
                            <option value="02" <?php echo e(date("m")=="02"?"selected":""); ?>>February</option>
                            <option value="03" <?php echo e(date("m")=="03"?"selected":""); ?>>March</option>
                            <option value="04" <?php echo e(date("m")=="04"?"selected":""); ?>>April</option>
                            <option value="05" <?php echo e(date("m")=="05"?"selected":""); ?>>May</option>
                            <option value="06" <?php echo e(date("m")=="06"?"selected":""); ?>>June</option>
                            <option value="07" <?php echo e(date("m")=="07"?"selected":""); ?>>July</option>
                            <option value="08" <?php echo e(date("m")=="08"?"selected":""); ?>>August</option>
                            <option value="09" <?php echo e(date("m")=="09"?"selected":""); ?>>September</option>
                            <option value="10" <?php echo e(date("m")=="10"?"selected":""); ?>>October</option>
                            <option value="11" <?php echo e(date("m")=="11"?"selected":""); ?>>November</option>
                            <option value="12" <?php echo e(date("m")=="12"?"selected":""); ?>>December</option>
                        </select>
                        <div class="col-md-6 col-xs-4 noPadding">
                            <button class="btn btn-default padding5" id="btnAttorneyStats" data-name="<?php echo e($att_name); ?>" data-pin="<?php echo e($att_id); ?>"><i class="fa fa-table"></i> Report</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <div class="infoChart"></div>
                </div>
            </div>

            
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets container-charts">
                <h4 id="titleChart">Monthly Attorney Details (<?php echo e($att_name); ?>)</h4>
                <table id="tableDataStats" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead id="tableDataHead">
                    <tr>
                        <th>FILENO</th>
                        <th>TYPE</th>
                        <th>RECEIVED</th>
                        <th>COMPLETED</th>
                    </tr>
                    </thead>
                    <tfoot id="tableDataFoot">
                    <tr>
                        <th>FILENO</th>
                        <th>TYPE</th>
                        <th>RECEIVED</th>
                        <th>COMPLETED</th>
                    </tr>
                    </tfoot>
                    <tbody id="tableDataBodyStats">
                    <?php $__currentLoopData = $attDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($attD->lead->fileno); ?></th>
                            <th><?php echo e($attD->type); ?></th>
                            <th><?php echo e(date("m-d-Y",strtotime($attD->created_at))); ?></th>
                            <th><?php if($rcvdDates[$attD->id]!=''): ?><?php echo e(date("m-d-Y",strtotime($rcvdDates[$attD->id]))); ?><?php else: ?> N/A <?php endif; ?></th>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($dat['FILENO']); ?></th>
                            <th><?php echo e($dat['TYPE']); ?></th>
                            <th><?php echo e($dat['SENDDATE']); ?></th>
                            <th><?php if($dat['RECEIVEDDATE']!=''): ?><?php echo e($dat['RECEIVEDDATE']); ?><?php else: ?> N/A <?php endif; ?></th>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("/plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/attDetailsVendors.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/moment.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/jquery.dataTables.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.buttons.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/buttons.print.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>