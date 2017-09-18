<div class="portlet col-md-12 portlet-new" id="container_<?php echo e($project->id); ?>"  style="height: 40px" data-id = "<?php echo e($project->id); ?>" data-request-id="<?php echo e($project->id); ?>" data-lead-id="<?php echo e($project->lead->id); ?>" data-date-action="<?php echo e($project->actionDate); ?>">
    <div class="box call">
        <div class="portlet-title">
            <div class="indicator caption" style="z-index: 100" data-id="<?php echo e($project->id); ?>">
                &nbsp;<i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<span id="captionFullName_<?php echo e($project->id); ?>"><?php echo e($project->lead->lname.", ".$project->lead->fname); ?></span> - <?php echo e($project->lead->fileno); ?>

                <i class="pull-left fa fa-chevron-down"  id="indicator_<?php echo e($project->id); ?>"></i>
                <?php if($projectp->completed==2): ?>
                    &nbsp;&nbsp;<span style="color: red;">This file needs to be sent it back within 24 hours.</span>
                <?php endif; ?>
                <?php if($project->contractIIG() != ""): ?>

                    <?php if($project->contractIIG()->paid >= 1179 && Session::get('user_id') == 45): ?>
                        &nbsp;&nbsp;<span style="color: red;">This file needs a Press Release.</span>
                    <?php endif; ?>
                <?php elseif($project->contractIGUP() != ""): ?>
                    <?php if($project->contractIGUP()->paid >= 930 && Session::get('user_id') == 45): ?>
                        &nbsp;&nbsp;<span style="color: red;">This file needs a Press Release.</span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="portlet-body hide" id="portletBody_<?php echo e($project->id); ?>">
            <div class="tab-content col-md-12 portlet_tab_content_<?php echo e($project->id); ?>" style="display: none">
                <div class="tab-pane active" id="portlet_tab_<?php echo e($project->id); ?>_4" role="tabpanel">
                    <div class="col-md-4 pull-right"  style="margin-top: 25px;">
                        <i class="fa fa-print fa-3 printBusinessVendor adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Print" data-id = "<?php echo e($project->id); ?>" ></i>
                        <i class="fa fa-folder-open fa-3 openFilesVendor adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Open Files" data-id = "<?php echo e($project->id); ?>" ></i>
                        <i class="fa fa-upload fa-3 uploadFilesVendorProject adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Upload Files" data-id = "<?php echo e($project->id); ?>" ></i>
                    </div>
                    <div class="col-md-12">
                        <?php if($projectp->completed==2): ?>
                        <h5 style="font-weight: bold;color: rgb(157, 12, 12);">Return Reason:</h5>
                        <p class="pProjectInfo" style="background-color: bisque;"><?php echo e(strlen($projectp->returnedReason)>0?$projectp->returnedReason:"N/A"); ?></p>
                        <?php endif; ?>
                        <h5>Invention Name:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->ideaName)>0?$project->ideaName:"N/A"); ?></p>
                        <h5>Invention Short Description:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->ideaConcept)>0?$project->ideaConcept:"N/A"); ?></p>
                        <h5>Describe what makes your idea unique, how it looks/works:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->ideaConcept)>0?$project->ideaConcept:"N/A"); ?></p>
                        <h5>Give us the details of your product's function and parts. (How does it work, materials, etc.):</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->descIdea)>0?$project->descIdea:"N/A"); ?></p>
                        <h5>Tell us when and how you thought of your invention:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->hisIdea)>0?$project->hisIdea:"N/A"); ?></p>
                        <h5>What similar product is on the market now?(Similar, but not the same):</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->similarProduct)>0?$project->similarProduct:"N/A"); ?></p>
                        <h5>Why do you believe your idea is unique, different or better?:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->uniIdea)>0?$project->uniIdea:"N/A"); ?></p>
                        <h5>What Problem does your idea solve?What are the advantages and benefits of your idea's solution?:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->propIdea)>0?$project->propIdea:"N/A"); ?></p>
                        <div class="col-md-6">
                            <h5>How much will it cost to produce your idea?:</h5>
                            <p  class="pProjectInfo"><?php echo e(strlen($project->costSpend)>0?$project->costSpend:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>How much will you sell it for?</h5>
                            <p  class="pProjectInfo"><?php echo e(strlen($project->payIdea)>0?$project->payIdea:"N/A"); ?></p>
                        </div>
                        <h5>What technical field(s) does your project fall into?:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->techField)>0?$project->techField:"N/A"); ?></p>
                        <h5>What companies, groups of people, products, processes or services could use your idea?:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->targetMarket)>0?$project->targetMarket:"N/A"); ?></p>
                        <h5>What upgrades or modifications can you suggest to improve functionality, packaging, appeal, versatility, mechanics or affordability to a manufacturer or end user?:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->modifications)>0?$project->modifications:"N/A"); ?></p>
                        <h5>Describe the environment (wet, dry, temperature, pressure, light, dark, etc.) in which your idea will function?:
                            If your idea is a "device", what does it consume or produce? And what powers it? (Manual, electricity, gasoline, sunlight, water power, batteries, etc.):</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->environment)>0?$project->environment:"N/A"); ?></p>
                        <h5>Any additional comments or information you wish to volunteer about yourself (inventor), any co-inventors or the invention?:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->addNotes)>0?$project->addNotes:"N/A"); ?></p>
                    </div>
                    <div class="col-md-12">
                        <h4>Inventor Profile</h4>
                        <div class="col-md-4">
                            <h5>Client Email:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->email)>0?$project->lead->email:"N/A"); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5>Profession:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->profession)>0?$project->lead->profession:"N/A"); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5>College:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->college)>0?$project->lead->college:"N/A"); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5>Degree:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->degree)>0?$project->lead->degree:"N/A"); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5>Spouse Name:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->spouse)>0?$project->lead->spouse:"N/A"); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5>Married:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->married)>0?$project->lead->married:"N/A"); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5>Date of Birth:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->birth)>0?date('m-d-Y h:i:s',strtotime(str_replace('-','/',$project->lead->birth))):"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Children:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->children)>0?$project->lead->children:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Hobby:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->hobby)>0?$project->lead->hobby:"N/A"); ?></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h5>Consultant notes:</h5>
                            <p class="pProjectInfo"><?php echo e($project->internalNotes); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>