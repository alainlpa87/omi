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
    {{--@include('intranet.layouts.common')--}}
    @include('intranet.tools.loadingModal')
    @include('intranet.tools.loadingModalAjax')

    <div class="container-fluid">
        <div class="row rowTop">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12 col-xs-8">
                        <select class="selectedMonth col-md-6 col-xs-6 noPadding">
                            <option value="01" {{date("m")=="01"?"selected":""}}>January</option>
                            <option value="02" {{date("m")=="02"?"selected":""}}>February</option>
                            <option value="03" {{date("m")=="03"?"selected":""}}>March</option>
                            <option value="04" {{date("m")=="04"?"selected":""}}>April</option>
                            <option value="05" {{date("m")=="05"?"selected":""}}>May</option>
                            <option value="06" {{date("m")=="06"?"selected":""}}>June</option>
                            <option value="07" {{date("m")=="07"?"selected":""}}>July</option>
                            <option value="08" {{date("m")=="08"?"selected":""}}>August</option>
                            <option value="09" {{date("m")=="09"?"selected":""}}>September</option>
                            <option value="10" {{date("m")=="10"?"selected":""}}>October</option>
                            <option value="11" {{date("m")=="11"?"selected":""}}>November</option>
                            <option value="12" {{date("m")=="12"?"selected":""}}>December</option>
                        </select>
                        <div class="col-md-6 col-xs-4 noPadding">
                            <button class="btn btn-default padding5" id="btnAttorneyStats" data-name="{{$att_name}}" data-pin="{{$att_id}}"><i class="fa fa-table"></i> Report</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <div class="infoChart"></div>
                </div>
            </div>

            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets container-charts">
                <h4 id="titleChart">Monthly Attorney Details ({{$att_name}})</h4>
                <table id="tableDataStats" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead id="tableDataHead">
                    <tr>
                        <th>FILENO</th>
                        <th>TYPE</th>
                        <th>SEND DATE</th>
                        <th>RECEIVED DATE</th>
                    </tr>
                    </thead>
                    <tfoot id="tableDataFoot">
                    <tr>
                        <th>FILENO</th>
                        <th>TYPE</th>
                        <th>SEND DATE</th>
                        <th>RECEIVED DATE</th>
                    </tr>
                    </tfoot>
                    <tbody id="tableDataBodyStats">
                    @foreach($attDetails as $attD)
                        <tr>
                            <th>{{$attD->lead->fileno}}</th>
                            <th>{{$attD->type}}</th>
                            <th>{{date("m-d-Y",strtotime($attD->created_at))}}</th>
                            <th>@if($rcvdDates[$attD->id]!=''){{date("m-d-Y",strtotime($rcvdDates[$attD->id]))}}@else N/A @endif</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script src="{{asset("/plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/attDetails.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/moment.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
@endsection
