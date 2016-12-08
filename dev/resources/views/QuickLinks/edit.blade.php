@extends('layouts.master_admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title"> <?php echo "Update Quick links"; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            {!! Form::open(['url'=>'quicklinks/update/'.$data[0]->quick_links_id,'class'=>'form-horizontal','id'=>'myForm']) !!} 

            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class="form-group row form-main-box">
                            <label class="control-label col-md-4">URL</label>
                            <div class="col-md-7">
                                {!! Form::text('link_url',$data[0]->link_url,['class'=>'form-control', 'id' => 'link_url']) !!}
                            </div>
                            <span id="err_link_url" class="error col-md-7 col-md-push-4">{{$errors->first('link_url')}}</span>
                        </div>
                        <div class="form-group row form-main-box">
                            <label class="control-label col-md-4">Friendly Link</label>
                            <div class="col-md-7">
                                {!! Form::text('link_friendly',$data[0]->link_friendly,['class'=>'form-control', 'id' => 'link_friendly']) !!}       
                            </div>
                            <span id="err_link_url" class="error col-md-7 col-md-push-4">{{$errors->first('link_friendly')}}</span>
                        </div>
                        <div class="form-group row form-main-box">
                            <label class="control-label col-md-4">Sort</label>
                            <div class="col-md-7">
                                {!! Form::text('link_sort',$data[0]->link_sort,['class'=>'form-control', 'id' => 'link_sort','style'=>'width:100px']) !!}
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            <label class="control-label col-md-4">Active</label>
                            <div class="col-md-7">
                                {!! Form::select('active',['Yes'=>'Yes','No'=>'No'],$data[0]->active,['class'=>'form-control', 'id' => 'active']) !!}

                            </div>
                        </div> 
                        <div class="form-group row form-main-box">
                            <label class="control-label col-md-4">Type</label>
                            <div class="col-md-7">
                                {!! Form::select('link_type',['Public'=>'Public','Internal'=>'Internal'],$data[0]->link_type,['class'=>'form-control', 'id' => 'link_type']) !!}
                            </div>
                        </div> 
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}</div>
                    <div class="clearfix">
                        <a href="<?php echo url('/') . '/quicklinks/delete/' . $data[0]->quick_links_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                            Delete</a> check here to delete Quick Link
                    </div>
                </div>
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
     {!! Form::close() !!}   
</div>
<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#myForm").validate({
            rules: {
                link_url: {required: true},
                link_friendly: {required: true}
            },
            messages: {
                link_url: "The link url field is required",
                link_friendly: "The link friendly field is required"
            },
            errorElement: 'div'
            
        });
    });
</script>

@endsection