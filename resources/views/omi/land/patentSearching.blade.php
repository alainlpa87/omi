@extends('omi.layout.land')
@section('metainfo')
    <meta name="description" content="Patent Services USA is your top choice for patent searching and invention patenting. We will handle the headaches, challenges and legal obstacles of the process." />
@endsection
@section('title')
    Patent Search Service | Patent Search | Search a Patent
@endsection
@section('content')

    <section class="main-section" id="Portfolio"><!--main-section-start-->
        <div class="container">
            <h2>Patent Searching</h2>
            {{--<h6>Fresh portfolio of designs that will keep you wanting more.</h6>--}}
            <div class="row">
                <div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices">A proper patent search should be exhaustive, comprehensive, detailed and should look at the product idea or invention from various angles to make sure all permutations and combinations are being taken into consideration and that all I's are dotted and that all T's are crossed.</p>
                    <br>
                    <p class="pServices">Many think that searching for a patent is as simple as going to Google Patents and entering some information, but this process entails much more. An inventor may conduct a patent search on his own, but there are many benefits to a professional patent search that many are probably not aware of. Furthermore, there are even more advantages if a patent search includes a legal opinion.</p>
                </div>
                <figure class="col-lg-8 col-sm-6 text-right wow text-center fadeInUp delay-02s"><!-- -->
                    <img src="{{asset('img/services/PatentSearching.jpg')}}" alt="InventionHelp">
                </figure>
                <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <br>
                    <p class="pServices">Do you know the difference between simple do-it-yourself patent searches as compared to detailed patent searches that include an unbiased and objective legal opinion? If you don’t, <a href="{{url('home#contact')}}">contact us</a> to schedule a consultation with one of our specialists and we will be happy to help you understand the difference.</p>
                    <br>
                    <p class="pServices">When it comes to patenting, the more <a href="{{url('learn/Why-You-Need-To-Research-Your-Patent')}}">research</a> you do and the more you document your findings, the better your case. Having said that, realize that there is a significant advantage to having a qualified legal opinion for your patent search. Proper research and thorough documentation significantly improves your case and can help you receive serious consideration for your invention from manufacturers even during the patent pending stage.</p>
                    <br>
                    <p class="pServices"><a href="https://www.ownmyinvention.com/">At Patent Services USA</a>, all our patent searches are exhaustive and include a legal opinion. We have access to large a network of highly qualified and experienced independent registered patent attorneys and when you work with us, a full patent search is conducted and will include a legal opinion regarding how patentable your invention idea is, that can give you a good indication of whether you should continue to pursue the idea or not.</p>
                    <br>
                    <p class="pServices">And if all looks good, with a registered patent attorney’s legal opinion behind the search, you can take your project to market with much higher credibility to support your invention idea!</p>
                    <br>
                    <p class="pServices">Please note that while independent patent agents can also perform patent searches, they cannot provide legal opinions or advice.</p>
                    <br>
                    <p class="pServices">Get in touch with us via telephone at 888-344-6836 or use our secure online system to <a href="{{url('newSub')}}">submit your idea for assessment</a>.</p>
                    <br>
                    <p class="pServices">Don't forget to <a href="https://www.facebook.com/PatentServicesUSA/">follow us on Facebook!</a></p>
                    <br>
                    <p class="pServices">Want to read what our clients are saying about us? Head on over to <a href="http://patentservicesusareviews.com/">www.patentservicesusareviews.com!</a></p>
                </div>
            </div>
        </div>
    </section><!--main-section-end-->

@endsection

@section('footer_scripts')
@endsection
