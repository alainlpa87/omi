@extends('omi.layout.headSandbox')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/payment.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 align="center"><strong>Patent Services Payment Terminal</strong></h1>
    <h2 class="subTitles">Payment Success!</h2>
    <p>Your payment was <strong>APPROVED</strong>! Please answer the questions as soon as you can in the project view.</p>
    <p>Now the real client will see a pop up to review patent Services. We don't show you the pop up to you to avoid mistakes</p>
<a class="btn btn-primary" href="{{url('launch_sandbox')}}">Go back to the Launch Center</a>
@endsection

@section('footer_scripts')
    <script src="{{asset("js/autoNumeric.js")}}"></script>
    <script src="{{asset("/js/omi/payment.js")}}"></script>
@endsection