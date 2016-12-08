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
                <div class="col-lg-12 col-xs-12 p-t-10">
                    <div class="info-title page-info page-info-title">Maintain Daily Defaults (Lunch) | 
                        <a href="<?php echo url('/'); ?>/menu_intro">intro paragraph</a> | 
                        <a href="<?php echo url('/'); ?>/menu_intro/weekend_setting_updates">WEEKEND OPTION</a> | 
                        <a href="<?php echo url('/'); ?>/menu/menucopyview">COPY MENU</a> | 
                        <a href="<?php echo url('/'); ?>/menu_intro/ical_setting">ICAL OPTION (OFF)</a>
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12 p-0 m-b-10">
                    {!! Form::open(array('url' => '/menu/menucreate','class' => 'form-horizontal', 'id'=>'myForm')) !!}
                    <?php
                    $month = (isset($month)) ? $month : "";
                    ?>    
                    <div class="col-lg-2 col-xs-12 p-t-b-10">
                        <select name="theMonth" class="form-control">
                            <option selected value=""> All Months</option>
                            <option value="1" <?php echo ($month == "1") ? "selected" : ""; ?>> January</option>
                            <option value="2" <?php echo ($month == "2") ? "selected" : ""; ?>> February</option>
                            <option value="3" <?php echo ($month == "3") ? "selected" : ""; ?>> March</option>
                            <option value="4" <?php echo ($month == "4") ? "selected" : ""; ?>> April</option>
                            <option value="5" <?php echo ($month == "5") ? "selected" : ""; ?>> May</option>
                            <option value="6" <?php echo ($month == "6") ? "selected" : ""; ?>> June</option>
                            <option value="7" <?php echo ($month == "7") ? "selected" : ""; ?>> July</option>
                            <option value="8" <?php echo ($month == "8") ? "selected" : ""; ?>> August</option>
                            <option value="9" <?php echo ($month == "9") ? "selected" : ""; ?>> September</option>
                            <option value="10" <?php echo ($month == "10") ? "selected" : ""; ?>> October</option>
                            <option value="11" <?php echo ($month == "11") ? "selected" : ""; ?>> November</option>
                            <option value="12" <?php echo ($month == "12") ? "selected" : ""; ?>> December</option>
                        </select>
                        @if ($errors->has('theMonth')) <p class="help-block text-danger">{{ $errors->first('theMonth') }}</p> @endif
                    </div>
                    <div class="col-lg-2 col-xs-12 p-t-b-10">
                        <select name="theYear" class="form-control">
                            <option value="0"> All Years</option>
                            <?php for ($i = date("Y") + 1; $i >= date("Y") - 5; $i--) { ?>
                                <option value="<?php echo $i; ?>" <?php echo ($year == $i) ? "selected" : ""; ?>><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-xs-12 p-t-b-10">
                        <select class="form-control" name="category_id">
                            <option value="0">Menu Category</option>
                            <?php foreach ($category as $row) { ?>                                
                                <option value="<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></option>                                
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-xs-12 p-t-b-10">
                        {!! Form::submit('Show Month >',array('class' => 'form-control')) !!}
                    </div>
                    {!! Form::close() !!}
                    <?php
                    if (isset($day) && $day != "") {
                        ?>
                        {!! Form::open(array('url' => '/menu/add','class' => 'form-horizontal', 'id'=>'myForm2')) !!}
<!--                        {!! Form::hidden('hidden_day',$day,['class'=>'form-control']) !!}
                        {!! Form::hidden('hidden_month',$month,['class'=>'form-control']) !!}
                        {!! Form::hidden('hidden_year',$year,['class'=>'form-control']) !!}-->
                        <input type="hidden" name="hidden_day" value="<?php echo $day; ?>">
                        <input type="hidden" name="hidden_month" value="<?php echo $month; ?>">
                        <input type="hidden" name="hidden_year" value="<?php echo $year; ?>">
                        <div class="form-group">
                            <div class="col-md-10" align="left">
                                <?php
                                for ($i = 1; $i <= $day; $i++) {
                                    // echo $i."-".$month."-".$year; exit;
                                    ?><br/>
                                    <?php
                                    $menu_date_generate = $month . "/" . $i . "/" . $year;
                                    //echo "<br>";
                                    $format_date = date("l, m/d/Y", strtotime($menu_date_generate))
                                    ?>
                                    <div class="info-title page-info"><b><?php echo $format_date . " - menu"; ?></b>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other Menu Information (on pop-up only)</div>
<!--                                    {!! Form::textarea('name=menu_{{$i}}', null, array('id' => 'menu_{{$i}}','rows' => 4, 'cols' => 40)) !!}
                                    {!! Form::textarea('name=other_menu_{{$i}}', null, array('id' => 'other_menu_{{$i}}','rows' => 4, 'cols' => 40)) !!}<br>-->
                                    <textarea style="height:160px" row="3" cols="40" id="menu_<?php echo $i; ?>" name="menu_<?php echo $i; ?>"></textarea>
                                    <textarea style="height:160px; margin-left: 350px;" row="3" cols="40" id="other_menu_<?php echo $i; ?>" name="other_menu_<?php echo $i; ?>"></textarea><br/>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                            {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'myFunction()')) !!}</div>
                        <div class="clearfix"></div>
                        {!! Form::close() !!}   
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                    {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'myFunction()')) !!}</div>
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
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdata.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxtabs.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxscrollbar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 

<script type="text/javascript">
function myFunction() {
    document.getElementById("myForm2").submit();
}

$(document).ready(function () {
    $("#tab2").click(function () {
        $("#tab-description2").slideToggle();
        $("#tab1").toggleClass("top-btn-hide");
        $("#tab2 .fa").toggleClass("fa-angle-double-up");
        $("#tab2 .fa").toggleClass("fa-angle-double-down");
    });
});
</script>
@stop
