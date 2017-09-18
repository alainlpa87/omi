@extends('omi.layout.head')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/payment.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 align="center"><strong>Patent Services Payment Terminal</strong></h1>
    <h2 class="subTitles">Payment Success!</h2>
    @if($contract->type!="PPA" && $complete == 1)
        <p>Your payment was <strong>APPROVED</strong>! Please answer the questions as soon as you can in the project view.</p>
        <script type="text/javascript">
            var sa_values = { "site":12644 };
            function saLoadScript(src) {
                var js = window.document.createElement("script");
                js.src = src; js.type = "text/javascript";
                document.getElementsByTagName("head")[0].appendChild(js);
            }
            var d = new Date();
            if (d.getTime() - 172800000 > 1447169768000)
                saLoadScript("//www.shopperapproved.com/thankyou/rate/12644.js");
            else
                saLoadScript("//direct.shopperapproved.com/thankyou/rate/12644.js?d=" + d.getTime()); </script>
    @else
        <p>Your payment was <strong>APPROVED</strong>! </p>
    @endif
    <a class="btn btn-primary" href="{{url('launch')}}">Go back to the Launch Center</a>
@endsection

@section('footer_scripts')
    <script src="{{asset("js/autoNumeric.js")}}"></script>
    <script src="{{asset("/js/omi/payment.js")}}"></script>
@endsection