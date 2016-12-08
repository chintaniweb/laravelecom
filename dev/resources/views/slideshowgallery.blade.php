@extends('layouts.master_front')
@section('content')
<section>
    <div class="inner-content-section">  	
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12 left-side-bar side-bar">
                    <div class="side-menu">
                        <div class="side-menu-title">About Us</div>
                        <ul>
                            <li><a href="<?php echo url('/') . '/page/boces-overview' ?>" title="">BOCES Overview</a></li>
                            <li><a href="<?php echo url('/') . '/page/wswhe-boces' ?>" title="">WSWHE BOCES</a></li>
                            <li><a href="<?php echo url('/') . '/page/district-superintendent-of-schools' ?>" title="">District Superintendent of Schools</a></li>
                            <li><a href="<?php echo url('/') . '/page/districts-we-serve' ?>" title="">Districts We Serve</a></li>
                            <li><a href="<?php echo url('/') . '/page/board-of-education' ?>" title="">Board of Education</a></li>
                            <li><a href="http://www.wswheboces.org/documents.cfm?id=14.39" title="">Board Agenda/Minutes</a></li>
                            <li><a href="<?php echo url('/') . '/page/boe-policies' ?>" title="">BOE Policies</a></li>
                            <li><a href="<?php echo url('/') . '/page/notifications' ?>" title="">Notifications</a></li>
                            <li><a href="<?php echo url('/') . '/page/boces-report-card' ?>" title="">BOCES Report Card</a></li>
                            <li><a href="<?php echo url('/') . '/staff_directory' ?>" title="">Staff Directory</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-xs-12 content-area left-side-bar-on">
                    <div class="content-area-title"><?php echo $data[0]->title; ?></div>
                    <div class="content-area-desc slideshow-gallery">
                        <div class="m-b-10">click any photo to see large view&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo url('/') . "/Slide_show/Index/" . $data[0]->slide_show_id; ?>" title="">click here to view slideshow</a></div>
                        <div class="row">
                            <?php foreach ($slide_image_data as $slide_image) { ?>
                                <div class="col-md-3 col-sm-4 col-xs-6 slideshow-gallery-item">
                                    <figure><img src="<?php echo url('/') . "/resources/views/Slide_show/slide_show_file/" . $slide_image->image; ?>" alt="" title=""  height="80" width="180"></figure>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop