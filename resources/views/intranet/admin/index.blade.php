@extends('intranet.layouts.default')
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/uploadFile.css') }}" rel="stylesheet">
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
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="whoString" placeholder="FIND LEAD" style="width: {{WHO_IS_WIDTH}}px;">
                </div>
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: {{WHO_IS_WIDTH}}px;">
                </div>
                <div class="col-md-12 noPadding">
                    <button class="btn btn-default" id="btnContracts">{{BTN_CONTRACTS}}: <span id="contractsToMail"> {{$totalContracts}}</span></button>
                </div>
                <div class="col-md-12 divSelectOptionAdmin">
                    <select  id="selectOptionAdmin">
                        <option value="0">{{SELECT_ACTION}}</option>
                        <option value="C-L">{{CREATE_LEAD}}</option>
                        <option value="C-S">{{CREATE_SUB}}</option>
                        <option value="E-L">{{EXCLUDE_LEAD}}</option>
                        <option value="R-L">{{REASSIGN_ONE_LEAD}}</option>
                        <option value="R-A">{{REASSIGN_AMOUNT_OF_LEAD}}</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary showTicketsView" id="showTicketsAdmin">MANAGE TICKETS</button>
                </div>
            </div>

            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                @foreach ($dataRequest as $request)
                    @if($project = $request['PROJECT'])@endif
                    @if($currentRequest = $request['REQUEST'])@endif
                    @if($project!=null)
                        @include('intranet.admin.portlet')
                    @endif
                @endforeach
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
        </div>
    </div>

    @include('intranet.tools.iframePrint')
    @include('intranet.tools.UploadFileModal')
    @include('intranet.admin.tools.adminLoadingModal')
    @include('intranet.admin.tools.adminReassignLeadWithSubModal')
    @include('intranet.admin.tools.adminFilesModal')
    @include('intranet.admin.tools.adminActionModal')
    @include('intranet.admin.tools.adminContractModal')
    @include('intranet.admin.tools.whoIsThisModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/admin.js")}}"></script>
    {{--upload file--}}
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>
    <script src="{{asset("js/uploadFile/uploadFileAdmin.js")}}"></script>

    <script src="{{asset("/plugins/bootstrap/moment.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
@endsection
