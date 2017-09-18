@extends('intranet.layouts.default')
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/production.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection
@include('intranet.layouts.mobile')
@section('content')

    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    <input type="hidden" id="pendingPatentAppF" data-projpending="{{$pendingPatentAppF}}">{{--to know if there patent app with 3 months since patent app was filed--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                {{--<p class="boxAttorney">Total projects sent to mike_attorney: <span id="attorney1Available">{{$attorney1Available}}</span></p>--}}
                {{--<p class="boxAttorney">Total projects sent to jh_attorney: <span id="attorney2Available">{{$attorney2Available}}</span></p>--}}
                <p class="boxAttorney">Total projects sent this month: <span id="attorney2Available">{{$totalSend}}</span></p>

                @foreach ($attArray as $att)
                    @if($attData = explode("-",$att))@endif
                    <p class="boxAttorney">Total projects sent to {{$attData[0]}}: <span id="attorney1Available">{{$attData[1]}}</span></p>
                @endforeach
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: {{WHO_IS_WIDTH}}px;">
                </div>
                <div class="col-md-12">
                        <button class="btn btn-primary" id="sentLetterOfEngagement">Send LetterOfEng</button>
                    {{--@if(count($projectsProductionNew)>0 && (date("l")=="Monday"||date("l")=="Friday"))--}}
                        <button class="btn btn-primary" id="sendProjects">Send Projects</button>
                    {{--@endif--}}
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary showTicketsView" id="showTicketsProd">MANAGE TICKETS</button>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <button class="btn btn-primary" id="emToVendor">SEND EMAIL TO VENDOR</button>
                </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="groupQuestions">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseNew" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        New Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseNew" class="panel-collapse collapse {{count($projectsProductionNew)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-new">
                                        @foreach ($projectsProductionNew as $projectp)
                                        @if($project = $projectp->project)@endif
                                        @include('intranet.production.portlet')
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSent" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        Sent Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseSent" class="panel-collapse collapse {{count($projectsProductionSent)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-sent">
                                    @foreach ($projectsProductionSent as $projectp)
                                    @if($project = $projectp->project)@endif
                                    @include('intranet.production.portlet')
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading backBlue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseCompleted" class="actionQuestions">
                                    <h4 class="panel-title titleContainers">
                                        Completed Projects
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseCompleted" class="panel-collapse collapse {{count($projectsProductionCompleted)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-completed">
                                    @foreach ($projectsProductionCompleted as $projectp)
                                    @if($project = $projectp->project)@endif
                                    @include('intranet.production.portlet')
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
                            <div id="collapseReturned" class="panel-collapse collapse {{count($projectsProductionReturned)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-returned">
                                    @foreach ($projectsProductionReturned as $projectp)
                                    @if($project = $projectp->project)@endif
                                    @include('intranet.production.portlet')
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
                            <div id="collapseOverdue" class="panel-collapse collapse {{count($projectsProductionOverdue)>0?"in":""}}">
                                <div class="panel-body borderBlue">
                                    <div class="container-portlets-overdue">
                                    @foreach ($projectsProductionOverdue as $projectp)
                                    @if($project = $projectp->project)@endif
                                    @include('intranet.production.portlet')
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
    @include('intranet.production.tools.productionFilesModal')
    @include('intranet.production.tools.productionReturnProjectModal')
    @include('intranet.production.tools.productionSelectAttorneyModal')
    @include('intranet.production.tools.productionSetShippingDateModal')
    @include('intranet.tools.UploadFileModal')
    @include('intranet.tools.emailToVendorsModal')
    @include('intranet.tools.selectFilesToAttachModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/production.js")}}"></script>
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>
    <script src="{{asset("js/uploadFile/uploadFileProduction.js")}}"></script>

    <script src="{{asset("/plugins/bootstrap/moment.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
@endsection
