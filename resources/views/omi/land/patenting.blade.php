@extends('omi.layout.land')
@section('metainfo')
    <meta name="description" content="Get access to full-service patent assistance services along with additional benefits when you work with Patent Services USA." />
@endsection
@section('title')
    Patenting Your Idea | How to Get Patent New Ideas | Patents for Inventions
@endsection
@section('content')

    <section class="main-section" id="Portfolio"><!--main-section-start-->
        <div class="container">
            <h2>Patenting</h2>
            {{--<h6>Fresh portfolio of designs that will keep you wanting more.</h6>--}}
            <div class="row">
                <div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices">Are you wondering if getting a patent is right for you?</p>
                    <br>
                    <p class="pServices">Many people choose to patent a new product idea because they are looking to profit from their innovation. Others choose to patent because they want to protect their <a href="{{url('learn/Intellectual-Property')}}">intellectual property</a>, and some choose this path because they want to gain recognition.</p>
                    <br>
                    <p class="pServices">Why do you want to get a patent?</p>
                    <br>
                    <p class="pServices">The United Stated Patent and Trademark Office defines a patent as: A property right granted by the Government of the United States of America to an inventor “to exclude others from making, using, offering for sale, or selling the invention throughout the United States or importing the invention into</p>
                </div>
                <figure class="col-lg-8 col-sm-6 text-right wow text-center fadeInUp delay-02s"><!-- -->
                    <img src="{{asset('img/services/Patenting.jpg')}}" alt="InventionHelp">
                </figure>
                <div class="col-lg-12 col-md-12 col-sm-6 wow fadeInLeft delay-05s"><!---->
                    <p class="pServices">the United States” for a limited time in exchange for public disclosure of the invention when the patent is granted.</p>
                    <br>
                    <p class="pServices">Like other forms of property rights such as real estate, patent rights may be transferred, sold or licensed by the owner to earn a profit.</p>
                    <br>
                    <p class="pServices">Generally, there are three steps involved in the patenting process:</p>
                    <br>
                    <ol class="pServices">
                        <li>A patent search.</li>
                        <li>Preparing and <a href="{{url('patent-filing')}}">filing the patent application.</a></li>
                        <li>One or more prosecutions to defend the patent.</li>
                    </ol>
                    <br>
                    <p class="pServices">These steps remain the same for each patented product; however the complexity and effort involved in each patent application may vary substantially depending on what is being patented.</p>
                    <br>
                    <p class="pServices">The <a href="http://www.uspto.gov/">U.S. Patent and Trademark Office (USPTO)</a> "strongly recommends that all prospective applicants retain the services of a registered patent agent or patent attorney to prepare and prosecute their applications."</p>
                    <br>
                    <p class="pServices">Get in touch with us to find out how you can get started with a <a href="{{url('newSub')}}">free product assessment!</a></p>
                    <br>
                    <p class="pServices">At Patent Services USA, our goal is to help you establish patent protection and to assist you with licensing and marketing your invention or product idea. Once you establish patent protection, you may work with one of our professional licensing affiliates. These affiliates work entirely on contingency fee basis and can assist you with licensing or marketing your invention idea directly to manufacturers.</p>
                    <br>
                    <p class="pServices">You can also <a href="https://www.facebook.com/PatentServicesUSA/">follow us</a> on Facebook.</p>
                </div>
            </div>
        </div>
    </section><!--main-section-end-->

@endsection

@section('footer_scripts')
@endsection
