@extends('layouts.master_admin')
@section('content')
<style>
    .text-danger .alert {padding: 0 !important; margin-bottom: 5px !important; font-weight: normal !important;}
    .text-danger .alert strong {font-weight: normal !important;}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Menus</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="row">
                <div class="col-lg-12 col-xs-12 p-t-10">
                    <div class="info-title page-info page-info-title">Maintain Daily Defaults (Lunch) | 
                        <a href="<?php echo url('/'); ?>/menu_intro">intro paragraph</a> | 
                        <a href="<?php echo url('/'); ?>/menu_intro/weekend_setting_updates">WEEKEND OPTION</a> | 
                        <a href="<?php echo url('/'); ?>/menu/menucopyview">COPY MENU</a> | 
                        <a href="<?php echo url('/'); ?>/menu_intro/ical_setting">ICAL OPTION (OFF)</a>
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12 p-t-10">
                    <div class="info-title page-info page-info-title">Menu Copy :
                        Select the existing MENU you would like to COPY FROM - then enter the menu you'd like to COPY TO
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12 p-0 m-b-10">
                    {!! Form::open(array('url' => '/menu/menucopy','class' => 'form-horizontal')) !!}
                    <?php
                    $month = (isset($month)) ? $month : "";
                    ?>    
                    <div class="col-lg-4 col-xs-12 p-t-b-10">
                        Copy FROM
                        <select name="copyfrom" class="form-control">
                            <?php for ($i = 0; $i < count($existing_menu_lable); $i++) { ?>                                
                                <option value="<?php echo $existing_menu_value[$i]->Month; ?>"> <?php echo $existing_menu_lable[$i]->Month; ?></option>
                            <?php }
                            ?>
                        </select>
                        <BR>
                        Copy TO
                        <select name="copyto" class="form-control">
                            <?php
                            $curr_month = mktime(0, 0, 0, date('m'), date('d'), date('y'));
                            $next_year = mktime(0, 0, 0, date('m') + 12, date('d'), date('y'));

                            for ($i = 0; $i <= date("M") + 12; $i++) {
                                $next_month = mktime(0, 0, 0, date('m') + $i, date('d'), date('y'));
                                ?>
                                <option value="<?php echo date("Y-m", $next_month); ?>"><?php echo date("Y-M", $next_month); ?></option>
                            <?php } ?>
                        </select>
                        <BR>
                        Category
                        <select class="form-control" name="category_id">
                            <?php foreach ($category as $row) { ?>                                
                                <option value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>                                
                            <?php } ?>
                        </select>
                        <BR>
                        {!! Form::submit('Copy Data >',array('class' => 'form-control')) !!}
                        <!--<input type="submit" value="Copy Data &gt;" name="mysubmit" class="form-control">-->
                    </div>
                    <div class="col-lg-12 col-xs-12 p-t-b-10">
                        Once the menu data is added for you, you will have a chance to hand edit any days if necessary. Please note that any existing data for the new dates being copied to will be removed.
                    </div>    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop