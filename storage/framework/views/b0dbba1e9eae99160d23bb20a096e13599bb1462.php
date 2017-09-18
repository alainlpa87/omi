<div class="portlet col-md-12 portlet-new" style="height: auto" id="container_<?php echo e($project->id); ?>"  data-id = "<?php echo e($project->id); ?>" data-lead-id="<?php echo e($project->lead->id); ?>" data-fileno="<?php echo e($project->lead->fileno); ?>" data-date-action="<?php echo e($project->actionDate); ?>"
<?php if($projectClientS!=null): ?>
     data-completed="<?php echo e($projectClientS->completed); ?>"
<?php endif; ?>>
    <div class="box call">
        <div class="portlet-title">
            <div class="indicator caption" style="z-index: 100" data-id="<?php echo e($project->id); ?>">
                <i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<span id="captionFullName_<?php echo e($project->id); ?>"><?php echo e($project->lead->lname.", ".$project->lead->fname); ?></span> - <?php echo e($project->lead->fileno); ?> - <?php echo e($project->lead->leadSource); ?>

                <i class="pull-left fa fa-chevron-down"  id="indicator_<?php echo e($project->id); ?>"></i>
            </div>
            <ul class="nav nav-tabs invisible" id="navTabs_<?php echo e($project->id); ?>" role="tablist">
                <li>
                    <a href="#portlet_tab_<?php echo e($project->id); ?>_4" data-toggle="tab" role="tab"> BUSINESS PROFILE </a>
                </li>
                <li>
                    <a href="#portlet_tab_<?php echo e($project->id); ?>_3" data-toggle="tab" role="tab"> LEGAL </a>
                </li>
                <li class="active">
                    <a href="#portlet_tab_<?php echo e($project->id); ?>_1" data-toggle="tab" role="tab"> CLIENT </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body hide" id="portletBody_<?php echo e($project->id); ?>">
            <div class="tab-content col-md-12 portlet_tab_content_<?php echo e($project->id); ?>"  style="display: none">
                <div class="tab-pane active" id="portlet_tab_<?php echo e($project->id); ?>_1" role="tabpanel">
                    <div class="col-md-12 vendorBox">
                        <?php if($projectClientS != null && $projectClientS->completed != 4 && $projectClientS->completed != 5): ?>
                            <div class="col-md-4" style="position:relative;">
                                <select class="select" title="Select Status">
                                    <option ></option>
                                    <option value="4">Closed</option>
                                    <option value="5">Closed (expired)</option>
                                </select>
                            </div>
                        <?php elseif($projectClientS != null): ?>
                            <div class="col-md-4" style="position: relative;" id="divChangState_<?php echo e($project->id); ?>">
                                <button class="btn btn-warning reOpenBtn" id="reOpenBtn_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>">Re-Open</button>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-4 btnActionsClientServices">
                            <i class="fa fa-print fa-3 printProject adminIcons" data-toggle="tooltip" data-placement="bottom" title="Print Submission" data-id = "<?php echo e($project->id); ?>" ></i>
                            <i class="fa fa-folder-open fa-3 openFilesClientServices adminIcons" data-toggle="tooltip" data-placement="bottom" title="Open Files" data-id = "<?php echo e($project->id); ?>" ></i>
                            <i class="fa fa-upload fa-3 uploadFilesClientServices adminIcons" data-toggle="tooltip" data-placement="bottom" title="Upload Files" data-id = "<?php echo e($project->id); ?>" ></i>
                            <i class="fa fa-qrcode fa-3 sendPass adminIcons" data-toggle="tooltip" data-placement="bottom" title="Send Password" data-id = "<?php echo e($project->id); ?>" ></i>
                            <?php if($projectClientS!=null): ?>
                                <i <?php if($projectClientS->show==1): ?>
                                    class="fa fa-eye showProjectClientServices adminIcons"
                                    title="Hide project"
                                    <?php else: ?>
                                    class="fa fa-eye-slash showProjectClientServices adminIcons"
                                    title="Show project"
                                    <?php endif; ?>
                                    data-toggle="tooltip" data-placement="bottom"  aria-hidden="true"
                                    data-state="<?php echo e($projectClientS->show); ?>" data-id="<?php echo e($project->id); ?>" id="showP_<?php echo e($project->id); ?>"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php if($projectClientS!=null && $projectClientS->completed==2): ?>
                            <h5 style="font-weight: bold;color: rgb(157, 12, 12);">Return Reason:</h5>
                            <p class="pProjectInfo" style="background-color: bisque;"><?php echo e(strlen($projectClientS->returnedReason)>0?$projectClientS->returnedReason:"N/A"); ?></p>
                        <?php elseif($projectClientS!=null && $projectClientS->completed==3): ?>
                            <h5 style="font-weight: bold;color: rgb(157, 12, 12);">Overdue By:</h5>
                            <p class="pProjectInfo" style="background-color: bisque;"><?php echo e(strlen($projectClientS->overDueReason)>0?$projectClientS->overDueReason:"N/A"); ?></p>
                        <?php endif; ?>
                        <i><h4>Inventor Detail:</h4></i>
                        <div class="col-md-3">
                            <h5>Inventor First Name:</h5>
                            <input type="text" name="pProjectInfoFname" id="pProjectInfoFname_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="fname" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->lead->fname)>0?$project->lead->fname:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Inventor Last Name:</h5>
                            <input type="text" name="pProjectInfoLname" id="pProjectInfoLname_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="lname" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->lead->fname)>0?$project->lead->lname:"N/A"); ?>">
                        </div>
                        <div class="col-md-6">
                            <h5>Co-inventor Name:</h5>
                            <input type="text" name="pProjectInfoCname" id="pProjectInfoCFname_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="coInventor" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->coInventor)>0?$project->coInventor:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Street:</h5>
                            <input type="text" name="pProjectInfoStreet" id="pProjectInfoStreet_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="street" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->lead->street)>0?$project->lead->street:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>City:</h5>
                            <input type="text" name="pProjectInfoCity" id="pProjectInfoCity_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="city" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->lead->city)>0?$project->lead->city:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>State:</h5>
                            <input type="text" name="pProjectInfoState" id="pProjectInfoState_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="state" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->lead->state)>0?$project->lead->state:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Zip:</h5>
                            <input type="text" name="pProjectInfoZip" id="pProjectInfoZip_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="zip" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->lead->zip)>0?$project->lead->zip:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Mobile:</h5>
                            <input type="text" name="pProjectInfoPhone1" id="pProjectInfoPhone1_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="phone" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->lead->phone)>0?$project->lead->phone:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Home Phone:</h5>
                            <input type="text" name="pProjectInfoPhone2" id="pProjectInfoPhone2_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="phone2" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->lead->phone2)>0?$project->lead->phone2:"N/A"); ?>">
                        </div>
                        <div class="col-md-3">
                            <h5>Email:</h5>
                            <input type="text" name="pProjectInfoEmail" id="pProjectInfoEmail_<?php echo e($project->id); ?>" data-id="<?php echo e($project->id); ?>" data-field="email" class="pProjectInfo clientDetailsInput" value="<?php echo e(strlen($project->lead->email)>0?$project->lead->email:"N/A"); ?>">
                        </div>
                        <div class="col-md-6">
                            <h4>Consultant: <?php echo e($project->consultant->usr); ?></h4>
                        </div>
                        <div class="col-md-6">
                            <h4>Pin: <?php echo e($project->id); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_<?php echo e($project->id); ?>_3" role="tabpanel">
                    <?php if($projectClientS != null): ?>
                        <div class="panel-group" id="accordion_<?php echo e($project->id); ?>">
                            <div class="col-md-12 vendorBox">
                                <input type="hidden" id="attorneys_<?php echo e($project->id); ?>" data-att="<?php echo e($attorneys); ?>">
                                <div class="attorney_info" style="position:relative;top: -6px;">
                                    <i class="fa fa-upload fa-3 uploadFileToAtt adminIcons" data-toggle="tooltip" data-placement="bottom" title="Upload Files to Attorney" data-id="<?php echo e($project->id); ?>"></i>
                                </div>
                                <div class="attorney_info">
                                    <p><strong>Attorney :</strong></p>
                                </div>
                                <div class="attorney_info">
                                    <div class="form-group">
                                        <select id="selectAttorney_<?php echo e($project->id); ?>" class="selectAtt" style="height: 100%;">
                                            <option value="<?php echo e($projectClientS->attorney_id); ?>" selected>
                                                <?php if($projectClientS->attorney_id != "0"): ?>
                                                    <?php $__currentLoopData = $attorneys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attorney): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($attorney->id == $projectClientS->attorney_id): ?>
                                                            <?php echo e($attorney->usr); ?>

                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    ---
                                                <?php endif; ?>
                                            </option>
                                            <?php $__currentLoopData = $attorneys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attorney): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($attorney->id != $projectClientS->attorney_id): ?>
                                                    <option value="<?php echo e($attorney->id); ?>">
                                                        <?php echo e($attorney->usr); ?>

                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="attorney_info">
                                    <p><strong>Attorney Email: </strong></p>
                                </div>
                                <div class="attorney_info">
                                    <p id="att_email_<?php echo e($project->id); ?>">
                                        <?php if($projectClientS->attorney_id != "0"): ?>
                                            <?php $__currentLoopData = $attorneys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attorney): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($attorney->id == $projectClientS->attorney_id): ?>
                                                    <?php echo e($attorney->email); ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapsePPA_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">PPA Details:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapsePPA_<?php echo e($project->id); ?>" class="collapse">
                                    <div class="col-md-6">
                                        <h5>Total PPA Contract Amount:</h5>
                                        <?php if($projectClientS->contract != null && $projectClientS->contract->ppaTotalPrice() >0): ?>
                                            $ <input type="number"  id="totalPrice_<?php echo e($project->id); ?>" class="ppaDetailsInput" name="totalPrice" value="<?php echo e($projectClientS->contract->ppaTotalPrice()); ?>" >
                                        <?php else: ?>
                                            $ <input type="number"  name="totalPrice" id="totalPrice_<?php echo e($project->id); ?>" class="ppaDetailsInput"  value="" >
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Contract Type</h5>
                                        <p class="pProjectInfo">
                                            <input type="checkbox" name="typeUT" id="typeUT_<?php echo e($project->id); ?>" class="checkType" data-val="UT"
                                            <?php if($projectClientS->hasType("UT")): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                            <span class="checkSpan">UT</span>
                                            <input type="checkbox" name="typeUPG_UT" id="typeUPG_UT_<?php echo e($project->id); ?>" class="checkType" data-val="UPG_UT"
                                            <?php if($projectClientS->hasType("UPG_UT")): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                            <span class="checkSpan">UPG UT</span>
                                            <input type="checkbox" name="typeCR" id="typeCR_<?php echo e($project->id); ?>" class="checkType" data-val="CR"
                                            <?php if($projectClientS->hasType("CR")): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                            <span class="checkSpan">CR</span>
                                            <input type="checkbox" name="typeEPO" id="typeEPO_<?php echo e($project->id); ?>" class="checkType" data-val="EPO"
                                            <?php if($projectClientS->hasType("EPO")): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                            <span class="checkSpan">EPO</span>
                                            <input type="checkbox" name="typePCT" id="typePCT_<?php echo e($project->id); ?>" class="checkType" data-val="PCT"
                                            <?php if($projectClientS->hasType("PCT")): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                            <span class="checkSpan">PCT</span>
                                            <input type="checkbox" name="typeD" id="typeD_<?php echo e($project->id); ?>" class="checkDesign"  data-val="D"  
                                            <?php if($projectClientS->hasType("D")): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                            <span class="checkSpan">D</span>
                                            <br>
                                            <input type="checkbox" name="typeTM" id="typeTM_<?php echo e($project->id); ?>" class="checkType" data-val="TM"
                                            <?php if($projectClientS->hasType("TM")): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                            <span class="checkSpan">TM</span>
                                            <input type="checkbox" name="typePROV" id="typePROV_<?php echo e($project->id); ?>" class="checkType" data-val="PROV"
                                            <?php if($projectClientS->hasType("PROV")): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                            <span class="checkSpan">PROV</span>

                                            <input type="checkbox" style="margin-left: 50px;" name="mailOnly" id="mailOnly_<?php echo e($project->id); ?>" class="checkMailOnly"
                                            <?php if($projectClientS->mailOnly): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                            <span class="checkSpan">Mail Only</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Total Amount Paid:</h5>
                                        <?php if($projectClientS->contract!=null): ?>
                                            $ <input type="number" name="amntPaid" id="amntPaid_<?php echo e($project->id); ?>" class="ppaDetailsInput"  value="<?php echo e($projectClientS->contract->paid); ?>" >
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Received  Date:</h5>
                                        <input type="text" id="recvdDate_<?php echo e($project->id); ?>" name="ppaRcvdDate" class="ppaDetailsDate pickDate"
                                            <?php if($projectClientS->ppaRcvdDate!='0000-00-00 00:00:00'): ?>
                                               value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->ppaRcvdDate)))); ?>"
                                               <?php else: ?>
                                                value="N/A"
                                                <?php endif; ?>
                                                >
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Balance Due:</h5>
                                        <p style=" padding: 10px;font-size: 10px;text-align: justify;background: white;border-radius: 5px;" id="balanceDue_<?php echo e($project->id); ?>">
                                            <?php if($projectClientS->contract!=null && $projectClientS->contract->ppaTotalPrice() > 0): ?>
                                            <?php echo e(money_format('%=#10.2n',($projectClientS->contract->ppaTotalPrice())-
                                            ($projectClientS->contract->paid))); ?>

                                            <?php else: ?>
                                            N/A
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Contract Start Date:</h5>
                                        <input type="text" id="contractStarDate_<?php echo e($project->id); ?>" name="rcvdDate" class="ppaDetailsDate pickDate"
                                        <?php if($projectClientS->rcvdDate!='0000-00-00 00:00:00'): ?>
                                               value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->rcvdDate)))); ?>"
                                               <?php else: ?>
                                               value="N/A"
                                                <?php endif; ?>
                                                >
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Percentage Paid:</h5>
                                        <p class="pProjectInfo" id="percentPaid_<?php echo e($project->id); ?>">
                                            <?php if($projectClientS->contract!=null && $projectClientS->contract->ppaTotalPrice()>0): ?>
                                                <?php echo e(floor(($projectClientS->contract->paid)/($projectClientS->contract->ppaTotalPrice())*100).'%'); ?>

                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Contract End Date:</h5>
                                        <p class="pProjectInfo" id="contractEndDate_<?php echo e($project->id); ?>">
                                            <?php if($projectClientS->rcvdDate != '0000-00-00 00:00:00' && $projectClientS->hasType('PROV') && !$projectClientS->hasType('UPG_UT')): ?>
                                                <?php echo e(date('m-d-Y h:i:s', strtotime('+1 year -1 day', strtotime($projectClientS->rcvdDate)))); ?>

                                            <?php elseif($projectClientS->agreementExt_rcvd!='0000-00-00 00:00:00' && $projectClientS->rcvdDate != '0000-00-00 00:00:00'): ?>
                                                <?php echo e(date('m-d-Y h:i:s', strtotime('+3 year -1 day', strtotime($projectClientS->rcvdDate)))); ?>

                                            <?php elseif($projectClientS->rcvdDate != '0000-00-00 00:00:00'): ?>
                                                <?php echo e(date('m-d-Y h:i:s', strtotime('+2 year -1 day', strtotime($projectClientS->rcvdDate)))); ?>

                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapseDocs_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Initial Documents (PSA, DDR, TDQ, CRQ):</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseDocs_<?php echo e($project->id); ?>" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-10"></div>
                                        <div class="col-md-2">
                                            <h5 id="sendback_label_<?php echo e($project->id); ?>" style="display: none">Send Back</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>PSA,DDR and Signed PPA Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="ppaSent" id="ppaSent_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="ppaSent_created_at" data-p="ppaSentDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->ppaSent_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>PSA,DDR and Signed PPA Sent Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="ppaSent_created_at" id="ppaSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->ppaSent_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->ppaSent_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <?php if(($file=$projectClientS->getDocsByName('agreementPSA'))!=null && $projectClientS->ddrReceived_created_at=="" && $file->signdate!=""): ?>
                                            <div class="col-md-1">
                                                <button id="returnPSA_<?php echo e($project->id); ?>" data-id="<?php echo e($file->file_id); ?>"  data-filename="<?php echo e($file->name); ?>"
                                                        class="btn btn-danger resendFile" style="font-size:65%;" aria-hidden="true"
                                                <?php if($file->file_id==-1): ?>
                                                        disabled="true"
                                                        <?php endif; ?>> PSA</button>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(($file=$projectClientS->getDocsByName('ddr'))!=null && $projectClientS->ddrReceived_created_at=="" && $file->signdate!=""): ?>
                                            <div class="col-md-1">
                                                <button id="returnDDR_<?php echo e($project->id); ?>" class="btn btn-danger resendFile"  data-filename="<?php echo e($file->name); ?>"
                                                        data-id="<?php echo e($file->file_id); ?>"  style="font-size:65%;" aria-hidden="true"
                                                <?php if($file->file_id==-1): ?>
                                                        disabled="true"
                                                        <?php endif; ?>> DDR</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>PSA & DDR Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="ddrSent" id="ddrSent_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="ddrReceived_created_at" data-p="ddrSentDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->ddrReceived_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>PSA & DDR  Received Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="ddrReceived_created_at" id="ddrSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->ddrReceived_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->ddrReceived_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>CopyRight Questionnaire Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="copyrightSent" id="copyrightSent_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="copyrightSent_created_at" data-p="copyrightSentDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->copyrightSent_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>CopyRight Questionnaire Sent Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="copyrightSent_created_at" id="copyrightSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->copyrightSent_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->copyrightSent_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <?php if(($file=$projectClientS->getDocsByName('copyrightQuestionnaire'))!=null && $projectClientS->copyrightReceived_created_at=="" && $file->signdate!=""): ?>
                                            <div class="col-md-1">
                                                <button id="returnCOPYRIGHT_<?php echo e($project->id); ?>" data-id="<?php echo e($file->file_id); ?>"  data-filename="<?php echo e($file->name); ?>"
                                                        class="btn btn-danger resendFile" style="font-size:65%;" aria-hidden="true"
                                                <?php if($file->file_id==-1): ?>
                                                        disabled="true"
                                                        <?php endif; ?>> COPYRIGHT</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>Trademark Questionnaire Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="trademarkSent" id="trademarkSent_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="trademarkSent_created_at" data-p="trademarkSentDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->trademarkSent_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>Trademark Questionnaire Sent Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="trademarkSent_created_at" id="trademarkSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->trademarkSent_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->trademarkSent_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <?php if(($file=$projectClientS->getDocsByName('trademark'))!=null && $projectClientS->trademarkReceived_created_at=="" && $file->signdate!=""): ?>
                                            <div class="col-md-1">
                                                <button id="returnTRADEMARK_<?php echo e($project->id); ?>" class="btn btn-danger resendFile" data-filename="<?php echo e($file->name); ?>"
                                                        data-id="<?php echo e($file->file_id); ?>" style="font-size:65%;" aria-hidden="true"
                                                <?php if($file->file_id==-1): ?>
                                                        disabled="true"
                                                        <?php endif; ?>> TRADEMARK</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>CopyRight Questionnaire Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="copyrightReceived" id="copyrightReceived_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="copyrightReceived_created_at" data-p="copyrightReceivedDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->copyrightReceived_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>CopyRight Questionnaire Received Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="copyrightReceived_created_at" id="copyrightReceivedDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->copyrightReceived_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->copyrightReceived_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>Trademark Questionnaire Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="trademarkReceived" id="trademarkReceived_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="trademarkReceived_created_at" data-p="trademarkReceivedDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->trademarkReceived_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>Trademark Questionnaire Received Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="trademarkReceived_created_at" id="trademarkReceivedDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->trademarkReceived_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->trademarkReceived_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapseAttorney_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Documents to Attorney:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseAttorney_<?php echo e($project->id); ?>" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Document Package Sent to Attorney</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="documentSent" id="documentSent_<?php echo e($project->id); ?>" class="doc_sent_att"
                                                   data-prop="documentSent_created_at" data-p="documentSentDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->documentSent_created_at!=""): ?>
                                                   checked="checked"
                                                   disabled
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Date Document Package Sent to Attorney</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="documentSent_created_at" id="documentSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->documentSent_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->documentSent_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Upgrade Sent to Attorney</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="upgradeSent" id="upgradeSent_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->docUpgSent_created_at!="0000-00-00 00:00:00"): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    disabled
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Date Upgrade Sent to Attorney</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="docUpgSent_created_at"  id="upgradeSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->docUpgSent_created_at!='0000-00-00 00:00:00'): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->docUpgSent_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapseClient_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Welcome Client:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseClient_<?php echo e($project->id); ?>" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Welcome Email Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="emailSent" id="emailSent_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="emailSent_created_at" data-p="emailSentDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->emailSent_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Welcome Email Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="emailSent_created_at" id="emailSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->emailSent_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->emailSent_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Welcome Email Follow-up Call</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="emailCall" id="emailCall_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="emailCall_created_at" data-p="emailCallDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->emailCall_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Welcome Email Follow-up Call Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="emailCall_created_at" id="emailCallDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->emailCall_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->emailCall_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapsePatentApp_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Patent Application:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapsePatentApp_<?php echo e($project->id); ?>" class="collapse">
                                    <?php if($projectClientS->appSent_created_at!="" && $projectClientS->patentAppApproved_created_at!=''): ?>
                                        <div class="col-md-12" >
                                            <div class="col-md-4">
                                                <button class="btn btn-danger resendAPP" id="reSendPatentAPP_<?php echo e($project->id); ?>"
                                                    <?php if($projectClientS->hasType('PROV') && !$projectClientS->hasType('UPG_UT')): ?>
                                                        data-type="PROV"
                                                        <?php else: ?>
                                                        data-type="PA"
                                                        <?php endif; ?>>
                                                    Resend App
                                                </button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Title of Invention</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" data-prop="titleofinvention" id="titleOfInv_<?php echo e($project->id); ?>" class="titleInv" style="width: 100% !important;" value="<?php echo e($projectClientS->titleofinvention); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent Application Sent to Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="pApplicationSent" id="pApplicationSent_<?php echo e($project->id); ?>" class="patentAppSent"
                                                   data-prop="appSent_created_at"  data-p="pApplicationDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->appSent_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                            <?php if($projectClientS->hasType('PROV') && !$projectClientS->hasType('UPG_UT')): ?>
                                                   data-type="PROV"
                                                   <?php else: ?>
                                                   data-type="PA"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent Application Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="appSent_created_at" id="pApplicationDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->appSent_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->appSent_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>POA and DEC Docs Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="poaDecSent" id="poaDecSent_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="poaDec_created_at" data-p="poaDecDate_<?php echo e($project->id); ?>" disabled="disabled"
                                            <?php if($projectClientS->poaDec_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>POA and DEC Docs Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="poaDec_created_at" id="poaDecDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->poaDec_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->poaDec_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App Followup with Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appFollowUpSent" id="appFollowUpSent_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="appFollowUp_created_at" data-p="appFollowUpDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->appFollowUp_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent App Followup with Inventor Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="appFollowUp_created_at" id="appFollowUpDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->appFollowUp_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->appFollowUp_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapseProv_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Provisional Or Utility App Approval by Inventor:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseProv_<?php echo e($project->id); ?>" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent Application Type:</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="ppa_type_<?php echo e($project->id); ?>" data-type="<?php echo e($project->utility=="U_D"?"Utility & Design":$project->utility); ?>">
                                                <?php if($projectClientS->hasType("PROV") && !$projectClientS->hasType("UPG_UT")): ?>
                                                    Provisional
                                                <?php else: ?>
                                                    <?php echo e($project->utility=="U_D"?"Utility & Design":"Utility"); ?>

                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>POA and DEC Docs Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="poaDecReceived" id="poaDecReceived_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="poaDecReceived_created_at" data-p="poaDecReceivedDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->poaDecReceived_created_at!=""): ?>
                                                   checked="checked"
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>POA and DEC Docs Received Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="poaDecReceived_created_at" id="poaDecReceivedDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->poaDecReceived_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->poaDecReceived_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>

                                    

                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App pending revisions</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appPendingRevision" data-prop="apppendingrevision" id="appPendingRevision_<?php echo e($project->id); ?>" class="appPendingRevision"
                                            <?php if($projectClientS->apppendingrevision!=0): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>

                                    

                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App Approved by Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appApproved" id="appApproved_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="patentAppApproved_created_at" data-p="appApprovedDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->patentAppApproved_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent App Approval Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="patentAppApproved_created_at" id="appApprovedDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->patentAppApproved_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->patentAppApproved_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapsePatentAppD_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Patent Application (Design):</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapsePatentAppD_<?php echo e($project->id); ?>" class="collapse">
                                    <?php if($projectClientS->appSentD_created_at!="0000-00-00 00:00:00" && $projectClientS->patentAppApprovedD_created_at!="0000-00-00 00:00:00"): ?>
                                        <div class="col-md-12" style="margin-bottom: 15px !important;">
                                            <div class="col-md-4">
                                                <button class="btn btn-danger resendAPP" id="reSendPatentAPP_<?php echo e($project->id); ?>" data-type="DESIGN">
                                                    Resend App
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Title of Invention</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" data-prop="titleofinventionD" id="titleOfInvD_<?php echo e($project->id); ?>" class="titleInv" style="width: 100% !important;" value="<?php echo e($projectClientS->titleofinventionD); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent Application Sent to Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="pApplicationSentD" id="pApplicationSentD_<?php echo e($project->id); ?>" class="patentAppSent"
                                                   data-prop="appSentD_created_at" data-type="DESIGN" data-p="pApplicationDateD_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->appSentD_created_at!="0000-00-00 00:00:00"): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent Application Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="appSentD_created_at" id="pApplicationDateD_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->appSentD_created_at!='0000-00-00 00:00:00'): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->appSentD_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>POA and DEC (Desing) Docs Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="poaDecSentD" id="poaDecSentD_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="poaDecSentD_created_at" data-p="poaDecDateD_<?php echo e($project->id); ?>" disabled="disabled"
                                            <?php if($projectClientS->poaDecSentD_created_at!="0000-00-00 00:00:00"): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>POA and DEC Docs Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="poaDecSentD_created_at" id="poaDecDateD_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->poaDecSentD_created_at!='0000-00-00 00:00:00'): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->poaDecSentD_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>POA and DEC Docs Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="poaDecReceivedD" id="poaDecReceivedD_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="poaDecRcvdD_created_at" data-p="poaDecReceivedDateD_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->poaDecRcvdD_created_at!="0000-00-00 00:00:00"): ?>
                                                   checked="checked"
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>POA and DEC Docs Received Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="poaDecRcvdD_created_at" id="poaDecReceivedDateD_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->poaDecRcvdD_created_at!='0000-00-00 00:00:00'): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->poaDecRcvdD_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App pending revisions</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appPendingRevision" data-prop="apppendingrevisionD" id="appPendingRevisionD_<?php echo e($project->id); ?>" class="appPendingRevision"
                                            <?php if($projectClientS->apppendingrevisionD!=0): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App (Design) Approved by Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appApproved" id="appApprovedD_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="patentAppApprovedD_created_at" data-p="appApprovedDateD_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->patentAppApprovedD_created_at!="0000-00-00 00:00:00"): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent App Approval Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="patentAppApprovedD_created_at" id="appApprovedDateD_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->patentAppApprovedD_created_at!='0000-00-00 00:00:00'): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->patentAppApprovedD_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapsePatenProc_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Patent Application Process:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapsePatenProc_<?php echo e($project->id); ?>" class="collapse">
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App Invoice #</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="patentAppInvoice_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="patentAppInvoiceNo" data-prop2="patentInvoiceSentDate"
                                                       data-p="patentInvoiceSentDate_<?php echo e($project->id); ?>"
                                                       value="<?php if($projectClientS->patentAppInvoiceNo!=0): ?><?php echo e($projectClientS->patentAppInvoiceNo); ?><?php endif; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <p>Patent Invoice Sent Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="patentInvoiceSentDate" id="patentInvoiceSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->patentInvoiceSentDate!=''): ?>
                                                       value="<?php echo e(date('m-d-Y ',strtotime(str_replace('-','/',$projectClientS->patentInvoiceSentDate)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App Check #</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="patentAppCheck_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="patentAppCheckNo" data-prop2="-"
                                                       value="<?php if($projectClientS->patentAppCheckNo!=""): ?><?php echo e($projectClientS->patentAppCheckNo); ?><?php endif; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App filed by Attorney</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="PatentAppFiled_<?php echo e($project->id); ?>"  class="checkPatenApp"
                                                       data-prop="patentAppFiled_created_at" data-p="patentAppFilingDate_<?php echo e($project->id); ?>"
                                                <?php if($projectClientS->patentAppFiled_created_at!="0000-00-00 00:00:00"): ?>
                                                       checked="checked"
                                                        <?php endif; ?>>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Patent App Filing Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="patentAppFiled_created_at" id="patentAppFilingDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->patentAppFiled_created_at!="0000-00-00 00:00:00"): ?>
                                                       value="<?php echo e(date('m-d-Y',strtotime(str_replace('-','/',$projectClientS->patentAppFiled_created_at)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="patentAppNumber_<?php echo e($project->id); ?>" class="patentAppText inputAppNo"
                                                       data-prop="patentAppNo" data-prop2="-"
                                                       value="<?php if($projectClientS->patentAppNo!=0): ?><?php echo e($projectClientS->patentAppNo); ?><?php endif; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <p>Patent App Type</p>
                                            </div>
                                            <div class="col-md-2">
                                                <select id="selectPatentType_<?php echo e($project->id); ?>" class="selectPatentType">
                                                    <option value="" >---</option>
                                                    <option value="UT" <?php if($projectClientS->patentType == 'UT'): ?> selected <?php endif; ?>>UT</option>
                                                    <option value="UT(UPG)" <?php if($projectClientS->patentType == 'UT(UPG)'): ?> selected <?php endif; ?>>UT(UPG)</option>
                                                    <option value="PROV" <?php if($projectClientS->patentType == 'PROV'): ?> selected <?php endif; ?>>PROV</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Copyright filed</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="copyrightFil_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                       data-prop="copyrightFiled_created_at" data-p="copyRFilDate_<?php echo e($project->id); ?>"
                                                <?php if($projectClientS->copyrightFiled_created_at!=""): ?>
                                                       checked="checked"
                                                        <?php endif; ?>>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Copyright Filing Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="copyrightFiled_created_at" id="copyRFilDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->copyrightFiled_created_at!=""): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->copyrightFiled_created_at)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Copyright Filing Attorney</p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select id="selectAttorneyCopyR_<?php echo e($project->id); ?>" class="selectAttorney" data-prop="copyrightAtt">
                                                        <option value="-1">---</option>
                                                        <?php $__currentLoopData = $attorneys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attorney): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($attorney->id); ?>"
                                                            <?php if($attorney->id==$projectClientS->copyrightAtt): ?>
                                                                    selected
                                                                    <?php endif; ?>
                                                                    ><?php echo e($attorney->usr); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Copyright Application Number</p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="copyRightAppNumber_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="copyrightAppNumber" data-prop2="-"
                                                       <?php if($projectClientS->copyrightAppNumber != ''): ?> value="<?php echo e($projectClientS->copyrightAppNumber); ?>" <?php endif; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>TradeMark filed</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="trademarkFil_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                       data-prop="trademarkFil_created_at" data-p="trademarkFilDate_<?php echo e($project->id); ?>"
                                                <?php if($projectClientS->trademarkFil_created_at!=""): ?>
                                                       checked="checked"
                                                        <?php endif; ?>>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Trademark Filed Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="trademarkFil_created_at" id="trademarkFilDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->trademarkFil_created_at!=""): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->trademarkFil_created_at)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Trademark Filing Attorney</p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select id="selectAttorneyTrademark_<?php echo e($project->id); ?>" class="selectAttorney" data-prop="trademarkAtt">
                                                        <option value="-1">---</option>
                                                        <?php $__currentLoopData = $attorneys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attorney): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($attorney->id); ?>"
                                                            <?php if($attorney->id==$projectClientS->trademarkAtt): ?>
                                                                    selected
                                                                    <?php endif; ?>
                                                                    ><?php echo e($attorney->usr); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Trademark Application Number</p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="trademarkAppNumber_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="trademarkAppNo" data-prop2="-"
                                                       value="<?php if($projectClientS->trademarkAppNo!=0): ?><?php echo e($projectClientS->trademarkAppNo); ?><?php endif; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>EPO Filed</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="checkEPO_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                       data-prop="epoFil_created_at" data-p="epoFilDate_<?php echo e($project->id); ?>"
                                                <?php if($projectClientS->epoFil_created_at!=""): ?>
                                                       checked="checked"
                                                        <?php endif; ?>>
                                            </div>
                                            <div class="col-md-4">
                                                <p>EPO File Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="epoFil_created_at" id="epoFilDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->epoFil_created_at!=""): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->epoFil_created_at)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>EPO Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="epoNumber_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="epoNumber" data-prop2="-"
                                                       value="<?php if($projectClientS->epoNumber!=0): ?><?php echo e($projectClientS->epoNumber); ?><?php endif; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT PSA Sent</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="pctPSASent" id="pctPSASent_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                       data-prop="pctPsaSent_create_at" data-p="pctPSASentDate_<?php echo e($project->id); ?>"
                                                <?php if($projectClientS->pctPsaSent_create_at!="0000-00-00 00:00:00"): ?>
                                                       checked="checked"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT PSA Sent Date: </p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctPsaSent_create_at" id="pctPSASentDate_<?php echo e($project->id); ?>" class="patentAppText editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->pctPsaSent_create_at!='0000-00-00 00:00:00'): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctPsaSent_create_at)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT PSA Received</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="pctPSARcvd" id="pctPSARcvd_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                       data-prop="pctPsaRcvd_create_at" data-p="pctPSARcvdDate_<?php echo e($project->id); ?>"
                                                <?php if($projectClientS->pctPsaRcvd_create_at!="0000-00-00 00:00:00"): ?>
                                                       checked="checked"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT PSA Received Date: </p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctPsaRcvd_create_at" id="pctPSARcvdDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->pctPsaRcvd_create_at!='0000-00-00 00:00:00'): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctPsaRcvd_create_at)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT Questionnaire Sent</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctQuestSent" id="pctQuestSent_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->pctQuestSent!="0000-00-00 00:00:00"): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctQuestSent)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT Questionnaire Received</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="checkPCTQuestRcvd_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                       data-prop="pctQuestReceived" data-p="pctQuestReceived_<?php echo e($project->id); ?>"
                                                <?php if($projectClientS->pctQuestReceived!="0000-00-00 00:00:00"): ?>
                                                       checked="checked"
                                                        <?php endif; ?>>
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT Quest Rcvd Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctQuestReceived" id="pctQuestReceived_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->pctQuestReceived!="0000-00-00 00:00:00"): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctQuestReceived)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT Filed</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="checkPCTFiled_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                       data-prop="pctFil_created_at" data-p="pctFiDate_<?php echo e($project->id); ?>"
                                                <?php if($projectClientS->pctFil_created_at!=""): ?>
                                                       checked="checked"
                                                        <?php endif; ?>>
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT File Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctFil_created_at" id="pctFiDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->pctFil_created_at!=""): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctFil_created_at)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="pctNumber_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="pctNumber" data-prop2="-"
                                                       value="<?php if($projectClientS->pctNumber!=""): ?><?php echo e($projectClientS->pctNumber); ?><?php endif; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT Case Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="pctCaseNumber_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="pctCaseNumber" data-prop2="-"
                                                       value="<?php if($projectClientS->pctCaseNumber!=""): ?><?php echo e($projectClientS->pctCaseNumber); ?><?php endif; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4"><p>PCT Invoice Received Date</p></div>
                                            <div class="col-md-2">
                                                <input type="text" id="pctInvSentDate_<?php echo e($project->id); ?>" style="width: 100% !important;" class="patentAppText saveDataInput pickDate"
                                                       data-prop="pctInvoiceRecvdDate"
                                                <?php if($projectClientS->pctInvoiceRecvdDate!="0000-00-00 00:00:00"): ?>
                                                       value="<?php echo e(date('m-d-Y',strtotime(str_replace('-','/',$projectClientS->pctInvoiceRecvdDate)))); ?>"
                                                       <?php else: ?>
                                                       value="Select Date"
                                                        <?php endif; ?>>
                                                <i class="fa fa-floppy-o saveDate" aria-hidden="true" id="savePctInvSentDate_<?php echo e($project->id); ?>" data-date="pctInvRecvdDate_<?php echo e($project->id); ?>"></i>
                                            </div>
                                            <div class="col-md-4"><p>PCT Invoice Paid Date</p></div>
                                            <div class="col-md-2">
                                                <input type="text" id="pctInvPaidDate_<?php echo e($project->id); ?>" style="width: 100% !important;" class="patentAppText saveDataInput pickDate"
                                                       data-prop="pctInvoicePaidDate"
                                                <?php if($projectClientS->pctInvoicePaidDate != "0000-00-00 00:00:00"): ?>
                                                       value="<?php echo e(date('m-d-Y',strtotime(str_replace('-','/',$projectClientS->pctInvoicePaidDate)))); ?>"
                                                       <?php else: ?>
                                                       value="Select Date"
                                                        <?php endif; ?>>
                                                <i class="fa fa-floppy-o saveDate" aria-hidden="true" id="savePctInvPaidDate_<?php echo e($project->id); ?>" data-date="pctInvPaidDate_<?php echo e($project->id); ?>"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Design Invoice #</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="designInvoice_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="designInvoiceNo" data-prop2="designInvoiceSentDate"
                                                       data-p="designInvSentDate_<?php echo e($project->id); ?>"
                                                       value="<?php if($projectClientS->designInvoiceNo!=0): ?><?php echo e($projectClientS->designInvoiceNo); ?><?php endif; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <p>Design Invoice Sent Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="designInvSentDate_<?php echo e($project->id); ?>" class="patentAppText editDate pickDate" style="width: 100% !important;"
                                                       data-prop="designInvoiceSentDate"
                                                <?php if($projectClientS->designInvoiceSentDate!="0000-00-00 00:00:00"): ?>
                                                       value="<?php echo e(date('m-d-Y',strtotime(str_replace('-','/',$projectClientS->designInvoiceSentDate)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Design Check #</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="designCheck_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="designCheckNo" data-prop2="-"
                                                       value="<?php if($projectClientS->designCheckNo!=0): ?><?php echo e($projectClientS->designCheckNo); ?><?php endif; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Design Filed</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="checkDesign_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                       data-prop="designFil_created_at" data-p="designDate_<?php echo e($project->id); ?>"
                                                <?php if($projectClientS->designFil_created_at!=""): ?>
                                                       checked="checked"
                                                        <?php endif; ?>>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Design File Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="designFil_created_at" id="designDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->designFil_created_at!=""): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->designFil_created_at)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Design Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="designNumber_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="designNumber" data-prop2="-"
                                                       value="<?php if($projectClientS->designNumber!=0): ?><?php echo e($projectClientS->designNumber); ?><?php endif; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <p>3D Model Design sent to ILC Date:</p>
                                            </div>
                                            <div class="col-md-2 col-md-offset-4">
                                                <input type="text" data-prop="DModel_sent" id="DModel_sent<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->DModel_sent!="0000-00-00 00:00:00"): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->DModel_sent)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Granted Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="grantedNumber_<?php echo e($project->id); ?>" class="patentAppText inputPatenAppProc"
                                                       data-prop="grantedNumber" data-prop2="grantedDate"
                                                       data-p="grantedDate_<?php echo e($project->id); ?>"
                                                       value="<?php if($projectClientS->grantedNumber!=0): ?><?php echo e($projectClientS->grantedNumber); ?><?php endif; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <p>Granted Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="grantedDate" id="grantedDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                                <?php if($projectClientS->grantedDate!=""): ?>
                                                       value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->grantedDate)))); ?>"
                                                       <?php else: ?>
                                                       disabled="disabled"
                                                        <?php endif; ?>
                                                        >
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App Upgrade Due</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p id="patentAppUp_<?php echo e($project->id); ?>">
                                                    <?php echo e($projectClientS->getUpgradeDue()); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapseILC_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">ILC Marketing Agreement:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseILC_<?php echo e($project->id); ?>" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Industry</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" data-prop="industry" id="industry_<?php echo e($project->id); ?>" class="industryInput" style="width: 100% !important;" value="<?php echo e($projectClientS->industry); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>ILC Marketing Agreement Pkg Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="marketingAgrSent" id="marketingAgrSent_<?php echo e($project->id); ?>" class="checkILCAgreementSent"
                                                   data-prop="marketingAgrSent_created_at" data-p="marketingAgrSentDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->marketingAgrSent_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>ILC Marketing Agreement Pkg Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="marketingAgrSent_created_at" id="marketingAgrSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->marketingAgrSent_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->marketingAgrSent_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>ILC Agreement After Upgrade Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="checkILCAgreementSentAfterUpgrade" id="ILCAfterUpgrade_<?php echo e($project->id); ?>" class="checkILCAgreementSentAfterUpgrade"
                                            <?php if($projectClientS->marketingAgrSentAfterUpgrade_created_at!=""): ?>
                                                   checked="checked"
                                            <?php endif; ?>
                                            <?php if($projectClientS->marketingAgrSent_created_at ==''): ?>
                                                   disabled="disabled"
                                            <?php endif; ?>
                                            >
                                        </div>
                                        <div class="col-md-5">
                                            <p>ILC Agreement After Upgrade Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" id="ILCAfterUpgradeSentDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->marketingAgrSentAfterUpgrade_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->marketingAgrSentAfterUpgrade_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>ILC Marketing Agreement Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="marketingAgrReceived" id="marketingAgrReceived_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="marketingAgrReceived_created_at" data-p="marketingAgrReceivedDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->marketingAgrReceived_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>ILC Marketing Agreement Received Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="marketingAgrReceived_created_at" id="marketingAgrReceivedDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->marketingAgrReceived_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->marketingAgrReceived_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Release Form Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="releaseFormReceived" id="releaseFormReceived_<?php echo e($project->id); ?>" class="checkPatenApp"
                                                   data-prop="releaseFormReceived_created_at" data-p="releaseFormReceivedDate_<?php echo e($project->id); ?>"
                                            <?php if($projectClientS->releaseFormReceived_created_at!=""): ?>
                                                   checked="checked"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Release Form Received Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="releaseFormReceived_created_at" id="releaseFormReceivedDate_<?php echo e($project->id); ?>" class="editDate pickDate" style="width: 100% !important;"
                                            <?php if($projectClientS->releaseFormReceived_created_at!=''): ?>
                                                   value="<?php echo e(date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->releaseFormReceived_created_at)))); ?>"
                                                   <?php else: ?>
                                                   disabled="disabled"
                                                    <?php endif; ?>
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading col-md-12">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#" class="actionQuestions col-md-10">
                                        <i>
                                            <h4 class="panel-title">Notes:</h4>
                                        </i>
                                    </a>
                                    <i class="fa fa-plus col-md-2 addNotesCs" style="border: 1px solid black;padding-right: 5px;padding-left: 5px;" aria-hidden="true"> NEW NOTE</i>
                                </div>
                                <div id="collapseNotes_<?php echo e($projectClientS->id); ?>">
                                    <div class="col-md-12" id="insideCollapseNotes_<?php echo e($projectClientS->id); ?>" style="overflow-y: scroll;min-height: 100px;max-height: 150px;">
                                        <?php $__currentLoopData = $projectClientS->csNotes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $csNotes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="noteLink col-md-12" id="divNote_<?php echo e($csNotes->id); ?>">
                                                <i title="Edit" class="fa fa-pencil-square-o col-md-1 editNotesCs" data-id="<?php echo e($csNotes->id); ?>" aria-hidden="true"></i>
                                                <p id="pNote_<?php echo e($csNotes->id); ?>" title="<?php echo e($csNotes->notes); ?>" class="col-md-6"><?php echo e(strlen($csNotes->notes)>40?substr($csNotes->notes,0,37).'...':$csNotes->notes); ?><?php if($csNotes->notes == 'Automatic Intro Call'): ?><i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;" title="The client services department at Patent Services has contacted you to introduce the department as they will be servicing your patent moving forward. A client services representative is available to speak with you at your convenience during normal business hours, Monday – Friday, 8am-5pm est. If you need assistance or have questions about the patent process, please contact the client services department at 1-888-344-6836."></i><?php endif; ?></p>
                                                <p class="col-md-4 col-md-push-1"><?php echo e(date('m-d-Y h:i a',strtotime(str_replace('-','/',$csNotes->created_at)))); ?></p>
                                                <i title="Delete" class="fa fa-times col-md-1 deleteNotesCs" data-id="<?php echo e($csNotes->id); ?>" aria-hidden="true"></i>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_<?php echo e($project->id); ?>" href="#collapseLegalMaint_<?php echo e($project->id); ?>" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Legal Maintenance Activity:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseLegalMaint_<?php echo e($project->id); ?>" class="collapse container-legalMA">
                                    <div class="col-md-12 col-md-offset-3">
                                        <button class="btn btn-primary newLegalAct">New Legal Maintenance Activity</button>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 15px;">
                                        <table class="table table-bordered" cellspacing="0" style="width: 97% !important;">
                                            <thead id="tableDataHead_<?php echo e($project->id); ?>" style="background-color: #428bca;color:#ffffff;">
                                            <tr>
                                                <th style="vertical-align: top;width: 3.5%;"></th>
                                                <th style="vertical-align: top;width: 14%;">Legal Activity ID</th>
                                                <th style="vertical-align: top;width: 18%;">Activity Type</th>
                                                <th style="vertical-align: top;width: 18%;">Activity</th>
                                                <th style="vertical-align: top;width: 14%;">Activity Due Date</th>
                                                <th style="vertical-align: top;width: 14%;">Rcvd Date</th>
                                                <th style="vertical-align: top;width: 18.5%;">Description</th>
                                            </tr>
                                            </thead>
                                        </table>
                                        <div style="overflow-y: scroll;max-height: 300px;">
                                            <table id="tableLegalAct_<?php echo e($project->id); ?>" class="table table-bordered" cellspacing="0" width="100%"
                                            <?php if($projectClientS->hasLegalRecord()): ?>
                                                   data-existlegal ="1"
                                                   <?php else: ?>
                                                   data-existlegal ="0"
                                                    <?php endif; ?>>
                                                <tbody id="tableDataBodyLegal_<?php echo e($project->id); ?>"> 
                                                <?php $__currentLoopData = $projectClientS->legalRecords(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $legalAct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr id='legalAct_<?php echo e($legalAct->id); ?>'>
                                                        <th style="vertical-align: top;width: 3%;"><i title="Delete" class="fa fa-times deleteLegalA" data-id="<?php echo e($legalAct->id); ?>" aria-hidden="true"></i></th>
                                                        <th style="width: 14%;"><a class='edit-legal-Act' data-id="<?php echo e($legalAct->id); ?>"><?php echo e($legalAct->legal_record); ?></a></th>
                                                        <th style="width: 18%;"><?php echo e($legalAct->record_type); ?></th>
                                                        <th style="width: 18%;"><?php echo e($legalAct->activity); ?></th>
                                                        <th style="width: 14%;"><?php echo e(date("m/d/Y",strtotime($legalAct->activity_due_date))); ?></th>
                                                        <th style="width: 14%;"><?php echo e(date("m/d/Y",strtotime($legalAct->recv_date))); ?></th>
                                                        <th style="width: 19%;"><p style='font-size: 11px;' title="<?php echo e($legalAct->description); ?>"><?php echo e(strlen($legalAct->description)>24?substr($legalAct->description,0,24)." ...":$legalAct->description); ?></p></th>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php if($processStarted == 0): ?>
                            <div class="col-md-12">
                                <button type="button" class="createProjBuntton btn btn-primary" data-id="<?php echo e($project->id); ?>">CREATE LEGAL</button>
                            </div>
                        <?php elseif($processStarted == 1): ?>
                            <h2> Process Started in Salesforce</h2>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="tab-pane" id="portlet_tab_<?php echo e($project->id); ?>_4" role="tabpanel">
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
                </div>
            </div>
        </div>
    </div>
</div>
