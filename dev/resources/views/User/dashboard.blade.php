@extends('layouts.master_admin')
@section('content')
<div class="container">
    <?php
    if (Session::has('website_id')) {

        $website_id = Session::get('website_id');
    }
    //echo $web;
    ?>
    <div class="row">
        <div class="col-xs-8 col-sm-8">
            <?php if ($website_id == 1) { ?>
                <h4 class="page-title">Dashboard</h4>
            <?php } elseif($website_id == 2) { ?>
                <h4 class="page-title">CTE Dashboard</h4>
            <?php } elseif($website_id == 3){ ?>
                <h4 class="page-title">ETA Dashboard</h4>
            <?php } else{ ?>
                <h4 class="page-title">Dashboard</h4>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="row">
                <div class="col-xs-12 col-lg-3">
                    <div class="widget-bg-color-icon card-box fadeInDown animated">
                        <div class="bg-icon bg-icon-info pull-left"> <i class="fa fa-users text-info"></i> </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b class="counter">13,570</b></h3>
                            <p class="text-muted">Active Users</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-3">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-pink pull-left"> <i class="fa fa-globe text-pink"></i> </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b class="counter">2800</b></h3>
                            <p class="text-muted">Monthly Total Visit Page </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-3">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-purple pull-left"> <i class="fa fa-eye text-purple"></i> </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b class="counter">16</b></h3>
                            <p class="text-muted">Today Total Visit</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-3">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-primary pull-left"> <i class="fa fa-facebook-official text-primary"></i> </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b class="counter">180</b></h3>
                            <p class="text-muted">Total Likes</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card-box">
                            <h4 class="text-dark header-title m-t-0">Total User</h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="morris-area-with-dotted" style="height: 300px;"></div>
                                </div>
                                <div class="col-md-4">
                                    <p class="font-600">Facebook <span class="text-primary pull-right">80%</span></p>
                                    <div class="progress m-b-30">
                                        <div class="progress-bar progress-bar-primary progress-animated wow animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> </div>
                                        <!-- /.progress-bar .progress-bar-danger --> 
                                    </div>
                                    <!-- /.progress .no-rounded -->

                                    <p class="font-600"> Google plus<span class="text-pink pull-right">50%</span></p>
                                    <div class="progress m-b-30">
                                        <div class="progress-bar progress-bar-pink progress-animated wow animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"> </div>
                                        <!-- /.progress-bar .progress-bar-pink --> 
                                    </div>
                                    <!-- /.progress .no-rounded -->

                                    <p class="font-600"> Twitter <span class="text-info pull-right">70%</span></p>
                                    <div class="progress m-b-30">
                                        <div class="progress-bar progress-bar-info progress-animated wow animated" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%"> </div>
                                        <!-- /.progress-bar .progress-bar-info --> 
                                    </div>
                                    <!-- /.progress .no-rounded --> 

                                </div>
                            </div>

                            <!-- end row --> 

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card-box">
                            <h4 class="text-dark header-title m-t-0">Facebook News Feed</h4>
                            <div class="row">
                                <div class="col-md-12 p-10 p-b-0 p-l-0 p-r-0">
                                    <img src="{{ url('resources/assets/img/fb-news-feedback.jpg') }}" width="100%" height="auto" style="max-height:290px;"  alt="" title=""> </div>
                            </div>

                            <!-- end row --> 

                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12 p-0">

                        <!--------------------------Updated Pages START --------------------------->

                        <?php $data = getUpdatedPages(); ?>
                        <div class="col-lg-12">
                            <div class="content-box" id="check-box1">
                                <header>
                                    <h5>Last 5 Updated Pages</h5>
                                    <div class="toolbar">
                                        <div class="btn-group"> <a class="btn btn-xs btn-primary minimize-box" data-toggle="collapse" href="#dash_c_1"> <i class="fa fa-angle-up"></i> </a> </div>
                                    </div>
                                </header>
                                <div id="dash_c_1" class="body table-responsive in">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th valign="middle" align="center">No.</th>
                                                <th valign="middle" align="left">Page Name</th>
                                                <th valign="middle" align="left">Page Preview</th>
                                                <th valign="middle" align="left">Last Updated On</th>
                                                <th valign="middle" align="left">Last Updated By</th>
                                                <th valign="middle" align="center">Publish</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($data as $row) {
                                                ?>  
                                                <tr>
                                                    <td align="center"><?php echo $i; ?></td>
                                                    <td align="left">
                                                        <a class="edittitle" target="_blank" title="Open in Content Editor" href="<?php echo url('/') . '/sitecontent/edit/' . $row->sitecontent_id; ?>">
                                                            <?php echo $row->navigation_title; ?>
                                                        </a>
                                                    </td>
                                                    <td align="left">
                                                        <?php
                                                        //fetch page_type
                                                        $page_type  = $row->page_type;
                                                        //set accessURL
                                                        $link = $row->access_url;
                                                        
                                                        if (stristr($link, 'http')) {
                                                            
                                                            $link = $row->access_url;
                                                        } 
                                                        else {
                                                            //$link = website_url() . '/page/' . $row->access_url;
                                                            if($page_type == "Typical Page"){
                                                   
                                                                $link = website_url() . '/page/' . $row->access_url;
                                                            }
                                                            else{
                                                                $link = website_url() . '/' . $row->access_url;
                                                            }
                                                        }
                                                        ?>
                                                        <a target="_blank" title="Page Preview" href="<?php echo $link; ?>">
                                                            <?php echo $row->page_title; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo date("m-d-Y H:m:i", strtotime($row->updated_at)); ?></td>
                                                    <td><?php echo $row->added_by; ?></td>
                                                    <td align="left"><?php echo $row->status; ?></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>

                                            <tr>
                                                <td width="100%" align="right" colspan="7"><a title="View List" href="<?php echo url('/') . '/sitecontent'; ?>"><span><i class="fa fa-list"></i> View List</span></a></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!--------------------------Updated Pages END ----------------------------->


                        <!--------------------------SEO INFORMATION START --------------------------->

                        <div id="sortable1" class="col-lg-4 connectedSortable">
                            <div class="content-box" id="check-box2">
                                
                                <?php
                                
                                
                                $data = getSeoData(); 
                                if(count($data) != 0){
                                ?>
                                <header>
                                    <h5>SEO Information</h5>
                                    <div class="toolbar">
                                        <div class="btn-group"> <a class="btn btn-xs btn-primary minimize-box" data-toggle="collapse" href="#dash_l_1_1"> <i class="fa fa-angle-up"></i></a> </div>
                                    </div>
                                </header>
                                <div id="dash_l_1_1" class="body in">
                                    <table class="table table-condensed table-responsive">
                                        <thead>
                                            <tr>
                                                <th valign="middle" align="left">SEO Value</th>
                                                <th valign="middle" align="center">Total Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="left">Page Title</td>
                                                <td align="left"><?php echo $data[0]->total_meta_title; ?>/
                                                    <?php echo $data[0]->total_sitecontent; ?></td>
                                            </tr>
                                            <tr>
                                                <td align="left">Meta Keywords</td>
                                                <td align="left"><?php echo $data[0]->total_meta_description; ?>/
                                                    <?php echo $data[0]->total_sitecontent; ?></td>
                                            </tr>
                                            <tr>
                                                <td align="left">Meta Description</td>
                                                <td align="left"><?php echo $data[0]->total_meta_keywords; ?>/
                                                    <?php echo $data[0]->total_sitecontent; ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!--------------------------SEO INFORMATION END ----------------------------->

                        <!------------------------RECENTLY VISITED PAGES START ---------------------->
                        <div id="sortable2" class="col-lg-4 connectedSortable">
                            <div class="content-box" id="check-box6">
                                <header>
                                    <h5>Recently Visited Pages</h5>
                                    <div class="toolbar">
                                        <div class="btn-group"> <a class="btn btn-xs btn-primary minimize-box" data-toggle="collapse" href="#dash_l_5"> <i class="fa fa-angle-up"></i> </a> </div>
                                    </div>
                                </header>
                                <div id="dash_l_5" class="body in">
                                    <table class="table table-condensed table-responsive">
                                        <thead>
                                            <tr>
                                                <th valign="top" align="left">No.</th>
                                                <th valign="middle" align="center">Page Name</th>
                                                <th valign="middle" align="center">Total Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            <?php
                                            $recently_visited_data = recentlyVisitedPages();

                                            if(count($recently_visited_data) != 0){
                                            $i = 1;
                                            foreach ($recently_visited_data as $page) {
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $i; ?></td>
                                                    <td align="left"><?php echo $page->page_title; ?></td>
                                                    <td align="center"><?php
                                                        $pagecount = get_page_count();

                                                        foreach ($pagecount as $pdata) {
                                                            if ($pdata->page_id == $page->sitecontent_id)
                                                                echo $pdata->total;
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i ++;
                                            }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!------------------------RECENTLY VISITED PAGES END ------------------------>

                        <!------------------------TOP 5 VISITED PAGES START ------------------------->

                        <div id="sortable3" class="col-lg-4 connectedSortable">
                            <div class="content-box" id="check-box4">
                                <header>
                                    <h5>TOP 5 visited Pages</h5>
                                    <div class="toolbar">
                                        <div class="btn-group"> <a class="btn btn-xs btn-primary minimize-box" data-toggle="collapse" href="#dash_l_6"> <i class="fa fa-angle-up"></i> </a> </div>
                                    </div>
                                </header>
                                <div id="dash_l_6" class="body in">
                                    <table class="table table-condensed table-responsive">
                                        <thead>
                                            <tr>
                                                <th valign="top" align="left">No.</th>
                                                <th valign="middle" align="center">Page Name</th>
                                                <th valign="middle" align="center">Total Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $visited_page_data = visitedPageData();
                                            if(count($visited_page_data) != 0){
                                            $i = 1;
                                            foreach ($visited_page_data as $page) {
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $i; ?></td>
                                                    <td align="left"><?php echo $page->page_title; ?></td>
                                                    <td align="center"><?php echo $page->total; ?></td>
                                                </tr>
                                                <?php
                                                $i ++;
                                            }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!------------------------TOP 5 VISITED PAGES END --------------------------->
                    </div>
                </div>



                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/morris.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/raphael-min.js"></script> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script>
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdata.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxmenu.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdropdownlist.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.sort.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.pager.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.selection.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.filter.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxbuttons.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxscrollbar.js"></script>


<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.dashboard_2.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/config.js"></script>

<script>
jQuery(document).ready(function ($) {
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function () {


        // Create Moveable Div's
        $("#sortable1, #sortable2, #sortable3").sortable({
            connectWith: ".connectedSortable"
        }).disableSelection();
    });

    // Create checkbox checkable Div's
    $('#checkbox1').change(function () {
        if ($('#checkbox1').is(":checked")) {
            $('#check-box1').show();
        } else {
            $('#check-box1').hide();
        }
    });
    $('#checkbox2').change(function () {
        if ($('#checkbox2').is(":checked")) {
            $('#check-box2').show();
        } else {
            $('#check-box2').hide();
        }
    });
    $('#checkbox3').change(function () {
        if ($('#checkbox3').is(":checked")) {
            $('#check-box3').show();
        } else {
            $('#check-box3').hide();
        }
    });
    $('#checkbox4').change(function () {
        if ($('#checkbox4').is(":checked")) {
            $('#check-box4').show();
        } else {
            $('#check-box4').hide();
        }
    });
    $('#checkbox5').change(function () {
        if ($('#checkbox5').is(":checked")) {
            $('#check-box5').show();
        } else {
            $('#check-box5').hide();
        }
    });
    $('#checkbox6').change(function () {
        if ($('#checkbox6').is(":checked")) {
            $('#check-box6').show();
        } else {
            $('#check-box6').hide();
        }
    });
</script>

<script>
    function myFunction() {
        var myWindow = window.open("publish-page.html", "MsgWindow");
    }
</script>
@stop