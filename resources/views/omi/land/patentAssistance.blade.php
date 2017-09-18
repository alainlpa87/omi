@extends('omi.layout.land')
@section('metainfo')
    <meta name="description" content="Patent Services is a professional patent assistance organization that will help you patent your invention idea along and also to license and market it." />
@endsection
@section('title')
    Patents for Ideas | Patented Idea
@endsection
@section('content')

    <section class="main-section" id="Portfolio"><!--main-section-start-->
        <div class="container">
            <h2>Patent Assistance</h2>
            {{--<h6>Fresh portfolio of designs that will keep you wanting more.</h6>--}}
            <div class="row">
                <div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices">As you get embark on establishing protection for your invention idea, take the time to look at all the different options that are available to you for getting a patent and eventually licensing and marketing your invention idea.</p>
                    <br>
                    <p class="pServices">You may work on establishing patent protection on your own; researching, identifying and searching for professionals to assist in preparing, documenting, protecting and marketing your invention idea. Or you may work with a <a href="https://www.ownmyinvention.com/">patent services company</a> like ours, Patent Services USA, where we provide patent assistance services to help you protect your invention idea.</p>
                    <br>
                    <p class="pServices">Our <a href="{{url('learn/Welcome-to-Our-Learning-Center')}}">learning center</a> has tons of articles and resources to help you with the patenting process. You can also visit our <a href="http://www.helpwithinvention.org/">Invention Help website</a> at <a href="http://www.helpwithinvention.org/">www.helpwithinvention.org</a> for even more learning materials.</p>
                </div>
                <figure class="col-lg-8 col-sm-6 text-right wow text-center fadeInUp delay-02s"><!-- -->
                    <img src="{{asset('img/services/PatentAssistance.jpg')}}" alt="InventionHelp">
                </figure>
                <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <br>
                    <p class="pServices">As you go through the process of establishing patent protection, you may find that you are limited on time, or that you don’t have the resources to find, interview, negotiate with, and then manage each of the different professionals required during the process.</p>
                    <br>
                    <p class="pServices">Also, there is a high probability that you may end up paying high fees for each of these professional services because, as an individual inventor, you do not have much leverage to negotiate favorable rates.</p>
                    <br>
                    <p class="pServices"><a href="https://www.ownmyinvention.com/">At Patent Services USA</a>, we have a lot of experience in helping inventors and providing patent <a href="{{url('learn/The-Benefits-of-Getting-Professional-Help-With-Your-Patent')}}">assistance</a> services. Over the years, we have established working relationships with the many professionals that are needed during the patenting process. With these relationships, we bring into play serious purchasing power, so we can negotiate discounted rates with our partners and what’s even better, we bring these discounted rates to you so you can save a lot of money!</p>
                    <br>
                    <p class="pServices">It’s easy to get started. You can reach us on the phone at 888-344-6836 or simply use 100% our confidential online idea submission system.</p>
                    <br>
                    <p class="pServices">Take a few minutes to head over to <a href="http://patentservicesusareviews.com/">www.patentservicesusareviews.com</a> to see what our clients have to say.</p>
                </div>
            </div>
        </div>
    </section><!--main-section-end-->

@endsection

@section('footer_scripts')
@endsection
