@extends('layouts.master_admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h4 class="page-title">Email Template</h4>
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
                            <div class="text-right m-b-10"> <a class="btn btn-primary" href="<?php echo url('/'); ?>/Email_template/create">Add Page</a></div>
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
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/jquery-1.11.1.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/jquery-ui.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/detect/detect.js"></script> 
<script type="text/javascript" ssrc="<?php echo url('/'); ?>/resources/assets/plugins/jquery-slimScroll/jquery.slimscroll.js"></script> 
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
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/waves.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/config.js"></script> 

<script type="text/javascript">
$(document).ready(function () {
    var url = BASE_URL + "getEmailtemplate";
    $.jqx.theme = "custom";
    // prepare the data
    var source =
            {
                datatype: "json",
                datafields: [
                    {name: 'email_template_id', type: 'int'},
                    {name: 'email_template_name', type: 'String'},
                    {name: 'from_name', type: 'String'},
                    {name: 'from_email', type: 'String'},
                    {name: 'subject', type: 'String'}
                ],
                id: 'email_template_id',
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

    // action define
    var actionlink = function (row, columnfield, value, columnproperties) {

        var actionLink = '';
        var id = $("#jqxgrid").jqxGrid('getrowdata', row).email_template_id;
        //alert(id);	
        actionLink = '<div class="text-center action-icons"><a href="' + BASE_URL + 'Email_template/' + id + '/edit" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a></div>'

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
                        sortable: true,
                        altrows: true,
                        enabletooltips: true,
                        editable: false,
                        columnsheight: 50,
                        rowsheight: 50,
                        showfilterrow: true,
                        filterable: true,
                        columns: [
                            {text: 'ID', datafield: 'email_template_id', width: '10%'},
                            {text: 'Template Name', datafield: 'email_template_name', width: '20%'},
                            {text: 'Name', datafield: 'from_name', width: '20%'},
                            {text: 'Email', datafield: 'from_email', width: '20%'},
                            {text: 'Subject', datafield: 'subject', width: '20%'},
                            {text: 'Action', datafield: 'PageEdit', width: '10%', cellsAlign: 'center', align: 'center', minwidth: '80', editable: false, filterable: false, cellsrenderer: actionlink}

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