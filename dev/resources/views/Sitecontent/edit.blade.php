@extends('layouts.master_admin')
@section('content')

<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}
    .text-danger .alert {padding: 0 !important; margin-bottom: 5px !important; font-weight: normal !important;}
    .text-danger .alert strong {font-weight: normal !important;}

    .tab-main-bg{float:left; width:100%; background:#f4f8fb; height:30px; font-family:Verdana, Geneva, sans-serif;}
    .tab-main-bg ul{float:left; list-style:none; margin:0; padding:0; font-size:13px;}
    .tab-main-bg ul li{float:left; margin:4px 10px 0 15px; padding:0 10px; color:#222222; line-height:24px;}
    .tab-main-bg ul li a{text-decoration:none; color:#222222}
    .tab-main-bg ul li a:hover{text-decoration:none; color:#000;}
    .tab-main-bg ul li.active{float:left; padding:0 10px; background:#fff; border-top-left-radius:3px; border-top-right-radius:3px; border:1px solid #aaaaaa; border-bottom:1px solid #fff;}

    /* right box css */
    .sort-down{ float:right; font-size:18px; padding:0; margin:0; color:#000;}
    .sort-down a, .sort-down:hover{ color:#000;padding:0; margin:0;}
    .display-inline{ display:inline;}
    .fa-eye, .fa-history, .fa-map-pin, .fa-calendar{ font-size:15px;}
    .btn-right{ float:right;}
    .move-btn { float:left; display:inline-block; margin-top:10px;}
    #published, #publishtab2, #publishtab3 { display:none;}
    /* right box css over here */

    #accessurl { display:none;}
</style>

<link rel="stylesheet" href="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<?php 
 if (Session::has('website_id')) {

    $website = Session::get('website_id');
    
 }?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Update Site Content</h4>
        </div>
        <div class="col-xs-12 col-sm-7 text-right p-t-10"> 
            <a target="_blank" href="
            <?php
            
            $page_type  = $data[0]->page_type;
            $link = $data[0]->access_url;
            
            if (stristr($link, 'http')) {
                $link = $data[0]->access_url;
            } 
            else {
                if($page_type == "Typical Page"){
                    $link = website_url() . '/page/' . $data[0]->access_url;
                }
                else{
                    $link = website_url() . '/' . $data[0]->access_url;
                }
            } 
            echo $link;
            ?>">View page on Site</a>
        </div>
    </div>
    <div class="row">
        {!! Form::open(array('url' => url('/').'/sitecontent/edit/'.$data[0]->sitecontent_id,'files'=>'true','class' => 'form-horizontal')) !!}
        {!! Form::hidden('parent_id', $data[0]->parent_id) !!}
        <div class="col-xs-9 col-sm-9 m-t-20">
            <div class="card-box m-b-0">
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                @endif

                <!-------------------- Tabs for Page-info, Images, Files, Links --------------------->
                
                <div class="tab-main-bg">
                        <ul>
                            <li class="active"><a href="#" title="">Page Info</a></li>
                            <li><a href="<?php echo url('/') . '/sitecontent/create_image/'.$data[0]->sitecontent_id  ; ?>" title="">Images</a></li>
                            <li><a href="<?php echo url('/') . '/sitecontent/create_file/'.$data[0]->sitecontent_id ; ?>" title="">Files</a></li>
                            <li><a href="<?php echo url('/') . '/sitecontent/create_link/'.$data[0]->sitecontent_id ; ?>" title="">Links</a></li>
                        </ul>
                </div>
                
                <div class="row">
                    <div role="grid" class="dataTables_wrapper" id="datatable-editable_wrapper">
                        <div class="col-lg-12 padding-15">
                            <div class="research-box padding-15">

                                <!-- PAGE INFORMATION -->      
                                <div class="p-20" id="general">

                                    <div class="info-title page-info page-info-title"> Page Information </div>

                                    <div class="form-group form-main-box">
                                        {!! Form::label('Navigation Title', 'Navigation Title *',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('navigation_title', $data[0]->navigation_title, 
                                            array('class' => 'form-control','id' => 'navigation_title')) !!}

                                            @if ($errors->has('navigation_title')) 
                                            <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('navigation_title') }}</p> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('Page Type', 'Page Type *',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::select('page_type', ['Typical Page' => 'Typical Page','Goto Page' => 'Goto Page'],
                                            $data[0]->page_type,array('class' => 'form-control', 'id' => 'purpose')) !!}

                                            @if ($errors->has('page_type')) 
                                            <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('page_type') }}</p> 
                                            @endif
                                        </div>
                                    </div>
                                    <div id="permalink_show" hidden="false"><i class="" ></i> 
                                        <span id="permalink_show" style="margin-left:230px;">
                                            <?php
                                            $page_type  = $data[0]->page_type;
                                            $link = $data[0]->access_url;
            
                                                if (stristr($link, 'http')) {
                                                    $link = $data[0]->access_url;
                                                } 
                                                else {
                                                    if($page_type == "Typical Page"){
                                                        $link = website_url() . '/page/' . $data[0]->access_url;
                                                    }
                                                    else{
                                                        $link = website_url() . '/' . $data[0]->access_url;
                                                    }
                                                } ?>

                                            Permalink : <a href="<?php echo $link ?>" target="_blank" id="a_perlink" ><?php echo $link ?></a>
                                        </span>
                                        <span class="edit_permalink" class="btn-right">
                                            <a href="#" title="" class="btn btn-primary btn-rect btn-sm" >Edit</a>
                                        </span>
                                    </div>
                                    <br>
                                    <div class="form-group form-main-box" id="accessurlshow">
                                        {!! Form::label('Access URL', 'Access URL *',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('access_url', $data[0]->access_url, array('class' => 'form-control',
                                            'id' => 'access_url')) !!}
                                            @if ($errors->has('access_url')) 
                                            <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('access_url') }}</p> 
                                            @endif
                                        </div>
                                        <span id="okcancel_permalink" class="btn btn-primary m-l-10">OK</span>
                                        <span id="cancel_permalink" class="m-l-10"><a href="#" title="">Cancel</a></span>
                                    </div> 

                                    <div class="form-group form-main-box">
                                        {!! Form::label('Page Title', 'Page Title *',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('page_title', $data[0]->page_title, array('class' => 'form-control')) !!}
                                            @if ($errors->has('page_title')) 
                                            <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('page_title') }}</p> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('Sub Title', 'Sub Title',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('sub_title', $data[0]->sub_title, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        {!! Form::label('Content Type', 'Content Type',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::select('content_type', ['Schools' => 'Schools','MainPage' => 'MainPage','Internal' => 'Internal'],
                                            $data[0]->content_type,array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('On Site', 'On Site',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::select('on_site', ['Yes' => 'Yes','No' => 'No'],$data[0]->on_site,
                                            array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('Sort', 'Sort',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('page_sort', $data[0]->page_sort, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="info-title page-info page-info-title">Page HTML</div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-md-12">
                                            <div class="adjoined-bottom">
                                                <div class="grid-container">
                                                    <div class="grid-width-100">
                                                        {!! Form::textarea('page_text', $data[0]->page_text, 
                                                        ['class' => 'form-control','id' => 'editor_1']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--------------------------SEO SECTION START----------------------------------->
                                    <div class="info-title page-info page-info-title">SEO Information
                                        <span class="sort-down">
                                            <a  title="">
                                                <i class="fa fa-arrow-circle-down seo-down" aria-hidden="true"></i> 
                                                <i class="fa fa-arrow-circle-up seo-down" style="display:none" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <div class="seo-con">
                                        <div class="form-group row form-main-box">
                                            <label class="control-label col-md-4">
                                                <?php
                                                (isset($data[0]->meta_title) && ($data[0]->meta_title != "")) ? $meta_title = $data[0]->meta_title : $meta_title = "";

                                                //$meta_title = $data['page'][0]['meta_title']; 
                                                if (strlen($meta_title) <= 10) {
                                                    echo '<div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                } else if (strlen($meta_title) > 10 && strlen($meta_title) <= 30) {
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                } else if (strlen($meta_title) > 30 && strlen($meta_title) <= 50) {
                                                    echo '<div style="width: 20px; height:20px; background-color: green; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: green; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: green; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: green; float:left; margin-right:10px;"></div>';
                                                } else {
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                }
                                                ?><strong>Meta Title</strong>&nbsp;(max chars 50)
                                            </label>
                                            <div class="col-md-7">
                                                {!! Form::text('meta_title', $data[0]->meta_title, array('class' => 'form-control',
                                                'id' => 'meta_title')) !!}
                                            </div>
                                            <div class="col-md-1">[<?php echo strlen($meta_title); ?>]</div>
                                        </div>
                                        <!-------------META DESCRIPTION---------->
                                        <div class="form-group">
                                            <label class="control-label col-md-4">
                                                <?php
                                                (isset($data[0]->meta_description) && ($data[0]->meta_description != "")) ?
                                                                $meta_description = $data[0]->meta_description : $meta_description = "";

                                                //$meta_title = $data['page'][0]['meta_title']; 
                                                if (strlen($meta_description) <= 10) {
                                                    echo '<div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                } else if (strlen($meta_description) > 10 && strlen($meta_description) <= 30) {
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                } else if (strlen($meta_description) > 30 && strlen($meta_description) <= 50) {
                                                    echo '<div style="width: 20px; height:20px; background-color: green; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: green; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: green; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: green; float:left; margin-right:10px;"></div>';
                                                } else {
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                }
                                                ?><strong>Meta Description</strong> &nbsp;(max chars 250)
                                                <i data-tooltip="tooltip" title="" data-original-title="Page HTML"></i>
                                            </label>
                                            <div class="col-md-7">
                                                {!! Form::textarea('meta_description', $data[0]->meta_description, 
                                                ['size' => '30x5','class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-1">[<?php echo strlen($meta_description); ?>]</div>
                                        </div>

                                        <!-------------META KEYWORDS---------->
                                        <div class="form-group row form-main-box">
                                            <label class="control-label col-md-4">
                                                <?php
                                                (isset($data[0]->meta_keywords) && ($data[0]->meta_keywords != "")) ?
                                                                $meta_keywords = $data[0]->meta_keywords : $meta_keywords = "";

                                                //$meta_keywords = $data['page'][0]['meta_keywords'];
                                                if (strlen($meta_keywords) <= 30) {
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                } else if (strlen($meta_keywords) > 30 && strlen($meta_keywords) <= 65) {
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                } else if (strlen($meta_keywords) > 65 && strlen($meta_keywords) <= 100) {
                                                    echo '<div style="width: 20px; height:20px; background-color:green; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color:green; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color:green; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height:20px; background-color:green; float:left; margin-right:10px;"></div>';
                                                } else {
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                    echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                }
                                                ?><strong>Meta Keywords</strong>&nbsp;(max chars 150)
                                            </label>
                                            <div class="col-md-7">
                                                {!! Form::textarea('meta_keywords', $data[0]->meta_keywords, 
                                                ['size' => '30x5','class' => 'form-control','id' => 'meta_keywords']) !!}
                                            </div>
                                            <div class="col-md-1">[<?php echo strlen($meta_keywords); ?>]</div>
                                        </div>

                                        <div class="form-group row form-main-box">
                                            <label class="control-label col-md-4">
                                            <?php
                                            (isset($data[0]->targeted_keyword) && ($data[0]->targeted_keyword != "")) ?
                                                            $targeted_keyword = $data[0]->targeted_keyword : $targeted_keyword = "";

                                            //$targeted_keyword = $data['page'][0]['targeted_keyword'];
                                            if (strlen($targeted_keyword) <= 30) {
                                                echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                            } else if (strlen($targeted_keyword) > 30 && strlen($targeted_keyword) <= 65) {
                                                echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height:20px; background-color: yellow; float:left; margin-right:10px;"></div>';
                                            } else if (strlen($targeted_keyword) > 65 && strlen($targeted_keyword) <= 100) {
                                                echo '<div style="width: 20px; height:20px; background-color:green; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height:20px; background-color:green; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height:20px; background-color:green; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height:20px; background-color:green; float:left; margin-right:10px;"></div>';
                                            } else {
                                                echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                                echo '<div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>';
                                            }
                                            ?><strong>Targeted Keywords</strong>&nbsp;(max chars 150)
                                            </label>

                                            <div class="col-md-7">
                                                {!! Form::textarea('targeted_keyword', $data[0]->targeted_keyword, 
                                                ['size' => '30x5','class' => 'form-control','id' => 'targeted_keyword']) !!}
                                            </div>

                                            <div class="col-md-1"> [<?php echo strlen($targeted_keyword); ?>]</div>
                                        </div>
                                    </div>
                                    <!--------------------------SEO SECTION END----------------------------------->
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                    {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'MyFunction()')) !!}
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- right  box -->
        <div class="col-xs-3 col-sm-3 m-t-20">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="card-box">
                        <div class="bg-muted p-10">Publish
                            <span class="sort-down">
                                <a href="#" title="">
                                    <i class="fa fa-arrow-circle-down circle-down" aria-hidden="true"></i> 
                                    <i class="fa fa-arrow-circle-up circle-down" style="display:none" aria-hidden="true"></i>
                                </a>
                            </span>
                        </div>

                        <div class="publish-con">
                            <div class="">
                                <i class="fa fa-map-pin m-r-5  p-t-20" aria-hidden="true"></i>Status: 
                                <span id="page_status">{{$data[0]->status}}</span> 
                                <span class="edit-show m-l-10"><a href="#" title="">Edit</a></span>
                            </div>

                            <div id="published" class="p-t-10">
                                {!! Form::select('status', ['Draft' => 'Draft','Pending' => 'Pending Review','Published'=>'Published'],
                                $data[0]->status,array('class' => 'form-control','id' => 'status')) !!}
                                <span id="okcancel" class="btn btn-primary m-l-10  m-t-10">OK</span>
                                <span id="cancel" class="m-l-10"><a href="#" title="">Cancel</a></span>
                            </div>

                            <div class="p-t-5">
                                <div  class="p-t-20"><i class="fa fa-eye m-r-5" aria-hidden="true"></i>Visibility: 
                                    <strong><span id="page_visibility">{{$data[0]->visibility}}</span></strong>
                                    <span id="publishtabedit2" class="m-l-10"><a href="#" title="">Edit</a></span>
                                </div>

                                <div id="publishtab2">

                                    <label class="label_checkbox">
                                        <?php
                                        if ($data[0]->visibility == 'Public') {
                                            $visibility = true;
                                        } else {
                                            $visibility = false;
                                        }
                                        ?>
                                        {!! Form::radio('visibility', 'Public', $visibility,array('class' => 'm-r-10')) !!}
                                        <span>Public</span>
                                    </label><br>

                                    <label class="label_checkbox">
                                        <?php
                                        if ($data[0]->visibility == 'Password protected') {
                                            $visibility = true;
                                        } else {
                                            $visibility = false;
                                        }
                                        ?>
                                        {!! Form::radio('visibility', 'Password protected',$visibility,array('id' => 'visibility',
                                        'class' => 'm-r-10','onclick' => 'MyAlert()')) !!}
                                        <span>Password protected</span>
                                    </label><br>

                                    <div class="p-t-10" id="password_protected" style="display: none;">
                                        {!! Form::text('password', $data[0]->password, array('class' => 'form-control')) !!}
                                    </div>

                                    <label class="label_checkbox">
                                        <?php
                                        if ($data[0]->visibility == 'Private') {
                                            $visibility = true;
                                        } else {
                                            $visibility = false;
                                        }
                                        ?>
                                        {!! Form::radio('visibility','Private',$visibility,array('class' => 'm-r-10')) !!}
                                        <span>Private</span>
                                    </label><br>
                                    <span id="okvisibility" class="btn btn-primary">OK</span>
                                    <span class="m-l-10"><a id="p-cancel" href="#" title="">Cancel</a></span>
                                </div>
                            </div>
                            <div class="p-t-5">
                                <?php $updated_date = date("M/d/Y H:m:ia", strtotime($data[0]->updated_at)); ?>
                                <div class="p-t-20"><i class="fa fa-calendar m-r-5" aria-hidden="true"></i>Updated on: <strong><?php echo $updated_date; ?></strong></div>
                                <div id="publishtab3" class="p-t-10"><input id="page_title" class="form-control" type="text" value="" name=""><br>
                                    <span class="btn btn-primary">OK</span>
                                    <span class="m-l-10"><a id="p-cancel3" href="#" title="">Cancel</a></span>
                                </div>
                            </div> 
                            <div class="bg-muted p-10 m-t-15">
                                <a class="move-btn" href="{{url('/')}}/sitecontent/delete/{{$data[0]->sitecontent_id}}" onclick="return confirm('Are you sure you want to delete this item?');" title="Move to Bin">Move to Trash</a>
                                <span class="btn-right">
                                    {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'MyFunction()')) !!}
                                </span>
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                    {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'MyFunction()')) !!}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/config.js"></script> 
<script>

var $website_id = <?php echo $website ;?>;
//alert($website_id);

    //on page type change
    $('#purpose').on('change', function () {
        $("#accessurlshow").toggle(this.value == 'Goto Page');
        if (this.value == 'Goto Page') {
            $('#permalink_show').hide();
        }
        if (this.value == 'Typical Page') {
            $('#permalink_show').show();
        }
    });
    /* right box script */
    $(document).ready(function () {

        $(".circle-down").click(function () {
            $(".publish-con").slideToggle();
            $('.fa-arrow-circle-down').toggle();
            $('.fa-arrow-circle-up').toggle();
        });
        $(".edit-show").click(function () {
            $("#published").slideToggle();
                    $('#status :selected').text() = document.getElementById("page_status").textContent;
                    $('.edit-show').hide();
        });
        $("#cancel").click(function () {
            $("#published").slideUp();
            $('.edit-show').show();
        });

        //ok status
        $("#okcancel").click(function () {
            $("#published").slideUp();
            //alert($('#status :selected').text());
            document.getElementById("page_status").textContent = $('#status :selected').text();
            $('.edit-show').show();
        });

        //ok visibility button
        $("#okvisibility").click(function () {

            $("#publishtab2").slideUp();
            //assign value into lable
            document.getElementById("page_visibility").textContent = $("input[name=visibility]:checked").val();
            $('#publishtabedit2').show();
        });


        $("#publishtabedit2").click(function () {
            $("#publishtab2").slideToggle();
            $('#publishtabedit2').hide();
        });

        $("#p-cancel").click(function () {
            $("#publishtab2").slideUp();
            $('#publishtabedit2').show();
        });

        $("#publishtabedit3").click(function () {
            $("#publishtab3").slideToggle();
            $('#publishtabedit3').hide();
        });

        $("#p-cancel3").click(function () {
            $("#publishtab3").slideUp();
            $('#publishtabedit3').show();
        });
        // on click edit button will show edit access url box
        $(".edit_permalink").click(function () {
            $("#permalink_show").hide();
            $("#accessurlshow").show();
                    $('#access_url').text() = document.getElementById("access_url").textContent;
                    $('.edit_permalink').hide();
            $("#permalink_show").show();
        });
        // cancel button close the text box 
        $("#cancel_permalink").click(function () {
            $("#accessurlshow").hide();
            $('#permalink_show').show();
        });
        // on click ok button change permalink for only view
        $("#okcancel_permalink").click(function () {
            var per_val = document.getElementById("access_url").value;
            var access_url_link;
            if (per_val.indexOf("http") > -1) {

                access_url_link = per_val;
            }
            else {
                 var type = document.getElementById("purpose").textContent;
                 
                 if($website_id == 1){
                
                        if(type == "Typical page"){
                             access_url_link = '<?php echo url('/') . '/page/'; ?>' + per_val;
                        }
                        else{
                             access_url_link = '<?php echo url('/') . '/'; ?>' + per_val;
                        }
                   }
                   else if($website_id == 2){
                        if(type == "Typical page"){
                             access_url_link = CTE_URL +'<?php echo 'page/'; ?>' + per_val;
                        }
                        else{
                             access_url_link = CTE_URL +'<?php echo ''; ?>' + per_val;
                        }
                   } 
                    else{
                        if(type == "Typical page"){
                             access_url_link = ETA_URL +'<?php echo 'page/'; ?>' + per_val;
                        }
                        else{
                             access_url_link = ETA_URL +'<?php echo ''; ?>' + per_val;
                        }
                   } 
            }
            document.getElementById("a_perlink").innerHTML = access_url_link;
            document.getElementById('access_url').value = per_val;
            $("#accessurlshow").hide();
            $('#permalink_show').show()
        });
        
        //SEO toggle
        $(".seo-down").click(function () {
            $(".seo-con").slideToggle();
            $('.fa-arrow-circle-down').toggle()
            $('.fa-arrow-circle-up').toggle()
        });

    });

    $("#tab2").click(function () {
        $("#tab-description2").slideToggle();
        $("#tab1").toggleClass("top-btn-hide");
        $("#tab2 .fa").toggleClass("fa-angle-double-up");
        $("#tab2 .fa").toggleClass("fa-angle-double-down");
    });

    //password protected open text-box
    function MyAlert() {
        $("#password_protected").slideToggle();
    }

    //form submit
    function MyFunction() {

        //if access_url blank
        if (document.getElementById("access_url").value == "") {
            if (document.getElementById("purpose").value == "Typical Page") {
                generate_url();
            }
        }
        else {
            if (document.getElementById("purpose").value == "Typical Page") {
                set_url();
            }
        }
    }

    //Generate url by fetch menu title
    function generate_url() {

        var menu_title = document.getElementById("navigation_title").value;
        var new_url = menu_title.split(' ').join('-');
        document.getElementById("access_url").value = new_url.toLowerCase();
    }

    //Set url by fetch menu title 
    //if change data in url 
    function set_url() {

        var access_url = document.getElementById("access_url").value;
        var new_url = access_url.split(' ').join('-');
        document.getElementById("access_url").value = new_url.toLowerCase();
    }
</script>
<script src="<?php echo url('/').'/vendor/unisharp/laravel-ckeditor/ckeditor.js';?>"></script>
<script src="<?php echo url('/').'/vendor/unisharp/laravel-ckeditor/adapters/jquery.js';?>"></script>
<script src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/js/sample.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/config.js"></script> 
<link rel="stylesheet" href="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

<script>
          CKEDITOR.replace('editor_1', {
                      height: 500,
                      filebrowserBrowseUrl:  '/tfs/boces_laravel/dev/vendor/unisharp/laravel-ckeditor/ckfinder/ckfinder.html',
                      filebrowserUploadUrl:   '/tfs/boces_laravel/dev/vendor/unisharp/laravel-ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                      filebrowserWindowWidth: '1000',
                      filebrowserWindowHeight: '700'
             
        });
        CKFinder.setupCKEditor(editor, '/tfs/boces_laravel/dev/vendor/unisharp/laravel-ckeditor/ckfinder/');
</script>
@endsection