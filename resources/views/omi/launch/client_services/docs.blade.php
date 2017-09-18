@extends('omi.layout.head')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/clientServices.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/bootstrap-datetimepicker.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/css/sign.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/plugins/docusign/assets/jquery.signaturepad.css') }}" rel="stylesheet" type="text/css" >
@endsection
@if(setlocale(LC_MONETARY, 'en_US.UTF-8'))@endif
@section('content')
    <div class="container-fluid">
        @if($project_CS->existReturned())
            <div class="row  panel-primary container-legal-docs">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">Returned Documents</h4>
                </div>
                <div class="panel-body">
                    @foreach($project_CS->getDocsCS() as $docCS)
                        @if($docCS->signdate!="")
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" data-doc = "{{$docCS->document}}" data-id="{{$project_CS->project_id}}"
                                   href="{{route('launch/clientServices/sign',"DOCUMENT=".$docCS->document."&ID=".$project_CS->project_id)}}"
                                   title="Reason: {{$docCS->notes_resend}}"  data-toggle="tooltip" data-placement="bottom"   >
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">{{$docCS->name}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        @if($project_CS->existNoReturned())
            <div class="row panel-primary container-legal-docs">
                <div class="panel-heading heading-docs"> {{--modal-header--}}
                    <h4 class="modal-title subTitlesCS">Documents</h4>
                </div>
                <div class="panel-body">
                    @if($project_CS->getDocsCS()!=null)
                        @foreach($project_CS->getDocsCS() as $docCS)
                            @if($docCS->notes_resend=="" && $docCS->belong_PA != 1)
                                <form method="post" action="{{url('launch/clientServices/sign')}}" name="doc{{$docCS->name}}" id="doc{{$docCS->name}}">
                                    <input type="hidden" name="DOCUMENT" value="{{$docCS->document}}">
                                    <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#doc{{$docCS->name}}').submit();" >{{--href="{{route('launch/clientServices/sign',"DOCUMENT=".$docCS->document."&ID=".$project_CS->project_id)}}"--}}
                                            <div class="visual">
                                                <i class="fa fa-file-text"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <p style="font-size: 80%;">{{$docCS->name}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </form>
                            @endif
                        @endforeach
                    @endif
                    @if($project_CS->agreementExt_sent!="0000-00-00 00:00:00" && $project_CS->agreementExt_rcvd == "0000-00-00 00:00:00")
                        <form method="post" action="{{url('launch/clientServices/sign')}}" name="agreementExt" id="agreementExt">
                            <input type="hidden" name="DOCUMENT" value="agreementExtension">
                            <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#agreementExt').submit();" >
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">AGREEMENT EXTENSION</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        @endif
        @if($docs_signed['type'] != 'NA'&& $project_CS->completed != 2)
            <div class="row panel-primary container-legal-docs" id="appPack">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">Patent Application</h4>
                </div>
                <div class="panel-body">
                    @if($docs_signed['dec'] == -1)
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <form method="post" action="{{url('launch/clientServices/sign')}}" name="docDec" id="docDec">
                                <input type="hidden" name="DOCUMENT"
                                @if($docs_signed['type']=='PAU')
                                       value="declarationU"
                                        @elseif($docs_signed['type']=='PAD')
                                       value="declarationD"
                                        @endif>
                                <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                <a class="dashboard-stat dashboard-stat-light blue-soft"  onclick="$('#docDec').submit();"> {{--href="{{route('launch/clientServices/sign',"DOCUMENT=declaration&ID=".$project_CS->project_id)}}"--}}
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">Declaration</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    @endif
                    @if($coInvCount>0 && $docs_signed['add_dec'] == -1)
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <form method="post" action="{{url('launch/clientServices/sign')}}" name="docAddDec" id="docAddDec">
                                <input type="hidden" name="DOCUMENT"
                                @if($docs_signed['type']=='PAU')
                                       value="addDeclarationU"
                                        @elseif($docs_signed['type']=='PAD')
                                       value="addDeclarationD"
                                       @endif
                                       value="">
                                <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                <a class="dashboard-stat dashboard-stat-light blue-soft"  onclick="$('#docAddDec').submit();"> {{--href="{{route('launch/clientServices/sign',"DOCUMENT=add_declaration&ID=".$project_CS->project_id)}}"--}}
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">Additional Declaration</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    @endif
                    @if($docs_signed['poa'] == -1)
                        @if(!File::exists("files/projects/".$client->fileno."/signature_poa.jpg"))
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <form method="post" action="{{url('launch/clientServices/sign')}}" name="docPOA" id="docPOA">
                                    <input type="hidden" name="DOCUMENT"
                                    @if($docs_signed['type']=='PAU')
                                           value="poaU"
                                            @elseif($docs_signed['type']=='PAD')
                                           value="poaD"
                                           @endif
                                           value="">
                                    <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                    <input type="hidden" name="COINVINDEX" value="0">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPOA').submit();"> {{-- href="{{route('launch/clientServices/sign',"DOCUMENT=poa&ID=".$project_CS->project_id)}}"--}}
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">POA</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        @endif
                        @for($i=1;$i<$coInvCount+1;$i++) {{--empiezo en 1 pq el 0 es el inventor principal--}}
                        @if(!File::exists("files/projects/".$client->fileno."/signature_poa_coInv".$i.".jpg"))
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <form method="post" action="{{url('launch/clientServices/sign')}}" name="docPOACoInv_{{$i}}" id="docPOACoInv_{{$i}}">
                                    <input type="hidden" name="DOCUMENT"
                                    @if($docs_signed['type']=='PAU')
                                           value="poaU"
                                            @elseif($docs_signed['type']=='PAD')
                                           value="poaD"
                                            @endif>
                                    <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                    <input type="hidden" name="COINVINDEX" value="{{$i}}">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPOACoInv_{{$i}}').submit();"> {{-- href="{{route('launch/clientServices/sign',"DOCUMENT=poa&ID=".$project_CS->project_id)}}"--}}
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">POA {{$coInvs[$i-1]}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        @endif
                        @endfor
                    @endif
                    @if($docs_signed['microEntity'] == -1)
                        @if(!File::exists("files/projects/".$client->fileno."/signature_mE.jpg"))
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <form method="post" action="{{url('launch/clientServices/sign')}}" id="docMEntity">
                                    <input type="hidden" name="DOCUMENT"
                                    @if($docs_signed['type']=='PAU')
                                           value="microEntityU"
                                            @elseif($docs_signed['type']=='PAD')
                                           value="microEntityD"
                                            @elseif($docs_signed['type']=='PROV')
                                           value="microEntityP"
                                            @endif>
                                    <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                    <input type="hidden" name="COINVINDEX" value="0">
                                    <span style="cursor: pointer;" class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docMEntity').submit();" >{{--data-formid="docMEntity"   href="{{route('launch/clientServices/sign',"DOCUMENT=microEntity&ID=".$project_CS->project_id)}}"--}}
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">Micro Entity</p>
                                            </div>
                                        </div>
                                    </span>
                                </form>
                            </div>
                        @endif
                        @for($i=1;$i<$coInvCount+1;$i++) {{--empiezo en 1 pq el 0 es el inventor principal--}}
                        @if(!File::exists("files/projects/".$client->fileno."/signature_mE_coInv".$i.".jpg"))
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <form method="post" action="{{url('launch/clientServices/sign')}}" name="docMECoInv_{{$i}}" id="docMECoInv_{{$i}}">
                                    <input type="hidden" name="DOCUMENT"
                                    @if($docs_signed['type']=='PAU')
                                           value="microEntityU"
                                            @elseif($docs_signed['type']=='PAD')
                                           value="microEntityD"
                                            @elseif($docs_signed['type']=='PROV')
                                           value="microEntityP"
                                            @endif>
                                    <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                    <input type="hidden" name="COINVINDEX" value="{{$i}}">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docMECoInv_{{$i}}').submit();" > {{--data-formid="docMECoInv_{{$i}}"--}}
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">Micro Entity {{$coInvs[$i-1]}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        @endif
                        @endfor
                    @endif
                    {{--esta condicion sta x si es renviando el patent app package--}}
                    @if($project_CS->appSent_created_at!="" && $project_CS->patentAppApproved_created_at == "" || $project_CS->appSentD_created_at!="0000-00-00 00:00:00" && $project_CS->patentAppApprovedD_created_at == "0000-00-00 00:00:00")
                        <div class="col-md-9" id="patent_app_docs" style="border: 1px solid black;padding-left: 0px !important;padding-right: 0px !important;padding-top: 10px !important;">
                            @foreach($urlsPA as $urlPA)
                                <a class="dashboard-stat dashboard-stat-light blue-soft col-md-4"
                                   href="{{$urlPA}}" target="_blank" style="margin-left: 20px;">
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 70%;">Patent Application Docs</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <div class="col-md-2">
                                <a class="fa fa-check-circle-o fa-3x patent-app-up hvr-grow " style="line-height: 50px !important;margin-left: 20px;" aria-hidden="true" data-prop="{{$allDocsSigned}}" data-type="{{$docs_signed['type']}}" data-id="{{$project_CS->project_id}}" href="#"></a>
                                <br>
                                <a class="fa fa-times-circle-o fa-3x patent-app-down hvr-grow " style="line-height: 50px !important;margin-left: 20px;" aria-hidden="true" data-type="{{$docs_signed['type']}}" data-id="{{$project_CS->project_id}}" href="#"></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        @if($upLetterSign  == 1 || $provInvoiceSign == 1 || $upgLetterPCTSign  == 1 || $pctPSASign == 1)
            <div class="row panel-primary container-legal-docs">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">PCT/EPO-----------Provisional Invoice</h4>
                </div>
                <div class="panel-body">
                    @if($upLetterSign  == 1)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="post" action="{{url('launch/clientServices/sign')}}" name="docPCTEPO" id="docPCTEPO">
                                <input type="hidden" name="DOCUMENT" value="upgradePCTEPO">
                                <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPCTEPO').submit();">{{-- data-doc = "upgradePCTEPO" data-id="{{$project_CS->project_id}}"  href="{{route('launch/clientServices/sign',['DOCUMENT'=>'upgradePCTEPO', 'ID'=>$project_CS->project_id])}}"--}}
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">PCT/EPO</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    @endif
                    @if($upgLetterPCTSign  == 1)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="post" action="{{url('launch/clientServices/sign')}}" name="docPCT" id="docPCT">
                                <input type="hidden" name="DOCUMENT" value="upgradePCT">
                                <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPCT').submit();">
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">PCT</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    @endif
                    @if($provInvoiceSign  == 1)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="post" action="{{url('launch/clientServices/sign')}}" name="docProvInv" id="docProvInv">
                                <input type="hidden" name="DOCUMENT" value="provInvoice">
                                <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docProvInv').submit();">{{--href="{{route('launch/clientServices/sign',"DOCUMENT=provInvoice&ID=".$project_CS->project_id)}}"--}}
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">Provisional<br> Invoice</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    @endif
                    @if($pctPSASign  == 1)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="post" action="{{url('launch/clientServices/sign')}}" onsubmit="return pctPsaSign();" name="docPCTPSA" id="docPCTPSA">
                                <input type="hidden" name="DOCUMENT" value="PCT_PSA">
                                <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docPCTPSA').submit();">
                                    <div class="visual">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <p style="font-size: 80%;">PCT PSA</p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        @if($ilcNeedSign == 1 || $ilcPatentedC == 1)
            <div class="row panel-primary container-legal-docs">
                <div class="panel-heading heading-docs">
                    <h4 class="modal-title subTitlesCS">ILC</h4>
                </div>
                <div class="panel-body">
                    @if($ilcNeedSign == 1)
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <h5>Release ILC from any obligation</h5>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        @if($ilcNeedSign == 1)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <form method="post" action="{{url('launch/clientServices/sign')}}" name="docILC" id="docILC">
                                    <input type="hidden" name="DOCUMENT" value="ilc_agreement">
                                    <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docILC').submit();">{{--href="{{route('launch/clientServices/sign',"DOCUMENT=ilc_agreement&ID=".$project_CS->project_id)}}"--}}
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">ILC</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <form method="post" action="{{url('launch/clientServices/sign')}}" name="docReleaseForm" id="docReleaseForm">
                                    <input type="hidden" name="DOCUMENT" value="ilc_release">
                                    <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#docReleaseForm').submit();">{{--href="{{route('launch/clientServices/sign',"DOCUMENT=ilc_release&ID=".$project_CS->project_id)}}"--}}
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">Release Form</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        @endif
                        @if($ilcPatentedC == 1)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <form method="post" action="{{url('launch/clientServices/sign')}}" name="patentedContract" id="patentedContract">
                                    <input type="hidden" name="DOCUMENT" value="patentedContract">
                                    <input type="hidden" name="ID" value="{{$project_CS->project_id}}">
                                    <a class="dashboard-stat dashboard-stat-light blue-soft" onclick="$('#patentedContract').submit();" >
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <p style="font-size: 80%;">ILC PATENTED CONTRACT</p>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('footer_scripts')
    <script src="{{asset("/js/omi/sign.js")}}"></script>
    <script src="{{asset("/plugins/docusign/jquery.signaturepad.js")}}"></script>
    <script src="{{asset("/plugins/docusign/assets/json2.min.js")}}"></script>
@endsection

