
<?php $__env->startSection('title'); ?>
    Statistics View
<?php $__env->stopSection(); ?>
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
                    <div class="col-md-12">
                        <select class="consultantSelect">
                            <option value="-1" selected>ALL</option>
                            <?php $__currentLoopData = $consultants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($consultant->id); ?>"><?php echo e($consultant->usr); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <label class="col-md-12 noMobil">From:</label>
                    <div class="col-md-12 col-xs-6">
                        <div class='input-group date' id='datetimepickerStart'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <label class="col-md-12 noMobil">To:</label>
                    <div class="col-md-12 col-xs-6">
                        <div class='input-group date' id='datetimepickerEnd'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <?php if(strpos(Session::get('user_type'), 'admin')!== false): ?>
                        <div class="col-md-12 containerReportButtons">
                        <div class="col-md-6 col-xs-3 noPadding">
                            <button class="btn btn-default btnContracts padding5" id="btnContracts"><i class="fa fa-paper-plane-o"></i> Contracts</button>
                        </div>
                        <div class="col-md-6 col-xs-3 noPadding">
                            <button class="btn btn-default btnSubmissions padding5" id="btnSubmissions"><i class="fa fa-file-o"></i> Submissions</button>
                        </div>
                        <div class="col-md-6 col-xs-3 noPadding">
                            <button class="btn btn-default btnSold padding5" id="btnSold"><i class="fa fa-money"></i> Sold</button>
                        </div>
                    <?php endif; ?>
                            <div class="col-md-6 col-xs-3 noPadding">
                                <button class="btn btn-default btnTransactions padding5" id="btnTransactions"><i class="fa fa-bar-chart"></i> CALLS</button>
                            </div>
                    <?php if(strpos(Session::get('user_type'), 'admin')!== false): ?>
                        <div class="col-md-12 col-xs-6 noPadding">
                            <button class="btn btn-default btnCalls padding5" id="btnCalls"><i class="fa fa-phone"></i> Calls Per Day by Hours</button>
                        </div>
                        <div class="col-md-12 col-xs-3 noPadding">
                            <button class="btn btn-default btnLeadsPerConsultant padding5" id="btnLeadsPerConsultant"><i class="fa fa-bar-chart"></i> Leads per Consultant</button>
                        </div>
                        <div class="col-md-12 col-xs-3 noPadding">
                            <button class="btn btn-default btnLeadsBySource padding5" id="btnLeadsBySource"><i class="fa fa-bar-chart"></i> Leads by Source</button>
                        </div>
                        <div class="col-md-4 col-xs-3 noPadding">
                            <button class="btn btn-default btnLeads3dCall padding5" id="btnLeads3dCall"><i class="fa fa-table"></i> 3-Day</button>
                        </div>
                        <div class="col-md-8 col-xs-3 noPadding">
                            <button class="btn btn-default btnLeads3dCallPerConsultant padding5" id="btnLeads3dCallPerConsultant"><i class="fa fa-table"></i> 3-Day per Cons.</button>
                        </div>
                        <?php if(strpos(Session::get('user_type'), 'boss')!== false): ?>
                            <div class="col-md-12 col-xs-2 noPadding">
                                <button class="btn btn-default btnSubBySource padding5" id="btnSubBySource"><i class="fa fa-calendar"></i> Subs By Source</button>
                            </div>
                                    <div class="col-md-12 col-xs-2 noPadding">
                                        <button class="btn btn-default btnPh1BySource padding5" id="btnPh1BySource"><i class="fa fa-calendar"></i> Paid Ph1 By Source</button>
                                    </div>
                            <div class="col-md-12 col-xs-2 noPadding">
                                <button class="btn btn-default btnLeadWithSubBySource padding5" id="btnLeadWithSubBySource"><i class="fa fa-calendar"></i> Leads with Projects by Source</button>
                            </div>
                            <div class="col-md-6 col-xs-6 noPadding">
                                <select class="sourceSelect">
                                    <option value="-1" selected>VENDOR</option>
                                    <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(strlen($vendor->leadSource)>0): ?>
                                        <option value="<?php echo e($vendor->leadSource); ?>"><?php echo e($vendor->leadSource); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-xs-2 noPadding">
                                <button class="btn btn-default btnGrossLead padding5" id="btnGrossLead"><i class="fa fa-calendar"></i>Lead Gross</button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <?php if(strpos(Session::get('user_type'), 'boss')!== false): ?>
                    <div class="col-md-12 col-xs-12 noPadding">
                        <button class="btn btn-default col-md-6 btnMonthlyMoneyReport padding5" id="btnMonthlyMoneyReport"><i class="fa fa-money"></i> Money Report</button>
                        <button class="btn btn-default col-md-6 btnMonthlyMoneyReport padding5" id="btnMonthlyMoneyReportCSV"><i class="fa fa-file-excel-o"></i> Money Report</button>
                    </div>
                    <div class="col-md-12 col-xs-12 noPadding">
                        <button class="btn btn-default btnSetPayment padding5" id="btnSetPayment"><i class="fa fa-money"></i> Report Sell</button>
                    </div>
                    <div class="col-md-12 col-xs-12 noPadding">
                        <button class="btn btn-default btnPaymentInAndNotSentToVendor padding5" id="btnPaymentInAndNotSentToVendor"><i class="fa fa-paper-plane"></i> Pending to Vendor</button>
                    </div>
                    <div class="col-md-12 col-xs-12 noPadding">
                        <button class="btn btn-default btFunding padding5" id="btFunding"><i class="fa fa-money"></i> Funding Contracts</button>
                    </div>
                <?php endif; ?>
                <div class="col-md-12 col-xs-2 noPadding">
                    <button class="btn btn-default btnJrToSrConsultant padding5" id="btnPersonalPH2ClosingRatio" title="PH2 / (IIG or IMG in a period of time)"><i class="fa fa-paper-plane-o"></i> Personal PH2 Closing Ratio</button>
                </div>
                <div class="col-md-12 col-xs-2 noPadding">
                    <button class="btn btn-default btnSrFromJrConsultant padding5" id="btnTeamLeadPH2ClosingRatio"><i class="fa fa-paper-plane-o"></i> Team Lead PH2 Closing Ratio</button>
                </div>

                <?php if(strpos(Session::get('user_type'), 'boss')!== false): ?>
                    <div class="col-md-12 divSelectOptionAdmin">
                    <select  id="selectOptionAdmin">
                        <option value="0">--REASSIGN ACTIONS--</option>
                        <option value="R-L"><?php echo e(REASSIGN_ONE_LEAD); ?></option>
                        <option value="R-A"><?php echo e(REASSIGN_AMOUNT_OF_LEAD); ?></option>
                    </select>
                </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <div class="infoChart"></div>
                </div>
            </div>

            
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets container-charts">
                <h4 id="titleChart"></h4>
                <div class="chart">
                    <div class="ct-chart ct-golden-section"></div>
                </div>
                <div class="divTable">
                    <table id="tableData" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead id="tableDataHead"></thead>
                        <tfoot id="tableDataFoot"></tfoot>
                        <tbody id="tableDataBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $__env->make('intranet.project.tools.sendTextModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.report.tools.monthlyReportNotesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.lead.tools.whoIsThisModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.tools.settingsModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.report.tools.setPaymentProjectModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('intranet.admin.tools.adminReassignLeadWithSubModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('intranet.admin.tools.adminActionModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/report.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/moment.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datetimepicker.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/jquery.dataTables.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.buttons.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/buttons.print.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/chartist/chartist.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>