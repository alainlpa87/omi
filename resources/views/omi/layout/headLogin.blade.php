<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Protect Your Product & Invention Idea with a Patent - Patent Services USA</title>
    <!-- CSS  ================================================== -->
    <link href="{{ asset('/plugins/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.min.css"/>
    <link href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Knewave') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('/css/omiCommon.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/launchTemplate/css/basic.css') }}" rel="stylesheet" />
    <link href="{{ asset('/plugins/launchTemplate/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/plugins/component/components.css') }}" rel="stylesheet" type="text/css" >
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                document,'script','//connect.facebook.net/en_US/fbevents.js');

        fbq('init', '1669170773333510');
        fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1669170773333510&ev=PageView&noscript=1"
                /></noscript>
    <!-- End Facebook Pixel Code -->
    @yield('header_styles')
</head>
<!-- Body -->
<!-- Part 1: #Header -->
<body>
    <div>
        <nav class="navbar navbar-default navbar-cls-top headerLogin" role="navigation" style="margin-bottom: 0;border-bottom: 5px solid #E0E0E0;">
            <div class="header-left col-md-5 col-sm-5">
                <a class="linkPatentServices" href="\"><img src="{{ asset('img/logos/icologo_lg.png')}}" alt="Patent Services Logo" width="48">PATENT SERVICES</a>
                <ul class="list-unstyled list-inline ulContact">
                    <li><a href="mailto:info@ownmyinvention.com"><i class="fa fa-envelope-o"></i><span> info@ownmyinvention.com</span></a></li>
                    <li><a href="tel:#"><i class="fa fa-phone"></i><span> 888-344-6836</span></a></li>
                </ul>
            </div>
            <div class="header-right col-md-7 col-sm-7 additional-nav">
                <a href="http://inventorssociety.net/" target="_blank">
                    <img src="{{ asset('img/logos/issf2.png')}}" width="13%" alt="Inventor Society of South Florida" style="float: right;padding-top: 7px;">
                </a>
                <a href="http://www.dandb.com/verified/business/672862398/" target="_blank">
                    <img src="{{ asset('img/logos/dyblogo.png')}}" width="11%" alt="VERIFIED Seal" style="float: right;margin-right: 10px;">
                </a>
                <img src="{{ asset('img/logos/us_chamber.png')}}" width="8%" alt="U.S. Chamber Of Commerce" style="float: right;margin-right: 10px;">
                <a href="http://www.uiausa.org/" target="_blank">
                    <img src="{{ asset('img/logos/uiaNew.png')}}" width="12%" alt="United Inventors Association Of America" style="float: right;margin-right: 10px;">
                </a>
            </div>
        </nav>

        @yield('content')

    </div>
    <div id="footer-sec" style="border-top: 5px solid #E0E0E0;">
        &copy; 2016 Patent Services USA
    </div>
    <script src="{{asset('/plugins/jquery/jquery-1.11.3.js') }}" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap.min.js")}}"></script>
    <script src="{{asset("/js/tools.js")}}" type="text/javascript"></script>
    <script src="{{asset("/plugins/sweetalert/sweetalert.min.js")}}"></script>
    @yield('footer_scripts')
</body>
</html>