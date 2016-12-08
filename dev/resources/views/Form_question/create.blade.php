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
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title"><?php echo "Add New Question"; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
                       <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif

            <div class="tab-main-bg">
                <ul>
                    <li><a href="<?php echo url('/') . '/Form_creator/'.$id.'/edit'; ?>" title="">Main Info</a></li>
                    <li class="active"><a href="#" title="">Add</a></li>
                    <li><a href="<?php echo url('/') .'/Form_question/'.$id; ?>" title="">Edit</a></li>
                    <li><a href="<?php echo url('/') . '/Form_creator_update_limit/'.$id ; ?>" title="">Limits</a></li>
                    <li><a href="<?php echo url('/') . '/Form_creator_delete/'.$id; ?>" title="">Delete</a></li>
                </ul>
            </div>
            {!! Form::open(array('url' => 'Form_question/add/','class' => 'form-horizontal','id'=>'myForm','files'=>'true')) !!}
            {!! Form::hidden('_token', csrf_token(), array('class' => 'form-control')) !!}
            {!! Form::hidden('form_creator_id', $id, array('class' => 'form-control')) !!}
                <div class="card-box m-b-0">
                    <div class="row">
                        <div class=" col-sm-12 col-xs-12 p-t-b-10">
                            <div class="form-group row form-main-box">
                                {!!Form::label('Question','Question',['class' => 'control-label col-md-4'])!!}
                                <div class="col-sm-7">
                                    {!! Form::text('question', null,array('class' => 'form-control','id' => 'question')) !!}                                
                                </div>
                                @if ($errors->has('question')) 
                                     <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('question') }}</p> 
                                @endif
                            </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('Sorted','Sorted',['class' => 'control-label col-md-4'])!!}
                                <div class="col-sm-7">
                                    {!! Form::text('question_sort', null,array('class' => 'form-control','id' => 'question_sort')) !!}   
                                </div>                                
                            </div>
                            <div class="form-group">
                                {!!Form::label('Require','Require',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::select('question_require', ['Yes' => 'Yes','No' => 'No'],'No',array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!!Form::label('Type','Type',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                     {!! Form::select('answer_type', ['ShortAnswer'         => 'Short Answer',
                                                                      'MediumAnswer'        => 'Medium Answer',
                                                                      'BigAnswer'           => 'Long Answer',
                                                                      'TrueFalse'           => 'True/False',
                                                                      'MultipleChoice'      => 'Multiple Choice',
                                                                      'MultipleChoiceLimit' => 'Multiple Choice (LIMITS)',
                                                                      'DateFormat'          => 'Date Format',
                                                                      'EmailFormat'         => 'Email Format',
                                                                      'FileUpload'          => 'File Upload',
                                                                      'InfoOnly'            => 'Informational (no answer)']
                                                                      ,'InfoOnly',array('class' => 'form-control','id' => 'answer_type')) !!}
                               </div>
                            </div>
                            <div class="form-group">
                                {!!Form::label('Show file with question','Show file with question',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                     {!! Form::file('question_file',array('class'=>'btn btn-block btn-grey','id' => 'question_file')) !!}
                                    allows visitor to view / download this file as it pertains to question
                                </div>
                            </div>

                            <div class="form-group" id="question_phrase" >
                                {!!Form::label('User(Form Taker):','User(Form Taker):',['class' => 'control-label col-md-4'])!!}
                                <div class="col-md-7">
                                    {!! Form::select('questionphrase', ['select1'               => 'User selects one option only (Radio Check Box)',
                                                                        'select1list'             => 'Select one option only (Pull-Down List)',
                                                                        'selectmultiple'          => 'User selects multiple',
                                                                        'select1answer'           => 'User selects one and may type answer',
                                                                        'selectmultipleanswer'    => 'User selects multiple and may type answer'],
                                                                        'select1',array('class' => 'form-control','id' => 'questionphrase')) !!}
                                    
                                    {!!Form::label(' Answer Choices:
                                        Enter each choice on a separate line (100 character limit per choice).',
                                        ' Answer Choices:
                                        Enter each choice on a separate line (100 character limit per choice).')!!}
                                    {!! Form::textarea('multiplechoicetext', null,array('class' => 'form-control',
                                                       'id' => 'multiplechoicetext','style'=>'width:400px')) !!}  
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                            {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
            
        </div>
    </div>
</div>
<div style="position:relative;">
    <div class="navbar-fixed-bottom fix-b-list">
        <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
            <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
     {!! Form::close() !!}

<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/globalization/globalize.js"></script> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 

<script>

                                        $('#answer_type').on('change', function () {
                                            //alert($(this).find(':Selected').text());
                                            if ($(this).find(':Selected').text() == 'Multiple Choice') {
                                                $('#question_phrase').show();
                                            }
                                            else {
                                                $('#question_phrase').hide();
                                            }
                                        });
                                        $('#answer_type').on('change', function () {
                                            //alert($(this).find(':Selected').text());
                                            if ($(this).find(':Selected').text() == 'Multiple Choice (LIMITS)')
                                            {
                                                $('#ans_limit').show();
                                            }
                                            else
                                            {
                                                $('#ans_limit').hide();
                                            }

                                        });

                                        var basicDemo = (function () {
                                            //Adding event listeners	
                                            function _addEventListeners() {
                                                $('#showWindowButton').click(function () {
                                                    $('#window').jqxWindow('open');
                                                });
                                                $('#hideWindowButton').click(function () {
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
                                                    initContent: function () {
                                                        $('#window').jqxWindow('focus');
                                                    }
                                                });
                                            }
                                            ;
                                            return {
                                                config: {
                                                    dragArea: null
                                                },
                                                init: function () {
                                                    //Attaching event listeners
                                                    _addEventListeners();
                                                    //Adding jqxWindow
                                                    _createWindow();
                                                }
                                            };
                                        }());
                                        $(document).ready(function () {

                                            $("#tab2").click(function () {
                                                $("#tab-description2").slideToggle();
                                                $("#tab1").toggleClass("top-btn-hide");
                                                $("#tab2 .fa").toggleClass("fa-angle-double-up");
                                                $("#tab2 .fa").toggleClass("fa-angle-double-down");
                                            });

                                            // Create jqxTabs.

                                            //get value from PHP - hidden element
                                            hidden_on_site_date = $("#hidden_on_site_date").val();
                                            hidden_off_site_date = $("#hidden_off_site_date").val();

                                            //set updated date
                                            if (hidden_on_site_date != "01/01/1970")
                                                $('#on_site_date').jqxDateTimeInput('setDate', hidden_on_site_date);
                                            if (hidden_off_site_date != "01/01/1970")
                                                $('#off_site_date').jqxDateTimeInput('setDate', hidden_off_site_date);

                                            //alert(hidden_on_site_date);
                                        });

                                        $("#on_site_date").jqxDateTimeInput({width: '300px', height: '30px'})
                                        $("#off_site_date").jqxDateTimeInput({width: '300px', height: '30px'})

</script>

@endsection