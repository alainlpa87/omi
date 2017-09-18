@extends('intranet.layouts.default')
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/clientServices.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/buttons.dataTables.min.css')}}" rel="stylesheet"/>
@endsection
@include('intranet.layouts.mobile')
@section('content')

    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-2 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <div class="col-md-12 col-xs-6 noPadding">
                        <select id="trainingDocs">
                            <option value="0">--Training--</option>
                            <option value="{{url("training/Lead_training_Screen_.png")}}">Lead training</option>
                            <option value="{{url("training/Project View.png")}}">Project View</option>
                            <option value="{{url("training/Sandbox.swf")}}">Sandbox</option>
                            <option value="{{url("training/Set_up.swf")}}">Set up</option>
                            <option value="{{url("training/set_voicemail.swf")}}">Set voicemail</option>
                            <option value="{{url("training/contract process_PC.pdf")}}">Signing the contract-PC</option>
                            <option value="{{url("training/contract process_Mobile.pdf")}}">Signing the contract-Mobile</option>
                            <option value="{{url("training/Proof_of_Patent_Search_Cost.JPG")}}">Proof of Patent Search Cost</option>
                            <option value="{{url("training/Proof_of_AIPLA_2015_Report.pdf")}}">Proof of AIPLA 2015 Report</option>
                            <option value="{{url("training/Patent_Attorney_Info.pdf")}}">Patent Attorney Info</option>
                            <option value="{{url("training/Rough_Patent_Search.pdf")}}">Rough Patent Search(Example).pdf</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="page-container">
                <div class="leadroll">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="portlet box green">
                                <div class="portlet-title" style="background-color: #35aa47;height: 40px !important;">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>RECORDINGS
                                    </div>
                                </div>
                                <div class="portlet-body container-charts">
                                    <div class="table-scrollable" style="width: 100% !important;">
                                        <table id="tableDataStats" class="table table-striped table-bordered" cellspacing="0" >
                                            <thead id="tableDataHead">
                                            <tr>
                                                <td style="width: 5%;"><strong> <span class="label label-sm label-info" title=""></span></strong></td>
                                                <td style="width: 10%;"><strong> <span class="label label-sm label-info" title=""></span></strong></td>
                                                <td style="width: 15%;"><strong>CONSULTANT</strong></td>
                                                <td style="width: 35%;">Description</td>
                                                <td style="width: 10%;"><strong> <span class="label label-sm label-info" title="">FILENO</span></strong></td>
                                                <td style="width: 15%;text-align: center"><strong> <span class="label label-sm label-warning" title="">STAMP</span></strong></td>
                                                @if($rolLibrary == 1)
                                                    <td style="width: 10%;text-align: center"><strong> <span class="label label-sm label-warning" title="">Library</span></strong></td>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody id="tableDataBodyStats">
                                            @for($i=0;$i<count($records);$i++)
                                                <tr id="{{$records[$i]->id}}">
                                                    <td>{{$i+1}}</td>
                                                    <td>
                                                       <div>
                                                           @if($rolLibrary == 1)
                                                               <i class="fa fa-ban deleteCall" aria-hidden="true" data-id="{{$records[$i]->id}}" style="margin-right: 20px;"></i>
                                                           @endif
                                                           <i class="fa fa-phone recordCallId" data-id="{{$records[$i]->id}}"></i> <i class="fa fa-play recordUrl" style="display: inline !important;margin-left: 10px;" data-url="{{$records[$i]->url}}"></i>
                                                       </div>
                                                    </td>
                                                    <td>
                                                        {{ucwords($records[$i]->consultant->usr)}}
                                                    </td>
                                                    <td>
                                                        @if($rolLibrary == 1)
                                                            <input type="text" class="setDescription" id="description_{{$records[$i]->id}}" data-id="{{$records[$i]->id}}" value="{{$records[$i]->description}}">
                                                        @else
                                                            <label style="width:100%;">{{$records[$i]->description}}</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($records[$i]->lead != null)
                                                            {{$records[$i]->lead->fileno}}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center">
                                                        {{date('m-d-Y',strtotime($records[$i]->created_at))}}
                                                    </td>
                                                    @if($rolLibrary == 1)
                                                        <td>
                                                            <input type="checkbox" class="checkLibrary" name="library" id="library_{{$records[$i]->id}}" data-id="{{$records[$i]->id}}"  @if($records[$i]->library)checked="checked"@endif>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(setlocale(LC_MONETARY, 'en_US.UTF-8'))@endif
    @include('intranet.tools.iframePrint')

@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/recordCalls.js")}}"></script>
    {{--upload file--}}
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>

    <script src="{{asset("/plugins/bootstrap/moment.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
    <script src="{{asset("js/attDetails.js")}}"></script>
@endsection
