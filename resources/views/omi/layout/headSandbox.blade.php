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
    <link href="{{ asset('/css/hover-min.css')}}" rel="stylesheet" media="all">
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
    <SCRIPT type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </SCRIPT>
    @yield('header_styles')
</head>
<!-- Body -->
<!-- Part 1: #Header -->
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="header-left col-md-5 col-sm-5">
                <a class="linkPatentServices" href="\"><img src="{{ asset('img/logos/icologo_lg.png')}}" alt="Patent Services Logo" width="48">PATENT SERVICES</a>
                <ul class="list-unstyled list-inline ulContact">
                    <li><a href="mailto:info@ownmyinvention.com"><i class="fa fa-envelope-o"></i><span> info@ownmyinvention.com</span></a></li>
                    <li><a href="tel:#"><i class="fa fa-phone"></i><span> 888-344-6836</span></a></li>
                </ul>
            </div>
            <div class="header-right col-md-7 col-sm-7 additional-nav">
                <a href="http://inventorssociety.net/" target="_blank">
                    <img src="{{ asset('img/logos/issf2.png')}}" width="15%" alt="Inventor Society of South Florida" style="float: right;padding-top: 7px;">
                </a>
                <a href="http://www.dandb.com/verified/business/672862398/" target="_blank">
                    <img src="{{ asset('img/logos/dyblogo.png')}}" width="14%" alt="VERIFIED Seal" style="float: right;margin-right: 10px;">
                </a>
                <img src="{{ asset('img/logos/us_chamber.png')}}" width="11%" alt="U.S. Chamber Of Commerce" style="float: right;margin-right: 10px;">
                <a href="http://www.uiausa.org/" target="_blank">
                    <img src="{{ asset('img/logos/uiaNew.png')}}" width="15%" alt="United Inventors Association Of America" style="float: right;margin-right: 10px;">
                </a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <div class="inner-text">
                               <span id="spanUser">  {{ucwords($client->fname." ".$client->lname)}} <i class="fa fa-sign-out"></i></span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{route('launch_sandbox')}}"><i class="fa fa-dashboard "></i>Launch Center</a>
                    </li>
                    <li>
                        <a href="{{route('launch_sandbox/profile')}}"><i class="fa fa-user"></i>Inventor Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-yelp "></i>My Projects <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @foreach($client->projects as $project)
                                @if($project->status!="EXCLUDE")
                                    <li>
                                        <a href="{{route('launch_sandbox/project',$project->id)}}"><i class="fa fa-key "></i>{{$project->ideaName}}</a>
                                    </li>
                                @endif
                            @endforeach
                            {{--<li>
                                <a href="{{route('launch/new')}}"><i class="fa fa-key "></i>Create New</a>
                            </li>--}}
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-upload "></i>Upload Files<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @foreach($client->projects as $project)
                                @if($project->status!="EXCLUDE")
                                    <li>
                                        <a href="javascript:;" class="linkUploadFileProject" data-id="{{$project->id}}"><i class="fa fa-upload "></i>{{$project->ideaName}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    @if($client->makePaymentAvailable())
                    <li>
                        <a href="#"><i class="fa fa-money "></i>Make a Payment<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @foreach($client->projects as $project)
                                @if($project->status!="EXCLUDE")
                                    @if($project->lastContractNoWP() !=null && $project->lastContractNoWP()->paid < $project->lastContractNoWP()->price && in_array($project->stage,array("WOM", 'WALKTHRU',"DROP", "DROP/IMG", "ARCHIVE","PHASE2","CONTRACT")) && ($project->stage=="WALKTHRU"||$project->lastContractNoWP()->type=="IGUP"||$project->lastContractNoWP()->type=="PPA" || new \DateTime($project->actionDate) <= new \DateTime()))
                                        @if($project->lastContractNoWP()->funding==1||$project->lastContractNoWP()->type=="PPA")
                                            <li>
                                                <form method="POST" action="{{url("payment_sandbox")}}" id="paymentForm_{{$project->id}}">
                                                    <input type="hidden" name="project_id" value="{{$project->id}}">
                                                    <input type="hidden" name="contract_id" value="{{$project->lastContractNoWP()->id}}">
                                                </form>
                                                <a href="javascript:;" onclick="$('#paymentForm_{{$project->id}}').submit();">
                                                    <i class="fa fa-money"></i>{{$project->ideaName}}
                                                </a>
                                            </li>
                                        @else
                                        <li>
                                            <a href="{{route('launch_sandbox/signBeforePaid',$project->id)}}" class="linkMakePaymentProject" data-id="{{$project->id}}"><i class="fa fa-money"></i>{{$project->ideaName}}</a>
                                        </li>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    <li>
                        <a href="{{url('learn/Welcome-to-Our-Learning-Center')}}"><i class="fa fa-lightbulb-o "></i>Learning Center</a>
                    </li>
                   <li>
                        <a href="blank.html"><i class="fa fa-square-o "></i>Settings<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li id="changePass" data-id="{{$project->lead->id}}">
                                <a href="javascript:;"><i class="fa fa-desktop "></i>Change Password </a>
                            </li>
                            {{--<li>
                                <a href="form-advance.html"><i class="fa fa-code "></i>Advance</a>
                            </li>--}}
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">

                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line bubble">
                            <p class="greet">Welcome to your Launch Center</p>
                        </h1>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    @include('intranet.tools.UploadFileModal')
    @include('omi.tools.changePasswordModal')

    <div id="footer-sec">
        &copy; 2016 Patent Services USA
    </div>
    <script src="{{asset('/plugins/jquery/jquery-1.11.3.js') }}" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap.min.js")}}"></script>
    <script src="{{asset("js/autoNumeric.js")}}" type="text/javascript"></script>
    <script src="{{asset("/js/tools.js")}}" type="text/javascript"></script>
    <script src="{{asset("/plugins/launchTemplate/js/jquery.metisMenu.js")}}"></script>
    <script src="{{asset("/plugins/launchTemplate/js/custom.js")}}"></script>
    <script src="{{asset("/plugins/sweetalert/sweetalert.min.js")}}"></script>
    <script src="{{asset("/js/omi/launch_sandbox.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/moment.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datetimepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    {{--upload file--}}
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>
    <script src="{{asset("js/uploadFile/uploadFileLaunch.js")}}"></script>
    @yield('footer_scripts')
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/930107513/?value=0&amp;guid=ON&amp;script=0"/>
        </div>
    </noscript>
</body>
</html>