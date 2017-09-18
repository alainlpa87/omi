@extends('omi.layout.land')
@section('metainfo')
    <meta name="description" content="Patent Services USA is a professional patent & invention assistance organization that will help you to protect your invention idea." />
@endsection
@section('title')
    Protect Your Invention Idea | Protecting Ideas
@endsection
@section('content')

    <section class="main-section" id="Portfolio"><!--main-section-start-->
        <div class="container">
            <h2>Invention Protection</h2>
            {{--<h6>Fresh portfolio of designs that will keep you wanting more.</h6>--}}
            <div class="row">
                <div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <h3>Patent Protection</h3>
                    <p class="pServices">If you have a great product or invention idea that can potentially result in a marketable product, you definitely want to consider protecting your invention idea. This begs the question: how do you go about protecting your invention?</p>
                    <br>
                    <p class="pServices">Depending on your invention idea or concept you can follow the steps below to get started on invention protection:</p>
                    <br>
                    <h3>Patent Search</h3>
                    <p class="pServices">Determine if your invention idea is patentable by doing an exhaustive patent search. Better yet, work with an <a href="http://www.helpwithinvention.org/2016/05/3-benefits-of-a-patent-services-company/">invention protection services company</a> to help you obtain a patent search with an <a href="{{url('learn/Research-your-invention-before-filing-a-patent')}}">objective legal opinion</a>. This legal opinion provides detailed insight into the patentability of your invention idea.</p>
                </div>
                <figure class="col-lg-8 col-sm-6 text-right wow text-center fadeInUp delay-02s"><!-- -->
                    <img src="{{asset('img/services/InventionProtection.jpg')}}" alt="InventionProtection">
                </figure>
                <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <br>
                    <h3>Invention Evaluation</h3>
                    <p class="pServices">Consider getting an <a href="{{url('learn/Research-your-invention-before-filing-a-patent')}}">evaluation of your invention</a> before you even file for a patent. An evaluation looks at your invention idea strictly from a marketing perspective. This allows you to determine whether your invention idea is marketable and whether you should move forward with patent protection or not.</p>
                    <br>
                    <h3>Patent Filing</h3>
                    <p class="pServices">If your idea turns out to be patentable and marketable, by all means proceed with <a href="{{url('patent-filing')}}">filing an application for a patent</a>. Remember, as soon as you file an application for a patent; you are given <a href="{{url('learn/Patent-Pending-Scheme')}}">"patent pending"</a> status. Patent pending does not give you legal protection, but it does give you the right to use “patent pending” and affords you additional credibility. <a href="http://www.helpwithinvention.org/2016/01/what-does-patent-pending-mean/">Patent pending</a> does not also mean that you have been granted a patent but means your patent application is in the process. It also does not guarantee that you will receive a patent once your application has been processed and thoroughly evaluated.</p>
                    <br>
                    <p class="pServices">At Patent Services USA, we can help you protect your invention idea. When you work with us, you will work with a dedicated consultant who will guide you through the entire process of taking your idea from the concept to a marketable product. You will also have access to our entire network of individuals and companies that can assist you with the various requirements of the patent process and the subsequent licensing or marketing activities.</p>
                    <br>
                    <p class="pServices">Visit our learning center and <a href="http://www.helpwithinvention.org/">our invention help website</a> at www.helpwithinvention.org where you will find a <a href="http://www.helpwithinvention.org/">large collection of articles and other resources</a> that will help you educate yourself about <a href="http://www.helpwithinvention.org/2015/11/protect-your-invention-infographic-on-our-learning-center/">protecting your invention.</a></p>
                    <br>
                    <p class="pServices">Get <a href="{{url('newSub')}}"> started with a free product assessment</a> or call 888-344-6836 to speak to one of our consultants. We are here to help you protect your invention!</p>
                </div>
            </div>
        </div>
    </section><!--main-section-end-->

@endsection

@section('footer_scripts')
@endsection
