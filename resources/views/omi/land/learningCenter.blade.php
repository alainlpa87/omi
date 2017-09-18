@extends('omi.layout.land')
@section('metainfo')
    @if($descriptionhtml == '')
        <meta name="description" content="The Patent Services USA learning center is a great resource of potential & established inventors to learn about patents, the patenting process, licensing, invention protection &  more." />
    @else
        <meta name="description" content="{{$descriptionhtml}}" />
    @endif
@endsection
@section('title')
    @if($titlehtml == '')
        Patent Services USA Learning Center - Articles & Resources for Inventors
    @else
        {{$titlehtml}}
    @endif
@endsection
@section('header_styles')
    <link href="{{ asset('/css/learning.css') }}" rel="stylesheet">
@endsection
@section('content')

    <section class="main-section" id="Portfolio" style="padding-top: 30px"><!--main-section-start-->
        <div class="container" id="containerLearning">
            <h2 id="articleTitle">@if($title!='none'){{$title}}@endif</h2>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 container-tools-left artLinks">
                    <ul>
                        @foreach($articles as $art)
                            <li class="learningTopic" data-title="{{$art->title}}">{{$art->title}}</li>
                        @endforeach
                    </ul>
                </div>
                <div id="artContent" class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    @if($content == 'none')
                        <h2 class="bubble wow fadeInDown delay-03s"> <p>Welcome to Our Learning Center</p></h2>
                        <p class="pServices wow fadeInLeft delay-03s">Having access to valuable information is important for new <b>inventors</b> and entrepreneurs who are stepping into the <b>intellectual property</b> marketplace for the first time.</p>
                        <br>
                        <p class="pServices wow fadeInLeft delay-03s">Our learning center was created to help inventors gain a thorough understanding of <b>patents</b>, the <b>patent process, patent searches, applications, licensing</b> and other related and important topics.</p>
                        <br>
                        <p class="pServices wow fadeInLeft delay-03s">So go ahead and browse through our articles using the links on the left.</p>
                        <br>
                        <p class="pServices wow fadeInLeft delay-03s">Getting the most out of a patent application requires that research and strategy building has already been completed in detail. When an inventor establishes a patent application date, the contents of the application is used to define the protected invention idea.</p>
                        <br>
                        <p class="pServices wow fadeInLeft delay-03s">As a newcomer to the intellectual property marketplace, here are 5 topics that we strongly believe that you should become familiar with:</p>
                        <ul class="list-unstyled" style="margin-left: 30px;margin-top: 15px;">
                            <li class="homelist pServices wow fadeInRight delay-03s">
                                <span class="fakeLink learningTopic"  data-title="Trade Secret">Trade Secret</span> - Before you have been granted a patent, you are most likely holding a trade secret. Know where you stand.
                            </li>
                            <li class="homelist pServices wow fadeInRight delay-03s">
                                <span class="fakeLink learningTopic"  data-title="Intellectual Property">Intellectual Property</span> - Property holds value. These are special properties that hold all the value in art and ideas.
                            </li>
                            <li class="homelist pServices wow fadeInRight delay-03s">
                                <span class="fakeLink learningTopic"  data-title="Invention Promotion Company">Invention Promotion Company</span> - AKA patent marketing company. Working with certain agencies can be a dead-end street. There are dozens of honest contractors who we have screened and tested for inventors in our network.
                            </li>
                            <li class="homelist pServices wow fadeInRight delay-03s">
                                <a href="invention-licensing" class="fakeLink">Licensing</a> - Licensing is the most accessible way to get rewards or royalties from a patent. With the right support licensing can be a way to get passive income from intellectual property.
                            </li>
                            <li class="homelist pServices wow fadeInRight delay-03s">
                                <span class="fakeLink learningTopic"  data-title="Startup Model">The Startup Model</span> - Startups getting more and more popular. Launching a startup can be a very lucrative reason for establishing a patent.
                            </li>
                        </ul>
                        <br>
                        <p class="pServices wow fadeInLeft delay-03s">
                            Be on the lookout for links that are embedded within each article that will allow access to related subject matter. Please note that some of the material in our learning center is for advanced users and will require you to register before access is granted. After you have taken the first steps toward protecting your invention and patenting your invention or product idea, advanced topics will help you to keep you sure-footed at every stage of development.
                        </p>
                        <br>
                        <p class="pServices wow fadeInLeft delay-03s">
                            So, go ahead and <a href="register#Portfolio">register</a> in our network for free and gain access to advanced topics and other valuable material.
                        </p>
                        <br><br>
                        <p class="pServices wow fadeInLeft delay-03s">Any inventor with an active trade secret or startup also needs access to experienced support. Establish a confidential submission and statement of nondisclosure for your project, and we will make sure that you have a consultation team backing you up for the life of your project.</p>
                        <div class="row quote-v1 wow fadeInUp delay-03s">
                            <div class="col-md-12">
                                <div class="cta">What's your big idea?</div>
                            </div>
                            <div class="col-md-4 text-right">
                                <br><a class="btn-transparent" href="sub"><i class="fa fa-rocket margin-right-10"></i>Make a Submission</a><br>
                            </div>
                        </div>
                        <br>
                        <p class="pServices wow fadeInLeft delay-03s">
                            Need to speak with a pro right away? Give us a call at 888-344-6836 or visit our contact center.
                        </p>
                        <br>
                        <p class="pServices wow fadeInLeft delay-03s">
                            Results speak for themselves. Take a look at some of these inventors who put knowledge and advice to work for their great ideas.
                        </p>
                        <br>
                     @else
                        {!! $content !!}
                    @endif
                </div>
            </div>
        </div>
    </section><!--main-section-end-->

@endsection

@section('footer_scripts')
    <script src="{{ asset('/js/omi/newLearning.js') }}" type="text/javascript"></script>
@endsection
