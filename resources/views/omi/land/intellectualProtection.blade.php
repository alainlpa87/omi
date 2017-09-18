@extends('omi.layout.land')
@section('metainfo')
    <meta name="description" content="Patent Services is a professional patent assistance company that can help you protect, license & market your intellectual property." />
@endsection
@section('title')
    Protect Your Intellectual Property with A Patent
@endsection
@section('content')

    <section class="main-section" id="Portfolio"><!--main-section-start-->
        <div class="container">
            <h2>Intellectual Property Protection</h2>
            {{--<h6>Fresh portfolio of designs that will keep you wanting more.</h6>--}}
            <div class="row">
                <div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices">As an inventor who is looking to capitalize and benefit from you invention idea, you will probably come across the term “intellectual property” and you may have one or more of the following questions:</p>
                    <br>
                    <ul class="pServices">
                        <li>What is intellectual property?</li><br>
                        <li>How can one protect intellectual property?</li><br>
                        <li>How can Patent Services help me with my intellectual property?</li>
                    </ul>
                    <p class="pServices">Intellectual property is defined as " work or invention that is the result of creativity, such as a manuscript or design, to which one has rights and for which one may apply for a patent, copyright, trademark, etc."</p>
                </div>
                <figure class="col-lg-8 col-sm-6 text-right wow text-center fadeInUp delay-02s"><!-- -->
                    <img src="{{asset('img/services/IntellectualPropertyProtection.jpg')}}" alt="InventionHelp">
                </figure>
                <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <br>
                    <p class="pServices">One of the unique aspects of intellectual property is the fact that it is intangible - i.e. it is not constituted or represented by a physical object and is often of value that cannot be measured precisely. So, your invention idea or concept is, in fact, your intellectual property. And, as in inventor, you should take necessary steps to protect this property.</p>
                    <br>
                    <p class="pServices">Over the last 100 years, as time progressed, intellectual property rights such as patents, <a href="http://www.helpwithinvention.org/2016/02/the-differences-between-patents-trademarks-and-copyrights/">copyrights</a> and <a href="{{url('learn/Trademark')}}">trademarks</a> came into existence to help reduce the risks of exposing trade secrets in the market place. In our time, with multiple protection options, intellectual property is in fact treated just like real property. It can be traded, transferred and licensed and it can also be held in the form of an asset.</p>
                    <br>
                    <p class="pServices">By <a href="{{url('learn/Understanding-The-Patent-Application-Process')}}">filing for a patent</a>, you can start the process of protecting your intellectual property. Please keep in mind that <a href="http://www.helpwithinvention.org/2015/11/protect-your-invention-infographic-on-our-learning-center/">establishing patent protection</a> is not quick and easy, and it is by no means simple, but the beauty of the system is that you can protect it by following the process.</p>
                    <br>
                    <p class="pServices">At Patent Services USA, we have in-depth experience in helping inventors and innovators protect their intellectual property by establishing patent protection. Whether you are a new inventor, or whether you are an experienced one, we can help you.</p>
                    <br>
                    <p class="pServices">The reality is that not every idea is an immediate candidate for valuable intellectual property. Our process starts with a statement of non-disclosure, followed by a detailed review and planning to validate your concept. In fact, many of our clients are new inventors that are looking to protect their intellectual property for the first time.</p>
                    <br>
                    <p class="pServices">Give us a call on 888-344-6836 and speak with one of our consultants and you will be on the way to protecting your intellectual property in no time!</p>
                </div>
            </div>
        </div>
    </section><!--main-section-end-->

@endsection

@section('footer_scripts')
@endsection
