<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1">
        <meta name="description" content="Patent Services USA helps make patenting an idea simple. Resource for anyone trying to get a patent, product research or get a prototype for an idea." />
        
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <link rel="icon" href="favicon.png" type="image/png">
        <link rel="shortcut icon" href="favicon.ico" type="img/x-icon">

        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600' rel='stylesheet' type='text/css'>

        <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('/plugins/colorbox/colorbox.css')); ?>" rel="stylesheet"> <!-- colorbox css-->
        <link href="<?php echo e(asset('/plugins/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css" >
        <link href="<?php echo e(asset('css/land.css')); ?>" rel="stylesheet" type="text/css" >
        <link href="<?php echo e(asset('/plugins/theme/css/responsive.css')); ?>" rel="stylesheet" type="text/css" >
        <link href="<?php echo e(asset('/plugins/theme/css/animate.css')); ?>" rel="stylesheet" type="text/css" >
        <link href="<?php echo e(asset('/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.min.css"/>

        

        <script src="<?php echo e(asset('/plugins/jquery/jquery-1.11.3.js')); ?>" type="text/javascript"></script> <!-- jQuery -->
        <script src="<?php echo e(asset('/plugins/jquery/jquery-ui.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('/plugins/jquery/jquery.easing.1.3.js')); ?>" type="text/javascript"></script> <!-- jQuery easing -->
        <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap.min.js")); ?>"></script>
        <script src="<?php echo e(asset('/plugins/colorbox/jquery.colorbox.js')); ?>" type="text/javascript"></script> <!-- jQuery colorbox -->
        <script src="<?php echo e(asset('/plugins/theme/js/jquery-scrolltofixed.js')); ?>" type="text/javascript"></script> <!-- jQuery -->
        <script src="<?php echo e(asset('/plugins/theme/js/jquery.isotope.js')); ?>" type="text/javascript"></script> <!-- jQuery -->
        <script src="<?php echo e(asset('/js/tools.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('/plugins/theme/js/wow.js')); ?>" type="text/javascript"></script> <!-- jQuery -->
        <script src="<?php echo e(asset('/plugins/theme/js/classie.js')); ?>" type="text/javascript"></script> <!-- jQuery -->
        <script src="<?php echo e(asset("/js/omi/landLayout.js")); ?>"></script>
        <script src="<?php echo e(asset("/plugins/sweetalert/sweetalert.min.js")); ?>"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
        <?php echo $__env->yieldContent('header_styles'); ?>
    </head>
    <body>
    <header class="header" id="header"><!--header-start-->


        <img class="bottom changeImg" alt="Patent Services USA" src="<?php echo e(asset('img/land/header02.jpg')); ?>" />
        <img class="top changeImg" alt="Patent Services USA" src="<?php echo e(asset('img/land/header03.jpg')); ?>" />

        
        <div class="pre-header">
            <div class="col-md-4 col-sm-4">
                <a class="patentName" href="https://www.ownmyinvention.com/" style="color: #FFFFFF;text-decoration: none;">
                    <img style="vertical-align:text-bottom;" src="<?php echo e(asset('img/logos/icologo_lg.png')); ?>" alt="Patent Services USA Logo" width="48">
                    PATENT SERVICES USA
                </a>
                <ul class="list-unstyled list-inline" style="padding-left: 2%">
                    <li>
                        <a href="mailto:info@ownmyinvention.com">
                            <i class="fa fa-envelope-o whiteColor"></i>
                            <span class="whiteColor">info@ownmyinvention.com</span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:#18883446836">
                            <i class="fa fa-phone whiteColor"></i>
                            <span class="whiteColor">888-344-6836</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-offset-1 col-md-7" style="padding-top: 10px">
                <a class="btn btn-primary col-md-offset-1 col-md-5 col-xs-12 btnLogin" href="<?php echo e(url('/launch/login')); ?>">
                    <i class="fa fa-lock" style=""></i>Click here to login to <br>your project
                </a>
                <a class="btn btn-success col-md-5 col-xs-12 btnSub" href="<?php echo e(url('newSub#Portfolio')); ?>">
                    <i class="fa fa-lock"></i>Click here to submit <br>your new product idea
                </a>
            </div>
            
            <nav class="main-nav-outer col-md-12" id="topMenu"><!--main-nav-start-->
                <div class="container" style="">
                    <ul class="main-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Launch<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(url('launch/login')); ?>">Launch Center</a></li>
                                <li><a href="<?php echo e(url('newSub#Portfolio')); ?>">New Submission</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Learn<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(url('learning')); ?>">Learning Center</a></li>
                                <li><a href="<?php echo e(url('aboutUs#Portfolio')); ?>">About Us</a></li>
                                <li><a href="<?php echo e(url('faq#Portfolio')); ?>">FAQ</a></li>
                                <li><a href="<?php echo e(url('download#Portfolio')); ?>">Downloads</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo e(url('tradeshows#Portfolio')); ?>">Trade Shows</a></li>
                        <li><a class="menu" href="<?php echo e(url('home#service')); ?>">Services</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reviews<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(url('bbbReviews')); ?>">BBB</a></li>
                                <li><a href="http://www.shopperapproved.com/reviews/ownmyinvention.com/">Shopper Approved</a></li>
                                <li><a href="https://www.customerlobby.com/reviews/42159/patent-services-usa-inc/">Customer Lobby</a></li>
                                <li><a class="menu" href="http://patentservicesusareviews.com/">PSU Testimonials</a></li>
                                <li><a href="<?php echo e(url('badReviews#Portfolio')); ?>">Bad Reviews</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Successes<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(url('awardedPatents#Portfolio')); ?>">Awarded Patents</a></li>
                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Media<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="https://www.youtube.com/embed/pKC6fqN_W2E?rel=0">Discovery Channel</a></li>
                                <li><a href="http://www.huffingtonpost.com/entry/7-benefits-of-using-a-patent-services-company_us_57edde4be4b095bd896a0aaf">Huffington Post</a></li>
                                <li><a href="<?php echo e(url('learningGivenArt/Industry Expert Radio Segment 1')); ?>">Radio</a></li>
                            </ul>
                        </li>
                        <li><a class="menu" href="<?php echo e(url('home#contact')); ?>">Contact Us</a></li>
                    </ul>
                    <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
                </div>
            </nav>
            
        </div>
        


        <div class="container headerContainer">
            <div class="brEbook" style="margin-bottom: 25px">
                <a class="patentName" href="https://www.ownmyinvention.com/">
                    <img style="vertical-align:text-bottom;" src="<?php echo e(asset('img/logos/icologo_lg.png')); ?>" alt="Patent Services Logo" width="48">
                    PATENT SERVICES USA
                </a>
                <ul class="list-unstyled list-inline" style="padding-left: 2%">
                    <li>
                        <a href="mailto:info@ownmyinvention.com">
                            <i class="fa fa-envelope-o whiteColor"></i>
                            <span class="whiteColor">info@ownmyinvention.com</span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:#18883446836">
                            <i class="fa fa-phone whiteColor"></i>
                            <span class="whiteColor">888-344-6836</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 col-xs-12 brEbook" style="padding-top: 5px;margin-bottom: 80px;">
                <a class="btn btn-primary col-md-5 col-xs-12 wow fadeInLeft delay-06s btnLogin" href="<?php echo e(url('/launch/login')); ?>">
                    <i class="fa fa-lock" style=""></i>Click here to login to <br>your project
                </a>
                <a class="btn btn-success col-md-5 col-xs-12 wow fadeInRight delay-06s btnSub" href="<?php echo e(url('newSub#Portfolio')); ?>">
                    <i class="fa fa-lock"></i>Click here to submit <br>your new product idea
                </a>
            </div>
            <div class="col-md-4 pull-right headerForm">
                <p class="caption lfr tp-caption start wow fadeInRight delay-06s" style="text-align: center;color: #ffffff"><strong class="strong28">FREE PATENT <br class="brEbook">E-BOOK </strong><br class="br49"><span class="spanHeader49">$49 value</span>
                </p>
                <p class="firstStep wow fadeInRight delay-06s whiteColor">Your First Step to Success</p>
                <form role="form" id="form_1">
                    <div>
                        <div class="form-group wow fadeInRight delay-06s">
                            <div class="input-group">
                            <span class="input-group-addon borderPos">
                                <i class="fa fa-user"></i>
                            </span>
                                <input type="text" id="fnameSubHeader" data-uid="3ced837374b95e1a5c516f6270b1bd9f" class="form-control borderFocus" placeholder="First Name">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group wow fadeInRight delay-06s">
                            <div class="input-group">
                            <span class="input-group-addon borderPos">
                                <i class="fa fa-user"></i>
                            </span>
                                <input type="text" id="lnameSubHeader" data-uid="3ced837374b95e1a5c516f6270b1bd9f" class="form-control borderFocus" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-body">
                            <div class="form-group wow fadeInRight delay-06s">
                                <div class="input-group">
                                <span class="input-group-addon borderPos">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                    <input type="email" id="emailSubHeader" data-uid="3ced837374b95e1a5c516f6270b1bd9f" class="form-control borderFocus" placeholder="Email Address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group wow fadeInRight delay-06s">
                            <div class="input-group">
                            <span class="input-group-addon borderPos">
                                <i class="fa fa-phone"></i>
                            </span>
                                <input type="text" id="dphonenoSubHeader" data-uid="3ced837374b95e1a5c516f6270b1bd9f" class="form-control borderFocus" placeholder="Contact Number">
                            </div>
                        </div>
                    </div>
                    <div>
                    <span class="input-group-btn col-md-12 col-xs-12" id="submitRequest">
                            <button class="btn wow fadeInRight delay-06s" type="button" id="sendInfo">
                                Submit Your Request
                                <i class="fa fa-arrow-right fa-fw"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>

        </div>




    </header>
    <!--header-end-->

    <!--menu mobile: solo se usa en mobiles-->
    <nav class="main-nav-outer brEbook" id="test"><!--main-nav-start-->
        <div class="container">
            <ul class="main-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Launch<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(url('launch/login')); ?>">Launch Center</a></li>
                        <li><a href="<?php echo e(url('newSub#Portfolio')); ?>">New Submission</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Learn<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(url('learning')); ?>">Learning Center</a></li>
                        <li><a href="<?php echo e(url('aboutUs#Portfolio')); ?>">About Us</a></li>
                        <li><a href="<?php echo e(url('faq#Portfolio')); ?>">FAQ</a></li>
                        <li><a href="<?php echo e(url('download#Portfolio')); ?>">Downloads</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo e(url('tradeshows#Portfolio')); ?>">Trade Shows</a></li>
                <li><a class="menu" href="<?php echo e(url('home#service')); ?>">Services</a></li>
                <li class="small-logo"><a href="<?php echo e(url('indexNew')); ?>"><img style="width: 94px;height: 75px;"  src="<?php echo e(asset('img/logos/logoWithoutBackground.png')); ?>" alt="Patent Services USA Logo"></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reviews<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(url('bbbReviews')); ?>">BBB</a></li>
                        <li><a href="http://www.shopperapproved.com/reviews/ownmyinvention.com/">Shopper Approved</a></li>
                        <li><a href="https://www.customerlobby.com/reviews/42159/patent-services-usa-inc/">Customer Lobby</a></li>
                        <li><a class="menu" href="http://patentservicesusareviews.com/">PSU Testimonials</a></li>
                        <li><a href="<?php echo e(url('badReviews#Portfolio')); ?>">Bad Reviews</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Successes<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(url('awardedPatents#Portfolio')); ?>">Awarded Patents</a></li>
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Media<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="https://www.youtube.com/embed/pKC6fqN_W2E?rel=0">Discovery Channel</a></li>
                        <li><a href="http://www.huffingtonpost.com/entry/7-benefits-of-using-a-patent-services-company_us_57edde4be4b095bd896a0aaf">Huffington Post</a></li>
                        <li><a href="<?php echo e(url('learningGivenArt/Industry Expert Radio Segment 1')); ?>">Radio</a></li>
                    </ul>
                </li>
                <li><a class="menu" href="<?php echo e(url('indexNew#contact')); ?>">Contact Us</a></li>
            </ul>
            <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
        </div>
    </nav>
    <!--end menu mobile-->

    
    <?php echo $__env->yieldContent('content'); ?>

    <!--======================Footer============================ -->
    <footer class="footer">
        <div class="container">
            <div class="footer-logo"><a href="#"><img style="max-width: 120% !important;"  src="<?php echo e(asset('img/logos/logoGrey.png')); ?>" alt="Patent Services USA Logo"></a></div>
            <span class="copyright">&copy; 2012-<?php echo e(date("Y")); ?> Patent Services USA. All Rights Reserved</span>
            <span class="footer-terms-links"><a href="<?php echo e(url('terms#Portfolio')); ?>">Terms and Conditions</a><a href="<?php echo e(url('privacy#Portfolio')); ?>">Privacy</a><a href="<?php echo e(url('legal#Portfolio')); ?>">Legal</a></span>
        </div>
    </footer>

    <?php echo $__env->yieldContent('footer_scripts'); ?>
    <!-- =====================End Footer============================= -->
    </body>
</html>