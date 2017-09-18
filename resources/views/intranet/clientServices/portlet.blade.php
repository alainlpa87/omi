<div class="portlet col-md-12 portlet-new" style="height: auto" id="container_{{$project->id}}"  data-id = "{{$project->id}}" data-lead-id="{{$project->lead->id}}" data-fileno="{{$project->lead->fileno}}" data-date-action="{{$project->actionDate}}"
@if($projectClientS!=null)
     data-completed="{{$projectClientS->completed}}"
@endif>
    <div class="box call">
        <div class="portlet-title">
            <div class="indicator caption" style="z-index: 100" data-id="{{$project->id}}">
                <i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<span id="captionFullName_{{$project->id}}">{{$project->lead->lname.", ".$project->lead->fname}}</span> - {{$project->lead->fileno}} - {{$project->lead->leadSource}}
                <i class="pull-left fa fa-chevron-down"  id="indicator_{{$project->id}}"></i>
            </div>
            <ul class="nav nav-tabs invisible" id="navTabs_{{$project->id}}" role="tablist">
                <li>
                    <a href="#portlet_tab_{{$project->id}}_4" data-toggle="tab" role="tab"> BUSINESS PROFILE </a>
                </li>
                <li>
                    <a href="#portlet_tab_{{$project->id}}_3" data-toggle="tab" role="tab"> LEGAL </a>
                </li>
                <li class="active">
                    <a href="#portlet_tab_{{$project->id}}_1" data-toggle="tab" role="tab"> CLIENT </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body hide" id="portletBody_{{$project->id}}">
            <div class="tab-content col-md-12 portlet_tab_content_{{$project->id}}"  style="display: none">
                <div class="tab-pane active" id="portlet_tab_{{$project->id}}_1" role="tabpanel">
                    <div class="col-md-12 vendorBox">
                        @if($projectClientS != null && $projectClientS->completed != 4 && $projectClientS->completed != 5)
                            <div class="col-md-4" style="position:relative;">
                                <select class="select" title="Select Status">
                                    <option ></option>
                                    <option value="4">Closed</option>
                                    <option value="5">Closed (expired)</option>
                                </select>
                            </div>
                        @elseif($projectClientS != null)
                            <div class="col-md-4" style="position: relative;" id="divChangState_{{$project->id}}">
                                <button class="btn btn-warning reOpenBtn" id="reOpenBtn_{{$project->id}}" data-id="{{$project->id}}">Re-Open</button>
                            </div>
                        @endif
                        <div class="col-md-4 btnActionsClientServices">
                            <i class="fa fa-print fa-3 printProject adminIcons" data-toggle="tooltip" data-placement="bottom" title="Print Submission" data-id = "{{$project->id}}" ></i>
                            <i class="fa fa-folder-open fa-3 openFilesClientServices adminIcons" data-toggle="tooltip" data-placement="bottom" title="Open Files" data-id = "{{$project->id}}" ></i>
                            <i class="fa fa-upload fa-3 uploadFilesClientServices adminIcons" data-toggle="tooltip" data-placement="bottom" title="Upload Files" data-id = "{{$project->id}}" ></i>
                            <i class="fa fa-qrcode fa-3 sendPass adminIcons" data-toggle="tooltip" data-placement="bottom" title="Send Password" data-id = "{{$project->id}}" ></i>
                            @if($projectClientS!=null)
                                <i @if($projectClientS->show==1)
                                    class="fa fa-eye showProjectClientServices adminIcons"
                                    title="Hide project"
                                    @else
                                    class="fa fa-eye-slash showProjectClientServices adminIcons"
                                    title="Show project"
                                    @endif
                                    data-toggle="tooltip" data-placement="bottom"  aria-hidden="true"
                                    data-state="{{$projectClientS->show}}" data-id="{{$project->id}}" id="showP_{{$project->id}}"></i>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if($projectClientS!=null && $projectClientS->completed==2)
                            <h5 style="font-weight: bold;color: rgb(157, 12, 12);">Return Reason:</h5>
                            <p class="pProjectInfo" style="background-color: bisque;">{{strlen($projectClientS->returnedReason)>0?$projectClientS->returnedReason:"N/A"}}</p>
                        @elseif($projectClientS!=null && $projectClientS->completed==3)
                            <h5 style="font-weight: bold;color: rgb(157, 12, 12);">Overdue By:</h5>
                            <p class="pProjectInfo" style="background-color: bisque;">{{strlen($projectClientS->overDueReason)>0?$projectClientS->overDueReason:"N/A"}}</p>
                        @endif
                        <i><h4>Inventor Detail:</h4></i>
                        <div class="col-md-3">
                            <h5>Inventor First Name:</h5>
                            <input type="text" name="pProjectInfoFname" id="pProjectInfoFname_{{$project->id}}" data-id="{{$project->id}}" data-field="fname" class="pProjectInfo clientDetailsInput" value="{{strlen($project->lead->fname)>0?$project->lead->fname:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Inventor Last Name:</h5>
                            <input type="text" name="pProjectInfoLname" id="pProjectInfoLname_{{$project->id}}" data-id="{{$project->id}}" data-field="lname" class="pProjectInfo clientDetailsInput" value="{{strlen($project->lead->fname)>0?$project->lead->lname:"N/A"}}">
                        </div>
                        <div class="col-md-6">
                            <h5>Co-inventor Name:</h5>
                            <input type="text" name="pProjectInfoCname" id="pProjectInfoCFname_{{$project->id}}" data-id="{{$project->id}}" data-field="coInventor" class="pProjectInfo clientDetailsInput" value="{{strlen($project->coInventor)>0?$project->coInventor:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Street:</h5>
                            <input type="text" name="pProjectInfoStreet" id="pProjectInfoStreet_{{$project->id}}" data-id="{{$project->id}}" data-field="street" class="pProjectInfo clientDetailsInput" value="{{strlen($project->lead->street)>0?$project->lead->street:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>City:</h5>
                            <input type="text" name="pProjectInfoCity" id="pProjectInfoCity_{{$project->id}}" data-id="{{$project->id}}" data-field="city" class="pProjectInfo clientDetailsInput" value="{{strlen($project->lead->city)>0?$project->lead->city:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>State:</h5>
                            <input type="text" name="pProjectInfoState" id="pProjectInfoState_{{$project->id}}" data-id="{{$project->id}}" data-field="state" class="pProjectInfo clientDetailsInput" value="{{strlen($project->lead->state)>0?$project->lead->state:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Zip:</h5>
                            <input type="text" name="pProjectInfoZip" id="pProjectInfoZip_{{$project->id}}" data-id="{{$project->id}}" data-field="zip" class="pProjectInfo clientDetailsInput" value="{{strlen($project->lead->zip)>0?$project->lead->zip:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Mobile:</h5>
                            <input type="text" name="pProjectInfoPhone1" id="pProjectInfoPhone1_{{$project->id}}" data-id="{{$project->id}}" data-field="phone" class="pProjectInfo clientDetailsInput" value="{{strlen($project->lead->phone)>0?$project->lead->phone:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Home Phone:</h5>
                            <input type="text" name="pProjectInfoPhone2" id="pProjectInfoPhone2_{{$project->id}}" data-id="{{$project->id}}" data-field="phone2" class="pProjectInfo clientDetailsInput" value="{{strlen($project->lead->phone2)>0?$project->lead->phone2:"N/A"}}">
                        </div>
                        <div class="col-md-3">
                            <h5>Email:</h5>
                            <input type="text" name="pProjectInfoEmail" id="pProjectInfoEmail_{{$project->id}}" data-id="{{$project->id}}" data-field="email" class="pProjectInfo clientDetailsInput" value="{{strlen($project->lead->email)>0?$project->lead->email:"N/A"}}">
                        </div>
                        <div class="col-md-6">
                            <h4>Consultant: {{$project->consultant->usr}}</h4>
                        </div>
                        <div class="col-md-6">
                            <h4>Pin: {{$project->id}}</h4>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="portlet_tab_{{$project->id}}_3" role="tabpanel">
                    @if($projectClientS != null)
                        <div class="panel-group" id="accordion_{{$project->id}}">
                            <div class="col-md-12 vendorBox">
                                <input type="hidden" id="attorneys_{{$project->id}}" data-att="{{$attorneys}}">
                                <div class="attorney_info" style="position:relative;top: -6px;">
                                    <i class="fa fa-upload fa-3 uploadFileToAtt adminIcons" data-toggle="tooltip" data-placement="bottom" title="Upload Files to Attorney" data-id="{{$project->id}}"></i>
                                </div>
                                <div class="attorney_info">
                                    <p><strong>Attorney :</strong></p>
                                </div>
                                <div class="attorney_info">
                                    <div class="form-group">
                                        <select id="selectAttorney_{{$project->id}}" class="selectAtt" style="height: 100%;">
                                            <option value="{{$projectClientS->attorney_id}}" selected>
                                                @if($projectClientS->attorney_id != "0")
                                                    @foreach($attorneys as $attorney)
                                                        @if($attorney->id == $projectClientS->attorney_id)
                                                            {{$attorney->usr}}
                                                        @endif
                                                    @endforeach
                                                @else
                                                    ---
                                                @endif
                                            </option>
                                            @foreach($attorneys as $attorney)
                                                @if($attorney->id != $projectClientS->attorney_id)
                                                    <option value="{{$attorney->id}}">
                                                        {{$attorney->usr}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="attorney_info">
                                    <p><strong>Attorney Email: </strong></p>
                                </div>
                                <div class="attorney_info">
                                    <p id="att_email_{{$project->id}}">
                                        @if($projectClientS->attorney_id != "0")
                                            @foreach($attorneys as $attorney)
                                                @if($attorney->id == $projectClientS->attorney_id)
                                                    {{$attorney->email}}
                                                @endif
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapsePPA_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">PPA Details:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapsePPA_{{$project->id}}" class="collapse">
                                    <div class="col-md-6">
                                        <h5>Total PPA Contract Amount:</h5>
                                        @if($projectClientS->contract != null && $projectClientS->contract->ppaTotalPrice() >0)
                                            $ <input type="number"  id="totalPrice_{{$project->id}}" class="ppaDetailsInput" name="totalPrice" value="{{$projectClientS->contract->ppaTotalPrice()}}" >
                                        @else
                                            $ <input type="number"  name="totalPrice" id="totalPrice_{{$project->id}}" class="ppaDetailsInput"  value="" >
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Contract Type</h5>
                                        <p class="pProjectInfo">
                                            <input type="checkbox" name="typeUT" id="typeUT_{{$project->id}}" class="checkType" data-val="UT"
                                            @if($projectClientS->hasType("UT"))
                                                   checked="checked"
                                                    @endif
                                                    >
                                            <span class="checkSpan">UT</span>
                                            <input type="checkbox" name="typeUPG_UT" id="typeUPG_UT_{{$project->id}}" class="checkType" data-val="UPG_UT"
                                            @if($projectClientS->hasType("UPG_UT"))
                                                   checked="checked"
                                                    @endif
                                                    >
                                            <span class="checkSpan">UPG UT</span>
                                            <input type="checkbox" name="typeCR" id="typeCR_{{$project->id}}" class="checkType" data-val="CR"
                                            @if($projectClientS->hasType("CR"))
                                                   checked="checked"
                                                    @endif
                                                    >
                                            <span class="checkSpan">CR</span>
                                            <input type="checkbox" name="typeEPO" id="typeEPO_{{$project->id}}" class="checkType" data-val="EPO"
                                            @if($projectClientS->hasType("EPO"))
                                                   checked="checked"
                                                    @endif
                                                    >
                                            <span class="checkSpan">EPO</span>
                                            <input type="checkbox" name="typePCT" id="typePCT_{{$project->id}}" class="checkType" data-val="PCT"
                                            @if($projectClientS->hasType("PCT"))
                                                   checked="checked"
                                                    @endif
                                                    >
                                            <span class="checkSpan">PCT</span>
                                            <input type="checkbox" name="typeD" id="typeD_{{$project->id}}" class="checkDesign"  data-val="D"  {{--class="checkType"--}}
                                            @if($projectClientS->hasType("D"))
                                                   checked="checked"
                                                    @endif
                                                    >
                                            <span class="checkSpan">D</span>
                                            <br>
                                            <input type="checkbox" name="typeTM" id="typeTM_{{$project->id}}" class="checkType" data-val="TM"
                                            @if($projectClientS->hasType("TM"))
                                                   checked="checked"
                                                    @endif
                                                    >
                                            <span class="checkSpan">TM</span>
                                            <input type="checkbox" name="typePROV" id="typePROV_{{$project->id}}" class="checkType" data-val="PROV"
                                            @if($projectClientS->hasType("PROV"))
                                                   checked="checked"
                                                    @endif
                                                    >
                                            <span class="checkSpan">PROV</span>

                                            <input type="checkbox" style="margin-left: 50px;" name="mailOnly" id="mailOnly_{{$project->id}}" class="checkMailOnly"
                                            @if($projectClientS->mailOnly)
                                                   checked="checked"
                                                    @endif
                                                    >
                                            <span class="checkSpan">Mail Only</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Total Amount Paid:</h5>
                                        @if($projectClientS->contract!=null)
                                            $ <input type="number" name="amntPaid" id="amntPaid_{{$project->id}}" class="ppaDetailsInput"  value="{{$projectClientS->contract->paid}}" >
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Received  Date:</h5>
                                        <input type="text" id="recvdDate_{{$project->id}}" name="ppaRcvdDate" class="ppaDetailsDate pickDate"
                                            @if($projectClientS->ppaRcvdDate!='0000-00-00 00:00:00')
                                               value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->ppaRcvdDate)))}}"
                                               @else
                                                value="N/A"
                                                @endif
                                                >
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Balance Due:</h5>
                                        <p style=" padding: 10px;font-size: 10px;text-align: justify;background: white;border-radius: 5px;" id="balanceDue_{{$project->id}}">
                                            @if($projectClientS->contract!=null && $projectClientS->contract->ppaTotalPrice() > 0)
                                            {{money_format('%=#10.2n',($projectClientS->contract->ppaTotalPrice())-
                                            ($projectClientS->contract->paid))}}
                                            @else
                                            N/A
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Contract Start Date:</h5>
                                        <input type="text" id="contractStarDate_{{$project->id}}" name="rcvdDate" class="ppaDetailsDate pickDate"
                                        @if($projectClientS->rcvdDate!='0000-00-00 00:00:00')
                                               value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->rcvdDate)))}}"
                                               @else
                                               value="N/A"
                                                @endif
                                                >
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Percentage Paid:</h5>
                                        <p class="pProjectInfo" id="percentPaid_{{$project->id}}">
                                            @if($projectClientS->contract!=null && $projectClientS->contract->ppaTotalPrice()>0)
                                                {{floor(($projectClientS->contract->paid)/($projectClientS->contract->ppaTotalPrice())*100).'%'}}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>PPA Contract End Date:</h5>
                                        <p class="pProjectInfo" id="contractEndDate_{{$project->id}}">
                                            @if($projectClientS->rcvdDate != '0000-00-00 00:00:00' && $projectClientS->hasType('PROV') && !$projectClientS->hasType('UPG_UT'))
                                                {{date('m-d-Y h:i:s', strtotime('+1 year -1 day', strtotime($projectClientS->rcvdDate)))}}
                                            @elseif($projectClientS->agreementExt_rcvd!='0000-00-00 00:00:00' && $projectClientS->rcvdDate != '0000-00-00 00:00:00')
                                                {{date('m-d-Y h:i:s', strtotime('+3 year -1 day', strtotime($projectClientS->rcvdDate)))}}
                                            @elseif($projectClientS->rcvdDate != '0000-00-00 00:00:00')
                                                {{date('m-d-Y h:i:s', strtotime('+2 year -1 day', strtotime($projectClientS->rcvdDate)))}}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapseDocs_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Initial Documents (PSA, DDR, TDQ, CRQ):</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseDocs_{{$project->id}}" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-10"></div>
                                        <div class="col-md-2">
                                            <h5 id="sendback_label_{{$project->id}}" style="display: none">Send Back</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>PSA,DDR and Signed PPA Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="ppaSent" id="ppaSent_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="ppaSent_created_at" data-p="ppaSentDate_{{$project->id}}"
                                            @if($projectClientS->ppaSent_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>PSA,DDR and Signed PPA Sent Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="ppaSent_created_at" id="ppaSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->ppaSent_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->ppaSent_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                        @if(($file=$projectClientS->getDocsByName('agreementPSA'))!=null && $projectClientS->ddrReceived_created_at=="" && $file->signdate!="")
                                            <div class="col-md-1">
                                                <button id="returnPSA_{{$project->id}}" data-id="{{$file->file_id}}"  data-filename="{{$file->name}}"
                                                        class="btn btn-danger resendFile" style="font-size:65%;" aria-hidden="true"
                                                @if($file->file_id==-1)
                                                        disabled="true"
                                                        @endif> PSA</button>
                                            </div>
                                        @endif
                                        @if(($file=$projectClientS->getDocsByName('ddr'))!=null && $projectClientS->ddrReceived_created_at=="" && $file->signdate!="")
                                            <div class="col-md-1">
                                                <button id="returnDDR_{{$project->id}}" class="btn btn-danger resendFile"  data-filename="{{$file->name}}"
                                                        data-id="{{$file->file_id}}"  style="font-size:65%;" aria-hidden="true"
                                                @if($file->file_id==-1)
                                                        disabled="true"
                                                        @endif> DDR</button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>PSA & DDR Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="ddrSent" id="ddrSent_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="ddrReceived_created_at" data-p="ddrSentDate_{{$project->id}}"
                                            @if($projectClientS->ddrReceived_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>PSA & DDR  Received Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="ddrReceived_created_at" id="ddrSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->ddrReceived_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->ddrReceived_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>CopyRight Questionnaire Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="copyrightSent" id="copyrightSent_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="copyrightSent_created_at" data-p="copyrightSentDate_{{$project->id}}"
                                            @if($projectClientS->copyrightSent_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>CopyRight Questionnaire Sent Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="copyrightSent_created_at" id="copyrightSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->copyrightSent_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->copyrightSent_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                        @if(($file=$projectClientS->getDocsByName('copyrightQuestionnaire'))!=null && $projectClientS->copyrightReceived_created_at=="" && $file->signdate!="")
                                            <div class="col-md-1">
                                                <button id="returnCOPYRIGHT_{{$project->id}}" data-id="{{$file->file_id}}"  data-filename="{{$file->name}}"
                                                        class="btn btn-danger resendFile" style="font-size:65%;" aria-hidden="true"
                                                @if($file->file_id==-1)
                                                        disabled="true"
                                                        @endif> COPYRIGHT</button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>Trademark Questionnaire Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="trademarkSent" id="trademarkSent_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="trademarkSent_created_at" data-p="trademarkSentDate_{{$project->id}}"
                                            @if($projectClientS->trademarkSent_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>Trademark Questionnaire Sent Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="trademarkSent_created_at" id="trademarkSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->trademarkSent_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->trademarkSent_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                        @if(($file=$projectClientS->getDocsByName('trademark'))!=null && $projectClientS->trademarkReceived_created_at=="" && $file->signdate!="")
                                            <div class="col-md-1">
                                                <button id="returnTRADEMARK_{{$project->id}}" class="btn btn-danger resendFile" data-filename="{{$file->name}}"
                                                        data-id="{{$file->file_id}}" style="font-size:65%;" aria-hidden="true"
                                                @if($file->file_id==-1)
                                                        disabled="true"
                                                        @endif> TRADEMARK</button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>CopyRight Questionnaire Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="copyrightReceived" id="copyrightReceived_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="copyrightReceived_created_at" data-p="copyrightReceivedDate_{{$project->id}}"
                                            @if($projectClientS->copyrightReceived_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>CopyRight Questionnaire Received Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="copyrightReceived_created_at" id="copyrightReceivedDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->copyrightReceived_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->copyrightReceived_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <p>Trademark Questionnaire Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="trademarkReceived" id="trademarkReceived_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="trademarkReceived_created_at" data-p="trademarkReceivedDate_{{$project->id}}"
                                            @if($projectClientS->trademarkReceived_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-4">
                                            <p>Trademark Questionnaire Received Date: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="trademarkReceived_created_at" id="trademarkReceivedDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->trademarkReceived_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->trademarkReceived_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapseAttorney_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Documents to Attorney:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseAttorney_{{$project->id}}" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Document Package Sent to Attorney</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="documentSent" id="documentSent_{{$project->id}}" class="doc_sent_att"
                                                   data-prop="documentSent_created_at" data-p="documentSentDate_{{$project->id}}"
                                            @if($projectClientS->documentSent_created_at!="")
                                                   checked="checked"
                                                   disabled
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Date Document Package Sent to Attorney</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="documentSent_created_at" id="documentSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->documentSent_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->documentSent_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Upgrade Sent to Attorney</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="upgradeSent" id="upgradeSent_{{$project->id}}"
                                            @if($projectClientS->docUpgSent_created_at!="0000-00-00 00:00:00")
                                                   checked="checked"
                                                    @endif
                                                    disabled
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Date Upgrade Sent to Attorney</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="docUpgSent_created_at"  id="upgradeSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->docUpgSent_created_at!='0000-00-00 00:00:00')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->docUpgSent_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapseClient_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Welcome Client:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseClient_{{$project->id}}" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Welcome Email Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="emailSent" id="emailSent_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="emailSent_created_at" data-p="emailSentDate_{{$project->id}}"
                                            @if($projectClientS->emailSent_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Welcome Email Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="emailSent_created_at" id="emailSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->emailSent_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->emailSent_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Welcome Email Follow-up Call</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="emailCall" id="emailCall_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="emailCall_created_at" data-p="emailCallDate_{{$project->id}}"
                                            @if($projectClientS->emailCall_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Welcome Email Follow-up Call Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="emailCall_created_at" id="emailCallDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->emailCall_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->emailCall_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapsePatentApp_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Patent Application:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapsePatentApp_{{$project->id}}" class="collapse">
                                    @if($projectClientS->appSent_created_at!="" && $projectClientS->patentAppApproved_created_at!='')
                                        <div class="col-md-12" >
                                            <div class="col-md-4">
                                                <button class="btn btn-danger resendAPP" id="reSendPatentAPP_{{$project->id}}"
                                                    @if($projectClientS->hasType('PROV') && !$projectClientS->hasType('UPG_UT'))
                                                        data-type="PROV"
                                                        @else
                                                        data-type="PA"
                                                        @endif>
                                                    Resend App
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Title of Invention</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" data-prop="titleofinvention" id="titleOfInv_{{$project->id}}" class="titleInv" style="width: 100% !important;" value="{{$projectClientS->titleofinvention}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent Application Sent to Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="pApplicationSent" id="pApplicationSent_{{$project->id}}" class="patentAppSent"
                                                   data-prop="appSent_created_at"  data-p="pApplicationDate_{{$project->id}}"
                                            @if($projectClientS->appSent_created_at!="")
                                                   checked="checked"
                                                    @endif
                                            @if($projectClientS->hasType('PROV') && !$projectClientS->hasType('UPG_UT'))
                                                   data-type="PROV"
                                                   @else
                                                   data-type="PA"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent Application Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="appSent_created_at" id="pApplicationDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->appSent_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->appSent_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>POA and DEC Docs Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="poaDecSent" id="poaDecSent_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="poaDec_created_at" data-p="poaDecDate_{{$project->id}}" disabled="disabled"
                                            @if($projectClientS->poaDec_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>POA and DEC Docs Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="poaDec_created_at" id="poaDecDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->poaDec_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->poaDec_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App Followup with Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appFollowUpSent" id="appFollowUpSent_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="appFollowUp_created_at" data-p="appFollowUpDate_{{$project->id}}"
                                            @if($projectClientS->appFollowUp_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent App Followup with Inventor Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="appFollowUp_created_at" id="appFollowUpDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->appFollowUp_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->appFollowUp_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapseProv_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Provisional Or Utility App Approval by Inventor:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseProv_{{$project->id}}" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent Application Type:</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="ppa_type_{{$project->id}}" data-type="{{$project->utility=="U_D"?"Utility & Design":$project->utility}}">
                                                @if($projectClientS->hasType("PROV") && !$projectClientS->hasType("UPG_UT"))
                                                    Provisional
                                                @else
                                                    {{$project->utility=="U_D"?"Utility & Design":"Utility"}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>POA and DEC Docs Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="poaDecReceived" id="poaDecReceived_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="poaDecReceived_created_at" data-p="poaDecReceivedDate_{{$project->id}}"
                                            @if($projectClientS->poaDecReceived_created_at!="")
                                                   checked="checked"
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>POA and DEC Docs Received Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="poaDecReceived_created_at" id="poaDecReceivedDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->poaDecReceived_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->poaDecReceived_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>

                                    {{--insert new check--}}

                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App pending revisions</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appPendingRevision" data-prop="apppendingrevision" id="appPendingRevision_{{$project->id}}" class="appPendingRevision"
                                            @if($projectClientS->apppendingrevision!=0)
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                    </div>

                                    {{--end of insert new check--}}

                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App Approved by Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appApproved" id="appApproved_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="patentAppApproved_created_at" data-p="appApprovedDate_{{$project->id}}"
                                            @if($projectClientS->patentAppApproved_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent App Approval Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="patentAppApproved_created_at" id="appApprovedDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->patentAppApproved_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->patentAppApproved_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapsePatentAppD_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Patent Application (Design):</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapsePatentAppD_{{$project->id}}" class="collapse">
                                    @if($projectClientS->appSentD_created_at!="0000-00-00 00:00:00" && $projectClientS->patentAppApprovedD_created_at!="0000-00-00 00:00:00")
                                        <div class="col-md-12" style="margin-bottom: 15px !important;">
                                            <div class="col-md-4">
                                                <button class="btn btn-danger resendAPP" id="reSendPatentAPP_{{$project->id}}" data-type="DESIGN">
                                                    Resend App
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Title of Invention</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" data-prop="titleofinventionD" id="titleOfInvD_{{$project->id}}" class="titleInv" style="width: 100% !important;" value="{{$projectClientS->titleofinventionD}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent Application Sent to Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="pApplicationSentD" id="pApplicationSentD_{{$project->id}}" class="patentAppSent"
                                                   data-prop="appSentD_created_at" data-type="DESIGN" data-p="pApplicationDateD_{{$project->id}}"
                                            @if($projectClientS->appSentD_created_at!="0000-00-00 00:00:00")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent Application Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="appSentD_created_at" id="pApplicationDateD_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->appSentD_created_at!='0000-00-00 00:00:00')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->appSentD_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>POA and DEC (Desing) Docs Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="poaDecSentD" id="poaDecSentD_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="poaDecSentD_created_at" data-p="poaDecDateD_{{$project->id}}" disabled="disabled"
                                            @if($projectClientS->poaDecSentD_created_at!="0000-00-00 00:00:00")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>POA and DEC Docs Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="poaDecSentD_created_at" id="poaDecDateD_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->poaDecSentD_created_at!='0000-00-00 00:00:00')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->poaDecSentD_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>POA and DEC Docs Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="poaDecReceivedD" id="poaDecReceivedD_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="poaDecRcvdD_created_at" data-p="poaDecReceivedDateD_{{$project->id}}"
                                            @if($projectClientS->poaDecRcvdD_created_at!="0000-00-00 00:00:00")
                                                   checked="checked"
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>POA and DEC Docs Received Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="poaDecRcvdD_created_at" id="poaDecReceivedDateD_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->poaDecRcvdD_created_at!='0000-00-00 00:00:00')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->poaDecRcvdD_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App pending revisions</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appPendingRevision" data-prop="apppendingrevisionD" id="appPendingRevisionD_{{$project->id}}" class="appPendingRevision"
                                            @if($projectClientS->apppendingrevisionD!=0)
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Patent App (Design) Approved by Inventor</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="appApproved" id="appApprovedD_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="patentAppApprovedD_created_at" data-p="appApprovedDateD_{{$project->id}}"
                                            @if($projectClientS->patentAppApprovedD_created_at!="0000-00-00 00:00:00")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Patent App Approval Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="patentAppApprovedD_created_at" id="appApprovedDateD_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->patentAppApprovedD_created_at!='0000-00-00 00:00:00')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->patentAppApprovedD_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapsePatenProc_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Patent Application Process:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapsePatenProc_{{$project->id}}" class="collapse">
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App Invoice #</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="patentAppInvoice_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="patentAppInvoiceNo" data-prop2="patentInvoiceSentDate"
                                                       data-p="patentInvoiceSentDate_{{$project->id}}"
                                                       value="@if($projectClientS->patentAppInvoiceNo!=0){{$projectClientS->patentAppInvoiceNo}}@endif">
                                            </div>
                                            <div class="col-md-4">
                                                <p>Patent Invoice Sent Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="patentInvoiceSentDate" id="patentInvoiceSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->patentInvoiceSentDate!='')
                                                       value="{{date('m-d-Y ',strtotime(str_replace('-','/',$projectClientS->patentInvoiceSentDate)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App Check #</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="patentAppCheck_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="patentAppCheckNo" data-prop2="-"
                                                       value="@if($projectClientS->patentAppCheckNo!=""){{$projectClientS->patentAppCheckNo}}@endif">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App filed by Attorney</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="PatentAppFiled_{{$project->id}}"  class="checkPatenApp"
                                                       data-prop="patentAppFiled_created_at" data-p="patentAppFilingDate_{{$project->id}}"
                                                @if($projectClientS->patentAppFiled_created_at!="0000-00-00 00:00:00")
                                                       checked="checked"
                                                        @endif>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Patent App Filing Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="patentAppFiled_created_at" id="patentAppFilingDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->patentAppFiled_created_at!="0000-00-00 00:00:00")
                                                       value="{{date('m-d-Y',strtotime(str_replace('-','/',$projectClientS->patentAppFiled_created_at)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="patentAppNumber_{{$project->id}}" class="patentAppText inputAppNo"
                                                       data-prop="patentAppNo" data-prop2="-"
                                                       value="@if($projectClientS->patentAppNo!=0){{$projectClientS->patentAppNo}}@endif">
                                            </div>
                                            <div class="col-md-4">
                                                <p>Patent App Type</p>
                                            </div>
                                            <div class="col-md-2">
                                                <select id="selectPatentType_{{$project->id}}" class="selectPatentType">
                                                    <option value="" >---</option>
                                                    <option value="UT" @if($projectClientS->patentType == 'UT') selected @endif>UT</option>
                                                    <option value="UT(UPG)" @if($projectClientS->patentType == 'UT(UPG)') selected @endif>UT(UPG)</option>
                                                    <option value="PROV" @if($projectClientS->patentType == 'PROV') selected @endif>PROV</option>
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
                                                <input type="checkbox" id="copyrightFil_{{$project->id}}" class="checkPatenApp"
                                                       data-prop="copyrightFiled_created_at" data-p="copyRFilDate_{{$project->id}}"
                                                @if($projectClientS->copyrightFiled_created_at!="")
                                                       checked="checked"
                                                        @endif>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Copyright Filing Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="copyrightFiled_created_at" id="copyRFilDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->copyrightFiled_created_at!="")
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->copyrightFiled_created_at)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Copyright Filing Attorney</p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select id="selectAttorneyCopyR_{{$project->id}}" class="selectAttorney" data-prop="copyrightAtt">
                                                        <option value="-1">---</option>
                                                        @foreach($attorneys as $attorney)
                                                            <option value="{{$attorney->id}}"
                                                            @if($attorney->id==$projectClientS->copyrightAtt)
                                                                    selected
                                                                    @endif
                                                                    >{{$attorney->usr}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Copyright Application Number</p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="copyRightAppNumber_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="copyrightAppNumber" data-prop2="-"
                                                       @if($projectClientS->copyrightAppNumber != '') value="{{$projectClientS->copyrightAppNumber}}" @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>TradeMark filed</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="trademarkFil_{{$project->id}}" class="checkPatenApp"
                                                       data-prop="trademarkFil_created_at" data-p="trademarkFilDate_{{$project->id}}"
                                                @if($projectClientS->trademarkFil_created_at!="")
                                                       checked="checked"
                                                        @endif>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Trademark Filed Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="trademarkFil_created_at" id="trademarkFilDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->trademarkFil_created_at!="")
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->trademarkFil_created_at)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Trademark Filing Attorney</p>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select id="selectAttorneyTrademark_{{$project->id}}" class="selectAttorney" data-prop="trademarkAtt">
                                                        <option value="-1">---</option>
                                                        @foreach($attorneys as $attorney)
                                                            <option value="{{$attorney->id}}"
                                                            @if($attorney->id==$projectClientS->trademarkAtt)
                                                                    selected
                                                                    @endif
                                                                    >{{$attorney->usr}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Trademark Application Number</p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="trademarkAppNumber_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="trademarkAppNo" data-prop2="-"
                                                       value="@if($projectClientS->trademarkAppNo!=0){{$projectClientS->trademarkAppNo}}@endif">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>EPO Filed</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="checkEPO_{{$project->id}}" class="checkPatenApp"
                                                       data-prop="epoFil_created_at" data-p="epoFilDate_{{$project->id}}"
                                                @if($projectClientS->epoFil_created_at!="")
                                                       checked="checked"
                                                        @endif>
                                            </div>
                                            <div class="col-md-4">
                                                <p>EPO File Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="epoFil_created_at" id="epoFilDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->epoFil_created_at!="")
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->epoFil_created_at)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>EPO Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="epoNumber_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="epoNumber" data-prop2="-"
                                                       value="@if($projectClientS->epoNumber!=0){{$projectClientS->epoNumber}}@endif">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT PSA Sent</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="pctPSASent" id="pctPSASent_{{$project->id}}" class="checkPatenApp"
                                                       data-prop="pctPsaSent_create_at" data-p="pctPSASentDate_{{$project->id}}"
                                                @if($projectClientS->pctPsaSent_create_at!="0000-00-00 00:00:00")
                                                       checked="checked"
                                                        @endif
                                                        >
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT PSA Sent Date: </p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctPsaSent_create_at" id="pctPSASentDate_{{$project->id}}" class="patentAppText editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->pctPsaSent_create_at!='0000-00-00 00:00:00')
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctPsaSent_create_at)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT PSA Received</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="pctPSARcvd" id="pctPSARcvd_{{$project->id}}" class="checkPatenApp"
                                                       data-prop="pctPsaRcvd_create_at" data-p="pctPSARcvdDate_{{$project->id}}"
                                                @if($projectClientS->pctPsaRcvd_create_at!="0000-00-00 00:00:00")
                                                       checked="checked"
                                                        @endif
                                                        >
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT PSA Received Date: </p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctPsaRcvd_create_at" id="pctPSARcvdDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->pctPsaRcvd_create_at!='0000-00-00 00:00:00')
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctPsaRcvd_create_at)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT Questionnaire Sent</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctQuestSent" id="pctQuestSent_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->pctQuestSent!="0000-00-00 00:00:00")
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctQuestSent)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT Questionnaire Received</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="checkPCTQuestRcvd_{{$project->id}}" class="checkPatenApp"
                                                       data-prop="pctQuestReceived" data-p="pctQuestReceived_{{$project->id}}"
                                                @if($projectClientS->pctQuestReceived!="0000-00-00 00:00:00")
                                                       checked="checked"
                                                        @endif>
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT Quest Rcvd Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctQuestReceived" id="pctQuestReceived_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->pctQuestReceived!="0000-00-00 00:00:00")
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctQuestReceived)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT Filed</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="checkPCTFiled_{{$project->id}}" class="checkPatenApp"
                                                       data-prop="pctFil_created_at" data-p="pctFiDate_{{$project->id}}"
                                                @if($projectClientS->pctFil_created_at!="")
                                                       checked="checked"
                                                        @endif>
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT File Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="pctFil_created_at" id="pctFiDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->pctFil_created_at!="")
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->pctFil_created_at)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>PCT Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="pctNumber_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="pctNumber" data-prop2="-"
                                                       value="@if($projectClientS->pctNumber!=""){{$projectClientS->pctNumber}}@endif">
                                            </div>
                                            <div class="col-md-4">
                                                <p>PCT Case Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="pctCaseNumber_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="pctCaseNumber" data-prop2="-"
                                                       value="@if($projectClientS->pctCaseNumber!=""){{$projectClientS->pctCaseNumber}}@endif">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4"><p>PCT Invoice Received Date</p></div>
                                            <div class="col-md-2">
                                                <input type="text" id="pctInvSentDate_{{$project->id}}" style="width: 100% !important;" class="patentAppText saveDataInput pickDate"
                                                       data-prop="pctInvoiceRecvdDate"
                                                @if($projectClientS->pctInvoiceRecvdDate!="0000-00-00 00:00:00")
                                                       value="{{date('m-d-Y',strtotime(str_replace('-','/',$projectClientS->pctInvoiceRecvdDate)))}}"
                                                       @else
                                                       value="Select Date"
                                                        @endif>
                                                <i class="fa fa-floppy-o saveDate" aria-hidden="true" id="savePctInvSentDate_{{$project->id}}" data-date="pctInvRecvdDate_{{$project->id}}"></i>
                                            </div>
                                            <div class="col-md-4"><p>PCT Invoice Paid Date</p></div>
                                            <div class="col-md-2">
                                                <input type="text" id="pctInvPaidDate_{{$project->id}}" style="width: 100% !important;" class="patentAppText saveDataInput pickDate"
                                                       data-prop="pctInvoicePaidDate"
                                                @if($projectClientS->pctInvoicePaidDate != "0000-00-00 00:00:00")
                                                       value="{{date('m-d-Y',strtotime(str_replace('-','/',$projectClientS->pctInvoicePaidDate)))}}"
                                                       @else
                                                       value="Select Date"
                                                        @endif>
                                                <i class="fa fa-floppy-o saveDate" aria-hidden="true" id="savePctInvPaidDate_{{$project->id}}" data-date="pctInvPaidDate_{{$project->id}}"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 vendorBox">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Design Invoice #</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="designInvoice_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="designInvoiceNo" data-prop2="designInvoiceSentDate"
                                                       data-p="designInvSentDate_{{$project->id}}"
                                                       value="@if($projectClientS->designInvoiceNo!=0){{$projectClientS->designInvoiceNo}}@endif">
                                            </div>
                                            <div class="col-md-4">
                                                <p>Design Invoice Sent Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="designInvSentDate_{{$project->id}}" class="patentAppText editDate pickDate" style="width: 100% !important;"
                                                       data-prop="designInvoiceSentDate"
                                                @if($projectClientS->designInvoiceSentDate!="0000-00-00 00:00:00")
                                                       value="{{date('m-d-Y',strtotime(str_replace('-','/',$projectClientS->designInvoiceSentDate)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Design Check #</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="designCheck_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="designCheckNo" data-prop2="-"
                                                       value="@if($projectClientS->designCheckNo!=0){{$projectClientS->designCheckNo}}@endif">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Design Filed</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="checkDesign_{{$project->id}}" class="checkPatenApp"
                                                       data-prop="designFil_created_at" data-p="designDate_{{$project->id}}"
                                                @if($projectClientS->designFil_created_at!="")
                                                       checked="checked"
                                                        @endif>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Design File Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="designFil_created_at" id="designDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->designFil_created_at!="")
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->designFil_created_at)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Design Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="designNumber_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="designNumber" data-prop2="-"
                                                       value="@if($projectClientS->designNumber!=0){{$projectClientS->designNumber}}@endif">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <p>3D Model Design sent to ILC Date:</p>
                                            </div>
                                            <div class="col-md-2 col-md-offset-4">
                                                <input type="text" data-prop="DModel_sent" id="DModel_sent{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->DModel_sent!="0000-00-00 00:00:00")
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->DModel_sent)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Granted Number</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="grantedNumber_{{$project->id}}" class="patentAppText inputPatenAppProc"
                                                       data-prop="grantedNumber" data-prop2="grantedDate"
                                                       data-p="grantedDate_{{$project->id}}"
                                                       value="@if($projectClientS->grantedNumber!=0){{$projectClientS->grantedNumber}}@endif">
                                            </div>
                                            <div class="col-md-4">
                                                <p>Granted Date</p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" data-prop="grantedDate" id="grantedDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                                @if($projectClientS->grantedDate!="")
                                                       value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->grantedDate)))}}"
                                                       @else
                                                       disabled="disabled"
                                                        @endif
                                                        >
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p>Patent App Upgrade Due</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p id="patentAppUp_{{$project->id}}">
                                                    {{$projectClientS->getUpgradeDue()}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapseILC_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">ILC Marketing Agreement:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseILC_{{$project->id}}" class="collapse">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Industry</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" data-prop="industry" id="industry_{{$project->id}}" class="industryInput" style="width: 100% !important;" value="{{$projectClientS->industry}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>ILC Marketing Agreement Pkg Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="marketingAgrSent" id="marketingAgrSent_{{$project->id}}" class="checkILCAgreementSent"
                                                   data-prop="marketingAgrSent_created_at" data-p="marketingAgrSentDate_{{$project->id}}"
                                            @if($projectClientS->marketingAgrSent_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>ILC Marketing Agreement Pkg Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="marketingAgrSent_created_at" id="marketingAgrSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->marketingAgrSent_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->marketingAgrSent_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>

                                    {{--new date send for ilc after upgrade to utility--}}
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>ILC Agreement After Upgrade Sent</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="checkILCAgreementSentAfterUpgrade" id="ILCAfterUpgrade_{{$project->id}}" class="checkILCAgreementSentAfterUpgrade"
                                            @if($projectClientS->marketingAgrSentAfterUpgrade_created_at!="")
                                                   checked="checked"
                                            @endif
                                            @if($projectClientS->marketingAgrSent_created_at =='')
                                                   disabled="disabled"
                                            @endif
                                            >
                                        </div>
                                        <div class="col-md-5">
                                            <p>ILC Agreement After Upgrade Sent Date</p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" id="ILCAfterUpgradeSentDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->marketingAgrSentAfterUpgrade_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->marketingAgrSentAfterUpgrade_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    {{--END OF new date send for ilc after upgrade to utility--}}

                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>ILC Marketing Agreement Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="marketingAgrReceived" id="marketingAgrReceived_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="marketingAgrReceived_created_at" data-p="marketingAgrReceivedDate_{{$project->id}}"
                                            @if($projectClientS->marketingAgrReceived_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>ILC Marketing Agreement Received Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="marketingAgrReceived_created_at" id="marketingAgrReceivedDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->marketingAgrReceived_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->marketingAgrReceived_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <p>Release Form Received</p>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="releaseFormReceived" id="releaseFormReceived_{{$project->id}}" class="checkPatenApp"
                                                   data-prop="releaseFormReceived_created_at" data-p="releaseFormReceivedDate_{{$project->id}}"
                                            @if($projectClientS->releaseFormReceived_created_at!="")
                                                   checked="checked"
                                                    @endif
                                                    >
                                        </div>
                                        <div class="col-md-5">
                                            <p>Release Form Received Date
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" data-prop="releaseFormReceived_created_at" id="releaseFormReceivedDate_{{$project->id}}" class="editDate pickDate" style="width: 100% !important;"
                                            @if($projectClientS->releaseFormReceived_created_at!='')
                                                   value="{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectClientS->releaseFormReceived_created_at)))}}"
                                                   @else
                                                   disabled="disabled"
                                                    @endif
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading col-md-12">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#" class="actionQuestions col-md-10">
                                        <i>
                                            <h4 class="panel-title">Notes:</h4>
                                        </i>
                                    </a>
                                    <i class="fa fa-plus col-md-2 addNotesCs" style="border: 1px solid black;padding-right: 5px;padding-left: 5px;" aria-hidden="true"> NEW NOTE</i>
                                </div>
                                <div id="collapseNotes_{{$projectClientS->id}}">
                                    <div class="col-md-12" id="insideCollapseNotes_{{$projectClientS->id}}" style="overflow-y: scroll;min-height: 100px;max-height: 150px;">
                                        @foreach ($projectClientS->csNotes() as $csNotes)
                                            <div class="noteLink col-md-12" id="divNote_{{$csNotes->id}}">
                                                <i title="Edit" class="fa fa-pencil-square-o col-md-1 editNotesCs" data-id="{{$csNotes->id}}" aria-hidden="true"></i>
                                                <p id="pNote_{{$csNotes->id}}" title="{{$csNotes->notes}}" class="col-md-6">{{strlen($csNotes->notes)>40?substr($csNotes->notes,0,37).'...':$csNotes->notes}}@if($csNotes->notes == 'Automatic Intro Call')<i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;" title="The client services department at Patent Services has contacted you to introduce the department as they will be servicing your patent moving forward. A client services representative is available to speak with you at your convenience during normal business hours, Monday – Friday, 8am-5pm est. If you need assistance or have questions about the patent process, please contact the client services department at 1-888-344-6836."></i>@endif</p>
                                                <p class="col-md-4 col-md-push-1">{{date('m-d-Y h:i a',strtotime(str_replace('-','/',$csNotes->created_at)))}}</p>
                                                <i title="Delete" class="fa fa-times col-md-1 deleteNotesCs" data-id="{{$csNotes->id}}" aria-hidden="true"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 vendorBox">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion_{{$project->id}}" href="#collapseLegalMaint_{{$project->id}}" class="actionQuestions">
                                        <i>
                                            <h4 class="panel-title">Legal Maintenance Activity:</h4>
                                        </i>
                                    </a>
                                </div>
                                <div id="collapseLegalMaint_{{$project->id}}" class="collapse container-legalMA">
                                    <div class="col-md-12 col-md-offset-3">
                                        <button class="btn btn-primary newLegalAct">New Legal Maintenance Activity</button>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 15px;">
                                        <table class="table table-bordered" cellspacing="0" style="width: 97% !important;">
                                            <thead id="tableDataHead_{{$project->id}}" style="background-color: #428bca;color:#ffffff;">
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
                                            <table id="tableLegalAct_{{$project->id}}" class="table table-bordered" cellspacing="0" width="100%"
                                            @if($projectClientS->hasLegalRecord())
                                                   data-existlegal ="1"
                                                   @else
                                                   data-existlegal ="0"
                                                    @endif>
                                                <tbody id="tableDataBodyLegal_{{$project->id}}"> {{--<i title="Delete" class="fa fa-times col-md-1 deleteLegalA" id="deleteLegalA_{{$legalAct->id}}" data-id="{{$legalAct->id}}" aria-hidden="true"></i>--}}
                                                @foreach($projectClientS->legalRecords() as $legalAct)
                                                    <tr id='legalAct_{{$legalAct->id}}'>
                                                        <th style="vertical-align: top;width: 3%;"><i title="Delete" class="fa fa-times deleteLegalA" data-id="{{$legalAct->id}}" aria-hidden="true"></i></th>
                                                        <th style="width: 14%;"><a class='edit-legal-Act' data-id="{{$legalAct->id}}">{{$legalAct->legal_record}}</a></th>
                                                        <th style="width: 18%;">{{$legalAct->record_type}}</th>
                                                        <th style="width: 18%;">{{$legalAct->activity}}</th>
                                                        <th style="width: 14%;">{{date("m/d/Y",strtotime($legalAct->activity_due_date))}}</th>
                                                        <th style="width: 14%;">{{date("m/d/Y",strtotime($legalAct->recv_date))}}</th>
                                                        <th style="width: 19%;"><p style='font-size: 11px;' title="{{$legalAct->description}}">{{strlen($legalAct->description)>24?substr($legalAct->description,0,24)." ...":$legalAct->description}}</p></th>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @if($processStarted == 0)
                            <div class="col-md-12">
                                <button type="button" class="createProjBuntton btn btn-primary" data-id="{{$project->id}}">CREATE LEGAL</button>
                            </div>
                        @elseif($processStarted == 1)
                            <h2> Process Started in Salesforce</h2>
                        @endif
                    @endif
                </div>

                <div class="tab-pane" id="portlet_tab_{{$project->id}}_4" role="tabpanel">
                    <h3><i class="fa fa-print fa-3 printBusiness" data-toggle="tooltip" data-placement="bottom" title="Print Submission" data-id = "{{$project->id}}" ></i></h3>
                    <div class="col-md-12">
                        <h5>Invention Name:</h5>
                        <p class="pProjectInfo">{{strlen($project->ideaName)>0?$project->ideaName:"N/A"}}</p>
                        <h5>Invention Short Description:</h5>
                        <p class="pProjectInfo">{{strlen($project->ideaConcept)>0?$project->ideaConcept:"N/A"}}</p>
                        <h5>Describe what makes your idea unique, how it looks/works:</h5>
                        <p class="pProjectInfo">{{strlen($project->ideaConcept)>0?$project->ideaConcept:"N/A"}}</p>
                        <h5>Give us the details of your product's function and parts. (How does it work, materials, etc.):</h5>
                        <p class="pProjectInfo">{{strlen($project->descIdea)>0?$project->descIdea:"N/A"}}</p>
                        <h5>Tell us when and how you thought of your invention:</h5>
                        <p class="pProjectInfo">{{strlen($project->hisIdea)>0?$project->hisIdea:"N/A"}}</p>
                        <h5>What similar product is on the market now?(Similar, but not the same):</h5>
                        <p class="pProjectInfo">{{strlen($project->similarProduct)>0?$project->similarProduct:"N/A"}}</p>
                        <h5>Why do you believe your idea is unique, different or better?:</h5>
                        <p class="pProjectInfo">{{strlen($project->uniIdea)>0?$project->uniIdea:"N/A"}}</p>
                        <h5>What Problem does your idea solve?What are the advantages and benefits of your idea's solution?:</h5>
                        <p class="pProjectInfo">{{strlen($project->propIdea)>0?$project->propIdea:"N/A"}}</p>
                        <div class="col-md-6">
                            <h5>How much will it cost to produce your idea?:</h5>
                            <p  class="pProjectInfo">{{strlen($project->costSpend)>0?$project->costSpend:"N/A"}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>How much will you sell it for?</h5>
                            <p  class="pProjectInfo">{{strlen($project->payIdea)>0?$project->payIdea:"N/A"}}</p>
                        </div>
                        <h5>What technical field(s) does your project fall into?:</h5>
                        <p class="pProjectInfo">{{strlen($project->techField)>0?$project->techField:"N/A"}}</p>
                        <h5>What companies, groups of people, products, processes or services could use your idea?:</h5>
                        <p class="pProjectInfo">{{strlen($project->targetMarket)>0?$project->targetMarket:"N/A"}}</p>
                        <h5>What upgrades or modifications can you suggest to improve functionality, packaging, appeal, versatility, mechanics or affordability to a manufacturer or end user?:</h5>
                        <p class="pProjectInfo">{{strlen($project->modifications)>0?$project->modifications:"N/A"}}</p>
                        <h5>Describe the environment (wet, dry, temperature, pressure, light, dark, etc.) in which your idea will function?:
                            If your idea is a "device", what does it consume or produce? And what powers it? (Manual, electricity, gasoline, sunlight, water power, batteries, etc.):</h5>
                        <p class="pProjectInfo">{{strlen($project->environment)>0?$project->environment:"N/A"}}</p>
                        <h5>Any additional comments or information you wish to volunteer about yourself (inventor), any co-inventors or the invention?:</h5>
                        <p class="pProjectInfo">{{strlen($project->addNotes)>0?$project->addNotes:"N/A"}}</p>
                    </div>
                    <div class="col-md-12">
                        <h4>Inventor Profile</h4>
                        <div class="col-md-4">
                            <h5>Profession:</h5>
                            <p class="pProjectInfo">{{strlen($project->lead->profession)>0?$project->lead->profession:"N/A"}}</p>
                        </div>
                        <div class="col-md-4">
                            <h5>College:</h5>
                            <p class="pProjectInfo">{{strlen($project->lead->college)>0?$project->lead->college:"N/A"}}</p>
                        </div>
                        <div class="col-md-4">
                            <h5>Degree:</h5>
                            <p class="pProjectInfo">{{strlen($project->lead->degree)>0?$project->lead->degree:"N/A"}}</p>
                        </div>
                        <div class="col-md-4">
                            <h5>Spouse Name:</h5>
                            <p class="pProjectInfo">{{strlen($project->lead->spouse)>0?$project->lead->spouse:"N/A"}}</p>
                        </div>
                        <div class="col-md-4">
                            <h5>Married:</h5>
                            <p class="pProjectInfo">{{strlen($project->lead->married)>0?$project->lead->married:"N/A"}}</p>
                        </div>
                        <div class="col-md-4">
                            <h5>Date of Birth:</h5>
                            <p class="pProjectInfo">
                                {{strlen($project->lead->birth)>0?date('m-d-Y h:i:s',strtotime(str_replace('-','/',$project->lead->birth))):"N/A"}}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Children:</h5>
                            <p class="pProjectInfo">{{strlen($project->lead->children)>0?$project->lead->children:"N/A"}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Hobby:</h5>
                            <p class="pProjectInfo">{{strlen($project->lead->hobby)>0?$project->lead->hobby:"N/A"}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
