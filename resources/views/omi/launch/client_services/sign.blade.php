@extends('omi.layout.head')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/bootstrap-datetimepicker.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/css/sign.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/plugins/docusign/assets/jquery.signaturepad.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
@endsection
@if(setlocale(LC_MONETARY, 'en_US.UTF-8'))@endif
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if($document=="trademark_too_descriptive")
                @include('omi.tools.client_services.trademark_too_descriptive')
            @endif
            @if($document=="trademark")
                @include('omi.tools.client_services.trademark_copyright')
            @endif
            @if($document=="ddr")
                @include('omi.tools.client_services.ddrDocusign')
            @endif
            @if($document=="applicationCoverPagePCT")
                @include('omi.tools.client_services.applicationCoverPagePCT')
            @endif
            @if($document=="applicationCoverPageProvisional")
                @include('omi.tools.client_services.applicationCoverPageProvisional')
            @endif
            @if($document=="applicationCoverPageUtility")
                @include('omi.tools.client_services.applicationCoverPageUtility')
            @endif
            @if($document=="ph2AttorneyCoverSheet")
                @include('omi.tools.client_services.ph2AttorneyCoverSheet')
            @endif
            @if($document=="pct_questionnaire")
                @include('omi.tools.client_services.pct_questionnaire')
            @endif
            @if($document=="copyrightQuestionnaire")
                @include('omi.tools.client_services.copyrightQuestionnaire')
            @endif
            @if($document=="agreementPSA")
                @include('omi.tools.client_services.psaDocusign')
            @endif
            @if($document=="declarationU" || $document=="declarationD")
                @include("omi.tools.client_services.declaration",array('document'=>$document))
            @endif
            @if($document=="addDeclarationU" || $document=="addDeclarationD")
                @include("omi.tools.client_services.add_declaration",array('document'=>$document))
            @endif
            @if($document=="poaU" || $document=="poaD")
                @include("omi.tools.client_services.doc_poa",array('document'=>$document))
            @endif
            @if($document=="microEntityU" || $document=="microEntityD" || $document=="microEntityP")
                @include("omi.tools.client_services.doc_microEntity",array('document'=>$document))
            @endif
            @if($document=="upgradePCTEPO")
                @include("omi.tools.client_services.upgradePCTEPO")
            @endif
            @if($document=="upgradePCT")
                @include("omi.tools.client_services.upgradePCT")
            @endif
            @if($document=="provInvoice")
                @include("omi.tools.client_services.provInvoice")
            @endif
            @if($document=="ilc_agreement")
                @include("omi.tools.client_services.ilc")
            @endif
            @if($document=="ilc_release")
                @include("omi.tools.client_services.ilc_release")
            @endif
            @if($document=="trademark_letter")
                @include("omi.tools.client_services.trademark_letter")
            @endif
            @if($document=="PCT_PSA")
                @include("omi.tools.client_services.PCTPSA")
            @endif
            @if($document=="agreementExtension")
                @include("omi.tools.client_services.agreementExtension")
            @endif
            @if($document=="patentedContract")
                @include("omi.tools.ilc.ilc_patented_contract")
            @endif
            <div class="col-md-12 margin-top-20 margin-bottom-20">
                <p align="center">
                    <button class="btn-submit" type="submit" onclick="$('#formSign').submit();">
                        <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>I ACCEPT THE TERMS
                    </button>
                </p>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    {{--<link type="text/css" rel="stylesheet" href="{{ asset('/plugins/jquery/jquery-ui.css') }}"  />--}}
    <script src="{{asset("/js/omi/sign.js")}}"></script>
    <script src="{{asset("/js/omi/client_services.js")}}"></script>
    {{--<script src="{{ asset('/plugins/jquery/jquery-ui.min.js') }}" type="text/javascript"></script>--}}
    <script src="{{asset("/plugins/docusign/jquery.signaturepad.js")}}"></script>
    <script src="{{asset("/plugins/docusign/assets/json2.min.js")}}"></script>
    <script src="{{asset("/plugins/docusign/assets/bezier.js")}}"></script>
    <script src="{{asset("/plugins/docusign/assets/numeric-1.2.6.min.js")}}"></script>
@endsection

