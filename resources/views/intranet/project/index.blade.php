@extends('intranet.layouts.default')
@section('title')
    Projects View
@endsection
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection
@include('intranet.layouts.mobile')
@section('content')

    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    @include('intranet.tools.loadingModal')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12 col-xs-2 noPadding">
                        <button class="btn btn-default btnConnect padding5" id="btnConnect"><i class="fa fa-cogs"></i> {{CONNECT}}</button>
                    </div>
                    <div class="col-md-12 col-xs-8

                     noPadding">
                        <input type="text" class="editableval inputCurrentPhone" id="inputCurrentPhone" placeholder="Phone"/>
                    </div>
                    @if($consultant->allowRecording == 1)
                    <div class="pull-right col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-danger btnRecordCall padding5" id="btnRecordCall"><i class="fa fa-microphone"></i> {{RECORD_CALL}}</button>
                    </div>
                    @endif
                    <div class="pull-right col-md-6 col-xs-1 noPadding">
                        <button class="btn btn-default btnHangUp padding5" id="btnHangUp">{{HANG_UP}}</button>
                    </div>
                    <div class="pull-right col-md-6 col-xs-1 noPadding">
                        <button class="btn btn-success btnDial padding5" id="btnDial"><i class="fa fa-phone"></i> {{DIAL}}</button>
                    </div>
                    <div class="col-xs-1 extraDiv"></div>
                    <div class="col-md-6 col-xs-3 noPadding">
                        <select class="selectSendText" id="selectSendText">
                            <option value="1">INFO</option>
                            <option value="2">SCREEN</option>
                            <option value="3">CALL</option>
                            <option value="4">MISSED</option>
                            <option value="159">OPTIONS</option>
                            <option value="217">SCAMS</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-1 noPadding">
                        <button class="btn btn-default btnSendText padding5" id="btnSendTextLead"><i class="fa fa-mobile"></i> {{SEND_TEXT}}</button>
                    </div>
                    <div class="col-md-6 col-xs-3 noPadding">
                        <select class="selectLeaveVM" id="selectLeaveVM">
                            @foreach($voiceMessages as $vm)
                            <option value="{{$vm->id}}">{{$vm->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-1 noPadding">
                        <button class="btn btn-default btnLeaveVM padding5" id="btnLeaveVM"><i class="fa fa-volume-down"></i> {{LEAVE_VM}}</button>
                    </div>
                    <div class="col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-default btnAppointment padding5" id="btnAppointment"><i class="fa fa-calendar"></i> {{APPOINTMENT}}</button>
                    </div>
                    <div class="col-md-12 col-xs-6 noPadding">
                        <select class="script" id="scriptToReed">
                            <option value="0">--SCRIPT--</option>
                            <option value="/UPLOADEDFILES/scriptText1.pdf">Lead Call with Concept Review</option>
                            <option value="/UPLOADEDFILES/scriptText4.pdf">Overcoming Objections</option>
                            <option value="/UPLOADEDFILES/scriptText2.pdf">Contract Presentation and Close</option>
                            <option value="/UPLOADEDFILES/scriptText3.pdf">Do or Die Voicemail</option>
                        </select>
                    </div>
                    <div class="col-md-12 col-xs-6 noPadding">
                        <select class="selectSendEmail" id="selectSendEmailProject">
                            <option value="0">{{SELECT_SEND_OPTION}}</option>
                            <option value="JVA">JVA</option>
                            {{--<option value="imgMsg">{{IMAGE_TEXT}}</option>--}}
                            <option value="sendMsg">{{SEND_MSG}}</option>
                        </select>
                    </div>
                    <div class="col-md-12 col-xs-7 noPadding">
                        <select class="selectSendArticle" id="selectSendArticle">
                            <option value="0">{{SELECT_ARTICLE}}</option>
                            @foreach($articles as $article)
                                <option value="{{$article->id}}" title="{{$article->title}}">{{strlen($article->title)>25?substr($article->title,0,23).'...':$article->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-default btnContractActions padding5" id="btnContractActions"><i class="fa fa-gavel"></i> {{CONTRACT_ACTIONS}}</button>
                    </div>
                    <div class="col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-default btnContractActions padding5" id="btnSetPayment"><i class="fa fa-money"></i> {{PROJECT_SET_PAYMENT}}</button>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <h4 class="totalProjects">Total Projects: {{count($projects)}}</h4>
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: {{WHO_IS_WIDTH}}px;">
                </div>
                <div class="col-md-12 col-xs-12 container-callers"></div>
                <div class="clear"></div>
                <h5 class="last15Title">Last 15 projects</h5>
                <div class="col-md-12 col-xs-12 container-last"></div>
            </div>

            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 boxFixedTop">
                <div id="paginator"></div>
                <div class="container-stages-href">
                    <button class="btn btn-default goToProjectStage" data-stage="SUBMISSIONS">SUBMISSIONS</button>
                    <button class="btn btn-default goToProjectStage" data-stage="CONCEPT">CONCEPT</button>
                    <button class="btn btn-default goToProjectStage" data-stage="PREP">PREP</button>
                    <button class="btn btn-default goToProjectStage" data-stage="CONTRACT">CONTRACT</button>
                    <button class="btn btn-default goToProjectStage" data-stage="WOM">WOM</button>
                    <button class="btn btn-default goToProjectStage" data-stage="WALKTHRU">WALKTHRU</button>
                    <button class="btn btn-default goToProjectStage" data-stage="PHASE2">PHASE2</button>
                    {{--<button class="btn btn-default goToProjectStage" data-stage="ARCHIVE">ARCHIVE</button>--}}
                </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets marginContainer">
                <div class="container-submissions">
                    <a name="SUBMISSIONS" id="SUBMISSIONSSC"></a>
                    <h5 class="h5Stage" id="stageTitleSubmissions">----SUBMISSIONS---</h5>
                    @if($projects_review = $projects->where('stage','SUBMISSIONS'))@endif
                    @foreach ($projects_review as $project)
                        @include('intranet.project.portlet')
                    @endforeach
                    @if($projects_empty = $projects->where('stage',''))@endif
                    @foreach ($projects_empty as $project)
                        @include('intranet.project.portlet')
                    @endforeach
                    <div class="clear"></div>
                </div>
                <div class="container-concept">
                    <a name="CONCEPT" id="CONCEPTSC"></a>
                    <h5 class="h5Stage" id="stageTitleConcept">----CONCEPT---</h5>
                    @if($projects_concept = $projects->where('stage','CONCEPT'))@endif
                    @foreach ($projects_concept as $project)
                        @include('intranet.project.portlet')
                    @endforeach
                    <div class="clear"></div>
                </div>
                <div class="container-prep">
                    <a name="PREP" id="PREPSC"></a>
                    <h5 class="h5Stage" id="stageTitlePrep">----PREP---</h5>
                    @if($projects_prep = $projects->where('stage','PREP'))@endif
                    @foreach ($projects_prep as $project)
                        @include('intranet.project.portlet')
                    @endforeach
                    <div class="clear"></div>
                </div>
                <div class="container-contract">
                    <a name="CONTRACT" id="CONTRACTSC"></a>
                    <h5 class="h5Stage" id="stageTitleContract">----CONTRACT---</h5>
                    @if($projects_contract = $projects->where('stage','CONTRACT'))@endif
                    @foreach ($projects_contract as $project)
                        @include('intranet.project.portlet')
                    @endforeach
                    <div class="clear"></div>
                </div>
                <div class="container-wom">
                    <a name="WOM" id="WOMSC"></a>
                    <h5  class="h5Stage" id="stageTitleWom">----WOM---</h5>
                    @if($projects_wom = $projects->where('stage','WOM'))@endif
                    @foreach ($projects_wom as $project)
                        @include('intranet.project.portlet')
                    @endforeach
                    <div class="clear"></div>
                </div>
                <div class="container-walkthru">
                    <a name="WALKTHRU" id="WALKTHRUSC"></a>
                    <h5 class="h5Stage" id="stageTitleWalkthru">----WALKTHRU---</h5>
                    @if($projects_walkthru = $projects->where('stage','WALKTHRU'))@endif
                    @foreach ($projects_walkthru as $project)
                        @include('intranet.project.portlet')
                    @endforeach
                    <div class="clear"></div>
                </div>
                <div class="container-phase2">
                    <a name="PHASE2" id="PHASE2SC"></a>
                    <h5 class="h5Stage" id="stageTitlePhase2">---PHASE2---</h5>
                    @if($projects_phase2 = $projects->where('stage','PHASE2'))@endif
                    @foreach ($projects_phase2 as $project)
                        @include('intranet.project.portlet')
                    @endforeach
                    <div class="clear"></div>
                </div>
                <div class="container-archive"></div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found marginContainer" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
        </div>
    </div>

    {{--include Modal Appointment--}}
    @include('intranet.tools.appointmentModal')
    @include('intranet.project.tools.sendTextModal')
    @include('intranet.project.tools.resetPasswordModal')
    @include('intranet.tools.sendArticleModal')
    @include('intranet.tools.settingsModal')
    @include('intranet.project.tools.filesModal')
    @include('intranet.project.tools.contractActionsModal')
    @include('intranet.project.tools.setPaymentProjectModal')
    @include('intranet.project.tools.setPPAProjectModal')
    @include('intranet.project.tools.setStageAndDateModal')
    @include('intranet.project.tools.shareNoteModal')
    {{--iframes--}}
    @include('intranet.tools.iframePrint')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/project.js")}}"></script>
    <script src="{{asset("js/plivo.js")}}"></script>
    <script src="{{asset("js/email.js")}}"></script>

    <script src="{{asset("/plugins/bootstrap/moment.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
@endsection
