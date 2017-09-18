@extends('omi.layout.land')
@section('metainfo')
    <meta name="description" content="Tradeshows are a great way for you to gauge current industry trends. Patent Services USA licensing affiliates work with multiple tradeshows to boost product exposure." />
@endsection
@section('title')
    Trade Shows - Maximize Exposure for Your invention Idea - Patent Services USA
@endsection
@section('content')

    <section class="main-section" id="Portfolio"><!--main-section-start-->
        <div class="container">
            <h2>Trade Shows</h2>
            <div class="row">
                <div class="col-lg-5 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices">Are you looking for ways to maximize exposure for your product idea or invention to manufacturers? Industry trade shows are one important part of an effective marketing strategy designed to boost brand visibility and position your product to potential buyers. Trade shows provide inventors and industry professionals with opportunities for:</p>
                    <br>
                    <ul class="pServices">
                        <li>New product marketing</li>
                        <li>Industry education</li>
                        <li>Market penetration</li>
                        <li>Developing and expanding skill sets</li>
                        <li>Identifying competition</li>
                        <li>Networking</li>
                        <li>Building relationships with peers and customers</li>
                    </ul>
                </div>
                <figure class="col-lg-7 col-sm-6 text-right wow text-center fadeInUp delay-02s"><!-- -->
                    <img src="{{asset('img/land/tradeShowMinimal.jpeg')}}" style="width: 60%;">
                </figure>
                <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices">Trade shows are an excellent place for an inventor to gauge current industry trends. However if you find that your own schedule or resources limit your ability to participate in trade show opportunities, rest assured that our licensing affiliates will provide you with expert representation at some of the largest invention trade shows for new products. Our licensing affiliates will work throughout the trade shows to maximize product exposure, launching your product onto the world stage. Through effective pre-qualification and networking efforts, the licensing affiliate will build relationships with buyers and manufacturers in order to convert those relationships into licensing opportunities. All trade show representation, as well as all of your new product marketing services, is performed by the licensing affiliate on a contingency fee basis.</p>
                    <br>
                    <p class="pServices">Below are a sampling of industry trade shows where your new product idea could receive professional representation.</p>
                    <br>
                    <br>
                </div>
                @if($nextYear != null)
                    <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s">
                        <br>
                        <b class="pServices">{{($year+1)." TRADE SHOW EVENTS:"}}</b>
                        <br>
                        @foreach($nextYear as $tradeshow)
                            <label><a href="{{$tradeshow->link}}" target="_blank">{{$tradeshow->name}}</a>&nbsp;&nbsp; {{date('M,j',strtotime($tradeshow->tradeshowStartDate))." - ".date('j, Y',strtotime($tradeshow->tradeshowEndDate))}}, {{$tradeshow->location}}</label>
                            <br>
                        @endforeach
                    </div>
                @endif
                @if($currentYear != null)
                    <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s">
                        <br>
                        <b class="pServices">{{$year." TRADE SHOW EVENTS:"}}</b>
                        <br>
                        @foreach($currentYear as $tradeshow)
                            <label><a href="{{$tradeshow->link}}" target="_blank">{{$tradeshow->name}}</a>&nbsp;&nbsp; {{date('M,j',strtotime($tradeshow->tradeshowStartDate))." - ".date('j, Y',strtotime($tradeshow->tradeshowEndDate))}}, {{$tradeshow->location}}</label>
                            <br>
                        @endforeach
                    </div>
                @endif
                @if($prevYear != null)
                    <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s">
                        <br>
                        <b class="pServices">{{($year-1)." TRADE SHOW EVENTS:"}}</b>
                        <br>
                        @foreach($prevYear as $tradeshow)
                            <label><a href="{{$tradeshow->link}}" target="_blank">{{$tradeshow->name}}</a>&nbsp;&nbsp; {{date('M,j',strtotime($tradeshow->tradeshowStartDate))." - ".date('j, Y',strtotime($tradeshow->tradeshowEndDate))}}, {{$tradeshow->location}}</label>
                            <br>
                        @endforeach
                    </div>
                @endif
                @if($prevPrevYear != null)
                    <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s">
                        <br>
                        <b class="pServices">{{($year-2)." TRADE SHOW EVENTS:"}}</b>
                        <br>
                        @foreach($prevPrevYear as $tradeshow)
                            <label><a href="{{$tradeshow->link}}" target="_blank">{{$tradeshow->name}}</a>&nbsp;&nbsp; {{date('M,j',strtotime($tradeshow->tradeshowStartDate))." - ".date('j, Y',strtotime($tradeshow->tradeshowEndDate))}}, {{$tradeshow->location}}</label>
                            <br>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section><!--main-section-end-->

@endsection

@section('footer_scripts')
@endsection
