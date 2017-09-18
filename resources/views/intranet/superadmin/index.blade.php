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
                <div class="container-dialer">
                    <div class="col-md-6 col-xs-10">
                        <select class="consultantSelect">
                            <option value="-1" selected>Create New</option>
                            @foreach($consultants as $consultant)
                                <option value="{{$consultant->id}}">{{$consultant->usr}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-default btnManageConsultant padding5" id="btnManageConsultant"><i class="fa fa-paper-plane-o"></i> Manage Consultant</button>
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
                    <h3 class="h3ManageInfo">Create Consultant</h3>
                    <form id="consultantData" action="" onsubmit="return false;">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>First Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control cleanBorder" id="fname" name="fname" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Last Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control cleanBorder" id="lname" name="lname"/>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Username</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control cleanBorder" id="username" name="username"/>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="text" class="form-control cleanBorder" id="password" name="password"/>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>DID</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control cleanBorder" id="did" name="did"/>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>DID2</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control cleanBorder" id="did2" name="did2"/>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>EXT</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control cleanBorder" id="ext" name="ext"/>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-inbox"></i></span>
                                <input type="email" class="form-control cleanBorder" id="email" name="email"/>
                            </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                            <label>Phone Letter Combination</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control cleanBorder" id="token" name="email"/>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Consultant Type</label>
                            <div class="input-group">
                                <select name="type" id="type">
                                    <option value="ADMIN">Admin</option>
                                    <option value="CON_JR">Junior</option>
                                    <option value="CON_SR">Senior</option>
                                    <option value="CON_MGR">Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Shift</label>
                            <div class="input-group">
                                <select name="shift" id="shift">
                                    <option value="EARLY">EARLY</option>
                                    <option value="LATE">LATE</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="allowRecording" name="allowRecording"><span>Allow Recording Call</span>
                            </div>
                        </div>

                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <div class="input-group">
                                <input type="checkbox" id="leads" name="leads"/> <span>Grade A Leads</span>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="oldLeads" name="oldLeads"> <span>Grade B Leads</span>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="oldLeads21" name="oldLeads21"> <span>Grade C Leads</span>
                            </div>
                            @if(strpos(Session::get('user_type'), 'boss')!== false)
                            <div class="input-group">
                                &nbsp;
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="allowToWorkFromHome" name="allowToWorkFromHome"> <span>Allow To Work From Home In Office Hours</span>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="noAllowToWorkFromHomeAtAll" name="noAllowToWorkFromHomeAtAll"> <span>Not Allow To Work From Home At All</span>
                            </div>
                                @endif
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label class="col-md-12 col-xs-12">Leadsources:</label>
                            <div class="col-md-4 col-xs-4">
                                <input type="checkbox" id="imi" name="imi"><span>imi</span>
                            </div>
                            {{--<div class="col-md-4 col-xs-4">
                                <input type="checkbox" id="cmp" name="cmp"><span>cmp</span>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <input type="checkbox" id="cmf" name="cmf"><span>cmf</span>
                            </div>--}}
                            <div class="col-md-4 col-xs-4">
                                <input type="checkbox" id="live" name="live"><span>live</span>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <input type="checkbox" id="omi" name="omi"><span>omi</span>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <input type="checkbox" id="live_n" name="live_n"><span>live_n</span>
                            </div>
                            {{--<div class="col-md-4 col-xs-4">--}}
                                {{--<input type="checkbox" id="n42" name="n42"><span>n42</span>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-4 col-xs-4">--}}
                                {{--<input type="checkbox" id="seo" name="seo"><span>seo</span>--}}
                            {{--</div>--}}
                            <div class="col-md-4 col-xs-4">
                                <input type="checkbox" id="def" name="def"><span>def</span>
                            </div>
                            {{--<div class="col-md-4 col-xs-4">--}}
                                {{--<input type="checkbox" id="pal" name="pal"><span>pal</span>--}}
                            {{--</div>--}}
                        </div>

                        <div class="form-group col-md-12 col-xs-12">
                            <button class="btn btn-primary btnSaveConsultant" id="btnSaveConsultant">Save Consultant</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{--include Modal Appointment--}}
@endsection
@section('footer_scripts')
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/superadmin.js")}}"></script>
@endsection
