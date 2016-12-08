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
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Weekdend Option</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="col-lg-12 col-xs-12 p-t-10">
                <div class="info-title page-info page-info-title">Maintain Daily Defaults (Lunch) | 
                    <a href="<?php echo url('/'); ?>/menu_intro">intro paragraph</a> | 
                    <a href="<?php echo url('/'); ?>/menu_intro/weekend_setting_updates">WEEKEND OPTION</a> | 
                    <a href="<?php echo url('/'); ?>/menu/menucopyview">COPY MENU</a> | 
                    <a href="<?php echo url('/'); ?>/menu_intro/ical_setting">ICAL OPTION (OFF)</a>
                </div>
            </div>
            {!! Form::open(array('url' => '/menu_intro/weekend_update','class' => 'form-horizontal')) !!}
            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class="info-title page-info page-info-title"> This option will affect all the menus in the system.</div>
                        <div class="form-group row form-main-box">
                            <label class="control-label col-sm-8" for="site">
                                If you would like to EXCLUDE weekends in this admin area as well as when a visitor views the menu on the front of the site, please update below.
                            </label>                                
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('weekend_option', 'Show Weekends',array('class' => 'control-label col-sm-4')) !!}
                            <div class="col-sm-4">
                                {!! Form::select('weekend_option', ['Show_weekend' => 'Show_weekend','No_weekend' => 'No_weekend'],$data[0]->weekend_option,array('class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                    <div class="clearfix"></div>
                </div>
                </form>    
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
</div>
@stop