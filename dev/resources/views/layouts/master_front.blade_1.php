<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php 
        $name = Request::segment(2);
        $meta_data = getMetaData($name);?>
        <title>BOCES - <?php echo  isset($meta_data[0]->page_title) ? $meta_data[0]->page_title : "" ; ?> </title>
        <meta name="title" content="<?php echo  isset($meta_data[0]->meta_title) ? $meta_data[0]->meta_title : "" ; ?>">
        <meta name="keyword" content="<?php echo  isset($meta_data[0]->	meta_keywords) ? $meta_data[0]->meta_keywords : "" ; ?>">
        <meta name="description" content="<?php echo  isset($meta_data[0]->meta_description) ? $meta_data[0]->meta_description : "" ; ?>">
        <!--<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>-->
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo url('/') . '/resources/assets/front_themes/boces/' ?>images/favicon.ico'/>
        <link rel="stylesheet" type="text/css" href="<?php echo url('/') . '/resources/assets/front_themes/boces/' ?>css/bootstrap.css?<?php echo rand(); ?>">
       
         <!-------------------- Front Style-Sheet ----------------------->
        {!! Html::style('resources/assets/front_themes/boces/css/font-awesome.css') !!}
        {!! Html::style('resources/assets/front_themes/boces/css/slick.css') !!}
        {!! Html::style('resources/assets/front_themes/boces/css/slick-theme.css') !!}
        {!! Html::style('resources/assets/front_themes/boces/css/style.css') !!}
        {!! Html::style('resources/assets/front_themes/boces/css/animate.css') !!}
        
        <!-- share this code -->
        <script type="text/javascript">(function () {
                window.switchTo5x = false;
                var e = document.createElement("script");
                e.type = "text/javascript";
                e.async = true;
                e.onload = function () {
                    try {
                        stLight.options({publisher: "44ab5535-2c52-435d-b11a-d2894403c868-a51c", doNotHash: false, doNotCopy: false, hashAddressBar: false});
                    } catch (e) {
                    }
                };
                e.src = ("https:" == document.location.protocol ? "https://ws" : "http://w") + ".sharethis.com/button/buttons.js";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(e, s);
            })();
        </script>        
    </head>

    <body>
        <header>
            <div class="header-1">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 contact-num">Tel: (518) 581-3310</div>
                        <div class="col-sm-9 col-xs-12">
                            <div class="search-box">
                                <!--<form method="get" id="MyForm" action="#"><?php //echo url('/'); ?>Search_statistics/search -->
                                {!! Form::open(array('url' => 'search','class' => 'form-horizontal','onsubmit'=>'myFunction','method'=>'get')) !!}
                                {!! Form::text('search_for', null, array('class' => 'form-control','id' => 'search_for', 'placeholder'=>'Search')) !!}
                                    <!--<input type="text" class="search-input" name="search_header" placeholder="Search" onsubmit="myFunction()">-->
                                {!! form::close() !!}
                            </div>
                            <div class="top-nav">
                                <ul class="list-unstyled list-inline">
                                    <li><a href="#">School Tool</a></li>
                                    <li><a href="#">BOCES Email</a></li>
                                    <li><a href="#">Workshops</a></li>
                                    <li><a href="#">Site Map</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="spy" class="header-2">
                <div class="container">
                    <div class="logo-box">
                        <a href="<?php echo url('/'); ?>" class="logo">
                            <img src="<?php echo url('/') . '/resources/assets/front_themes/boces/' ?>images/logo.jpg" alt="BOCES">
                        </a>
                    </div>
                </div>
            </div>
            
            <nav>
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    
                    @include('layouts.header_font_menu')

                </div>
            </nav>
        </header>

            @yield('content')
        
        <footer>
            <div class="footer-navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6 footer-box-1">
                            <div class="footer-title">Contact Info</div>
                            <div class="footer-detail-box">
                                <div class="ft-address">
                                    ADDRESS<br><strong>1153 Burgoyne Avenue, Suite 2,<br>Ft. Edward, New York <br>12828-1134</strong>
                                </div>
                                <div class="ft-telephone">
                                    TELEPHONE<br><strong>(518) 581-3310 or 746-3310 </strong>
                                </div>
                                <div class="ft-fax">
                                    FAX<br><strong>(518) 581-3319 or 746-3319</strong>
                                </div>
                                <div class="ft-email">
                                    EMAIL<br><a href="#">jwhite@wswheboces.org</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-xs-6 footer-box-2">
                            <div class="footer-title">Instagram</div>
                            <div class="footer-detail-box">
                                <img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/instagram-profiles.jpg" alt="Instagram Profiles">
                            </div>
                        </div>
        
                        <div class="hidden visible-sm visible-xs col-sm-12 col-xs-12"></div>
                        <div class="col-md-3 col-sm-6 col-xs-6 footer-box-3">
                            <div class="footer-title">Categories</div>
                            <div class="footer-detail-box">
                                <ul class="footer-menu">
                                    <li><a href="<?php echo url('/') . '/page/about-us' ?>">About</a></li>
                                    <li><a href="<?php echo url('/') . '/page/resources' ?>">Resource</a></li>
                                    <li><a href="<?php echo url('/') . '/page/programs' ?>">Program</a></li>
                                    <li><a href="<?php echo url('/') . '/page/services' ?>">Services</a></li>
                                    <li><a href="<?php echo url('/') . '/page/Location/Location' ?>">Locations</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-xs-6 footer-box-4">
                            <div class="footer-title">Latest Tweets</div>
                            <div class="footer-detail-box">
                                <img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/twitter.jpg" alt="Twitter">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="footer-copyright">
                <div class="scrollTo"><a href="#" class="scrollToTop">Scroll To Top</a></div>
                <div class="container">      
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 ft-copyright">&copy; 2016 BOCES All Rights Reserved</div>
                        <div class="col-sm-6 col-xs-12 ft-follow-us">FOLLOW US 
                            <a href="http://www.facebook.com">
                                <img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/fb.png" alt="facebook">
                            </a>
                            <a href="http://www.instagram.com">
                                <img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/instagram.png" alt="instagram">
                            </a>
                            <a href="http://www.linkedin.com">
                                <img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/linkedin.png" alt="linkedin">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </footer>
            
         <?php 
         if(Request::segment(1) != "calendar_event") { ?>
                <script type="text/javascript" src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>js/jquery-1.12.3.min.js"></script> 
        <?php } ?>
         
        <!-- Commom Javascript -->
        
        <script type="text/javascript" src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>js/bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>js/slick.js"></script>

        <!-- Script file for Animation and counter effect  -->
        <script src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>js/viewportchecker.js"></script>
        <script type="text/javascript" src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>js/jquery.counterup.min.js"></script>
        <script src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>js/waypoints.min.js"></script>
        <!-- End including of Script file for Animation and counter effect  -->
     
        <script type="text/javascript">

                                        function myFunction() {
                                            $("#MyForm").submit();

                                        }

                                        /* Code for animation effect for div  */
                                        jQuery(document).ready(function () {
                                            jQuery('.slider1').addClass("hidden").viewportChecker({
                                                classToAdd: 'visible animated fadeInUp', // Class to add to the elements when they are visible
                                                offset: 100
                                            });

                                            jQuery('.load-10').addClass("hidden").viewportChecker({
                                                classToAdd: 'visible animated fadeInUp', // Class to add to the elements when they are visible
                                                offset: 100
                                            });
                                            jQuery('.load-4,.load-5,.load-6,.load-7,.load-8,.load-9').addClass("hidden").viewportChecker({
                                                classToAdd: 'visible animated bounceInUp', // Class to add to the elements when they are visible
                                                offset: 100
                                            });
                                            jQuery('.footer-box-1,.footer-box-2').addClass("hidden").viewportChecker({
                                                classToAdd: 'visible animated bounceInLeft', // Class to add to the elements when they are visible
                                                offset: 100
                                            });
                                            jQuery('.footer-box-3,.footer-box-4').addClass("hidden").viewportChecker({
                                                classToAdd: 'visible animated bounceInRight', // Class to add to the elements when they are visible
                                                offset: 100
                                            });

                                        });
                                        /*Code ends for animation effect for div  */

                                        $(document).ready(function () {
                                            /*Code to display coundown effect  */
                                            $('.counter').counterUp({
                                                delay: 10, // the delay time in ms
                                                time: 1000 // the speed time in ms
                                            });
                                            /*Code ends to display coundown effect  */
                                            //Click event to scroll to top
                                            $('.scrollToTop').click(function () {
                                                $('html, body').animate({scrollTop: 0}, 800);
                                                return false;
                                            });
                                            //Slick Slider 1
                                            $('.slick-slider-1').slick({
                                                infinite: true,
                                                autoplay: true,
                                                arrows: false,
                                                slidesToShow: 1,
                                                slidesToScroll: 1,
                                                asNavFor: '.slider-nav'
                                            });
                                            $('.gallery-slider').slick({
                                                infinite: true,
                                                autoplay: true,
                                                slidesToShow: 1,
                                                slidesToScroll: 1,
                                            });
                                            $('.slider-nav').slick({
                                                slidesToShow: 1,
                                                slidesToScroll: 1,
                                                asNavFor: '.slick-slider-1',
                                                dots: false,
                                                arrows: true,
                                                focusOnSelect: true
                                            });
                                            //Slick Slider 2
                                            $('.slick-slider-2').slick({
                                                infinite: true,
                                                autoplay: true,
                                                slidesToShow: 4,
                                                slidesToScroll: 1,
                                                responsive: [
                                                    {
                                                        breakpoint: 1200,
                                                        settings: {
                                                            slidesToShow: 3
                                                        }
                                                    },
                                                    {
                                                        breakpoint: 992,
                                                        settings: {
                                                            slidesToShow: 2
                                                        }
                                                    },
                                                    {
                                                        breakpoint: 639,
                                                        settings: {
                                                            slidesToShow: 1
                                                        }
                                                    }
                                                ]
                                            });
                                        });
                                        $(window).on("load scroll", function () {
                                            var windowWidth = window.innerWidth || document.documentElement.clientWidth;
                                            if (windowWidth >= 320) {
                                                if ($(this).scrollTop() > $('.header .wrapper_w').height() + 60 + $('#topline').height()) {
                                                    $('#spy').addClass('fix');
                                                } else {
                                                    $('#spy').removeClass('fix');
                                                }
                                            }
                                        });
        </script>
        
        <!-- Modal Window for event section -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">            
                </div>
            </div>
        </div>
        
        <!-- Modal end -->
    </body>
   <?php  save_site_visit(); ?>
</html>
