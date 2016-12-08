@extends('layouts.master_admin')

@section('content')
<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}
    .text-danger .alert {padding: 0 !important; margin-bottom: 5px !important; font-weight: normal !important;}
    .text-danger .alert strong {font-weight: normal !important;}

    .tab-main-bg{float:left; width:100%; background:#f4f8fb; height:30px; font-family:Verdana, Geneva, sans-serif;}
    .tab-main-bg ul{float:left; list-style:none; margin:0; padding:0; font-size:13px;}
    .tab-main-bg ul li{float:left; margin:4px 10px 0 15px; padding:0 10px; color:#222222; line-height:24px;}
    .tab-main-bg ul li a{text-decoration:none; color:#222222}
    .tab-main-bg ul li a:hover{text-decoration:none; color:#000;}
    .tab-main-bg ul li.active{float:left; padding:0 10px; background:#fff; border-top-left-radius:3px; border-top-right-radius:3px; border:1px solid #aaaaaa; border-bottom:1px solid #fff;}

    /* right box css */
    .sort-down{ float:right; font-size:18px; padding:0; margin:0; color:#000;}
    .sort-down a, .sort-down:hover{ color:#000;padding:0; margin:0;}
    .display-inline{ display:inline;}
    .fa-eye, .fa-history, .fa-map-pin, .fa-calendar{ font-size:15px;}
    .btn-right{ float:right;}
    .move-btn { float:left; display:inline-block; margin-top:10px;}
    #published, #publishtab2, #publishtab3 { display:none;}

    /* right box css over here */

    #accessurl { display:none;}
</style>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Add Site Content</h4>
        </div>
    </div>

    <div class="row">
        {!! Form::open(array('url' => 'sitecontent/add','files'=>'true','class' => 'form-horizontal')) !!}
        {!! Form::hidden('_token', csrf_token(), array('class' => 'form-control')) !!}
        <div class="col-xs-9 col-sm-9 m-t-20">
            <div class="card-box m-b-0">
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                @endif
                <div class="row">
                    <div role="grid" class="dataTables_wrapper" id="datatable-editable_wrapper">
                        <div class="col-lg-12 padding-15">
                            <div class="research-box padding-15">

                                <!--------------------- PAGE INFORMATION --------------------->      
                                <div class="p-20" id="general">

                                    <div class="info-title page-info page-info-title"> Page Information </div>

                                    <?php if ($page_tree != "") { ?>
                                        <div class="form-group">
                                            {!! Form::label('Page Root', 'Page Root',array('class' => 'control-label col-md-4')) !!}
                                            <div class="col-md-7">
                                                <?php
                                                echo $page_tree;
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="form-group form-main-box">
                                        {!! Form::label('Navigation Title', 'Navigation Title *',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('navigation_title', null, array('class' => 'form-control','id' => 'navigation_title')) !!}

                                            @if ($errors->has('navigation_title')) 
                                            <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('navigation_title') }}</p> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('Page Type', 'Page Type *',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::select('page_type', ['Typical Page' => 'Typical Page','Goto Page' => 'Goto Page'],'Standard Page',array('class' => 'form-control', 'id' => 'purpose')) !!}

                                            @if ($errors->has('page_type')) 
                                            <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('page_type') }}</p> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group form-main-box" id="accessurlshow" hidden="true">
                                        {!! Form::label('Access URL', 'Access URL',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('access_url', null, array('class' => 'form-control','id' => 'access_url')) !!}
                                            @if ($errors->has('access_url')) 
                                            <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('access_url') }}</p> 
                                            @endif
                                        </div>
                                    </div> 

                                    <div class="form-group form-main-box">
                                        {!! Form::label('Page Title', 'Page Title *',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('page_title', null, array('class' => 'form-control')) !!}
                                            @if ($errors->has('page_title')) 
                                            <p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('page_title') }}</p> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('Sub Title', 'Sub Title',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('sub_title', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('Content Type', 'Content Type',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::select('content_type', ['Schools' => 'Schools','MainPage' => 'MainPage','Internal' => 'Internal'],'MainPage',array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('On Site', 'On Site',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::select('on_site', ['Yes' => 'Yes','No' => 'No'],'No',array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('Sort', 'Sort',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            {!! Form::text('page_sort', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('Web site','Web site',array('class' => 'control-label col-md-4')) !!}
                                        <div class="col-md-7">
                                            @foreach ($website_array as $k=>$v)
                                            <div class="col-md-2 m-t-10 p-0">
                                                {!! Form::checkbox('website_id[]',$k,null,array('class' => '')) !!}&nbsp;&nbsp;{{$v}}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                 <div class="text-center" style="margin-right:12%">@if ($errors->has('website_id')) <p class="help-block text-danger ">{{ $errors->first('website_id') }}</p> @endif</div>
                                    <div class="info-title page-info page-info-title">Page HTML</div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-md-12">
                                            <div class="adjoined-bottom">
                                                <div class="grid-container">
                                                    <div class="grid-width-100">
                                                        {!! Form::textarea('page_text', null, ['size' => '30x5','class' => 'form-control',
                                                        'id' => 'editor_1']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--------------------------SEO SECTION START----------------------------------->
                                    <div class="info-title page-info page-info-title">SEO Information<span class="sort-down"><a href="#"><i class="fa fa-arrow-circle-down seo-down" aria-hidden="true"></i> <i class="fa fa-arrow-circle-up seo-down" style="display:none" aria-hidden="true"></i></a></span></div>
                                    <div class="seo-con">
                                        <div class="form-group row form-main-box">
                                            <label class="control-label col-md-4">
                                                <div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <strong>Meta Title</strong>&nbsp;(max chars 50)
                                            </label>
                                            <div class="col-md-7">
                                                {!! Form::text('meta_title', null, array('class' => 'form-control','id' => 'meta_title')) !!}
                                            </div>
                                            <div class="col-md-1">[0]</div>
                                        </div>

                                        <!-------------META DESCRIPTION---------->
                                        <div class="form-group">
                                            <label class="control-label col-md-4">
                                                <div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height:20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <strong>Meta Description</strong> &nbsp;(max chars 250)<i data-tooltip="tooltip" title="" data-original-title="Page HTML"></i>
                                            </label>
                                            <div class="col-md-7">
                                                {!! Form::textarea('meta_description', null, ['size' => '30x5','class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-1">[0]</div>
                                        </div>

                                        <!-------------META KEYWORDS---------->
                                        <div class="form-group row form-main-box">
                                            <label class="control-label col-md-4">
                                                <div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <strong>Meta Keywords</strong>&nbsp;(max chars 150)
                                            </label>
                                            <div class="col-md-7">
                                                {!! Form::textarea('meta_keywords', null, ['class' => 'form-control','id' => 'meta_keywords']) !!}
                                            </div>
                                            <div class="col-md-1">[0]</div>
                                        </div>

                                        <!-------------TARGETED KEYWORDS---------->
                                        <div class="form-group row form-main-box">
                                            <label class="control-label col-md-4">
                                                <div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <div style="width: 20px; height: 20px; background-color: red; float:left; margin-right:10px;"></div>
                                                <strong>Targeted Keywords</strong>&nbsp;(max chars 150)
                                            </label>
                                            <div class="col-md-7">
                                                {!! Form::textarea('targeted_keyword', null, ['size' => '30x5','class' => 'form-control',
                                                'id' => 'editor_1']) !!}

                                            </div>
                                            <div class="col-md-1">[0]</div>
                                        </div>
                                    </div>
                                    <!--------------------------SEO SECTION START----------------------------------->
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>

                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                    {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'MyFunction()')) !!}
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <!----------------- RIGHT  BOX ----------------->
        <div class="col-xs-3 col-sm-3 m-t-20">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="card-box">
                        <div class="bg-muted p-10">Publish
                            <span class="sort-down">
                                <a href="#" title="">
                                    <i class="fa fa-arrow-circle-down circle-down" aria-hidden="true"></i> 
                                    <i class="fa fa-arrow-circle-up circle-down" style="display:none" aria-hidden="true"></i>
                                </a>
                            </span>
                        </div>

                        <div class="publish-con">
                            <div class="">
                                <i class="fa fa-map-pin m-r-5 p-t-20" aria-hidden="true"></i>Status: 
                                <span id="page_status"><?php echo "Published"; ?></span> 
                                <span class="edit-show m-l-10"><a href="#" title="">Edit</a></span>
                            </div>

                            <div id="published" class="p-t-10">
                                {!! Form::select('status', ['Draft' => 'Draft','Pending' => 'Pending Review','Published'=>'Published'],
                                'Published',array('class' => 'form-control p-t-10','id'=>'status')) !!}
                                <span id="okcancel" class="btn btn-primary m-l-10 m-t-10">OK</span>
                                <span id="cancel" class="m-l-10"><a href="#" title="">Cancel</a></span>
                            </div>

                            <div class="p-t-5">
                                <div  class="p-t-20"><i class="fa fa-eye m-r-5" aria-hidden="true"></i>Visibility: 
                                    <strong><span id="page_visibility"><?php echo "Public"; ?></span></strong>
                                    <span id="publishtabedit2" class="m-l-10"><a href="#" title="">Edit</a></span>
                                </div>

                                <div id="publishtab2">

                                    <label class="label_checkbox">
                                        {!! Form::radio('visibility', 'Public',null,array('class' => 'm-r-10')) !!}
                                        <span>Public</span>
                                    </label><br>

                                    <label class="label_checkbox">
                                        {!! Form::radio('visibility', 'Password protected',null,array('id' => 'visibility',
                                        'class' => 'm-r-10','onclick' => 'MyAlert()')) !!}
                                        <span>Password protected</span>
                                    </label><br>

                                    <div class="p-t-10" id="password_protected" style="display: none;">
                                        {!! Form::text('password', null, array('class' => 'form-control')) !!}
                                    </div>

                                    <label class="label_checkbox">
                                        {!! Form::radio('visibility','Private',null,array('class' => 'm-r-10')) !!}
                                        <span>Private</span>
                                    </label><br>
                                    <span id="okvisibility" class="btn btn-primary">OK</span>
                                    <span class="m-l-10"><a id="p-cancel" href="#" title="">Cancel</a></span>
                                </div>
                            </div>

                            <div class="bg-muted p-10 m-t-15">
                                <span class="btn-right">
                                    {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'MyFunction()')) !!}
                                </span>
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---------------- RELATIVE SUBMIT BUTTON ------------------------->
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                    {!! Form::submit('Save page',array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'MyFunction()')) !!}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
</div>
<script>

    //on page type change
    $('#purpose').on('change', function () {
        $("#accessurlshow").toggle(this.value == 'Goto Page');
        if (this.value == 'Goto Page') {
            $('#permalink_show').hide();
        }
        if (this.value == 'Typical Page') {
            $('#permalink_show').show();
        }
    });
    /* right box script */
    $(document).ready(function () {

        $(".circle-down").click(function () {
            $(".publish-con").slideToggle();
            $('.fa-arrow-circle-down').toggle();
            $('.fa-arrow-circle-up').toggle();
        });
        $(".edit-show").click(function () {
            $("#published").slideToggle();
                    $('#status :selected').text() = document.getElementById("page_status").textContent;
                    $('.edit-show').hide();
        });
        $("#cancel").click(function () {
            $("#published").slideUp();
            $('.edit-show').show();
        });

        //ok status
        $("#okcancel").click(function () {
            $("#published").slideUp();
            //alert($('#status :selected').text());
            document.getElementById("page_status").textContent = $('#status :selected').text();
            $('.edit-show').show();
        });

        //ok visibility button
        $("#okvisibility").click(function () {

            $("#publishtab2").slideUp();
            //assign value into lable
            document.getElementById("page_visibility").textContent = $("input[name=visibility]:checked").val();
            $('#publishtabedit2').show();
        });


        $("#publishtabedit2").click(function () {
            $("#publishtab2").slideToggle();
            $('#publishtabedit2').hide();
        });


        $("#p-cancel").click(function () {
            $("#publishtab2").slideUp();
            $('#publishtabedit2').show();
        });

        $("#publishtabedit3").click(function () {
            $("#publishtab3").slideToggle();
            $('#publishtabedit3').hide();
        });

        $("#p-cancel3").click(function () {
            $("#publishtab3").slideUp();
            $('#publishtabedit3').show();
        });
        // on click edit button will show edit access url box
        $(".edit_permalink").click(function () {
            $("#permalink_show").hide();
            $("#accessurlshow").show();
                    $('#access_url').text() = document.getElementById("access_url").textContent;
                    $('.edit_permalink').hide();
            $("#permalink_show").show();
        });
        // cancel button close the text box 
        $("#cancel_permalink").click(function () {
            $("#accessurlshow").hide();
            $('#permalink_show').show();
        });
        // on click ok button change permalink for only view

        $(".seo-down").click(function () {
            $(".seo-con").slideToggle();
            $('.fa-arrow-circle-down').toggle()
            $('.fa-arrow-circle-up').toggle()
        });

    });

    $("#tab2").click(function () {
        $("#tab-description2").slideToggle();
        $("#tab1").toggleClass("top-btn-hide");
        $("#tab2 .fa").toggleClass("fa-angle-double-up");
        $("#tab2 .fa").toggleClass("fa-angle-double-down");
    });

    function MyAlert()
    {
        //alert ("You have selected one option" );  
        $("#password_protected").slideToggle();
    }

    //form submit
    function MyFunction() {

        //if access_url blank
        if (document.getElementById("access_url").value == "") {
            if (document.getElementById("purpose").value == "Typical Page") {
                generate_url();
            }
        }
    }

    //Generate url by fetch menu title
    function generate_url() {

        var menu_title = document.getElementById("navigation_title").value;
        var new_url = menu_title.split(' ').join('-');
        document.getElementById("access_url").value = new_url.toLowerCase();
    }

</script>
<!-------------------- CK-EDITOR CONFIGURATION ------------------->
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/adapters/jquery.js'; ?>"></script>
<script src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/js/sample.js"></script>
<script type="text/javascript" src="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/config.js"></script> 
<link rel="stylesheet" href="<?php echo url('/'); ?>/vendor/unisharp/laravel-ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

<script>
    CKEDITOR.replace('editor_1', {
        height: 500,
        filebrowserBrowseUrl: '/tfs/boces_laravel/dev/vendor/unisharp/laravel-ckeditor/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/tfs/boces_laravel/dev/vendor/unisharp/laravel-ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700'


    });
    CKFinder.setupCKEditor(editor, '/tfs/boces_laravel/dev/vendor/unisharp/laravel-ckeditor/ckfinder/');
</script>

@endsection