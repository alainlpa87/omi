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
    <div class="ilc_pending_introCall_hide">
        @foreach($pendingIntroCall as $pending)
            <input type="hidden" class="ilc_pending_intro" data-fileno ="{{$pending->fileno}}" data-name="{{$pending->projectclientservices->project->lead->fname." ".$pending->projectclientservices->project->lead->lname}}" data-phone="{{$pending->projectclientservices->project->lead->phone}}" data-iid="{{$pending->id}}">
        @endforeach
    </div>
    <div class="ilc_pending_expiration_hide">
        @foreach($pendingExpiration as $pending)
            <input type="hidden" class="ilc_pending_expiration" data-fileno ="{{$pending->fileno}}" data-name="{{$pending->projectclientservices->project->lead->fname." ".$pending->projectclientservices->project->lead->lname}}" data-phone="{{$pending->projectclientservices->project->lead->phone}}" data-iid="{{$pending->id}}">
        @endforeach
    </div>
    @if($tradeshowAlert == 1)
        <div id="tradeshows"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>Trade Shows Call:</h5>
                    </div>
                    <div class="modal-body">
                        <div >
                           <p>One trade show just happened, to find the clients to call search in the ILC grid with the parameter "trade shows call".</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(count($pendingIntroCall)>0)
    <div id="ilcPendingIntroCall"  aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                    <h5>FILES WITH PENDING INTRO CALL:</h5>
                </div>
                <div class="modal-body">
                    <div class="container-pendingIntro">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(count($pendingExpiration)>0)
        <div id="ilcPendingExpiration"  aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                        <h5>FILES WITH EXPIRATION IN A WEEK OR LESS:</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-pendingExpiration">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('footer_scripts')
    <script src="{{asset("js/ilcPending.js")}}"></script>
    <script src="{{asset("js/ilc.js")}}"></script>
@endsection