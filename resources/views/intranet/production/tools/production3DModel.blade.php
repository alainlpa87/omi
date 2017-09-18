@extends('intranet.layouts.default')
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/clientServices.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection
@include('intranet.layouts.mobile')
@section('content')


    <div class="cs_pending_patentApp_filed_hide">
        @foreach($pendingPatentAppF as $pending)
            <input type="hidden" class="pending_app_filed" data-fileno ="{{$pending->fileno}}" data-pin="{{$pending->project_id}}" data-clientfn="{{$pending->project->lead->fname}}" data-clientln="{{$pending->project->lead->lname}}">
        @endforeach
    </div>
    @if(count($pendingPatentAppF)>0)
    <div id="PendingPatentAppModal"  aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bubble"  style="padding-top:1px !important;height: 30px !important;">
                    <h5>Files with Patent App Filed since 3 months:</h5>
                </div>
                <div class="modal-body">
                    <div class="container-files">
                    </div>
                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
    @endif
@endsection
@section('footer_scripts')
    {{--<script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>--}}
    {{--<script src="{{asset("js/common.js")}}"></script>--}}
    <script src="{{asset("js/alert3DDesign.js")}}"></script>
@endsection