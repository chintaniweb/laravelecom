@extends('layouts.master_admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title"> Update Filing Cabinet Category</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            {!! Form::model($category,array('route' => array('Filing_cabinet_category.update',$category->filing_cabinet_category_id), 'method' => 'PUT','files'=>'true','class' => 'form-horizontal','id'=>'myForm')) !!}
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <?php if ($page_tree != "") { ?>
                            <div class="form-group">
                                <label class="control-label col-sm-4">File Category <i data-tooltip="tooltip" title="" data-original-title="Name of Page"></i></label>
                                <div class="col-sm-7">
                                    <?php
                                    echo $page_tree;
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group row form-main-box">
                            <label class="control-label col-sm-4" for="site">Category Name</label>
                            <div class="col-sm-7">
                                {!! Form::text('category_name',null,['class'=>'form-control', 'id' => 'category_name']) !!} 
                            </div>
                            <span id="err_link_url" class="error col-md-7 col-md-push-4">{{$errors->first('category_name')}}</span>
                        </div>
                        <div class="form-group row form-main-box">
                            <label class="control-label col-sm-4">Category Sort</label>
                            <div class="col-sm-7">
                                {!! Form::text('category_sort',null,['class'=>'form-control', 'id' => 'category_sort','style'=>'width:100px;']) !!}      
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                    <div class="clearfix">

                    </div>
                </div>
                {!! Form::close() !!}    

                {!! Form::open(array('url' => 'Filing_cabinet_category/'.$category->filing_cabinet_category_id)) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('Delete', array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'return confirm("Are you sure you want to delete this item?")')) !!}Filing cabinet category
                {!!Form::close()!!}


            </div>
        </div>
    </div>
</div>
<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
   $(document).ready(function () {
       $("#myForm").validate({
           rules: {
               category_name: {required: true}
           },
           messages: {
               category_name: "The Category Name field is required",
           },
           errorElement: 'div'
           
       });
   });
</script>

@endsection