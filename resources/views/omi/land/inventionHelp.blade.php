@extends('omi.layout.land')
@section('metainfo')
    <meta name="description" content="Patent Service USA is a professional company that provides inventor assistance. We will help you take your new invention idea to the market." />
@endsection
@section('title')
    Help With my Invention | Invention Help & Advice
@endsection
@section('content')

    <section class="main-section" id="Portfolio"><!--main-section-start-->
        <div class="container">
            <h2>Invention Help & Assistance</h2>
            {{--<h6>Fresh portfolio of designs that will keep you wanting more.</h6>--}}
            <div class="row">
                <div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices"><a href="https://www.ownmyinvention.com/">Welcome to Patent Services</a>. We are your go to resource for invention help and assistance!</p>
                    <br>
                    <p class="pServices">It is important that you look at all the various options that are available to you as you work on establishing patent protection for your invention idea and eventually licensing and marketing if you are awarded a patent.</p>
                    <br>
                    <p class="pServices">Given the legal complexities of the patent system, taking an invention from a concept to an actual product is usually not a simple process. It takes time, money and effort and comes with its own set of challenges and obstacles. As an inventor, the more you educate yourself and the more you understand the process, the better it is.</p>
                </div>
                <figure class="col-lg-8 col-sm-6 text-right wow text-center fadeInUp delay-02s"><!-- -->
                    <img src="{{asset('img/services/InventionHelp.jpg')}}" alt="InventionHelp">
                </figure>
                <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices">As you work through establishing patent protection for your invention idea, you will need to select, interview, negotiate with and manage the different types of professionals that are required during the various stages of the patent process. All of this takes time and effort.</p>
                    <br>
                    <p class="pServices">At Patent Services USA, <a href="https://www.ownmyinvention.com/">we provide invention help and assistance to inventors</a>. We have established relationships with the many professionals that are involved in the patent protection process. With these relationships, we can bring into play strong purchasing power, and this allows us to negotiate very attractive rates with these partners. And we simply pass these savings on to you, so you can save a significant amount of money as you work through protecting your invention.</p>
                    <br>
                    <p class="pServices">We invite you to visit our <a href="{{url('learn/Welcome-to-Our-Learning-Center')}}">dedicated learning center</a> where you will find tons of informative material and resources. You may also visit our Invention Help website at <a href="http://www.helpwithinvention.org/">www.helpwithinvention.org</a> for even more learning material.</p>
                    <br>
                    <p class="pServices"><a href="register">Register for an account on our learning center</a> and you will have immediate access to an <a href="{{url('learn/Welcome-to-Our-Learning-Center')}}">exclusive library of in-depth articles and infographics</a> we are sure you will find useful.</p>
                    <br>
                    <p class="pServices"><a href="https://www.facebook.com/PatentServicesUSA/">Follow us on Facebook where we regularly share articles</a>, contests, and other related material.</p>
                    <br>
                    <p class="pServices">Read what our clients are saying about us on our website at www.patentservicesusareviews.com.</p>
                    <br>
                    <p class="pServices">It is simple and easy to get started with establishing protection for your invention idea.</p>
                    <br>
                    <p class="pServices">Call us on 888-344-6836 or <a href="sub">submit your idea for evaluation</a> using our secure online system.</p>
                </div>
            </div>
        </div>
    </section><!--main-section-end-->

@endsection

@section('footer_scripts')
@endsection
