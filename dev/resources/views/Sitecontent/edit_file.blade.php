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
            <h4 class="page-title">Site Content File(s)</h4>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="tab-main-bg">
                <ul>
                    <li><a href="<?php echo url('/') . '/sitecontent/edit/' . $data[0]->sitecontent_id ?>" title="">Page Info</a></li>
                    <li><a href="<?php echo url('/') . '/sitecontent/create_image/' . $data[0]->sitecontent_id; ?>" title="">Images</a></li>
                    <li class="active"><a href="#" title="">Files</a></li>
                    <li><a href="<?php echo url('/') . '/sitecontent/create_link/' . $data[0]->sitecontent_id; ?>" title="">Links</a></li>
                </ul>
            </div>

            {!! Form::open(array('url' => url('/').'/sitecontent/edit_file/'.$data[0]->sitecontent_id.'/'.$data[0]->site_content_files_id,'class' => 'form-horizontal','files'=>'true')) !!}
            {!! Form::hidden('_token', csrf_token(), array('class' => 'form-control')) !!}

            <div class="card-box m-b-0">
                <br>
                <div class="info-title page-info page-info-title"> Update File </div>

                <div class="row">
                    <div class="col-sm-12 col-xs-12 p-t-b-10"><strong></strong></div>
                    <div class="col-md-7 col-xs-12">
                        <div class="form-group row form-main-box">
                            {!!Form::label('Upload File','Upload File *',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::file('file_name',array('class'=>'btn btn-block btn-grey','id' => 'file_name')) !!}

                                @if ($errors->has('file_name')) 
                                   <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('file_name') }}</p> 
                                @endif  
                            </div>
                            <?php   if ((isset($data[0]->file_name)) && ($data[0]->file_name != "")) { ?>
                                        <a target="_blank" href="<?php echo url('/') . "/resources/views/Sitecontent/Site_content_files/" . $data[0]->file_name; ?>">View</a>
                            <?php }  ?>
                        </div>
                        <div class="form-group">
                            {!!Form::label('Friendly File Name','Friendly File Name',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::text('friendly_name', $data[0]->file_name,array('class' => 'form-control','id' => 'friendly_name')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!!Form::label('File Description','File Description',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::textarea('file_description', $data[0]->file_description,array('class' => 'form-control','id' => 'file_description')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!!Form::label('Sort','Sort',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::text('file_sort', $data[0]->file_sort,array('class' => 'form-control','id' => 'file_sort')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                        {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                    </div>
                    <div class="clearfix"></div><div class="clearfix"></div>
                    <br>
                </div>
            </div>
            <?php
            if (count($files) != 0) {
                ?>
                <div class="info-title page-info page-info-title"> Current Files  </div>
                <div class="row">
                    <div class="col-xs-12 m-t-20">
                        <div class="card-box">
                            <div class="container">
                                <div class="row m-0">
                                    <div role="grid" class="dataTables_wrapper site-content-grid" id="datatable-editable_wrapper">
                                        <div class="col-lg-12 p-0">
                                            <div id="list" class="site-content-isting-bg">

                                                <div id="response"> </div>
                                                <div class="col-sm-12 col-xs-12 m-b-10 p-10 site-content-isting-box">
                                                    <span class="col-sm-3 col-xs-12"><strong>Sort</strong></span>

                                                    <span class="col-sm-3 col-xs-12"><strong>Friendly File Information</strong></span>
                                                    <span class="col-sm-3 col-xs-12"><strong>Click for file</strong></span>

                                                    <span class="col-sm-3 col-xs-12"><strong>Action</strong></span>
                                                </div>
                                                <ul>
                                                    <?php
                                                    foreach ($files as $row) {
                                                        $file_name =  "resources/views/Sitecontent/Site_content_files/" . $row->file_name;
                                                        if (file_exists($file_name)) {?>
                                                            <li>
                                                                <span class="col-sm-3 col-xs-12"><?php echo $row->file_sort; ?></span>
                                                                <span class="col-sm-3 col-xs-12"><?php echo $row->friendly_name; ?></span>
                                                                <span class="col-sm-3 col-xs-12">
                                                                    <a href="<?php echo url('/') . '/resources/views/Sitecontent/Site_content_files/' . $row->file_name; ?>" target="_blank">
                                                                        <?php
                                                                        if (filesize($file_name) >= 1048576) {
                                                                            echo number_format(filesize($file_name) / 1048576, 2) . ' MB';
                                                                        } elseif (filesize($file_name) >= 1024) {
                                                                            echo number_format(filesize($file_name) / 1024, 2) . ' KB';
                                                                        }?>
                                                                    </a>
                                                                </span>
                                                                <span class="col-sm-3 col-xs-12">
                                                                    <a href="<?php echo url('/') . '/sitecontent/edit_file/'.$id.'/' . $row->site_content_files_id; ?>">Edit</a>|
                                                                    <a href="<?php echo url('/') . '/sitecontent/delete_file/' . $id.'/'.$row->site_content_files_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                                                </span>
                                                            </li>
                                                        <?php }
                                                    } ?>
                                                </ul>
                                            </div>
                                            <div id="log"></div>
                                            <div id="log2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } 
            ?>
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