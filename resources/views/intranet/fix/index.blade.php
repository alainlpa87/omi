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
    @include('intranet.tools.loadingModalAjax')
    <div class="container-fluid">
        <div class="row rowTop">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="col-md-12 col-xs-12" style="border: 1px solid blue">
                    <p>Assign Leads</p>
                    <select class="consultantSelect">
                        <option value="-1" selected>Select Consultant</option>
                        @foreach($consultants as $consultant)
                            <option value="{{$consultant->id}}">{{$consultant->usr}}</option>
                        @endforeach
                    </select>
                    <select class="leadAmount">
                        <option value="0">Amount of Leads</option>
                        <option value="100">100 Leads</option>
                        <option value="200">200 Leads</option>
                        <option value="300">300 Leads</option>
                        <option value="1">1 Lead</option>
                    </select>
                    <div class="col-md-12">
                        <button class="btn btn-default btnAssignLeads padding5" id="btnAssignLeads"><i class="fa fa-paper-plane-o"></i> Assing Leads</button>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12" style="border: 1px solid blue;margin-top: 10px;">
                    <p>Fix Contracts</p>
                    <input type="text" class="form-control cleanBorder" id="project" placeholder="Project PIN"/>
                    <select class="contractTypeSelect">
                        <option value="-1" selected>Select Type</option>
                        <option value="IMG">IMG ($449)</option>
                        <option value="IGUP">IGUP ($430)</option>
                        <option value="IIG">IIG ($879)</option>
                    </select>
                    <div class="col-md-12">
                        <button class="btn btn-default btnFixContract padding5" id="btnFixContract"><i class="fa fa-paper-plane-o"></i> Fix Contract</button>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12" style="border: 1px solid blue;margin-top: 10px;">
                    <p>Delete Duplicate Project</p>
                    <input type="text" class="form-control cleanBorder" id="projectDuplicate" placeholder="Project PIN"/>
                    <div class="col-md-12">
                        <button class="btn btn-default btnFixDuplicate padding5" id="btnFixDuplicate"><i class="fa fa-paper-plane-o"></i>Delete Duplicate</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
            </div>
            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="col-md-12 col-xs-12">

                </div>
            </div>
        </div>
    </div>
    {{--include Modal Appointment--}}
@endsection
@section('footer_scripts')
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/fix.js")}}"></script>
@endsection
