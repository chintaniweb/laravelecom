@extends('layouts.master_admin')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h4 class="page-title">Current Forms Listing</h4>
        </div>
    </div>
    
    <div class="row">
       
        <div class="col-xs-12 col-sm-12 m-t-20">
            
            <div class="card-box">
                @if(Session::has('msg'))
                    <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('msg') }}</p>
                @endif
                <div class="row m-0">
                    <div role="grid" class="dataTables_wrapper site-content-grid" id="datatable-editable_wrapper">
                        <div class="col-lg-12 p-0">
                            <div class="text-right m-b-10"> <a class="btn btn-primary" href="<?php echo url('/'); ?>/Form_creator/create">Add Form</a></div>
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

<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 
<!--<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/detect/detect.js"></script> -->
<!--<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jquery-slimScroll/jquery.slimscroll.js"></script> -->
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


$(document).ready(function () {

    var url = BASE_URL + "getFormList";
    $.jqx.theme = "custom";
    // prepare the data
    var source =
            {
                datatype: "json",
                updaterow: function (rowid, rowdata, commit) {

                    /////
                    {
                        // synchronize with the server - send update command

                    }

                    ////

                },
                datafields: [
                    {name: 'form_creator_id', type: 'int'},
                    {name: 'form_name', type: 'string'},
                    {name: 'on_site_date', type: 'date'},
                    {name: 'off_site_date', type: 'date'},
                    {name: 'questions', type: 'int'},
                    {name: 'submited', type: 'int'},
                ],
                id: 'form_creator_id',
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
        //alert(row); 
        var actionLink = '';
        var id = $("#jqxgrid").jqxGrid('getrowdata', row).form_creator_id;
        //alert(id);	

        actionLink = '<div class="text-center action-icons"><a title="Edit Form" href="' + BASE_URL + 'Form_creator/' + id + '/edit' + '" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a> \n\
                            | <a title="Add Question" href="' + BASE_URL + 'Form_question/create/' + id + '" class="on-default edit-row text-default"><i class="fa fa-file-archive-o"></i></a>\n\
                            | <a title="View Question" href="' + BASE_URL + 'Form_question/' + id + '" class="on-default edit-row text-default"><i class="fa fa-list"></i></a></div>'


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
                            {text: 'ID', datafield: 'form_creator_id', width: '5%', editable: false},
                            {text: 'Title', datafield: 'form_name', width: '35%', editable: false},
                            {text: 'Start Date', datafield: 'on_site_date', width: '15%', editable: false, columntype: 'date', cellsformat: '<?php echo ADMIN_JQR_GRID_DATE_FORMAT?>'},
                            {text: 'End Date', datafield: 'off_site_date', width: '15%', editable: false, columntype: 'date', cellsformat: '<?php echo ADMIN_JQR_GRID_DATE_FORMAT ?>'},
                            {text: 'Questions', datafield: 'questions', width: '10%', editable: false},
                            {text: 'Form Submit', datafield: 'submited', width: '10%', editable: false},
                            {text: 'Action', datafield: 'PageEdit', width: '10%', minwidth: '80', editable: false, filterable: false, cellsrenderer: actionlink}

                        ]
                    });

            //set Grid page limit for jqzgrid
            $('#jqxgrid').jqxGrid({
                pageSize: PAGE_SIZE,
            });
        });

</script>
@endsection