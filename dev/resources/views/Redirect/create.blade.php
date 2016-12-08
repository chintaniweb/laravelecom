@extends('layouts.master_admin')
@section('content')
<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}
    #form label.error {color:red;}
    #form input.error {border:1px solid red;}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Add URL Redirects</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            {!! Form::open(array('url' => 'Redirect_url','class' => 'form-horizontal','id'=>'myForm')) !!}


            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                        @endif
                        <div class="form-group row form-main-box">
                            {!!Form::label('Source Url','Source Url',['class'=>'control-label col-sm-4 text-right','style'=>'padding-top:8px'])!!}

                            <div class="col-sm-7">
                                {!!Form::text('source_url',null,['class'=>'form-control','id'=>'source_url'])!!}
                                @if ($errors->has('source_url')) <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('source_url') }}</p>
                                @endif

                            </div>

                        </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('Target URL','Target URL',['class'=>'control-label col-sm-4 text-right','style'=>'padding-top:8px'])!!}

                            <div class="col-sm-7">
                                {!!Form::text('target_url',null,['class'=>'form-control','id'=>'target_url'])!!}
                                @if ($errors->has('target_url')) <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('target_url') }}</p>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                        {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                    </div>

                </div>
                {!!Form::close()!!}
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
<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
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
                source_url: {required: true},
                target_url: {required: true}
            },
            messages: {
                source_url: "The Source URL field is required",
                target_url: "The Target Url field is required"
            },
            errorElement: 'div'
        });
    });
</script>
@stop