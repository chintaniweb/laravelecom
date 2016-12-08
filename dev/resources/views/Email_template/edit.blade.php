@extends('layouts.master_admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-b-15">
            <h4 class="page-title"><h4 class="page-title">Update Email_template</h4></h4>
        </div>
    </div>
    <div class="row">
        {!! Form::model($data, array('route' => array('Email_template.update', $data->email_template_id), 'method' => 'PUT','files'=>'true','class' => 'form-horizontal','id'=>'myForm')) !!}
        <div class="col-xs-12 col-sm-12">
            <div class="card-box">
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                @endif
                <div class="form-group row form-main-box">
                    <label class="control-label col-sm-4 col-md-3 p-t-10"><strong>Email Template Name</strong></label>
                    <div class="col-sm-6 col-md-5">
                        {!!Form::text('email_template_name',null,['class'=>'form-control','id'=>'email_template_name'])!!}
                        @if ($errors->has('email_template_name')) <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('email_template_name') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group row form-main-box">
                    {!!Form::label('From Name','From Name',['class'=>'control-label col-sm-4 col-md-3 p-t-10'])!!}

                    <div class="col-sm-6 col-md-5">
                        {!!Form::text('from_name',null,['class'=>'form-control','id'=>'from_name'])!!}
                        @if ($errors->has('from_name')) <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('from_name') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group row form-main-box">
                    {!!Form::label('From Email','From Email',['class'=>'control-label col-sm-4 col-md-3 p-t-10'])!!}
                    <div class="col-sm-6 col-md-5">
                        {!!Form::email('from_email',null,['class'=>'form-control','id'=>'from_email'])!!}
                        @if ($errors->has('from_email')) <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('from_email') }}</p>
                        @endif  
                    </div>
                </div>
                <div class="form-group row form-main-box">
                    {!!Form::label('Subject','Subject',['class'=>'control-label col-sm-4 col-md-3 p-t-10'])!!}
                    <div class="col-sm-6 col-md-5">
                        {!!Form::text('subject',null,['class'=>'form-control','id'=>'subject'])!!}
                        @if ($errors->has('subject')) <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('subject') }}</p>
                        @endif   
                    </div>
                </div>
                <!-- CK EDITOR INTEGRATION -->
                <div class="form-group row form-main-box">
                    {!!Form::label('Body','Body',['class'=>'control-label col-sm-4 col-md-3 p-t-10'])!!}
                    <div class="col-sm-6 col-md-9">
                        <div class="adjoined-bottom">
                            <div class="grid-container">
                                <div class="grid-width-100">
                                    {!! Form::textarea('body', null, array('id' => 'editor1')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row form-main-box">
                    <label class="control-label col-sm-4 col-md-3 p-t-10"></label>
                    <div class="col-sm-6 col-md-5">
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                            {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                {!!Form::close()!!}
                <div class="clearfix">
                    <!-- Delete Form --> 
                    {!! Form::open(array('url' => 'Email_template/' . $data->email_template_id)) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'return confirm("Are you sure you want to delete this item?")')) !!}
                    {!! Form::close() !!}
                    check here to delete this Email template
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
<!-- jQuery Form Validation code -->
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
                email_template_name: {required: true},
                from_email: {email: true}
            },
            messages: {
                email_template_name: "The Template Name field is required",
                from_email: "Enter the valid email"
            },
            errorElement: 'div',
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
            }
        });
    });
</script>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/adapters/jquery.js'; ?>"></script>
<script src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/js/sample.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/config.js"></script> 
<link rel="stylesheet" href="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>
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
