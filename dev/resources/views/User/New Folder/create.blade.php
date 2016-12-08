@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Add User</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('msg'))
            <p class="alert alert-success">{{ Session::get('msg') }}</p>
            @endif
            {!! Form::open(['action' => 'User@store','autocomplete' => 'off']) !!}      
            {!! Form::hidden('remember_token',csrf_token()) !!}
            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class="form-group row form-main-box">
                            {!! Form::label('first_name','First Name',['class' => 'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('first_name','',['class' => 'form-control','autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('last_name','Last Name',['class' => 'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('last_name',null,['class' => 'form-control']) !!}
                            </div>                               
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('email','Email',['class' => 'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('email',null,['class' => 'form-control' , 'autocomplete' => 'off']) !!}                                    
                            </div>
                            <span class="text-danger col-sm-7 col-sm-push-4">{{ $errors->first('email') }}</span>
                        </div>                            
                        <div class="form-group row form-main-box">
                            {!! Form::label('password','Password',['class' => 'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::password('password',['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>
                            <span class="text-danger col-sm-7 col-sm-push-4">{{ $errors->first('password') }}</span>
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('active','Active',['class' => 'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::select('active', ['Yes' => 'Yes','No' => 'No'],'active',['class' => 'form-control']) !!}
                            </div>
                        </div>
                        
                        <div class="form-group row form-main-box">
                            {!! Form::label('Web site','Web site',array('class' => 'control-label col-md-4')) !!}
                            <div class="col-md-7">
                                <?php $i=1 ?>
                                @foreach ($user_create as $k=>$v)
                                <div class="col-md-2 m-t-10 p-0">
                                    {!! Form::checkbox('website_id[]',$k,null,array('class' => '','id'=>'site'.$i)) !!}&nbsp;&nbsp;{{$v}}
                                </div>
                                <?php  $i++ ?>
                                @endforeach
                                
                            </div>
                            <span class="text-danger col-sm-7 col-sm-push-4">{{ $errors->first('website_id') }}</span>
                        </div>
                        <div class="form-group row form-main-box boces-role">
                            {!! Form::label('id','Role For Boces',array('class' => 'control-label col-md-4')) !!}
                            <div class="col-md-7">
                               <select name="boces_role_id" class="form-control">
                                            <option value="">----Select Role-----</option>
                                            @foreach ($user_role as $k => $v)
                                                <option value="{{$k}}">{{$v}}</option>                                          
                                            @endforeach
                                        </select>
                            </div>
                        </div>
                         <div class="form-group row form-main-box cte-role">
                            {!! Form::label('id','Role For CTE ',array('class' => 'control-label col-md-4')) !!}
                            <div class="col-md-7">
                               <select name="cte_role_id" class="form-control">
                                            <option value="">----Select Role-----</option>
                                            @foreach ($user_role1 as $k => $v)
                                                <option value="{{$k}}">{{$v}}</option>                                          
                                            @endforeach
                                        </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                        {!! Form::submit( 'Save page', ['class'=>'btn btn-primary btn-rect btn-sm']) !!}
                        <div class="clearfix"></div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
$(document).ready(function(){
    $(".boces-role").hide();
    $(".cte-role").hide();
    $('input[type="checkbox"]').click(function(){
    if($(this).attr("id")=="site1"){
        $(".boces-role").toggle();
    }
    if($(this).attr("id")=="site2"){
        $(".cte-role").toggle();
    }
        
    });
});
</script>
@stop