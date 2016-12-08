@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h4 class="page-title">Search Information</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="card-box">
                <div class="row m-0">
                    <div class="col-lg-12 col-xs-12 p-t-10">
                        <div class="info-title page-info page-info-title"><strong>This page will detail the information searched for on your website - use it to determine if an area is hard to find.</strong></div>
                    </div>
                    {!! Form::open(array('url' => 'Search_statistic/index','class' => 'form-horizontal', 'id'=>'myForm')) !!}
                        <div class="col-lg-12 col-xs-12 p-0">
                            <!-------------------Search Month, Year, & details Start--------------------------------->
                            <?php
                            $month = (isset($month)) ? $month : "";
                            ?>    
                            <div class="col-lg-2 col-xs-12 p-t-b-10">
                                <select name="theMonth" class="form-control">
                                    <option value=""> All Months</option>
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
                            </div>
                            <div class="col-lg-2 col-xs-12 p-t-b-10">
                                <select name="theYear" class="form-control">
                                    <option value=""> All Years</option>
                                    <?php for ($i = date("Y") + 1; $i >= 2010; $i--) { ?>
                                        <option value="<?php echo $i; ?>" <?php echo ($year == $i) ? "selected" : ""; ?>><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-xs-12 p-t-b-10">
                                <select class="form-control" name="details">
                                    <?php
                                    if ($details != "") {
                                        $select = $details;
                                    } else {
                                        $select = "Group_by_words";
                                    }
                                    ?>
                                    <option <?php echo ($select == "Group_by_words") ? "selected" : ""; ?> value="Group_by_words">Group By Words</option>
                                    <option <?php echo ($select == "Individual_details") ? "selected" : ""; ?> value="Individual_details">Individual Details</option>                                  
                                </select>
                            </div>
                            <div class="col-lg-1 col-xs-12 p-t-b-10">
                                {!! Form::submit('Show >',array('class' => 'form-control')) !!}
                            </div>
                            <!-------------------Search Month, Year, & details Start--------------------------------->
                            <?php
                            if (count($search_data) != 0) {
                                ?>
                                <div class="col-lg-12 col-xs-12" style="padding-top:30px;">
                                    <div class="col-lg-8 col-xs-12 m-b-25">
                                        <!---------------------------Headings Start--------------------------------------->
                                        <div class="info-title page-info page-info-title col-sm-3">#</div>
                                        <div class="info-title page-info page-info-title col-sm-3"><a>Searched For</a></div>
                                        <div class="info-title page-info page-info-title col-sm-3">Try Search</div>
                                        <div class="info-title page-info page-info-title col-sm-3"><a>Date/Time</a></div>
                                        <!---------------------------Headings End--------------------------------------->

                                        <!---------------------------Content Start--------------------------------------->
                                        <?php foreach ($search_data as $row) { ?>
                                        <div class="col-sm-3  border-t"><?php echo (isset($row->site_search_id)) ? $row->site_search_id : ""; ?></div>
                                        <div class="col-sm-3  border-t"><?php echo (isset($row->search_for)) ? $row->search_for : ""; ?></div>
                                        <div class="col-sm-3  border-t"><a href="<?php echo url('/') . '/search/edit/' . $row->site_search_id; ?>">Search</a></div>
                                        <div class="col-sm-3  border-t"><?php echo (isset($row->created_at)) ? $row->created_at : ""; ?></div>
                                        <?php } ?>
                                        <!---------------------------Content End----------------------------------------->
                                        <br>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
<script type="text/javascript" src="<?php echo url('/'); ?>/ressources/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/ressources/assets/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/ressources/assets/plugins/jqwidgets/jqxcore.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/ressources/assets/plugins/detect/detect.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/ressources/assets/plugins/jquery-slimScroll/jquery.slimscroll.js"></script> 

<script src="<?php echo url('/'); ?>/ressources/client_validate/js/jquery.validate.min.js" type="text/javascript"></script>
@stop
