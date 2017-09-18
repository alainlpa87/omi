<div class="portlet col-md-12 portlet-new" id="container_{{$projectN->id}}"  style="height: 40px" data-id = "{{$project->id}}" data-request-id="{{$project->id}}" data-lead-id="{{$project->lead->id}}" data-date-action="{{$project->actionDate}}">
    <div class="box call">
        <div class="portlet-title">
            <div class="indicator caption" style="z-index: 100;width: 93%;" data-id="{{$project->id}}" data-aid="{{$projectN->id}}">
                &nbsp;<i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<span id="captionFullName_{{$project->id}}">{{$project->lead->lname.", ".$project->lead->fname}}</span> - {{$project->lead->fileno}}&nbsp;&nbsp;&nbsp; -
                @if($projectN->type == 'UT')UTILITY @elseif($projectN->type == 'PROV')PROV @elseif($projectN->type == 'DESIGN')DESIGN @elseif($projectN->type == 'UPG_UT')Upgrade @elseif($projectN->type == 'CR')CR @elseif($projectN->type == 'TM')TM @endif
                <i class="pull-left fa fa-chevron-down"  id="indicator_{{$projectN->id}}"></i>
                @if($projectN->type == 'CR' || $projectN->type == 'TM')
                    <span id="dueDate_{{$project->id}}" class="pull-right">Day Sent: {{date('m-d-Y',strtotime($projectN->created_at))}} &nbsp;&nbsp;&nbsp;&nbsp; Due: {{date('m-d-Y',strtotime($projectN->created_at." +2 weeks"))}}</span>
                @elseif($projectN->completed != 2 && $projectN->completed != 3 && $projectN->completed !=4 && $projectN->type != 'UPG_UT')
                    <span id="dueDate_{{$project->id}}" class="pull-right">Day Sent: {{date('m-d-Y',strtotime($projectN->created_at))}} &nbsp;&nbsp;&nbsp;&nbsp; Due: {{date('m-d-Y',strtotime($projectN->created_at." +56 days"))}}</span>
                @elseif($projectN->completed != 2 && $projectN->completed != 3 && $projectN->completed !=4 && $projectN->type == 'UPG_UT')
                    <span id="dueDate_{{$project->id}}" class="pull-right">Day Sent: {{date('m-d-Y',strtotime($projectN->created_at))}} &nbsp;&nbsp;&nbsp;&nbsp; Due: {{date('m-d-Y',strtotime($projectN->dueDate))}}</span>
                @elseif($projectN->completed == 2)
                    <span id="dueDate_{{$project->id}}" class="pull-right">Day Sent: {{date('m-d-Y',strtotime($projectN->stateChangedDate))}} &nbsp;&nbsp;&nbsp;&nbsp; Due: {{date('m-d-Y',strtotime($projectN->stateChangedDate." +2 weeks"))}}</span>
                @elseif($projectN->completed == 3)
                    @if($projectN->beforeDue == 'normal')
                        <span id="pastDueDate_{{$project->id}}" class="pull-right">Days Past Due: {{ceil((strtotime(date('Y-m-d h:s:i')) - strtotime($projectN->created_at." +56 days"))/86400)}}</span>
                    @else
                        <span id="pastDueDate_{{$project->id}}" class="pull-right">Days Past Due: {{ceil((strtotime(date('Y-m-d h:s:i')) - strtotime($projectN->stateChangedDate))/86400)}}</span>
                    @endif
                @elseif($projectN->completed == 4)
                    <span id="dueDate_{{$project->id}}" class="pull-right">Day Sent: {{str_replace('/', '-', $projectN->projectclientservices->patentInvoiceSentDate)}} &nbsp;&nbsp;&nbsp;&nbsp; Invoice: {{$projectN->projectclientservices->patentAppInvoiceNo}}</span>
                @endif
            </div>
        </div>
        <div class="portlet-body hide" id="portletBody_{{$projectN->id}}">
            <div class="tab-content col-md-12 portlet_tab_content_{{$projectN->id}}" style="display: none">
                <div class="tab-pane active" id="portlet_tab_{{$project->id}}_4" role="tabpanel">
                    <div class="col-md-4 pull-right"  style="margin-top: 25px;">
                        @if($projectN->completed != 4 ){{--&& $search==0--}}
                            <i class="fa fa-check-circle-o fa-3 finishAttCS adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Upload and send back to Patent Services" data-id = "{{$project->id}}" data-aid="{{$projectN->id}}" data-command="NORMAL" ></i>
                            <i class="fa fa-print fa-3 printBusinessAttCS adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Print" data-id = "{{$project->id}}" data-aid="{{$projectN->id}}" ></i>
                        {{--@elseif($search == 1)--}}
                            {{--<i class="fa fa-check-circle-o fa-3 finishAttCS adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Upload and send back to Patent Services" data-id = "{{$project->id}}" data-aid="{{$projectN->id}}" data-command="SEARCH" ></i>--}}
                        @else
                            <i class="fa fa-check-circle-o fa-3 finishAttCS adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Upload and send back to Patent Services" data-id = "{{$project->id}}" data-aid="{{$projectN->id}}" data-command="APP" ></i>
                        @endif
                        <i class="fa fa-folder-open fa-3 openFilesAttCS adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Open Files" data-id = "{{$project->id}}" ></i>
                    </div>
                    <div class="col-md-12">
                        @if($projectN->completed==2)
                            <h5 style="font-weight: bold;color: rgb(157, 12, 12);">Return Reason:</h5>
                            <p class="pProjectInfo" style="background-color: bisque;">{{strlen($projectN->returnedReason)>0?$projectN->returnedReason:"N/A"}}</p>
                        @elseif($projectN->completed==3)
                            <h5 style="font-weight: bold;color: rgb(157, 12, 12);">Overdue Reason:</h5>
                            <p class="pProjectInfo" style="background-color: bisque;">{{strlen($projectN->overDueReason)>0?$projectN->overDueReason:"N/A"}}</p>
                        @endif
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
                        <div class="col-md-12">
                            <h5>Consultant notes:</h5>
                            <p class="pProjectInfo">{{$project->internalNotes}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>