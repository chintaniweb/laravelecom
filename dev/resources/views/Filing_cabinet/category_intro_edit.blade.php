@extends('layouts.master_admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title"><?php echo "Filing Cabinet Category Information"; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            {!! Form::model($data,array('route' => array('Filing_cabinet_category_intro.update',$data->filing_cabinet_category_intro_id), 'method' => 'PUT','files'=>'true','class' => 'form-horizontal','id'=>'myForm')) !!}
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class="form-group row form-main-box">
                            <label class="control-label col-sm-4" for="site"><strong>Headline</strong></label>
                            <div class="col-sm-7">
                                {!! Form::text('headline',null,['class'=>'form-control', 'id' => 'headline']) !!} 
                            </div>

                        </div>
                        <div class="form-group row form-main-box">
                            <label class="control-label col-sm-4" for="site">Header Image</label>
                            <div class="col-sm-7">
                                {!! Form::file('header_image',['class' => 'btn btn-block btn-grey', 'autocomplete' => 'off']),null!!}
                            </div>
                            <?php $header_image = (isset($data->header_image) && ($data->header_image != "")) ? $data->header_image : ""; ?>

                            <?php if (isset($header_image) && ($header_image != "")) { ?>
                                <a target="_blank" href="<?php echo url('/') . "/resources/views/Filing_cabinet/filing_cabinet_category_intro_files/" . $header_image; ?>">View</a>
                                <a href="<?php echo url('/') . "/Filing_cabinet_category_intro/deleteImage/" . $data->filing_cabinet_category_intro_id; ?>" onclick="return confirm('Are you sure you want to delete this image?');">|Delete</a>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4"><strong>Cabinet Category Intro</strong></label>
                            <div class="col-sm-6 col-md-7">
                                <div class="adjoined-bottom">
                                    <div class="grid-container">
                                        <div class="grid-width-100">
                                            {!! Form::textarea('filesystem_intro',null,['class'=>'form-control', 'id' => 'editor_1']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                    <div class="clearfix"></div>
                </div>
                
            </div>
        </div>
    </div>
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center">{!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    {!! Form::close() !!} 
</div>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/adapters/jquery.js'; ?>"></script>
<script>
//replcae editor_1 id by ck_editor
$('#editor_1').ckeditor(); // if class is prefered.
</script>

@endsection