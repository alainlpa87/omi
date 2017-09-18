
<?php $__env->startSection('title','Patent Services USA'); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/common.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap-datetimepicker.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if($needSign): ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-light blue-soft" href="<?php echo e(route('launch/sign',$project->id)); ?>">
                            <div class="visual">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <p style="font-size: 80%;">SIGN CONTRACT</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if($letterOfEngagement): ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-light blue-soft" href="<?php echo e(route('launch/signLetterOfEngagement',$project->id)); ?>">
                            <div class="visual">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <p style="font-size: 80%;">Sign Letter Of Engagement</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                    
                <?php if(($cS=$project->clientServicesProject())!=null && ($docsToSign>0 || ($cS->appSent_created_at!="" && $cS->patentAppApproved_created_at == "") || ($cS->appSentD_created_at != "0000-00-00 00:00:00" && $cS->patentAppApprovedD_created_at == "0000-00-00 00:00:00") || $upLetterSign == 1 || $upgLetterPCTSign == 1 || $ilcNeedSign == 1 || $provInvoiceSign == 1)): ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div id="showDocsDiv" class="dashboard-stat dashboard-stat-light blue-soft" style="cursor:pointer;" data-pid="<?php echo e($project->id); ?>" >
                            <div class="visual">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <p style="font-size: 80%;">SIGN LEGAL DOCS</p>
                                </div>
                                <input type="hidden" name="document" value="<?php echo e($upgLetterPCTSign); ?>">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($allowPayment): ?>
                    <?php if($contract->funding==1 ||($contract->type=="PPA" && strlen($contract->signed)>0)): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="POST" action="<?php echo e(url("payment")); ?>" id="paymentForm">
                                <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                                <input type="hidden" name="contract_id" value="<?php echo e($contract->id); ?>">
                                    <span style="cursor: pointer;" class="dashboard-stat dashboard-stat-light green-soft" onclick="$('#paymentForm').submit();">
                                        <div class="visual"><i class="fa fa-money"></i></div>
                                        <div class="details">
                                            <div class="number">
                                                Make a Payment
                                            </div>
                                        </div>
                                    </span>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light green-soft" href="<?php echo e(route('launch/signBeforePaid',$project->id)); ?>">
                                <div class="visual"><i class="fa fa-money"></i></div>
                                <div class="details">
                                    <div class="number">
                                        Make a Payment
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                <?php else: ?>
                    <?php if($allowPpaPlans): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light green-turquoise" id="addPlan" data-id="<?php echo e($project->id); ?>">
                                <div class="visual"><i class="fa fa-money"></i></div>
                                <div class="details">
                                    <div class="number">
                                        Plan Add-ons
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if($allowQuestions): ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-light yellow-casablanca showEmail">
                            <div class="visual">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="details" style="right: 0 !important;">
                                <div class="number">
                                    <p style="font-size: 80%;">Contact Us.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 linkUploadFileProject" data-id="<?php echo e($project->id); ?>">
                    <a class="dashboard-stat dashboard-stat-light red-soft" href="#">
                        <div class="visual"><i class="fa fa-upload"></i></div>
                        <div class="details">
                            <div class="number">
                                UPLOAD FILES
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs" role="tablist">
                    <div class="caption">
                        <span class="projectStatus">PROJECT STATUS: <?php echo e($project->lastRequestToAdmin() && strlen($project->lastRequestToAdmin()->adminStage)>0?$project->lastRequestToAdmin()->adminStage:"PRELIMINARY SCREENING"); ?></span>
                    </div>
                    <li <?php if(($pcs = $project->clientServicesProject())== null): ?>class="active"<?php endif; ?>>
                        <a href="#portlet_tab_1" data-toggle="tab" role="tab"> PROJECT DETAILS </a>
                    </li>
                    <li>
                        <a href="#portlet_tab_2" data-toggle="tab" role="tab"> INVENTORS </a>
                    </li>
                    <?php if($pcs!=null): ?>
                        <li class="active">
                            <a href="#portlet_tab_3" data-toggle="tab" role="tab"> LEGAL STATUS </a>
                        </li>
                    <?php endif; ?>
                    <?php if($pcs!=null  && $pcs->id=="154" && $ilcInfo['exist'] == 1): ?>
                        <li>
                            <a href="#portlet_tab_4" data-toggle="tab" role="tab"> ILC STATUS </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="portlet-body">
                    <div class="tab-content col-md-12">
                        <div class="tab-pane <?php if($pcs == null): ?> active <?php endif; ?>" id="portlet_tab_1" role="tabpanel">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Invention Name:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control cleanBorder" id="ideaName" name="ideaName" value="<?php echo e($project->ideaName); ?>" data-id="<?php echo e($project->id); ?>"/>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Invention Product Description</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <label type="text" id="ideaConcept" class="form-control" readonly style="height: 100px;overflow-y:scroll;"><?php echo $project->ideaConcept; ?></label>
                                </div>
                            </div>
                            <?php if(!$allowQuestions): ?>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Add some comments to your idea</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                        <textarea rows="6" type="text" class="form-control" id="description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <button id="btnSaveProject" data-id="<?php echo e($project->id); ?>" data-next="1" data-tab="0" class="btn btn-success center-block btnSaveProject" type="button">
                                        <i class="fa fa-floppy-o"></i>
                                        <strong>Save</strong>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="clear"></div>
                            <?php if($notesApproval>0): ?>
                                <div class="boxApproval">
                                    <div class="form-group col-md-10 col-sm-12 col-xs-12">
                                        <label>For Inventor Approval:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                            <textarea rows="6" type="text" class="form-control" id="notesApproval" name="notesApproval"><?php echo e($project->approvalNotes); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 col-sm-12 col-xs-12 boxBtnApproval">
                                        <button id="btnSaveApproval" data-id="<?php echo e($project->id); ?>" class="btn btn-success center-block btnSaveApproval" type="button">
                                            <i class="fa fa-thumbs-up"></i>
                                            <strong>Approve</strong>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>


                            <?php if($allowQuestions): ?>
                                <div class="groupQuestions">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="actionQuestions" data-id="<?php echo e($project->id); ?>">
                                                    <h4 class="panel-title">
                                                        Questions Group 1
                                                    </h4>
                                                </a>
                                            </div>
                                            <div id="collapse1" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>Tell us when and how you thought of your invention.</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="hisIdea" name="hisIdea"> <?php echo e($project->hisIdea); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>How does your new invention WORK, OPERATE or FUNCTION.</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="descIdea" name="descIdea"> <?php echo e($project->descIdea); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What similar product is on the market now? (Similar, but not the same).</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="similarProduct" name="similarProduct"> <?php echo e($project->similarProduct); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <button id="btnSaveProject1" data-id="<?php echo e($project->id); ?>" data-next="2" data-tab="1" class="btn btn-success center-block btnSave btnSaveProject" type="button">
                                                            <i class="fa fa-floppy-o"></i>
                                                            <strong>Save And Continue</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="actionQuestions" data-id="<?php echo e($project->id); ?>">
                                                    <h4 class="panel-title">
                                                        Questions Group 2
                                                    </h4>
                                                </a>
                                            </div>
                                            <div id="collapse2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>How is your new invention DIFFERENT from other similar ideas? (Uniqueness)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="uniIdea" name="uniIdea"> <?php echo e($project->uniIdea); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What PROBLEM does your idea solve? What are the advantages and benefits of your idea's solution?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="probIdea" name="probIdea"> <?php echo e($project->probIdea); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>How much will it cost to produce your idea?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="costSpend" name="costSpend"> <?php echo e($project->costSpend); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-4">
                                                        <button id="btnBackProject2" data-id="<?php echo e($project->id); ?>" data-back="1" data-tab="2" class="btn btn-info center-block btnSave btnBack" type="button">
                                                            <i class="fa fa-arrow-left"></i>
                                                            <strong>Back</strong>
                                                        </button>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-8">
                                                        <button id="btnSaveProject2" data-id="<?php echo e($project->id); ?>" data-next="3" data-tab="2" class="btn btn-success center-block btnSave btnSaveProject" type="button">
                                                            <i class="fa fa-floppy-o"></i>
                                                            <strong>Save And Continue</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="actionQuestions" data-id="<?php echo e($project->id); ?>">
                                                    <h4 class="panel-title">
                                                        Questions Group 3
                                                    </h4>
                                                </a>
                                            </div>
                                            <div id="collapse3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>How much will you sell it for?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="payIdea" name="payIdea"> <?php echo e($project->payIdea); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What technical field(s) does your project fall into:? (Hold the Ctrl or ⌘ button to make multiple selections)</label>
                                                        <select multiple="" id="techField" name="techField" class="form-control" >
                                                            <option value="agriculture" <?php echo e(strpos($project->techField, 'agriculture')!==false ?" selected":""); ?>>agriculture</option>
                                                            <option value="apparel/accessories" <?php echo e(strpos($project->techField, 'apparel/accessories')!==false ?" selected":""); ?>>apparel/accessories</option>
                                                            <option value="arts/crafts/graphics" <?php echo e(strpos($project->techField, 'arts/crafts/graphics')!==false ?" selected":""); ?>>arts/crafts/graphics</option>
                                                            <option value="automotive/vehicle" <?php echo e(strpos($project->techField, 'automotive/vehicle')!==false ?" selected":""); ?>>automotive/vehicle</option>
                                                            <option value="drug/beauty educational" <?php echo e(strpos($project->techField, 'drug/beauty educational')!==false ?" selected":""); ?>>drug/beauty educational</option>
                                                            <option value="electronics fuel/energy" <?php echo e(strpos($project->techField, 'electronics fuel/energy')!==false ?" selected":""); ?>>electronics fuel/energy</option>
                                                            <option value="food/beverage/tobacco" <?php echo e(strpos($project->techField, 'food/beverage/tobacco')!==false ?" selected":""); ?>>food/beverage/tobacco</option>
                                                            <option value="hardware – building product" <?php echo e(strpos($project->techField, 'hardware – building product')!==false ?" selected":""); ?>>hardware – building product</option>
                                                            <option value="hardware – tools" <?php echo e(strpos($project->techField, 'hardware – tools')!==false ?" selected":""); ?>>hardware – tools</option>
                                                            <option value="household – decorative" <?php echo e(strpos($project->techField, 'household – decorative')!==false ?" selected":""); ?>>household – decorative</option>
                                                            <option value="household – cleaning" <?php echo e(strpos($project->techField, 'household – cleaning')!==false ?" selected":""); ?>>household – cleaning</option>
                                                            <option value="household – tools/gadget" <?php echo e(strpos($project->techField, 'household – tools/gadget')!==false ?" selected":""); ?>>household – tools/gadget</option>
                                                            <option value="household – other" <?php echo e(strpos($project->techField, 'household – other')!==false ?" selected":""); ?>>household – other</option>
                                                            <option value="lawn/garden" <?php echo e(strpos($project->techField, 'lawn/garden')!==false ?" selected":""); ?>>lawn/garden</option>
                                                            <option value="medical/therapeutic" <?php echo e(strpos($project->techField, 'medical/therapeutic')!==false ?" selected":""); ?>>medical/therapeutic</option>
                                                            <option value="miscellaneous/other" <?php echo e(strpos($project->techField, 'miscellaneous/other')!==false ?" selected":""); ?>>miscellaneous/other</option>
                                                            <option value="music" <?php echo e(strpos($project->techField, 'music')!==false ?" selected":""); ?>>music</option>
                                                            <option value="novelty" <?php echo e(strpos($project->techField, 'novelty')!==false ?" selected":""); ?>>novelty</option>
                                                            <option value="pets" <?php echo e(strpos($project->techField, 'pets')!==false ?" selected":""); ?>>pets</option>
                                                            <option value="restaurant/hospitality" <?php echo e(strpos($project->techField, 'restaurant/hospitality')!==false ?" selected":""); ?>>restaurant/hospitality</option>
                                                            <option value="safety" <?php echo e(strpos($project->techField, 'safety')!==false ?" selected":""); ?>>safety</option>
                                                            <option value="seasonal" <?php echo e(strpos($project->techField, 'seasonal')!==false ?" selected":""); ?>>seasonal</option>
                                                            <option value="sports/fitness/recreation" <?php echo e(strpos($project->techField, 'sports/fitness/recreation')!==false ?" selected":""); ?>>sports/fitness/recreation</option>
                                                            <option value="stationery/office" <?php echo e(strpos($project->techField, 'stationery/office')!==false ?" selected":""); ?>>stationery/office</option>
                                                            <option value="technology" <?php echo e(strpos($project->techField, 'technology')!==false ?" selected":""); ?>>technology</option>
                                                            <option value="toys/hobbies" <?php echo e(strpos($project->techField, 'toys/hobbies')!==false ?" selected":""); ?>>toys/hobbies</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What companies, groups of people, products, processes or services could use your idea?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="targetMarket" name="targetMarket"> <?php echo e($project->targetMarket); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-4">
                                                        <button id="btnBackProject2" data-id="<?php echo e($project->id); ?>" data-back="2" data-tab="3" class="btn btn-info center-block btnSave btnBack" type="button">
                                                            <i class="fa fa-arrow-left"></i>
                                                            <strong>Back</strong>
                                                        </button>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-8">
                                                        <button id="btnSaveProject3" data-id="<?php echo e($project->id); ?>" data-next="4" data-tab="3" class="btn btn-success center-block btnSave btnSaveProject" type="button">
                                                            <i class="fa fa-floppy-o"></i>
                                                            <strong>Save And Continue</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="actionQuestions" data-id="<?php echo e($project->id); ?>">
                                                    <h4 class="panel-title">
                                                        Questions Group 4
                                                    </h4>
                                                </a>
                                            </div>
                                            <div id="collapse4" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What upgrades or modifications can you suggest to improve functionality, packaging, appeal, versatility, mechanics or affordability to a manufacturer or end user?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="modifications" name="modifications"> <?php echo e($project->modifications); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>Describe the environment (wet, dry, temperature, pressure, light, dark, etc.) in which your idea will function?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="environment" name="environment"> <?php echo e($project->environment); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>If your idea is a "device", what does it consume or produce? And what powers it? (Manual, electricity, gasoline, sunlight, water power, batteries, etc.)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="device" name="device"> <?php echo e($project->device); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>Any additional comments or information you wish to volunteer about yourself (inventor), any co-inventors or the invention</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="addNotes" name="addNotes"> <?php echo e($project->addNotes); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                        <button id="btnBackProject2" data-id="<?php echo e($project->id); ?>" data-back="3" data-tab="4" class="btn btn-info center-block btnSave btnBack" type="button">
                                                            <i class="fa fa-arrow-left"></i>
                                                            <strong>Back</strong>
                                                        </button>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                        <button id="btnSaveProject2" data-id="<?php echo e($project->id); ?>" data-next="1" data-tab="4" class="btn btn-success center-block btnSave btnSaveProject" type="button">
                                                            <i class="fa fa-floppy-o"></i>
                                                            <strong>Save</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="portlet_tab_2"  role="tabpanel">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>List all Inventors</label> <span id="editCoInventors" style="margin-left: 15px;cursor: pointer;"><i class="fa fa-edit"></i>Edit Co-Inventors</span>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="coInventor" class="form-control" value="<?php echo e($project->coInventor); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>Coinventor Relation</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="coInventorRelation" class="form-control" value="<?php echo e($project->coInventorRelation); ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>Primary Inventor Occupation</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                                    <input type="text" id="occupation" class="form-control" value="<?php echo e($project->lead->occupation); ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>List all Third-Party Authorized Contacts</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="tpaContact" class="form-control" value="<?php echo e($project->tpaContact); ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>Has a patent attorney been hired?</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                    <select class="form-control" id="patentSearch">
                                        <option <?php echo e($project->patentSearch==0?"selected":""); ?> value="0">No</option>
                                        <option <?php echo e($project->patentSearch==1?"selected":""); ?> value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>Has a licensing agency been hired?</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                    <select class="form-control" id="patented">
                                        <option <?php echo e($project->patented==0?"selected":""); ?> value="0">No</option>
                                        <option <?php echo e($project->patented==1?"selected":""); ?> value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <?php if($pcs == null): ?>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <button id="btnSaveInventors" data-id="<?php echo e($project->id); ?>" class="btn btn-success center-block btnSave btnSaveInventors" type="button">
                                        <i class="fa fa-floppy-o"></i>
                                        <strong>Save</strong>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if($pcs != null): ?>
                            <div class="tab-pane active" id="portlet_tab_3"  role="tabpanel">
                                <?php if($pcs->rcvdDate!='0000-00-00 00:00:00'): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">PATENT PROTECTION AGREEMENT PAYMENT DATE: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime($pcs->rcvdDate))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($pcs->ppaSent_created_at!=''): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">AGREEMENT FOR PATENT SERVICES & DUE DILIGENCE REVIEW SENT DATE: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$pcs->ppaSent_created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($pcs->ddrReceived_created_at!=''): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">AGREEMENT FOR PATENT SERVICES & DUE DILIGENCE REVIEW RECEIVED DATE: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$pcs->ddrReceived_created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($pcs->emailSent_created_at!=''): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div  class="col-md-9">
                                            <label><a href="<?php echo e(asset('files/omi/Welcome to Patent Services USA.pdf')); ?>" target="_blank" class="welcomeEmLCLabel">WELCOME EMAIL SENT DATE:</a></label>
                                            <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;" title="Welcome to Patent Services, client services department. During the next few weeks we will be coordinating all activities with the attorney on your behalf. Please consider client services as your primary point of contact moving forward. The client services department is available to speak with you at your convenience Monday – Friday, 8am-5pm est. Our contact number is 1-888-344-6836. We are excited to be a part of your team."></i>
                                        </div>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$pcs->emailSent_created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($pcs->emailCall_created_at!=''): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div  class="col-md-9">
                                            <label>INTRO CALL DATE: </label>
                                            <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;" title="The client services department at Patent Services has contacted you to introduce the department as they will be servicing your patent moving forward. A client services representative is available to speak with you at your convenience during normal business hours, Monday – Friday, 8am-5pm est. If you need assistance or have questions about the patent process, please contact the client services department at 1-888-344-6836."></i>
                                        </div>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$pcs->emailCall_created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($pcs->appSent_created_at!=''): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">PATENT APPLICATION SENT DATE: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$pcs->appSent_created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($pcs->patentAppApproved_created_at!=''): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">PATENT APPLICATION APPROVED DATE: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$pcs->patentAppApproved_created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($pcs->marketingAgrSent_created_at!=''): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">ILC MARKETING AGREEMENT AND RECEIPT USPTO SENT DATE: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$pcs->marketingAgrSent_created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($pcs->marketingAgrReceived_created_at!=''): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">ILC MARKETING AGREEMENT RECEIVED DATE: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$pcs->marketingAgrReceived_created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php $__currentLoopData = $updateEmails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-9">
                                            <label>
                                                UPDATE EMAIL FROM CLIENT SERVICES(<?php echo e($email->params); ?>)
                                            </label>
                                            <?php if($email->params == '3 months'): ?>
                                                <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;"
                                                   title="Congratulations on taking important steps towards the development of your invention, this is a tremendous accomplishment! Your courage and entrepreneurial spirit will carry you, to realizing your dream. Currently, we are continuing to monitor your patent application with the Independent Registered Patent attorney, every effort is being made to assist the attorney."></i>
                                            <?php elseif($email->params == '6 months'): ?>
                                                <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;"
                                                   title="Currently, we are continuing to monitor your patent application with the Independent Registered Patent attorney, every effort is being made to assist the attorney. The patent application is published with the United States Patent and Trademark Office approximately 18 months after the filing date of the application, and then the status of the application can be viewed on USPTO's PAIR service (http://portal.uspto.gov/external/portal/pair). Until the application is published, the application information is not viewable. Please note it usually takes 18-24 months for the USPTO to start the examination process. Sometimes office action will occur before the application is published, and we will send you a copy of  such office actions when we receive them. Any questions do not hesitate to contact me."></i>
                                            <?php elseif($email->params == '12 months'): ?>
                                                <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;"
                                                   title="Currently, we are continuing to monitor your patent application with the Independent Registered Patent attorney, every effort is being made to assist the attorney.
 Your patent was filed on <?php echo e(date('m/d/Y',strtotime($pcs->patentAppFiled_created_at))); ?> -Application number is <?php echo e($pcs->patentAppNo); ?>"></i>
                                            <?php endif; ?>:
                                        </div>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$email->created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $updateAfterYearEmails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">UPDATE EMAIL FROM CLIENT SERVICES AFTER 1 YEAR: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e(date('m-d-Y', strtotime(str_replace('-','/',$email->created_at)))); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($pcs!=null  && $ilcInfo['exist'] == 1): ?>
                            <div class="tab-pane" id="portlet_tab_4"  role="tabpanel">
                                <?php if($ilcInfo['contractDate'] != -1): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">THE AGREEMENT START ON: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e($ilcInfo['contractDate']); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($ilcInfo['welcomePkcg'] != -1): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">YOU RECEIVED A WELCOME PACKAGE ON: <?php if($ilcInfo['welcomePackEmail'] != -1): ?>&nbsp;&nbsp;&nbsp;&nbsp;(<a href="<?php echo e(url($ilcInfo['welcomePackEmail'])); ?>" target='_blank'>PDF</a>) <?php endif; ?></label>
                                        <div class="col-md-3">
                                            <p><?php echo e($ilcInfo['welcomePkcg']); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($ilcInfo['introCall'] != -1): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">YOU RECEIVED AN INTRO CALL ON: </label>
                                        <div class="col-md-3">
                                            <p><?php echo e($ilcInfo['introCall']); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($ilcInfo['introCallEmail'] != -1): ?>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">YOU RECEIVED INTRO EMAIL ON:<?php if($ilcInfo['introCallILCEmail'] != -1): ?>&nbsp;&nbsp;&nbsp;&nbsp;(<a href="<?php echo e(url($ilcInfo['introCallILCEmail'])); ?>" target='_blank'>PDF</a>) <?php endif; ?></label>
                                        <div class="col-md-3">
                                            <p><?php echo e($ilcInfo['introCallEmail']); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($ilcInfo['courtesyUpdate'] != -1): ?>
                                    <?php $__currentLoopData = $ilcInfo['courtesyUpdate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courtesy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="col-md-9">YOU RECEIVED AN UPDATE EMAIL ON: <?php if($courtesy[1] != -1): ?>&nbsp;&nbsp;&nbsp;&nbsp;(<a href="<?php echo e(url($courtesy[1])); ?>" target='_blank'>PDF</a>) <?php endif; ?></label>
                                            <div class="col-md-3">
                                                <p><?php echo e($courtesy[0]); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                    <?php if($ilcInfo['website'] != -1): ?>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="col-md-9">WEBSITE DATE: </label>
                                            <div class="col-md-3">
                                                <p><?php echo e($ilcInfo['website']); ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($ilcInfo['subEmail'] != -1): ?>
                                        <?php $__currentLoopData = $ilcInfo['subEmail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label class="col-md-9">A SUBMISSION EMAIL WAS SENT TO MANUFACTURER ON:<?php if($sub[1] != -1): ?>&nbsp;&nbsp;&nbsp;&nbsp;(<a href="<?php echo e(url($sub[1])); ?>" target='_blank'>PDF</a>) <?php endif; ?> </label>
                                                <div class="col-md-3">
                                                    <p><?php echo e($sub[0]); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($ilcInfo['separationDate'] != -1): ?>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="col-md-9"><?php echo e($ilcInfo['separationType']); ?> <?php if($ilcInfo['separationFile'] != -1): ?>&nbsp;&nbsp;&nbsp;&nbsp;(<a href="<?php echo e(url($ilcInfo['separationFile'])); ?>" target='_blank'>PDF</a>) <?php endif; ?></label>
                                            <div class="col-md-3">
                                                <p><?php echo e($ilcInfo['separationDate']); ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 " id="fileList_<?php echo e($project->id); ?>">
                <span class="fileListSpan">LIST OF FILES:</span></br></br>
                <?php $__currentLoopData = $project->filesByType(array('public','clientVendor')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12 col-sm-12 col-xs-12" id="divFile_<?php echo e($file->id); ?>"><span title="<?php echo e($file->fileName); ?>&nbsp;&nbsp;&nbsp;<?php echo e($file->created_at); ?>"><a href="<?php echo e(asset("/".$file->url)); ?>" target="_blank"><?php echo e(strlen($file->fileName)>25?substr($file->fileName,0,23).'...':$file->fileName); ?></a></span></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php echo $__env->make('omi.tools.addPpaPlanModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('omi.launch.client_services.editCoInvModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('omi.launch.client_services.clientEmailModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('omi.launch.client_services.signModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('omi.layout.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>