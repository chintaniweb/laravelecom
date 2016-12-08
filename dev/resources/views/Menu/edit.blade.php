@extends('layouts.master_admin')
@section('content')
<style>
    .text-danger .alert {padding: 0 !important; margin-bottom: 5px !important; font-weight: normal !important;}
    .text-danger .alert strong {font-weight: normal !important;}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Menus</h4>
        </div>
        
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="row">
                <div class="col-lg-12 col-xs-12 p-0 m-b-10">
                     {!! Form::open(array('url' => url('/').'/menu/edit/'.$data[0]->menu_id,'class' => 'form-horizontal')) !!}
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('menu','Menu',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::textarea('menu', $data[0]->menu, array()) !!}
                                    <!--<textarea id="menu" name="menu" rows="10" cols="50"><?php //echo (isset($data[0]['menu'])) ? $data[0]['menu'] : set_value('menu'); ?></textarea>-->                                    
                                </div>
                            </div>
                            <div class="form-group">
                                {!!Form::label('other_menu','Other Menu',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                     {!! Form::textarea('other_menu', $data[0]->other_menu, array()) !!}
                                    <!--<textarea id="other_menu" name="other_menu" rows="10" cols="50"><?php //echo (isset($data[0]['other_menu'])) ? $data[0]['other_menu'] : set_value('other_menu'); ?></textarea>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> {!! Form::submit('Save Page',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                        <a href="{{ url('menu/delete/'.$data[0]->menu_id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                        Delete</a> click here to delete this Menu
                         
                </div>
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
@stop