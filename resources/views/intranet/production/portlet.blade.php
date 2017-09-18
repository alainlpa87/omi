<div class="portlet col-md-12 portlet-new" data-exists="0" data-stage="{{$projectp->sendDate=="0000-00-00 00:00:00"?"new":($projectp->completed==1?"completed":($projectp->completed==2?"returned":($projectp->completed==3?"overdue":"sent")))}}" id="container_{{$project->id}}"  style="height: 40px" data-id = "{{$project->id}}" data-production-id="{{$projectp->id}}" data-request-id="{{$project->id}}" data-lead-id="{{$project->lead->id}}">
    <div class="box call">
        <div class="portlet-title">
            <div class="indicator caption" style="z-index: 100" data-id="{{$project->id}}">
                &nbsp;<i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<span id="captionFullName_{{$project->id}}">{{$project->lead->lname.", ".$project->lead->fname}}</span> - {{$project->lead->fileno}}
                <i class="pull-left fa fa-chevron-down"  id="indicator_{{$project->id}}"></i>
                @if($project->contractIIG() != "")
                    @if($project->contractIIG()->paid >= 1179)
                    &nbsp;&nbsp;<span style="color: red;">This file needs a Press Release.</span>
                    @endif
                @endif
            </div>
        </div>
        <div class="portlet-body hide" id="portletBody_{{$project->id}}">
            <div class="tab-content col-md-12 portlet_tab_content_{{$project->id}}" style="display: none">
                <div class="tab-pane active" id="portlet_tab_{{$project->id}}_4" role="tabpanel">
                    <div class="col-md-5 pull-right" style="margin-top: 25px;">
                        @if((($projectp->completed==0) && $projectp->sendDate!="0000-00-00 00:00:00") || $projectp->completed==2)
                            <i class="fa fa-check-square fa-3 completeProject adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" data-fileno = "{{$project->lead->fileno}}" title="Complete Project" data-id = "{{$project->id}}" ></i>
                        @endif
                        @if($projectp->completed==0||$projectp->completed==1||$projectp->completed==2||$projectp->completed==4)
                            <i class="fa fa-thumbs-down fa-3 returnProject adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" data-fileno = "{{$project->lead->fileno}}" title="Return Project" data-id = "{{$project->id}}" ></i>
                        @endif
                        <i class="fa fa-print fa-3 printBusinessProduction adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Print" data-id = "{{$project->id}}" ></i>
                        <i class="fa fa-folder-open fa-3 openFilesProduction adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Open Files" data-id = "{{$project->id}}" ></i>
                       @if($projectp->completed==0 || $projectp->completed==1 || $projectp->completed==2)
                            <i class="fa fa-calendar fa-3 shippingDateSet adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Set Shipping Date" data-id = "{{$project->id}}" data-fileno = "{{$project->lead->fileno}}" ></i>
                            <i class="fa fa-thumbs-up fa-3 finishProject adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Finish Project" data-id = "{{$project->id}}" ></i>
                        @endif
                            <i class="fa fa-trash fa-3 refundFilesProduction adminIcons" data-toggle="tooltip" data-placement="bottom" title="Refund File" data-id = "{{$project->id}}" ></i>
                    </div>
                    @if($projectp->sendDate=="0000-00-00 00:00:00")
                        <div class="setDestiny col-md-2 pull-right" style="margin-top: 25px;" data-id = "{{$project->id}}"   data-fileno = "{{$project->lead->fileno}}">
                            <i class="fa fa-pencil-square-o fa-3 adminIcons" data-toggle="tooltip" data-placement="bottom" title="Set"></i>
                            <span><strong>SET</strong></span>
                        </div>
                        <div class="col-md-2 pull-right" style="margin-top: 25px;">
                            <span><input type="checkbox" class="excludeProjectInput" id="excludeProject_{{$project->id}}" >Exclude</span>&nbsp;
                        </div>
                    @endif
                    @if($projectp->completed==2)
                        <div class="col-md-12">
                            <h5><strong>Project returned to: {{$projectp->returnedTo()}}</strong></h5>
                            <h5><strong>Reason: </strong></h5>
                            <p class="pProjectInfo">{{$projectp->returnedReasonTo()}}</p>
                        </div>
                    @endif
                    @if($projectp->completed==3)
                        <div class="col-md-12">
                            <h5><strong>Project overdue by: {{$projectp->overdueBy()}}</strong></h5>
                        </div>
                    @endif
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
                        <div class="col-md-6">
                            <h5>Is your idea software or an app?:</h5>
                            <p  class="pProjectInfo">{{$project->isApp == 1?"Yes":"No"}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Programming Language:</h5>
                            <p  class="pProjectInfo">{{$project->language!=''?ucwords($project->language):"N/A"}}</p>
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
                            <p class="pProjectInfo">{{strlen($project->lead->birth)>0?date('m-d-Y h:i:s',strtotime(str_replace('-','/',$project->lead->birth))):"N/A"}}</p>
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






                    <div class="col-md-12">
                        <h4>Inventor Information Correction</h4>
                        <div class="col-md-6">
                            <h5>Inventor Name:</h5>
                            <p class="pProjectInfo" id="pProjectInfoFullName_{{$project->id}}">{{strlen($project->lead->fname)>0?$project->lead->fname." ".$project->lead->lname:"N/A"}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Co-inventor Name:</h5>
                            <p class="pProjectInfo">{{strlen($project->coInventor)>0?$project->coInventor:"N/A"}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>Street:</h5>
                            <p class="pProjectInfo" id="pProjectInfoStreet_{{$project->id}}">{{strlen($project->lead->street)>0?$project->lead->street:"N/A"}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>City:</h5>
                            <p class="pProjectInfo" id="pProjectInfoCity_{{$project->id}}">{{strlen($project->lead->city)>0?$project->lead->city:"N/A"}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>State:</h5>
                            <p class="pProjectInfo" id="pProjectInfoState_{{$project->id}}">{{strlen($project->lead->state)>0?$project->lead->state:"N/A"}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>Zip:</h5>
                            <p class="pProjectInfo" id="pProjectInfoZip_{{$project->id}}">{{strlen($project->lead->zip)>0?$project->lead->zip:"N/A"}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Mobile:</h5>
                            <p class="pProjectInfo" id="pProjectInfoPhone_{{$project->id}}">{{strlen($project->lead->phone)>0?$project->lead->phone:"N/A"}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Home Phone:</h5>
                            <p class="pProjectInfo">{{strlen($project->lead->phone2)>0?$project->lead->phone2:"N/A"}}</p>
                        </div>
                        <div class="col-md-12">
                            <h5>Inventors:</h5>
                            <p class="pProjectInfo">{{strlen($project->coInventor)>0?$project->lead->fname." ".$project->lead->lname.",".$project->coInventor:$project->lead->fname." ".$project->lead->lname}}</p>
                        </div>

                        <div class="col-md-6">
                            <h5>Date Of Payment:</h5>
                            <p class="pProjectInfo">
                                @if($project->lastContractPaid() != '')
                                    {{$project->lastContractPaid()['DATE']}}
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Contract Type:</h5>
                            <p class="pProjectInfo">
                                @if($project->lastContractPaid() != '')
                                    {{$project->lastContractPaid()['TYPE']}}
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Consultant:</h5>
                            <p class="pProjectInfo">{{$project->consultant->usr}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>IMG Payment Date:</h5>
                            <p class="pProjectInfo">
                                @if($project->lastContractPaid() != '' && $project->contractIMG() != null)
                                    {{$project->lastContractPaid()['IMG']}}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table border="1">
                            <tbody>
                            <tr>
                                <td style="padding: 5px 5px 5px 5px;">
                                    @if($project->lastContractPaid() != '')
                                        {{explode (' ',$project->lastContractPaid()['DATE'])[0]}}
                                    @endif
                                </td>
                                <td style="padding: 5px 5px 5px 5px;">{{$project->lead->fileno}}</td>
                                <td style="padding: 5px 5px 5px 5px;">{{$project->lead->fname." ".$project->lead->lname}}</td>
                                <td style="padding: 5px 5px 5px 5px;">&nbsp;</td>
                                <td style="padding: 5px 5px 5px 5px;">
                                    @if($project->lastContractPaid() != '')
                                        {{$project->lastContractPaid()['TYPE']}}
                                    @endif
                                </td>
                                <td style="padding: 5px 5px 5px 5px;">{{$project->consultant->usr}}</td>
                                @if($projectp->contractType=="IGUP")
                                    <td style="padding: 5px 5px 5px 5px;">
                                        @if($project->contractIMG() != null)
                                            IMG Paid Date: {{explode (' ',$project->contractIMG()->paidDate)[0]}}
                                        @endif
                                    </td>
                                @endif
                                <td style="padding: 5px 5px 5px 5px;">
                                    @if($projectp->contractType=="IGUP" && $project->contractIGUP() != "")
                                        @if($project->contractIGUP()->paid == 200)
                                            SILVER
                                        @endif
                                        @if($project->contractIGUP()->paid == 300)
                                            GOLD
                                        @endif
                                        @if($project->contractIGUP()->paid >= 530)
                                            PLATINUM
                                        @endif
                                        @if($project->contractIGUP()->paid == 400)
                                            SILVER
                                        @endif
                                        @if($project->contractIGUP()->paid == 430)
                                            SILVER
                                        @endif
                                        @if($project->contractIGUP()->paid == 500)
                                            GOLD
                                        @endif
                                        @if($project->contractIGUP()->paid == 630)
                                            GOLD
                                        @endif
                                        @if($project->contractIGUP()->paid >= 730)
                                            PLATINUM
                                        @endif
                                        @if($project->contractIGUP()->paid >= 930)
                                            PLATINUM
                                        @endif
                                    @elseif($project->contractIIG() != "")
                                        @if($project->contractIIG()->paid == 649)
                                            SILVER
                                        @endif
                                        @if($project->contractIIG()->paid == 849)
                                            SILVER
                                        @endif
                                        @if($project->contractIIG()->paid == 879)
                                            SILVER
                                        @endif
                                        @if($project->contractIIG()->paid == 749)
                                            GOLD
                                        @endif
                                        @if($project->contractIIG()->paid == 949)
                                            GOLD
                                        @endif
                                        @if($project->contractIIG()->paid == 1079)
                                            GOLD
                                        @endif
                                        @if($project->contractIIG()->paid >= 979)
                                            PLATINUM
                                        @endif
                                        @if($project->contractIIG()->paid >= 1179)
                                            PLATINUM
                                        @endif
                                        @if($project->contractIIG()->paid >= 1379)
                                            PLATINUM
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>




                    <div class="col-md-12">
                        <h5>Vendors:</h5>
                        <p class="pProjectInfo">
                            Attorney: {{$projectp->attorney()?$projectp->attorney()->usr:"N/A"}}<br>
                            University: {{$projectp->university()?ucwords($projectp->university()->fname." ".$projectp->university()->lname):"N/A"}}<br>
                            Designer: {{$projectp->designer()?ucwords($projectp->designer()->fname." ".$projectp->designer()->lname):"N/A"}}<br>
                            Designer2D: {{$projectp->designer2d()?ucwords($projectp->designer2d()->fname." ".$projectp->designer()->designer2d):"N/A"}}<br>
                            Writer: {{$projectp->writer()?ucwords($projectp->writer()->fname." ".$projectp->writer()->lname):"N/A"}}<br>
                            Schedule Date: {{date("m-d-Y",strtotime($projectp->scheduleDate))}}<br>
                            Shipping Date: <span id="spanShipping_{{$project->id}}">{{($projectp->shippingDate == '0000-00-00 00:00:00'?'':date("m-d-Y",strtotime($projectp->shippingDate)))}}</span>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h5>Consultant notes:</h5>
                            <p class="pProjectInfo">{{$project->internalNotes}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="hiddenAttorney_{{$project->id}}" value="{{$projectp->attorney_id}}">
    <input type="hidden" id="hiddenWriter_{{$project->id}}" value="{{$projectp->writer_id}}">
    <input type="hidden" id="hiddenDesigner_{{$project->id}}" value="{{$projectp->designer_id}}">
    <input type="hidden" id="hiddenUniversity_{{$project->id}}" value="{{$projectp->university_id}}">
    <input type="hidden" id="hiddenLetter_{{$project->id}}" value="{{$projectp->letterofengagement}}">
    <input type="hidden" id="hiddenLetterDate_{{$project->id}}" value="{{$projectp->sent_letterofeng != '0000-00-00 00:00:00' ? date('d F Y',strtotime($projectp->sent_letterofeng)):""}}">
    <input type="hidden" id="hiddenScheduleDate_{{$project->id}}" value="{{date('d F Y',strtotime($projectp->scheduleDate))}} - 00:00 AM">
    <input type="hidden" id="hiddenShippingDate_{{$project->id}}" value="{{$projectp->shippingDate!="0000-00-00 00:00:00"?date('d F Y',strtotime($projectp->shippingDate))." - 00:00 AM":""}}">
    <input type="hidden" id="utility_{{$project->id}}" value="{{$project->utility}}">
</div>