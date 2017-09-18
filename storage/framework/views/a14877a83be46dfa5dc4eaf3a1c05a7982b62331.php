
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
                            <button class="btn btn-default btnConsultantStats padding5" id="btnStats"><i class="fa fa-table"></i> Stats</button>
                        </div>
                    </div>
                    <div class="col-md-12 containerReportButtons">
                        <div class="col-md-12 col-xs-1 noPadding">
                            <button class="btn btn-default btnConsultantScores padding5" id="btnScores"><i class="fa fa-bar-chart"></i> Scores</button>
                        </div>
                        <div class="col-md-12 col-xs-1 noPadding">
                            <button class="btn btn-default btnConsultantProduction padding5" id="btnProduction"><i class="fa fa-bar-chart"></i> Production</button>
                        </div>
                        <?php if(strpos(Session::get('user_type'), 'boss')!== false||strpos(Session::get('user_type'), 'production')!== false): ?>
                            <div class="col-md-12 col-xs-1 noPadding">
                                <button class="btn btn-default btnConsultantProduction padding5" id="productionProgressReport"><i class="fa fa-bar-chart"></i> Progress Report</button>
                            </div>
                            <div class="col-md-12 col-xs-1 noPadding">
                                <button class="btn btn-default btnConsultantProduction padding5" id="productionProgressReportCSV"><i class="fa fa-download"></i> Progress Report CSV</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <div class="infoChart" style="display: block">
                        <p>Total Calls: <?php echo e($calls); ?></p>
                        <p>Total SUBS: <?php echo e($subs); ?></p>
                        <p>Total CONT: <?php echo e($contracts); ?></p>
                        <p>Total PH1: <?php echo e($ph1); ?></p>
                        <p>Total IMG: <?php echo e($imgs); ?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <p style="padding-top: 30px;">Calls Info for <?php echo e(date("F")); ?></p>
                    <div class="callChart" style="display: block">
                        <p>Calls: <?php echo e($totals["CALL"]); ?></p>
                        <p style="padding-left: 10%;">LEADS CALLs: <?php echo e($totals["Lead"]); ?></p>
                        <p style="padding-left: 20%;">NEW: <?php echo e($totals["New"]); ?></p>
                        <p style="padding-left: 20%;">RECYCLE: <?php echo e($totals["Recycle"]); ?></p>
                        <p style="padding-left: 10%;">PH-1 CALLs: <?php echo e($totals["Sub"]); ?></p>
                        <p style="padding-left: 10%;">PH-2 CALLs: <?php echo e($totals["PaidPH1"]); ?></p>
                        <p>Phase One Pipeline: <?php echo e($totals["Pipe"]); ?></p>
                    </div>
                </div>
            </div>

            
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets container-charts">
                <h4 id="titleChart">Monthly Numbers</h4>
                <table id="tableDataStats" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead id="tableDataHead">
                    <tr>
                        <th>CONSULTANT</th>
                        <th>CALLS</th>
                        <th>SUBS</th>
                        <th>CONT</th>
                        <th>PH-1</th>
                        <th>IMG</th>
                    </tr>
                    </thead>
                    <tfoot id="tableDataFoot">
                    <tr>
                        <th>CONSULTANT</th>
                        <th>CALLS</th>
                        <th>SUBS</th>
                        <th>CONT</th>
                        <th>PH-1</th>
                        <th>IMG</th>
                    </tr>
                    </tfoot>
                    <tbody id="tableDataBodyStats">
                    <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e(ucfirst($stat->consultant->usr)); ?></th>
                            <th><?php echo e($stat->calls); ?></th>
                            <th><?php echo e($stat->subs); ?></th>
                            <th><?php echo e($stat->cont); ?></th>
                            <th><?php echo e($stat->ph1); ?></th>
                            <th><?php echo e($stat->img); ?></th>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <table id="tableDataScores" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead id="tableDataHead">
                    <tr style="text-align: center;font-weight: bold;">
                        <td style='background-color: bisque;'>Consultant</td>
                        <td colspan="3" class='bkCornsilk'>Sub Approved</td>
                        <td colspan="3" class='bkBisque'>Contracts Out</td>
                        <td colspan="4" class='bkCornsilk'> Sales</td>
                        <td colspan="2" class='bkBisque'>Total</td>
                    </tr>
                    <tr>
                        <td class="bkBisque"></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">T</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">P</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">14</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">T</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">P</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">14</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">IIG</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">IMG</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">T</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">14</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">T</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">14</span></strong></td>
                    </tr>
                    </thead>
                    <tfoot id="tableDataFoot">
                    <tr style="text-align: center;font-weight: bold;">
                        <td style='background-color: bisque;'>Consultant</td>
                        <td colspan="3" class='bkCornsilk'>Sub Approved</td>
                        <td colspan="3" class='bkBisque'>Contracts Out</td>
                        <td colspan="4" class='bkCornsilk'> Sales</td>
                        <td colspan="2" class='bkBisque'>Total</td>
                    </tr>
                    <tr>
                        <td class="bkBisque"></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">T</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">P</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">14</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">T</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">P</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">14</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">IIG</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">IMG</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">T</span></strong></td>
                        <td class='bkCornsilk'><strong> <span class="label label-sm label-info">14</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">T</span></strong></td>
                        <td class='bkBisque'><strong> <span class="label label-sm label-info">14</span></strong></td>
                    </tr>
                    </tfoot>
                    <tbody id="tableDataBodyScores">
                    </tbody>
                </table>
                <table id="tableDataProduction" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead id="tableDataHead">
                    <tr>
                        <th>Date of Payment</th>
                        <th>File #</th>
                        <th>Inventor</th>
                        <th>Est. Shipping</th>
                        <th>Date Shipping</th>
                        <th>Rep</th>
                        <th>PPA Type</th>
                    </tr>
                    </thead>
                    <tfoot id="tableDataFoot">
                    <tr>
                        <th>Date of Payment</th>
                        <th>File #</th>
                        <th>Inventor</th>
                        <th>Est. Shipping</th>
                        <th>Date Shipping</th>
                        <th>Rep</th>
                        <th>PPA Type</th>
                    </tr>
                    </tfoot>
                    <tbody id="tableDataBodyProduction">
                    </tbody>
                </table>
                <table id="tableDataProductionProgressReport" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead id="tableDataHead">
                    <tr>
                        <th>Date of Payment</th>
                        <th>File #</th>
                        <th>Inventor</th>
                        <th>Est. Shipping</th>
                        <th>Date Shipping</th>
                        <th>Rep</th>
                        <th>PPA Type</th>
                        <th>Attorney</th>
                        <th>Sent To Vendors</th>
                        <th>IIG TYPE</th>

                    </tr>
                    </thead>
                    <tfoot id="tableDataFoot">
                    <tr>
                        <th>Date of Payment</th>
                        <th>File #</th>
                        <th>Inventor</th>
                        <th>Est. Shipping</th>
                        <th>Date Shipping</th>
                        <th>Rep</th>
                        <th>PPA Type</th>
                        <th>Attorney</th>
                        <th>Sent To Vendors</th>
                        <th>IIG TYPE</th>
                    </tr>
                    </tfoot>
                    <tbody id="tableDataBodyProductionProgressReport">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <?php echo $__env->make('intranet.project.tools.sendTextModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.settingsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/stats.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/moment.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/jquery.dataTables.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.buttons.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/buttons.print.min.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>