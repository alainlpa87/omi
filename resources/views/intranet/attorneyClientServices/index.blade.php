@extends('intranet.layouts.default')
@section('title','Legal View')
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/vendor.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection
@include('intranet.layouts.mobile')
@section('content')

    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    @if($search =0)@endif
    <div class="container-fluid">
        <input type="hidden" data-email="{{$consultant->email}}" id="vendor_email">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="panel-heading backBlue">
                    <a  href="{{url('reportAttVendors?ATT='.$consultant->id)}}" target="_blank" class="actionQuestions">
                        <p class="boxAttorney" style="color: #ffffff">
                            Monthly Report
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSubAttCS" placeholder="FIND SUB" style="width: {{WHO_IS_WIDTH}}px;">
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <button class="btn btn-primary" id="emToCSBtn">SEND EMAIL TO PSU</button>
                </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
            {{--Container of all the portlets--}}
            @if($newCRAndTM != "")
                <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-newTmandCR">
                    <p><b>We have sent you new TM or CR forms. Please read and confirm that the forms are complete within 7 days. If they are not complete, please deny and state what is missing. Thank you.</b></p>
                    @foreach ($newCRAndTM as $projectN)
                        @if($project = $projectN->projectclientservices->project)@endif
                            <div class="portlet col-md-12 portlet-new" id="container_{{$projectN->id}}"  style="height: 40px" data-id = "{{$project->id}}" data-request-id="{{$project->id}}">
                                <div class="box call">
                                    <div class="portlet-title">
                                        <div class="indicator caption" style="z-index: 100;width: 93%;" data-id="{{$project->id}}" data-aid="{{$projectN->id}}">
                                            NEW {{$projectN->type}} - {{$project->lead->fileno}}
                                            <a target="_blank" href="{{ asset('/files/projects/'.$project->lead->fileno.'/'.$project->id.'/'.($projectN->type == 'TM'?'trademarkCoverSheet.pdf':'copyRightCoverSheet.pdf')) }}" style="margin-left: 20%">FILE INFO <i class="fa fa-file-pdf-o"></i></a>
                                            <span class="rejectTandCR" data-id="{{$projectN->id}}" style="float: right;margin-left: 5%" title="REJECT">
                                                <i class="fa fa-thumbs-down fa-2x red"></i>
                                            </span>
                                            <span class="approveTandCR" data-id="{{$projectN->id}}" style="float: right;" title="APPROVE">
                                                <i class="fa fa-thumbs-up fa-2x green"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            @else
                <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="groupProjects">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseNewAttCS" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        New Applications
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseNewAttCS" class="panel-collapse collapse {{count($projectsNew)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-new">
                                        @foreach ($projectsNew as $projectN)
                                            @if($project = $projectN->projectclientservices->project)@endif
                                            @include('intranet.attorneyClientServices.portlet')
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTMandCR" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        CR AND TM
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseTMandCR" class="panel-collapse collapse {{count($tmAndCr)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-new">
                                        @foreach ($tmAndCr as $projectN)
                                            @if($project = $projectN->projectclientservices->project)@endif
                                            @include('intranet.attorneyClientServices.portlet')
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseReturnedAttCS" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        Revision Due
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseReturnedAttCS" class="panel-collapse collapse {{count($projectsReturned)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-returned">
                                        @foreach ($projectsReturned as $projectN)
                                            @if($project = $projectN->projectclientservices->project)@endif
                                            @include('intranet.attorneyClientServices.portlet')
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseAppAprovedAttCS">
                                    <h4 class="panel-title titleContainers">
                                        Patent Applications Pending Filing
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseAppAprovedAttCS" class="panel-collapse collapse {{count($projectAppAprvd)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-overdue">
                                        @foreach ($projectAppAprvd as $projectN)
                                            @if($project = $projectN->projectclientservices->project)@endif
                                            @include('intranet.attorneyClientServices.portlet')
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOverdueAttCS">
                                    <h4 class="panel-title titleContainers">
                                        Past Due Drafting Applications
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseOverdueAttCS" class="panel-collapse collapse {{count($projectsLate)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-overdue">
                                        @foreach ($projectsLate as $projectN)
                                            @if($project = $projectN->projectclientservices->project)@endif
                                            @include('intranet.attorneyClientServices.portlet')
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @include('intranet.tools.iframePrint')
    @include('intranet.tools.attCSFilesModal')
    @include('intranet.attorneyClientServices.tools.attRejectCRorTMNotesModal')
    @include('intranet.attorneyClientServices.tools.finishAttModal')
    @include('intranet.tools.emailToPSUFromVendorsModal')
    @include('intranet.tools.UploadFileModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>
    <script src="{{asset("js/uploadFile/uploadFileAttCS.js")}}"></script>
    <script src="{{asset("js/attClientServices.js")}}"></script>
@endsection
