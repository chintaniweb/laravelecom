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
            <h4 class="page-title">Site Content Links(s)</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="tab-main-bg">
                <ul>
                    <li><a href="<?php echo url('/') . '/sitecontent/edit/' . $id ?>" title="">Page Info</a></li>
                    <li><a href="<?php echo url('/') . '/sitecontent/create_image/' . $id; ?>" title="">Images</a></li>
                    <li><a href="<?php echo url('/') . '/sitecontent/create_file/' . $id; ?>" title="">Files</a></li>
                    <li class="active"><a href="<?php echo url('/') . '/sitecontent/create_link/' . $id; ?>" title="">Links</a></li>
                </ul>
            </div>

            {!! Form::open(array('url' => url('/').'/sitecontent/add_link/'.$id,'class' => 'form-horizontal','files'=>'true')) !!}
            {!! Form::hidden('_token', csrf_token(), array('class' => 'form-control')) !!}


            <form id="myForm" class="form-horizontal" action="<?php echo url('/') . 'Sitecontent/Admin/Sitecontent/' . $id; ?>" method="post" enctype="multipart/form-data">
                <div class="card-box m-b-0">
                    <br>
                    <div class="info-title page-info page-info-title"> Add New Links </div>
                    <div class="row">
                        <div class="col-md-7 col-xs-12">
                            <div class="form-group row form-main-box">
                                {!!Form::label('Web Site Address','Web Site Address *',['class' => 'control-label col-md-4'])!!}
                                <div class="col-sm-7">
                                    {!! Form::text('website_url', null,array('class' => 'form-control','id' => 'website_url')) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('Friendly Link','Friendly Link',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::text('friendly_url', null,array('class' => 'form-control','id' => 'friendly_url')) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('Web Site Description','Web Site Description',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::textarea('website_description', null,array('class' => 'form-control','id' => 'website_description')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!!Form::label('Sort','Sort',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::text('link_sort', null,array('class' => 'form-control','id' => 'link_sort')) !!}
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
                        <div class="info-title page-info page-info-title"> Current Links </div>
                        <div><?php foreach ($data as $row) { ?>
                                <p>
                                    <?php
                                    if ($row->website_url != "") {
                                        ?>
                                    <div align="left">
                                        <div>URLs:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;<?php echo $row->website_url; ?>&nbsp;&nbsp;&nbsp;
                                            <a href="<?php echo url('/') . '/sitecontent/delete_link/' . $id . '/' . $row->site_content_links_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php
                                if ($row->friendly_url != "") {
                                    ?>
                                    <div align="left">
                                        <div>Friendly link:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;<?php echo $row->friendly_url; ?></div>
                                    </div>
                                <?php } ?><br>
                            <?php }
                        }
                        ?>
                        </p>
                    </div>

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
@endsection