@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-b-15">
            <h4 class="page-title"><h4 class="page-title">Update Homepage Banner</h4></h4>
        </div>
    </div>
    <div class="row">
        {!! Form::open(array('url' => 'banner_update/'.$data[0]->banner_id, 'files'=>'true','class' => 'form-horizontal','id'=>'myForm')) !!}
        <div class="col-xs-12 col-sm-12">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="card-box">
                 <div class="form-group row form-main-box">
                    {!!Form::label('title','Title',['class' => 'control-label col-sm-4 col-md-3 p-t-10'])!!}
                    <div class="col-sm-6 col-md-5">
                        {!! Form::text('title', $data[0]->title, array('class'=>'form-control')) !!}
                        @if ($errors->has('title')) <p class="help-block text-danger">{{ $errors->first('title') }}</p> @endif
                    </div>
                </div>
                <div class="form-group row form-main-box">
                    {!!Form::label('url','URL',['class'=>'control-label col-sm-4 col-md-3 p-t-10'])!!}
                    <div class="col-sm-6 col-md-5">
                        {!! Form::text('url',$data[0]->url,['class'=>'form-control']) !!}
                    </div>
                </div>
                 <div class="form-group row form-main-box">
                    {!!Form::label('image','Image',['class' => 'control-label col-sm-4 col-md-3 p-t-10'])!!}
                    <div class="col-sm-6 col-md-5">
                        {!! Form::file('image', array('class'=>'btn btn-block btn-grey')) !!}
                        small thumbnail-type photo 
                        <?php if (isset($data[0]->image) && ($data[0]->image != "")) { ?>
                            <a target="_blank" href="<?php echo url('/') . "/resources/views/Homepage_banners/Homepage_banners_files/" . $data[0]->image; ?>">View</a>
                            <a href="<?php echo url('/') . "/banner/deleteImage/" . $data[0]->banner_id; ?>" onclick="return confirm('Are you sure you want to delete this image?');">|Delete</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group row form-main-box">
                    {!! Form::label('fix_size', 'Fix-Size',array('class' => 'control-label col-sm-4 col-md-3 p-t-10')) !!}
                    <div class="col-sm-6 col-md-5">
                        {!! Form::select('fix_size', ['Yes' => 'Yes','No' => 'No'],'No',array('class' => 'form-control')) !!}
                    </div>
                </div>
                 <div class="form-group row form-main-box">
                    {!! Form::label('start_date', 'Start Date',array('class' => 'control-label col-sm-4 col-md-3 p-t-10')) !!}
                    <div class="col-sm-7">
                        {!! Form::hidden('start_date',$data[0]->start_date ,['class' => 'form-control','id' => 'hidden_start_date']) !!}
                        <div id='start_date' name="start_date">&nbsp;</div>
                    </div>
                </div> 
                <div class="form-group row form-main-box">
                    {!! Form::label('end_date', 'End Date',array('class' => 'control-label col-sm-4 col-md-3 p-t-10')) !!}
                    <div class="col-sm-7">
                        {!! Form::hidden('end_date',$data[0]->end_date,['class'=>'form-control','id' => 'hidden_end_date']) !!}
                        <div id='end_date' name="end_date">&nbsp;</div>
                    </div>
                </div> 
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">  {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                <div class="clearfix"></div>
                <a href="{{ url('banner_delete/'.$data[0]->banner_id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                        Delete</a> click here to delete this banner
            </div>
        </div>
    </div>
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box " style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                    {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!} 

<!-- date & time calender js -->
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/globalization/globalize.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 

<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>

<!-- jQuery Form Validation code -->
<script>
    $(document).ready(function () {  
      $("#myForm").validate({
            rules: {
                title: {required: true},
                url: {required: true}
            },
            messages: {
                title: "The Title field is required",
                url: "The URL field is required"
            },
            errorElement: "div",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
            }
        });
      
        //get value from PHP - hidden element
        hidden_start_date = $("#hidden_start_date").val();
        hidden_end_date = $("#hidden_end_date").val();
      
        //set updated date
        if (hidden_start_date != "01/01/1970")
            $('#start_date').jqxDateTimeInput('setDate', hidden_start_date);
        if (hidden_end_date != "01/01/1970")
            $('#end_date').jqxDateTimeInput('setDate', hidden_end_date);
    });
    
    $("#start_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: '<?php echo ADMIN_JQR_DATE_FORMAT ?>'})
    $("#end_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: '<?php echo ADMIN_JQR_DATE_FORMAT ?>'})
        
    
</script>
@endsection