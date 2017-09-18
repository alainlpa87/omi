@extends('intranet.layouts.default')
@section('title')
    ILC Vendor View
@endsection
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/uploadFile.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/clientServices.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection

@include('intranet.layouts.mobile')
@section('content')

    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    @include('intranet.tools.loadingModal')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: {{WHO_IS_WIDTH}}px;">
                </div>
            </div>

            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseNewILCV" class="actionQuestions">
                                <h4 class="panel-title titleContainers">
                                    New Projects
                                </h4>
                            </a>
                        </div>
                        <div id="collapseNewILCV" class="panel-collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-new">
                                    {{--@if($projectsNew = $allPCS->where('completed',0))@endif--}}
                                    @foreach ($projectsILCVendors as $projectV)
                                        @if($project = $projectV->ilc->projectclientservices->project)@endif
                                        @include('intranet.ilcVendors.portlet')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseProcessILCV" class="actionQuestions">
                                <h4 class="panel-title titleContainers">
                                    Returned Projects
                                </h4>
                            </a>
                        </div>
                        <div id="collapseProcessILCV" class="panel-collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-returned">
                                    @foreach ($projectsILCVReturned as $projectV)
                                        @if($project = $projectV->ilc->projectclientservices->project)@endif
                                        @include('intranet.ilcVendors.portlet')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOverduILeCV">
                                <h4 class="panel-title titleContainers">
                                    Overdue Projects
                                </h4>
                            </a>
                        </div>
                        <div id="collapseOverdueILCV" class="panel-collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-overdue">
                                    @foreach ($projectsILCVOverDue as $projectV)
                                        @if($project = $projectV->ilc->projectclientservices->project)@endif
                                        @include('intranet.ilcVendors.portlet')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--@foreach ($projectsILC as $projectilc)--}}
                    {{--@if($project = $projectilc->projectclientservices->project)@endif--}}
                    {{--@include('intranet.ILC.portlet')--}}
                {{--@endforeach--}}

            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
        </div>
    </div>

    @include('intranet.tools.iframePrint')
    @include('intranet.tools.UploadFileModal')
    @include('intranet.ilcVendors.tools.ILCVendorsFilesModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/ilcVendors.js")}}"></script>
    {{--upload file--}}
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>
    <script src="{{asset("js/uploadFile/uploadFileILCVendors.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/moment.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
@endsection
