<div class="portlet portlet-new" id="container_{{$project->id}}" style="height: auto;"  data-id = "{{$project->id}}" data-request-id="{{$project->id}}" data-lead-id="{{$project->lead->id}}" data-date-action="{{$project->actionDate}}" data-iid = "{{$projectilc->id}}">
    <div class="box call">
        <div class="portlet-title">
            <div class="indicator caption"  style="z-index: 100" data-id="{{$project->id}}">
                <i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<span id="captionFullName_{{$project->id}}">{{$project->lead->lname.", ".$project->lead->fname}}</span> - {{$project->lead->fileno}} - {{$project->lead->leadSource}}
            </div>
            <ul class="nav nav-tabs"  id="navTabs_{{$project->id}}" role="tablist">
                {{--<li>--}}
                {{--<a href="#portlet_tab_{{$project->id}}_4" data-toggle="tab" role="tab"> BUSINESS PROFILE </a>--}}
                {{--</li>--}}
                <li>
                    <a href="#portlet_tab_{{$project->id}}_2" data-toggle="tab" role="tab"> ILC</a>
                </li>
                <li class="active">
                    <a href="#portlet_tab_{{$project->id}}_1" data-toggle="tab" role="tab"> CLIENT </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body" id="portletBody_{{$project->id}}">
            <div class="tab-content col-md-12 portlet_tab_content_{{$project->id}}" style="display: block">
                <div class="tab-pane active" id="portlet_tab_{{$project->id}}_1" role="tabpanel">
                    <div class="col-md-12 boxProjectInfo">
                        <div class="col-md-3">
                            @if($projectilc->created_at != '0000-00-00 00:00:00')
                                <p id="creation_p_{{$project->id}}">{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectilc->created_at)))}}</p>
                            @else
                                <p id="creation_p_{{$project->id}}">{{$projectilc->created_at}}</p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <i><strong><p id="request_p_{{$project->id}}">
                                        {{"REQUEST: ".$project->consultantStage}}
                                    </p></strong></i>
                        </div>
                        <div class="col-md-4">
                            <i class="fa fa-print fa-3 printProjectILC adminIcons" data-toggle="tooltip" data-placement="bottom" title="Print Submission" data-id = "{{$project->id}}" ></i>
                            <i class="fa fa-folder-open fa-3 openFilesILC adminIcons" data-toggle="tooltip" data-placement="bottom" title="Open Files" data-iid="{{$projectilc->id}}" data-id = "{{$project->id}}" ></i>
                            <i class="fa fa-upload fa-3 uploadFilesILC adminIcons" data-toggle="tooltip" data-placement="bottom" title="Upload Files" data-id = "{{$project->id}}" ></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <i><h4>Inventor Detail:</h4></i>
                        <div class="col-md-3">
                            <h5>Inventor First Name:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="{{$projectilc->id}}" data-field="invFname" id="pProjectInfoFirstName_{{$projectilc->id}}" value="{{strlen($projectilc->invFname)>0?$projectilc->invFname:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Inventor Last Name:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="{{$projectilc->id}}" data-field="invLname" id="pProjectInfoLastName_{{$projectilc->id}}" value="{{strlen($projectilc->invFname)>0?$projectilc->invLname:"N/A"}}">
                        </div>
                        <div class="col-md-6">
                            <h5>Co-inventor Name:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="{{$projectilc->id}}" data-field="coInvs" id="pProjectInfoCoInvName_{{$projectilc->id}}" value="{{strlen($projectilc->coInvs)>0?$projectilc->coInvs:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5><b>Invention Name:</b></h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="{{$projectilc->id}}" data-field="inventionName" id="pProjectInfoStreet_{{$projectilc->id}}" value="{{strlen($projectilc->inventionName)>0?$projectilc->inventionName:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Street:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="{{$projectilc->id}}" data-field="street" id="pProjectInfoStreet_{{$projectilc->id}}" value="{{strlen($projectilc->street)>0?$projectilc->street:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>City:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-id="{{$project->id}}" data-field="city" id="pProjectInfoCity_{{$projectilc->id}}" value="{{strlen($projectilc->city)>0?$projectilc->city:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>State:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="{{$projectilc->id}}" data-field="state" id="pProjectInfoState_{{$projectilc->id}}" value="{{strlen($projectilc->state)>0?$projectilc->state:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Zip:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="{{$projectilc->id}}" data-field="zip" id="pProjectInfoZip_{{$projectilc->id}}" value="{{strlen($projectilc->zip)>0?$projectilc->zip:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Mobile:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="{{$projectilc->id}}" data-field="phone" id="pProjectInfoPhone_{{$projectilc->id}}" value="{{strlen($projectilc->phone)>0?$projectilc->phone:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Home Phone:</h5>
                            <input type="text" class="pProjectInfo clientDetailsInput" data-iid="{{$projectilc->id}}" data-field="phone2" id="pProjectInfoPhone2_{{$project->id}}" value="{{strlen($projectilc->phone2)>0?$projectilc->phone2:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Email:</h5>
                            <input type="text" id="pProjectInfoEmail_{{$project->id}}" data-iid="{{$projectilc->id}}" data-field="email" class="pProjectInfo clientDetailsInput" value="{{strlen($projectilc->email)>0?$projectilc->email:"N/A"}}">
                        </div>
                        <div class="col-md-6">
                            <h4>Consultant: {{$project->consultant->usr}}</h4>
                        </div>
                        <div class="col-md-3">
                            <h4>Pin: {{$project->id}}</h4>
                        </div>
                        <div class="col-md-3">
                            <h4>App Number: {{$project->clientServicesProject()->patentAppNo}}</h4>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_{{$project->id}}_2" role="tabpanel">
                    <div class="panel-group" id="accordion_{{$project->id}}">
                        <div class="col-md-12 boxProjectILCInfo">
                            <div class="col-md-12 vendorBox">
                                <p>Contract Types: {{$projectilc->projectclientservices->contractTypes}}</p>
                                <p>Contract IIG Plan: {{$projectilc->projectclientservices->project->IigType()}}</p>
                            </div>
                            <div class="col-md-6">
                                @if($projectilc->agreementStartDate != '0000-00-00 00:00:00')
                                    <p id="expiration_date_{{$project->id}}">Expiration Date: {{$expirationDate}}</p>
                                @else
                                    <p id="expiration_date_{{$project->id}}">Expiration Date: {{'0000-00-00 00:00:00'}}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($projectilc->separationDate != '0000-00-00 00:00:00')
                                    <p style="display: inline;" id="separation_date_{{$project->id}}">Separation Date: {{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectilc->separationDate)))}}</p>
                                @else
                                    <p id="separation_date_{{$project->id}}">Separation Date: {{$projectilc->separationDate}}</p>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-12 vendorBox">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapseIndustry_{{$project->id}}" class="actionQuestions" aria-expanded="true">
                                    <i>
                                        <h4 class="panel-title">INDUSTRY & MANUFACTURERS:</h4>
                                    </i>
                                </a>
                            </div>
                            <div id="collapseIndustry_{{$project->id}}" class="collapse in" aria-expanded="true">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Industry:</p>
                                        <select id="industrySelected_{{$projectilc->id}}" class="industrySelected" data-iid="{{$projectilc->id}}" style="margin-top: 15px;">
                                            <option value="0" selected>Select Industry</option>
                                            @foreach($industries as $industry)
                                                <option value="{{$industry->id}}" @if($industry->id==$projectilc->industry_id)selected="selected"@endif>{{$industry->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="col-md-6"><p>Add Manufacturers</p></div>
                                        <div class="col-md-6">
                                            <select id="manufacturerSelect_{{$projectilc->id}}" class="manufacturerSelect" data-iid="{{$projectilc->id}}" style="width: 100%;">
                                                @if($projectilc->industry_id != 0)
                                                    <option value="-1" selected>Select Manufacturer</option>
                                                    @foreach($projectilc->industry->manufacturers as $manufacturer)
                                                        <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                                    @endforeach
                                                @else
                                                    <option value="-1" selected>No industry associated</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Assigned Manufacturers:</p>
                                        </div>
                                        <div class="col-md-6">
                                            <select size="4" id="manufacturersIlc_{{$projectilc->id}}" name="manufacturersIlc" style="width: 100%;">
                                                @foreach($projectilc->manufacturers as $manufacturer)
                                                    <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" id="addManufacturer" data-iid="{{$projectilc->id}}"><i class="fa fa-plus "></i></button>
                                        </div><br>
                                        <div class="col-md-12" style="margin-top: 7px;">
                                            <button class="btn btn-danger" id="removeManufacturer" data-iid="{{$projectilc->id}}"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-md-push-3">
                                        <div class="col-md-5"><p>Additional Emails:</p></div>
                                        <div class="col-md-7"><textarea id="additionalEmails_{{$projectilc->id}}" class="clientDetailsInput" data-field="additionalEmails" data-iid="{{$projectilc->id}}" rows="3" cols="30">{{$projectilc->additionalEmails}}</textarea></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 vendorBox">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapseIntroCall_{{$project->id}}" class="actionQuestions" aria-expanded="true">
                                    <i>
                                        <h4 class="panel-title">INTRO CALL & WEBSITE CODES:</h4>
                                    </i>
                                </a>
                            </div>
                            <div id="collapseIntroCall_{{$project->id}}" class="collapse in" aria-expanded="true">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Intro Call</p>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="checkbox" name="introCallCheck" id="introCallCheck_{{$projectilc->id}}" class="checkIntroCall"
                                               data-prop="introCallDate"
                                        @if(!(strpos($projectilc->introCallDate, '00:00:00') !== false))
                                               checked="checked"
                                                @endif
                                                >
                                    </div>
                                    <div class="col-md-3 col-md-push-2">
                                        <p>Intro Call Date: </p>
                                    </div>
                                    <div class="col-md-3 col-md-push-2">
                                        <input type="text" data-prop="introCallDate" id="introCallDate_{{$projectilc->id}}" class="editDate pickDate" style="width: 100% !important;"
                                        @if(!(strpos($projectilc->introCallDate, '00:00:00') !== false))
                                               value="{{date('m-d-Y',strtotime($projectilc->introCallDate))}}"
                                               @else
                                               disabled="disabled"
                                                @endif
                                                >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Website Codes</p>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="checkbox" name="websiteCodesCheck" id="websiteCodesCheck_{{$projectilc->id}}" class="checkIntroCall"
                                               data-prop="website_codes"
                                        @if($projectilc->website_codes != '0000-00-00 00:00:00')
                                               checked="checked"
                                                @endif
                                                >
                                    </div>
                                    <div class="col-md-3 col-md-push-2">
                                        <p>Website Codes Date: </p>
                                    </div>
                                    <div class="col-md-3 col-md-push-2">
                                        <input type="text" data-prop="website_codes" id="websiteCodesDate_{{$projectilc->id}}" class="editDate pickDate" style="width: 100% !important;"
                                        @if($projectilc->website_codes!= '0000-00-00 00:00:00')
                                               value="{{date('m-d-Y',strtotime($projectilc->website_codes))}}"
                                               @else
                                               disabled="disabled"
                                                @endif
                                                >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Website Codes User: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="websiteUser_{{$projectilc->id}}" data-iid="{{$projectilc->id}}" data-field="website_codes_user" class="editWebsiteCodes" style="width: 100% !important;" value="{{$projectilc->website_codes_user}}">
                                    </div>
                                    <div class="col-md-3">
                                        <p>Website Codes Pswd: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="websitePswd_{{$projectilc->id}}" data-iid="{{$projectilc->id}}" data-field="website_codes_pswd" style="width: 100% !important;" class="editWebsiteCodes" value="{{$projectilc->website_codes_pswd}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Call after tradeshow: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="callTradeshow_{{$projectilc->id}}" data-iid="{{$projectilc->id}}" class="setCallTradeshow"
                                        @if($projectilc->callTradeshow == "1")
                                               checked="checked"
                                                @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <p>3D (or 2D) Model Rcvd: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="dModelRcvd_{{$projectilc->id}}" data-pid="{{$projectilc->projectclientservices_id}}" class="checkDModelRcvd"
                                        @if($projectilc->projectclientservices->DModel_rcvd != "0000-00-00 00:00:00")
                                               checked="checked" disabled="disabled"
                                                @endif>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="panel-heading col-md-12">
                                <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapseNotes_{{$projectilc->id}}" class="col-md-9">
                                    <i>
                                        <h4 class="panel-title">Notes:</h4>
                                    </i>
                                </a>
                                <i class="fa fa-plus col-md-3 addNotesIlc" data-iid ="{{$projectilc->id}}" style="border: 1px solid black;padding-right: 5px;padding-left: 5px;" aria-hidden="true"> NEW NOTE</i>
                            </div>
                            <div id="collapseNotes_{{$projectilc->id}}">
                                <div class="col-md-12" id="insideCollapseNotes_{{$projectilc->id}}" style="overflow-y: scroll;min-height: 100px;max-height: 150px;">
                                    @foreach ($projectilc->ilcNotes() as $ilcNotes)
                                        <div class="noteLink col-md-12" id="divNote_{{$ilcNotes->id}}">
                                            <i title="Edit" class="fa fa-pencil-square-o col-md-1 editNotesIlc" data-id="{{$ilcNotes->id}}" data-system="{{$ilcNotes->system}}" aria-hidden="true"></i>
                                            <p id="pNote_{{$ilcNotes->id}}" title="{{$ilcNotes->notes}}" class="col-md-6">{{strlen($ilcNotes->notes)>45?substr($ilcNotes->notes,0,40).'...':$ilcNotes->notes}}</p>
                                            <p class="col-md-4">{{date('m-d-Y h:i a',strtotime(str_replace('-','/',$ilcNotes->created_at)))}}</p>
                                            @if($ilcNotes->system == 0)<i title="Delete" class="fa fa-times col-md-1 deleteNotesIlc" data-id="{{$ilcNotes->id}}" aria-hidden="true"></i>@endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>