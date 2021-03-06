@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h4 class="page-title">Website List</h4>
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
                            <div class="text-right m-b-10"><a class="btn btn-primary" href="<?php echo url('/'); ?>/Website/create">Add Page</a></div>
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
        var orderdetailsurl = BASE_URL + "getWebsite";
        var theme = 'classic';

        var ordersSource =
                {
                    dataFields: [
                        {name: 'website_id', type: 'int'},
                        {name: 'name', type: 'String'},
                        {name: 'discription', type: 'String'},
                        {name: 'status', type: 'String'},
                        {name: 'website_logo', type: 'Float'},
                        {name: 'website_id_tmp', type: 'int'}
                    ],
                    root: "data",
                    dataType: "json",
                    cache: false,
                    id: 'website_id',
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
                            url: BASE_URL + "Website/Admin/Website/sortUpdate/",
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
                    rendering: function ()
                    {
                        // destroys all buttons.
                        if ($(".editButtons").length > 0) {
                            $(".editButtons").jqxButton('destroy');
                        }
                        if ($(".cancelButtons").length > 0) {
                            $(".cancelButtons").jqxButton('destroy');
                        }
                    },
                    // called when jqxDataTable is rendered.
                    rendered: function () {
                        if ($(".editButtons").length > 0) {
                            $(".cancelButtons").jqxButton();
                            $(".editButtons").jqxButton();

                            var editClick = function (event) {
                                var target = $(event.target);
                                // get button's value.
                                var value = target.val();
                                // get clicked row.


                                var rowIndex = parseInt(event.target.getAttribute('data-row'));
                                if (isNaN(rowIndex)) {
                                    return;
                                }
                                if (value == "Edit") {
                                    // begin edit.
                                    $("#dataTable").jqxDataTable('beginRowEdit', rowIndex);
                                    target.parent().find('.cancelButtons').show();
                                    target.val("Save");
                                }
                                else {
                                    // end edit and save changes.
                                    target.parent().find('.cancelButtons').hide();
                                    target.val("Edit");
                                    $("#dataTable").jqxDataTable('endRowEdit', rowIndex);
                                }
                            }
                            $(".editButtons").on('click', function (event) {
                                editClick(event);
                            });

                            $(".cancelButtons").click(function (event) {
                                // end edit and cancel changes.
                                var rowIndex = parseInt(event.target.getAttribute('data-row'));
                                if (isNaN(rowIndex)) {
                                    return;
                                }
                                $("#dataTable").jqxDataTable('endRowEdit', rowIndex, true);
                            });
                        }
                    },
                    pagerButtonsCount: 8,
                    columns: [
                        {text: 'ID', editable: false, dataField: 'website_id', cellsAlign: 'center', align: 'center', width: '5%'},
                        {text: 'Name', editable: false, dataField: 'name', cellsAlign: 'left', align: 'left', width: '65%'},
                        {text: 'Status', editable: false, dataField: 'status', cellsAlign: 'left', align: 'left', width: '15%'},
                        {text: 'Action', dataField: 'website_id_tmp', cellsAlign: 'center', align: "center", columnType: 'int', width: '15%', minwidth: '80', editable: false, filterable: false, cellsRenderer: function (row, column, value) {

                                actionLink = '<div class="text-center action-icons"><a title="Update Record" href="' + BASE_URL + 'Website/' + value + '/edit" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a></div>'
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
@stop