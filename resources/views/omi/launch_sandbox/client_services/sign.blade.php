@extends('omi.layout.headSandbox')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/bootstrap-datetimepicker.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/css/sign.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/plugins/docusign/assets/jquery.signaturepad.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('/css/pdf_client.css') }}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">--}}
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
                @include('omi.tools.client_services.ddr')
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
                @include('omi.tools.client_services.agreementPSA')
            @endif
            @if($document=="declaration")
                @include("omi.tools.client_services.declaration")
            @endif
            @if($document=="add_declaration")
                @include("omi.tools.client_services.add_declaration")
            @endif
            @if($document=="poa")
                @include("omi.tools.client_services.doc_poa")
            @endif
            @if($document=="microEntity")
                @include("omi.tools.client_services.doc_microEntity")
            @endif
            @if($document=="upgradePCTEPO")
                @include("omi.tools.client_services.upgradePCTEPO")
            @endif
            @if($document=="provInvoice")
                @include("omi.tools.client_services.provInvoice")
            @endif
            @if($document=="ilc")
                @include("omi.tools.client_services.ilc")
            @endif
            @if($document=="ilc_release")
                @include("omi.tools.client_services.ilc_release")
            @endif
            <div class="col-md-12 margin-top-20 margin-bottom-20">
                <p align="center">
                    <button class="btn-submit" type="submit">
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

