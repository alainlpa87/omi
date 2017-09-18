<div class="portlet portlet-new" id="container_<?php echo e($project->id); ?>" style="height: auto;"  data-id = "<?php echo e($project->id); ?>" data-request-id="<?php echo e($project->id); ?>" data-lead-id="<?php echo e($project->lead->id); ?>" data-date-action="<?php echo e($project->actionDate); ?>" data-iid = "<?php echo e($projectilc->id); ?>">
    <div class="box call">
        <div class="portlet-title">
            <div class="indicator caption"  style="z-index: 100" data-id="<?php echo e($project->id); ?>">
                <i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<span id="captionFullName_<?php echo e($project->id); ?>"><?php echo e($project->lead->lname.", ".$project->lead->fname); ?></span> - <?php echo e($project->lead->fileno); ?> - <?php echo e($project->lead->leadSource); ?>

            </div>
            <ul class="nav nav-tabs"  id="navTabs_<?php echo e($project->id); ?>" role="tablist">
                
                
                
                <li>
                    <a href="#portlet_tab_<?php echo e($project->id); ?>_2" data-toggle="tab" role="tab"> ILC</a>
                </li>
                <li class="active">
                    <a href="#portlet_tab_<?php echo e($project->id); ?>_1" data-toggle="tab" role="tab"> CLIENT </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body" id="portletBody_<?php echo e($project->id); ?>">
            <div class="tab-content col-md-12 portlet_tab_content_<?php echo e($project->id); ?>" style="display: block">
                <div class="tab-pane active" id="portlet_tab_<?php echo e($project->id); ?>_1" role="tabpanel">
                    <div class="col-md-12 boxProjectInfo">
                        <div class="col-md-3">
                            <?php if($projectilc->created_at != '0000-00-00 00:00:00'): ?>
                                <p id="creation_p_<?php echo e($project->id); ?>"><?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectilc->created_at)))); ?></p>
                            <?php else: ?>
                                <p id="creation_p_<?php echo e($project->id); ?>"><?php echo e($projectilc->created_at); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <i><strong><p id="request_p_<?php echo e($project->id); ?>">
                                        <?php echo e("REQUEST: ".$project->consultantStage); ?>

                                    </p></strong></i>
                        </div>
                        <div class="col-md-4">
                            <i class="fa fa-print fa-3 printProjectILC adminIcons" data-toggle="tooltip" data-placement="bottom" title="Print Submission" data-id = "<?php echo e($project->id); ?>" ></i>
                            <i class="fa fa-folder-open fa-3 openFilesILC adminIcons" data-toggle="tooltip" data-placement="bottom" title="Open Files" data-iid="<?php echo e($projectilc->id); ?>" data-id = "<?php echo e($project->id); ?>" ></i>
                            <i class="fa fa-upload fa-3 uploadFilesILC adminIcons" data-toggle="tooltip" data-placement="bottom" title="Upload Files" data-id = "<?php echo e($project->id); ?>" ></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <i><h4>Inventor Detail:</h4></i>
                        <div class="col-md-3">
                            <h5>Inventor First Name:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="<?php echo e($projectilc->id); ?>" data-field="invFname" id="pProjectInfoFirstName_<?php echo e($projectilc->id); ?>" value="<?php echo e(strlen($projectilc->invFname)>0?$projectilc->invFname:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Inventor Last Name:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="<?php echo e($projectilc->id); ?>" data-field="invLname" id="pProjectInfoLastName_<?php echo e($projectilc->id); ?>" value="<?php echo e(strlen($projectilc->invFname)>0?$projectilc->invLname:"N/A"); ?>">
                        </div>
                        <div class="col-md-6">
                            <h5>Co-inventor Name:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="<?php echo e($projectilc->id); ?>" data-field="coInvs" id="pProjectInfoCoInvName_<?php echo e($projectilc->id); ?>" value="<?php echo e(strlen($projectilc->coInvs)>0?$projectilc->coInvs:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5><b>Invention Name:</b></h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="<?php echo e($projectilc->id); ?>" data-field="inventionName" id="pProjectInfoStreet_<?php echo e($projectilc->id); ?>" value="<?php echo e(strlen($projectilc->inventionName)>0?$projectilc->inventionName:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Street:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="<?php echo e($projectilc->id); ?>" data-field="street" id="pProjectInfoStreet_<?php echo e($projectilc->id); ?>" value="<?php echo e(strlen($projectilc->street)>0?$projectilc->street:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>City:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-id="<?php echo e($project->id); ?>" data-field="city" id="pProjectInfoCity_<?php echo e($projectilc->id); ?>" value="<?php echo e(strlen($projectilc->city)>0?$projectilc->city:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>State:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="<?php echo e($projectilc->id); ?>" data-field="state" id="pProjectInfoState_<?php echo e($projectilc->id); ?>" value="<?php echo e(strlen($projectilc->state)>0?$projectilc->state:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Zip:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="<?php echo e($projectilc->id); ?>" data-field="zip" id="pProjectInfoZip_<?php echo e($projectilc->id); ?>" value="<?php echo e(strlen($projectilc->zip)>0?$projectilc->zip:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Mobile:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="<?php echo e($projectilc->id); ?>" data-field="phone" id="pProjectInfoPhone_<?php echo e($projectilc->id); ?>" value="<?php echo e(strlen($projectilc->phone)>0?$projectilc->phone:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Home Phone:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="<?php echo e($projectilc->id); ?>" data-field="phone2" id="pProjectInfoPhone2_<?php echo e($project->id); ?>" value="<?php echo e(strlen($projectilc->phone2)>0?$projectilc->phone2:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Email:</h5>
                            <input type="text" id="pProjectInfoEmail_<?php echo e($project->id); ?>" data-iid="<?php echo e($projectilc->id); ?>" data-field="email" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($projectilc->email)>0?$projectilc->email:"N/A"); ?>">
                        </div>
                        <div class="col-md-6">
                            <h4>Consultant: <?php echo e($project->consultant->usr); ?></h4>
                        </div>
                        <div class="col-md-3">
                            <h4>Pin: <?php echo e($project->id); ?></h4>
                        </div>
                        <div class="col-md-3">
                            <h4>App Number: <?php echo e($project->clientServicesProject()->patentAppNo); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_<?php echo e($project->id); ?>_2" role="tabpanel">
                    <div class="panel-group" id="accordion_<?php echo e($project->id); ?>">
                        <div class="col-md-12 boxProjectILCInfo">
                            <div class="col-md-12 vendorBox">
                                <p>Contract Types: <?php echo e($projectilc->projectclientservices->contractTypes); ?></p>
                                <p>Contract IIG Plan: <?php echo e($projectilc->projectclientservices->project->IigType()); ?></p>
                            </div>
                            <div class="col-md-6">
                                <?php if($projectilc->agreementStartDate != '0000-00-00 00:00:00'): ?>
                                    <p id="expiration_date_<?php echo e($project->id); ?>">Expiration Date: <?php echo e($expirationDate); ?></p>
                                <?php else: ?>
                                    <p id="expiration_date_<?php echo e($project->id); ?>">Expiration Date: <?php echo e('0000-00-00 00:00:00'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <?php if($projectilc->separationDate != '0000-00-00 00:00:00'): ?>
                                    <p style="display: inline;" id="separation_date_<?php echo e($project->id); ?>">Separation Date: <?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectilc->separationDate)))); ?></p>
                                <?php else: ?>
                                    <p id="separation_date_<?php echo e($project->id); ?>">Separation Date: <?php echo e($projectilc->separationDate); ?></p>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="col-md-12 vendorBox">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapseIndustry_<?php echo e($project->id); ?>" class="actionQuestions" aria-expanded="true">
                                    <i>
                                        <h4 class="panel-title">INDUSTRY & MANUFACTURERS:</h4>
                                    </i>
                                </a>
                            </div>
                            <div id="collapseIndustry_<?php echo e($project->id); ?>" class="collapse in" aria-expanded="true">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Industry:</p>
                                        <select id="industrySelected_<?php echo e($projectilc->id); ?>" class="industrySelected" data-iid="<?php echo e($projectilc->id); ?>" style="margin-top: 15px;">
                                            <option value="0" selected>Select Industry</option>
                                            <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($industry->id); ?>" <?php if($industry->id==$projectilc->industry_id): ?>selected="selected"<?php endif; ?>><?php echo e($industry->type); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="col-md-6"><p>Add Manufacturers</p></div>
                                        <div class="col-md-6">
                                            <select id="manufacturerSelect_<?php echo e($projectilc->id); ?>" class="manufacturerSelect" data-iid="<?php echo e($projectilc->id); ?>" style="width: 100%;">
                                                <?php if($projectilc->industry_id != 0): ?>
                                                    <option value="-1" selected>Select Manufacturer</option>
                                                    <?php $__currentLoopData = $projectilc->industry->manufacturers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($manufacturer->id); ?>"><?php echo e($manufacturer->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <option value="-1" selected>No industry associated</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Assigned Manufacturers:</p>
                                        </div>
                                        <div class="col-md-6">
                                            <select size="4" id="manufacturersIlc_<?php echo e($projectilc->id); ?>" name="manufacturersIlc" style="width: 100%;">
                                                <?php $__currentLoopData = $projectilc->manufacturers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($manufacturer->id); ?>"><?php echo e($manufacturer->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" id="addManufacturer" data-iid="<?php echo e($projectilc->id); ?>"><i class="fa fa-plus "></i></button>
                                        </div><br>
                                        <div class="col-md-12" style="margin-top: 7px;">
                                            <button class="btn btn-danger" id="removeManufacturer" data-iid="<?php echo e($projectilc->id); ?>"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-md-push-3">
                                        <div class="col-md-5"><p>Additional Emails:</p></div>
                                        <div class="col-md-7"><textarea id="additionalEmails_<?php echo e($projectilc->id); ?>" class="clientDetailsInput" data-field="additionalEmails" data-iid="<?php echo e($projectilc->id); ?>" rows="3" cols="30"><?php echo e($projectilc->additionalEmails); ?></textarea></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 vendorBox">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapseIntroCall_<?php echo e($project->id); ?>" class="actionQuestions" aria-expanded="true">
                                    <i>
                                        <h4 class="panel-title">INTRO CALL & WEBSITE CODES:</h4>
                                    </i>
                                </a>
                            </div>
                            <div id="collapseIntroCall_<?php echo e($project->id); ?>" class="collapse in" aria-expanded="true">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Intro Call</p>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="checkbox" name="introCallCheck" id="introCallCheck_<?php echo e($projectilc->id); ?>" class="checkIntroCall"
                                               data-prop="introCallDate"
                                        <?php if(!(strpos($projectilc->introCallDate, '00:00:00') !== false)): ?>
                                               checked="checked"
                                                <?php endif; ?>
                                                >
                                    </div>
                                    <div class="col-md-3 col-md-push-2">
                                        <p>Intro Call Date: </p>
                                    </div>
                                    <div class="col-md-3 col-md-push-2">
                                        <input type="text" data-prop="introCallDate" id="introCallDate_<?php echo e($projectilc->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                        <?php if(!(strpos($projectilc->introCallDate, '00:00:00') !== false)): ?>
                                               value="<?php echo e(date('m-d-Y',strtotime($projectilc->introCallDate))); ?>"
                                               <?php else: ?>
                                               disabled="disabled"
                                                <?php endif; ?>
                                                >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Website Codes</p>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="checkbox" name="websiteCodesCheck" id="websiteCodesCheck_<?php echo e($projectilc->id); ?>" class="checkIntroCall"
                                               data-prop="website_codes"
                                        <?php if($projectilc->website_codes != '0000-00-00 00:00:00'): ?>
                                               checked="checked"
                                                <?php endif; ?>
                                                >
                                    </div>
                                    <div class="col-md-3 col-md-push-2">
                                        <p>Website Codes Date: </p>
                                    </div>
                                    <div class="col-md-3 col-md-push-2">
                                        <input type="text" data-prop="website_codes" id="websiteCodesDate_<?php echo e($projectilc->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                        <?php if($projectilc->website_codes!= '0000-00-00 00:00:00'): ?>
                                               value="<?php echo e(date('m-d-Y',strtotime($projectilc->website_codes))); ?>"
                                               <?php else: ?>
                                               disabled="disabled"
                                                <?php endif; ?>
                                                >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Website Codes User: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="websiteUser_<?php echo e($projectilc->id); ?>" data-iid="<?php echo e($projectilc->id); ?>" data-field="website_codes_user" class="editWebsiteCodes" style="width: 100% !important;" value="<?php echo e($projectilc->website_codes_user); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <p>Website Codes Pswd: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="websitePswd_<?php echo e($projectilc->id); ?>" data-iid="<?php echo e($projectilc->id); ?>" data-field="website_codes_pswd" style="width: 100% !important;" class="editWebsiteCodes" value="<?php echo e($projectilc->website_codes_pswd); ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Call after tradeshow: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="callTradeshow_<?php echo e($projectilc->id); ?>" data-iid="<?php echo e($projectilc->id); ?>" class="setCallTradeshow"
                                        <?php if($projectilc->callTradeshow == "1"): ?>
                                               checked="checked"
                                                <?php endif; ?>>
                                    </div>
                                    <div class="col-md-3">
                                        <p>3D (or 2D) Model Rcvd: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="dModelRcvd_<?php echo e($projectilc->id); ?>" data-pid="<?php echo e($projectilc->projectclientservices_id); ?>" class="checkDModelRcvd"
                                        <?php if($projectilc->projectclientservices->DModel_rcvd != "0000-00-00 00:00:00"): ?>
                                               checked="checked" disabled="disabled"
                                                <?php endif; ?>>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="panel-heading col-md-12">
                                <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapseNotes_<?php echo e($projectilc->id); ?>" class="col-md-9">
                                    <i>
                                        <h4 class="panel-title">Notes:</h4>
                                    </i>
                                </a>
                                <i class="fa fa-plus col-md-3 addNotesIlc" data-iid ="<?php echo e($projectilc->id); ?>" style="border: 1px solid black;padding-right: 5px;padding-left: 5px;" aria-hidden="true"> NEW NOTE</i>
                            </div>
                            <div id="collapseNotes_<?php echo e($projectilc->id); ?>">
                                <div class="col-md-12" id="insideCollapseNotes_<?php echo e($projectilc->id); ?>" style="overflow-y: scroll;min-height: 100px;max-height: 150px;">
                                    <?php $__currentLoopData = $projectilc->ilcNotes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ilcNotes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="noteLink col-md-12" id="divNote_<?php echo e($ilcNotes->id); ?>">
                                            <i title="Edit" class="fa fa-pencil-square-o col-md-1 editNotesIlc" data-id="<?php echo e($ilcNotes->id); ?>" data-system="<?php echo e($ilcNotes->system); ?>" aria-hidden="true"></i>
                                            <p id="pNote_<?php echo e($ilcNotes->id); ?>" title="<?php echo e($ilcNotes->notes); ?>" class="col-md-6"><?php echo e(strlen($ilcNotes->notes)>45?substr($ilcNotes->notes,0,40).'...':$ilcNotes->notes); ?></p>
                                            <p class="col-md-4"><?php echo e(date('m-d-Y h:i a',strtotime(str_replace('-','/',$ilcNotes->created_at)))); ?></p>
                                            <?php if($ilcNotes->system == 0): ?><i title="Delete" class="fa fa-times col-md-1 deleteNotesIlc" data-id="<?php echo e($ilcNotes->id); ?>" aria-hidden="true"></i><?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>