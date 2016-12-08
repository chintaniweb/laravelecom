@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h4 class="page-title">Slide Show List</h4>
        </div>
        <div class="pull-right col-xs-2 col-sm-2">
            <select class="form-control" name="website_id" id="website_id" onchange="get_id(this.value)" >

                <?php
            
                if (Session::has('website_id')) {

                        //fetch user name from session
                        $website_id = Session::get('website_id');
                }
                
               //echo $website_id;exit;
                
                foreach ($website_data as $website) {
                //print_r($website);
                ?>
                <option value="<?php echo $website->website_id ?>" <?php echo ($website->website_id == $website_id) ? "Selected" : ""; ?>><?php echo $website->name; ?></option>                                       
            <?php }?>
                                              
            </select>
        </div>
    </div>
   @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="card-box">
                <div class="row m-0">
                    <div role="grid" class="dataTables_wrapper site-content-grid" id="datatable-editable_wrapper">
                        <div class="col-lg-12 p-0">
                            <!--
                            <div class="info-title page-info page-info-title">
                              Main Pages
                            </div> 
                            -->
                            <!--div class="text-right m-b-10"> <span><i class="fa fa-circle text-success"></i> Complete</span><span class="p-l-20"><i class="fa fa-circle text-warning"></i> Product Description or SEO Details Missing</span><span class="p-l-20"><i class="fa fa-circle text-danger"></i> Dropshipper SKU or Assembly Items Missing</span> </div-->
                            <div class="text-right m-b-10"> <a class="btn btn-primary" href="<?php echo url('/'); ?>/Slide_show/create">Add Page</a></div>
                            <div id="dataTable"></div>

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
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdata.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxlistbox.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdropdownlist.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxbuttons.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxscrollbar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatatable.js"></script> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/config.js"></script> 

<script type="text/javascript">
    var that = this;
    $(document).ready(function () {
        var orderdetailsurl = BASE_URL + "getSlideShowList";
        //var theme = 'classic';

        var ordersSource =
                {
                    dataFields: [
                        {name: 'slide_show_id', type: 'int'},
                        {name: 'title', type: 'string'},
                        {name: 'on_site_date', type: 'date'},
                        {name: 'off_site_date', type: 'date'},
                        {name: 'slide_show_sort', type: 'String'},
                        {name: 'slide_show_category_id', type: 'int'},
                        {name: 'slide_show_id_tmp', type: 'int'}


                    ],
                    sortcolumn: 'slide_show_sort',
                    sortdirection: 'asc',
                    root: "data",
                    dataType: "json",
                    cache: false,
                    id: 'slide_show_id',
                    url: orderdetailsurl,
                    addRow: function (rowID, rowData, position, commit) {
                        // synchronize with the server - send insert command
                        // call commit with parameter true if the synchronization with the server is successful 
                        // and with parameter false if the synchronization failed.
                        // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
                        commit(true);
                    },
                    updateRow: function (rowID, rowData, commit) {

                        var data = "insert=true&" + $.param(rowData);
                        $.ajax({
                            dataType: 'json',
                            url: BASE_URL + "Slide_show/Admin/Slide_show/sortUpdate/",
                            data: data,
                            cache: false,
                            success: function (data, status, xhr) {
                                // insert command is executed.
                                commit(true);
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                commit(false);
                            }
                        });
                        // synchronize with the server - send update command
                        // call commit with parameter true if the synchronization with the server is successful 
                        // and with parameter false if the synchronization failed.
                        commit(true);
                    },
                    deleteRow: function (rowID, commit) {
                        // synchronize with the server - send delete command
                        // call commit with parameter true if the synchronization with the server is successful 
                        // and with parameter false if the synchronization failed.
                        commit(true);
                    }
                };
        var dataAdapter = new $.jqx.dataAdapter(ordersSource, {
            loadComplete: function () {
                // data is loaded.
            }
        });
        this.editrow = -1;


        $("#dataTable").jqxDataTable(
                {
                    width: '100%',
                    source: dataAdapter,
                    pageable: true,
                    altRows: true,
                    sortable: true,
                    filterable: true,
                    editable: true,
                    editSettings: {saveOnPageChange: true, saveOnBlur: true, saveOnSelectionChange: true, cancelOnEsc: true, saveOnEnter: true, editOnDoubleClick: true, editOnF2: false},
                    // called when jqxDataTable is going to be rendered.
                    pagerButtonsCount: 8,
                    columns: [
                        {text: 'ID', editable: false, dataField: 'slide_show_id', cellsAlign: 'center', align: 'center', width: '5%'},
                        {text: 'Title', editable: false, dataField: 'title', cellsAlign: 'left', align: 'left', width: '55%'},
                        {text: 'Start Date', editable: false, dataField: 'on_site_date', cellsAlign: 'center', align: 'center', width: '10%', columntype: 'date', cellsformat: '<?php echo ADMIN_JQR_GRID_DATE_FORMAT ?>'},
                        {text: 'End Date', editable: false, dataField: 'off_site_date', cellsAlign: 'center', align: 'center', width: '10%', columntype: 'date', cellsformat: '<?php echo ADMIN_JQR_GRID_DATE_FORMAT ?>'},
                        {text: 'Sort', editable: true, dataField: 'slide_show_sort', cellsAlign: 'center', align: 'center', width: '5%'},
                        {text: 'Action', dataField: 'slide_show_id_tmp', cellsAlign: 'center', align: "center", columnType: 'int', width: '15%', minwidth: '80', editable: false, filterable: false, cellsRenderer: function (row, column, value) {

                                actionLink = '<div class="text-center action-icons"><a title="Update Record" href="' + BASE_URL + 'Slide_show/' + value + '/edit" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a></div>'
                                return actionLink;
                            }

                        }
                    ]
                });
        //set Grid page limit for jqxDataTable
        $('#dataTable').jqxDataTable({
            pageSize: PAGE_SIZE,
        });
    });
</script>
<script type="text/javascript">
    function get_id(website_id)
    {
        //alert(website_id);
        window.location.href= BASE_URL + "Slide_show/set_website/"+website_id;
    }
</script>

@stop