@extends('layouts.master_admin')
@section('content')
<?php
//$id=Request::segment(2);
//echo $val;
//exit;
//echo "<pre>";
//print_r($data);
//echo "<pre>";
//print_r($permissions_data);
//exit;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Administration area</h4>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 m-t-20">
                {!! Form::open(['url'=>'Roles/update/'.$data[0]->id,'class'=>'form-horizontal','id'=>'myForm']) !!}
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                @endif

                <div class="card-box m-b-0">
                    <div class="info-title page-info page-info-title"><strong>Admin Roles</strong> </div>
                    <div class="row">
                        
                        <div class="form-group">
                            {!!Form::label('Role Name','Role Name',['class'=>'control-label col-sm-2'])!!} 
                            <div class="col-sm-3">
                                {!! Form::label('name',$data[0]->name,['class'=>'form-control']) !!}  
                            </div>
                        </div>
                        <div class="form-group">
                            {!!Form::label('Role Description','Role Description',['class'=>'control-label col-sm-2'])!!} 
                            <div class="col-sm-3">
                               {!! Form::label('description',$data[0]->description,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="info-title page-info page-info-title"><strong>Administrator Roles Right</strong></div>
                        <div class="col-sm-8 col-xs-12 col-sm-offset-2 p-0">
                            <?php
                            foreach ($permissions_data as $row) {
                                ?>
                                <div class="control-group">
                                    <div class="col-sm-4">
                                        <div class="col-xs-12">
                                          <?php
                                            $checked = "";
                                          
                                            if (in_array($row->id,$permission_role)) {
                                                $checked = "checked";
                                            } else {
                                                $checked = "";
                                            }
                                            ?>
                                            <input type="checkbox" class="m-r-10" name="permissions_id[]"  <?php echo $checked; ?> value="<?php echo $row->id;?>">
                                            <span><?php echo $row->display_name; ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="control-group">
                                <div class="col-sm-4">
                                <div class="col-xs-15">
                            {!!Form::checkbox('selectall',null,null,['id'=>'selecctall','class' => 'm-r-10'])!!}&nbsp;&nbsp;&nbsp;
                                Select All
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div style="position:relative;">
        <div class="navbar-fixed-bottom fix-b-list">
            <div class="card-box " style="background-color:#f5f5f5;">
                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                    {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                    <!--a class="adminlink btn btn-danger btn-rect btn-sm" href="javascript: if (confirm('Are you sure you want to delete this page?')) { if (confirm('This will remove all data related to this page. (Including Backup)')) {document.location.href='manage.php?p=page_mng&amp;a=delete&amp;PageId=147&amp;RetFlg=&amp;page=1&amp;perPage=50&amp;PageTypeS=All&amp;box_search=';}}"><i style="font-size:14px" class="icon-minus-circle"></i>Cancel</a--> </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}     
</div>
<script>
     $(document).ready(function () {

        $("#selecctall").change(function () {
            $(".m-r-10").prop('checked', $(this).prop("checked"));
        })
    });
</script>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo url('/') . '/vendor/unisharp/laravel-ckeditor/adapters/jquery.js'; ?>"></script>
<script>
//replcae editor_1 id by ck_editor
$('#editor_1').ckeditor(); // if class is prefered.
</script>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 
<!-- jQWidgets core JavaScript --> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdata.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxscrollbar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/globalization/globalize.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>

@endsection