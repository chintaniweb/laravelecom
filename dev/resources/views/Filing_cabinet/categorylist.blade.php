@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h4 class="page-title">Website Filing Cabinet - Category</h4>
        </div>
    </div>
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="card-box">
                <div class="row m-0">
                    <div role="treeGrid" class="dataTables_wrapper site-content-treeGrid" id="datatable-editable_wrapper">
                        <div class="col-lg-12 p-0">
                            <!--
                            <div class="info-title page-info page-info-title">
                              Main Pages
                            </div> 
                            -->
                            <!--div class="text-right m-b-10"> <span><i class="fa fa-circle text-success"></i> Complete</span><span class="p-l-20"><i class="fa fa-circle text-warning"></i> Product Description or SEO Details Missing</span><span class="p-l-20"><i class="fa fa-circle text-danger"></i> Dropshipper SKU or Assembly Items Missing</span> </div-->
                            <div class="text-right m-b-10"><a href="<?php echo url('/') . '/Filing_cabinet_intro'; ?>">Intro Paragraph</a> <a class="btn btn-primary" href="<?php echo url('/'); ?>/Filing_cabinet_category/create">Add Page</a></div>
                            <div class="text-left m-b-10"> <a class="btn btn-primary" href="<?php echo url('/'); ?>/Filing_cabinet">Root Category</a></div>


                            <div id="treeGrid"></div>

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
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxscrollbar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxlistbox.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdropdownlist.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxbuttons.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatatable.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxtreegrid.js"></script> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/config.js"></script> 

<script type="text/javascript">
var that = this;
var id =<?php echo Request::segment(3) ? Request::segment(3) : 0 ?>;

$(document).ready(function() {

    var orderdetailsurl = BASE_URL + "getFilingCabinetCategoryList/" + id;

    var theme = 'classic';

    var ordersSource =
            {
                dataFields: [
                    {name: 'filing_cabinet_category_id', type: 'int'},
                    {name: 'parent_id', type: 'int'},
                    {name: 'category_name', type: 'string'},
                    {name: 'filing_cabinet_category_id_cat_tmp', type: 'int'}, // show file
                    {name: 'filing_cabinet_category_id_tmp', type: 'int'} //show sub category


                ],
                hierarchy:
                        {
                            keyDataField: {name: 'filing_cabinet_category_id'},
                            parentDataField: {name: 'category_name'}
                        },
                root: "data",
                dataType: "json",
                cache: false,
                id: 'filing_cabinet_category_id',
                url: orderdetailsurl,
                addRow: function(rowID, rowData, position, commit) {
                    // synchronize with the server - send insert command
                    // call commit with parameter true if the synchronization with the server is successful 
                    // and with parameter false if the synchronization failed.
                    // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
                    commit(true);
                },
                updateRow: function(rowID, rowData, commit) {

                    var data = "insert=true&" + $.param(rowData);
                    $.ajax({
                        dataType: 'json',
                        url: BASE_URL + "Filing_cabinet/Admin/Filing_cabinet/sortUpdate/",
                        data: data,
                        cache: false,
                        success: function(data, status, xhr) {
                            // insert command is executed.
                            commit(true);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            commit(false);
                        }
                    });
                    // synchronize with the server - send update command
                    // call commit with parameter true if the synchronization with the server is successful 
                    // and with parameter false if the synchronization failed.
                    commit(true);
                },
                deleteRow: function(rowID, commit) {
                    // synchronize with the server - send delete command
                    // call commit with parameter true if the synchronization with the server is successful 
                    // and with parameter false if the synchronization failed.
                    commit(true);
                }
            };
    var dataAdapter = new $.jqx.dataAdapter(ordersSource, {
        loadComplete: function() {
            // data is loaded.
        }
    });
    this.editrow = -1;


    $("#treeGrid").jqxTreeGrid(
            {
                width: '100%',
                source: dataAdapter,
                pageable: true,
                altRows: true,
                sortable: true,
                filterable: true,
                editable: true,
                editSettings: {saveOnPageChange: true, saveOnBlur: true, saveOnSelectionChange: false, cancelOnEsc: true, saveOnEnter: true, editOnDoubleClick: false, editOnF2: false},
                // called when jqxTreeGrid is going to be rendered.
                ready: function() {
                    $("#treeGrid").jqxTreeGrid('expandRow', '2');
                },
                rendering: function()
                {
                    // destroys all buttons.
                    if ($(".editButtons").length > 0) {
                        $(".editButtons").jqxButton('destroy');
                    }
                    if ($(".cancelButtons").length > 0) {
                        $(".cancelButtons").jqxButton('destroy');
                    }
                },
                // called when jqxTreeGrid is rendered.
                rendered: function() {
                    if ($(".editButtons").length > 0) {
                        $(".cancelButtons").jqxButton();
                        $(".editButtons").jqxButton();

                        var editClick = function(event) {
                            var target = $(event.target);
                            // get button's value.
                            var value = target.val();
                            // get clicked row.
                            var rowIndex = parseInt(event.target.getAttribute('data-row'));
                            if (isNaN(rowIndex)) {
                                return;
                            }
                            if (value === "Edit") {
                                // begin edit.
                                $("#treeGrid").jqxTreeGrid('beginRowEdit', rowIndex);
                                target.parent().find('.cancelButtons').show();
                                target.val("Save");
                            }
                            else {
                                // end edit and save changes.
                                target.parent().find('.cancelButtons').hide();
                                target.val("Edit");
                                $("#treeGrid").jqxTreeGrid('endRowEdit', rowIndex);
                            }
                        }
                        $(".editButtons").on('click', function(event) {
                            editClick(event);
                        });

                        $(".cancelButtons").click(function(event) {
                            // end edit and cancel changes.
                            var rowIndex = parseInt(event.target.getAttribute('data-row'));
                            if (isNaN(rowIndex)) {
                                return;
                            }
                            $("#treeGrid").jqxTreeGrid('endRowEdit', rowIndex, true);
                        });
                    }
                },
                pagerButtonsCount: 8,
                columns: [
                    {text: 'ID', editable: false, dataField: 'filing_cabinet_category_id', width: '5%'},
                    {text: 'Category', editable: false, dataField: 'category_name', cellsAlign: 'left', align: 'left', width: '50%'},
                    {text: 'Show File', dataField: 'filing_cabinet_category_id_cat_tmp', cellsAlign: 'center', align: "center", columnType: 'int', width: '10%', minwidth: '80', editable: false, filterable: false, cellsRenderer: function(row, column, value) {
                            sub_category_Link = '<div class="text-center action-icons"><a title="Show Files" href="' + BASE_URL + 'Filing_cabinet/fileList/' + value + '" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a></div>'
                            return sub_category_Link;
                        }
                    },
                    {text: 'Sub Category', dataField: 'filing_cabinet_category_id_tmp', cellsAlign: 'center', align: "center", columnType: 'int', width: '35%', minwidth: '80', editable: false, filterable: false, cellsRenderer: function(row, column, value) {
                            sub_category_Link = '<div class="text-center action-icons"><a title="Sub Category" href="' + BASE_URL + 'Filing_cabinet/index/' + value + '" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a></div>'
                            return sub_category_Link;
                        }
                    }
                ]
            });
    //set Grid page limit for jqxDataTable
    $('#treeGrid').jqxTreeGrid({
        pageSize: PAGE_SIZE,
    });
});
</script>
@endsection