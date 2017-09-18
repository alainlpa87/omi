@extends('intranet.layouts.default')
@section('header_styles')
    <link href="{{ asset('/css/report.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/chartist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/bootstrap-datetimepicker.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/plugins/bootstrap/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/plugins/bootstrap/buttons.dataTables.min.css')}}" rel="stylesheet"/>
@endsection
@include('intranet.layouts.mobile')
@section('content')
    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    @include('intranet.tools.loadingModal')
    <div class="container-fluid">
        <div class="row rowTop">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-6 col-xs-10">
                        <select class="consultantSelect">
                            {{--code will be in superadminController--}}
                            <option value="-1" selected>Select Consultant</option>
                            @foreach($consultants as $consultant)
                                <option value="{{$consultant->id}}">{{$consultant->usr}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-danger padding5" id="btnRecordConsultant"><i class="fa fa-microphone"></i> Start Recording</button>
                    </div>
                    <div class="col-md-12 containerReportButtons">
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
            </div>
            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="col-md-12 col-xs-12">
                    <h3 class="h3ManageInfo">CALLS</h3>
                    <table id="tableCalls" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead id="tableDataHead">
                        <tr>
                            <th>ACTION</th>
                            <th>CONSULTANT</th>
                            <th>DATE</th>
                        </tr>
                        </thead>
                        <tfoot id="tableDataFoot">
                        <tr>
                            <th>ACTION</th>
                            <th>CONSULTANT</th>
                            <th>DATE</th>
                        </tr>
                        </tfoot>
                        <tbody id="tableCallsBodyStats">
                        @foreach($calls as $call)
                            <tr id="{{$call->id}}">
                                <th><i class="fa fa-ban deleteCall" aria-hidden="true" data-id="{{$call->id}}" style="margin-right: 20px;"></i> <a href="{{$call->url}}" target="_blank"><i class="fa fa-play"></i></a></th>
                                <th>{{ucfirst($call->consultant->usr)}}</th>
                                <th>{{date('m-d-Y h:i:s',strtotime($call->created_at))}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/recordingcalls.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/moment.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
@endsection