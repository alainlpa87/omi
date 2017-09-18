@extends('intranet.layouts.default')
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/clientServices.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/uploadFile.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection
@include('intranet.layouts.mobile')
@section('content')


    <div class="cs_docs_without_sign_hide">
        @foreach($pendingPCTEPO as $pending)
            <input type="hidden" class="docs_without_sing" data-fileno ="{{$pending->fileno}}" data-pin="{{$pending->project_id}}" data-clientfn="{{$pending->project->lead->fname}}" data-clientln="{{$pending->project->lead->lname}}">
        @endforeach
    </div>
    <div class="cs_prov_hide">
        @foreach($pendingPROV as $prov)
            <input type="hidden" class="prov_to_expire" data-fileno ="{{$prov->fileno}}" data-pin="{{$prov->project_id}}" data-clientfn="{{$prov->project->lead->fname}}" data-clientln="{{$prov->project->lead->lname}}">
        @endforeach
    </div>
    <div class="we_followup_hide">
        @foreach($pendingEmailFollowUp as $we)
            <input type="hidden" class="we_followup" data-fileno ="{{$we->fileno}}" data-pin="{{$we->project_id}}" data-clientfn="{{$we->project->lead->fname}}" data-clientln="{{$we->project->lead->lname}}">
        @endforeach
    </div>
    <div class="pa_followup_hide">
        @foreach($pendingPtntAppFollowUp as $pa)
            <input type="hidden" class="pa_followup" data-fileno ="{{$pa->fileno}}" data-pin="{{$pa->project_id}}" data-clientfn="{{$pa->project->lead->fname}}" data-clientln="{{$pa->project->lead->lname}}">
        @endforeach
    </div>
    @if(count($pendingPCTEPO)>0)
    <div id="DocsWithOutSignModal"  aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                    <h5>SUBMISSIONS WITH MORE THAN 6 MONTHS WITHOUT SIGN PCT or EPO:</h5>
                </div>
                <div class="modal-body">
                    <div class="container-docs">
                    </div>
                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
    @endif
    @if(count($pendingPROV)>0)
    <div id="ProvWithOutSignModal"  aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bubble" style="padding-top:1px !important;height: 30px !important;">
                    <h5>SUBMISSIONS PROV THAT EXPIRES IN 3 MONTHS :</h5>
                </div>
                <div class="modal-body">
                    <div class="container-prov">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(count($pendingEmailFollowUp)>0)
        <div id="CallFollowUpModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TODAY WELCOME EMAIL FOLLOW UP:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-we">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(count($pendingPtntAppFollowUp)>0)
        <div id="CallFollowUpModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TODAY PATENT APP FOLLOW UP:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-pa">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('footer_scripts')
    {{--<script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>--}}
    {{--<script src="{{asset("js/common.js")}}"></script>--}}
    <script src="{{asset("js/alertNoSign.js")}}"></script>
@endsection