
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/clientServices.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/modal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/datepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/buttons.dataTables.min.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('intranet.layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    
    <?php echo $__env->make('intranet.layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12 col-xs-6 noPadding">
                        <select id="trainingDocs">
                            <option value="0">--Training--</option>
                            <option value="<?php echo e(url("training/Lead_training_Screen_.png")); ?>">Lead training</option>
                            <option value="<?php echo e(url("training/Project View.png")); ?>">Project View</option>
                            <option value="<?php echo e(url("training/Sandbox.swf")); ?>">Sandbox</option>
                            <option value="<?php echo e(url("training/Set_up.swf")); ?>">Set up</option>
                            <option value="<?php echo e(url("training/set_voicemail.swf")); ?>">Set voicemail</option>
                            <option value="<?php echo e(url("training/contract process_PC.pdf")); ?>">Signing the contract-PC</option>
                            <option value="<?php echo e(url("training/contract process_Mobile.pdf")); ?>">Signing the contract-Mobile</option>
                            <option value="<?php echo e(url("training/Proof_of_Patent_Search_Cost.JPG")); ?>">Proof of Patent Search Cost</option>
                            <option value="<?php echo e(url("training/Proof_of_AIPLA_2015_Report.pdf")); ?>">Proof of AIPLA 2015 Report</option>
                            <option value="<?php echo e(url("training/Patent_Attorney_Info.pdf")); ?>">Patent Attorney Info</option>
                            <option value="<?php echo e(url("training/Rough_Patent_Search.pdf")); ?>">Rough Patent Search(Example).pdf</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="page-container">
                <div class="leadroll">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="portlet box green">
                                <div class="portlet-title" style="background-color: #35aa47;height: 40px !important;">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>RECORDINGS
                                    </div>
                                </div>
                                <div class="portlet-body container-charts">
                                    <div class="table-scrollable" style="width: 100% !important;">
                                        <table id="tableDataStats" class="table table-striped table-bordered" cellspacing="0" >
                                            <thead id="tableDataHead">
                                            <tr>
                                                <td style="width: 5%;"><strong> <span class="label label-sm label-info" title=""></span></strong></td>
                                                <td style="width: 10%;"><strong> <span class="label label-sm label-info" title=""></span></strong></td>
                                                <td style="width: 15%;"><strong>CONSULTANT</strong></td>
                                                <td style="width: 35%;">Description</td>
                                                <td style="width: 10%;"><strong> <span class="label label-sm label-info" title="">FILENO</span></strong></td>
                                                <td style="width: 15%;text-align: center"><strong> <span class="label label-sm label-warning" title="">STAMP</span></strong></td>
                                                <?php if($rolLibrary == 1): ?>
                                                    <td style="width: 10%;text-align: center"><strong> <span class="label label-sm label-warning" title="">Library</span></strong></td>
                                                <?php endif; ?>
                                            </tr>
                                            </thead>
                                            <tbody id="tableDataBodyStats">
                                            <?php for($i=0;$i<count($records);$i++): ?>
                                                <tr id="<?php echo e($records[$i]->id); ?>">
                                                    <td><?php echo e($i+1); ?></td>
                                                    <td>
                                                       <div>
                                                           <?php if($rolLibrary == 1): ?>
                                                               <i class="fa fa-ban deleteCall" aria-hidden="true" data-id="<?php echo e($records[$i]->id); ?>" style="margin-right: 20px;"></i>
                                                           <?php endif; ?>
                                                           <i class="fa fa-phone recordCallId" data-id="<?php echo e($records[$i]->id); ?>"></i> <i class="fa fa-play recordUrl" style="display: inline !important;margin-left: 10px;" data-url="<?php echo e($records[$i]->url); ?>"></i>
                                                       </div>
                                                    </td>
                                                    <td>
                                                        <?php echo e(ucwords($records[$i]->consultant->usr)); ?>

                                                    </td>
                                                    <td>
                                                        <?php if($rolLibrary == 1): ?>
                                                            <input type="text" class="setDescription" id="description_<?php echo e($records[$i]->id); ?>" data-id="<?php echo e($records[$i]->id); ?>" value="<?php echo e($records[$i]->description); ?>">
                                                        <?php else: ?>
                                                            <label style="width:100%;"><?php echo e($records[$i]->description); ?></label>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($records[$i]->lead != null): ?>
                                                            <?php echo e($records[$i]->lead->fileno); ?>

                                                        <?php else: ?>
                                                            N/A
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <?php echo e(date('m-d-Y',strtotime($records[$i]->created_at))); ?>

                                                    </td>
                                                    <?php if($rolLibrary == 1): ?>
                                                        <td>
                                                            <input type="checkbox" class="checkLibrary" name="library" id="library_<?php echo e($records[$i]->id); ?>" data-id="<?php echo e($records[$i]->id); ?>"  <?php if($records[$i]->library): ?>checked="checked"<?php endif; ?>>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endfor; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
    <?php echo $__env->make('intranet.tools.iframePrint', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("plugins/jquery/jquery.expandable.js")); ?>"></script>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
    <script src="<?php echo e(asset("js/recordCalls.js")); ?>"></script>
    
    <script src="<?php echo e(asset("plugins/jquery/dropzone.js")); ?>"></script>

    <script src="<?php echo e(asset("/plugins/bootstrap/moment.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepicker.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/jquery.dataTables.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/dataTables.buttons.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/buttons.print.min.js")); ?>"></script>
    <script src="<?php echo e(asset("js/attDetails.js")); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>