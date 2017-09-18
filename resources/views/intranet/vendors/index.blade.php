@extends('intranet.layouts.default')
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

    <div class="container-fluid">
        <input type="hidden" data-email="{{$consultant->email}}" id="vendor_email">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="col-md-12 col-xs-2 noPadding">
                    <button class="btn btn-default btnUploadSeveralFiles padding5" id="btnUploadSeveralFiles"><i class="fa fa-upload"></i> UPLOAD FILES</button>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: {{WHO_IS_WIDTH}}px;">
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
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="groupProjects">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseNew" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        New Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseNew" class="panel-collapse collapse {{count($projectsNew)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-new">
                                        @foreach ($projectsNew as $projectp)
                                            @if($project = $projectp->project)@endif
                                            @include('intranet.vendors.portlet')
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseReturned" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        Returned Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseReturned" class="panel-collapse collapse {{count($projectsReturned)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-returned">
                                        @foreach ($projectsReturned as $projectp)
                                            @if($project = $projectp->project)@endif
                                            @include('intranet.vendors.portlet')
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOverdue">
                                    <h4 class="panel-title titleContainers">
                                        Overdue Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseOverdue" class="panel-collapse collapse {{count($projectsLate)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-overdue">
                                        @foreach ($projectsLate as $projectp)
                                            @if($project = $projectp->project)@endif
                                            @include('intranet.vendors.portlet')
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

    @include('intranet.tools.iframePrint')
    @include('intranet.vendors.tools.vendorFilesModal')
    @include('intranet.tools.UploadFileModal')
    @include('intranet.tools.emailToPSUFromVendorsModal')
    @include('intranet.tools.attCSFilesModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>
    <script src="{{asset("js/uploadFile/uploadFileVendors.js")}}"></script>
    <script src="{{asset("js/vendors.js")}}"></script>
@endsection
