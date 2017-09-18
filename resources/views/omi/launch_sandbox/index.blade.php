@extends('omi.layout.headSandbox')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            {{--Main Body of the page--}}
            <div class="col-md-12 col-xs-12 col-lg-12">
                <div class="col-md-12 col-sm-12" style="font-family: Verdana, Geneva, sans-serif;">
                    <p>From here, you can review your project status, complete your inventor profile, and add detail to projects that you are working on.  You may upload supporting documents and even create simple sketches right from your computer or mobile device.</p>
                    <p>Use the links at the left to access projects or your inventor profile.</p>
                    @if($client->consultant != null)
                        <div id="consultantInfo">
                            <p>You have been assigned a consultant who can help you guide your projects through review and development:</p>
                            <p>&nbsp;</p>
                            <p>NAME: {{$client->consultant->fname." ".$client->consultant->lname}}</p>
                            <p><a href="mailto:info@ownmyinvention.com" style="color: darkslateblue;">
                                    <i class="fa fa-envelope-o"></i><span>: info@ownmyinvention.com</span>
                                </a></p>
                            <p><a style="color: darkslateblue;" href="tel:{{$client->consultant->did}}"><i class="fa fa-phone"></i><span>: {{$client->consultant->did}}</span></a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
@endsection