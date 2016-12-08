@extends('layouts.master_admin')
@section('content')
<style>
    .text-danger .alert {padding: 0 !important; margin-bottom: 5px !important; font-weight: normal !important;}
    .text-danger .alert strong {font-weight: normal !important;}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">ICAL Option</h4>
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
            {!! Form::open(array('url' => '/menu_intro/ical_setting_updates','class' => 'form-horizontal')) !!}
            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class="info-title page-info page-info-title"> This system allows you to publish ical menu files for people to subscribe to</div>
                        <div class="form-group row form-main-box">
                            <label class="control-label col-sm-8" for="site">
                                If you would like to include ical files for all your menus (separated by categories), please select YES below.
                            </label>                                
                        </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('ical_option','Option',['class' => 'control-label col-md-4'])!!}
                            <div class="col-sm-4">
                                {!! Form::select('ical_option', ['Yes' => 'Yes','No' => 'No'],$data[0]->ical_option,array('class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">{!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                    <div class="clearfix"></div>
                </div>
                </form>    
            </div>
        </div>
    </div>
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@stop