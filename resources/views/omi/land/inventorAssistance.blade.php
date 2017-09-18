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
            <h2>Inventor Assistance</h2>
            {{--<h6>Fresh portfolio of designs that will keep you wanting more.</h6>--}}
            <div class="row">
                <div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices"><a href="https://www.ownmyinvention.com/">Welcome to Patent Services</a>. As a professional organization, we specialize in providing a wide range of <a href="{{url('learn/The-Benefits-of-Getting-Professional-Help-With-Your-Patent')}}">services to inventors and innovators</a> who would like to take their invention idea from concept to a feasible commercial product.</p>
                    <br>
                    <p class="pServices">Perhaps you are a new mother with an idea for a product that improves the safety and comfort of your child. Or you’re a sports coach who has an idea for a product that increases the fun factor of various sports.</p>
                    <br>
                    <p class="pServices">Or a mechanical engineer who has an idea of a new product that will change the way machines are maintained in a factory.</p>
                    <br>
                    <p class="pServices">Or may be a dentist who has a new idea about reducing the pain and discomfort during oral surgeries.</p>
                </div>
                <figure class="col-lg-8 col-sm-6 text-right wow text-center fadeInUp delay-02s"><!-- -->
                    <img src="{{asset('img/services/InventorAssistance.jpg')}}" alt="InventorAssistance">
                </figure>
                <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices">Regardless of where your idea came from and how much experience you may have in the patenting process, there will come a time when you, the inventor, will need assistance with this process.</p>
                    <br>
                    <p class="pServices">We recommend that you take the time to explore the various options available to you, to assist you in obtaining patent protection for your idea and the subsequent licensing and <a href="http://www.helpwithinvention.org/2016/03/how-will-i-market-my-invention-once-its-patented/">marketing of your invention</a> once you are awarded a patent.</p>
                    <br>
                    <p class="pServices">The <a href="{{url('learn/An-In-Depth-Understanding-of-the-Patent-Application-Process')}}">patent process</a> is a complex legal system. Taking an invention from an idea to a real, marketable product is unfortunately not a simple or easy process. It takes a lot of effort, time and money. You will encounter obstacles and challenges in every step of the way.</p>
                    <br>
                    <p class="pServices">Therefore, the more time you take to <a href="{{url('learn/Welcome-to-Our-Learning-Center')}}">educate yourself</a> and understand the process, the better off you will be.</p>
                    <br>
                    <p class="pServices">At Patent Services USA, we provide <a href="{{url('home#contact')}}">assistance to inventors</a>. During the process you will need to interview and negotiate with various professionals and organizations that you will need during the process. This process is lengthy and requires experience.</p>
                    <br>
                    <p class="pServices">Over the years, we have established working relationships with professionals and organizations that work in the patent protection industry. When you work with us, you will have access to this extensive network that will not only save you time, effort and frustration but it will also save you money!</p>
                    <br>
                    <p class="pServices">Our consultants are available to provide <a href="http://www.helpwithinvention.org/">inventor assistance</a> and can be reached on 888-344-6836.</p>
                    <br>
                    <p class="pServices">You may also submit your idea for evaluation via our <a href="{{url('newSub')}} ">secure online system to get started!</a></p>
                </div>
            </div>
        </div>
    </section><!--main-section-end-->

@endsection

@section('footer_scripts')
@endsection
