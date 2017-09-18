@extends('omi.layout.head')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/bootstrap-datetimepicker.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/css/sign.css') }}" rel="stylesheet" type="text/css" >
@endsection
@if(setlocale(LC_MONETARY, 'en_US.UTF-8'))@endif
@section('content')
    <div class="container-fluid">
        <div class="row">
        @if($contract->type=="IMG")
            @include('omi.tools.imgDocusign')
        @elseif($contract->type=="IIG")
                @include('omi.tools.iigDocusign')
        @elseif($contract->type=="IGUP")
                @include('omi.tools.igupDocusign')
        @elseif($contract->type=="PPA" && $ContractType == 'Utility')
                @include('omi.tools.ppaUtilitydocusign')
        @elseif($contract->type=="PPA" && $ContractType == 'U_D')
                @include('omi.tools.ppaU&Ddocusign')
        @elseif($contract->type=="PPA" && $ContractType == 'Provisional')
                @include('omi.tools.ppaIMGdocusign')
        @elseif($contract->type=="PPA" && $ContractType == 'IMG')
                @include('omi.tools.ppaIMGdocusign')
        @endif
        @if($from=="sign")
            <form action="{{url("launch/prepareDocusignContract")}}"  name="formSign" onsubmit="return checkFormSign();" method="post" enctype="multipart/form-data">
                <input type="hidden" name="ID" value="{{$contract->id}}">
                <input type="hidden" name="inventor_name_hidden" id="inventor_name_hidden">
                <input type="hidden" name="inventor_date_hidden" id="inventor_date_hidden">
                <input type="hidden" name="cinventor_name_hidden" id="cinventor_name_hidden">
                <input type="hidden" name="cinventor_date_hidden" id="cinventor_date_hidden">
                <div class="col-md-12 margin-top-20 margin-bottom-20">
                    <p align="center" id="acceptTerms">
                        <button class="btn-submit" type="submit" onclick="$('#formSign').submit();">
                            <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>SIGN CONTRACT
                        </button>
                    </p>
                </div>
            </form>
        @elseif($from=="signPPA" || $contract->type=="PPA" )
            <form action="{{url("launch/prepareDocusignContract")}}"  name="formSign" onsubmit="return checkFormSign();" method="post" enctype="multipart/form-data">
                <input type="hidden" name="ID" value="{{$contract->id}}">
                <input type="hidden" name="contract_type_hidden" id="contract_type_hidden" value="{{$ContractType}}">
                <input type="hidden" name="inventor_name_hidden" id="inventor_name_hidden">
                <input type="hidden" name="inventor_date_hidden" id="inventor_date_hidden">
                <input type="hidden" name="cinventor_name_hidden" id="cinventor_name_hidden">
                <input type="hidden" name="cinventor_date_hidden" id="cinventor_date_hidden">
                {{--PPA plans--}}
                <input type="hidden" name="hidden_plan1" id="hidden_plan1">
                <input type="hidden" name="hidden_plan2" id="hidden_plan2">
                <input type="hidden" name="hidden_plan3" id="hidden_plan3">
                <input type="hidden" name="hidden_plan4" id="hidden_plan4">
                <input type="hidden" name="hidden_plan5" id="hidden_plan5">
                <input type="hidden" name="hidden_plan6" id="hidden_plan6">
                <input type="hidden" name="hidden_plan7" id="hidden_plan7">
                <input type="hidden" name="hidden_plan8" id="hidden_plan8">
                <input type="hidden" name="hidden_plan9" id="hidden_plan9">
                <input type="hidden" name="hidden_plan10" id="hidden_plan10">
                <input type="hidden" name="hidden_plan11" id="hidden_plan11">
                <input type="hidden" name="hidden_plan12" id="hidden_plan12">

                {{--PPA PRICE--}}
                <input type="hidden" name="hidden_price" id="hidden_price">

                <div class="col-md-12 margin-top-20 margin-bottom-20">
                    <p align="center" id="acceptTerms">
                        <button class="btn-submit" type="submit" onclick="$('#formSign').submit();">
                            <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>SIGN CONTRACT
                        </button>
                    </p>
                </div>
            </form>
        @else
            {{--this form is hide but is there because for some reason is what make this proces of phase one works but the form below is the one that send the info--}}
            <form action="{{url("launch/prepareDocusignContract")}}"  name="formSign" method="post" onsubmit="return checkFormSign();" enctype="multipart/form-data" hidden="hidden">
                <input type="hidden" name="project_id" value="{{$project->id}}">
                <input type="hidden" name="contract_id" value="{{$contract->id}}">
                <input type="hidden" name="inventor_name_hidden" id="inventor_name_hidden">
                <input type="hidden" name="inventor_date_hidden" id="inventor_date_hidden">
                <input type="hidden" name="cinventor_name_hidden" id="cinventor_name_hidden">
                <input type="hidden" name="cinventor_date_hidden" id="cinventor_date_hidden">
                <input type="hidden" name="newPrice_hidden" id="newPrice_hidden">
                <div class="col-md-12 margin-top-20 margin-bottom-20">
                    <p align="center" id="acceptTerms">
                        <button class="btn-submit" type="submit" onclick="$('#formSign').submit();">
                            <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>SIGN CONTRACT
                        </button>
                    </p>
                </div>
            </form>

                <form action="{{url("launch/prepareDocusignContract")}}"  name="formSignDocusign" onsubmit="return checkFormSign();" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="ID" value="{{$contract->id}}">
                    <input type="hidden" name="newPrice_hidden1" id="newPrice_hidden1">
                    <div class="col-md-12 margin-top-20 margin-bottom-20">
                        <p align="center" id="acceptTermsDocu">
                            <button class="btn-submit" type="submit" onclick="$('#formSignDocusign').submit();">
                                <i class="fa fa-thumbs-up" style="font-size: x-large;margin-right: 10px;"></i>SIGN CONTRACT
                            </button>
                        </p>
                    </div>
                </form>
        @endif

            {{--logos--}}
            <div class="col-md-12">
                <img src="{{ asset('/img/logos/uiaNew.png') }}" width="12%" alt="United Inventors Association Of America" style="margin-right: 5%;margin-left: 15%;">
                <img src="{{ asset('/img/logos/google.jpg') }}" width="10%" alt="Google Reviews" style="margin-right: 5%;">
                <img src="{{ asset('/img/logos/bbb.png') }}" width="18%" alt="Better Business Bureau" style="margin-right: 5%;">
                <img src="{{ asset('/img/logos/shopper.png') }}" width="13%" alt="Shopper Apprived" style="margin-right: 5%;">
                <img src="{{ asset('/img/logos/customersReview.png') }}" width="10%" alt="Review of Patent Services USA Inc">
            </div>
            {{--End logos--}}
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{asset("/js/omi/sign.js")}}"></script>
@endsection

