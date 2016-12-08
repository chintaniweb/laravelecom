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
            <h4 class="page-title">Export</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            {!! Form::open(array('url' => 'Export','class' => 'form-horizontal','id'=>'myForm')) !!}
            
            
                <div class="card-box m-b-0">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                        @endif
                    <div class="row">
                        <div class="col-sm-12">
                                    <label class="form-control" for="site_content">Page</label>
                                </div>
                        <div class=" col-sm-12 col-xs-12 p-t-b-10">
                                
                                <div class="col-sm-3">Site Content
                                </div>
                            </div>
                        <div class="col-sm-12">
                             <label class="form-control" for="status">Status</label>
                             </div>
                         <div class=" col-sm-3 col-xs-3 p-t-b-10">
                             
                             <select class="form-control" name="status">
                                 <option value="<?php echo 'Draft'; ?>"><?php echo 'Draft'; ?></option>
                                 <option value="<?php echo 'Pending';?>"><?php echo 'Pending'; ?></option>
                             </select>
                         </div>
                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> <a id="btn" class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Export</a> </div>
                        
                    </div>
            {!!Form::close()!!}   
        </div>
    </div>
</div>

</div>




<script type="text/javascript">
    $(function () {
        $('#btn').click(function (e) {
            e.preventDefault();
            $("#myForm").submit();
        });
    });
    </script>
@stop