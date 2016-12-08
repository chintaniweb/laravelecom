@extends('layouts.master_admin')

@section('content')
<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}
    .tab-main-bg{float:left; width:100%; background:#f4f8fb; height:30px; font-family:Verdana, Geneva, sans-serif;}
    .tab-main-bg ul{float:left; list-style:none; margin:0; padding:0; font-size:13px;}
    .tab-main-bg ul li{float:left; margin:4px 10px 0 15px; padding:0 10px; color:#222222; line-height:24px;}
    .tab-main-bg ul li a{text-decoration:none; color:#222222}
    .tab-main-bg ul li a:hover{text-decoration:none; color:#000;}
    .tab-main-bg ul li.active{float:left; padding:0 10px; background:#fff; border-top-left-radius:3px; border-top-right-radius:3px; border:1px solid #aaaaaa; border-bottom:1px solid #fff;}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h4 class="page-title">Forms's Question Listing</h4>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="card-box">
                <div class="tab-main-bg">
                    <ul>
                        <li><a href="<?php echo url('/') . '/Form_creator/'.$form_creator_id .'/edit'; ?>" title="">Main Info</a></li>
                        <li><a href="<?php echo url('/') . '/Form_question/create/'.$form_creator_id ; ?>" title="">Add</a></li>
                        <li class="active"><a href="#" title="">Edit</a></li>
                        <li><a href="<?php echo url('/') . '/Form_creator_update_limit/'.$form_creator_id ; ?>" title="">Limits</a></li>
                        <li><a href="<?php echo url('/') . '/Form_creator_delete/'.$form_creator_id; ?>" title="">Delete</a></li>
                    </ul>
                </div>
                <div class="row m-0">
                    <div role="grid" class="dataTables_wrapper site-content-grid" id="datatable-editable_wrapper">
                        <div class="col-lg-12 p-0">
                            <div class="text-right m-b-10"> <a class="btn btn-primary" href="<?php echo url('/') . "/Form_question/create/" . $form_creator_id; ?>">Add Question</a></div>
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
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jquery-slimScroll/jquery.slimscroll.js"></script> 
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

    var form_creator_id = <?php echo $form_creator_id; ?>;

    $(document).ready(function () {

        var url = BASE_URL + "getQuestionList/" + form_creator_id;
        //var url = ADMIN_BASE_URL + "Form_question/getQuestionList";

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
                        {name: 'form_questions_id', type: 'int'},
                        {name: 'question', type: 'string'},
                        {name: 'answer_type', type: 'String'},
                        {name: 'question_require', type: 'String'}
                    ],
                    id: 'form_questions_id',
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
            var id = $("#jqxgrid").jqxGrid('getrowdata', row).form_questions_id;
            var form_id = form_creator_id;
            //alert(id);	
            actionLink = '<div class="text-center action-icons"><a href="' + BASE_URL + 'Form_question/' + id + '/edit/form_id/' + form_id +'" class="on-default edit-row text-default"><i class="fa fa-pencil"></i></a></div>'


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
                            editable: true,
                            selectionmode: 'singlecell',
                            columnsheight: 50,
                            rowsheight: 50,
                            showfilterrow: true,
                            filterable: true,
                            columns: [
                                {text: 'ID', datafield: 'form_questions_id', width: '5%', editable: false},
                                {text: 'Question', datafield: 'question', width: '45%', editable: false},
                                {text: 'Type', datafield: 'answer_type', width: '20%', editable: false},
                                {text: 'Required', datafield: 'question_require', width: '20%', editable: false},
                                {text: 'Action', datafield: 'PageEdit', width: '10%', minwidth: '80', editable: false, filterable: false, cellsrenderer: actionlink}

                            ],
                        });

                //set Grid page limit for jqzgrid
                $('#jqxgrid').jqxGrid({
                    pageSize: PAGE_SIZE,
                });
            });

</script>
@endsection