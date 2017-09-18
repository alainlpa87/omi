@extends('intranet.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 divLogo">
                <img src="{{asset('img/logo.png')}}">
                <span class="spanIntranet">INTRANET</span>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading panel-login">Click where you want to go:</div>
                    <div class="panel-body panel-login">
                        @if(strpos(Session::get('user_type'), 'consultant')!== false &&
                        (strpos(Session::get('user_type'), 'vendors')=== false ||Session::get('user_username')=="alain"||Session::get('user_username')=="jesus"))
                            <div class="form-group divLinkIndex" style="{{Session::get('user_username')=="ilc"?'display: none;':''}}">
                                <span>Lead View</span>
                                <a href="{{route('leads')}}">[Here]</a>
                                <a href="{{route('leads')}}" target="_blank">[New Tab]</a>
                            </div>
                            <div class="form-group divLinkIndex" style="{{Session::get('user_username')=="ilc"?'display: none;':''}}">
                                <span>Project View</span>
                                <a href="{{route('projects')}}">[Here]</a>
                                <a href="{{route('projects')}}" target="_blank">[New Tab]</a>
                            </div>
                            <div class="form-group divLinkIndex" style="{{Session::get('user_username')=="ilc"?'display: none;':''}}">
                                <span>Stats View</span>
                                <a href="{{route('stats')}}">[Here]</a>
                                <a href="{{route('stats')}}" target="_blank">[New Tab]</a>
                            </div>
                            <div class="form-group divLinkIndex" style="{{Session::get('user_username')=="ilc"?'display: none;':''}}">
                                <span>Training Calls View</span>
                                <a href="{{route('recordCalls')}}">[Here]</a>
                                <a href="{{route('recordCalls')}}" target="_blank">[New Tab]</a>
                            </div>
                        @endif
                        @if(strpos(Session::get('user_type'), 'admin')!== false)
                            <div class="form-group divLinkIndex">
                                <span>Admin View</span>
                                <a href="{{route('admin')}}">[Here]</a>
                                <a href="{{route('admin')}}" target="_blank">[New Tab]</a>
                            </div>
                                <div class="form-group divLinkIndex">
                                    <span>Consultant Management</span>
                                    <a href="{{route('superadmin')}}">[Here]</a>
                                    <a href="{{route('superadmin')}}" target="_blank">[New Tab]</a>
                                </div>
                        @endif
                        @if(strpos(Session::get('user_type'), 'statistics')!== false)
                            <div class="form-group divLinkIndex">
                                <span>Statistics View</span>
                                <a href="{{route('statistics')}}">[Here]</a>
                                <a href="{{route('statistics')}}" target="_blank">[New Tab]</a>
                            </div>
                        @endif
                        @if(strpos(Session::get('user_type'), 'vendors')!== false)
                            @if(Session::get('user_id') == 71)
                                <div class="form-group divLinkIndex">
                                    <span>ILC Vendor View</span>
                                    <a href="{{route('ilcVendors')}}">[Here]</a>
                                    <a href="{{route('ilcVendors')}}" target="_blank">[New Tab]</a>
                                </div>
                            @elseif(Session::get('user_id') == 30)
                                <div></div>
                            @elseif(Session::get('user_id') == 47)
                                <div class="form-group divLinkIndex">
                                    <span>Vendor View</span>
                                    <a href="{{route('vendors')}}">[Here]</a>
                                    <a href="{{route('vendors')}}" target="_blank">[New Tab]</a>
                                </div>
                                    <div class="form-group divLinkIndex">
                                        <span>ILC Vendor View</span>
                                        <a href="{{route('ilcVendors')}}">[Here]</a>
                                        <a href="{{route('ilcVendors')}}" target="_blank">[New Tab]</a>
                                    </div>
                            @else
                                <div class="form-group divLinkIndex">
                                    <span>Vendor View</span>
                                    <a href="{{route('vendors')}}">[Here]</a>
                                    <a href="{{route('vendors')}}" target="_blank">[New Tab]</a>
                                </div>
                            @endif
                        @endif

                        @if(strpos(Session::get('user_type'), 'production')!== false)
                            <div class="form-group divLinkIndex">
                                <span>Production View</span>
                                <a href="{{route('production')}}">[Here]</a>
                                <a href="{{route('production')}}" target="_blank">[New Tab]</a>
                            </div>
                            <div class="form-group divLinkIndex">
                                <span>Stats View</span>
                                <a href="{{route('stats')}}">[Here]</a>
                                <a href="{{route('stats')}}" target="_blank">[New Tab]</a>
                            </div>
                        @endif
                        @if(strpos(Session::get('user_type'), 'clientservices')!== false)
                            <div class="form-group divLinkIndex">
                                <span>Client Services View</span>
                                <a href="{{route('clientServices')}}">[Here]</a>
                                <a href="{{route('clientServices')}}" target="_blank">[New Tab]</a>
                            </div>
                        @endif
                        @if(strpos(Session::get('user_type'), 'attorneytest')!== false || strpos(Session::get('user_type'), 'attorneyLev')!== false || strpos(Session::get('user_type'), 'attorneySandra')!== false || strpos(Session::get('user_type'), 'attorneyjh')!== false || strpos(Session::get('user_type'), 'attorneyjk')!== false || strpos(Session::get('user_type'), 'attorneyMike')!== false)
                            <div class="form-group divLinkIndex">
                                <span>Legal View</span>
                                <a href="{{route('attClientServices')}}">[Here]</a>
                                <a href="{{route('attClientServices')}}" target="_blank">[New Tab]</a>
                            </div>
                        @endif
                        @if(strpos(Session::get('user_type'), 'ilc')!== false)
                            <div class="form-group divLinkIndex">
                                <span>ILC View</span>
                                <a href="{{route('ilc')}}">[Here]</a>
                                <a href="{{route('ilc')}}" target="_blank">[New Tab]</a>
                            </div>
                                <div class="form-group divLinkIndex">
                                    <span>Manufacturers View</span>
                                    <a href="{{route('manufacturer')}}">[Here]</a>
                                    <a href="{{route('manufacturer')}}" target="_blank">[New Tab]</a>
                                </div>
                        @endif
                        @if(Session::get('user_id') == 16 || Session::get('user_id') == 3 || Session::get('user_id') == 5)
                            <div class="form-group divLinkIndex">
                                <span>Calls Manager</span>
                                <a href="{{route('recordCallsManager')}}">[Here]</a>
                                <a href="{{route('recordCallsManager')}}" target="_blank">[New Tab]</a>
                            </div>
                        @endif
                        @if(Session::get('user_id') == 16 || Session::get('user_id') == 3 || Session::get('user_id') == 24 || Session::get('user_id') == 25 || Session::get('user_id') == 30 || Session::get('user_id') == 89)
                            <div class="form-group divLinkIndex">
                                <span>Attorneys Report</span>
                                <a href="{{route('attReport')}}">[Here]</a>
                                <a href="{{route('attReport')}}" target="_blank">[New Tab]</a>
                            </div>
                        @endif
                        @if(strpos(Session::get('user_type'), 'fix')!== false)
                            <div class="form-group divLinkIndex">
                                <span>Fix Problems / Tricks</span>
                                <a href="{{route('fix')}}">[Here]</a>
                                <a href="{{route('fix')}}" target="_blank">[New Tab]</a>
                            </div>
                        @endif

                        <div class="form-group divLinkIndex">
                            <span id="spanUser">Logout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{asset("js/common.js")}}"></script>
@endsection

