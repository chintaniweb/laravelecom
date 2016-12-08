@extends('layouts.master_admin')
@section('content')
<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}
    #form label.error {color:red;}
    #form input.error {border:1px solid red;}
</style>
<div class="container">
    <div class="row">
        <?php
        //print_r($data);exit;
        ?>
        {!!Form::open(['url'=>'alert_message/edit/'.$data[0]->alert_message_id, 'id'=>'myForm'])!!}
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title"> Add Website Information Alert System</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', ' alert-success') }}">{{Session::get('message')}}</p>
            @endif   


            <div class="card-box m-b-0">
                <div class="row">
                    <div class="row m-0">
                        <div class="bg-muted p-10 m-b-15"> Add New Alert Message Below </div>
                    </div>
                    <div class="row m-b-15">
                        <div class="col-sm-12">Select desired image below - enter details at the end</div>
                    </div>
                    <?php
                    if (isset($data[0]->alert_image) && $data[0]->alert_image != "") {
                        $alert_image = $data[0]->alert_image;
                    } else {
                        $alert_image = "";
                    }
                    ?>
                    <div class="row m-b-15">
                        <div class="col-sm-6 p-10 border-b border-r">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"> <img src="<?php echo url('/'); ?>/resources/assets/img/2HrsDelay.gif" title="2Hrs Delay" alt="2Hrs Delay"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == '2HrsDelay.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', '2HrsDelay.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="90min" title="90min" src="<?php echo url('/'); ?>/resources//assets/img/90min.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == '90min.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', '90min.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b border-r">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="after School" title="after School" src="<?php echo url('/'); ?>/resources/assets/img/afterSchool.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'afterSchool.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'afterSchool.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="Cancellation" title="Cancellation" src="<?php echo url('/'); ?>/resources/assets/img/Cancellation.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'Cancellation.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'Cancellation.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b border-r">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="delay" title="delay" src="<?php echo url('/'); ?>/resources/assets/img/delay.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'delay.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'delay.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="Early Dismissal" title="Early Dismissal" src="<?php echo url('/'); ?>/resources/assets/img/EarlyDismissal.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'EarlyDismissal.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'EarlyDismissal.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b border-r">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Budget Info" title="School Budget Info" src="<?php echo url('/'); ?>/resources/assets/img/SchoolBudget.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'SchoolBudget.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'SchoolBudget.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/SchoolClosed.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'SchoolClosed.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'SchoolClosed.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/SnowDay.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'SnowDay.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'SnowDay.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/SnowDay2.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'SnowDay2.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'SnowDay2.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/SpAnnouncement.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'SpAnnouncement.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'SpAnnouncement.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/WeatherDelay.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'WeatherDelay.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>

                                {!!Form::radio('alert_image', 'WeatherDelay.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/2HrDelay.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == '2HrDelay.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', '2HrDelay.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/SAEC rescheduled.jpg"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'SAEC rescheduled.jpg') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'SAEC rescheduled.jpg',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/SAEC4.jpg"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'SAEC4.jpg') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'SAEC4.jpg',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/alert_Simulationmarch 10.jpg"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'alert_Simulationmarch 10.jpg') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'alert_Simulationmarch 10.jpg',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/Adult-Ed-Cancel.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'Adult-Ed-Cancel.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'Adult-Ed-Cancel.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                        <div class="col-sm-6 p-10 border-b">
                            <div class="col-sm-12 text-center m-t-10 m-b-10"><img border="0" alt="School Closed" title="School Closed" src="<?php echo url('/'); ?>/resources/assets/img/Myers-&-SAEC-2-Hour-Delay.gif"></div>
                            <div class="col-sm-12 text-center m-b-10">
                                <?php
                                if ($data[0]->alert_image == 'Myers-&-SAEC-2-Hour-Delay.gif') {
                                    $checked = true;
                                } else {
                                    $checked = false;
                                }
                                ?>
                                {!!Form::radio('alert_image', 'Myers-&-SAEC-2-Hour-Delay.gif',$checked)!!}

                                <b>Select Image</b></div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class="info-title page-info page-info-title"> Alert System </div>
                        <div class="form-group row form-main-box">
                            {!!Form::label('Subject','',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}

                            <div class="col-md-7">
                                {!!Form::text('subject',$data[0]->subject,['class'=>'form-control','id'=>'subject'])!!}
                                @if ($errors->has('subject')) <p class="help-block text-danger">{{ $errors->first('subject') }}</p> @endif

                            </div>

                        </div>
                        <div class="form-group row">
                            {!!Form::label('Start Date',null,['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}

                            <div class="col-md-7">
                                {!!Form::hidden('on_site_date',$data[0]->on_site_date,['class'=>'form-control','id'=>'hidden_on_site_date'])!!}

                                <div id='on_site_date' name="on_site_date">&nbsp;</div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            {!!Form::label('End Date',null,['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}

                            <div class="col-md-7">
                                {!!Form::hidden('off_site_date',$data[0]->off_site_date,['class'=>'form-control','id'=>'hidden_off_site_date'])!!}  

                                <div id='off_site_date' name="off_site_date">&nbsp;</div>
                            </div>
                        </div> 
                        <div class="form-group">
                            {!!Form::label('Details','',['class'=>'control-label col-sm-4 text-right','style'=>'padding-top:8px'])!!}
                            <div class="col-md-7">
                                {!!Form::textarea('details',$data[0]->details,['class'=>'form-control','id'=>'details','rows' => 2, 'cols' => 40])!!}
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                    {!! Form::submit( 'Save Page', ['class'=>' btn-primary btn-rect btn-sm']) !!}
                </div>
                </div> 
                <div class="clearfix">
                    <a href="{{ url('alert_message/delete/'.$data[0]->alert_message_id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                        Delete</a> click here to delete alert message  
                </div>
                

            </div>

        </div>
        <div style="position:relative;">
            <div class="navbar-fixed-bottom fix-b-list">
                <div class="card-box " style="background-color:#f5f5f5;">
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                        {!! Form::submit('Save Page ',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                        <!--a class="adminlink btn btn-danger btn-rect btn-sm" href="javascript: if (confirm('Are you sure you want to delete this page?')) { if (confirm('This will remove all data related to this page. (Including Backup)')) {document.location.href='manage.php?p=page_mng&amp;a=delete&amp;PageId=147&amp;RetFlg=&amp;page=1&amp;perPage=50&amp;PageTypeS=All&amp;box_search=';}}"><i style="font-size:14px" class="icon-minus-circle"></i>Cancel</a--> </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            {!!Form::close()!!}  
        </div>

    </div>
</div>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdata.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxscrollbar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/globalization/globalize.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 


<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- jQuery Form Validation code -->
<script>

                        $(document).ready(function () {


                            //get value from PHP - hidden element
                            hidden_on_site_date = $("#hidden_on_site_date").val();
                            hidden_off_site_date = $("#hidden_off_site_date").val();
                            if (hidden_on_site_date != "01/01/1970")
                                $('#on_site_date').jqxDateTimeInput('setDate', hidden_on_site_date);
                            if (hidden_off_site_date != "01/01/1970")
                                $('#off_site_date').jqxDateTimeInput('setDate', hidden_off_site_date);

                        });
                        $("#on_site_date").jqxDateTimeInput({formatString: "F", showTimeButton: true, width: '400px', height: '30px'})

                        $("#off_site_date").jqxDateTimeInput({formatString: "F", showTimeButton: true, width: '400px', height: '30px'})
                        $('#on_site_date').bind('valueChanged', function (event) {
                            var date = $("#on_site_date").jqxDateTimeInput('getDate');
                            var formattedDate = $.jqx.dataFormat.formatdate(date, "F");
                            $("#hidden_on_site_date").val(formattedDate);
                        });
                        $('#off_site_date').bind('valueChanged', function (event) {
                            var date = $("#off_site_date").jqxDateTimeInput('getDate');
                            var formattedDate = $.jqx.dataFormat.formatdate(date, "F");
                            $("#hidden_off_site_date").val(formattedDate);

                        });

                        $(document).ready(function () {
                            $("#myForm").validate({
                                rules: {
                                    subject: {required: true}
                                },
                                messages: {
                                    subject: "The Subject field is required"
                                },
                                errorElement: "div"
                            });


                        });

//            var date = $("#off_site_date").jqxDateTimeInput('getDate');
//            var formattedDate = $.jqx.dataFormat.formatdate(date, 'MM/dd/yyyy hh:mm:ss tt');
//          $("#hidden_off_site_date").val(formattedDate);
//          
//          var date = $("#on_site_date").jqxDateTimeInput('getDate');
//            var formattedDate = $.jqx.dataFormat.formatdate(date, 'MM/dd/yyyy hh:mm:ss tt');
//          $("#hidden_on_site_date").val(formattedDate);
</script>
@stop