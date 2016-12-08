@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title"><h4 class="page-title">Update Page Information</h4></h4>
        </div>
    </div>
    <div class="row">
        {!! Form::open(array('url' => url('/').'/menu_intro/edit/'.$data[0]->menu_intro_id,'files'=>'true','class' => 'form-horizontal')) !!}
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class="form-group row form-main-box">
                            {!!Form::label('headline','Headline',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::text('headline', $data[0]->headline, array('class'=>'form-control')) !!}
                                @if ($errors->has('headline')) <p class="help-block text-danger">{{ $errors->first('headline') }}</p> @endif
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('header_image','Header Image',['class' => 'control-label col-md-4'])!!}
                            <div class="col-md-7">
                                {!! Form::file('header_image', array('class'=>'btn btn-block btn-grey')) !!}
                                <?php if (isset($data[0]->header_image) && ($data[0]->header_image != "")) { ?>
                                    <a target="_blank" href="<?php echo url('/') . "/resources/views/Menu/menu_intro_files/" . $data[0]->header_image; ?>">View</a>
                                    <a href="<?php echo url('/') . "/menu_intro/deleteImage/".$data[0]->menu_intro_id ; ?>" onclick="return confirm('Are you sure you want to delete this image?');">|Delete</a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('menu_intro','Menu Intro',['class' => 'control-label col-sm-4 col-md-4 p-t-10'])!!}
                            <div class="col-sm-6 col-md-7">
                                <div class="adjoined-bottom">
                                    <div class="grid-container">
                                        <div class="grid-width-100">
                                            {!! Form::textarea('menu_intro', $data[0]->menu_intro, array('id' => 'board_member_intro')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">  {!! Form::submit('Save Page',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> {!! Form::submit('Save Page',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!} 
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/adapters/jquery.js'; ?>"></script>
<script src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/js/sample.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/config.js"></script> 
<link rel="stylesheet" href="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<script>
//replcae map_direction id by ck_editor
    CKEDITOR.replace('menu_intro', {
        height: 350
    });
</script>
@endsection