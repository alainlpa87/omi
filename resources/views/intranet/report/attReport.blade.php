@extends('intranet.layouts.default')
@section('header_styles')
    <link href="{{ asset('/css/report.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/chartist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/plugins/bootstrap/buttons.dataTables.min.css')}}" rel="stylesheet"/>
@endsection
@include('intranet.layouts.mobile')
@section('content')
    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    @include('intranet.tools.loadingModal')
    @include('intranet.tools.loadingModalAjax')
    <div class="container-fluid">
        <div class="row rowTop">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12">
                        <select class="consultantSelect">
                            <option value="-1" selected>--Select Attorney--</option>
                            @foreach($consultants as $consultant)
                            <option value="{{$consultant->id}}">{{$consultant->fname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-md-12 noMobil">From:</label>
                    <div class="col-md-12 col-xs-6">
                        <div class='input-group date' id='datetimepickerStart'>
                            <input type='text' class="form-control" id="datetimepickerStartInput"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <label class="col-md-12 noMobil">To:</label>
                    <div class="col-md-12 col-xs-6">
                        <div class='input-group date' id='datetimepickerEnd'>
                            <input type='text' class="form-control" id="datetimepickerEndInput"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 containerReportButtons">
                        <div class="col-md-12 col-xs-6 noPadding">
                            <button class="btn btn-default col-md-9 padding5" id="btnPatentSearchReport"><i class="fa fa-paper-plane-o"></i> Patent Search</button>
                            <button class="btn btn-default col-md-3 padding5" id="btnPatentSearchReportCSV"><i class="fa fa-file-excel-o"></i></button>
                        </div>
                        <div class="col-md-12 col-xs-6 noPadding">
                            <button class="btn btn-default col-md-9 padding5" id="btnCSReport"><i class="fa fa-bar-chart"></i> App-CR-TM</button>
                            <button class="btn btn-default col-md-3 padding5" id="btnCSReportCSV"><i class="fa fa-file-excel-o"></i></button>
                        </div>
                        <div class="col-md-12 col-xs-6 noPadding">
                            <button class="btn btn-default col-md-9 padding5" id="btnPsaDdrReport"><i class="fa fa-bar-chart"></i> PSA - DDR</button>
                            <button class="btn btn-default col-md-3 padding5" id="btnPsaDdrReportCSV"><i class="fa fa-file-excel-o"></i></button>
                        </div>
                        <div class="col-md-12 col-xs-6 noPadding">
                            <button class="btn btn-default col-md-9 padding5" id="btnPctEpoReport"><i class="fa fa-bar-chart"></i> PCT - EPO</button>
                            <button class="btn btn-default col-md-3 padding5" id="btnPctEpoReportCSV"><i class="fa fa-file-excel-o"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets container-charts">
                <h4 id="titleChart"></h4>
                <div class="chart">
                    <div class="ct-chart ct-golden-section"></div>
                </div>
                <div class="divTable">
                    <table id="tableData" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead id="tableDataHead"></thead>
                        <tfoot id="tableDataFoot"></tfoot>
                        <tbody id="tableDataBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--include Modal Appointment--}}
    @include('intranet.project.tools.sendTextModal')
    @include('intranet.lead.tools.whoIsThisModal')
    @include('intranet.tools.settingsModal')
    @include('intranet.report.tools.setPaymentProjectModal')

    @include('intranet.admin.tools.adminReassignLeadWithSubModal')
    @include('intranet.admin.tools.adminActionModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/attReport.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/moment.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
    <script src="{{asset("/plugins/chartist/chartist.js")}}"></script>
@endsection
