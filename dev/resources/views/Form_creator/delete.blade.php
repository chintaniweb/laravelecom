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
            <h4 class="page-title"><?php echo "Delete Confirmation"; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
                   <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="tab-main-bg">
                <ul>
                    <li><a href="<?php echo url('/') . '/Form_creator/' . $id . '/edit'; ?>" title="">Main Info</a></li>
                    <li><a href="<?php echo url('/') . '/Form_question/create/'.$id; ?>" title="">Add</a></li>
                    <li><a href="<?php echo url('/') . '/Form_question/'.$id; ?>" title="">Edit</a></li>
                    <li><a href="<?php echo url('/') . '/Form_creator_update_limit/'.$id; ?>" title="">Limits</a></li>
                    <li class="active"><a href="#" title="">Delete</a></li>
                </ul>
            </div>
            {!! Form::open(array('url' => 'Form_creator/' . $id)) !!}
            {!! Form::hidden('_method', 'DELETE') !!}

            <div class="card-box m-b-0">
                <div class="row">
                    
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class=" col-sm-12 col-xs-12 p-t-b-10">
                            <p><div>If you want this Event Deleted - and are sure, check this box and hit Delete below: </div></p>
                            <div class="form-group row form-main-box">
                                <div class="col-sm-7">
                                    {!! Form::radio('form_delete', 'Delete_question', array('class' => 'form-control','id' => 'form_delete')) !!}
                                    &nbsp;Delete All Submissions Only - Leave form questions intact
                                    <br/>
                                    {!! Form::radio('form_delete', 'Delete_form_question', array('class' => 'form-control','id' => 'form_delete1')) !!}
                                    &nbsp;Delete All Submissions and Entire Form
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                        {!! Form::submit('Delete', array('class' => 'btn btn-primary btn-rect btn-sm',
                        'onclick' => 'return confirm("Are you sure you want to delete?")')) !!}
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
                     {!! Form::submit('Delete', array('class' => 'btn btn-primary btn-rect btn-sm',
                     'onclick' => 'return confirm("Are you sure you want to delete?")')) !!}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}
</div>

@endsection