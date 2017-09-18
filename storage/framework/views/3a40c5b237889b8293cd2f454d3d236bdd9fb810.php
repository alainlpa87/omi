<div class="portlet col-md-12 <?php echo e($project->actionDate>date("Y-m-d")." 23:59:59"?"actionDateBigger":""); ?> <?php echo e($new==1?"portlet-new":""); ?>" id="container_<?php echo e($project->id); ?>"  data-id = "<?php echo e($project->id); ?>" data-lead-id="<?php echo e($project->lead->id); ?>" data-fileno="<?php echo e($project->lead->fileno); ?>" data-date-action="<?php echo e(($project->actionDate == '0000-00-00 00:00:00'?'00-00-0000 00:00:00':date('m-d-Y',strtotime(str_replace('-','/',$project->actionDate))))); ?>">
    <div class="box call">
        <div class="portlet-title">
            <div class="caption">
                <span id="captionFullName_<?php echo e($project->id); ?>"><?php echo e($project->lead->lname.", ".$project->lead->fname); ?></span> - <?php echo e($project->lead->fileno); ?> - <?php echo e($project->id); ?>

            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li>
                    <a href="#portlet_tab_<?php echo e($project->id); ?>_4" data-toggle="tab" role="tab"> <?php echo e(BUSINESS_PROFILE); ?> </a>
                </li>
                <li>
                    <a href="#portlet_tab_<?php echo e($project->id); ?>_3" data-toggle="tab" role="tab"> <?php echo e(PROJECT); ?> </a>
                </li>
                <li>
                    <a href="#portlet_tab_<?php echo e($project->id); ?>_2" data-toggle="tab" role="tab"> <?php echo e(PROFILE); ?> </a>
                </li>
                <li class="active">
                    <a href="#portlet_tab_<?php echo e($project->id); ?>_1" data-toggle="tab" role="tab"> <?php echo e(BASE); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body" id="portletBody_<?php echo e($project->id); ?>">
            <div class="tab-content col-md-12">
                <div class="tab-pane active" id="portlet_tab_<?php echo e($project->id); ?>_1" role="tabpanel">
                    <div class="col-md-12 boxProjectInfo">
                        <div class="col-md-3">
                            <p id="creation_p_<?php echo e($project->id); ?>"><?php echo e($project->created_at); ?></p>
                        </div>
                        <div class="col-md-4">
                            <p id="request_p_<?php echo e($project->id); ?>" class="lastRequestProject">
                                <?php echo $project->lastRequestToAdmin()?"REQUEST ".$project->lastRequestToAdmin()->consultantStage.' : <span id="request_p_admin_'.$project->id.'">'.
                                (strlen($project->lastRequestToAdmin()->adminStage)>0?
                                $project->lastRequestToAdmin()->adminStage.($project->pendingNMI==1?
                                "<span class='moreInfo'> BUT NEEDS MORE INFO <i data-id='".$project->lastRequestToAdmin()->id."' class='fa fa-envelope-square requestMoreInfoReview'></i></span>":"")
                                :"N/A")."</span>":""; ?>

                            </p>
                        </div>
                        <div class="col-md-3">
                            <?php if($project->totalPhase1AmountIn() < 879): ?>
                                <p id="contract_p_<?php echo e($project->id); ?>" class="allowFunding">
                                    Allow Funding
                                    <input type="checkbox" id="allowFundingCheckbox_<?php echo e($project->id); ?>" class="allowFundingCheckbox" data-id="<?php echo e($project->id); ?>" <?php echo e($project->lastFundingContract() && $project->lastFundingContract()->paid<$project->lastFundingContract()->price?" checked":""); ?>>
                                    <label><?php echo e($project->lastFundingContract()?money_format("Total Paid: %i", $project->lastFundingContract()->paid):""); ?></label>
                                </p>
                            <?php endif; ?>
                            <?php if($project->allowPPA()): ?>
                            <div id="contract_p_ppa_<?php echo e($project->id); ?>" class="allowPPA">
                                Allow PPA
                                <input type="checkbox" id="allowPPACheckbox_<?php echo e($project->id); ?>" class="allowPPACheckbox" data-id="<?php echo e($project->id); ?>" <?php echo e($project->contractPPA()!=""?" checked":""); ?>>
                                <label><?php echo e($project->contractPPA()?money_format("Total Paid: %i", $project->contractPPA()->paid):""); ?></label>
                                <div id="alloyHalfPricePPABox_<?php echo e($project->id); ?>" style="<?php echo e($project->contractPPA()=="" || $project->contractPPA()->paid!=0 ? "display:none;":""); ?>">
                                    Allow Half Payment PPA
                                    <input type="checkbox" data-amount="<?php echo e($project->contractPPA()!=""?$project->contractPPA()->paid:0); ?>" id="allowHalfPricePPAProject_<?php echo e($project->id); ?>" class="allowHalfPricePPAProject"  data-id="<?php echo e($project->id); ?>" <?php echo e($project->contractPPA()!="" && $project->contractPPA()->halfPrice==1?" checked":""); ?>/>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-2">
                            <p id="contract_info_<?php echo e($project->id); ?>" class="boxLasContractInfo">
                                <?php echo $project->lastContractNoWP()?"Last Send <br><span>(".$project->lastContractNoWP()->type.' : '.money_format("%i",$project->lastContractNoWP()->price).")</span>":""; ?>

                            </p>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <h4><strong>Name: </strong></h4>
                            <p id="full_name_p_<?php echo e($project->id); ?>"><?php echo e($project->lead->fname." ".$project->lead->lname); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h4> <strong> Primary Phone: </strong></h4>
                            <p id="phone_p_<?php echo e($project->id); ?>"><?php echo e($project->lead->phone); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h4> <strong> Address: </strong></h4>
                            <p id="address_p_<?php echo e($project->id); ?>"><?php echo e($project->lead->street." ".$project->lead->street2); ?></p>
                        </div>
                        <div class="col-md-2">
                            <p id="contract_p_tpaid_<?php echo e($project->id); ?>"  class="boxLastPaymentInfo">
                                <?php echo $project->totalPhase1AmountIn() != ""?"Total PH1 Paid <br><span>(".money_format("%i",$project->totalPhase1AmountIn()).")</span>":""; ?>

                            </p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <h4> <strong> Email: </strong></h4>
                            <p id="email_p_<?php echo e($project->id); ?>"><?php echo e($project->lead->email); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h4> <strong> Secondary Phone: </strong></h4>
                            <?php if(strlen($project->lead->phone2)>0): ?><input type="checkbox" class="checkPhone" id="checkPhone_<?php echo e($project->id); ?>" style="float: left;"><?php endif; ?>
                            <p id="phone_p_<?php echo e($project->id); ?>_2" data-checkable="<?php echo e(strlen($project->lead->phone2)>0?1:0); ?>"><?php echo e($project->lead->phone2); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h4> <strong> City: </strong></h4>
                            <p id="city_p_<?php echo e($project->id); ?>"><?php echo e($project->lead->city); ?></p>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btnFiles" data-id="<?php echo e($project->id); ?>" >Files</button>
                            <button class="btn btn-primary btnResetP" data-id="<?php echo e($project->id); ?>" >Reset PW</button>
                            <button class="btn btn-primary btnInbox" data-id="<?php echo e($project->lead->id); ?>" >Inbox</button>
                            <button class="btn btn-primary productionShipmentDate" data-id="<?php echo e($project->id); ?>">Product <i class="fa fa-calendar"></i></button>
                            <div id="allowEcheckPaymentsBox_<?php echo e($project->id); ?>">
                                Echeck Payments
                                <input type="checkbox" id="allowEcheckPayments_<?php echo e($project->id); ?>" class="allowEcheckPayments"  data-id="<?php echo e($project->id); ?>" <?php echo e($project->echeck==1?" checked":""); ?>/>
                            </div>
                            <?php if($project->getProjectProduction() !=null && $project->getProjectProduction()->attorney() !=null): ?>
                                <div id="loe_<?php echo e($project->id); ?>" title="Att: <?php echo e(ucwords($project->getProjectProduction()->attorney()->fname." ".$project->getProjectProduction()->attorney()->lname)); ?>"><?php echo e($project->getProjectProduction()->letterofengagement == 1?'LOE Sent : '.date('m/d',strtotime(str_replace('-','/',$project->getProjectProduction()->sent_letterofeng))):($project->getProjectProduction()->letterofengagement == 2?'LOE Received : '.date('m/d',strtotime(str_replace('-','/',$project->getProjectProduction()->sent_letterofeng))):'')); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4" id="project_utility_box_<?php echo e($project->id); ?>" <?php echo e($project->utility != '' || $project->IigType() != '' ?"":'style=display:none;'); ?>>
                            <?php if($project->utility != ''): ?>
                            <h4><strong>PPA TYPE:</strong></h4>
                            <p id="ppa_type_<?php echo e($project->id); ?>" data-utility="<?php echo e($project->utility); ?>" data-img="<?php echo e($project->lastContractPaid() && $project->lastContractPaid()['TYPE']=="IMG"?1:0); ?>"><?php echo e($project->utility=="U_D"?"Utility & Design":$project->utility); ?></p>
                            <?php endif; ?>
                            <p id="iig_plan_<?php echo e($project->id); ?>" data-plan="<?php echo e($project->IigType()); ?>"><strong>IIG PLAN: </strong><?php echo e($project->IigType() != ''?$project->IigType():''); ?></p>
                        </div>

                        <div class="col-md-3">
                            <h4><strong>Best Time to call:</strong></h4>
                            <p id="best_p_<?php echo e($project->id); ?>"><?php echo e($project->lead->best); ?></p>
                        </div>
                        <div class="col-md-3">
                            <h4><strong>State, Zip: </strong></h4>
                            <p id="state_p_<?php echo e($project->id); ?>"><?php echo e($project->lead->state.", ".$project->lead->zip); ?></p>
                        </div>
                        <div class="col-md-2">
                            <input class="dateMove form-control datepicker" id="dateMove_<?php echo e($project->id); ?>" name="DATE" readonly="readonly" size="30" type="text" value="<?php echo e(($project->actionDate == '0000-00-00 00:00:00'? date("m-d-Y"):date('m-d-Y',strtotime(str_replace('-','/',$project->actionDate))))); ?>">
                            <button class="btn btn-primary btnMoveToDate" data-id="<?php echo e($project->id); ?>">Move to Date</button>
                        </div>
                    </div>
                    <div class="col-md-12 container-stages">
                        <button class="btn <?php echo e($project->stage=="CONCEPT"?"btn-primary":"btn-default"); ?> btnProjectStage" data-id="<?php echo e($project->id); ?>" data-current="0">CONCEPT</button>
                        <button class="btn <?php echo e($project->stage=="PREP"?"btn-primary":"btn-default"); ?> btnProjectStage" data-id="<?php echo e($project->id); ?>" data-current="0">PREP</button>
                        <button class="btn <?php echo e($project->stage=="CONTRACT"?"btn-primary":"btn-default"); ?> btnProjectStage" data-id="<?php echo e($project->id); ?>" data-current="0">CONTRACT</button>
                        <button class="btn <?php echo e($project->stage=="WOM"?"btn-primary":"btn-default"); ?> btnProjectStage" data-id="<?php echo e($project->id); ?>" data-current="0">WOM</button>
                        <button class="btn <?php echo e($project->stage=="WALKTHRU"?"btn-primary":"btn-default"); ?> btnProjectStage" data-id="<?php echo e($project->id); ?>" data-current="0">WALKTHRU</button>
                        <button class="btn <?php echo e($project->stage=="PHASE2"?"btn-primary":"btn-default"); ?> btnProjectStage" data-id="<?php echo e($project->id); ?>" data-current="0">PHASE2</button>
                        <button class="btn <?php echo e($project->stage=="ARCHIVE"?"btn-primary":"btn-default"); ?> btnProjectStage" data-id="<?php echo e($project->id); ?>" data-current="0">ARCHIVE</button>
                        <?php if($project->status=="EXCLUDE"): ?>
                            &nbsp;<button class="btn btn-success btnAddProject" data-id="<?php echo e($project->id); ?>">RESTORE</button>
                        <?php else: ?>
                            &nbsp;<button class="btn btn-danger btnRemoveProject" data-id="<?php echo e($project->id); ?>">EXCLUDE</button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_<?php echo e($project->id); ?>_2"
                     role="tabpanel">
                    <div class="col-md-6 col-xs-12">
                        <h5>Age:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->lead->age())>0?$project->lead->age()." years":"N/A"); ?></p>
                        <h5>Occupation:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->lead->occupation)>0?$project->lead->occupation:"N/A"); ?></p>
                        <h5>Any third Party Authorized Contacts:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->tpaContact)>0?$project->tpaContact:"N/A"); ?></p>
                        <h5>Primary Inventors:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->pInventor)>0?$project->pInventor:$project->lead->fname." ".$project->lead->lname); ?></p>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <ul class="nav nav-tabs nav-projects" role="notesAndInbox">
                            <li><a href="#portlet_tab_notes_<?php echo e($project->id); ?>_3" data-toggle="tab" role="tab"> LOGS </a></li>
                            <li><a href="#portlet_tab_notes_<?php echo e($project->id); ?>_1" data-toggle="tab" role="tab"> LEAD NOTES </a></li>
                            <li  class="active"><a href="#portlet_tab_notes_<?php echo e($project->id); ?>_2" data-toggle="tab" role="tab"> PROJECT NOTES </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="portlet_tab_notes_<?php echo e($project->id); ?>_2" role="tabpanel">
                                <div class="col-md-12" style="padding: 0px;">
                                    <textarea class="editableval notesTextarea" id="notes_<?php echo e($project->id); ?>"><?php echo e(str_replace("<br>","\n",$project->notes)); ?></textarea>
                                </div>
                                <div class="col-md-12 container-btn-project">
                                    <button type="button" data-id="<?php echo e($project->id); ?>" class="btn btn-primary btnUpdateNotes">SAVE NOTES</button>
                                    <?php if(isset($consultant) && $consultant->usr == 'alain'): ?>
                                        <br><br><br><br>
                                        <button type="button" data-id="<?php echo e($project->id); ?>" id="btnShareNote" data-pid="<?php echo e($project->id); ?>" class="btn btn-primary">CREATE NOTE TO SHARE</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="portlet_tab_notes_<?php echo e($project->id); ?>_1" role="tabpanel">
                                <div class="col-md-12" style="padding: 0px;">
                                    <textarea readonly="readonly" class="editableval notesTextarea"><?php echo e(str_replace("<br>","\n",$project->lead->notes)); ?></textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="portlet_tab_notes_<?php echo e($project->id); ?>_3" role="tabpanel">
                                <p class="projectLogs"></p>
                                
                                <i class="fa fa-refresh updateLogs pull-right" data-id="<?php echo e($project->id); ?>"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_<?php echo e($project->id); ?>_3" role="tabpanel">
                    <h3><i class="fa fa-print fa-3 printProject" data-toggle="tooltip" data-placement="bottom" title="Print Submission" data-id = "<?php echo e($project->id); ?>" ></i></h3>
                    <div class="col-md-12">
                        <h5>Name Of Invention:</h5>
                        <p  class="pProjectInfo" id="ideaname_<?php echo e($project->id); ?>"><?php echo e(strlen($project->ideaName)>0?$project->ideaName:"N/A"); ?></p>
                        <h5>In a few words, what does your idea do?(The concept):</h5>
                        <p  class="pProjectInfo"><?php echo e(strlen($project->ideaConcept)>0?$project->ideaConcept:"N/A"); ?></p>
                        <h5>Tell us when and how you thought of your invention:</h5>
                        <p  class="pProjectInfo"><?php echo e(strlen($project->hisIdea)>0?$project->hisIdea:"N/A"); ?></p>
                        <h5>How does your new invention WORK, OPERATE or FUNCTION:</h5>
                        <p  class="pProjectInfo"><?php echo e(strlen($project->descIdea)>0?$project->descIdea:"N/A"); ?></p>
                        <h5>What similar product is on the market now?(Similar, but not the same):</h5>
                        <p  class="pProjectInfo"><?php echo e(strlen($project->similarProduct)>0?$project->similarProduct:"N/A"); ?></p>
                        <h5>What Problem does your idea solve?:</h5>
                        <p  class="pProjectInfo"><?php echo e(strlen($project->probIdea)>0?$project->probIdea:"N/A"); ?></p>
                        <div class="col-md-6">
                            <h5>How much will it cost to produce your idea?:</h5>
                            <p  class="pProjectInfo"><?php echo e(strlen($project->costSpend)>0?$project->costSpend:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>How much will you sell it for?</h5>
                            <p  class="pProjectInfo"><?php echo e(strlen($project->payIdea)>0?$project->payIdea:"N/A"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>"Is your idea software or an app?:</h5>
                            <p  class="pProjectInfo"><?php echo e($project->isApp == 1?"Yes":"No"); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Language:</h5>
                            <p  class="pProjectInfo"><?php echo e($project->language!=''?ucwords($project->language):"N/A"); ?></p>
                        </div>
                        <div class="col-md-6 approveBox" data-id="<?php echo e($project->id); ?>">
                            <span class="spanRequestApprove">If Product Description is Complete - Request Approval  <i class="fa fa-thumbs-up fa-2x green" data-id="<?php echo e($project->id); ?>"></i></span>
                        </div>
                        <div class="col-md-6 rejectBox"  data-id="<?php echo e($project->id); ?>">
                            <span class="spanRequestReject">If Product on Reject List - Request Reject <i class="fa fa-thumbs-down fa-2x red" data-id="<?php echo e($project->id); ?>"></i></span>
                        </div>
                        <h5>Admin notes:</h5>
                        <p class="pProjectInfo"><?php echo e($project->adminNotes); ?></p>
                        <h5 class="absolute">Invention Details / Notes</h5>
                        <div class="col-md-3 col-md-offset-9 divRequestClientReview">
                            <span class="spanRequestClientReview" data-id="<?php echo e($project->id); ?>">Request Client Review  <i class="fa fa-thumbs-up fa-2x green" data-id="<?php echo e($project->id); ?>"></i></span>
                        </div>
                        <textarea class="salesNotes editableval col-md-12 col-xs-12" data-id="<?php echo e($project->id); ?>"><?php echo e($project->approvalNotes); ?></textarea>
                        <h5>Inventor Personal Information</h5>
                        <textarea class="internalNotes editableval col-md-12 col-xs-12" data-id="<?php echo e($project->id); ?>"><?php echo e($project->internalNotes); ?></textarea>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_<?php echo e($project->id); ?>_4" role="tabpanel">
                    <h3><i class="fa fa-print fa-3 printBusiness" data-toggle="tooltip" data-placement="bottom" title="Print Submission" data-id = "<?php echo e($project->id); ?>" ></i></h3>
                    <div class="col-md-12">
                        <h5>Invention Name:</h5>
                        <p class="pProjectInfo ideaNameSecondP"><?php echo e(strlen($project->ideaName)>0?$project->ideaName:"N/A"); ?></p>
                        <h5>Invention Short Description:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->ideaConcept)>0?$project->ideaConcept:"N/A"); ?></p>
                        <h5>Tell us when and how you thought of your invention:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->hisIdea)>0?$project->hisIdea:"N/A"); ?></p>
                        <h5>How does your new invention WORK, OPERATE or FUNCTION:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->descIdea)>0?$project->descIdea:"N/A"); ?></p>
                        <h5>How is your new invention DIFFERENT from other similar ideas? (Uniqueness):</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->uniIdea)>0?$project->uniIdea:"N/A"); ?></p>
                        <h5>What similar product is on the market now?(Similar, but not the same):</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->similarProduct)>0?$project->similarProduct:"N/A"); ?></p>
                        <h5>What Problem does your idea solve?What are the advantages and benefits of your idea's solution?:</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->probIdea)>0?$project->probIdea:"N/A"); ?></p>
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
                        <h5>Describe the environment (wet, dry, temperature, pressure, light, dark, etc.) in which your idea will function? :</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->environment)>0?$project->environment:"N/A"); ?></p>
                        <h5>If your idea is a "device", what does it consume or produce? And what powers it? (Manual, electricity, gasoline, sunlight, water power, batteries, etc.) :</h5>
                        <p class="pProjectInfo"><?php echo e(strlen($project->environment)>0?$project->device:"N/A"); ?></p>
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
                            <p class="pProjectInfo"><?php echo e(strlen($project->lead->birth)>0?$project->lead->birth:"N/A"); ?></p>
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