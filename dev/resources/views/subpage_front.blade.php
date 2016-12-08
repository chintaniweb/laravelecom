@extends('layouts.master_front')

@section('content')
<section>
    <div class="inner-content-section">
        <div class="container">
            <div class="row">
                <div class="breadcrumb-bg">
                    <div class="container">
                        <div class="breadcrumb">
                            <?php
                            if (isset($bread_crumb_link)) {
                                echo $bread_crumb_link;
                            }?>
                        </div>
                    </div>
                </div>

                <br>
                <div class="col-sm-4 col-xs-12 left-side-bar side-bar">
                    <div class="side-menu">

                        <ul>
                            <?php
                            if (count($subpage_data) != 0) {
    
                                foreach ($subpage_data as $sub_data) {
                                    
                                        $link = $sub_data->access_url;

                                        if (stristr($link, 'http')) {
                                            $link = $sub_data->access_url;
                                        } 
                                        else {
                                                if($sub_data->page_type == "Typical Page"){
                                                    $link = url('/') . '/page/' . $sub_data->access_url;
                                                }
                                                else{
                                                    $link = url('/') . '/' . $sub_data->access_url;
                                                }
                                        }?>
                                    
                                    <li><a href="<?php echo $link; ?>"><?php echo $sub_data->navigation_title; ?></a></li>
                            
                              <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
                
                <div class="col-sm-8 col-xs-12 content-area left-side-bar-on">
                    <div class="content-area-title">
                        <?php
                        if (isset($page[0]->page_title)) {
                            echo $page[0]->page_title;
                        }
                        ?>
                    </div>
                    <div class="content-area-desc">
                        <p>  
                            <?php if (isset($page[0]->page_text)) {
                                        echo $page[0]->page_text;
                                }?>
                        </p>

                        <br>
                        <?php if (count($sitecontent_pdf) != 0) { ?>
                            <p class="head">Related Files</p>

                            <ul class="pdf-file-list">

                                <?php  foreach ($sitecontent_pdf as $row) {

                                        if (($row->file_name != "")) {?>
                                               <li>
                                                    <a href="<?php echo url('/') . "/resources/views/Sitecontent/Site_content_files/" .
                                                            $row->file_name; ?>" target="_blank">
                                                        <i class="fa fa-file-pdf-o"></i> 
                                                        <span><?php echo $row->file_name; ?></span>
                                                    </a>
                                               </li>

                                        <?php }
                                } ?>
                            </ul> 
                        <?php } ?>
                        <br>
                            <?php if (count($sitecontent_link) != 0) { ?>
                                        <p class="head">Related Links</p>

                                        <ul class="pdf-file-list">
                                            <?php foreach ($sitecontent_link as $row) { ?>

                                                        <li>
                                                            <a href="<?php echo $row->website_url; ?>" >
                                                                <i class="fa fa-external-link"></i> 
                                                                <span><?php echo $row->website_url; ?></span>
                                                            </a>
                                                        </li>

                                            <?php } ?>
                                        </ul>    
                        <?php } ?>
                    </div>
                    <div>
                        <p>
                            <span class='st_facebook' displayText='Facebook'></span>
                            <span class='st_twitter' displayText='Tweet'></span>
                            <span class='st_pinterest' displayText='Pinterest'></span>
                            <span class='st_sharethis' displayText='ShareThis'></span>
                            <span class='st_googleplus' displayText='Google +'></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection