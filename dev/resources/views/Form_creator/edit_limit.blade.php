@extends('layouts.master_admin')

@section('content')

<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}
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
            <h4 class="page-title"><?php echo "Form Submission Limits"; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
                @if(Session::has('msg'))
                    <p class="alert alert-success">{{ Session::get('msg') }}</p>
                @endif
                <div class="tab-main-bg">
                    <ul>
                        <li><a href="<?php echo url('/') . '/Form_creator/'.$form_creator_limit->form_creator_id.'/edit' ; ?>" title="">Main Info</a></li>
                        <li><a href="<?php echo url('/') . '/Form_question/create/'.$form_creator_limit->form_creator_id ; ?>" title="">Add</a></li>
                        <li><a href="<?php echo url('/') . '/Form_question/'.$form_creator_limit->form_creator_id ; ?>" title="">Edit</a></li>
                        <li class="active"><a href="#" title="">Limits</a></li>
                        <li><a href="<?php echo url('/') . '/Form_creator_delete/'.$form_creator_limit->form_creator_id; ?>" title="">Delete</a></li>
                    </ul>
                </div>
            
            {!! Form::model($form_creator_limit, array('route' => array('Form_creator_limit.update', $form_creator_limit->form_creator_id), 'method' => 'PUT','files'=>'true','class' => 'form-horizontal','id'=>'myForm')) !!}
            {!! Form::hidden('_token', csrf_token(), array('class' => 'form-control')) !!}
           
                <div class="card-box m-b-0"><br>
                    <div class="info-title page-info page-info-title">
                        <strong>This area of the FORM CREATOR controls how many people can submit responses.</strong>
                    </div>
                    <div class="row">
                        <div class=" col-sm-12 col-xs-12 p-t-b-10">
                            <div class="form-group row form-main-box">
                                <div class="col-md-1">
                                     {!! Form::text('form_limit', null,array('class' => 'form-control','id' => 'form_limit')) !!}         
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;max
                                </div>
                                <label class="control-label col-md-0">
                                    Enter the number of overall submissions. Once the maximum number is reached, further submissions will not be accepted.
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                             {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
    </div>
</div>
<div style="position:relative;">
    <div class="navbar-fixed-bottom fix-b-list">
        <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
            <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                 {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
     {!! Form::close() !!}
</div>

@endsection
