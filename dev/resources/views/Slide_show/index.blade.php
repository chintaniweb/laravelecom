@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h4 class="page-title">Slide Show Categories</h4>
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
                            <div class="text-right m-b-10"> <a class="btn btn-primary" href="<?php echo url('/'); ?>/Slide_show_category/create">Add Page</a></div>
                            <div class="col-lg-12 col-xs-12 p-0">
                            </div>
                            </form-->    
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
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxgrid.edit.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxbuttons.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcheckbox.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxscrollbar.js"></script> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/config.js"></script> 

<script type="text/javascript">

var location_id = 0;
location_id = <?php
if ($location_id != 0)
    echo $location_id;
else
    echo "0"
    ?>;
//alert(location_id);

$(document).ready(function () {

    var url = BASE_URL + "getSlideShowCategory/" + location_id;
    //var url = ADMIN_BASE_URL + "Slide_show_category/getSlideShowCategory/";
    $.jqx.theme = "custom";
    // prepare the data
    var source =
            {
                datatype: "json",
                updaterow: function (rowid, rowdata, commit) {
                    {
                        // synchronize with the server - send update command
                        var data = "update=true&" + $.param(rowdata);
                        $.ajax({
                            dataType: 'json',
                            url: BASE_URL + "Slide_show/Admin/Slide_show_category/setUpdateValue/",
                            cache: false,
                            data: data,
                            success: function (data, status, xhr) {
                                // update command is executed.
                                commit(true);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                commit(false);
                            }
                        });
                    }

                    ////

                },
                datafields: [
                    {name: 'slide_show_category_id', type: 'int'},
                    {name: 'name', type: 'string'},
                    {name: 'location_name', type: 'string'},
                    {name: 'category_sort', type: 'float'}

                ],
                id: 'slide_show_category_id',
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
        var id = $("#jqxgrid").jqxGrid('getrowdata', row).slide_show_category_id;
        //alert(id);	                                       
        actionLink = '<div class="text-center action-icons"><a href="' + BASE_URL + 'Slide_show_category/' + id + '/edit" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a></div>'


        return actionLink;
    }
    // action define
    var deletelink = function (row, columnfield, value, columnproperties) {

        var actionLink = '';
        var id = $("#jqxgrid").jqxGrid('getrowdata', row).slide_show_category_id;
        //alert(id);	
        actionLink = '<div class="text-center action-icons"><a onclick="return confirm(\'Are you sure you want to delete this item?\');" href="' + BASE_URL + 'Slide_show_category/delete/' + id + '" class="on-default edit-row text-default">Delete</a></div>'


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
                        editable: true,
                        selectionmode: 'singlecell',
                        columnsheight: 50,
                        rowsheight: 50,
                        showfilterrow: true,
                        filterable: true,
                        columns: [
                            {text: 'ID', datafield: 'slide_show_category_id', width: '5%', cellsAlign: 'center', editable: false},
                            {text: 'Category', datafield: 'name', width: '30%', editable: false},
                            {text: 'Location', filtertype: 'checkedlist', datafield: 'location_name', width: '35%', editable: false},
                            {text: 'Sort', datafield: 'category_sort', columntype: 'textbox', cellsAlign: 'center', align: 'center', width: '10%', editable: false, createeditor: function (row, cellvalue, editor, cellText, width, height) {

                                    // construct the editor.
                                    //var inputElement = $("<input/>").prependTo(editor);
                                    //inputElement.jqxInput({ source: getEditorDataAdapter('spotlight_sort'), displayMember: "spotlight_sort", width: width, height: height});
                                },
                                initeditor: function (row, cellvalue, editor, celltext, pressedkey) {
                                    // set the editor's current value. The callback is called each time the editor is displayed.
                                    var value = parseInt(cellvalue);
                                    if (isNaN(value))
                                        value = 0;
                                    editor.jqxInput('setValue', value);
                                },
                                geteditorvalue: function (row, cellvalue, editor) {
                                    // return the editor's value.
                                    return editor.val();
                                }

                            },
                            {text: 'Action', datafield: 'PageEdit', width: '10%', align: 'center', editable: false, filterable: false, cellsrenderer: actionlink},
                            {text: 'Delete', datafield: 'RowEdit', width: '10%', editable: false, filterable: false, cellsrenderer: deletelink}

                        ],
                        columngroups: [
                            {text: 'Product Details', align: 'center', name: 'ProductDetails'}
                        ]
                    });

            //set Grid page limit for jqzgrid
            $('#jqxgrid').jqxGrid({
                pageSize: PAGE_SIZE,
            });
        });
</script>
@stop