<div class="portlet col-md-12 {{$new==1?"portlet-new":""}}" id="container_{{$lead->id}}" data-last="{{$lead->last}}" data-id = "{{$lead->id}}" data-fileno = "{{$lead->fileno}}" style="{{$lead->flag==''||$lead->flag=="transparent"?'':"border: 5px solid ".$lead->flag}};">
    <div class="box call">
        <div class="portlet-title">
            <div class="caption">
                <i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;{{$lead->lname.", ".$lead->fname." - ".$lead->fileno}}
            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li>

                    <a href="#portlet_tab_{{$lead->id}}_2" data-toggle="tab" role="tab"> {{SHOW_DETAILS}} </a>
                </li>
                <li class="active">
                    <a href="#portlet_tab_{{$lead->id}}_1" data-toggle="tab" role="tab"> {{BASE}} </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body" id="portletBody_{{$lead->id}}" style="{{$lead->local == "1" ? 'background-color: rgb(247, 223, 231);':null}}">
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_tab_{{$lead->id}}_1" role="tabpanel">
                    <div class="container-flags">
                        <img src="{{ asset('img/greenflag.png')}}" width="15" height="13"  data-color="green" data-id="{{$lead->id}}" class="flag"/>
                        <img src="{{ asset('img/orangeflag.png')}}" width="15" height="13" data-color="orange" data-id="{{$lead->id}}" class="flag"/>
                        <img src="{{ asset('img/purpleflag.png')}}" width="15" height="13" data-color="purple" data-id="{{$lead->id}}" class="flag"/>
                        <img src="{{ asset('img/redflag.png')}}" width="15" height="13" data-color="red" data-id="{{$lead->id}}" class="flag"/>
                        <img src="{{ asset('img/defaultflag.png')}}" width="15" height="13" data-color="black" data-id="{{$lead->id}}" class="flag"/>
                        <span id='flag_portletBody_{{$lead->id}}' style='font-size:5%;'>{{$lead->flag==''?'transparent':$lead->flag}}</span>
                    </div>
                    <div class="col-md-3">
                        <h4><strong>Name: </strong></h4>
                        <p id="full_name_c_{{$lead->id}}">{{$lead->fname.", ".$lead->lname}}</p>
                    </div>
                    <div class="col-md-3">
                        <h4> <strong> Phone: </strong></h4>
                        <p id="phone_c_{{$lead->id}}">{{$lead->phone}}</p>
                    </div>
                    <div class="col-md-3">
                        <h4><strong>Local Time:</strong></h4>
                        <p class ="{{in_array( $lead->state, $pst )?"PST":
                                            (in_array( $lead->state, $mst )?"MST":
                                            ((in_array( $lead->state, $cst )?"CST":
                                            (in_array(  $lead->state, $est )?"EST":
                                            (in_array(  $lead->state, $mdt )?"MDT":
                                            ($lead->state=="AK"?"AST":
                                            ($lead->state == 'HI' ? 'HST':"EST")))))))}}"></p>
                    </div>
                    <div class="col-md-3">
                        <h4> <strong> Last Time Called: </strong></h4>
                        <p id="last_c_{{$lead->id}}">{{$lead->last}}</p>
                    </div>
                    <div class="col-md-3">
                        <h4><strong>File #: </strong></h4>
                        <p id="address_c_{{$lead->id}}">{{$lead->fileno}}</p>
                    </div>
                    <div class="col-md-3">
                        <h4> <strong> Email: </strong></h4>
                        <p id="email_c_{{$lead->id}}">{{$lead->email}}</p>
                    </div>
                    <div class="col-md-3">
                        <h4><strong>Best Time to call:</strong></h4>
                        <p id="best_c_{{$lead->id}}" style="text-align: center;">{{$lead->best}}</p>
                    </div>
                    <div class="col-md-3">
                        <h4> <strong> Reason</strong></h4>
                        <select class="reasoncount" id="reason_{{$lead->id}}">
                            <option>- SELECT REASON -</option>
                            <option>SUBMITED</option>
                            <option>DO NOT CALL</option>
                            <option>DUPLICATE</option>
                            <option>WRONG NUMBER</option>
                            <option>BAD/DISCONECTED</option>
                            <option>OTHER</option>
                        </select>
                        <button type="button" data-id="{{$lead->id}}" class="btn btn-primary btnRemoveLead">REMOVE LEAD</button>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_{{$lead->id}}_2" role="tabpanel">
                    <div class="col-md-8">
                        <div class="col-lg-6 col-md-6">
                            <input class="editableval" placeholder="First Name" id="fname_{{$lead->id}}" type="text" value="{{$lead->fname}}" />
                            <input class="editableval" placeholder="Last Name" id="lname_{{$lead->id}}" type="text" value="{{$lead->lname}}" />
                            <input class="editableval" placeholder="Email" id="email_{{$lead->id}}" type="text" value="{{$lead->email}}" />
                            <input class="editableval" placeholder="Phone" id="phone_{{$lead->id}}" type="text" value="{{$lead->phone}}" />
                            <input type="checkbox" class="checkPhone" id="checkPhone_{{$lead->id}}">
                            <input class="editableval inputSecondPhone" placeholder="Phone2" data-checkable="{{strlen($lead->phone2)>0?1:0}}" id="phone2_{{$lead->id}}" type="text" value="{{$lead->phone2}}" />
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input class="editableval" placeholder="Street" id="street_{{$lead->id}}" type="text" value="{{$lead->street}}" />
                            <input class="editableval" placeholder="Apartment Number" id="street2_{{$lead->id}}" type="text" value="{{$lead->street2}}" />
                            <input class="editableval" placeholder="City" id="city_{{$lead->id}}" type="text" value="{{$lead->city}}" />
                            <input class="editableval" placeholder="State" id="state_{{$lead->id}}" type="text" value="{{$lead->state}}" />
                            <input class="editableval" placeholder="Zip" id="zip_{{$lead->id}}" type="text" value="{{$lead->zip}}" />
                            <button type="button" data-id="{{$lead->id}}" class="btn btn-primary btnUpdateLead">UPDATE LEAD</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <ul class="nav nav-tabs" role="notesAndLogs">
                            <li><a href="#portlet_tab_notes_{{$lead->id}}_2" data-toggle="tab" role="tab"> LOGS </a></li>
                            <li class="active"><a href="#portlet_tab_notes_{{$lead->id}}_1" data-toggle="tab" role="tab"> NOTES </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="portlet_tab_notes_{{$lead->id}}_1" role="tabpanel">
                                <div class="col-md-12" style="padding: 0px;">
                                    <textarea class="editableval notesTextarea" id="notes_{{$lead->id}}">{{str_replace("<br>","\n",$lead->notes)}}</textarea>
                                </div>
                                <div class="col-md-12 container-btn-lead">
                                    <button type="button" data-id="{{$lead->id}}" class="btn btn-primary btnUpdateNotes">SAVE NOTES</button>
                                </div>
                            </div>
                            <div class="tab-pane" id="portlet_tab_notes_{{$lead->id}}_2" role="tabpanel">
                                <div class="col-md-12" style="padding: 0px;">
                                    <p class="editableval logsTextarea" id="logs_{{$lead->id}}"></p>
                                    {{--{!! $lead->lastTransactions() !!}--}}
                                    <i class="fa fa-refresh updateLogs pull-right" data-id="{{$lead->id}}"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>