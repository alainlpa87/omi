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

            </div>

            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <div class="infoChart"></div>
                </div>
            </div>

            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets container-charts">
                <h4 id="titleChart">APPOINTMENTS</h4>
                <table id="tableDataStats" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead id="tableDataHead">
                    <tr>
                        <th>STATUS</th>
                        <th>DATE</th>
                        <th>NOTE</th>
                    </tr>
                    </thead>
                    <tfoot id="tableDataFoot">
                    <tr>
                        <th>STATUS</th>
                        <th>DATE</th>
                        <th>NOTE</th>
                    </tr>
                    </tfoot>
                    <tbody id="tableDataBodyStats">
                    @foreach($appointments as $appointment)
                        <tr>
                            <th>{{$appointment->status}}</th>
                            <th>{{date("m-d-Y H:m A",strtotime($appointment->date))}}</th>
                            <th>{{$appointment->note}}</th>
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
    <script src="{{asset("js/allAppointments.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/moment.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
@endsection
