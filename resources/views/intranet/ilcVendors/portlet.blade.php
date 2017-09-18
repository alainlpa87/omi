<div class="portlet col-md-12 portlet-new" id="container_{{$project->id}}" style="height: 40px;"  data-id = "{{$project->id}}" data-state="{{$projectV->state}}" data-iid="{{$projectV->id}}">
    <div class="box call">
        <div class="portlet-title">
            <div class="indicator caption"  style="z-index: 100" data-id="{{$project->id}}">
                <i style="font-size:15px;" class="fa fa-file-o"></i>&nbsp;<span id="captionFullName_{{$project->id}}">{{$project->lead->lname.", ".$project->lead->fname}}</span> - {{$project->lead->fileno}}
                <i class="pull-left fa fa-chevron-down"  id="indicator_{{$project->id}}"></i>
            </div>
        </div>
        <div class="portlet-body hide" id="portletBody_{{$project->id}}">
            <div class="col-md-12 portlet_tab_content_{{$project->id}}" style="display: none;margin-top: 40px !important;">
                <div class="tab-pane active" id="portlet_tab_{{$project->id}}_1" role="tabpanel">
                    <div class="col-md-12 boxProjectInfo">
                        <div class="col-md-3">
                            @if($projectV->created_at != '0000-00-00 00:00:00')
                                <p id="creation_p_{{$project->id}}">{{date('m-d-Y h:i:s',strtotime(str_replace('-','/',$projectV->created_at)))}}</p>
                            @else
                                <p id="creation_p_{{$project->id}}">{{$projectV->created_at}}</p>
                            @endif
                        </div>
                        <div class="col-md-4 col-md-push-4">
                            <i class="fa fa-folder-open fa-3 openFilesILCVendors adminIcons" data-toggle="tooltip" data-placement="bottom" title="Open Files" data-id = "{{$project->id}}" ></i>
                            <i class="fa fa-check-circle-o fa-3 uploadFilesILCVendors adminIcons pull-right" data-toggle="tooltip" data-placement="bottom" title="Upload Files and Finish" data-id = "{{$project->id}}" ></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <i><h4>Inventor Detail:</h4></i>
                        <div class="col-md-3">
                            <h5>Inventor First Name:</h5>
                            <p class="pProjectInfo" data-id="{{$project->id}}" id="pProjectInfoFirstName_{{$project->id}}">{{strlen($project->lead->fname)>0?$project->lead->fname:"N/A"}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>Inventor Last Name:</h5>
                            <p class="pProjectInfo" data-id="{{$project->id}}" id="pProjectInfoLastName_{{$project->id}}">{{strlen($project->lead->fname)>0?$project->lead->lname:"N/A"}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>Invention Name:</h5>
                            <p class="pProjectInfo" data-id="{{$project->id}}" id="pProjectInfoInventionName_{{$project->id}}">{{strlen($projectV->ilc->inventionName)>0?$projectV->ilc->inventionName:"N/A"}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>Design Type:</h5>
                            <p class="pProjectInfo" data-id="{{$project->id}}" id="pProjectInfoDesignType_{{$project->id}}">{{$projectV->dosD == 0 ?"3D":"2D"}}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Co-inventor Name:</h5>
                            <p class="pProjectInfo" data-id="{{$project->id}}" id="pProjectInfoCoInvName_{{$project->id}}" >{{strlen($project->coInventor)>0?$project->coInventor:"N/A"}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>File No:</h5>
                            <p class="pProjectInfo" data-id="{{$project->id}}" id="pProjectInfoLastName_{{$project->id}}" >{{strlen($project->lead->fileno)>0?$project->lead->fileno:"N/A"}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5>Pin: </h5>
                            <p class="pProjectInfo" data-id="{{$project->id}}" id="pProjectInfoLastName_{{$project->id}}">{{strlen($project->id)>0?$project->id:"N/A"}}</p>
                        </div>
                        <div class="col-md-12">
                            <h5>Text: </h5>
                            <p class="pProjectInfo" data-id="{{$project->id}}" id="pProjectInfoLastName_{{$project->id}}">{{strlen($projectV->text)>0?$projectV->text:"N/A"}}</p>
                        </div>
                        @if($projectV->textBack != '')
                            <div class="col-md-12">
                                <h5>Returned Text: </h5>
                                <p class="pProjectInfo" data-id="{{$project->id}}" id="pProjectInfoLastName_{{$project->id}}">{{$projectV->textBack}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>