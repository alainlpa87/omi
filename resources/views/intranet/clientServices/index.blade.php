@extends('intranet.layouts.default')
@section('title')
    Client Services View
@endsection
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/clientServices.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/uploadFile.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection
@include('intranet.layouts.mobile')
@section('content')

    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    @include('intranet.tools.loadingModal')
    @include('intranet.admin.tools.adminLoadingModal')
    @if(setlocale(LC_MONETARY, 'en_US.UTF-8'))@endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-12 container-tools-left">
                <a href="{{url('files/omi/Online_Tutorial.pdf ')}}" target="_blank">Dialer Tutorial</a>
                <br><br><br>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a  href="{{url('reportAtt?ATT=53')}}" target="_blank" class="actionQuestions">
                                <p class="boxAttorney">
                                    Total projects sent to mike_attorney: <span>{{$arrayAtt["total_MIKE"]}}</span><br>
                                    Prov sent: <span>{{$arrayAtt["countProv_MIKE"]}}</span><br>
                                    Utility sent: <span>{{$arrayAtt["countU_MK"]}}</span><br>
                                    Design sent: <span>{{$arrayAtt["countU_D_MIKE"]}}</span><br>
                                    Details :
                                </p>
                            </a>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a href="{{url('reportAtt?ATT=34')}}" target="_blank" class="actionQuestions">
                                <p class="boxAttorney">Total projects sent to jh_attorney: <span>{{$arrayAtt["total_JH"]}}</span><br>
                                    Prov sent: <span>{{$arrayAtt["countProv_JH"]}}</span><br>
                                    Utility sent: <span>{{$arrayAtt["countU_JH"]}}</span><br>
                                    Design sent: <span>{{$arrayAtt["countU_D_JH"]}}</span><br>
                                    Details :
                                </p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xs-1 noPadding">
                    <button class="btn btn-default btnAppointment padding5" id="btnAppointment"><i class="fa fa-calendar"></i> Create New Task</button>
                </div>
                <div class="col-md-12 col-xs-1 noPadding">
                    <button class="btn btn-primary showTicketsView" id="showTicketsAdmin">MANAGE TICKETS</button>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12">
                    <input type="text" class="editableval" id="inputFindSub" placeholder="FIND SUB" style="width: {{WHO_IS_WIDTH}}px;">
                </div>
                <br><br><br><br>
                <div class="col-md-12 divSelectOptionAdmin">
                    <select  id="selectOptionClientS" style="width: 170px;">
                        <option value="0">{{SELECT_ACTION}}</option>
                        <option value="ttry">WE TRY TO REACH YOU</option>
                        <option value="tm-letter">SEND TRADEMARK LETTER</option>
                        <option value="ATT_COVERSHEET">SEND COVERSHEET TO ATTORNEY</option>
                        <option value="UPG_COVERSHEET">SEND UPGRADE COVERSHEET TO ATTORNEY</option>
                        <option value="ILC_COVERSHEET">SEND ILC COVERSHEET</option>
                        <option value="TM_COVERSHEET">SEND TRADEMARK COVERSHEET</option>
                        <option value="CR_COVERSHEET">SEND COPYRIGHT COVERSHEET</option>
                        <option value="TR_ALLOWANCE">SEND TRADEMARK NOTICE OF ALLOWANCE</option>
                        <option value="TR_OFFICE_ACTION">SEND TRADEMARK OFFICE ACTION</option>
                        <option value="NON_F_OFFICE_ACTION">SEND NON FINAL OFFICE ACTION</option>
                        <option value="F_OFFICE_ACTION">SEND FINAL OFFICE ACTION</option>
                        <option value="NOTICE_OF_ALLOWANCE">SEND NOTICE OF ALLOWANCE(PATENT)</option>
                        {{--<option value="pct-quest">SEND PCT AGREEMENT</option>--}}
                        <option value="pct-quest">SEND PCT APPLICATION</option>
                        {{--<option value="PCT_AGREEMENT">SEND PCT FILING RECEIPT</option>--}}
                        <option value="PCT_APP">SEND PCT FILING RECEIPT</option>
                        <option value="REVISION_ATT">SEND REVISION TO ATTORNEY</option>
                        <option value="EMAIL_CLIENT">SEND EMAIL TO CLIENT</option>
                        <option value="EMAIL_VENDOR">SEND EMAIL TO VENDOR</option>
                    </select>
                </div>
                <div class="clear"></div>
                <h5 class="last15Title">Last 15</h5>
                <div class="col-md-12 col-xs-12 container-last"></div>
            </div>

            {{--Container of all the portlets--}}
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseNewCS" class="actionQuestions">
                                <h4 class="panel-title titleContainers">
                                    New Projects
                                </h4>
                            </a>
                        </div>
                        <div id="collapseNewCS" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-new">
                                    @if($projectsNew = $allPCS->where('completed',0))@endif
                                    @foreach ($projectsNew as $projectClientS)
                                        @if($project = $projectClientS->project)@endif
                                        @include('intranet.clientServices.portlet')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseProcessCS" class="actionQuestions">
                                <h4 class="panel-title titleContainers">
                                    In Process Projects
                                </h4>
                            </a>
                        </div>
                        <div id="collapseProcessCS" class="panel-collapse collapse in">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-process">
                                    @if($projectsProcc = $allPCS->where('completed',1))@endif
                                    @foreach ($projectsProcc as $projectClientS)
                                        @if($project = $projectClientS->project)@endif
                                        @include('intranet.clientServices.portlet')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseReturnedCS" class="actionQuestions">
                                <h4 class="panel-title titleContainers">
                                    Returned Projects
                                </h4>
                            </a>
                        </div>
                        <div id="collapseReturnedCS" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-returned">
                                    @if($projectsReturned = $allPCS->where('completed',2))@endif
                                    @foreach ($projectsReturned as $projectClientS)
                                        @if($project = $projectClientS->project)@endif
                                        @include('intranet.clientServices.portlet')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading backBlue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOverdueCS">
                                <h4 class="panel-title titleContainers">
                                    Overdue Projects
                                </h4>
                            </a>
                        </div>
                        <div id="collapseOverdueCS" class="panel-collapse collapse">
                            <div class="panel-body borderBlue">
                                <div class="container-portlets-overdue">
                                    @if($projectsLate = $allPCS->where('completed',3))@endif
                                    @foreach ($projectsLate as $projectClientS)
                                        @if($project = $projectClientS->project)@endif
                                        @include('intranet.clientServices.portlet')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
        </div>
    </div>

    @include('intranet.tools.appointmentModal')
    @include('intranet.admin.tools.adminLoadingModal')
    @include('intranet.tools.iframePrint')
    @include('intranet.tools.UploadFileModal')
    @include('intranet.clientServices.tools.clientServicesFilesModal')
    @include('intranet.clientServices.tools.resendLegalDocsModal')
    @include('intranet.clientServices.tools.whoIsThisModal')
    @include('intranet.clientServices.tools.reminderPCTEPOModal')
    @include('intranet.clientServices.tools.csNotesModal')
    @include('intranet.clientServices.tools.filingRFilesModal')
    @include('intranet.clientServices.tools.legalMaintenanceModal')
    @include('intranet.clientServices.tools.selectFilesModal')
    @include('omi.tools.recoverPsswdModal')
    @include('intranet.tools.selectFilesToAttachModal')
    @include('intranet.clientServices.tools.designCoversheetModal')
    @include('intranet.clientServices.tools.upgCoversheetToAttModal')
    @include('intranet.clientServices.tools.emailCSModal')
    @include('intranet.tools.emailToVendorsModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/clientservices.js")}}"></script>
    {{--upload file--}}
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>
    <script src="{{asset("js/uploadFile/uploadFileClientServices.js")}}"></script>

    <script src="{{asset("/plugins/bootstrap/moment.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
@endsection
