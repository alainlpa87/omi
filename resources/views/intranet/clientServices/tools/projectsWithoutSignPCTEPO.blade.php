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
    <div class="tm_reminder_hide">
        @foreach($pendingPtntAppTM as $pcs)
            <input type="hidden" class="tm_reminder" data-fileno ="{{$pcs->fileno}}" data-pin="{{$pcs->project_id}}" data-clientfn="{{$pcs->project->lead->fname}}" data-clientln="{{$pcs->project->lead->lname}}">
        @endforeach
    </div>
    <div class="cr_reminder_hide">
        @foreach($pendingPtntAppCR as $pcs)
            <input type="hidden" class="cr_reminder" data-fileno ="{{$pcs->fileno}}" data-pin="{{$pcs->project_id}}" data-clientfn="{{$pcs->project->lead->fname}}" data-clientln="{{$pcs->project->lead->lname}}">
        @endforeach
    </div>
    <div class="upEm_reminder_hide">
        @foreach($pendingUpdEmail as $pcs)
            <input type="hidden" class="updEm_reminder" data-fileno ="{{$pcs->fileno}}" data-pin="{{$pcs->project_id}}" data-clientfn="{{$pcs->project->lead->fname}}" data-clientln="{{$pcs->project->lead->lname}}">
        @endforeach
    </div>
    <div class="expUt_reminder_hide">
        @foreach($pendingUtilities as $pcs)
            <input type="hidden" class="expUt_reminder" data-pcsid="{{$pcs->id}}" data-fileno ="{{$pcs->fileno}}" data-pin="{{$pcs->project_id}}" data-clientfn="{{$pcs->project->lead->fname}}" data-clientln="{{$pcs->project->lead->lname}}">
        @endforeach
    </div>
    <div class="9months_follow_call_hide">
        @foreach($Months9FollowCall as $followCall)
            <input type="hidden" class="9m_follow_call" data-fileno ="{{$followCall->fileno}}" data-pin="{{$followCall->project_id}}" data-clientfn="{{$followCall->project->lead->fname}}" data-clientln="{{$followCall->project->lead->lname}}">
        @endforeach
    </div>
    <div class="app_delay_hide">
        @foreach($pendingLateApp as $appDelay)
            <input type="hidden" class="app_delay" data-pcsid="{{$appDelay->id}}" data-fileno ="{{$appDelay->fileno}}" data-pin="{{$appDelay->project_id}}" data-clientfn="{{$appDelay->project->lead->fname}}" data-clientln="{{$appDelay->project->lead->lname}}">
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
    @if(count($pendingUpdEmail)>0)
        <div id="updateEmailModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>Email Update Utility after 1 Year:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-updEm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(count($pendingUtilities)>0)
        <div id="expiredUtModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>Utilities expired:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-expUt">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(count($pendingPtntAppTM)>0)
        <div id="pendingTMModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TRADEMARK QUESTIONNAIRE WITHOUT SIGNATURE:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-tm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(count($pendingPtntAppCR)>0)
        <div id="pendingCRModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>COPYRIGHT QUESTIONNAIRE WITHOUT SIGNATURE:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-cr">
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
                        <h5>TODAY WELCOME EMAIL FOLLOW UP CALL:</h5>
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
        <div id="FollowUpModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TODAY PATENT APP FOLLOW UP WITH INVENTOR:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-pa">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(count($Months9FollowCall)>0)
        <div id="CallFollow9MonthsModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TODAY 9 MONTHS FOLLOW UP CALL:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-9m">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(count($pendingLateApp)>0)
        <div id="AppDelayModal"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>TODAY 91 DAYS SINCE DOCUMENTS WAS SENT TO ATTORNEY:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-appDelay">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('intranet.tools.updateEmailSelectFilesModal')
@endsection
@section('footer_scripts')
    {{--<script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>--}}
    {{--<script src="{{asset("js/common.js")}}"></script>--}}
    <script src="{{asset("js/alertNoSign.js")}}"></script>
@endsection