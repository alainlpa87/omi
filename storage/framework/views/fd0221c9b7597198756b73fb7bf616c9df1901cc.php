<div class="portlet col-md-12 <?php echo e($new==1?"portlet-new":""); ?>" id="container_<?php echo e($lead->id); ?>" data-last="<?php echo e($lead->last); ?>" data-id = "<?php echo e($lead->id); ?>" data-fileno = "<?php echo e($lead->fileno); ?>" style="<?php echo e($lead->flag==''||$lead->flag=="transparent"?'':"border: 5px solid ".$lead->flag); ?>;">
    <div class="box call">
        <div class="portlet-title">
            <div class="caption">
                <i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<?php echo e($lead->lname.", ".$lead->fname." - ".$lead->fileno); ?>

            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li>

                    <a href="#portlet_tab_<?php echo e($lead->id); ?>_2" data-toggle="tab" role="tab"> <?php echo e(SHOW_DETAILS); ?> </a>
                </li>
                <li class="active">
                    <a href="#portlet_tab_<?php echo e($lead->id); ?>_1" data-toggle="tab" role="tab"> <?php echo e(BASE); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body" id="portletBody_<?php echo e($lead->id); ?>" style="<?php echo e($lead->local == "1" ? 'background-color: rgb(247, 223, 231);':null); ?>">
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_tab_<?php echo e($lead->id); ?>_1" role="tabpanel">
                    <div class="container-flags">
                        <img src="<?php echo e(asset('img/greenflag.png')); ?>" width="15" height="13"  data-color="green" data-id="<?php echo e($lead->id); ?>" class="flag"/>
                        <img src="<?php echo e(asset('img/orangeflag.png')); ?>" width="15" height="13" data-color="orange" data-id="<?php echo e($lead->id); ?>" class="flag"/>
                        <img src="<?php echo e(asset('img/purpleflag.png')); ?>" width="15" height="13" data-color="purple" data-id="<?php echo e($lead->id); ?>" class="flag"/>
                        <img src="<?php echo e(asset('img/redflag.png')); ?>" width="15" height="13" data-color="red" data-id="<?php echo e($lead->id); ?>" class="flag"/>
                        <img src="<?php echo e(asset('img/defaultflag.png')); ?>" width="15" height="13" data-color="black" data-id="<?php echo e($lead->id); ?>" class="flag"/>
                        <span id='flag_portletBody_<?php echo e($lead->id); ?>' style='font-size:5%;'><?php echo e($lead->flag==''?'transparent':$lead->flag); ?></span>
                    </div>
                    <div class="col-md-3">
                        <h4><strong>Name: </strong></h4>
                        <p id="full_name_c_<?php echo e($lead->id); ?>"><?php echo e($lead->fname.", ".$lead->lname); ?></p>
                    </div>
                    <div class="col-md-3">
                        <h4> <strong> Phone: </strong></h4>
                        <p id="phone_c_<?php echo e($lead->id); ?>"><?php echo e($lead->phone); ?></p>
                    </div>
                    <div class="col-md-3">
                        <h4><strong>Local Time:</strong></h4>
                        <p class ="<?php echo e(in_array( $lead->state, $pst )?"PST":
                                            (in_array( $lead->state, $mst )?"MST":
                                            ((in_array( $lead->state, $cst )?"CST":
                                            (in_array(  $lead->state, $est )?"EST":
                                            (in_array(  $lead->state, $mdt )?"MDT":
                                            ($lead->state=="AK"?"AST":
                                            ($lead->state == 'HI' ? 'HST':"EST")))))))); ?>"></p>
                    </div>
                    <div class="col-md-3">
                        <h4> <strong> Last Time Called: </strong></h4>
                        <p id="last_c_<?php echo e($lead->id); ?>"><?php echo e($lead->last); ?></p>
                    </div>
                    <div class="col-md-3">
                        <h4><strong>File #: </strong></h4>
                        <p id="address_c_<?php echo e($lead->id); ?>"><?php echo e($lead->fileno); ?></p>
                    </div>
                    <div class="col-md-3">
                        <h4> <strong> Email: </strong></h4>
                        <p id="email_c_<?php echo e($lead->id); ?>"><?php echo e($lead->email); ?></p>
                    </div>
                    <div class="col-md-3">
                        <h4><strong>Best Time to call:</strong></h4>
                        <p id="best_c_<?php echo e($lead->id); ?>" style="text-align: center;"><?php echo e($lead->best); ?></p>
                    </div>
                    <div class="col-md-3">
                        <h4> <strong> Reason</strong></h4>
                        <select class="reasoncount" id="reason_<?php echo e($lead->id); ?>">
                            <option>- SELECT REASON -</option>
                            <option>SUBMITED</option>
                            <option>DO NOT CALL</option>
                            <option>DUPLICATE</option>
                            <option>WRONG NUMBER</option>
                            <option>BAD/DISCONECTED</option>
                            <option>OTHER</option>
                        </select>
                        <button type="button" data-id="<?php echo e($lead->id); ?>" class="btn btn-primary btnRemoveLead">REMOVE LEAD</button>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_<?php echo e($lead->id); ?>_2" role="tabpanel">
                    <div class="col-md-8">
                        <div class="col-lg-6 col-md-6">
                            <input class="editableval" placeholder="First Name" id="fname_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->fname); ?>" />
                            <input class="editableval" placeholder="Last Name" id="lname_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->lname); ?>" />
                            <input class="editableval" placeholder="Email" id="email_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->email); ?>" />
                            <input class="editableval" placeholder="Phone" id="phone_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->phone); ?>" />
                            <input type="checkbox" class="checkPhone" id="checkPhone_<?php echo e($lead->id); ?>">
                            <input class="editableval inputSecondPhone" placeholder="Phone2" data-checkable="<?php echo e(strlen($lead->phone2)>0?1:0); ?>" id="phone2_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->phone2); ?>" />
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input class="editableval" placeholder="Street" id="street_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->street); ?>" />
                            <input class="editableval" placeholder="Apartment Number" id="street2_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->street2); ?>" />
                            <input class="editableval" placeholder="City" id="city_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->city); ?>" />
                            <input class="editableval" placeholder="State" id="state_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->state); ?>" />
                            <input class="editableval" placeholder="Zip" id="zip_<?php echo e($lead->id); ?>" type="text" value="<?php echo e($lead->zip); ?>" />
                            <button type="button" data-id="<?php echo e($lead->id); ?>" class="btn btn-primary btnUpdateLead">UPDATE LEAD</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <ul class="nav nav-tabs" role="notesAndLogs">
                            <li><a href="#portlet_tab_notes_<?php echo e($lead->id); ?>_2" data-toggle="tab" role="tab"> LOGS </a></li>
                            <li class="active"><a href="#portlet_tab_notes_<?php echo e($lead->id); ?>_1" data-toggle="tab" role="tab"> NOTES </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="portlet_tab_notes_<?php echo e($lead->id); ?>_1" role="tabpanel">
                                <div class="col-md-12" style="padding: 0px;">
                                    <textarea class="editableval notesTextarea" id="notes_<?php echo e($lead->id); ?>"><?php echo e(str_replace("<br>","\n",$lead->notes)); ?></textarea>
                                </div>
                                <div class="col-md-12 container-btn-lead">
                                    <button type="button" data-id="<?php echo e($lead->id); ?>" class="btn btn-primary btnUpdateNotes">SAVE NOTES</button>
                                </div>
                            </div>
                            <div class="tab-pane" id="portlet_tab_notes_<?php echo e($lead->id); ?>_2" role="tabpanel">
                                <div class="col-md-12" style="padding: 0px;">
                                    <p class="editableval logsTextarea" id="logs_<?php echo e($lead->id); ?>"></p>
                                    
                                    <i class="fa fa-refresh updateLogs pull-right" data-id="<?php echo e($lead->id); ?>"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>