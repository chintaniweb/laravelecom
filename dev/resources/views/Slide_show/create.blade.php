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
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Add Slide Show Category</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            {!! Form::open(array('url' => 'Slide_show_category','class' => 'form-horizontal')) !!}

            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                        @endif
                        <div class="form-group row form-main-box">
                            {!! Form::label('Category', 'Category*',array('class' => 'control-label col-md-4')) !!}
                            <div class="col-md-7">
                                {!! Form::text('name', null, array('class' => 'form-control','id' => 'name')) !!}
                                @if ($errors->has('name')) 
                                <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('name') }}</p> 
                                @endif
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('location_id','Location*',['class'=>'control-label col-sm-4 text-right','style'=>'padding-top:8px'])!!} 
                            <div class="col-sm-7">
                               
<!--                                {!! Form::select('location_id',$location_data,null,array('class' => 'form-control')) !!}-->
                                   <select name="location_id" class="form-control">
                                            <option value="">----Select Location-----</option>
                                            @foreach ($location_data as $k => $v)
                                                <option value="{{$k}}">{{$v}}</option>                                          
                                            @endforeach
                                        </select>
                               @if ($errors->has('location_id')) 
                                <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('location_id') }}</p> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group row form-main-box">
                            {!! Form::label('Sort', 'Sort',array('class' => 'control-label col-md-4')) !!}
                            <div class="col-sm-1">
                                {!! Form::text('category_sort', null, array('class' => 'form-control','id' => 'category_sort')) !!}
                                @if ($errors->has('category_sort')) 
                                <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('category_sort') }}</p> 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                        {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                    </div>
                    <div class="clearfix"></div>
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

<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/detect/detect.js"></script> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
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
            name: "The Category field is required",
            
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
@stop