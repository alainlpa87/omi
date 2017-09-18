<div class="portlet col-md-12 portlet-new" id="container_<?php echo e($currentRequest->id); ?>"  data-id = "<?php echo e($project->id); ?>" data-request-id="<?php echo e($currentRequest->id); ?>" data-lead-id="<?php echo e($project->lead->id); ?>" data-date-action="<?php echo e($project->actionDate); ?>">
    <div class="box call">
        <div class="portlet-title">
            <div class="caption">
                <i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<span id="captionFullName_<?php echo e($project->id); ?>"><?php echo e($project->lead->lname.", ".$project->lead->fname); ?></span> - <?php echo e($project->lead->fileno); ?> - <?php echo e($project->lead->leadSource); ?>

            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li>
                    <a href="#portlet_tab_<?php echo e($currentRequest->id); ?>_4" data-toggle="tab" role="tab"> BUSINESS PROFILE </a>
                </li>
                <li>
                    <a href="#portlet_tab_<?php echo e($currentRequest->id); ?>_3" data-toggle="tab" role="tab"> PROJECT </a>
                </li>
                <li class="active">
                    <a href="#portlet_tab_<?php echo e($currentRequest->id); ?>_1" data-toggle="tab" role="tab"> CLIENT </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body" id="portletBody_<?php echo e($project->id); ?>">
            <div class="tab-content col-md-12">
                <div class="tab-pane active" id="portlet_tab_<?php echo e($currentRequest->id); ?>_1" role="tabpanel">
                    <div class="col-md-12 vendorBox">
                        <div class="col-md-3">
                            <input type="checkbox" class="checkVendor" id="checkVendors_<?php echo e($currentRequest->id); ?>" data-projectId="<?php echo e($project->id); ?>" <?php echo e($project->vendor==1?"checked":""); ?>>
                            <span> Available for Vendors</span>
                        </div>
                        <div class="col-md-3">
                            <span>Payment:</span>
                            <?php if($project->lastContractPaidDate() != '0000-00-00 00:00:00' && $project->lastContractPaidDate() != ''): ?>
                                <span><?php echo e(date('m-d-Y',strtotime(str_replace('-','/',$project->lastContractPaidDate())))); ?></span>
                            <?php else: ?>
                                <span>N/A</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-2">
                            <span class="redNMI">
                                <?php if($project->pendingNMI > 0): ?>
                                    But NMI
                                <?php endif; ?>
                            </span>
                        </div>
                        <?php if($project->totalPhase1AmountIn() != ''): ?>
                            <div class="col-md-2">
                                Phase1: <?php echo e(money_format('%=#10.2n',$project->totalPhase1AmountIn())); ?>

                            </div>
                        <?php endif; ?>
                        <?php if($project->contractPPA() != '' && $project->contractPPA()->paid > 0): ?>
                            <div class="col-md-2">
                                Phase2: <?php echo e(money_format('%=#10.2n',$project->contractPPA()->paid)); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12 boxProjectInfo">
                        <div class="col-md-3">
                            <?php if($currentRequest->created_at != '0000-00-00 00:00:00'): ?>
                                <p id="creation_p_<?php echo e($project->id); ?>"><?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$currentRequest->created_at)))); ?></p>
                            <?php else: ?>
                                <p id="creation_p_<?php echo e($project->id); ?>"><?php echo e($currentRequest->created_at); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <i><strong><p id="request_p_<?php echo e($project->id); ?>">
                                        <?php echo e("REQUEST: ".$currentRequest->consultantStage); ?>

                                    </p></strong></i>
                        </div>
                        <div class="col-md-4">
                            <i class="fa fa-print fa-3 printProject adminIcons" data-toggle="tooltip" data-placement="bottom" title="Print Submission" data-id = "<?php echo e($project->id); ?>" ></i>
                            <i class="fa fa-folder-open fa-3 openFilesAdmin adminIcons" data-toggle="tooltip" data-placement="bottom" title="Open Files" data-id = "<?php echo e($project->id); ?>" ></i>
                            <i class="fa fa-upload fa-3 uploadFilesAdmin adminIcons" data-toggle="tooltip" data-placement="bottom" title="Upload Files" data-id = "<?php echo e($project->id); ?>" ></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <i><h4>Inventor Detail:</h4></i>
                        <div class="col-md-6">
                            <h5>Inventor Name:</h5>
                            <p class="pProjectInfo" id="pProjectInfoFullName_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->fname)>0?$project->lead->fname." ".$project->lead->lname:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Co-inventor Name:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->coInventor)>0?$project->coInventor:"N/A"); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5>Street:</h5>
                            <p class="pProjectInfo" id="pProjectInfoStreet_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->street)>0?$project->lead->street:"N/A"); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5>City:</h5>
                            <p class="pProjectInfo" id="pProjectInfoCity_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->city)>0?$project->lead->city:"N/A"); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5>State:</h5>
                            <p class="pProjectInfo" id="pProjectInfoState_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->state)>0?$project->lead->state:"N/A"); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5>Zip:</h5>
                            <p class="pProjectInfo" id="pProjectInfoZip_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->zip)>0?$project->lead->zip:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Mobile:</h5>
                            <p class="pProjectInfo" id="pProjectInfoPhone_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->phone)>0?$project->lead->phone:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Home Phone:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->phone2)>0?$project->lead->phone2:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4>Consultant: <?php echo e($project->consultant->usr); ?></h4>
                        </div>
                        <div class="col-md-6">
                            <h4>Pin: <?php echo e($project->id); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_<?php echo e($currentRequest->id); ?>_3" role="tabpanel">
                    <div class="col-md-12">
                        <i><h4>Invention Detail:</h4></i>
                        <h5>Name Of Invention:</h5>
                        <p  class="pProjectInfo" id="ideaname_<?php echo e($project->id); ?>"><?php echo e(strlen($project->ideaName)>0?$project->ideaName:"N/A"); ?></p>
                        <h5>Invention Short Description:</h5>
                        <p  class="pProjectInfo"><?php echo e(strlen($project->ideaConcept)>0?$project->ideaConcept:"N/A"); ?></p>

                        <div class="col-md-2 approveBox adminActions" data-requestid="<?php echo e($currentRequest->id); ?>" data-action="APPROVED">
                            <span class="spanRequestApprove"><i class="fa fa-thumbs-up fa-2x green"></i></span>
                        </div>
                        <div class="col-md-1">
                            <span></span>
                        </div>
                        <div class="col-md-2 approveNmiBox adminActions" data-requestid="<?php echo e($currentRequest->id); ?>" data-action="APPROVED BUT NMI">
                            <span class="spanRequestApproveNmi"><i class="fa fa-thumbs-up fa-2x"></i><i class="fa fa-question-circle fa-2x"></i></span>
                        </div>
                        <div class="col-md-1">
                            <span></span>
                        </div>
                        <div class="col-md-2 nmiBox adminActions" data-requestid="<?php echo e($currentRequest->id); ?>" data-action="NEEDS MORE INFO">
                            <span class="spanRequestNmi"><i class="fa fa-question-circle fa-2x dodgerblue"></i></span>
                        </div>
                        <div class="col-md-1">
                            <span></span>
                        </div>
                        <div class="col-md-2 rejectBox adminActions" data-requestid="<?php echo e($currentRequest->id); ?>" data-action="REJECTED">
                            <span class="spanRequestReject"><i class="fa fa-thumbs-down fa-2x red"></i></span>
                        </div>
                        <div class="col-md-1">
                            <span></span>
                        </div>
                        <h5>Consultant notes:</h5>
                        <p class="pProjectInfo"><?php echo e($project->internalNotes); ?></p>
                        <h5>Admin Notes</h5>
                        <textarea class="adminNotes editableval col-md-12 col-xs-12" data-projectId="<?php echo e($project->id); ?>" data-requestId="<?php echo e($currentRequest->id); ?>"><?php echo e($currentRequest->adminNotes); ?></textarea>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_<?php echo e($currentRequest->id); ?>_4" role="tabpanel">
                    <h3><i class="fa fa-print fa-3 printBusiness" data-toggle="tooltip" data-placement="bottom" title="Print Submission" data-id = "<?php echo e($project->id); ?>" ></i></h3>
                    <div class="col-md-12">
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
                        <div class="col-md-6">
                            <h5>Is your idea software or an app?:</h5>
                            <p  class="pProjectInfo"><?php echo e($project->isApp == 1?"Yes":"No"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Programming Language:</h5>
                            <p  class="pProjectInfo"><?php echo e($project->language!=''?ucwords($project->language):"N/A"); ?></p>
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
                            <p class="pProjectInfo">
                                <?php echo e(strlen($project->lead->birth)>0?date('m-d-Y h:i:s',strtotime(str_replace('-','/',$project->lead->birth))):"N/A"); ?>

                            </p>
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
                        <h4>Inventor Information Correction</h4>
                        <div class="col-md-6">
                            <h5>Inventor Name:</h5>
                            <p class="pProjectInfo" id="pProjectInfoFullName_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->fname)>0?$project->lead->fname." ".$project->lead->lname:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Co-inventor Name:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->coInventor)>0?$project->coInventor:"N/A"); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5>Street:</h5>
                            <p class="pProjectInfo" id="pProjectInfoStreet_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->street)>0?$project->lead->street:"N/A"); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5>City:</h5>
                            <p class="pProjectInfo" id="pProjectInfoCity_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->city)>0?$project->lead->city:"N/A"); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5>State:</h5>
                            <p class="pProjectInfo" id="pProjectInfoState_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->state)>0?$project->lead->state:"N/A"); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h5>Zip:</h5>
                            <p class="pProjectInfo" id="pProjectInfoZip_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->zip)>0?$project->lead->zip:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Mobile:</h5>
                            <p class="pProjectInfo" id="pProjectInfoPhone_<?php echo e($project->id); ?>"><?php echo e(strlen($project->lead->phone)>0?$project->lead->phone:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Home Phone:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->phone2)>0?$project->lead->phone2:"N/A"); ?></p>
                        </div>
                        <div class="col-md-12">
                            <h5>Inventors:</h5>
                            <p class="pProjectInfo"><?php echo e(strlen($project->coInventor)>0?$project->lead->fname." ".$project->lead->lname.",".$project->coInventor:$project->lead->fname." ".$project->lead->lname); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>