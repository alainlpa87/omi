@extends('intranet.layouts.default')
@section('title')
    Manufacturers
@endsection
@section('header_styles')
    <link href="{{ asset('/css/report.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/uploadFile.css') }}" rel="stylesheet">
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
        <div class="rowTop col-md-12 col-lg-12">
            <div class="col-md-2 col-xs-12 col-lg-2 container-tools-left ">
                <div class="container-dialer">
                    <div class="col-md-12 col-lg-12">
                        <button class="btn btn-default btnCreateManufacturer padding5" style="width: 100%;margin-left: 15px !important;" id="btnCreateManufacturer"><i class="fa fa-plus"></i> Create Manufacturer</button>
                    </div>
                </div>
            </div>
            {{--<div class="col-md-2 col-xs-12 container-tools-right">--}}
            {{--</div>--}}
            {{--Container of all the portlets--}}
            <div class="col-md-12  col-xs-12 col-lg-12 col-lg-pull-3 col-md-pull-3 container-portlets" style="margin-top: 40px !important;">
                <div class="table-scrollable" style="width: 100% !important;">
                    <table id="tableDataManufacturer" class="table table-striped table-bordered" cellspacing="0" >
                        <thead id="tableDataHeadManufacturer">
                        <tr>
                            {{--<td style="width: 5%;" align="center"><strong> <span class="label label-sm label-info" title=""></span></strong></td>--}}
                            <td align="center"><strong>NAME</strong></td>
                            <td  align="center">INDUSTRY</td>
                            <td  align="center">EMAIL</td>
                            <td  align="center">PHONE</td>
                            <td  align="center">CONTACT NAME</td>
                            <td  align="center">CONTACT LNAME</td>
                            <td  align="center"><strong>ILC NDA SIGN</strong></td>
                            <td  align="center"><strong>WEBSITE NDA SIGN</strong></td>
                            <td  align="center"><strong>MANF NDA</strong></td>
                            <td  align="center"><strong>CT SIGN MANF NDA</strong></td>
                            <td  align="center"><strong>WANT'S NO NDA</strong></td>
                            <td  align="center"><strong> <span class="label label-sm label-info" title=""></span>ACTIONS</strong></td>
                        </tr>
                        </thead>
                        <tbody id="tableDataBodyManufacturer">
                        @for($i=0;$i<count($manufacturers);$i++)
                            <tr class="rd" id="rowManufacturer_{{$manufacturers[$i]->id}}">
                                {{--<td class="hidden" align="center">{{$i+1}}</td>--}}
                                <td align="center" style="padding: 0px !important;">
                                   <span id="manfName_{{$manufacturers[$i]->id}}"> {{ucwords($manufacturers[$i]->name)}} </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    @foreach($industries as $industry)
                                        @if($manufacturers[$i]->industry_id == $industry->id)
                                            <span id="indType_{{$manufacturers[$i]->id}}"> {{$industry->type}} </span>
                                        @endif
                                    @endforeach
                                </td>
                                <td align="center" style="padding: 2px !important;">
                                    <span id="manfEmail_{{$manufacturers[$i]->id}}"> {{$manufacturers[$i]->email}} </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfPhone_{{$manufacturers[$i]->id}}"> {{$manufacturers[$i]->phone}} </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfFName_{{$manufacturers[$i]->id}}"> {{ucwords($manufacturers[$i]->fname)}} </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfLName_{{$manufacturers[$i]->id}}"> {{ucwords($manufacturers[$i]->lname)}} </span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="ndaSign_{{$manufacturers[$i]->id}}"> {{$manufacturers[$i]->ndaSign == 1? 'YES' : 'NO'}}</span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="hasNda_{{$manufacturers[$i]->id}}"> {{$manufacturers[$i]->hasNda == 1? 'YES' : 'NO'}}</span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfNda_{{$manufacturers[$i]->id}}"> {{$manufacturers[$i]->manfNda == 1? 'YES' : 'NO'}}</span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="cSignManfNda_{{$manufacturers[$i]->id}}"> {{$manufacturers[$i]->cSignManfNda == 1? 'YES' : 'NO'}}</span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <span id="manfNoNda_{{$manufacturers[$i]->id}}"> {{$manufacturers[$i]->manfNoNda == 1? 'YES' : 'NO'}}</span>
                                </td>
                                <td align="center" style="padding: 0px !important;">
                                    <i class="fa fa-folder-open loadManufacturerFiles" title="Load Files" style="color: lightskyblue;margin-left: 7px;cursor: pointer;" data-id="{{$manufacturers[$i]->id}}"></i>
                                    <i class="fa fa-upload uploadManufacturerFile" title="Upload File" style="color: lightskyblue;margin-left: 7px;cursor: pointer;" data-id="{{$manufacturers[$i]->id}}"></i>
                                    <i class="fa fa-edit editManufacturer" title="Edit Manufacturer" style="color: orange;margin-left: 7px;cursor: pointer;" data-id="{{$manufacturers[$i]->id}}"></i>
                                    <i class="fa fa-file-text showModalCreateNote" title="Notes" style="color: orange;margin-left: 7px;cursor: pointer;" data-id="{{$manufacturers[$i]->id}}"></i>
                                    <i class="fa fa-times-circle-o deleteManufacturer" title="Remove Manufacturer" style="display: inline !important;margin-left: 7px;color: red;cursor: pointer;" data-id="{{$manufacturers[$i]->id}}"></i>
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--include Modal Appointment--}}
    @include('intranet.ILC.tools.createManufacturerModal')
    @include('intranet.ILC.tools.manufacturerNotesModal')
    @include('intranet.tools.UploadFileModal')
    @include('intranet.ILC.tools.ILCFilesModal')
@endsection
@section('footer_scripts')
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/manufacturer.js")}}"></script>
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>
    <script src="{{asset("js/uploadFile/uploadFileManufacturer.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
@endsection
