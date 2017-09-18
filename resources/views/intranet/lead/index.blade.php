@extends('intranet.layouts.default')
@section('title')
    Lead View
@endsection
@section('header_styles')
    <link href="{{ asset('/css/lead.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
@endsection
@include('intranet.layouts.mobile')
@section('content')

    @if($est = ['CT','DE','DC','FL','KY','GA','IN','ME','MD','MA','MI','NH','NJ','NY','NC','OH','PA','RI','SC','VT','VA','WV'])@endif
    @if($cst = ['AL','AR','IA','KS','IL','LA','MN','MS','MO','NE','ND','OK','SD','TN','TX','WI'])@endif
    @if($mst = ['AZ','ID','MT','NM','UT','WY'])@endif
    @if($pst = ['CA','OR','WA','NV'])@endif
    @if($mdt = ['CO'])@endif
    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    @include('intranet.tools.loadingModal')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12 col-xs-1 noPadding">
                        <button class="btn btn-default btnConnect padding5" id="btnConnect"><i class="fa fa-cogs"></i> {{CONNECT}}</button>
                    </div>
                    <div class="col-md-12 col-xs-8 noPadding">
                        <input type="text" class="editableval inputCurrentPhone" id="inputCurrentPhone" placeholder="Phone" />
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
                    @if(strpos(Session::get('user_type'), 'incubator') === false)
                        <div class="col-md-12 col-xs-3 noPadding">
                            <select class="selectSendEmail" id="selectSendEmail">
                                <option value="0">{{SELECT_EMAIL}}</option>
                                <option value="submissionKit">{{SUBMISSION_KIT}}</option>
                                <option value="emailConsInfo">{{CONSULTANT_INFO}}</option>
                                <option value="tryingToReachYou">{{TRYING_TO_REACH}}</option>
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
                        <div class="col-md-12 col-xs-6 noPadding">
                            <select class="selectSendEmail" id="selectSendSms">
                                <option value="0">{{SELECT_SEND_OPTION}}</option>
                                <option value="sendMsg">{{SEND_MSG}}</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-xs-2 noPadding">
                            <button class="btn btn-default createLeadBtn padding5" id="createLeadBtn"><i class="fa fa-plus"></i> {{LIVE_CALL_REQUEST}}</button>
                        </div>
                        <div class="col-md-12 col-xs-2 noPadding">
                            <button class="pull-right col-md-12 col-xs-1 btn btn-default padding5" id="needMoreLeads"><i class="fa fa-plus"></i>    {{MORE_LEADS}}</button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <h4 class="totalLeads">Total Leads: {{count($leads)}}</h4>
                <div class="col-md-12 col-xs-4">
                    <input type="text" id="inputRestDays" class="editableval inputRestDays" placeholder="0" value="0">
                    <button class="btn btn-default padding5 btnRestDays" id="btnRestDays" data-active="0"><i class="fa fa-search-plus"></i> {{REST_DAYS}}</button>
                </div>
                <div class="col-md-12 col-xs-6">
                    <input type="text" class="editableval" id="whoString" placeholder="FIND LEAD" style="width: {{WHO_IS_WIDTH}}px;">
                </div>
                <div class="col-md-12 col-xs-12 container-callers"></div>
                <div class="clear"></div>
                <h5 class="last15Title">Last 15 leads</h5>
                <div class="col-md-12 col-xs-12 container-last"></div>
            </div>
            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                @foreach ($leads as $lead)
                    @include('intranet.lead.lead')
                @endforeach
            </div>
        </div>
    </div>

    {{--include Modal Appointment--}}
    @include('intranet.tools.appointmentModal')
    @include('intranet.lead.tools.whoIsThisModal')
    @include('intranet.tools.sendArticleModal')
    @include('intranet.tools.settingsModal')
    @include('intranet.lead.tools.createLeadModal')
    @include('intranet.project.tools.sendTextModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/lead.js")}}"></script>
    <script src="{{asset("js/plivo.js")}}"></script>
    <script src="{{asset("js/email.js")}}"></script>
@endsection
