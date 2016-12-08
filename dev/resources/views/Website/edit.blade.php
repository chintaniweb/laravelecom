@extends('layouts.master_admin')
@section('content')
<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}
    #form label.error {color:red; }
    #form input.error { border:1px solid red;}
</style>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Update Website</h4>
        </div>
    </div>
    <div class="row">
        {!! Form::model($data, array('route' => array('Website.update', $data->website_id), 'method' => 'PUT','files'=>'true','class' => 'form-horizontal','id'=>'myForm')) !!}
        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                        @endif
                        <div class="form-group row form-main-box">
                            {!!Form::label('Name','Name',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                            <div class="col-md-7">
                                {!!Form::text('name',null,['class'=>'form-control','id'=>'name'])!!}
                                @if ($errors->has('name')) <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('discription','Description',['class'=>'control-label col-sm-4 text-right','style'=>'padding-top:8px'])!!}
                            <div class="col-sm-7">
                                <div class="adjoined-bottom">
                                    <div class="grid-container">
                                        <div class="grid-width-100">
                                            {!! Form::textarea('discription', null, array('id' => 'editor1')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('Status','Status',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                            <div class="col-md-7">
                                {!! Form::select('status', ['Yes' => 'Yes','No' => 'No'] ,null,['class' => 'form-control']) !!}
                            </div>
                        </div> 
                        <div class="form-group row form-main-box">
                            {!!Form::label('Website Logo','Website Logo',['class'=>'control-label col-sm-4 text-right','style'=>'padding-top:8px'])!!}
                            <div class="col-sm-7">
                                {!! Form::file('website_logo',['class'=>'btn btn-block btn-grey','id'=>'website_logo']) !!}
                            </div>
                            <?php if (isset($data->website_logo) && ($data->website_logo != "")) { ?>
                                <a target="_blank" href="<?php echo url('/') . "/resources/views/Website/website_files/" . $data->website_logo; ?>">View</a>
                                <a href="<?php echo url('/') . "/Website/deleteImage/" . $data->website_id; ?>" onclick="return confirm('Are you sure you want to delete this image?');">|Delete</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                        {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                    </div>
                </div>
                {!!Form::close()!!}
                <div class="clearfix">
                    <!-- Delete Form --> 
                    {!! Form::open(array('url' => 'Website/' . $data->website_id)) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'return confirm("Are you sure you want to delete this item?")')) !!}
                    {!! Form::close() !!}

                    check here to delete this website
                </div>
            </div>
        </div>
    </div>
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> <a id="btn2" class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save</a></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/adapters/jquery.js'; ?>"></script>
<script src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/js/sample.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/config.js"></script> 
<link rel="stylesheet" href="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>

<script>
                                $(function () {
                                    $('#btn').click(function (e) {
                                        e.preventDefault();
                                        $("#myForm").submit();
                                    });
                                    $('#btn2').click(function (e) {
                                        e.preventDefault();
                                        $("#myForm").submit();
                                    });

                                });

                                $(document).ready(function () {
                                    $("#myForm").validate({
                                        rules: {
                                            name: {required: true},
                                        },
                                        messages: {
                                            name: "The Name field is required",
                                        },
                                        errorElement: 'div'
                                    });
                                });
</script>

<!-- CK EDITOR INTEGRATION -->
<script>
//replcae map_direction id by ck_editor
    CKEDITOR.replace('editor1', {
        height: 350
    });

</script>
<script>
    initSample();
</script>
<!-- CK EDITOR INTEGRATION over-->
@stop
