@extends('layouts.master_admin')
@section('content')
<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}

    #form label.error {
        color:red;
    }
    #form input.error {
        border:1px solid red;
    }
</style>
<?php
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Add Role</h4>
        </div>
    </div>
    <div class="row">
        {!! Form::open(array('url' => 'Roles','class' => 'form-horizontal','id'=>'myForm')) !!}
        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                        @endif
                        <div class="form-group row form-main-box">
                            {!!Form::label('name','name',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                            <div class="col-md-7">
                                {!!Form::text('name',null,['class'=>'form-control','id'=>'title'])!!}
                                @if ($errors->has('name'))<p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('name') }}</p>@endif 
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('display_name','display_name',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                            <div class="col-md-7">
                                {!!Form::text('display_name',null,['class'=>'form-control','id'=>'title'])!!}
                                @if ($errors->has('display_name'))<p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('display_name') }}</p>@endif 
                            </div>
                        </div>

                        <div class="form-group row form-main-box">
                            {!!Form::label('description','description',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}

                            <div class="col-md-7">
                                {!!Form::textarea('description','',['class'=>'form-control','id'=>'description','rows' => 2, 'cols' => 40])!!}


                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('Web site','Web site',array('class' => 'control-label col-md-4')) !!}
                            <div class="col-md-7">
                                @foreach ($website_array as $k=>$v)
                                <div class="col-md-2 m-t-10 p-0">
                                    {!! Form::checkbox('website_id[]',$k,null,array('class' => '')) !!}&nbsp;&nbsp;{{$v}}
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                            {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                        </div>

                    </div>
                    <div style="position:relative;">
                        <div class="navbar-fixed-bottom fix-b-list">
                            <div class="card-box " style="background-color:#f5f5f5;">
                                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                                    {!! Form::submit('Save ',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                                    <!--a class="adminlink btn btn-danger btn-rect btn-sm" href="javascript: if (confirm('Are you sure you want to delete this page?')) { if (confirm('This will remove all data related to this page. (Including Backup)')) {document.location.href='manage.php?p=page_mng&amp;a=delete&amp;PageId=147&amp;RetFlg=&amp;page=1&amp;perPage=50&amp;PageTypeS=All&amp;box_search=';}}"><i style="font-size:14px" class="icon-minus-circle"></i>Cancel</a--> </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    {!!Form::close()!!}

                </div>
            </div>
        </div>


    </div>
</div>
<!-- date & time calender js -->
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/globalization/globalize.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 

<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>

@stop
