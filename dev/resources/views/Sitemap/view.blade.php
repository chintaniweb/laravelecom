@extends('layouts.master_admin')
@section('content')
<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}

    #form label.error {
        color:red;
    }
    #form input.error {
        border:1px solid red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title"> Sitemap Generate</h4>
        </div>
    </div>
    <div class="row">

        <div class="col-xs-12 col-sm-12 m-t-20">
              
            {!! Form::open(['url'=>'generate','class'=>'form-horizontal','files'=>'ture']) !!} 
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            
                <div class="card-box m-b-0">
                    
                    <div class="row">
                        <div class=" col-sm-12 col-xs-12 p-t-b-10">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-md-4" for="site">Output File</label>
                                <div class="col-md-7">
                                    {!!Form::text('OUTPUT_FILE','sitemap.xml',['class'=>'form-control','id'=>'OUTPUT_FILE'])!!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-md-4">FREQUENCY</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="FREQUENCY">                                        
                                        <option value="daily">daily</option>                                        
                                        <option value="weekly">weekly</option>                                        
                                        <option value="monthly">monthly</option>                                        
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row form-main-box">
                                <label class="control-label col-md-4" for="site">PRIORITY</label>
                                <div class="col-md-7">
                                   
                                    {!!Form::text('PRIORITY','0.5',['class'=>'form-control','id'=>'PRIORITY'])!!}
                                </div>
                            </div>
                            <!--div class="form-group row form-main-box">
                                <label class="control-label col-md-4">Skip URL<i data-tooltip="tooltip"  data-original-title="Page HTML"></i></label>
                                <div class="col-md-7">
                                    <textarea class="form-control" id="description" name="skip_url"></textarea>
                                    Note. Enter skip url with comma seperated.
                                </div>
                            </div-->

                            <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                                </br>
                            <a href="<?php echo url('/').'/sitemap.xml' ?>" target="_blank" style="margin-left:-500px;margin-right:250px;"> Open file : sitemap.xml</a>
                                {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        </form>    
                    </div>
                </div>
        </div>
        <div style="position:relative;">
            <div class="navbar-fixed-bottom fix-b-list">
                <div class="card-box m-b-0 p-10" style="background-color:#f5f5f5;">
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> <a id="btn2" class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save</a></div>
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
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 

    <script src="<?php echo url('/'); ?>/resources/client_validate/js/jquery.validate.min.js" type="text/javascript"></script>


    <!-- jQuery Form Validation code -->
    <script>

                                        $(function () {
                                            $('#btn').click(function (e) {
                                                e.preventDefault();
                                                $("#myForm").submit();
                                            });
                                            $('#btn2').click(function (e) {
                                                e.preventDefault();
                                                $("#myForm").submit();
                                            });
                                            $('#btn3').click(function (e) {
                                                e.preventDefault();
                                                $("#myFormImage").submit();
                                            });

                                            //get value from PHP - hidden element
                                            hidden_on_date = $("#hidden_on_site_date").val();
                                            hidden_off_date = $("#hidden_off_site_date").val();

                                            //set updated date
                                            if (hidden_on_date != "01/01/1970")
                                                $('#on_site_date').jqxDateTimeInput('setDate', hidden_on_date);
                                            if (hidden_off_date != "01/01/1970")
                                                $('#off_site_date').jqxDateTimeInput('setDate', hidden_off_date);

                                        });
                                        $("#on_site_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: ""})
                                        $("#off_site_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: ""})

                                        $(document).ready(function () {
                                            $("#myForm").validate({
                                                rules: {
                                                    title: {
                                                        required: true
                                                    }
                                                },
                                                messages: {
                                                    title: "The Slide Show Title field is required"
                                                },
                                                errorElement: "div"
                                            });
                                        });

    </script>
@endsection