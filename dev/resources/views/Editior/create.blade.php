
@extends('layouts.master_admin')
@section('content')
<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}
    #form label.error {color:red;}
    #form input.error {border:1px solid red;}
</style>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Edit Themes</h4>
        </div>
    </div>
    <div class="row">
        {!! Form::open(array('url' => 'Editor/create/'.$file,'files'=>'true','id' => 'myForm','class' => 'form-horizontal')) !!}
        <div class="col-xs-12 col-sm-12 m-t-20">
            <div class="card-box">
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                @endif
                <?php
                if (Request::segment(3) != "") {
                    $data = file_get_contents(base_path() . '/resources/assets/css/' . $file);
                    //print_r($data);exit;
                } elseif (Request::segment(3) == '') {
                    $data = file_get_contents(base_path() . '/resources/assets/css/style.css');
                    //print_r($data);exit;
                }
                ?>

                <div class="form-group row form-main-box">
                    <label class="control-label col-sm-4 col-md-2 p-t-10"><?php if (Request::segment(3) != "") {
                    echo $file;
                } else {
                    echo "style.css";
                } ?></label>
                </div>
                <div class="form-group row form-main-box">
                    <div class="col-sm-10 col-md-10">
                        <textarea name="style" id="editor1" style="width: 100%" rows="20" cols="100">
<?php echo (isset($data)) ? $data : set_value('style'); ?>
                        </textarea>
                    </div>
                    <div class="col-sm-2 col-md-2 "> 
                        <label class="control-label"><h3>Styles</h3></label>
                        <ul>
                                <?php
                                foreach ($map as $file) {
                                    ?>
                                <li class="sub-category list-unstyled">
                                <?php
                                $file = basename($file);
                                ?>
                                    <a href="<?php echo url('/') . '/Editor/create/' . $file; ?>"><?php echo $file; ?></a><br>
                                </li>
<?php }
?>

                        </ul>
                    </div>

                </div>
                <div class="form-group row form-main-box">
                    <label class="control-label col-sm-4 col-md-3 p-t-10"></label>
                    <div class="col-sm-6 col-md-5">
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                            {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#btn').click(function (e) {
            e.preventDefault();
            $("#myForm").submit();
        });
    });
</script>
@stop