@extends('intranet.layouts.default')
@section('title')
    ILC View
@endsection
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/uploadFile.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/clientServices.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection
@include('intranet.layouts.mobile')
@section('content')

    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    @include('intranet.tools.loadingModal')

    <div class="container-fluid">
        <input type="hidden" data-pending="{{$pending}}" id="pending_ilc">
        <div class="row">
            {{--<div class="col-md-2 col-xs-12 container-tools-left">--}}
                {{--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="openCodesModal" data-target="#ilcCodesModal">Open Modal</button>--}}
            {{--</div>--}}

            <div class="col-md-2 col-xs-12 container-tools-right">
                <div class="col-md-12 divSelectOptionAdmin">
                    <select  id="selectOptionILC" style="width: 170px;">
                        <option value="0">{{SELECT_ACTION}}</option>
                        <option value="intro_pkg">SEND WELCOME PCKG</option>
                        <option value="intro_call_email">INTRO CALL EMAIL</option>
                        <option value="courtesy">SEND COURTESY UPDATE</option>
                        <option value="nda_to_manf">SEND ILC NDA TO MANF</option>
                        <option value="nda_to_client">SEND MANF NDA TO CT</option>
                        <option value="submission">SEND SUBMISSION TO MANF</option>
                        <option value="decline_email">CT REFUSES MANF NDA</option>
                        <option value="after_graphic"> AFTER GRAPHIC IS SENT TO VENDOR</option>
                        <option value="patented_contract">SEND ILC PATENTED CONTRACT</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <select  id="selectSeparationLetter" style="width: 170px;margin-top: 15px;">
                        <option value="0">SEPARATION_LETTER</option>
                        <option value="abandoned">SEND UTILITY ABANDONED LETTER</option>
                        <option value="client_request">SEND CLIENT REQUEST LETTER</option>
                        <option value="provisional">SEND PROVISIONAL LETTER</option>
                        <option value="utility">SEND UTILITY LETTER</option>
                    </select>
                </div>
                <div class="col-md-12 divNDAActions" style="margin-top: 15px;">
                    <button class="btn btn-primary" id="openNDAAction">NDA ACTIONS</button>
                </div>
                <div class="col-md-12" style="margin-top: 15px;">
                    <button class="btn btn-primary" id="emToCTBtn">SEND EMAIL TO CLIENT</button>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <button class="btn btn-primary" id="showPendingIntroCall">TODAY NOTIFICACION'S</button>
                </div>
            </div>

            {{--Container of all the portlets--}}
            <div class="col-md-10 col-xs-12 col-lg-10 container-table">
                {{--@foreach ($projectsILC as $projectilc)--}}
                    {{--@if($project = $projectilc->projectclientservices->project)@endif--}}
                    {{--@include('intranet.ILC.portlet')--}}
                {{--@endforeach--}}
                    <div class="table-scrollable" style="width: 100% !important;">
                        <table id="tableDataIlc" class="table table-striped table-bordered" cellspacing="0" >
                            <thead id="tableDataHeadIlc">
                            <tr>
                                <td align="center"><strong style="cursor:pointer;"> <span class="label label-sm label-info" title=""></span></strong></td>
                                <td align="center"><strong style="cursor:pointer;"><span class="label label-sm label-info" title="">FILENO</span></strong></td>
                                <td align="center"><strong style="cursor:pointer;">CLIENT NAME</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> COORDINATOR</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> PATENT STATUS</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> IDEA NAME</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> PPA TYPE</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> INDUSTRY</strong></td>
                                <td align="center"><strong style="cursor:pointer;"> APP NO</strong></td>
                                <td align="center" class="hidden"><strong> MANUFACTURERS</strong></td>
                                <td align="center" class="hidden"><strong> TRADE SHOWS CALL</strong></td>
                                <td align="center" class="hidden"><strong> PHONE</strong></td>
                            </tr>
                            </thead>
                            <tbody id="tableDataBodyIlc">
                            @for($i=0;$i<count($projectsILC);$i++)
                                <tr class="rd" id="rowIlc_{{$projectsILC[$i]->id}}">
                                    <td align="center">
                                        <input type="checkbox" class="selectIlc pull-left" id="selectIlc_{{$projectsILC[$i]->id}}" data-id="{{$projectsILC[$i]->projectclientservices->project->id}}" data-iid="{{$projectsILC[$i]->id}}">
                                    </td>
                                    <td align="center">
                                        <span id="ilc_FileNo_{{$projectsILC[$i]->id}}"><span data-id="{{$projectsILC[$i]->id}}" data-pid="{{$projectsILC[$i]->projectclientservices->project->id}}" class="openIlcPortlet" style="text-decoration: underline;color: #0000CC;cursor: pointer;">{{($projectsILC[$i]->fileno)}}</span></span>
                                    </td>
                                    <td align="center">
                                        <span id="ilc_clientName_{{$projectsILC[$i]->id}}"> {{ucwords($projectsILC[$i]->invFname." ".$projectsILC[$i]->invLname)}}</span>
                                    </td>
                                    <td align="center">
                                       <span id="ilc_coordinator_{{$projectsILC[$i]->id}}" style="cursor: pointer;color: blue;" class="selCoord" data-iid="{{$projectsILC[$i]->id}}" data-val="{{$projectsILC[$i]->coordinator}}">@if($projectsILC[$i]->coordinator!=''){{ $projectsILC[$i]->coordinator}}@else - @endif</span>
                                    </td>
                                    <td align="center">
                                        <span id="ilc_patentStatus_{{$projectsILC[$i]->id}}" style="cursor: pointer;color: blue;" class="selPStatus" data-iid="{{$projectsILC[$i]->id}}" data-pid="{{$projectsILC[$i]->projectclientservices->project->id}}" data-val="{{$projectsILC[$i]->patent_status}}">@if($projectsILC[$i]->patent_status!=''){{ $projectsILC[$i]->patent_status}}@else Select Patent Status @endif </span>
                                    </td>
                                    <td align="center">
                                        <span id="ilc_ideaName_{{$projectsILC[$i]->id}}"> {{$projectsILC[$i]->inventionName}}</span>
                                    </td>
                                    <td align="center">
                                        <span id="ilc_ppaType_{{$projectsILC[$i]->id}}">
                                            @if($projectsILC[$i]->projectclientservices->hasType("D"))
                                                Utilt & Design
                                            @elseif($projectsILC[$i]->projectclientservices->hasType("UT") || $projectsILC[$i]->projectclientservices->hasType("UPG_UT"))
                                                Utility
                                            @elseif($projectsILC[$i]->projectclientservices->hasType("PROV"))
                                                @if($projectsILC[$i]->projectclientservices->project->utility == 'IMG')
                                                    Provisional IMG
                                                @else
                                                    Provisional
                                                @endif
                                            @endif
                                        </span>
                                    </td>
                                    <td align="center" id="indType_{{$projectsILC[$i]->id}}">
                                        @foreach($industries as $industry)
                                            @if($projectsILC[$i]->industry_id == $industry->id)
                                                <span> {{$industry->type}} </span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td align="center">
                                        <span id="ilc_appNo_{{$projectsILC[$i]->id}}">{{$projectsILC[$i]->projectclientservices->patentAppNo}} </span>
                                    </td>
                                    <td class="hidden" id="manufacturersList_{{$projectsILC[$i]->id}}">
                                        @foreach($projectsILC[$i]->manufacturers as $manufacturer)
                                            <span >{{$manufacturer->name}} </span>
                                        @endforeach
                                    </td>
                                    <td class="hidden" id="tradeshowsCall_{{$projectsILC[$i]->id}}">
                                        @if($projectsILC[$i]->callTradeshow == 1)
                                            <span>Trade Shows Call</span>
                                        @endif
                                    </td>
                                    <td class="hidden" id="tradeshowsCall_{{$projectsILC[$i]->id}}">
                                        <span>{{$projectsILC[$i]->phone}}</span>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-3 container-portlets-found" style="display: none;">
                <div class="close-portlets-found">X</div>
                <div class="container-added-portlets"></div>
            </div>
        </div>
    </div>

    @include('intranet.tools.iframePrint')
    @include('intranet.tools.UploadFileModal')
    @include('intranet.ILC.tools.ILCFilesModal')
    @include('intranet.ILC.tools.whoIsThisModal')
    @include('intranet.ILC.tools.ilcCodesModal')
    @include('intranet.ILC.tools.ilcNotesModal')
    @include('intranet.ILC.tools.ndaTextModal')
    @include('intranet.ILC.tools.submissionEmailModal')
    @include('intranet.ILC.tools.ilcPortletModal')
    @include('intranet.ILC.tools.courtesyModal')
    @include('intranet.ILC.tools.declineEmailModal')
    @include('intranet.ILC.tools.ndaActionsModal')
    @include('intranet.ILC.tools.selectCoordinatorModal')
    @include('intranet.ILC.tools.selectPatentStatusModal')
    @include('intranet.ILC.tools.emailILCModal')
    @include('intranet.ILC.tools.afterGraphicModal')
    @include('intranet.ILC.tools.introCallEmailModal')
    @include('intranet.ILC.tools.patentedContractEmailModal')
    @include('intranet.ILC.tools.ilcVendorModal')
    @include('intranet.ILC.tools.filesBackToVendorModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/ilc.js")}}"></script>
    {{--upload file--}}
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>
    <script src="{{asset("js/uploadFile/uploadFileILC.js")}}"></script>

    <script src="{{asset("/plugins/bootstrap/moment.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
@endsection
