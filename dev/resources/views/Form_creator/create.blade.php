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
    .pointer{cursor: pointer;}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title"><?php echo "Add New Form"; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            
            {!! Form::open(array('url' => 'Form_creator','class' => 'form-horizontal','id'=>'myForm','files'=>'true')) !!}
            {!! Form::hidden('_token', csrf_token(), array('class' => 'form-control')) !!}
           
                <div class="card-box m-b-0">
                    <div class="row">
                        <div class=" col-sm-12 col-xs-12 p-t-b-10">
                             
                            <div class="form-group row form-main-box">
                                {!!Form::label('Form Name','Form Name',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::text('form_name', null,array('class' => 'form-control','id' => 'form_name')) !!}         
                                </div>
                                @if ($errors->has('form_name')) 
                                     <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('form_name') }}</p> 
                                @endif
                            </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('Form Information - on top of form before questions','Form Information - on top of form before questions',['class' => 'control-label col-md-4'])!!}
                                
                                <div class="col-md-7">
                                    {!! Form::textarea('top_form_info', null,array('class' => 'form-control','id' => 'top_form_info','rows' => '4')) !!} 
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('Start Date','Start Date',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::hidden('hidden_on_site_date',null,['class'=>'form-control','id' => 'hidden_on_site_date']) !!}
                                    <div id='on_site_date' name="on_site_date">&nbsp;</div>
                                                              
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('End Date','End Date',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::hidden('hidden_off_site_date',null,['class'=>'form-control','id' => 'hidden_off_site_date']) !!}
                                    <div id='off_site_date' name="off_site_date">&nbsp;</div>
                                    Form will no longer be available as of 12:00 AM ET on this date.
                                </div>
                            </div>
                            
                            <div class="form-group row form-main-box">
                                {!!Form::label('Form Password','Form Password',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::text('form_password', null,array('class' => 'form-control','id' => 'form_password')) !!}        
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('Public or Internal','Public or Internal',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::select('form_type', ['Public' => 'Open to Public','Internal' => 'Internal Only'],'No',array('class' => 'form-control')) !!}
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                            {!! Form::submit('Save form',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
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
                {!! Form::submit('Save form',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
     {!! Form::close() !!}
</div>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 

<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/globalization/globalize.js"></script> 

<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>

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

        //get value from PHP - hidden element
        hidden_on_site_date = $("#hidden_on_site_date").val();
        hidden_off_site_date = $("#hidden_off_site_date").val();

        // alert("ASDFASD");
        //set updated date
        if (hidden_on_site_date != "01/01/1970")
            $('#on_site_date').jqxDateTimeInput('setDate', hidden_on_site_date);
        if (hidden_off_site_date != "01/01/1970")
            $('#off_site_date').jqxDateTimeInput('setDate', hidden_off_site_date);
        // create Editor
        // Create jqxTabs.

        //get value from PHP - hidden element
        hidden_on_site_date = $("#hidden_on_site_date").val();
        hidden_off_site_date = $("#hidden_off_site_date").val();

        // alert("ASDFASD");
        //set updated date
        if (hidden_on_site_date != "01/01/1970")
            $('#on_site_date').jqxDateTimeInput('setDate', hidden_on_site_date);
        if (hidden_off_site_date != "01/01/1970")
            $('#off_site_date').jqxDateTimeInput('setDate', hidden_off_site_date);

        //alert(hidden_on_site_date);                  
        //alert(hidden_on_site_date);

    });
    $("#on_site_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: '<?php echo ADMIN_JQR_DATE_FORMAT ?>'})
    $("#off_site_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: '<?php echo ADMIN_JQR_DATE_FORMAT ?>'})

    $(document).ready(function () {
        $("#myForm").validate({
            rules: {
                form_name: {required: true}
            },
            messages: {
                form_name: "The Form Name field is required"
            },
            errorElement: "div"
        });
    });
    
</script>

@endsection