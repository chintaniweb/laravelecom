@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Add Filing Cabinet</h4>
        </div>
    </div>
    <div class="row">
        <div class="row m-0">
            <div class="info-title page-info page-info-title">File Add</div>
            <p>Choose your category or categories on the left add then add your file below </p>
            <!--p>To upload up to 20 files at once, use our <a href="javascript:void(0)">MULTIPLE FILES UPLOADER</a></p-->
        </div>
        {!! Form::open(['url'=>'Filing_cabinet','class'=>'form-horizontal','files'=>'ture']) !!} 
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
        @endif

        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="col-sm-5 col-md-4 bg-muted">
                <div class="p-10">
                    <div class="m-b-10"><strong>Categories</strong></div>
                    <div class="m-b-10"><small> Select the sub category (or multiple sub categories) you want this File to display in.</small></div>
                    <div id='jqxWidget'>
                        <div style='float: left;'>
                            <div id='jqxTree' >
                                <?php
                                if ($page_tree != "") {
                                    echo $page_tree;
                                } else {
                                    echo 'No Category Available';
                                }
                                echo $page_tree;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="col-sm-7 col-md-8">
                <div class="card-box m-b-0">
                    <div class="row">
                        <div class=" col-sm-12 col-xs-12 p-t-b-10">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-md-4" for="site">Upload</label>
                                <div class="col-md-7">
                                    {!! Form::file('file_name',['class'=>'btn btn-block btn-grey', 'autocomplete' => 'off']),null!!}
                                </div>
                                <span id="err_link_url" class="error col-md-7 col-md-push-4">{{$errors->first('file_name')}}</span>
                            </div>

                            <div class="form-group row form-main-box">
                                <label class="control-label col-md-4">Start Date</label>
                                <div class="col-md-7">
                                    <input type="hidden" name="show_file_date" id="hidden_show_file_date" value="">
                                    <div id='show_file_date' name="show_file_date">&nbsp;</div>
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-md-4">End Date</label>
                                <div class="col-md-7">
                                    <input type="hidden" name="hide_file_date" id="hidden_hide_file_date" value="">
                                    <div id='hide_file_date' name="hide_file_date">&nbsp;</div>
                                    news item will display as active until 11:59 PM ET of this date
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-md-4">File Description<i data-tooltip="tooltip" title="file_description" data-original-title="File Description"></i></label>
                                <div class="col-md-7">
                                    {!! Form::textarea('file_description',null,['class'=>'form-control','rows'=>2,'cols'=>5,'id'=>'file_description'])!!}
                                </div>
                            </div>                        
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> {!! Form::submit('Save Page',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>

                    </div>
                    <!--p><div class="form-group row text-center">
                        <a class="btn btn-primary" href="javascript:void(0)">Upload Multiple Files</a> <a class="btn btn-primary" href="javascript:void(0)">Upload ZIP</a>
                       </div></p--> 
                </div>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>

<link rel="stylesheet" href="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/styles/jqx.summer.css" type="text/css" />
<link rel="stylesheet" href="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/styles/jqx.base.css" type="text/css" />
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 

<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdata.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxscrollbar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxpanel.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxtree.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcheckbox.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/globalization/globalize.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 

<script src="<?php echo url('/'); ?>/resources/client_validate/js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript">
function myFunction() {
    document.getElementById("myForm").submit();
}
var basicDemo = (function() {
    //Adding event listeners	
    function _addEventListeners() {
        $('#showWindowButton').click(function() {
            $('#window').jqxWindow('open');
        });
        $('#hideWindowButton').click(function() {
            $('#window').jqxWindow('hide');
        });
    }
    ;

    //Creating the demo window
    function _createWindow() {
        var jqxWidget = $('#jqxWidget');
        var offset = jqxWidget.offset();
        $('#window').jqxWindow({
            position: 'center',
            //showCollapseButton: true,
            autoOpen: false,
            isModal: true,
            maxHeight: 400,
            maxWidth: 700,
            minHeight: 200,
            minWidth: 200,
            width: '100%',
            resizable: false,
            draggable: false,
            initContent: function() {
                $('#window').jqxWindow('focus');
            }
        });
    }
    ;
    return {
        config: {
            dragArea: null
        },
        init: function() {
            //Attaching event listeners
            _addEventListeners();
            //Adding jqxWindow
            _createWindow();
        }
    };
}());
$(document).ready(function() {
    $("#tab2").click(function() {
        $("#tab-description2").slideToggle();
        $("#tab1").toggleClass("top-btn-hide");
        $("#tab2 .fa").toggleClass("fa-angle-double-up");
        $("#tab2 .fa").toggleClass("fa-angle-double-down");
    });

    //get value from PHP - hidden element
    hidden_on_starting_date = $("#hidden_show_file_date").val();
    hidden_on_ending_date = $("#hidden_hide_file_date").val();

    //set updated date
    if (hidden_on_starting_date != "01/01/1970")
        $('#show_file_date').jqxDateTimeInput('setDate', hidden_on_starting_date);
    //alert($('#show_file_date').val());
    if (hidden_on_ending_date != "01/01/1970")
        $('#hide_file_date').jqxDateTimeInput('setDate', hidden_on_ending_date);
});
$("#show_file_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: '<?php echo ADMIN_JQR_DATE_FORMAT?>'})
$("#hide_file_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: '<?php echo ADMIN_JQR_DATE_FORMAT?>'})

$(document).ready(function() {
    // Create jqxTree
    $('#jqxTree').jqxTree({height: '300px', width: '300px'});
    $('#jqxTree').bind('select', function(event) {
        var htmlElement = event.args.element;
        var item = $('#jqxTree').jqxTree('getItem', htmlElement);
        //alert(item.label);
    });
});
</script>

@endsection