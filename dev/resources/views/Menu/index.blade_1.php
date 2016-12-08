@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h4 class="page-title">Menu Listing</h4>
        </div>
    </div>
    <div class="col-lg-12 col-xs-12 p-t-10">
        <div class="info-title page-info page-info-title">Maintain Daily Defaults (Lunch) | 
            <a href="<?php echo url('/'); ?>/menu_intro">intro paragraph</a> | 
            <a href="<?php echo url('/'); ?>/menu_intro/weekend_setting_updates">WEEKEND OPTION</a> | 
            <a href="<?php echo url('/'); ?>/menu/menucopyview">COPY MENU</a> | 
            <a href="<?php echo url('/'); ?>/menu_intro/ical_setting">ICAL OPTION (OFF)</a>
        </div>
    </div>
    <div style="margin-top:60px;">
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
    @endif
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="card-box">
                <div class="row m-0">
                    <div role="grid" class="dataTables_wrapper site-content-grid" id="datatable-editable_wrapper">
                        <div class="col-lg-12 p-0">
                            <div class="text-right m-b-10"> <a class="btn btn-primary" href="{{url('/')}}/menu/add">Add Page</a></div>
                            
                            {!! Form::open(array('url' => '/menu/list','class' => 'form-horizontal', 'id'=>'myForm')) !!}
                            
                                <div class="col-lg-12 col-xs-12 p-0">
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

                                    </div>
                                    <div class="col-lg-2 col-xs-12 p-t-b-10">
                                        <select name="theYear" class="form-control">
                                            <option value="0"> All Years</option>
                                            <?php for ($i = 2010; $i <= date("Y") + 1; $i++) { ?>
                                                <option value="<?php echo $i; ?>" <?php echo ($year == $i) ? "selected" : ""; ?>><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1 col-xs-12 p-t-b-10">
                                        {!! Form::submit('Show >',array('class' => 'form-control')) !!}
                                        <!--<input type="submit" class="form-control" name="mysubmit" value="Show &gt;">-->
                                    </div>
                                </div>
                            {!! Form::close() !!}   
                            <div id='jqxWidget'>
                                <div id="jqxgrid"></div>
                            </div>
                            <div id="log"></div>
                            <div id="log2"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/detect/detect.js"></script> 
<!--<script type="text/javascript" src="<?php //echo url('/'); ?>assets/plugins/jquery-slimScroll/jquery.slimscroll.js"></script>--> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdata.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxmenu.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxlistbox.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdropdownlist.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.sort.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.pager.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.selection.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.filter.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.edit.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxbuttons.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxscrollbar.js"></script> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/config.js"></script>

<script type="text/javascript">

    search_str = <?php if ($month != "" && $year != "") echo $year . $month; ?>;
    year = <?php echo $year; ?>;
    month = <?php echo $month; ?>;
    //alert(search_str);

    $(document).ready(function () {

        var url = BASE_URL + "getMenuList/" + year + "/" + month;
        //alert(url);
        $.jqx.theme = "custom";
        // prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'menu_id', type: 'int'},
                        {name: 'event_date', type: 'string'},
                        {name: 'menu', type: 'string'},
                        {name: 'menu_id_tmp', type: 'String'}
                    ],
                    id: 'menu_id',
                    url: url,
                    root: "data"
                };


        var dataAdapter = new $.jqx.dataAdapter(source, {
            downloadComplete: function (data, status, xhr) {
            },
            loadComplete: function (data) {
            },
            loadError: function (xhr, status, error) {
            }
        });

        //sub page
        var SubCategoryLink = function (row, columnfield, value) {
            if (value == 'No') {
                return '<div class="text-center action-icons" style="font-size:18px">-</div>';
            }
            else {
                return '<div class="text-center action-icons" style="font-size:18px"><a href="sub-categories-list.html"><i class="fa fa-plus-circle"></i></a></div>';
            }
        }
        // action define
        var actionlink = function (row, columnfield, value, columnproperties) {

            var actionLink = '';
            var id = $("#jqxgrid").jqxGrid('getrowdata', row).menu_id;
            //alert(id);	
            actionLink = '<div class="text-center action-icons"><a href="' + BASE_URL + 'menu/edit/' + id + '" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a></div>'


            return actionLink;
        }

        $("#jqxgrid").jqxGrid(
                //$("#jqxgrid").jqxDataTable(
                        {
                            width: '100%',
                            //height: '100%',
                            source: dataAdapter,
                            pageable: true,
                            autoheight: true,
                            autoheight: true,
                            sortable: true,
                            altrows: true,
                            enabletooltips: true,
                            editable: false,
                            columnsheight: 50,
                            rowsheight: 50,
                            showfilterrow: true,
                            filterable: true,
                            columns: [
                                {text: 'ID', datafield: 'menu_id', width: '5%'},
                                {text: 'Date', datafield: 'event_date', width: '10%'},
                                {text: 'Menu', datafield: 'menu', width: '75%'},
                                {text: 'Action', datafield: 'PageEdit', width: '10%', minwidth: '80', editable: false, filterable: false, cellsrenderer: actionlink}

                            ]
                           
                        });

                //set Grid page limit for jqzgrid
                $('#jqxgrid').jqxGrid({
                    pageSize: 31,
                });

            });

</script>
@stop