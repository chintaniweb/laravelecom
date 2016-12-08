@extends('layouts.master_front')
@section('content')
<style>
    .youtube-video {position: relative; padding:15px 15px; margin: 0 10px;}
    .youtube-video p {margin:0;}
    .youtube-video .yt-video-link {float:left; width: 100%; height:100%; padding:0;}
    .youtube-video .yt-video-link a {position:absolute; left:0; top:0; width: 100%; height:100%;}
    .youtube-video .yt-video-link a:hover {float:left; width:100%; padding:0; margin:0; height:100%;}
</style>
<section>
    <div class="slider-section">
        <div class="slider1">
            <div class="container">
                <div class="slider-for slick-slider-1">
                    <?php
                    $spotlight_slide_show = frontGetSpotlightSlideShow();
                    //print_r($spotlight_slide_show);exit;
                    if (count($spotlight_slide_show) > 0) {
                        foreach ($spotlight_slide_show as $slide_show) {
                            ?>
                            <div class="slider-item">
                                <img src="<?php echo url('/') . "/resources/views/Spotlight_story/spotlight_story_files/" . $slide_show->story_image; ?>" alt="banner">
                                <div class="slider-desc">              
                                    <p>
                                        <?php
                                            if (strlen($slide_show->description) > 110) {
                                                echo $text = substr($slide_show->description, 0, strpos($slide_show->description, ' ', 110)) . "...";
                                            } else {
                                                echo $slide_show->description;
                                            }
                                        ?>
                                    </p>
                                    
                                </div>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
                <div class="slider-nav">
                    <?php
                    if (count($spotlight_slide_show) > 0) {
                        foreach ($spotlight_slide_show as $slide_show) {
                            ?>
                            <div class="slider-nav-item">
                                <div class="slider1-title">
                                    <span class="slider-nav-title">
                                    <?php  
                                        preg_match("/(?:\w+(?:\W+|$)){0,10}/", $slide_show->title, $matches);
                                        echo $matches[0];
                                    ?>
                                    </span>
                                    <span class="link">
                                        <a href="<?php echo url('/') . '/view_story/' . $slide_show->spotlight_story_id; ?>" class="btn btn-default">
                                            READ MORE &raquo;
                                        </a>
                                    </span>
                                </div>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="slider2">
            <div class="container">
                <div class="slider2-title">Videos</div>
                <div class="slick-slider-2">
                    <?php
                    $video = frontGetVideos();
                    if (count($video) > 0) {
                        $load = 2;
                        foreach ($video as $videos) {
                            $data = str_replace('&lt;', '<', $videos->paragraph);
                            $data = str_replace('&gt;', '>', $data);
                            // get ifrmae src
                            preg_match('/src="([^"]+)"/', $data, $src);
                            $path = $src[1];

                            // check if it is youtube
                            if (strpos($path, 'youtube') !== false) {
                                // get video id
                                preg_match('/embed([^?]+)/', $path, $id);
                                $img = str_replace($path, 'http://img.youtube.com/vi' . $id[1] . '/0.jpg', $data);
                                ?>
                                <div class="youtube-video load-<?php echo $load; ?>"> 
                                    <?php echo $img; ?>
                                    <span class="yt-video-link"><a href="<?php echo $path; ?>"></a></span>
                                </div>
                                <?php
                                $load++;
                            } 
                            else {
                                ?>
                                <div class="youtube-video load-<?php echo $load; ?>">
                                    <?php echo $data; ?>
                                    <span class="yt-video-link"><a href="<?php echo $path; ?>"></a></span>
                                </div>
                                <?php
                                $load++;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div> 

    </div>

    <div class="content-section load-3">
        <div class="container">
            <div class="content-section-in">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-xs-12 main-content">
                        <div class="content-section-title">About BOCES</div>
                        <div class="content-section-img"><img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/about-us.jpg" alt="about us"></div>
                        <div class="content-section-desc">
                            <p class="head">Welcome</p>
                            <p>
                            <?php
                            $about_us = frontGetAboutUs();
                            if (count($about_us) > 0) {
                                echo $text = substr($about_us[0]->page_text, 0, strpos($about_us[0]->page_text, ' ', 500)) . "...";
                            }
                            ?>
                            </p>
                            <a href="<?php echo url('/') . '/page/about-us'; ?>" class="btn btn-default pull-right"> READ MORE &raquo;</a>
                        </div>          
                    </div>
                    <div class="col-sm-6 col-md-4 col-xs-6 side-content-1">
                        <div class="side-content-in">
                            <div class="content-section-title">Latest News</div>
                            <div class="content-section-desc">
                                <?php
                                $news = frontGetNews();
                                if (count($news) > 0) {
                                    foreach ($news as $latest_news) {
                                        ?>   
                                        <div class="content-desc-item">
                                            <div class="desc-item-content">
                                                <p><strong><a href='<?php echo url('/') . '/school_news/view_news/' . $latest_news->school_news_id; ?>'><?php echo $latest_news->headline; ?></a></strong></p>
                                                <p class="date"><?php echo date('l,F d,Y', strtotime($latest_news->news_starting)); ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php }
                                }
                                ?>
                                <div><a href="<?php echo url('/') . '/school_news/allNews' ?>">View All News</a></div>
                            </div>
                        </div>  
                    </div>                        
                    <div class="col-sm-6 col-md-4 col-xs-6 side-content-2">
                        <div class="side-content-in">
                            <div class="content-section-title">Upcoming Events</div>
                            <div class="content-section-desc">
                                <?php
                                $events = frontGetEvents();
                                if (count($events) > 0) {
                                    foreach ($events as $event) {
                                        ?>
                                        <p>
                                            <a href="<?php echo url('/') . '/calendar_event/front_calendar_event_data/' . $event->calendar_event_id; ?>" 
                                               data-toggle="modal" data-target="#myModal"><?php echo $event->headline; ?>
                                            </a>
                                        </p>
                                        <p class="date"><?php echo date('l,F d,Y', strtotime($event->event_start)); ?></p>
                                        <hr>
                                    <?php }
                                }
                                ?>
                                <div><a href="<?php echo url('/') . '/calendar_event/front_calendar'; ?>">View All Events</a></div>
                                <!--<hr>-->
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="more-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6 more-content-box-1">
                    <div class="more-content-box">
                        <span class="counter">6</span>
                        <div class="more-content-box-title">Programs</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 more-content-box-2">
                    <div class="more-content-box">
                        <span class="counter">120</span>
                        <div class="more-content-box-title">Classes</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 more-content-box-3">
                    <div class="more-content-box">
                        <span class="counter">5</span>
                        <div class="more-content-box-title">Locations</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 more-content-box-4">
                    <div class="more-content-box">
                        <span>18:1</span>
                        <div class="more-content-box-title">Ratio</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="other-content">
        <div class="container">
            <div class="other-content-title">Learn More About Our Programs</div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-xs-6 load-4">
                    <div class="other-content-box">
                        <div class="other-content-box-title">Adult Students</div>
                        <div class="other-content-img"><a href="<?php echo url('/') . '/page/general-information-for-adults' ?>"><img src="<?php echo url('/') . "/resources/assets/front_themes/boces/images/programs-1.jpg"; ?>" alt="Adult Students"></a></div>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. mauris vitae erat consequat auctor eu in elit.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xs-6 load-5">
                    <div class="other-content-box">
                        <div class="other-content-box-title">Career & Technical Education</div>
                        <div class="other-content-img"><a href="<?php echo url('/') . '/page/open-houses-january-2015' ?>"><img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/programs-2.jpg" alt="Career & Technical Education"></a></div>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. mauris vitae erat consequat auctor eu in elit.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-ms-12 visible-sm visible-xs"></div>
                <div class="col-sm-6 col-md-4 col-xs-6 load-6">
                    <div class="other-content-box">
                        <div class="other-content-box-title">Enrichment Resource Center</div>
                        <div class="other-content-img"><a href="<?php echo url('/') . '/page/overview' ?>"><img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/programs-3.jpg" alt="Enrichment Resource Center"></a></div>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. mauris vitae erat consequat auctor eu in elit.</p>
                    </div>
                </div>
                <div class="col-md-12 visible-md"></div>
                <div class="col-sm-6 col-md-4 col-xs-6 load-7">
                    <div class="other-content-box">
                        <div class="other-content-box-title">Special Education</div>
                        <div class="other-content-img"><a href="<?php echo url('/') . '/page/component-classes' ?>"><img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/programs-4.jpg" alt="PTECH"></a></div>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. mauris vitae erat consequat auctor eu in elit.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-ms-12 visible-sm visible-xs"></div>
                <div class="col-sm-6 col-md-4 col-xs-6 load-8">
                    <div class="other-content-box">
                        <div class="other-content-box-title">School Support Services</div>
                        <div class="other-content-img"><a href="<?php echo url('/') . '/page/school-support-services' ?>"><img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/programs-5.jpg" alt="Special & Alternative Education"></a></div>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. mauris vitae erat consequat auctor eu in elit.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xs-6 load-9">
                    <div class="other-content-box">
                        <div class="other-content-box-title">Administrative Services</div>
                        <div class="other-content-img"><a href="<?php echo url('/') . '/page/administrative-services' ?>"><img src="<?php echo url('/') . "/resources/assets/front_themes/boces/"; ?>images/programs-6.jpg" alt="SUNY Andirondack Early College"></a></div>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. mauris vitae erat consequat auctor eu in elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection