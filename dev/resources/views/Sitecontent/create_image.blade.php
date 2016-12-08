@extends('layouts.master_admin')
@section('content')
<style>
    .text-danger .alert {padding: 0 !important; margin-bottom: 5px !important; font-weight: normal !important;}
    .text-danger .alert strong {font-weight: normal !important;}

    .tab-main-bg{float:left; width:100%; background:#f4f8fb; height:30px; font-family:Verdana, Geneva, sans-serif;}
    .tab-main-bg ul{float:left; list-style:none; margin:0; padding:0; font-size:13px;}
    .tab-main-bg ul li{float:left; margin:4px 10px 0 15px; padding:0 10px; color:#222222; line-height:24px;}
    .tab-main-bg ul li a{text-decoration:none; color:#222222}
    .tab-main-bg ul li a:hover{text-decoration:none; color:#000;}
    .tab-main-bg ul li.active{float:left; padding:0 10px; background:#fff; border-top-left-radius:3px; border-top-right-radius:3px; border:1px solid #aaaaaa; border-bottom:1px solid #fff;}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Site Content Image(s)</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="tab-main-bg">
                <ul>
                    <li><a href="<?php echo url('/') . '/sitecontent/edit/' . $id ?>" title="">Main Info</a></li>
                    <li class="active"><a href="#" title="">Images</a></li>
                    <li><a href="<?php echo url('/') . '/sitecontent/create_file/' . $id ?>" title="">Files</a></li>
                    <li><a href="<?php echo url('/') . '/sitecontent/create_link/' . $id; ?>" title="">Links</a></li>
                </ul>
            </div>
            {!! Form::open(array('url' => url('/').'/sitecontent/add_image/'.$id,'class' => 'form-horizontal','files'=>'true')) !!}
            {!! Form::hidden('_token', csrf_token(), array('class' => 'form-control')) !!}
            <div class="card-box m-b-0">
                <br>
                <div class="info-title page-info page-info-title"> Add New Images </div>
                <div class="row">
                    <div class="col-sm-12 col-xs-12 p-t-b-10"><strong></strong></div>
                    <div class="col-md-7 col-xs-12">
                        <div class="form-group row form-main-box">
                            {!!Form::label('Upload Image','Upload Image *',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::file('site_images',array('class'=>'btn btn-block btn-grey','id' => 'site_images')) !!}

                                @if ($errors->has('site_images')) 
                                <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('site_images') }}</p> 
                                @endif  
                            </div>
                        </div>
                        <div class="form-group">
                            {!!Form::label('Image Caption','Image Caption',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::text('image_caption', null,array('class' => 'form-control','id' => 'image_caption')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!!Form::label('More info about image','More info about image',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::text('image_info', null,array('class' => 'form-control','id' => 'image_info')) !!}
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('Link to URL?','Link to URL?',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::text('url', null,array('class' => 'form-control','id' => 'url')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                        {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                    </div>
                    <div class="clearfix"></div><div class="clearfix"></div>
                    <br>
                </div>
                <?php if (count($data) != 0) { ?>
                    <div class="info-title page-info page-info-title"> Current Images </div>
                    <?php foreach ($data as $row) { ?>
                        <?php
                        if (($row->site_images != "")) {
                            ?>
                            <div align="center">
                                <img width="200px" height="200px" src="<?php echo url('/') . "/resources/views/Sitecontent/Site_content_files/" . $row->site_images; ?>" alt="small image" border="0"><br>
                                <?php echo $row->image_caption ?><br>

                                <font face="verdana" size="-1" color="000000">
                                <a href="<?php echo url('/') . "/resources/views/Sitecontent/Site_content_files/" . $row->site_images; ?>" target="_blank">
                                    Click to see Large Image
                                </a>
                                </font>

                                | <a href="<?php echo url('/') . '/sitecontent/delete_image/' . $id . '/' . $row->site_content_images_id; ?>" 
                                     onclick="return confirm('Are you sure you want to delete this item?');">
                                    Delete
                                </a>
                            </div>
                            <br>
                        <?php } ?>
                    <?php }
                }
                ?>

            </div>

        </div>
    </div>
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                    {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<style>
    ul {
        padding:0px;
        margin: 0px;
    }
    #list li {
        margin: 0 0 3px;
        padding:8px;
        background-color:#e8e8e8;
        color:#000;
        list-style: none;
        font-size:13px;
    }
    .site-content-isting-bg ul {float:left; width: 100%; list-style: none; padding:0; margin: 0;}
    .site-content-isting-bg ul li {float:left; width: 100%;}
    .site-content-isting-box {background:#e9e9e9;}
    .site-content-isting-box span {padding-right:20px; font-size:13px; line-height:20px;}
</style>
@endsection