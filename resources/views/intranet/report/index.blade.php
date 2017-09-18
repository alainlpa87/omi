@extends('intranet.layouts.default')
@section('title')
    Statistics View
@endsection
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
    @include('intranet.tools.loadingModalAjax')
    <div class="container-fluid">
        <div class="row rowTop">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12">
                        <select class="consultantSelect">
                            <option value="-1" selected>ALL</option>
                            @foreach($consultants as $consultant)
                            <option value="{{$consultant->id}}">{{$consultant->usr}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-md-12 noMobil">From:</label>
                    <div class="col-md-12 col-xs-6">
                        <div class='input-group date' id='datetimepickerStart'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <label class="col-md-12 noMobil">To:</label>
                    <div class="col-md-12 col-xs-6">
                        <div class='input-group date' id='datetimepickerEnd'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    @if(strpos(Session::get('user_type'), 'admin')!== false)
                        <div class="col-md-12 containerReportButtons">
                        <div class="col-md-6 col-xs-3 noPadding">
                            <button class="btn btn-default btnContracts padding5" id="btnContracts"><i class="fa fa-paper-plane-o"></i> Contracts</button>
                        </div>
                        <div class="col-md-6 col-xs-3 noPadding">
                            <button class="btn btn-default btnSubmissions padding5" id="btnSubmissions"><i class="fa fa-file-o"></i> Submissions</button>
                        </div>
                        <div class="col-md-6 col-xs-3 noPadding">
                            <button class="btn btn-default btnSold padding5" id="btnSold"><i class="fa fa-money"></i> Sold</button>
                        </div>
                    @endif
                            <div class="col-md-6 col-xs-3 noPadding">
                                <button class="btn btn-default btnTransactions padding5" id="btnTransactions"><i class="fa fa-bar-chart"></i> CALLS</button>
                            </div>
                    @if(strpos(Session::get('user_type'), 'admin')!== false)
                        <div class="col-md-12 col-xs-6 noPadding">
                            <button class="btn btn-default btnCalls padding5" id="btnCalls"><i class="fa fa-phone"></i> Calls Per Day by Hours</button>
                        </div>
                        <div class="col-md-12 col-xs-3 noPadding">
                            <button class="btn btn-default btnLeadsPerConsultant padding5" id="btnLeadsPerConsultant"><i class="fa fa-bar-chart"></i> Leads per Consultant</button>
                        </div>
                        <div class="col-md-12 col-xs-3 noPadding">
                            <button class="btn btn-default btnLeadsBySource padding5" id="btnLeadsBySource"><i class="fa fa-bar-chart"></i> Leads by Source</button>
                        </div>
                        <div class="col-md-4 col-xs-3 noPadding">
                            <button class="btn btn-default btnLeads3dCall padding5" id="btnLeads3dCall"><i class="fa fa-table"></i> 3-Day</button>
                        </div>
                        <div class="col-md-8 col-xs-3 noPadding">
                            <button class="btn btn-default btnLeads3dCallPerConsultant padding5" id="btnLeads3dCallPerConsultant"><i class="fa fa-table"></i> 3-Day per Cons.</button>
                        </div>
                        @if(strpos(Session::get('user_type'), 'boss')!== false)
                            <div class="col-md-12 col-xs-2 noPadding">
                                <button class="btn btn-default btnSubBySource padding5" id="btnSubBySource"><i class="fa fa-calendar"></i> Subs By Source</button>
                            </div>
                                    <div class="col-md-12 col-xs-2 noPadding">
                                        <button class="btn btn-default btnPh1BySource padding5" id="btnPh1BySource"><i class="fa fa-calendar"></i> Paid Ph1 By Source</button>
                                    </div>
                            <div class="col-md-12 col-xs-2 noPadding">
                                <button class="btn btn-default btnLeadWithSubBySource padding5" id="btnLeadWithSubBySource"><i class="fa fa-calendar"></i> Leads with Projects by Source</button>
                            </div>
                            <div class="col-md-6 col-xs-6 noPadding">
                                <select class="sourceSelect">
                                    <option value="-1" selected>VENDOR</option>
                                    @foreach($vendors as $vendor)
                                        @if(strlen($vendor->leadSource)>0)
                                        <option value="{{$vendor->leadSource}}">{{$vendor->leadSource}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-xs-2 noPadding">
                                <button class="btn btn-default btnGrossLead padding5" id="btnGrossLead"><i class="fa fa-calendar"></i>Lead Gross</button>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                @if(strpos(Session::get('user_type'), 'boss')!== false)
                    <div class="col-md-12 col-xs-12 noPadding">
                        <button class="btn btn-default col-md-6 btnMonthlyMoneyReport padding5" id="btnMonthlyMoneyReport"><i class="fa fa-money"></i> Money Report</button>
                        <button class="btn btn-default col-md-6 btnMonthlyMoneyReport padding5" id="btnMonthlyMoneyReportCSV"><i class="fa fa-file-excel-o"></i> Money Report</button>
                    </div>
                    <div class="col-md-12 col-xs-12 noPadding">
                        <button class="btn btn-default btnSetPayment padding5" id="btnSetPayment"><i class="fa fa-money"></i> Report Sell</button>
                    </div>
                    <div class="col-md-12 col-xs-12 noPadding">
                        <button class="btn btn-default btnPaymentInAndNotSentToVendor padding5" id="btnPaymentInAndNotSentToVendor"><i class="fa fa-paper-plane"></i> Pending to Vendor</button>
                    </div>
                    <div class="col-md-12 col-xs-12 noPadding">
                        <button class="btn btn-default btFunding padding5" id="btFunding"><i class="fa fa-money"></i> Funding Contracts</button>
                    </div>
                @endif
                <div class="col-md-12 col-xs-2 noPadding">
                    <button class="btn btn-default btnJrToSrConsultant padding5" id="btnPersonalPH2ClosingRatio" title="PH2 / (IIG or IMG in a period of time)"><i class="fa fa-paper-plane-o"></i> Personal PH2 Closing Ratio</button>
                </div>
                <div class="col-md-12 col-xs-2 noPadding">
                    <button class="btn btn-default btnSrFromJrConsultant padding5" id="btnTeamLeadPH2ClosingRatio"><i class="fa fa-paper-plane-o"></i> Team Lead PH2 Closing Ratio</button>
                </div>

                @if(strpos(Session::get('user_type'), 'boss')!== false)
                    <div class="col-md-12 divSelectOptionAdmin">
                    <select  id="selectOptionAdmin">
                        <option value="0">--REASSIGN ACTIONS--</option>
                        <option value="R-L">{{REASSIGN_ONE_LEAD}}</option>
                        <option value="R-A">{{REASSIGN_AMOUNT_OF_LEAD}}</option>
                    </select>
                </div>
                @endif
                <div class="col-md-12">
                    <div class="infoChart"></div>
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
    @include('intranet.report.tools.monthlyReportNotesModal')
    @include('intranet.lead.tools.whoIsThisModal')
    @include('intranet.tools.settingsModal')
    @include('intranet.report.tools.setPaymentProjectModal')

    @include('intranet.admin.tools.adminReassignLeadWithSubModal')
    @include('intranet.admin.tools.adminActionModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/report.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/moment.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datetimepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
    <script src="{{asset("/plugins/chartist/chartist.js")}}"></script>
@endsection
