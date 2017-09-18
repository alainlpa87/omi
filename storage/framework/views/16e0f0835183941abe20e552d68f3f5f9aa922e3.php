<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title>Protect Your Product & Invention Idea with a Patent - Patent Services USA</title>
    <!-- CSS  ================================================== -->
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.min.css"/>
    <link href="<?php echo e(asset('/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('https://fonts.googleapis.com/css?family=Knewave')); ?>" rel='stylesheet' type='text/css'>
    <link href="<?php echo e(asset('/css/omiCommon.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/launchTemplate/css/basic.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('/plugins/launchTemplate/css/custom.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(asset('/plugins/component/components.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(asset('/css/hover-min.css')); ?>" rel="stylesheet" media="all">
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                document,'script','//connect.facebook.net/en_US/fbevents.js');

        fbq('init', '1669170773333510');
        fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1669170773333510&ev=PageView&noscript=1"
                /></noscript>
    <SCRIPT type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </SCRIPT>
    <!-- End Facebook Pixel Code -->
    <?php echo $__env->yieldContent('header_styles'); ?>
</head>
<!-- Body -->
<!-- Part 1: #Header -->
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="header-left col-md-5 col-sm-5">
                <a class="linkPatentServices" href="\"><img src="<?php echo e(asset('img/logos/icologo_lg.png')); ?>" alt="Patent Services Logo" width="48">PATENT SERVICES</a>
                <ul class="list-unstyled list-inline ulContact">
                    <li><a href="mailto:info@ownmyinvention.com"><i class="fa fa-envelope-o"></i><span> info@ownmyinvention.com</span></a></li>
                    <li><a href="tel:#"><i class="fa fa-phone"></i><span> 888-344-6836</span></a></li>
                </ul>
            </div>
            <div class="header-right col-md-7 col-sm-7 additional-nav">
                <a href="http://inventorssociety.net/" target="_blank">
                    <img src="<?php echo e(asset('img/logos/issf2.png')); ?>" width="15%" alt="Inventor Society of South Florida" style="float: right;padding-top: 7px;">
                </a>
                <a href="http://www.dandb.com/verified/business/672862398/" target="_blank">
                    <img src="<?php echo e(asset('img/logos/dyblogo.png')); ?>" width="14%" alt="VERIFIED Seal" style="float: right;margin-right: 10px;">
                </a>
                <img src="<?php echo e(asset('img/logos/us_chamber.png')); ?>" width="11%" alt="U.S. Chamber Of Commerce" style="float: right;margin-right: 10px;">
                <a href="http://www.uiausa.org/" target="_blank">
                    <img src="<?php echo e(asset('img/logos/uiaNew.png')); ?>" width="15%" alt="United Inventors Association Of America" style="float: right;margin-right: 10px;">
                </a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <div class="inner-text">
                               <span id="spanUser">  <?php echo e(ucwords($client->fname." ".$client->lname)); ?> <i class="fa fa-sign-out"></i></span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo e(route('launch')); ?>"><i class="fa fa-dashboard "></i>Launch Center</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('launch/profile')); ?>"><i class="fa fa-user"></i>Inventor Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-yelp "></i>My Projects <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php $__currentLoopData = $client->projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($project->status!="EXCLUDE"): ?>
                                    <li>
                                        <a href="<?php echo e(route('launch/project',$project->id)); ?>"><i class="fa fa-key "></i><?php echo e($project->ideaName); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($client->projects) == 0): ?>
                                <li>
                                    <a href="<?php echo e(route('sub')); ?>"><i class="fa fa-key "></i>Create New Project</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-upload "></i>Upload Files<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php $__currentLoopData = $client->projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($project->status!="EXCLUDE"): ?>
                                    <li>
                                        <a href="javascript:;" class="linkUploadFileProject" data-id="<?php echo e($project->id); ?>"><i class="fa fa-upload "></i><?php echo e($project->ideaName); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <?php if($client->makePaymentAvailable()): ?>
                    <li>
                        <a href="#"><i class="fa fa-money "></i>Make a Payment<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php $__currentLoopData = $client->projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($project->status!="EXCLUDE"): ?>
                                    <?php if($project->lastContractNoWP() !=null && $project->lastContractNoWP()->paid < $project->lastContractNoWP()->price && in_array($project->stage,array("WOM", 'WALKTHRU',"DROP", "DROP/IMG", "ARCHIVE","PHASE2","CONTRACT")) && ($project->stage=="WALKTHRU"||$project->lastContractNoWP()->type=="IGUP"||$project->lastContractNoWP()->type=="PPA" || new \DateTime($project->actionDate) <= new \DateTime())): ?>
                                        <?php if($project->lastContractNoWP()->funding==1||($project->lastContractNoWP()->type=="PPA" && strlen($project->lastContractNoWP()->signed)>0)): ?>
                                            <li>
                                                <form method="POST" action="<?php echo e(url("payment")); ?>" id="paymentForm_<?php echo e($project->id); ?>">
                                                    <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                                                    <input type="hidden" name="contract_id" value="<?php echo e($project->lastContractNoWP()->id); ?>">
                                                </form>
                                                <a href="javascript:;" onclick="$('#paymentForm_<?php echo e($project->id); ?>').submit();">
                                                    <i class="fa fa-money"></i><?php echo e($project->ideaName); ?>

                                                </a>
                                            </li>
                                        <?php else: ?>
                                        <li>
                                            <a href="<?php echo e(route('launch/signBeforePaid',$project->id)); ?>" class="linkMakePaymentProject" data-id="<?php echo e($project->id); ?>"><i class="fa fa-money"></i><?php echo e($project->ideaName); ?></a>
                                        </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(isset($allowTickets)  && $allowTickets == 1): ?>
                    <li>
                        <a href="<?php echo e(route('showTickets')); ?>"><i class="fa fa-envelope"></i>Manage Tickets</a>
                    </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo e(url('learn/Welcome-to-Our-Learning-Center')); ?>"><i class="fa fa-lightbulb-o "></i>Learning Center</a>
                    </li>
                   <li>
                        <a href="blank.html"><i class="fa fa-square-o "></i>Settings<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li id="changePass" data-id="<?php echo e($client->id); ?>">
                                <a href="javascript:;"><i class="fa fa-desktop "></i>Change Password </a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">

                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line bubble">
                            <p class="greet">Welcome to your Launch Center</p>
                        </h1>
                    </div>
                </div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <?php echo $__env->make('intranet.tools.UploadFileModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('omi.tools.changePasswordModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('omi.tools.client_services.returnPatentAppNotesModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div id="footer-sec">
        &copy; 2016 Patent Services USA
    </div>
    <script src="<?php echo e(asset('/plugins/jquery/jquery-1.11.3.js')); ?>" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(asset("js/autoNumeric.js")); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset("/js/tools.js")); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset("/plugins/launchTemplate/js/jquery.metisMenu.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/launchTemplate/js/custom.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/sweetalert/sweetalert.min.js")); ?>"></script>
    <script src="<?php echo e(asset("/js/omi/launch.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/moment.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datetimepicker.js")); ?>"></script>
    <script src="<?php echo e(asset("/plugins/bootstrap/bootstrap-datepicker.js")); ?>"></script>
    
    <script src="<?php echo e(asset("plugins/jquery/dropzone.js")); ?>"></script>
    <script src="<?php echo e(asset("js/uploadFile/uploadFileLaunch.js")); ?>"></script>
    <?php echo $__env->yieldContent('footer_scripts'); ?>
    <!-- Google Code for Remarketing Tag -->
    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 930107513;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/930107513/?value=0&amp;guid=ON&amp;script=0"/>
        </div>
    </noscript>
</body>
</html>