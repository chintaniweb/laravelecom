@extends('layouts.master_admin')
@section('content')
<style>
    ul {
        padding:0px;
        margin: 0px;
    }
    #response {
        padding:10px;
        background-color:#9F9;
        border:2px solid #396;
        margin-bottom:20px;
    }
    #list li {
        margin: 0 0 3px;
        padding:8px;
        background-color:#e8e8e8;
        color:#000;
        list-style: none;
        font-size:13px;
    }
    .site-content-isting-bg ul {float:left; width: 100%; list-style: none; padding:0; margin: 0;}
    .site-content-isting-bg ul li {float:left; width: 100%;}
    .site-content-isting-box {background:#e9e9e9;}
    .site-content-isting-box span {padding-right:20px; font-size:13px; line-height:20px;}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-sm-6">
            <h4 class="page-title">User List</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('msg'))
            <p class="alert alert-success">{{ Session::get('msg') }}</p>
            @endif
            <div class="card-box">
                <div class="row m-0">
                    <div role="grid" class="dataTables_wrapper site-content-grid" id="datatable-editable_wrapper">
                        <div class="col-lg-12 p-0">
                            <div class="text-right m-b-10"> <a class="btn btn-primary" href="{{ url('user/add') }}">Add User</a></div>
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
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatatable.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/waves.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/config.js"></script> 

<script type="text/javascript">
var that = this;
$(document).ready(function () {
    var url = BASE_URL + "user/getUser";
    var theme = 'classic';

    var ordersSource =
            {
                dataFields: [
                    {name: 'id', type: 'int'},
                    {name: 'first_name', type: 'string'},
                    {name: 'last_name', type: 'string'},
                    {name: 'email', type: 'string'},
                    {name: 'id_tmp', type: 'int'}
                ],
                root: "data",
                dataType: "json",
                cache: false,
                id: 'id',
                url: url,
                addRow: function (rowID, rowData, position, commit) {
                    // synchronize with the server - send insert command
                    // call commit with parameter true if the synchronization with the server is successful 
                    // and with parameter false if the synchronization failed.
                    // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
                    commit(true);
                },
                updateRow: function (rowID, rowData, commit) {

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
                editSettings: {saveOnPageChange: true, saveOnBlur: true, saveOnSelectionChange: false, cancelOnEsc: true, saveOnEnter: true, editOnDoubleClick: false, editOnF2: false},
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
                    {text: 'ID', editable: false, dataField: 'id', width: '10%'},
                    {text: 'First Name', editable: false, dataField: 'first_name', cellsAlign: 'left', align: 'left', width: '20%'},
                    {text: 'Last Name', editable: false, dataField: 'last_name', cellsAlign: 'left', align: 'left', width: '20%'},
                    {text: 'Email', editable: false, dataField: 'email', cellsAlign: 'left', align: 'left', width: '30%'},
                    {text: 'Action', dataField: 'id_tmp', cellsAlign: 'center', align: "center", columnType: 'int', width: '20%', minwidth: '80', editable: false, filterable: false, cellsRenderer: function (row, column, value) {

                            actionLink = '<div class="text-center action-icons"><a title="Update Record" href="' + BASE_URL + 'user/edit/' + value + '" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a></div>'
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
