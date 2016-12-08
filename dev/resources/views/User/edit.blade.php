@extends('layouts.master_admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Update User</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">
            @if(Session::has('msg'))
            <p class="alert alert-success">{{ Session::get('msg') }}</p>
            @endif
            {!! Form::open(['url' => 'user/edit/'.$user->id , 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('remember_token',csrf_token()) !!}
            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class="form-group row form-main-box">
                            {!! Form::label('first_name','First Name',['class'=>'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('first_name',$user->first_name,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('last_name','Last Name',['class'=>'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('last_name',$user->last_name,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('email','Email',['class'=>'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('email',$user->email,['class' => 'form-control']) !!}
                            </div>
                            <span id="err_email_address" class="text-danger col-sm-7 col-sm-push-4">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('password','Password',['class'=>'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::input('password','password',null,['class' => 'form-control','autocomplete' => 'off']) !!}
                            </div>
                            <span id="err_password" class="text-danger col-sm-7 col-sm-push-4">{{ $errors->first('password') }}</span>
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('active','Active',['class' => 'control-label col-sm-4']) !!}
                            <div class="col-sm-7">
                                {!! Form::select('active', ['Yes' => 'Yes','No' => 'No'],$user->active,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row form-main-box">
                            {!! Form::label('Website','Website',array('class' => 'control-label col-md-4')) !!}
                            <div class="col-md-7">
                            <?php 
                                $i=1; 
                                $arr_website_id = array();
                                    //set location string
                                $user->website_id != "";

                                $arr_website_id = explode(",", $user->website_id);
                            ?>          
                            <div class="col-md-4 m-t-10 p-0">
                            <?Php
                            foreach ($website as $row) {
                            ?>
                            <?php
                            $checked = "";

                            if (in_array($row->website_id, $arr_website_id)) {
                             $checked = "checked";
                            } else {
                            $checked = "";
                             }
                             ?>
                            <input type="checkbox" id="site<?php echo $i; ?>" class="m-r-10 m-l-5" name="website_id[]" <?php echo $checked; ?> value="<?php echo $row->website_id; ?>">
                            <span><?php echo $row->name; ?></span>
                                                       
                                   <?php $i++;
                                        } ?>
                                               
                            </div>
                                </div>
                        </div>
                        <div class="form-group row form-main-box boces-role">
                             {!! Form::label('id','Role For Boces',array('class' => 'control-label col-md-4')) !!}
                            <div class="col-sm-7">
                                <?php $boces_role_id = (isset($user->boces_role_id)) ? $user->boces_role_id : set_value('boces_role_id'); ?>  
                                <?php
                                //print_r ($cte_role);exit;
                                ?>
                               <select name="boces_role_id" class="form-control" id="role_boces">
                                        <option value="">----Select Role-----</option>
                                        <?php foreach ($boces_role as $k=>$v) { 
                                            //print_r($k);exit;?>
                                            <option <?php echo ($k == $boces_role_id) ? "Selected" : ""; ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>                                        
                                        <?php } ?>
                                    </select>     
                            </div>
                        </div>
                        <div class="form-group row form-main-box cte-role">
                             {!! Form::label('id','Role For CTE',array('class' => 'control-label col-md-4')) !!}
                            <div class="col-sm-7">
                               <?php $cte_role_id = (isset($user->cte_role_id)) ? $user->cte_role_id : set_value('cte_role_id'); ?>  
                                <?php
                                //print_r ($cte_role);exit;
                                ?>
                               <select name="cte_role_id" class="form-control" id="role_cte">
                                        <option value="">----Select Role-----</option>
                                        <?php foreach ($cte_role as $k=>$v) { 
                                            //print_r($k);exit;?>
                                            <option <?php echo ($k == $cte_role_id) ? "Selected" : ""; ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>                                        
                                        <?php } ?>
                                    </select>  
                            </div>
                        </div>
                        <div class="form-group row form-main-box eta-role">
                             {!! Form::label('id','Role For ETA',array('class' => 'control-label col-md-4')) !!}

                            <div class="col-sm-7">
                               <?php $eta_role_id = (isset($user->eta_role_id)) ? $user->eta_role_id : set_value('eta_role_id'); ?>  
                                <?php
                                //print_r ($cte_role);exit;
                                ?>
                               <select name="eta_role_id" class="form-control" id="role_eta" >
                                        <option value="">----Select Role-----</option>
                                        <?php foreach ($eta_role as $k=>$v) { 
                                            //print_r($k);exit;?>
                                            <option <?php echo ($k == $eta_role_id) ? "Selected" : ""; ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>                                        
                                        <?php } ?>
                                    </select>  
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                        {!! Form::submit( 'Update', ['class'=>'btn btn-primary btn-rect btn-sm']) !!}
                    </div>
                    <div class="clearfix"></div>
                </div>
                {!! Form::close() !!}
                <div>
                    <a href="{{ url('user/delete/'.$user->id) }}" onclick="return confirm('Are you sure you want to delete this item?');">Delete </a>Click here to delete this user
                </div>
            </div>
        </div>
    </div>
    
<script type="text/javascript">
$(document).on("ready change",function(){
    
    if($('#site1').is(":checked")) 
   
    {
        $(".boces-role").show();
    }
   else if ($("#role_boces").val() !== "") {
     alert("First Delete Boces Role");
   }
    else
    {
        $(".boces-role").hide();
    }
   if($('#site2').is(":checked")) 
   
   {
        $(".cte-role").show();
    }
    else if ($("#role_cte").val() !== "") {
     alert("First Delete CTE Role");
   }
    else
    {
        $(".cte-role").hide();
    }
    if($('#site3').is(":checked")) 
   
   {
        $(".eta-role").show();
    }
    else if ($("#role_eta").val() !== "") {
     alert("First Delete ETA Role");
   }
    else
    {
        $(".eta-role").hide();
    }
        
    });

</script>
 @stop